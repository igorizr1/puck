<?php
/**
 * Created by PhpStorm.
 * User: codestack
 * Date: 09.05.15
 * Time: 17:40
 */

namespace Bonny\Router;

use Bonny\Helpers\Singleton;
use Bonny\Response\ApiProblem;
use Bonny\Response\JsonResponse;

final class Router extends Singleton{

    /**
     * MAIN ROuter method
     *
     * used to match request uri with available routes
     *
     * @return ApiProblem|EndpointMethod|bool
     */
    public function findRoute(){
        /**
         * Get all routes Config
         */

        foreach(EndpointConfigPool::getAll() as $regExp => $endpoint){

            $routeConfig = $endpoint->getConfig();

            Request::setEndpointConfig($routeConfig);

            /**
             * Match regExp with REQUEST_URI
             */
            if(preg_match($regExp, Request::getRequestUri(), $matchParams)){

                Request::setRouteParams( self::matchParams($routeConfig['params'], $matchParams) );

                /**
                 * if matched => match REQUEST_METHOD
                 */
                if($method_handlers = $routeConfig['methods'][Request::getRequestMethod()]){

                    /**
                     * if REQUEST_METHOD in the list of available methods for this Endpoint => than we have found it
                     *
                     * After this we need to call one by one all Endpoint handlers
                     */
                    if(is_array($method_handlers) && count($method_handlers) > 0){

                        /**
                         * ROUTE FOUND
                         */
                        Request::setMethodHandlers($method_handlers);

                        /**
                         * Call endpoint
                         */
                        return new EndpointMethod();

                    }else{
                        /**
                         * error: Route not Found
                         */
                        return new ApiProblem(404);
                    }
                }
                // error: method not allowed
                return new ApiProblem(405);
            }
        }
        // error: Route not Found
        return new ApiProblem(404);
    }

    private static function matchParams($keys, $values){
        array_shift($values);
        return array_combine($keys, $values);
    }

}


final class Request extends Singleton{

    private static $routeParams;
    private static $method_handlers;
    private static $endpoint_config;

    /**
     * Setters
     */
    public static function setRouteParams(array $routeParams){
        self::$routeParams = $routeParams;
    }

    public static function setEndpointConfig(array $endpoint_config){
        self::$endpoint_config = $endpoint_config;
    }

    public static function setMethodHandlers(array $method_handlers){
        self::$method_handlers = $method_handlers;
    }

    /**
     * Getters
     */
    public static function getRequestUri(){
        return $_SERVER['REQUEST_URI'];
    }

    public static function getRequestMethod(){
        return $_SERVER['REQUEST_METHOD'];
    }

    public static function getRouteParams(){
        return self::$routeParams;
    }

    public static function getEndpointConfig(){
        return self::$endpoint_config;
    }

    public static function getMethodHandlers(){
        return self::$method_handlers;
    }

    public static function getQueryParams(){
        return array();
    }

    public static function getBodyParams(){
        return array();
    }

    public static function getRestParams(){
        return array(
            'method'    =>  self::getRequestMethod(),
            'uri'    =>  self::getRequestUri(),
            'uriParams'    =>  self::getRouteParams(),
            'queryParams'    =>  self::getQueryParams(),
            'bodyParams'    =>  self::getBodyParams(),
        );
    }

}


final class EndpointMethod{

    private $restParams;

    public function __construct(){
        $this->restParams = Request::getRestParams();
        $this->run();
    }

    private function call_handler($handler){
        /**
         * check if this a function
         */
        if( is_callable($handler) ){
            $handler_result = $handler( $this->restParams );

            /**
             * check if result exists and it is NOT false and it is not ApiProblem or JsonResponse
             */
            if($handler_result && $handler_result instanceof ApiProblem || $handler_result instanceof JsonResponse){
                return FALSE;
            }

            if($handler_result){
                return TRUE;
            }
        }
        return FALSE;
    }



    private function run(){
        $method_handlers = Request::getMethodHandlers();
        $handlers_length = count($method_handlers);
        $i = 0;

        /**
         * Default response
         */
        new ApiProblem(404);

        /**
         * If call_handler return TRUE call next handler
         */
        while( $this->call_handler( $method_handlers[$i] ) === TRUE && $i < $handlers_length ){
            ++$i;
        }
    }


}

















