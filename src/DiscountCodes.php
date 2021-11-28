<?php

/**
 * Created with love by: PatryQHyper.pl
 * Date: 28.11.2021 23:40
 * Using: PhpStorm
 */

namespace PatryQHyper\SpaceIs;

class DiscountCodes extends Vouchers
{
    public function getDiscountCode(string $discountCode)
    {
        return $this->doRequest('/discount_code/' . $discountCode);
    }
}