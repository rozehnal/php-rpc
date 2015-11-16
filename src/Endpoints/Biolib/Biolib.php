<?php
namespace DixonsCz\Endpoints\Biolib;

use DixonsCz\Communicator\Parameters\NativeParameters;
use DixonsCz\Communicator\Server;
use DixonsCz\Endpoints\Response;

class Biolib
{
    /**
     * @var Server
     */
    private $server;

    public function __construct()
    {
        $this->server = new Server();
        $this->server->register(new FindName(), 'findname');
    }

    /**
     * @param $name
     * @param string $auth
     * @return Response
     * @throws \Exception
     */
    public function findname($name, $auth = '')
    {
        return $this->server->get('findname')->execute(new NativeParameters(array('name' => $name, 'auth' => $auth)));
    }

}