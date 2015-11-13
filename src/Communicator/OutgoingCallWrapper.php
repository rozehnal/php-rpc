<?php

namespace DixonsCz\Communicator;


class OutgoingCallWrapper
{
    private $endpoint;

    public function __construct(EndpointInterface $endpoint)
    {
        $this->endpoint = $endpoint;
    }


    public function call($params = array())
    {
        //TODO: dispatch request
    }

}