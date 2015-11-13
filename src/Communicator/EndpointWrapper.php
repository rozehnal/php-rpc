<?php


namespace DixonsCz\Communicator;


use DixonsCz\Communicator\Endpoint\EndpointInterface;

class EndpointWrapper
{
    private $endpoint;
    private $callback;

    public function __construct(EndpointInterface $endpoint, $callback)
    {
        $this->endpoint = $endpoint;
        $this->callback = $callback;
    }

    public function process($data) {
        $this->endpoint->setParameters($data);
        $this->endpoint->validateParameters();
        return $this->callback($data);
    }


}