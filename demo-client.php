<?php
require __DIR__ . '/vendor/autoload.php';

use DixonsCz\Communicator\Adapter\Http\HttpAdapter;
use DixonsCz\Communicator\Client;
use DixonsCz\Communicator\Parameters\NativeParameters;
use DixonsCz\Communicator\Server;
use DixonsCz\Endpoints\PeakClimber\Countries\Countries;
use DixonsCz\Endpoints\VirtualStock\CancelOrder\CancelOrder;


$vsClient = new Client(new HttpAdapter('http://communicator.dev'));
$vsClient->register(new CancelOrder('demo-server.php'));

/** @var \DixonsCz\Endpoints\VirtualStock\CancelOrder\CancelOrderResponse $response */
$response = $vsClient->get('demo-server.php')->dispatch(new NativeParameters(array('name' => 'this request has been')));
var_dump($response);
echo "<br />";
var_dump($response->getRawData(), $response->test());



echo "<hr>";


$pkClient = new Server();
$pkClient->register(new Countries(), null, "customname");

/** @var \DixonsCz\Endpoints\PeakClimber\Countries\CountriesResponse $response */
$response = $pkClient->get('customname')->execute(new NativeParameters(array('id' => 50)));

var_dump($response->getName());
echo "<br />";
var_dump($response->getRawData());


echo "<hr>";

$biolibServer = new Server();
$biolibServer->register(new \DixonsCz\Endpoints\Biolib\FindName());
$response = $biolibServer->get('findName')->execute(new NativeParameters(array('name' => 'elaphe guttata', 'auth' => '')));
var_dump($response instanceof \DixonsCz\Endpoints\Response);
echo "<br />";
var_dump($response->getRawData());

echo "<hr>";

$biolibClient = new Client(new HttpAdapter('http://communicator.dev'));
$biolibClient->register(new \DixonsCz\Endpoints\Biolib\FindName());
$response = $biolibClient->get('findName')->dispatch(new NativeParameters(array('name' => 'Python regius', 'auth' => '')));
var_dump($response);
echo "<br />";
var_dump($response->getRawData());