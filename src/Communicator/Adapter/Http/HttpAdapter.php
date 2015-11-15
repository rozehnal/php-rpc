<?php

namespace DixonsCz\Communicator\Adapter\Http;

use DixonsCz\Communicator\Adapter\AdapterInterface;
use DixonsCz\Communicator\Parameters\ParametersInterface;

class HttpAdapter implements AdapterInterface
{
    private $serverLocation;

    public function __construct($serverLocation)
    {
        $this->serverLocation = $serverLocation;
    }

    public function request(\DixonsCz\Endpoints\EndpointInterface $endpoint, ParametersInterface $params)
    {
        $uri = $endpoint->getUri();

        foreach($params->getArray() as $key => $value) {
            $str = '{' . $key . '}';
            if (strpos($uri, $str)) {
                $uri = str_replace($str, $value, $uri);
            }
        }

        $endpointName = $this->serverLocation . '/' . $uri;

        echo sprintf("request: %s<br>",  $endpointName . '?' . http_build_query($params->getArray()));

        $response = file_get_contents($endpointName . '?' . http_build_query($params->getArray()));
        $responseDecoded = unserialize($response);
        return $responseDecoded;
    }

    public function response($data)
    {
        return serialize($data);
    }
}