<?php
namespace Paro\Endpoints\PeakClimber;

use Paro\Communicator\Parameters\NativeParameters;
use Paro\Communicator\Server;
use Paro\Endpoints\PeakClimber\Countries\Countries;
use Paro\Endpoints\PeakClimber\Countries\CountriesResponse;

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