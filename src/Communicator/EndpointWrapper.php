<?php


namespace DixonsCz\Communicator;


use DixonsCz\Communicator\Endpoint\EndpointInterface;

class EndpointWrapper
{
    private $endpoint;

    public function __construct(EndpointInterface $endpoint)
    {
        $this->endpoint = $endpoint;
    }

    public function process($data) {
        $this->endpoint->setParameters($data);
        $this->endpoint->validateParameters();
        $this->endpoint->execute();
    }


}