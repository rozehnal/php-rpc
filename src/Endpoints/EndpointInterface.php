<?php

namespace DixonsCz\Communicator\Endpoint;


interface EndpointInterface
{

    /**
     * @return mixed
     */
    public function getEndpointName();


    /**
     * @param $array
     */
    public function setParameters($array);

    /**
     * @param $data array
     * @return boolean
     */
    public function validateParameters($data = null);

    /**
     * @return array
     */
    public function execute();

}