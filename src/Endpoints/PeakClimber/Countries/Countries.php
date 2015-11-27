<?php

namespace Paro\Endpoints\PeakClimber\Countries;

use Paro\Communicator\Parameters\ParametersInterface;
use Paro\Endpoints\EndpointInterface;
use Paro\Endpoints\ExecutableEndpointInterface;


class Countries implements EndpointInterface, ExecutableEndpointInterface
{

    /**
     * @param ParametersInterface $params
     * @return bool
     */
    public function validateParameters(ParametersInterface $params)
    {
        return $params->isDefined('id');
    }

    /**
     * @param ParametersInterface|null $params
     * @return CountriesResponse
     */
    public function execute(ParametersInterface $params = null)
    {
        $client = new \GuzzleHttp\Client();
        $res = $client->request('GET', sprintf('http://peakclimber.com/api/countries/%s.json', $params->getParameter('id')));
        $resArr = json_decode($res->getBody(), true);
        return new CountriesResponse($resArr);
    }

    /**
     * @return string
     */
    public function getUri()
    {
        return "countries";
    }
}