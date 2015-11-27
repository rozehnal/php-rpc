<?php

namespace Paro\Communicator\Adapter;

use Paro\Communicator\Parameters\ParametersInterface;
use Paro\Endpoints\EndpointInterface;

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