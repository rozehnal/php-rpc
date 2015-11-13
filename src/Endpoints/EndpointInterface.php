<?php

namespace DixonsCz\Endpoints;


use DixonsCz\Communicator\Adapter\AdapterInterface;

interface EndpointInterface
{

    /**
     * @return string
     */
    public function getEndpointName();

    /**
     * @return string
     */
    public function getEndpointUri();


    /**
     * @param $params
     */
    public function setParameters($params);

    /**
     * @param $params array
     * @return boolean
     */
    public function validateParameters($params = null);

    /**
     * @param AdapterInterface $adapter
     * @return array
     */
    public function execute(AdapterInterface $adapter);

}