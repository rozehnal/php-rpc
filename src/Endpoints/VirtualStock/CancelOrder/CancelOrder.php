<?php

namespace DixonsCz\Communicator\Endpoints\VirtualStock\CancelOrder;
use DixonsCz\Communicator\Adapter\AdapterInterface;
use DixonsCz\Communicator\Endpoint\EndpointInterface;
use DixonsCz\Communicator\Endpoints\VirtualStock\Get\CancelOrder\CancelOrderResponse;

class CancelOrder implements EndpointInterface
{

    var $params = array();


    public function __construct()
    {

    }

    /**
     * @param $params
     */
    public function setParameters($params)
    {
        $this->params = $params;
    }

    /**
     * @param $parmas array
     * @return boolean
     */
    public function validateParameters($params = null)
    {
        // TODO: Implement validateParameters() method.
        return true;
    }

    /**
     * @param AdapterInterface $adapter
     * @return array
     */
    public function execute(AdapterInterface $adapter)
    {
        //TODO: do HTTP request to VS
        $response = $adapter->request($this, $this->params);
        return new CancelOrderResponse($response);
    }

    /**
     * @return mixed
     */
    public function getEndpointName()
    {
        return "cancelOrder";
    }
}