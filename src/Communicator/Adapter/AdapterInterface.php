<?php

namespace DixonsCz\Communicator\Adapter;

interface AdapterInterface
{
    /**
     * @param \DixonsCz\Communicator\Endpoint\EndpointInterface $endpoint
     * @param $params
     * @return mixed
     */
    public function request(\DixonsCz\Communicator\Endpoint\EndpointInterface $endpoint, $params);

    public function response($data);

}