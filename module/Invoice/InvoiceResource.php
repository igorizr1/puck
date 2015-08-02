<?php

namespace Invoice;

use Bonny\Rest\RestResource;
use Bonny\Response\JsonResponse;

Class InvoiceResource extends RestResource{

    public static function create($data = array()){
        return new JsonResponse(array(
            "test"  =>  "hi"
        ));
    }

    public static function fetch($id = FALSE){
        return new JsonResponse(array(
            "fetch"  =>  "ohoh"
        ));
//        return new JsonResponse();
    }


}