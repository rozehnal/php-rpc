<?php


namespace DixonsCz\Communicator;


use DixonsCz\Communicator\Adapter\AdapterInterface;
use DixonsCz\Communicator\Endpoint\EndpointInterface;

class EndpointWrapper
{
    private $endpoint;
    private $callback;
    /**
     * @var AdapterInterface
     */
    private $adapter;

    public function __construct(EndpointInterface $endpoint, $callback, AdapterInterface $adapter)
    {
        $this->endpoint = $endpoint;
        $this->callback = $callback;
        $this->adapter = $adapter;
    }

    public function process($params) {
        if (!$this->endpoint->validateParameters($params)) {
            throw new \Exception('Not valid parameters!');
        }
        
        $this->endpoint->setParameters($params);
        
        return $this->adapter->response($this->callback($params)->getRawData());
    }


}