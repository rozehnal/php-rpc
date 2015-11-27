<?php
namespace Paro\Endpoints\Biolib;

use Paro\Communicator\Parameters\NativeParameters;
use Paro\Communicator\Server;
use Paro\Endpoints\Biolib\FindName\FindName;
use Paro\Endpoints\Response;

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