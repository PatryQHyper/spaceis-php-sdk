<?php

/**
 * Created with love by: PatryQHyper.pl
 * Date: 28.11.2021 23:38
 * Using: PhpStorm
 */

namespace PatryQHyper\SpaceIs;

class Subpages extends DiscountCodes
{
    public function getSubpage(string $subpageSlug)
    {
        return $this->doRequest('/subpage/' . $subpageSlug);
    }
}