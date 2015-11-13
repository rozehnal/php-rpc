<?php

namespace DixonsCz\Endpoints\PeakClimber\Countries;

use DixonsCz\Communicator\Adapter\AdapterInterface;
use DixonsCz\Endpoints\EndpointInterface;


class Countries implements EndpointInterface
{
    private $endpointName = "countries";

    private $params = array();


    public function __construct($endpointname = null)
    {
        if ($endpointname !== null) {
            $this->endpointName = $endpointname;
        }
    }

    /**
     * @param $params
     */
    public function setParameters($params)
    {
        $this->params = $params;
    }

    /**
     * @param $parmas array
     * @return boolean
     */
    public function validateParameters($params = null)
    {

        if ($params === null) {
            $params = $this->params;
        }

        return isset($params['id']);
    }

    /**
     * @param AdapterInterface $adapter
     * @return array
     */
    public function execute(AdapterInterface $adapter)
    {
        $response = $adapter->request($this, $this->params);
        return new CountriesResponse($response);
    }

    /**
     * @return mixed
     */
    public function getEndpointName()
    {
        return $this->endpointName;
    }

    /**
     * @return string
     */
    public function getEndpointUri()
    {
        return "countries/{id}.json";
    }
}