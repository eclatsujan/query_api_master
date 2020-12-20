<?php
namespace PAIG\Front;

class publicMain{
    
    public function __construct(){

        //register routing for single property & property list
        $this->registerRouting();
        $this->checkToken();
        $this->loadHooks();
        //show templates for property
        $this->renderShortcodes();
        //show sharing icons
        $this->renderSocialSharing();
    }

    public function checkToken(){
        new TokenLogic();
    }

    public function registerRouting(){
        new Routing();
    }

    public function loadHooks(){
        new publicHooks();
    }

    public function renderShortcodes(){
        new Shortcode();
    }

    public function renderSocialSharing(){
        new SocialSharing();
    }

}