<?php


namespace DixonsCz\Endpoints;


use DixonsCz\Communicator\Parameters\ParametersInterface;

interface ExecutableEndpointInterface
{
    /**
     * @param ParametersInterface $params = null
     * @return array
     */
    public function execute(ParametersInterface $params = null);
}