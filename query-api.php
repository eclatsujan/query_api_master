<?php
/*
    Plugin Name: Query APIs
    Plugin URI: paig.com.au
    Description: Display  properies from Hashtag API
    Author: Ramesh Bhatta
    Version: 1.0
    Author URI: http://www.paig.com.au
*/

use PAIG\Admin\adminMain;
use PAIG\Common\Option;

defined('ABSPATH') or die('unauthorize access');
define("PAIG_PLUGIN_NAME","PAIG_API");
define("PAIG_API_PLUGIN_URL",plugin_dir_url(__FILE__));
define("PAIG_API_PLUGIN_JS_URL",plugin_dir_url(__FILE__)."assets/js");
define("PAIG_API_PLUGIN_DIR",plugin_dir_path(__FILE__));
define("PAIG_API_PLUGIN_TEMPLATE",PAIG_API_PLUGIN_DIR."templates/");
define("PAIG_API_PUBLIC_DIR",plugin_dir_url(__FILE__)."inc/public/");

define("PAIG_JS_VERSION","2.4.22");
define("PAIG_CSS_VERSION","2.4.22");

define("PAIG_API_URL","http://api.hashtagportal.com.au/api");
define("PAIG_DEV_API_URL","http://paigbackend.test/api");

define("PAIG_API_LIVE_URL","http://api.hashtagportal.com.au/oauth/token");
define("PAIG_API_DEV_URL","http://paigbackend.test/oauth/token");


// Or, using an anonymous function as of PHP 5.3.0
spl_autoload_register(function ($class) {
    // base directory for the namespace prefix
    $base_dir = __DIR__ . '/inc/classes/';
    if(strpos($class, 'PAIG')!==0){
        return;
    }

    //remove paig from class name
    $file_name=str_replace('PAIG\\',"",$class);

    //use namespace as string parse
    $folders=explode("\\",$file_name);
    //remove file name from the folder
    $file_name=array_pop($folders);

    //convert folder array to path string using /
    $file_path=implode("/",array_map(function($folder){
       return strtolower($folder);
    },$folders));

    //combine whole file path and file name with extensions.
    $file_name=$file_path."/".$file_name.'.php';
    //check if file exists in the folder.
    if(file_exists($base_dir.$file_name)){
        //require if file exist
        require $base_dir.$file_name;
    }
});

$paigAdmin=new adminMain();
$paigAdmin->addMenuSettings();


new \PAIG\Front\publicMain();










