<?php
namespace DixonsCz\Endpoints\PeakClimber;

use DixonsCz\Communicator\Adapter\Http\HttpAdapter;
use DixonsCz\Communicator\Client;
use DixonsCz\Communicator\Parameters\NativeParameters;
use DixonsCz\Endpoints\PeakClimber\Countries\Countries;
use DixonsCz\Endpoints\PeakClimber\Countries\CountriesResponse;

class PeakClimber
{
    /**
     * @var Client
     */
    private $client;

    public function __construct($destinationUrl)
    {
        $this->client = new Client(new HttpAdapter($destinationUrl));
        $this->client->register(new Countries(), 'countries');
    }

    /**
     * @param $id
     * @return CountriesResponse
     * @throws \Exception
     */
    public function countries($id)
    {
        return $this->client->get('countries')->dispatch(new NativeParameters(array('id' => $id)));
    }

}