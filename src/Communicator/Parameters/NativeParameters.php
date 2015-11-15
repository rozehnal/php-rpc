<?php


namespace DixonsCz\Communicator\Parameters;

class NativeParameters implements ParametersInterface{
    /**
     * @var array
     */
    private $get;
    /**
     * @var array
     */
    private $post;

    public function __construct($get = array(), $post = array())
    {

        $this->get = $get;
        $this->post = $post;
    }


    /**
     * Expected parameters
     *
     * @param $key string
     * @return mixed
     */
    public function getParameter($key)
    {
        return $this->get[$key];
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
            return $this->post;
        }else{
            return $this->post[$key];
        }

    }

    /**
     * @return array assoc
     */
    public function getArray()
    {
        return $this->get;
    }
}