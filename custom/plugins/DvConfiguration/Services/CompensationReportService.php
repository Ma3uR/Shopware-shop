<?php declare(strict_types=1);

namespace DvConfiguration\Services;

class CompensationReportService
{
    public function findOrdersByUserIdAndCurrentMonth(int $userId, ?string $month): array
    {
        $queryBuilder = shopware()->Container()->get('dbal_connection')->createQueryBuilder(); //TODO: Refactor query builder with entities, not sql tables
        $queryBuilder->select('s_order.ordernumber')
            ->addSelect('s_order.ordertime')
            ->addSelect('s_order.invoice_amount')
            ->addSelect('s_order.status')
            ->from('s_order');

        if ($month == 0) {
            $queryBuilder->where("s_order.ordertime BETWEEN DATE_FORMAT(NOW(), '%Y-%m-01') AND NOW()");
        }else {
            $queryBuilder->where("s_order.ordertime BETWEEN DATE_FORMAT(NOW(), '%Y-$month-01') AND DATE_FORMAT(NOW(), '%Y-$month-31')");
        }
        $queryBuilder->andWhere('userID = :userId')
            ->setParameters([
                'userId' => $userId,
            ]);

        return $queryBuilder->execute()->fetchAll();
    }

    public function getTotalPrice(array $orders): ?float
    {
        $sumArray = array();

        foreach ($orders as $k=>$subArray) {
            if ($subArray['status'] == '2') {
                foreach ($subArray as $id=>$value) {
                    $sumArray[$id]+=$value;
                }
            }
        }
        return $sumArray['invoice_amount'];
    }

    public function getOptions(): array {
        return [
             '0' => 'Month',
             '01' => 'Jan',
             '02' => 'Feb',
             '03' => 'Mar',
             '04' => 'Apr',
             '05' => 'May',
             '06' => 'Jun',
             '07' => 'Jul',
             '08' => 'Aug',
             '09' => 'Sep',
             '10' => 'Oct',
             '11' => 'Nov',
             '12' => 'Dec'
        ];

    }
}
