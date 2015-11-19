<?php
namespace DixonsCz\Endpoints\Boom;

use DixonsCz\Communicator\Adapter\Json\JsonAdapter;
use DixonsCz\Communicator\Client;
use DixonsCz\Communicator\Parameters\NativeParameters;
use DixonsCz\Endpoints\Boom\CancelOrder\CancelOrder;
use DixonsCz\Endpoints\Boom\CancelOrder\CancelOrderResponse;

class Boom
{
    /**
     * @var Client
     */
    private $client;

    public function __construct($destinationUrl)
    {
        $this->client = new Client(new JsonAdapter($destinationUrl . '/boom.php?service=#ENDPOINTNAME#&#PARAMS#'));
        $this->client->register(new CancelOrder(), 'cancelOrder');
    }

    /**
     * @param $orderNumber
     * @return CancelOrderResponse
     * @throws \Exception
     */
    public function cancelOrder($orderNumber)
    {
        return $this->client->get('cancelOrder')->dispatch(new NativeParameters(array('name' => $orderNumber)));
    }

}