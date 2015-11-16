<?php

namespace DixonsCz\Communicator\Adapter\Http;

use DixonsCz\Communicator\Adapter\AdapterInterface;
use DixonsCz\Communicator\Parameters\ParametersInterface;

class HttpAdapter implements AdapterInterface
{
    private $serverLocation;

    public function __construct($serverLocation = null)
    {
        $this->serverLocation = $serverLocation;
    }

    public function request(\DixonsCz\Endpoints\EndpointInterface $endpoint, ParametersInterface $params)
    {
        $uri = $endpoint->getUri();

        /*foreach($params->getArray() as $key => $value) {
            $str = '{' . $key . '}';
            if (strpos($uri, $str)) {
                $uri = str_replace($str, $value, $uri);
            }
        }*/

        $endpointURI = $this->serverLocation;
        $endpointURI = str_replace('#ENDPOINTNAME#', $uri, $endpointURI);
        $endpointURI = str_replace('#PARAMS#', http_build_query($params->getArray()), $endpointURI);


        echo sprintf("request: %s<br>", $endpointURI);

        $response = file_get_contents($endpointURI);
        $responseDecoded = unserialize($response);
        return $responseDecoded;
    }

    public function response($data)
    {
        return serialize($data);
    }
}