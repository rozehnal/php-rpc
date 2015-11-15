<?php


namespace DixonsCz\Endpoints;


interface ResponseInterface
{
    /**
     * @return array assoc
     */
    public function getRawData();
}