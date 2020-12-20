<?php
namespace PAIG\Admin;
use PAIG\Admin\Widgets\scheduleFormWidget;
use PAIG\Common\Option;

class adminMain
{
    private $widgets=[scheduleFormWidget::class];
    private $paigOptions;

    public function __construct()
    {
        //Init the option for the whole plugin
        $this->initOptions();
        //Define Environment Variable
        $this->defineEnvironment();
        //Todo Permalink Settings
        $this->addPermalinkSettings();
        //Add admin hook for the plugin
        $this->addHooks();

    }

    public function addHooks(){
        add_action('admin_enqueue_scripts',array($this,'enqueue_admin_js'));
    }

    public function initOptions(){
        $paigOptions= Option::getInstance();
        $paigOptions::initOptions();
    }

    public function defineEnvironment(){
        $prod=empty(Option::getValue("enable_test_mode"))?"prod":"dev";
        define("PAIG_API_ENV",$prod); //either prod or dev
    }

    //Add style and script in the admin panel
    public function enqueue_admin_js(){
        if(get_current_screen()->id==="toplevel_page_PAIG_API"){
            wp_enqueue_script("axios-script1", "https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js");
            wp_enqueue_style( 'admin-materialize-font', 'https://fonts.googleapis.com/icon?family=Material+Icons');
            wp_enqueue_style("admin-tailwind","https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css");
            wp_enqueue_style( 'admin-materialize-style', 'https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css');
            wp_enqueue_script( 'admin-paig-script', 'https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js');
            wp_enqueue_script( 'admin-paig-custom', PAIG_API_PLUGIN_URL."assets/admin/js/custom.js");


            wp_localize_script('admin-paig-custom', 'csPaig', array(
                'accessToken' => Option::getValue("accessToken"),
                'environment'=>PAIG_API_ENV
            ));
        }
    }

    //Todo Custom Permalink Settings for listing page
    public function addPermalinkSettings(){

    }

    //Add menu settings in the plugin
    public function addMenuSettings(){
        new adminMenu();
    }

    //register All Widgets in the plugins
    public function registerWidget(){
        add_action('widgets_init',array($this,'registerAllWidgets'));
    }

    public function registerAllWidgets(){
        foreach($this->widgets as $widget){
            if(class_exists($widget)){

                register_widget($widget);
            }
        }
    }
}