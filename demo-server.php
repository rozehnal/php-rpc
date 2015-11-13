<?php
require __DIR__ . '/vendor/autoload.php';

use DixonsCz\Communicator\Server;
use DixonsCz\Communicator\Endpoints\VirtualStock\CancelOrder\CancelOrder;
use DixonsCz\Communicator\Endpoints\VirtualStock\CancelOrder\CancelOrderResponse;

$vsServer = new Server();
$vsServer->register(
    new CancelOrder(),
    function($params) {
        //do something clever
        return new CancelOrderResponse($params);
    }
);

$vsServer->get('cancelOrder')->process($_GET);
