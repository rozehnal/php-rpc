<?php
require __DIR__ . '/vendor/autoload.php';

use DixonsCz\Communicator\Adapter\Json\JsonAdapter;
use DixonsCz\Communicator\Parameters\NativeParameters;
use DixonsCz\Communicator\Server;

$vsServer = new Server(new JsonAdapter());
$vsServer->register(
    new \DixonsCz\Endpoints\Biolib\FindName(),
    'findname',
    function (\DixonsCz\Communicator\Parameters\ParametersInterface $params) {
        throw new Exception('error on the server');
        return new \DixonsCz\Endpoints\Response('aaaa');
    }
);

//echo($vsServer->get('cancelorder')->execute(new NativeParameters($_GET, $_POST)));
echo($vsServer->get($_GET['service'])->execute(new NativeParameters($_GET, $_POST)));