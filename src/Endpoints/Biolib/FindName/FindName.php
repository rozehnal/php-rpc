<?php

namespace Paro\Endpoints\Biolib\FindName;

use Paro\Communicator\Parameters\ParametersInterface;
use Paro\Endpoints\EndpointInterface;
use Paro\Endpoints\ExecutableEndpointInterface;
use Paro\Endpoints\Response;


class FindName implements EndpointInterface, ExecutableEndpointInterface
{

    /**
     * @param $params ParametersInterface
     * @return boolean
     */
    public function validateParameters(ParametersInterface $params)
    {

        return $params->isDefined('name');
    }

    /**
     * @param $params ParametersInterface
     * @return array
     * @throws \SoapFault
     */
    public function execute(ParametersInterface $params = null)
    {

        $soapClient = new \SoapClient("http://www.biolib.cz/soap/findname.wsdl", array('trace' => 1));
        try {
            ;
            $result = $soapClient->findName($params->getParameter('name'), $params->getParameter('auth'));
        } catch (\SoapFault $fault) {
            throw $fault;
        }

        return new Response($result);
    }

    /**
     * @return string
     */
    public function getUri()
    {
        return 'findname';
    }
}