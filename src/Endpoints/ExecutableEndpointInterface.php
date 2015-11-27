<?php


namespace Paro\Endpoints;


use Paro\Communicator\Parameters\ParametersInterface;

interface ExecutableEndpointInterface
{
    /**
     * @param ParametersInterface $params = null
     * @return array
     */
    public function execute(ParametersInterface $params = null);
}