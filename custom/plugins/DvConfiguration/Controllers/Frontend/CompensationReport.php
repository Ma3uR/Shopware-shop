<?php declare(strict_types=1);

class Shopware_Controllers_Frontend_CompensationReport extends Enlight_Controller_Action
{
    /**
     * @var \DvConfiguration\Services\CompensationReportService|object|null
     */
    private $compensationReportService;

    public function preDispatch()
    {
        $this->compensationReportService = $this->get('dv_configuration.services.compensation_report_service');
        $this->view->addTemplateDir(__DIR__ . '/../../Resources/views/');

        $currentAction = $this->Request()->getActionName();
        if ($this->get('session')->get('sUserId') === null && $currentAction === 'index') {
            $this->redirect([
                'module' => 'frontend',
                'controller' => 'account',
                'action' => 'login',
                'sTarget' => 'compensation_report',
                'sTargetAction' => 'index'
            ]);
        }
        $this->view->assign('currentAction', $currentAction);
    }

    public function indexAction()
    {
        $month = $_GET['month'];
        $orders = $this->compensationReportService->findOrdersByUserIdAndCurrentMonth(
            (int)$this->get('session')->get('sUserId'),
            $month
        );
        $total = $this->compensationReportService->getTotalPrice($orders);
        $options = $this->compensationReportService->getOptions();

        $this->view->assign([
            'options' => $options,
            'month' => $month,
            'orders' => $orders,
            'total' => $total
        ]);
    }
}

