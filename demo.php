<?php
require __DIR__ . '/vendor/autoload.php';

$vs = new \DixonsCz\Communicator\Communicator();
$vs->registerOutgoingCall(new DixonsCz\Communicator\Endpoints\VirtualStock\CancelOrder\CancelOrder());
$vs->registerEndpoint(
    new DixonsCz\Communicator\Endpoints\VirtualStock\CancelOrder\CancelOrder(),
    function($params) {
        return new \DixonsCz\Communicator\Endpoints\VirtualStock\Get\CancelOrder\CancelOrderResponse();
    }
);

$vs->getEndpoint('cancelOrder')->process($_GET);


var_dump($vs->getOutgoingCall('cancelOrder')->call(array('parameters'=>'parameters')));