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

//    public function getServiceConfig($sm){
//        return array(
//            "HulkTeam\\V1\\TeamService" =>  new TeamService(),
//            "HulkTeam\\V1\\ProfileService" =>  new ProfileService(),
//        );
//    }

} 