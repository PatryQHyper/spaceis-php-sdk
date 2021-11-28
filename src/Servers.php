<?php

/**
 * Created with love by: PatryQHyper.pl
 * Date: 28.11.2021 22:57
 * Using: PhpStorm
 */

namespace PatryQHyper\SpaceIs;

class Servers extends Products
{
    public function getServers()
    {
        return $this->doRequest('/servers');
    }

    public function getServer(string $serverId)
    {
        $response = $this->doRequest('/server/' . $serverId, [], 'GET', true, false);
        if (isset($response->message) && $response->message != false) return null;
        return $response;
    }

    public function getCommands(string $serverId, string $serverToken)
    {
        return $this->doRequest('/server/' . $serverId . '/' . $serverToken . '/commands/get');
    }

    public function getLatestBuys(string $serverId, int $limit = 10)
    {
        return $this->doRequest('/server/' . $serverId . '/latest_buys', ['limit' => $limit]);
    }

    public function getRichest(string $serverId, int $limit = 10)
    {
        return $this->doRequest('/server/' . $serverId . '/richest', ['limit' => $limit]);
    }
}