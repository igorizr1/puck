<?php
return array(
    "routes"        =>  array(
        "/hulk/team/:id" =>  array(
            "resource"    =>  "League\\Profile\\ProfileResource",
            "methods"       =>  array(
                "GET"    =>  array(
                    "validator"     =>  "Profile/profile_create.json",
                    "auth_required" =>  TRUE,
                    "acl"
                ),
                "POST"    =>  array(
                    "validator"     =>  "Profile/profile_create.json",
                    "auth_required" =>  TRUE,
                    "acl"
                ),
            )
        ),
        "/hulk/profile/:id" =>  array(
            "resource"    =>  "League\\Profile\\ProfileResource",
            "methods"       =>  array(
                "DELETE"    =>  array(
                    "validator"     =>  "Profile/profile_create.json",
                    "auth_required" =>  TRUE,
                    "acl"
                ),
                "GET"    =>  array(
                    "validator"     =>  "Profile/profile_create.json",
                    "auth_required" =>  TRUE,
                    "acl"
                ),
                "POST"    =>  array(
                    "validator"     =>  "Profile/profile_create.json",
                    "auth_required" =>  TRUE,
                    "acl"
                ),
                "PUT"    =>  array(
                    "validator"     =>  "Profile/profile_create.json",
                    "auth_required" =>  TRUE,
                    "acl"
                ),
            )
        ),
        "/hulk/profile" =>  array(
            "resource"    =>  "League\\Profile\\ProfileResource",
            "methods"       =>  array(
                "DELETE"    =>  array(
                    "validator"     =>  "Profile/profile_create.json",
                    "auth_required" =>  TRUE,
                    "acl"
                ),
                "GET"    =>  array(
                    "validator"     =>  "Profile/profile_create.json",
                    "auth_required" =>  TRUE,
                    "acl"
                ),
                "POST"    =>  array(
                    "validator"     =>  "Profile/profile_create.json",
                    "auth_required" =>  TRUE,
                    "acl"
                ),
                "PUT"    =>  array(
                    "validator"     =>  "Profile/profile_create.json",
                    "auth_required" =>  TRUE,
                    "acl"
                ),
            )
        )
    )
);