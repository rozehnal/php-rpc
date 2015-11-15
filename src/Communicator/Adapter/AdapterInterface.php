<?php

namespace DixonsCz\Communicator\Adapter;

use DixonsCz\Communicator\Parameters\ParametersInterface;
use DixonsCz\Endpoints\EndpointInterface;

interface AdapterInterface
{
    /**
     * @param EndpointInterface $endpoint
     * @param $params
     * @return mixed
     */
    public function request(EndpointInterface $endpoint, ParametersInterface $params);

    public function response($data);

}