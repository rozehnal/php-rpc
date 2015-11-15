<?php

namespace DixonsCz\Endpoints;


use DixonsCz\Communicator\Parameters\ParametersInterface;

interface EndpointInterface
{

    /**
     * @return string
     */
    public function getName();

    /**
     * @return string
     */
    public function getUri();

    /**
     * @param ParametersInterface $params
     * @return boolean
     */
    public function validateParameters(ParametersInterface $params);

    /**
     * @param ParametersInterface $params = null
     * @return array
     */
    public function execute(ParametersInterface $params = null);

}