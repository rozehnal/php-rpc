<?php

namespace DixonsCz\Communicator;

use DixonsCz\Communicator\Adapter\AdapterInterface;
use DixonsCz\Endpoints\EndpointInterface;

class Server
{

    private $adapter;
    private $endpoints = array();

    public function __construct(AdapterInterface $adapter)
    {
        $this->adapter = $adapter;
    }


    public function register(EndpointInterface $endpoint, $callback)
    {
        $name = $endpoint->getName();

        $this->endpoints[$name] = array('endpoint' => $endpoint, 'callback' => $callback);
        return $this;
    }


    public function get($name)
    {

        if (array_key_exists($name, $this->endpoints)) {
            return new EndpointWrapper($this->endpoints[$name]['endpoint'], $this->endpoints[$name]['callback'], $this->adapter);
        }else{
            throw new \Exception(sprintf('Endpoint %s not found.', $name));
        }
    }


}