<?php
/**
 * Created by PhpStorm.
 * User: codestack
 * Date: 07.05.15
 * Time: 16:39
 */

namespace League;


class Module {

    public function getConfig(){
        return include __DIR__ . '/../config/module.config.php';
    }

    public function getRouteConfig($sm){
        return array(
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
        );
    }

//    public function getServiceConfig($sm){
//        return array(
//            "HulkTeam\\V1\\TeamService" =>  new TeamService(),
//            "HulkTeam\\V1\\ProfileService" =>  new ProfileService(),
//        );
//    }

} 