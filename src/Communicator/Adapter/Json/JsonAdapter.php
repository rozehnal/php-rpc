<?php

namespace DixonsCz\Communicator\Adapter\Json;

use DixonsCz\Communicator\Adapter\AdapterInterface;
use DixonsCz\Communicator\Parameters\ParametersInterface;
use DixonsCz\Endpoints\Response;

class JsonAdapter implements AdapterInterface
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
        $responseDecoded = $this->unsrealize($response);
        return $responseDecoded;
    }

    protected function unsrealize($str)
    {
        $data = json_decode($str, true);
        $response = new $data['type']($data['data']);
        return $response;
    }

    public function response($data)
    {
        return $this->serialize($data);
    }

    protected function serialize($response)
    {
        $data = array();
        if ($response instanceof Response) {
            $data['status'] = 'success';
            $data['data'] = $response->getRawData();
            $data['type'] = get_class($response);
        } elseif ($response instanceof \Exception) {
            $data['status'] = 'fail';
            $data['type'] = get_class($response);
            $data['data'] = $response->getMessage();
        } else {
            $data['status'] = 'fail';
            $data['type'] = get_class($response);
            $data['data'] = '';
        }

        return json_encode($data);
    }

}