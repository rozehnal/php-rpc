<?php
require __DIR__ . '/vendor/autoload.php';

$vs = new \DixonsCz\Communicator\Communicator();
$vs->registerOutgoingCall(new DixonsCz\Communicator\Endpoints\VirtualStock\Get\CancelOrder\CancelOrder());
$vs->registerEndpoint(
    new DixonsCz\Communicator\Endpoints\VirtualStock\Get\CancelOrder\CancelOrder(),
    function(\DixonsCz\Communicator\Endpoints\VirtualStock\Get\CancelOrder\CancelOrderResponse $response) { var_dump($response);}
);

$vs->getOutgoingCall('cancelOrder')->get(array('parameters'=>'parameters'));
$vs->getEndpoint('cancelOrder')->process($_GET);