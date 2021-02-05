<?php declare(strict_types=1);

namespace SwagPaymentExample\Services;

class CheckoutService {

    public function str_to_sign($str): string {
        return base64_encode(sha1($str, true));
    }

    public function setParameters(array $basket, string $publicKey): array {
        if (!empty(Shopware()->Session()->sOrderVariables['sUserData'])) {
            $user = Shopware()->Session()->sOrderVariables['sUserData'];
        }else {
            $user = null;
        }

        $billing = $user['billingaddress'];
        $firstName = $billing['firstname'];
        $lastName = $billing['lastname'];
//        $orderNumber = preg_replace("/[^0-9]/", "", $basket['content'][0]['ordernumber'] );
        $amount = $basket['Amount'];

        return [
            "public_key" => $publicKey,
            "result_url" => "http://test-shopware.com/checkout/confirm",
            "amount" => (string)$amount,
            "version" => '3',
            "action" => 'pay',
            "currency" => "UAH",
            "description" => "Hello, $firstName $lastName. You buying on test-shopware.com",
            "order_id" => mt_rand()
        ];
    }

//    public function finishCardPayment(string $responseData, string $responseSignature, string $publicKey, string $privateKey, $controller) {
//
//    }
}
