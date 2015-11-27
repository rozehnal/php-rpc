<?php

namespace Paro\Communicator;

use Paro\Communicator\Adapter\AdapterInterface;
use Paro\Endpoints\EndpointInterface;

class Client
{
    private $adapter;
    private $calls = array();

    public function __construct(AdapterInterface $adapter)
    {
        $this->adapter = $adapter;
    }

    public function register(EndpointInterface $endpoint, $name)
    {
        $this->calls[$name] = $endpoint;
        return $this;
    }

    public function get($name)
    {
        if (array_key_exists($name, $this->calls)) {
            return new OutgoingCallWrapper($this->calls[$name], $this->adapter);
        }else{
            throw new \Exception(sprintf('Endpoint %s not found.', $name));
        }
    }



}