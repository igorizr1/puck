<?php
/**
 * Created by PhpStorm.
 * User: codestack
 * Date: 09.05.15
 * Time: 17:14
 */

namespace Puck\Router;


class ResourceInitializer {

    public function __construct($resource, $action, $params){
        if($this->loadResourceFile($resource)){
            $resourceName = "\\{$resource}";
            $resourceObject = new $resourceName;
            $initMethodName = "call_{$action}";

            $this->$initMethodName($resourceObject, $params);
        }
    }

    private function loadResourceFile($resourceName){
        $parts = explode('\\', $resourceName);
        $parts_length = count($parts);
        $file_path = APPLICATION_PATH."/module";

        foreach($parts as $k => $v){
            $file_path.="/{$v}";
            if($k === 0)
                $file_path.="/src";
            if($k+1 === $parts_length){
                $file_path.=".php";
            }
        }
        return require_once $file_path;
    }

    private function call_create($resource, $params){
        return $resource->create($params['body_params']);
    }

    private function call_fetch($resource, $params){
        return $resource->fetch(end($params['uri_params']));
    }

    private function call_fetchAll($resource, $params){
        return $resource->fetchAll(end($params['uri_params']));
    }

    private function call_update($resource, $params){

    }

    private function call_replaceList($resource, $params){

    }

    private function call_delete($resource, $params){

    }

    private function call_deleteList($resource, $params){

    }

} 