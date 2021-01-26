<?php declare(strict_types=1);

class Shopware_Controllers_Backend_DvCompensationReportBackend extends \Shopware_Controllers_Backend_Application {
    protected $model = \Shopware\Models\Order\Order::class;

    public function listAction() {
        $this->View()->assign(
            $this->getListData(),
        );
    }

    protected function getListData() {
        $compensationReportService = $this->get('dv_compensation_report_backend.services.dv_report_service');
        $data = $compensationReportService->getUserOrdersByCurrentMonth();

        return ['success' => true, 'data' => $data, 'total' => count($data)];
    }
}
