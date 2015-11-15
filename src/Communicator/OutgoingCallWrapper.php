<?php

namespace DixonsCz\Communicator;


use DixonsCz\Communicator\Adapter\AdapterInterface;
use DixonsCz\Communicator\Parameters\ParametersInterface;
use DixonsCz\Endpoints\EndpointInterface;

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
        return $response;
    }

}