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
     * @param $key string
     * @return boolean
     */
    public function isDefined($key);

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