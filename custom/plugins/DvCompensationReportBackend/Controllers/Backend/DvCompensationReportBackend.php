<?php declare(strict_types=1);

class Shopware_Controllers_Backend_DvCompensationReportBackend extends \Shopware_Controllers_Backend_Application {
    protected $model = \Shopware\Models\Order\Order::class;

    /**
     * @var mixed|object|\Symfony\Component\DependencyInjection\Container|null
     */
    private $compensationReportService;

    public function __construct() {
        parent::__construct();
        $this->compensationReportService = Shopware()->Container()->get('dv_compensation_report_backend.services.dv_report_service');
    }


    public function listAction() {
        $this->View()->assign(
            $this->getListData(),
        );
    }

    protected function getListData() {
        $data = $this->compensationReportService->getUserOrdersByCurrentMonth();

        return ['success' => true, 'data' => $data, 'total' => count($data)];
    }

    public function sendNoticeAction() {
        $this->compensationReportService->sendCurlRequest();
    }
}
