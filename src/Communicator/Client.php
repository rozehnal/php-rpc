<?php

namespace DixonsCz\Communicator;

use DixonsCz\Communicator\Adapter\HttpRest\HttpRestAdapter;
use DixonsCz\Communicator\Endpoint\EndpointInterface;

class Client
{
    private $adapter = null;
    private $calls = array();

    public function __construct($adapter = null)
    {
        $this->adapter = $adapter;
    }

    public function register(EndpointInterface $endpoint, $name = null)
    {
        if ($name === null) {
            $name = $endpoint->getEndpointName();
        }
        $this->calls[$name] = $endpoint;
    }

    public function get($name)
    {
        if (array_key_exists($name, $this->calls)) {
            return new OutgoingCallWrapper($this->calls[$name], $this->adapter);
        }else{
            throw new \Exception('Endpoint ' . $name . ' not found.');
        }
    }



}