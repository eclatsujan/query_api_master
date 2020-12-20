<?php

namespace PAIG\Admin\Menus;

use PAIG\Common\Option;
use PAIG\Common\Helper;

class filterMenu
{
    private $nonce = "paig_admin_filter_form";
    public function __construct()
    {

        add_action('admin_post_paig_admin_filter_form', array($this, 'saveOptions'));
    }

    public function saveOptions()
    {
        $nonce = sanitize_text_field($_POST["paig_admin_filter_nonce"]);
        $this->verifyNonce($nonce);
        $defaultPropertyType = sanitize_text_field($_POST["defaultPropertyType"]);
        $defaultStrategyType = sanitize_text_field($_POST["defaultStrategyType"]);
        $isSinglePropertyType=boolval($_POST["isSinglePropertyType"]);
        $isSingleStrategyType=boolval($_POST["isSingleStrategyType"]);

        $b2bPartner=sanitize_text_field($_POST["b2bPartner"]);
        $b2bPartner1=sanitize_text_field($_POST["b2bPartner1"]);
        $selected_state = sanitize_text_field($_POST["state"]);
        $display_developer_filter = sanitize_text_field($_POST["display_developer_filter"]);
        $display_area_filter = sanitize_text_field($_POST["display_area_filter"]);

        Option::setValues(array(
            "default_property" => $defaultPropertyType,
            "default_strategy"=>$defaultStrategyType,
            "isSinglePropertyType"=>$isSinglePropertyType,
            "isSingleStrategyType"=>$isSingleStrategyType,
            "b2b_partner"=>$b2bPartner,
            "b2b_partner1"=>$b2bPartner1,
            "selected_state"=>$selected_state,
            "display_developer_filter"=>$display_developer_filter,
            "display_area_filter"=>$display_area_filter
        ));
        wp_safe_redirect(wp_get_referer() . "&alert_success=true&alert_msg=Settings Saved");
    }

    public function verifyNonce($nonce)
    {
        if (!wp_verify_nonce($nonce, $this->nonce)) {
            wp_safe_redirect(wp_get_referer());
            die;
        }
        return true;
    }

    public function render()
    {
        $emails = [];
        Helper::view("admin/settings/tab/filter", compact('emails'));
    }
}
