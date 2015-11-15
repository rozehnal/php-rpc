<?php


namespace DixonsCz\Communicator\Parameters;

class NativeParameters implements ParametersInterface{
    /**
     * @var array
     */
    private $parameters;

    /**
     * @var array
     */
    private $data;

    public function __construct($parameters = array(), $data = array())
    {

        $this->parameters = $parameters;
        $this->data = $data;
    }


    /**
     * Expected parameters
     *
     * @param $key string
     * @return mixed
     */
    public function getParameter($key)
    {
        return $this->parameters[$key];
    }



    /**
     * Any user data (accessible as array)
     *
     * @param $key string
     * @return array|mixed
     */
    public function getContent($key = null)
    {
        if (is_null($key)){
            return $this->data;
        }else{
            return $this->data[$key];
        }

    }

    /**
     * @return array assoc
     */
    public function getArray()
    {
        return $this->parameters;
    }

    /**
     * @param $key string
     * @return boolean
     */
    public function isDefined($key)
    {
        return array_key_exists($key, $this->parameters);
    }
}