<?php
require __DIR__ . '/vendor/autoload.php';

use DixonsCz\Communicator\Adapter\HttpRest\HttpRestAdapter;
use DixonsCz\Communicator\Client;
use DixonsCz\Communicator\Parameters\NativeParameters;
use DixonsCz\Endpoints\PeakClimber\Countries\Countries;
use DixonsCz\Endpoints\VirtualStock\CancelOrder\CancelOrder;

$vsClient = new Client(new HttpRestAdapter('http://communicator.dev'));
$vsClient->register(new CancelOrder('demo-server.php'));

/** @var \DixonsCz\Endpoints\VirtualStock\CancelOrder\CancelOrderResponse $response */
$response = $vsClient->get('demo-server.php')->dispatch(new NativeParameters(array('name'=>'klient')));
var_dump($response->getRawData());



echo "<hr>";



$pkClient = new Client(new HttpRestAdapter('http://peakclimber.com/api'));
$pkClient->register(new Countries());

/** @var \DixonsCz\Endpoints\PeakClimber\Countries\CountriesResponse $response */
$response = $pkClient->get('countries')->dispatch(new NativeParameters(array('id'=>50)));


var_dump($response->getName());
echo "<br />";
var_dump($response->getRawData());