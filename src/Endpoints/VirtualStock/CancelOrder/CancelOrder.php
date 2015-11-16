<?php

namespace DixonsCz\Endpoints\VirtualStock\CancelOrder;

use DixonsCz\Communicator\Parameters\ParametersInterface;
use DixonsCz\Endpoints\EndpointInterface;


class CancelOrder implements EndpointInterface
{
    private $endpointName = "cancelOrder";


    public function __construct($endpointname = null)
    {
        if ($endpointname !== null) {
            $this->endpointName = $endpointname;
        }
    }

    /**
     * @param ParametersInterface $params
     * @return bool
     */
    public function validateParameters(ParametersInterface $params)
    {
        return $params->isDefined('name');
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->endpointName;
    }

    /**
     * @return string
     */
    public function getUri()
    {
        return $this->endpointName;
    }
}