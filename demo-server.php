<?php
require __DIR__ . '/vendor/autoload.php';

use DixonsCz\Communicator\Adapter\HttpRest\HttpRestAdapter;
use DixonsCz\Communicator\Parameters\NativeParameters;
use DixonsCz\Communicator\Server;
use DixonsCz\Endpoints\VirtualStock\CancelOrder\CancelOrder;
use DixonsCz\Endpoints\VirtualStock\CancelOrder\CancelOrderResponse;

$vsServer = new Server(new HttpRestAdapter('http://communicator.dev'));
$vsServer->register(
    new CancelOrder(),
    function(\DixonsCz\Communicator\Parameters\ParametersInterface $params) {
        //do something clever
        $return = false;
        if ($params->getParameter('name')) {
            $return = $params->getParameter('name') . ' processed on server at ' . time();
        }
        return new CancelOrderResponse($return);
    }
);

echo($vsServer->get('cancelOrder')->process(new NativeParameters($_GET, $_POST)));