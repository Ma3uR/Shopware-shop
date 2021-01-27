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

    public function sendCurlRequest() {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://hooks.slack.com/services/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');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "{\"text\":\"The daily menu has been loaded. Bon Appetit! Please visit http://test-shopware.com/\"}");

        $headers = array();
        $headers[] = 'Content-Type: application/json';
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch);
    }
}
