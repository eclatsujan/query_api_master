<?php
namespace PAIG\Common;
class Option{
    //Create Option Name
    public static $option_name="paig_admin_settings";
    //Hold Option Value
    private static $option_values=[];

    private static $instance;


    public static function getInstance(){
        return !isset(static::$instance)?new Option():static::$instance;
    }

    //Create Option in the admin page
    public static function initOptions(){
        $options=get_option(static::$option_name);
        //if empty option then create a new option
        if(empty($options)){
            add_option(static::$option_name,"");
            $options=[];
        }
        else{
            $options=unserialize($options);
        }
        static::initOptionValues($options);

    }

    public static function initOptionValues($options){
        static::$option_values=$options;
    }

    //Return Single Value From Array
    public static function getValue($option_name){
        return isset(static::$option_values[$option_name])?static::$option_values[$option_name]:null;
    }

    private static function saveOption(){
        return update_option(static::$option_name,serialize(static::$option_values));
    }

    public static function setValues($option_values){
        static::$option_values=array_merge(static::$option_values,$option_values);
        return static::saveOption();
    }

    //Set Single Value From Array
    public static function setValue($option_name,$option_value){
        static::$option_values[$option_name]=$option_value;
        return static::saveOption();
    }
}