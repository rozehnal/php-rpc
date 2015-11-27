<?php


namespace Paro\Endpoints;


interface ResponseInterface
{
    /**
     * @return array assoc
     */
    public function getRawData();
}