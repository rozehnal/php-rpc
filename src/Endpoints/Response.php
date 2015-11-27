<?php


namespace Paro\Endpoints;


class Response implements ResponseInterface
{

    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function getRawData()
    {
        return $this->data;
    }
}