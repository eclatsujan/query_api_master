<?php
namespace PAIG\Common;

class Helper{

    public static function getSearchRoute(){
        return get_site_url()."/search_properties";
        //        return get_option("paig_search_property_url");
    }

    public static function getBackRoute(){

        return get_site_url()."/search_properties";
        //        return get_option("paig_search_property_url");
    }



    public static function view($template_name,$data=[]){
        extract($data);
        $file_name=PAIG_API_PLUGIN_TEMPLATE.$template_name.".php";
        if(file_exists($file_name)){
            include($file_name);
        }
    }

    public static function alert($is_alert,$alert_state,$alert_msg=""){
        $alert_state=boolval($alert_state);
        $alert_msg=sanitize_text_field($alert_msg);

        static::view("common/alerts/alert",compact('is_alert','alert_state','alert_msg'));
    }

    public static function generateEmailHeader($email_string,$header_string){
        $headers=[];
        if(!empty($email_string)){
            $emails=explode(",",$email_string);
            foreach($emails as $email){
                $headers[]=$header_string."<{$email}>";
            }
        }
        return $headers;
    }

}