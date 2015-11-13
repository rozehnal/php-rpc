<?php

namespace DixonsCz\Communicator;

use DixonsCz\Communicator\Endpoint\EndpointInterface;

class Communicator
{

    private $adapter = null;
    private $endpoints = array();
    private $calls = array();

    public function __construct($adapter = null)
    {
        $this->adapter = $adapter;
    }

    public function registerOutgoingCall(EndpointInterface $endpoint, $name = null)
    {
        if ($name === null) {
            $name = $endpoint->getEndpointName();
        }
        $this->calls[$name] = $endpoint;
    }

    public function getOutgoingCall($name)
    {
        if (array_key_exists($name, $this->calls)) {
            return new OutgoingCallWrapper($this->endpoints[$name]);
        }else{
            throw new \Exception('Endpoint ' . $name . ' not found.');
        }
    }



    public function registerEndpoint(EndpointInterface $endpoint, $callback, $name = null)
    {
        if ($name === null) {
            $name = $endpoint->getEndpointName();
        }
        $this->endpoints[$name] = array('endpoint' => $endpoint, 'callback' => $callback);

        return this;
    }


    public function getEndpoint($name)
    {
        if (array_key_exists($name, $this->endpoints)) {
            return new EndpointWrapper($this->endpoints[$name]['endpoint'], $this->endpoints[$name]['callback']);
        }else{
            throw new \Exception('Endpoint ' . $name . ' not found.');
        }
    }


}