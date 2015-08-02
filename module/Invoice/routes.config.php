<?php
/**
 * Created by PhpStorm.
 * User: codestack
 * Date: 01.08.15
 * Time: 08:23
 */

namespace Invoice;

use Bonny\Router\Config;
use Bonny\Response\ApiProblem;
use Bonny\Response\JsonResponse;

Class Route extends Config{

    protected function setRoutes($req){

        $req->route('/league/:league_id/invoice')
            ->post(
                function(){
                    return TRUE;
                },
                function(){
                    return InvoiceResource::create();
                }
            )
            ->get(
                function(){
                    new JsonResponse();
                },
                function(){
                    echo ' not here';
                    InvoiceResource::fetch();
                }
            );
    }

}