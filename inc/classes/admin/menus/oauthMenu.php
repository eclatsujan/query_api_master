<?php
namespace PAIG\Admin\Menus;

use PAIG\Common\Helper;
use PAIG\Common\Option;
use PAIG\Front\TokenLogic;

class oauthMenu implements Menu
{
    private $nonce="paig_admin_oauth_form";

    public function __construct()
    {
        add_action( 'admin_post_paig_oauth_admin_form',array($this,'saveOptions'));
    }

    public function saveOptions()
    {
        $nonce=sanitize_text_field($_POST["paid_admin_email_nonce"]);

        if($this->verifyNonce($nonce)){
            $client_id=sanitize_text_field($_POST["client_id"]);
            $client_secret=sanitize_text_field($_POST["client_secret"]);
            $client_id_test=sanitize_text_field($_POST["client_id_test"]);
            $client_secret_test=sanitize_text_field($_POST["client_secret_test"]);

            $enable_test_mode=sanitize_text_field($_POST["enable_test_mode"]);

            $data=array(
                "client_id"=>$client_id,
                "client_id_test"=>$client_id_test,
                "enable_test_mode"=>$enable_test_mode,
                //To reset value
                'expiresIn'=>null,
                'accessToken'=>null
            );

            if(!empty($client_secret)){
                $data["client_secret"]=$client_secret;
            }

            if(!empty($client_secret_test)){
                $data["client_secret_test"]=$client_secret_test;
            }

            Option::setValues($data);
            TokenLogic::requestAccessToken($client_id,$client_secret);
            wp_safe_redirect(wp_get_referer()."&alert_success=true&alert_msg=Settings Saved");
        }
    }

    public function verifyNonce($nonce)
    {
        if(!wp_verify_nonce($nonce,$this->nonce)){
            wp_safe_redirect(wp_get_referer());
            die;
        }
        return true;
    }

    public function render()
    {
        // TODO: Implement render() method.
        $emails=[];
        Helper::view("admin/settings/tab/oauth",compact('emails'));
    }
}