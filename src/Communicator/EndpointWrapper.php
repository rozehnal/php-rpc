<?php


namespace DixonsCz\Communicator;


use DixonsCz\Communicator\Adapter\AdapterInterface;
use DixonsCz\Communicator\Parameters\ParametersInterface;
use DixonsCz\Endpoints\EndpointInterface;

class EndpointWrapper
{
    private $endpoint;
    /**
     * @var callable
     */
    private $callback;
    /**
     * @var AdapterInterface
     */
    private $adapter;

    public function __construct(EndpointInterface $endpoint, $callback = null, AdapterInterface $adapter = null)
    {

        $this->endpoint = $endpoint;
        $this->callback = $callback;
        $this->adapter = $adapter;
    }

    public function execute(ParametersInterface $params)
    {
        if (!$this->endpoint->validateParameters($params)) {
            throw new \Exception('Not valid parameters!');
        }

        //$this->endpoint->setParameters($params);

        if (is_null($this->callback)) {
            $response = $this->endpoint->execute($params);
        } else {
            $callback = $this->callback;
            $response = $callback($params);
        }

        if (is_null($this->adapter)) {
            return $response;
        } else {
            return $this->adapter->response($response);
        }

    }


}