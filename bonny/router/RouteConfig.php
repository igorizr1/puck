<?php
/**
 * Created by PhpStorm.
 * User: codestack
 * Date: 02.08.15
 * Time: 11:06
 */
namespace Bonny\Router;

use Bonny\Helpers\Singleton;

/**
 * Class Endpoint - define route methods & parse endpoint name
 * @package Bonny\Router
 */
final class EndpointConfig{

    /**
     * endpoint_name
     * @var string
     */
    private $endpoint;

    /**
     * list of methods, where key is method name(f.e. GET) & value is array with the list of actions for this enpoint
     * @var array
     */
    private $methods = array();

    /**
     * Endpoint regexp (used for matching request with endpoint name)
     * @var string
     */
    private $regExp;

    /**
     * endpoint params
     *   (f.e. /test/:test_id   - test_id will be the param )
     * @var array
     */
    private $params = array();

    public function __construct($endpoint_name){
        $parsed_endpoint = self::parseRoute($endpoint_name);

        $this->endpoint = $endpoint_name;
        $this->regExp = $parsed_endpoint['regExp'];
        $this->params = $parsed_endpoint['params'];
    }

    /**
     * Parse url and get [params] & [regExp]
     * @param $url
     * @return array
     */
    private static function parseRoute($url){
        $regExp = "/^";
        $parts = explode("/", $url);
        $params = array();

        foreach($parts as $part){
            if($part !== ""){
                if(preg_match('/^:(.+)/', $part, $matchParams)){
                    //route param
                    $regExp .= '\/(.+)';
                    array_shift($matchParams);
                    $params = array_merge($params, $matchParams);
                }else{
                    //route part
                    $regExp .= '\/'.$part;
                }
            }
        }
        $regExp .= "$/";
        return array(
            "regExp"    =>  $regExp,
            "params"    =>  $params
        );
    }

    /**
     * Get endpoint data
     * @return array
     */
    public function getConfig(){
        return array(
            'methods'   =>  $this->methods,
            'endpoint'  =>  $this->endpoint,
            'regExp'    =>  $this->regExp,
            'params'    =>  $this->params
        );
    }

    /**
     * Methods for defining routes (they are used in routes.config.php(RouteConfig) in modules)
     */
    public function post(){
        $this->methods['POST'] = func_get_args();
        return $this;
    }

    public function get(){
        $this->methods['GET'] = func_get_args();
        return $this;
    }

    public function put(){
        $this->methods['PUT'] = func_get_args();
        return $this;
    }

    public function delete(){
        $this->methods['DELETE'] = func_get_args();
        return $this;
    }

}


/**
 * Class EndpointConfigPool - it keeps the list of all routes in the app
 * @package Bonny\Router
 */
final class EndpointConfigPool{

    /**
     * pool of Endpoints
     * @var array
     */
    private static $routes = array();

    /**
     * Add route
     * @param EndpointConfig $endpoint
     * @return array
     */
    public static function push(EndpointConfig $endpoint){
        $endpoint_config = $endpoint->getConfig();
        return self::$routes[ $endpoint_config['regExp'] ] = $endpoint;
    }

    /**
     * Search route by it regExp
     * @param $regExp
     * @return null
     */
    public static function get($regExp){
        return isset(self::$routes[$regExp]) ? self::$routes[$regExp] : null;
    }

    /**
     * Get all routes
     * @return mixed
     */
    public static function getAll(){
        return self::$routes;
    }

}


/**
 * Class RouteConfig - used in app modules for defining routes
 * @package Bonny\Router
 */
abstract class Config extends Singleton{

    protected function __construct(){
        $this->setRoutes($this);
    }

    /**
     * function which is used in classes defined by developer to define routes
     * @param $req
     * @return mixed
     */
    abstract protected function setRoutes($req);

    /**
     * function for defining endpoint (used inside setRoutes)
     * @param $endpoint_name
     * @return array
     */
    final protected function route($endpoint_name){
        $endpoint_config = new EndpointConfig($endpoint_name);
        EndpointConfigPool::push( $endpoint_config );
        return $endpoint_config;
    }

}