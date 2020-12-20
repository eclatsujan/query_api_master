<?php
namespace PAIG\Admin\Menus;
use PAIG\Common\Option;
use PAIG\Common\Helper;

class layoutMenu{
    private $nonce="paig_admin_email_form";
    public function __construct() {

        add_action( 'admin_post_paig_admin_layout_form',array($this,'saveOptions'));
    }

    public function saveOptions(){
        $nonce=sanitize_text_field($_POST["paig_admin_layout_nonce"]);
        $theme_color=sanitize_text_field($_POST["theme_color_picker"]);
        $enable_flyer=intval($_POST["enable_flyer"]);
        Option::setValues(array(
            "theme_color"=>$theme_color,
	        "enable_flyer"=>$enable_flyer
        ));
        wp_safe_redirect(wp_get_referer()."&alert_success=true&alert_msg=Settings Saved");
    }

    public function verifyNonce($nonce){
        if(!wp_verify_nonce($nonce,$this->nonce)){
            wp_safe_redirect(wp_get_referer());
            die;
        }
        return true;
    }

    public function render(){
        $emails=[];
        Helper::view("admin/settings/tab/layout",compact('emails'));
    }
}