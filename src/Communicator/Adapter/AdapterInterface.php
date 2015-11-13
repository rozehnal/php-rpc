<?php

namespace DixonsCz\Communicator\Adapter;

use DixonsCz\Endpoints\EndpointInterface;

interface AdapterInterface
{
    /**
     * @param EndpointInterface $endpoint
     * @param $params
     * @return mixed
     */
    public function request(EndpointInterface $endpoint, $params);

    public function response($data);

}