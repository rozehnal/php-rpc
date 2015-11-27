<?php

namespace Paro\Endpoints;


use Paro\Communicator\Parameters\ParametersInterface;

interface EndpointInterface
{
    /**
     * @return string
     */
    public function getUri();

    /**
     * @param ParametersInterface $params
     * @return boolean
     */
    public function validateParameters(ParametersInterface $params);

}