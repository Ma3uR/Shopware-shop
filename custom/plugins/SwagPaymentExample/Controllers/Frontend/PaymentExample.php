<?php

use SwagPaymentExample\Components\ExamplePayment\PaymentResponse;
use SwagPaymentExample\Components\ExamplePayment\ExamplePaymentService;

class Shopware_Controllers_Frontend_PaymentExample extends Shopware_Controllers_Frontend_Payment
{
    const PAYMENTSTATUSPAID = 12;

    public function preDispatch()
    {
        /** @var \Shopware\Components\Plugin $plugin */
        $plugin = $this->get('kernel')->getPlugins()['SwagPaymentExample'];

        $this->get('template')->addTemplateDir($plugin->getPath() . '/Resources/views/');
    }

    /**
     * Index action method.
     *
     * Forwards to the correct action.
     */
    public function indexAction()
    {
        /**
         * Check if one of the payment methods is selected. Else return to default controller.
         */
        switch ($this->getPaymentShortName()) {
            case 'example_payment_invoice':
                return $this->redirect(['action' => 'gateway', 'forceSecure' => true]);
            case 'example_payment_cc':
                return $this->redirect(['action' => 'direct', 'forceSecure' => true]);
            default:
                return $this->redirect(['controller' => 'checkout']);
        }
    }

    /**
     * Gateway action method.
     *
     * Collects the payment information and transmit it to the payment provider.
     */
    public function gatewayAction()
    {
        $providerUrl = $this->getProviderUrl();
        $this->View()->addTemplateDir(__DIR__ . '/../../Resources/views/frontend/checkout');
        $this->View()->assign('fields', $providerUrl);
        $this->View()->assign('gatewayUrl', $providerUrl . $this->getUrlParameters());
    }

    /**
     * Direct action method.
     *
     * Collects the payment information and transmits it to the payment provider.
     */
    public function directAction()
    {
        $providerUrl = $this->getProviderUrl();
        $this->redirect('https://www.liqpay.ua/api/3/checkout' . $this->getUrlParameters());
    }

    /**
     * Return action method
     *
     * Reads the transactionResult and represents it for the customer.
     */
    public function returnAction()
    {
        /** @var ExamplePaymentService $service */
        $service = $this->container->get('swag_payment_example.example_payment_service');
        $user = $this->getUser();
        $billing = $user['billingaddress'];
        /** @var PaymentResponse $response */
        $response = $service->createPaymentResponse($this->Request());
        $token = $service->createPaymentToken($this->getAmount(), $billing['customernumber']);

        if (!$service->isValidToken($response, $token)) {
            $this->forward('cancel');

            return;
        }

        switch ($response->status) {
            case 'accepted':
                $this->saveOrder(
                    $response->transactionId,
                    $response->token,
                    self::PAYMENTSTATUSPAID
                );
                $this->redirect(['controller' => 'checkout', 'action' => 'finish']);
                break;
            default:
                $this->forward('cancel');
                break;
        }
    }

    /**
     * Cancel action method
     */
    public function cancelAction()
    {
    }

    /**
     * Creates the url parameters
     */
    private function buttonAction()
    {
        /** @var ExamplePaymentService $service */
        $service = $this->container->get('swag_payment_example.example_payment_service');
        $user = $this->getUser();
        $billing = $user['billingaddress'];
        $firstName = $billing['firstname'];
        $lastName = $billing['lastname'];

        $publicKey = 'sandbox_i99285382524';
        $privateKey = 'sandbox_Fldbwc8nWh3TZMf7fzi1tzxkAA4gVF5rCezFWan1';

        $basket = $this->getBasket();
        $orderNumber = $basket['content'][0]['ordernumber'];

        $parameter = [
            "public_key" => $publicKey,
            "amount" => (string)$this->getAmount(),
            "result_url" => "http://test-shopware.com/checkout/final",
            "version" => '3',
            "action" => 'pay',
            "currency" => $this->getCurrencyShortName(),
            "description" => "Hello, $firstName $lastName. You buying on test-shopware.com",
            "token" => $service->createPaymentToken($this->getAmount(), $billing['customernumber']),
            "order_id" => '10005'
        ];
        $json = json_encode($parameter);
        $data = base64_encode($json);
        $signature = $this->str_to_sign($privateKey.$data.$publicKey);

        $this->View()->assign([
            'data' => $data,
            'signature' => $signature
        ]);
    }

    public function str_to_sign($str)
    {
        $signature = base64_encode(sha1($str, 1));

        return $signature;
    }

    /**
     * Returns the URL of the payment provider. This has to be replaced with the real payment provider URL
     *
     * @return string
     */
    protected function getProviderUrl()
    {
        return '';
    }
}
