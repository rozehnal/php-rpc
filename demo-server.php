<?php
require __DIR__ . '/vendor/autoload.php';

use DixonsCz\Communicator\Adapter\Http\HttpAdapter;
use DixonsCz\Communicator\Parameters\NativeParameters;
use DixonsCz\Communicator\Server;
use DixonsCz\Endpoints\VirtualStock\CancelOrder\CancelOrder;
use DixonsCz\Endpoints\VirtualStock\CancelOrder\CancelOrderResponse;

$vsServer = new Server(new HttpAdapter('http://communicator.dev'));
$vsServer->register(
    new CancelOrder(),
    function(\DixonsCz\Communicator\Parameters\ParametersInterface $params) {
        //do something clever
        $return = false;
        if ($params->isDefined('name')) {
            $return = $params->getParameter('name') . ' processed on server at ' . time();
        }
        return new CancelOrderResponse($return);
    }
);

echo($vsServer->get('cancelOrder')->execute(new NativeParameters($_GET, $_POST)));