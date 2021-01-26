<?php declare(strict_types=1);

namespace DvConfiguration\Subscribers;

use Enlight\Event\SubscriberInterface;
use Shopware\Models\Category\Category;

class FrontendIndexSubscriber implements SubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return [
            'Enlight_Controller_Action_PostDispatch_Frontend_Index' => 'onPreDispatchTemplateRegistration'
        ];
    }

    public function onPreDispatchTemplateRegistration(\Enlight_Event_EventArgs $args)
    {
        /** @var \Shopware_Controllers_Frontend_RoutingDemonstration $subject */
        $controller = $args->getSubject();
        $controller->View()->addTemplateDir(__DIR__ . '/../Resources/views');

        $categoryBlocksService = $controller->get('dv_configuration.services.product_name_service');
        $categories = $categoryBlocksService->getCategories();
        $controller->View()->assign('categories', $categories);
    }
}
