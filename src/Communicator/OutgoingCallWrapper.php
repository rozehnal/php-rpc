<?php

namespace DixonsCz\Communicator;


use DixonsCz\Communicator\Adapter\AdapterInterface;
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


    public function call($params = array())
    {

        if (!$this->endpoint->validateParameters($params)) {
            throw new \Exception('Not valid parameters!');
        }

        $this->endpoint->setParameters($params);

        return $this->endpoint->execute($this->adapter);
    }

}