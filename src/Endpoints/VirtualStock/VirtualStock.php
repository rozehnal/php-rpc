<?php
namespace DixonsCz\Endpoints\VirtualStock;

use DixonsCz\Communicator\Adapter\Http\HttpAdapter;
use DixonsCz\Communicator\Client;
use DixonsCz\Communicator\Parameters\NativeParameters;
use DixonsCz\Endpoints\VirtualStock\CancelOrder\CancelOrder;
use DixonsCz\Endpoints\VirtualStock\CancelOrder\CancelOrderResponse;

class VirtualStock
{
    /**
     * @var Client
     */
    private $client;

    public function __construct($destinationUrl)
    {
        $this->client = new Client(new HttpAdapter($destinationUrl));
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