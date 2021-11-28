<?php

/**
 * Created with love by: PatryQHyper.pl
 * Date: 28.11.2021 23:43
 * Using: PhpStorm
 */

namespace PatryQHyper\SpaceIs;

use PatryQHyper\SpaceIs\Exceptions\VoucherNotFoundException;
use PatryQHyper\SpaceIs\Exceptions\VoucherUsedException;

class Vouchers extends User
{
    public function voucherRedeem(string $nick, string $voucherCode)
    {
        $response = $this->doRequest('/voucher', [
            'form_params' => [
                'nick' => $nick,
                'code' => $voucherCode
            ]
        ], 'POST', false, false);

        switch ($response->getStatusCode()) {
            case 404:
                throw new VoucherNotFoundException();
                break;
            case 403:
                throw new VoucherUsedException();
                break;
        }

        return true;
    }
}