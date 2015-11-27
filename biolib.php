<?php
require __DIR__ . '/vendor/autoload.php';

use Paro\Communicator\Adapter\Json\JsonAdapter;
use Paro\Communicator\Parameters\NativeParameters;
use Paro\Communicator\Server;

$vsServer = new Server(new JsonAdapter());
$vsServer->register(
    new \Paro\Endpoints\Biolib\FindName\FindName(),
    'findname',
    function (\Paro\Communicator\Parameters\ParametersInterface $params) {
        throw new Exception('error on the server');
        return new \Paro\Endpoints\Response('aaaa');
    }
);

//echo($vsServer->get('cancelorder')->execute(new NativeParameters($_GET, $_POST)));
echo($vsServer->get($_GET['service'])->execute(new NativeParameters($_GET, $_POST)));