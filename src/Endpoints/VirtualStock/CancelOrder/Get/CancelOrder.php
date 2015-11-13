<?php

namespace DixonsCz\Communicator\Endpoints\VirtualStock\Get\CancelOrder;
use DixonsCz\Communicator\Endpoint\EndpointInterface;

class CancelOrder implements EndpointInterface
{

    /**
     * @param $array
     */
    public function setParameters($array)
    {
        // TODO: Implement setParameters() method.
    }

    /**
     * @param $data array
     * @return boolean
     */
    public function validateParameters($data = null)
    {
        // TODO: Implement validateParameters() method.
        return true;
    }

    /**
     * @return array
     */
    public function execute()
    {
        //TODO: do HTTP request to VS
        return new CancelOrderResponse(array('response'=>'response'));
    }

    /**
     * @return mixed
     */
    public function getEndpointName()
    {
        return "cancelOrder";
    }
}