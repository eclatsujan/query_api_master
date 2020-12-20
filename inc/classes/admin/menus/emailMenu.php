<?php
namespace PAIG\Admin\Menus;
use PAIG\Common\Option;
use PAIG\Common\Helper;

class emailMenu{
    private $nonce="paig_admin_email_form";
    public function __construct()
    {
        add_action( 'admin_post_paig_admin_form',array($this,'saveOptions'));
    }

    public function saveOptions(){
        $nonce=sanitize_text_field($_POST["paid_admin_email_nonce"]);
        if($this->verifyNonce($nonce)){
            $email=sanitize_text_field($_POST["email_address"]);
            $cc_email=sanitize_text_field($_POST["cc_email_address"]);
            $reply_back_msg=wp_filter_post_kses($_POST["reply_back_msg"]);

            Option::setValues(array(
                "email"=>$email,
                "cc_email"=>$cc_email,
                "reply_back_msg"=>$reply_back_msg
            ));

            wp_safe_redirect(wp_get_referer()."&alert_success=true&alert_msg=Settings Saved");
        }
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
        Helper::view("admin/settings/tab/email",compact('emails'));
    }
}