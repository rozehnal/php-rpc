<?php

namespace DixonsCz\Endpoints\Boom\CancelOrder;

use DixonsCz\Communicator\Parameters\ParametersInterface;
use DixonsCz\Endpoints\EndpointInterface;


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