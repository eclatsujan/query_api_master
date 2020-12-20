<?php
namespace PAIG\Admin;

use PAIG\Admin\Menus\emailMenu;

use PAIG\Admin\Menus\layoutMenu;
use PAIG\Admin\Menus\oauthMenu;
use PAIG\Admin\Menus\filterMenu;
use PAIG\Common\Helper;

class adminMenu{

    private $adminTabs=[emailMenu::class,layoutMenu::class,oauthMenu::class,filterMenu::class];
    private $tabInstances=[];

    public function __construct()
    {
        //Initialize menu page hooks and actions
        $this->initHooks();
        //Initialize Tab Class
        $this->initTabClass();
        $this->showMainMenu();
    }

    public function initHooks(){

    }

    public function initTabClass(){
        foreach($this->adminTabs as $tab){
            if(class_exists($tab)){
                $this->tabInstances[]=new $tab();
            }
        }
    }

    public function showMainMenu()
    {
        add_action( 'admin_menu',array($this,'displayMenu'));
    }

    public function displayMenu(){
        add_menu_page( PAIG_PLUGIN_NAME, 'PAIG API Settings', 'administrator', PAIG_PLUGIN_NAME,
            array( $this, 'displaySettingsTab' ),
            null,
            100 );
    }

    public function displaySettingsTab(){
        ob_start();
            echo "<div class='mt4'>";
                Helper::view("admin/settings/header");
                $this->renderTabs();
            echo "</div>";
        ob_get_contents();
    }



    public function renderTabs(){
        foreach($this->tabInstances as $tabInstance){
            $tabInstance->render();
        }
    }

}