<?php
require __DIR__ . '/vendor/autoload.php';

use DixonsCz\Communicator\Adapter\Http\HttpAdapter;
use DixonsCz\Communicator\Client;
use DixonsCz\Communicator\Parameters\NativeParameters;


echo "<hr><h3>boom</h3>";

$boom = new \DixonsCz\Endpoints\Boom\Boom('http://communicator.dev');
$response = $boom->cancelOrder('ordernumberaaa');
var_dump($response, $response->test());


echo "<hr><h3>third party</h3>";
$biolib = new \DixonsCz\Endpoints\Biolib\Biolib();
$response = $biolib->findname('elaphe');
var_dump($response);

echo "<hr>";

$pk = new \DixonsCz\Endpoints\PeakClimber\PeakClimber();
$response = $pk->countries(50);
var_dump($response);


echo "<hr><h3>proxy of thirdparty [over biolib.php]</h3>";

$biolibClient = new Client(new HttpAdapter('http://communicator.dev' . '/biolib.php?service=#ENDPOINTNAME#&#PARAMS#'));
$biolibClient->register(new \DixonsCz\Endpoints\Biolib\FindName(), 'findName');
$response = $biolibClient->get('findName')->dispatch(new NativeParameters(array('name' => 'Python regius', 'auth' => '')));
var_dump($response);
echo "<br />";
//var_dump($response->getRawData());
