<?php

namespace Paro\Endpoints\Order\CancelOrder;

use Paro\Communicator\Parameters\ParametersInterface;
use Paro\Endpoints\EndpointInterface;


class CancelOrder implements EndpointInterface
{

    /**
     * @param ParametersInterface $params
     * @return bool
     */
    public function validateParameters(ParametersInterface $params)
    {
        return $params->isDefined('name');
    }

    /**
     * @return string
     */
    public function getUri()
    {
        return 'cancelorder';
    }
}