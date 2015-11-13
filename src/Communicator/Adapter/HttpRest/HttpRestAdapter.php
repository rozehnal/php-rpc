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

    public function request(\DixonsCz\Endpoints\EndpointInterface $endpoint, $params)
    {
        $uri = $endpoint->getEndpointUri();

        foreach($params as $key => $value) {
            $str = '{' . $key . '}';
            if (strpos($uri, $str)) {
                $uri = str_replace($str, $value, $uri);
            }
        }

        $endpointName = $this->serverLocation . '/' . $uri;

        $response = file_get_contents($endpointName . '?' . http_build_query($params));
        $responseDecoded = json_decode($response, true);
        return $responseDecoded;
    }

    public function response($data)
    {
        return json_encode($data);
    }
}