<?php
namespace DixonsCz\Endpoints\PeakClimber;

use DixonsCz\Communicator\Parameters\NativeParameters;
use DixonsCz\Communicator\Server;
use DixonsCz\Endpoints\PeakClimber\Countries\Countries;
use DixonsCz\Endpoints\PeakClimber\Countries\CountriesResponse;

class PeakClimber
{
    /**
     * @var Server
     */
    private $server;

    public function __construct()
    {
        $this->server = new Server();
        $this->server->register(new Countries(), 'countries');
    }

    /**
     * @param $id
     * @return CountriesResponse
     * @throws \Exception
     */
    public function countries($id)
    {
        return $this->server->get('countries')->execute(new NativeParameters(array('id' => $id)));
    }

}