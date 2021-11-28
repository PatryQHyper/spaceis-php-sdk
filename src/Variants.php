<?php

/**
 * Created with love by: PatryQHyper.pl
 * Date: 28.11.2021 22:57
 * Using: PhpStorm
 */

namespace PatryQHyper\SpaceIs;

class Variants extends Payments
{
    public function getVariants(string $serverId, string $productId)
    {
        $response = $this->doRequest('/server/' . $serverId . '/' . $productId, [], 'GET', true, false);
        if (isset($response->message) && $response->message != false) return null;
        return $response;
    }
}