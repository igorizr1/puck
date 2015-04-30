<?php

namespace League\Profile;

use Puck\Core\RestResource;
use Puck\Core\JsonResponse;

Class ProfileResource extends RestResource{

    public function create($data = array()){
        return new JsonResponse(array(
            "test"  =>  "hi"
        ));
    }


}