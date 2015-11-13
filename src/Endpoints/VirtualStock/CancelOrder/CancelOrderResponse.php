<?php

namespace DixonsCz\Endpoints\VirtualStock\CancelOrder;


class CancelOrderResponse
{
    private $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function getRawData()
    {
        return $this->data;
    }
}