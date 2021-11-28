<?php

/**
 * Created with love by: PatryQHyper.pl
 * Date: 28.11.2021 23:22
 * Using: PhpStorm
 */

namespace PatryQHyper\SpaceIs;

use PatryQHyper\SpaceIs\Exceptions\PaymentInitException;

class Payments extends Subpages
{
    public function initPayment(
        string  $serverId,
        string  $productId,
        string  $variantId,
        string  $nick,
        string  $method,
        ?string $email = NULL,
        ?string $smsCode = NULL,
        ?string $discountCodeId = NULL,
        ?string $additionalParameter = NULL
    )
    {
        $response = $this->doRequest('/server/' . $serverId . '/' . $productId . '/' . $variantId . '/payment/init', [
            'form_params' => [
                'nick' => $nick,
                'method' => $method,
                'email' => $email,
                'sms_code' => $smsCode,
                'discount_code_id' => $discountCodeId,
                'additional' => $additionalParameter
            ]
        ], 'POST', false);

        $json = @json_decode($response->getBody());

        if ($json->message != false) throw new PaymentInitException();

        return $json->data;
    }

    public function getTransactionInfo(string $transactionId, string $mode = 'info')
    {
        return $this->doRequest('/transaction/'.$transactionId.'/info/'.($mode == 'extended' ? $mode : ''));
    }
}