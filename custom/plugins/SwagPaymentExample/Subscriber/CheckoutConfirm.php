<?php

namespace SwagPaymentExample\Subscriber;

use Enlight\Event\SubscriberInterface;
use Shopware\Components\DependencyInjection\Bridge\Models;
use Shopware\Models\Order\Order;
use SwagPaymentExample\Services\CheckoutService;

class CheckoutConfirm implements SubscriberInterface
{
    /**
     * @var CheckoutService
     */
    private $checkoutService;

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return [
            'Enlight_Controller_Action_PostDispatch_Frontend_Checkout' => 'onPreDispatch',
            'Enlight_Controller_Action_PostDispatch_Frontend_Checkout_Confirm' => 'onConfirm',
        ];
    }

    public function __construct(CheckoutService $checkoutService) {
        $this->checkoutService = $checkoutService;
    }

    public function onPreDispatch(\Enlight_Event_EventArgs $args): void {
        $controller = $args->getSubject();
        $controller->View()->addTemplateDir(__DIR__ . '/../Resources/views');
        $basket = $controller->getBasket();
        $controller->View()->assign('sBasket', $basket);
        $publicKey = Shopware()->Container()->getParameter('lq.public.key');
        $privateKey = Shopware()->Container()->getParameter('lq.private.key');

        if ($_POST['data']) {
            $responseData = $_POST['data'];
            $responseSignature = $_POST['signature'];
            $signature = $this->checkoutService->str_to_sign($privateKey.$responseData.$privateKey);

            // checking request on trust
            if ($responseSignature === $signature) {
                $data = base64_decode($responseData);
                $dataArr = get_object_vars(json_decode($data));
                $orderNumber = $controller->saveOrder();
                $order = Shopware()->Models()->getRepository(Order::class)->findBy(['number' => $orderNumber]);

                if ($dataArr['status'] === 'success') {
                    Shopware()->Modules()->Order()->setOrderStatus($order[0]->getId(),'2');
                    $controller->redirect([
                        'controller' => 'checkout',
                        'action' => 'finish',
                    ]);

                    return;
                }

                Shopware()->Modules()->Order()->setPaymentStatus($order[0]->getId(),0);
            }
        }

        $parameters = $this->checkoutService->setParameters($basket, $publicKey);
        $json = json_encode($parameters);
        $data = base64_encode($json);
        $signature = $this->checkoutService->str_to_sign($privateKey.$data.$privateKey);

        $controller->View()->assign([
            'data' => $data,
            'signature' => $signature
        ]);
    }

    public function onConfirm(\Enlight_Event_EventArgs $args): void {
        $controller = $args->getSubject();
        if ($controller->get('session')->get('sUserId') === null) {
            $controller->redirect([
                'module' => 'frontend',
                'controller' => 'account',
                'action' => 'login',
                'sTarget' => 'checkout',
                'sTargetAction' => 'confirm'
            ]);
        }
    }

    public function createPaymentToken($amount, $customerId)
    {
        return md5(implode('|', [$amount, $customerId]));
    }
}
