<?php
require __DIR__ . '/vendor/autoload.php';

use Paro\Communicator\Adapter\Json\JsonAdapter;
use Paro\Communicator\Parameters\NativeParameters;
use Paro\Communicator\Server;
use Paro\Endpoints\Order\CancelOrder\CancelOrder;
use Paro\Endpoints\Order\CancelOrder\CancelOrderResponse;

$vsServer = new Server(new JsonAdapter());
$vsServer->register(
    new CancelOrder(),
    'cancelorder',
    function (\Paro\Communicator\Parameters\ParametersInterface $params) {
        //do something clever
        $return = false;
        if ($params->isDefined('name')) {
            $return = $params->getParameter('name') . ' processed on server at ' . time();
        }
        return new CancelOrderResponse($return);
    }
);

echo($vsServer->get($_GET['service'])->execute(new NativeParameters($_GET, $_POST)));