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
                "controller"    =>  "League\\Profile\\ProfileResource",
                "actions"       =>  array("delete", "create")
            ),
            "/hulk/profile/:id" =>  array(
                "controller"    =>  "League\\Profile\\ProfileResource",
                "actions"       =>  array(
                    "delete"    =>  array(
                        "validator"     =>  "Profile/profile_create.json",
                        "auth_required" =>  TRUE,
                        "acl"
                    ),
                    "create"    =>  array(

                    ),
                    "deleteList"    =>  array(

                    ),
                    "fetch"    =>  array(

                    ),
                    "fetchAll"    =>  array(

                    ),
                    "patch"    =>  array(

                    ),
                    "replaceList"    =>  array(

                    ),
                    "update"    =>  array(

                    )
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