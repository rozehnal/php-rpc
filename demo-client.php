<?php
require __DIR__ . '/vendor/autoload.php';

use DixonsCz\Communicator\Client;
use DixonsCz\Communicator\Endpoints\VirtualStock\CancelOrder\CancelOrder;

$vsClient = new Client(new \DixonsCz\Communicator\Adapter\HttpRest\HttpRestAdapter('http://localhost'));
$vsClient->register(new CancelOrder());


var_dump($vsClient->get('cancelOrder')->call(array('parameters'=>'parameters')));