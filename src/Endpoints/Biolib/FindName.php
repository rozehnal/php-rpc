<?php

namespace DixonsCz\Endpoints\Biolib;

use DixonsCz\Communicator\Parameters\ParametersInterface;
use DixonsCz\Endpoints\EndpointInterface;
use DixonsCz\Endpoints\Response;


class FindName implements EndpointInterface
{
    private $endpointName = "findName";


    public function __construct($endpointname = null)
    {
        if ($endpointname !== null) {
            $this->endpointName = $endpointname;
        }
    }

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
        ini_set("soap.wsdl_cache_enabled", "0");
        try {
            ;
            $result = $soapClient->findName($params->getParameter('name'), $params->getParameter('auth'));

            //foreach ($result as $res) {
            //echo '<a href="http://www.biolib.cz/cz/taxon/id'.$res['taxonid'].'/">'.$res['validname'].'</a> '.$res['validauthority'].'<br />';
            //print_r($res);
            //}
        } catch (\SoapFault $fault) {
            //var_dump($fault);
            throw $fault;
        }

        return new Response($result);
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->endpointName;
    }

    /**
     * @return string
     */
    public function getUri()
    {
        return 'findname.php';
    }
}