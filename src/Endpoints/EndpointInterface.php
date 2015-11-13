<?php

namespace DixonsCz\Communicator\Endpoint;


use DixonsCz\Communicator\Adapter\AdapterInterface;

interface EndpointInterface
{

    /**
     * @return mixed
     */
    public function getEndpointName();


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