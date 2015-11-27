<?php

namespace Paro\Communicator;


use Paro\Communicator\Adapter\AdapterInterface;
use Paro\Communicator\Parameters\ParametersInterface;
use Paro\Endpoints\EndpointInterface;

class OutgoingCallWrapper
{

    /**
     * @var EndpointInterface
     */
    private $endpoint;

    /**
     * @var AdapterInterface
     */
    private $adapter;

    public function __construct(EndpointInterface $endpoint, AdapterInterface $adapter)
    {
        $this->endpoint = $endpoint;
        $this->adapter = $adapter;
    }


    public function dispatch(ParametersInterface $params)
    {

        if (!$this->endpoint->validateParameters($params)) {
            throw new \Exception('Not valid parameters!');
        }

        $response = $this->adapter->request($this->endpoint, $params);
        if ($response instanceof \Exception) {
            throw $response;
        }
        return $response;
    }

}