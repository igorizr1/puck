<?php
/**
 * Created by PhpStorm.
 * User: codestack
 * Date: 30.04.15
 * Time: 16:03
 */

namespace Puck\Core;

class JsonResponse{
    public function __construct($data){
        $protocol = isset($_SERVER['SERVER_PROTOCOL']) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0';
        header('Content-Type: application/json');
        header($protocol.' 200 OK');
        echo json_encode($data);
    }
}