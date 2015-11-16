<?php
namespace DixonsCz\Endpoints\Biolib;

use DixonsCz\Communicator\Adapter\Http\HttpAdapter;
use DixonsCz\Communicator\Client;
use DixonsCz\Communicator\Parameters\NativeParameters;
use DixonsCz\Endpoints\Response;

class Biolib
{
    /**
     * @var Client
     */
    private $client;

    public function __construct($destinationUrl)
    {
        $this->client = new Client(new HttpAdapter($destinationUrl));
        $this->client->register(new FindName(), 'findname');
    }

    /**
     * @param $name
     * @param string $auth
     * @return Response
     * @throws \Exception
     */
    public function findname($name, $auth = '')
    {
        return $this->client->get('findname')->dispatch(new NativeParameters(array('name' => $name, 'auth' => $auth)));
    }

}