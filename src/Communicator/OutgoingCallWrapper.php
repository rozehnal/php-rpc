<?php

namespace DixonsCz\Communicator;


use DixonsCz\Communicator\Adapter\AdapterInterface;
use DixonsCz\Communicator\Endpoint\EndpointInterface;

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


    public function call($params = array())
    {
        $this->endpoint->setParameters($params);
        $this->endpoint->validateParameters();
        return $this->endpoint->execute($this->adapter);
    }

}