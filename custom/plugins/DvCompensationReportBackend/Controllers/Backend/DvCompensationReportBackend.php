<?php declare(strict_types=1);

class Shopware_Controllers_Backend_DvCompensationReportBackend extends \Shopware_Controllers_Backend_Application {
    protected $model = \Shopware\Models\Order\Order::class;
    protected $alias = 'myorder';

    public function listAction() {
        $this->View()->assign(
            $this->getListData(),
        );
    }

    protected function getListData() {
//        $this->compensationReportService = $this->get('dv_compensation_report_backend.services.compensation_report_service');
        $dateFirst = new \DateTime('midnight first day of this month');
        $dateLast = new \DateTime('midnight last day of this month');

        $data = Shopware()->Container()->get('models')->createQueryBuilder()
            ->select(["CONCAT(u.firstname, ' ', u.lastname) AS name", 'SUM(myorder.invoiceAmount) AS sumInvoice', 'COUNT(myorder.customerId) AS ordersCount'])
            ->from('Shopware\Models\Order\Order', 'myorder')
            ->leftJoin('Shopware\Models\Customer\Customer', 'u', \Doctrine\ORM\Query\Expr\Join::WITH, 'u.id = myorder.customerId')
            ->where("myorder.orderTime BETWEEN :dateFirst AND :dateLast")
            ->setParameters([
                'dateFirst' => $dateFirst,
                'dateLast' => $dateLast
            ])
            ->groupBy('myorder.customerId')
            ->getQuery()
            ->getResult();

        return ['success' => true, 'data' => $data, 'total' => count($data)];
    }
}
