<?php

namespace DixonsCz\Endpoints\VirtualStock\CancelOrder;

use DixonsCz\Communicator\Adapter\AdapterInterface;
use DixonsCz\Communicator\Parameters\ParametersInterface;
use DixonsCz\Endpoints\EndpointInterface;


class CancelOrder implements EndpointInterface
{
    private $endpointName = "cancelOrder";

    /**
     * @var ParametersInterface
     */
    private $params;


    public function __construct($endpointname = null)
    {
        if ($endpointname !== null) {
            $this->endpointName = $endpointname;
        }
    }

    /**
     * @param $params
     */
    public function setParameters(ParametersInterface $params)
    {
        $this->params = $params;
    }

    /**
     * @param $parmas array
     * @return boolean
     */
    public function validateParameters(ParametersInterface $params = null)
    {
        if ($params === null) {
            $params = $this->params;
        }

        return $params->getParameter('name') != '';
    }

    /**
     * @param AdapterInterface $adapter
     * @return array
     */
    public function execute(AdapterInterface $adapter)
    {
        $response = $adapter->request($this, $this->params);
        return new CancelOrderResponse($response);
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