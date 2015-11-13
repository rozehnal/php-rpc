<?php

namespace DixonsCz\Communicator;

use DixonsCz\Communicator\Endpoint\EndpointInterface;

class Server
{

    private $adapter = null;
    private $endpoints = array();

    public function __construct($adapter = null)
    {
        $this->adapter = $adapter;
    }


    public function register(EndpointInterface $endpoint, $callback, $name = null)
    {
        if ($name === null) {
            $name = $endpoint->getEndpointName();
        }
        $this->endpoints[$name] = array('endpoint' => $endpoint, 'callback' => $callback);

        return this;
    }


    public function get($name)
    {
        if (array_key_exists($name, $this->endpoints)) {
            return new EndpointWrapper($this->endpoints[$name]['endpoint'], $this->endpoints[$name]['callback'], $this->adapter);
        }else{
            throw new \Exception('Endpoint ' . $name . ' not found.');
        }
    }


}