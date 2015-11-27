# About

The project is a pure &amp; simple implementation of RPC (Remote Procedure Call) in php.

The goal is to provide a library which is compatible with every framework and environment and provide good encapsulation 
of your communication's interfaces between your or third party systems. This library has great support for mocking.

Benefits
- communication protocol (e.g. json, xml, ..) is located at one place - in adpters. see \Paro\Communicator\Adapter\...
- handling + transferring exceptions from server to client
- very good encapsulation of responses - each response can have own response class easily

# How to implement own endpoints?
- all endpoints are located within \Endpoints namespace
- each collection of endpoints should have
    - own namespace
    - own facade - e.g. \Endpoints\Biolib\Biolib
- each endpoint must implement EndpointInterface (and ExecutableEndpointInterface in case of third party encapsulation)

# General usage
## Client side
    $biolib = new \Paro\Endpoints\Biolib\Biolib();
    /** @var $response \Paro\Endpoints\Response */
    $response = $biolib->findname('elaphe');
    var_dump($response);

## Server side
You can define server (processing code) within the libary for thir parties or crate own server and attach endpoints 
by callback functions.
    
### Third party - execution mode [example]
Every endopoint must implement Paro\Endpoints\ExecutableEndpointInterface

    //src\Endpoints\PeakClimber\Countries\Countries.php
    
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


### Callback mode [example]
Use this approach for own implementation of server mode - your library provides just interfaces.

    //server.php
    
    <?php
    require __DIR__ . '/vendor/autoload.php';
    
    use Paro\Communicator\Adapter\Json\JsonAdapter;
    use Paro\Communicator\Parameters\NativeParameters;
    use Paro\Communicator\Server;
    use Paro\Endpoints\Order\CancelOrder\CancelOrder;
    use Paro\Endpoints\Order\CancelOrder\CancelOrderResponse;
    
    $vsServer = new Server(new JsonAdapter());
    $vsServer->register(
        new CancelOrder(),
        'cancelorder',
        function(\Paro\Communicator\Parameters\ParametersInterface $params) {
            //do something awesome
            $return = false;
            if ($params->isDefined('name')) {
                $return = $params->getParameter('name') . ' processed on server at ' . time();
            }
            return new CancelOrderResponse($return);
        }
    );
    
    echo($vsServer->get($_GET['service'])->execute(new NativeParameters($_GET, $_POST)));
    
This is just an example of using. You can find many others ways how create server side.


# Examples of endpoint implementations
- \Endpoints\Biolib - a third party with soap execution
- \Endpoints\PeakClimber - a third party with rest 
- \Endpoints\Order - just an interface - implementation in own callback at destination (server)
    

## Endpoint [full example]
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
    
## Facade of endpoints [full example]
    <?php
    namespace Paro\Endpoints\Biolib;
    
    use Paro\Communicator\Parameters\NativeParameters;
    use Paro\Communicator\Server;
    use Paro\Endpoints\Biolib\FindName\FindName;
    use Paro\Endpoints\Response;
    
    class Biolib
    {
        /**
         * @var Server
         */
        private $server;
    
        public function __construct()
        {
            $this->server = new Server();
            $this->server->register(new FindName(), 'findname');
        }
    
        /**
         * @param $name
         * @param string $auth
         * @return Response
         * @throws \Exception
         */
        public function findname($name, $auth = '')
        {
            return $this->server->get('findname')->execute(new NativeParameters(array('name' => $name, 'auth' => $auth)));
        }
    
    }
    