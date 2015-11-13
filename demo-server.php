<?php
require __DIR__ . '/vendor/autoload.php';

use DixonsCz\Communicator\Adapter\HttpRest\HttpRestAdapter;
use DixonsCz\Communicator\Server;
use DixonsCz\Endpoints\VirtualStock\CancelOrder\CancelOrder;
use DixonsCz\Endpoints\VirtualStock\CancelOrder\CancelOrderResponse;

$vsServer = new Server(new HttpRestAdapter('http://communicator.dev'));
$vsServer->register(
    new CancelOrder(),
    function($params) {
        //do something clever
        $return = false;
        if (isset($params['name'])) {
            $return = $params['name'] . ' processed on server at ' . time();
        }
        return new CancelOrderResponse($return);
    }
);

echo($vsServer->get('cancelOrder')->process($_GET));
