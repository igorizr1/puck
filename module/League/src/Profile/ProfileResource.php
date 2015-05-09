<?php

namespace League\Profile;

use Puck\Rest\RestResource;
use Puck\Response\JsonResponse;

Class ProfileResource extends RestResource{

    public function create($data = array()){
        return new JsonResponse(array(
            "test"  =>  "hi"
        ));
    }

    public function fetch($id = FALSE){
        return new JsonResponse(array(
            "fetch"  =>  "ohoh"
        ));
    }


}