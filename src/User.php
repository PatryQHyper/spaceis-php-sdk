<?php

/**
 * Created with love by: PatryQHyper.pl
 * Date: 28.11.2021 23:51
 * Using: PhpStorm
 */

namespace PatryQHyper\SpaceIs;

class User
{
    public function me()
    {
        return $this->doRequest('/me');
    }
}