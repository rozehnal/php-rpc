<?php


namespace DixonsCz\Communicator\Parameters;


interface ParametersInterface
{
    /**
     * @param $key string
     * @return mixed
     */
    public function getParameter($key);

    /**
     * @return array assoc
     */
    public function getArray();


    /**
     * @param string $key
     * @return mixed
     */
    public function getContent($key = null);

}