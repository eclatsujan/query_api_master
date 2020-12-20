<?php
namespace PAIG\Common;


class Logger
{
    private static $log_file="system.log";
    private static $is_log=false;

    public static function checkLog(){
        $file_name=PAIG_API_PLUGIN_DIR."/logs/".static::$log_file;
        if(!file_exists($file_name)){

        }
        static::$is_log=true;
    }

    public static function createLog(){

    }

    public static function getLine($message){
        if(is_array($message)){

        }
        else{

        }
    }

    public static function writeLine(){

    }

    public static function getLog(){

    }
}