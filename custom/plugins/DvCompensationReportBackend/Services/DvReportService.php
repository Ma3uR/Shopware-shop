<?php declare(strict_types=1);

namespace DvCompensationReportBackend\Services;

class DvReportService {

    public function getUserOrdersByCurrentMonth(): array {
        $dateFirst = new \DateTime('midnight first day of this month');
        $dateLast = new \DateTime('midnight last day of this month');

        return Shopware()->Container()->get('models')->createQueryBuilder()
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
    }
}
