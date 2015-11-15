<?php

namespace DixonsCz\Endpoints;


use DixonsCz\Communicator\Adapter\AdapterInterface;
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
     * @param $params
     */
    public function setParameters(ParametersInterface $params);

    /**
     * @param $params array
     * @return boolean
     */
    public function validateParameters(ParametersInterface $params = null);

    /**
     * @param AdapterInterface $adapter
     * @return array
     */
    public function execute(AdapterInterface $adapter);

}