<?php
require __DIR__ . '/vendor/autoload.php';

use DixonsCz\Communicator\Adapter\Http\HttpAdapter;
use DixonsCz\Communicator\Parameters\NativeParameters;
use DixonsCz\Communicator\Server;

$vsServer = new Server(new HttpAdapter('http://communicator.dev'));
$vsServer->register(
    new \DixonsCz\Endpoints\Biolib\FindName()
);

echo($vsServer->get('findName')->execute(new NativeParameters($_GET, $_POST)));