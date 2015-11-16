<?php
require __DIR__ . '/vendor/autoload.php';

use DixonsCz\Communicator\Adapter\Http\HttpAdapter;
use DixonsCz\Communicator\Parameters\NativeParameters;
use DixonsCz\Communicator\Server;
use DixonsCz\Endpoints\Boom\CancelOrder\CancelOrder;
use DixonsCz\Endpoints\Boom\CancelOrder\CancelOrderResponse;

$vsServer = new Server(new HttpAdapter());
$vsServer->register(
    new CancelOrder(),
    'cancelorder',
    function(\DixonsCz\Communicator\Parameters\ParametersInterface $params) {
        //do something clever
        $return = false;
        if ($params->isDefined('name')) {
            $return = $params->getParameter('name') . ' processed on server at ' . time();
        }
        return new CancelOrderResponse($return);
    }
);

//echo($vsServer->get('cancelorder')->execute(new NativeParameters($_GET, $_POST)));
echo($vsServer->get($_GET['service'])->execute(new NativeParameters($_GET, $_POST)));