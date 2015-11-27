<?php
require __DIR__ . '/vendor/autoload.php';

use Paro\Communicator\Adapter\Json\JsonAdapter;
use Paro\Communicator\Client;
use Paro\Communicator\Parameters\NativeParameters;


echo "<hr><h3>order</h3>";

$order = new \Paro\Endpoints\Order\Order('http://communicator.dev');
$response = $order->cancelOrder('ordernumberaaa');
var_dump($response, $response->test());


echo "<hr><h3>third party</h3>";
$biolib = new \Paro\Endpoints\Biolib\Biolib();
/** @var $response \Paro\Endpoints\Response */
$response = $biolib->findname('elaphe');
var_dump($response);

echo "<hr>";

$pk = new \Paro\Endpoints\PeakClimber\PeakClimber();
$response = $pk->countries(50);
var_dump($response);


echo "<hr><h3>proxy of thirdparty [over biolib.php]</h3>";

try {

    $biolibClient = new Client(new JsonAdapter('http://communicator.dev' . '/biolib.php?service=#ENDPOINTNAME#&#PARAMS#'));
    $biolibClient->register(new \Paro\Endpoints\Biolib\FindName\FindName(), 'findName');
$response = $biolibClient->get('findName')->dispatch(new NativeParameters(array('name' => 'Python regius', 'auth' => '')));
var_dump($response);

} catch (\Exception $e) {
    var_dump('exception: ' . $e->getMessage());
}


echo "<br />";
//var_dump($response->getRawData());
