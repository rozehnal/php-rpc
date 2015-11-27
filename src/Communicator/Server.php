<?php

namespace Paro\Communicator;

use Paro\Communicator\Adapter\AdapterInterface;
use Paro\Endpoints\EndpointInterface;

class Server
{

    private $adapter;
    private $endpoints = array();

    public function __construct(AdapterInterface $adapter = null)
    {
        $this->adapter = $adapter;
    }


    public function register(EndpointInterface $endpoint, $name, $callback = null)
    {
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