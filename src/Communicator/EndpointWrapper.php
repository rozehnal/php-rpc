<?php


namespace DixonsCz\Communicator;


use DixonsCz\Communicator\Adapter\AdapterInterface;
use DixonsCz\Communicator\Parameters\ParametersInterface;
use DixonsCz\Endpoints\EndpointInterface;
use DixonsCz\Endpoints\ExecutableEndpointInterface;

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

        try {
            if (is_null($this->callback)) {
                if ($this->endpoint instanceof ExecutableEndpointInterface) {
                    $response = $this->endpoint->execute($params);
                } else {
                    throw new \Exception(sprintf('Endpoint %s is not executable.', $this->endpoint->getUri()));
                }

            } else {
                $callback = $this->callback;
                $response = $callback($params);
            }
        } catch (\Exception $e) {
            $response = $e;
        }

        if (is_null($this->adapter)) {
            return $response;
        } else {
            return $this->adapter->response($response);
        }

    }


}