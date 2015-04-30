<?php
return array(
    "routes"        =>  array(
        "/hulk/profile/:id" =>  array(
            "controller"    =>  "League\\Profile\\ProfileResource",
            "methods"       =>  array(
                "collection"    =>  array(
                    "POST"   =>  array(
                        "validator"     =>  "Profile/profile_create.json",
                        "auth_required" =>  TRUE
                    ),
                    "GET"    =>  array(),
                    "PUT",
                    "DELETE" =>  array(
                        "auth_required" =>  FALSE
                    )
                ),
                "entity"        =>  array("POST", "GET", "PUT", "DELETE")
            )
        )
    )
);