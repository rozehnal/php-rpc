<?php

namespace DixonsCz\Communicator\Adapter\HttpRest;

use DixonsCz\Communicator\Adapter\AdapterInterface;

class HttpRestAdapter implements AdapterInterface
{
    private $serverLocation;

    public function __construct($serverLocation)
    {
        $this->serverLocation = $serverLocation;
    }

    public function request(\DixonsCz\Communicator\Endpoint\EndpointInterface $endpoint, $params)
    {
        $endpointName = $this->serverLocation . '/' . $endpoint->getEndpointName();
        var_dump($endpointName);

        $response = http_get($endpointName, array("timeout"=>1), $info);
        $responseArray = json_decode($response);
        return $responseArray;
    }

    public function response($data)
    {
        return json_encode($data);
    }
}