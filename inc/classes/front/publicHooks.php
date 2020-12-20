<?php

namespace PAIG\Front;

use PAIG\Common\Helper;
use PAIG\Common\Option;

class publicHooks
{

    public function __construct()
    {
        add_filter('body_class', array($this, 'addClassForSingleProperty'));
        add_action('wp_head', array($this, 'renderColorStyle'));
        add_action("wp_enqueue_scripts", array($this, "registerPropertyStyles"));
        //register scripts for vue
        add_action("wp_footer", array($this, "registerPropertyScripts"));
        add_action("wp_ajax_paig_send_email", array($this, 'paigSendEmail'));
        add_action("wp_ajax_nopriv_paig_send_email", array($this, 'paigSendEmail'));
        add_action("wp_body_open", array($this, "showContentPanel"));

        // Hooking up our functions to WordPress filters
        add_filter('wp_mail_from', array($this, 'wpb_sender_email'));
        add_filter("wp_mail_from_name", array($this, "wpb_sender_name"));
    }

    // Function to change email address
    function wpb_sender_email($original_email_address)
    {
        return 'noreply@hashtagportal.com.au';
    }

    // Function to change sender name
    function wpb_sender_name($original_email_from)
    {
//        return current active theme name
        return 'Hashtag Portal';
    }


    public function addClassForSingleProperty($classes)
    {
        global $wp_query;
        if (isset($wp_query->query_vars['display_id']) && is_single()) {
            $classes[] = "single_property";
        }
        return $classes;
    }

    public function renderColorStyle()
    {
        Helper::view("common/theme-color");
    }

    public function registerPropertyStyles()
    {

        //wp_enqueue_style("bootstrap-vue","https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css",array(),"4.0");
        wp_enqueue_style("paig-bootstrap-css", PAIG_API_PLUGIN_URL."assets/css/bootstrap.css", null, PAIG_CSS_VERSION);
        wp_enqueue_style("icons-css", PAIG_API_PLUGIN_URL."assets/css/icons.css", null, PAIG_CSS_VERSION);
        wp_enqueue_style("view-css", "https://unpkg.com/vue-select@latest/dist/vue-select.css", null, PAIG_CSS_VERSION);

        wp_enqueue_style("paig-cs-tailwind", PAIG_API_PLUGIN_URL."/assets/css/tailwind.css", null, PAIG_CSS_VERSION);
        wp_enqueue_style("paig-theme-css", PAIG_API_PLUGIN_URL."/assets/css/theme.css", null, PAIG_CSS_VERSION);

        wp_enqueue_style("paig-main-css", PAIG_API_PLUGIN_URL."/assets/css/main.css", null, PAIG_CSS_VERSION);

        wp_enqueue_style("paig-leaflet-css", "https://unpkg.com/leaflet@1.6.0/dist/leaflet.css", null,
            PAIG_CSS_VERSION);

        wp_enqueue_style("paig-custom-css", PAIG_API_PLUGIN_URL."/assets/css/custom.css", null, PAIG_CSS_VERSION);
        // wp_enqueue_style("color-css", PAIG_API_PLUGIN_URL . "/assets/css/color.css");
        wp_enqueue_style("paig-print-css", PAIG_API_PLUGIN_URL."/assets/css/print.css", null, PAIG_CSS_VERSION);
        wp_enqueue_style("paig-fa-css", "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css",
            null, PAIG_CSS_VERSION);

        wp_enqueue_style("footable-css", PAIG_API_PLUGIN_URL."/assets/css/footable.bootstrap.css", null,
            PAIG_CSS_VERSION);

    }


    public function registerPropertyScripts()
    {
        wp_enqueue_script("axios-script", "https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js");
        wp_enqueue_script("magnific-popup", PAIG_API_PLUGIN_JS_URL."/scripts/magnific-popup.min.js", null,
            PAIG_JS_VERSION);
        wp_enqueue_script("paig-custom-helpers", PAIG_API_PLUGIN_JS_URL."/helpers/propertyMapHelper.js", null,
            PAIG_JS_VERSION);
        wp_enqueue_script("custom-paig-js", PAIG_API_PLUGIN_JS_URL."/custom.js", array("jquery", "magnific-popup"),
            PAIG_JS_VERSION);

        $b2b_partner = !is_null(Option::getValue("b2b_partner")) ? Option::getValue("b2b_partner") : false;
        if ($b2b_partner == false) {
            $b2b_partner = !is_null(Option::getValue("b2b_partner1")) ? Option::getValue("b2b_partner1") : false;
        }

        $display_developer_filter = !is_null(Option::getValue("display_developer_filter")) ? Option::getValue("display_developer_filter") : false;
        $display_area_filter = !is_null(Option::getValue("display_area_filter")) ? Option::getValue("display_area_filter") : false;


        wp_localize_script('paig-custom-helpers', 'csPaig', array(
            'site_url' => get_site_url(),
            'accessToken' => Option::getValue("accessToken"),
            'environment' => PAIG_API_ENV,
            'default_property_type' => !is_null(Option::getValue("default_property")) ? Option::getValue("default_property") : "Project",
            'default_strategy_type' => !is_null(Option::getValue("default_strategy")) ? Option::getValue("default_strategy") : "",
            'isSinglePropertyType' => !is_null(Option::getValue("isSinglePropertyType")) ? Option::getValue("isSinglePropertyType") : false,
            'isSingleStrategyType' => !is_null(Option::getValue("isSingleStrategyType")) ? Option::getValue("isSingleStrategyType") : false,
            'b2b_partner' => $b2b_partner,
            'selected_state' => !is_null(Option::getValue("selected_state")) ? Option::getValue("selected_state") : "",
            'display_developer_filter' => $display_developer_filter,
            'display_area_filter' => $display_area_filter
        ));

        $vue_script = PAIG_API_ENV === "prod" ? "https://cdn.jsdelivr.net/npm/vue@2.6.11" : "https://cdn.jsdelivr.net/npm/vue/dist/vue.js";
        wp_enqueue_script("vue-script", $vue_script);
        wp_enqueue_script("vue-select", "https://cdnjs.cloudflare.com/ajax/libs/vue-select/3.10.7/vue-select.min.js");
        wp_enqueue_script("vue-select", "http://unpkg.com/vue-select@2.0.0");


        //wp_enqueue_script("datatable-script", "https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js",array('jquery'));

        //SearchBar Script
        wp_enqueue_script("searchbar-script", PAIG_API_PLUGIN_JS_URL."/components/searchbar.js", null, PAIG_JS_VERSION);
        //Compare Propeties Script
        wp_enqueue_script("compare-properties-script", PAIG_API_PLUGIN_JS_URL."/components/compare-properties.js", null,
            PAIG_JS_VERSION);
        //Front Page Owl Carousel
        wp_enqueue_script("properties-carousel", PAIG_API_PLUGIN_JS_URL."/components/properties-carousel.js", null,
            PAIG_JS_VERSION);


        //Single Page Details

        //Register Contact Form
        wp_register_script("cs-paig-contact-form", PAIG_API_PLUGIN_JS_URL."/components/single/single-contact-form.js",
            null, PAIG_JS_VERSION);
        //Send custom variable for contact
        wp_localize_script(
            'cs-paig-contact-form',
            'csAjax',
            array(
                'ajaxURL' => admin_url('admin-ajax.php'),
                'nonce' => wp_create_nonce('paig_contact_api_send')
            )
        );
        //Additional Jquery Features
        wp_enqueue_script("paig-owl-carousel-js", PAIG_API_PLUGIN_JS_URL."/scripts/owl.carousel.min.js",
            array("jquery"), PAIG_JS_VERSION);
        wp_enqueue_script("paig-slick-js", PAIG_API_PLUGIN_JS_URL."/scripts/slick.min.js", array("jquery"),
            PAIG_JS_VERSION);
        wp_enqueue_script("paig-leaftlet-js", "https://unpkg.com/leaflet@1.6.0/dist/leaflet.js", null, PAIG_JS_VERSION);
        wp_enqueue_script("paig-custom-helpers", PAIG_API_PLUGIN_JS_URL."/helpers/propertyMapHelper.js", null,
            PAIG_JS_VERSION);

        //Enqueue Contact Form
        wp_enqueue_script("paig-form-error", PAIG_API_PLUGIN_JS_URL."/components/form-error.js", null, PAIG_JS_VERSION);
        wp_enqueue_script("cs-paig-contact-form");
        wp_enqueue_script('paig-carousel', PAIG_API_PLUGIN_JS_URL."/components/single/carousel.js", null,
            PAIG_JS_VERSION);
        wp_enqueue_script('paig-single-title', PAIG_API_PLUGIN_JS_URL."/components/single/titlebar.js", null,
            PAIG_JS_VERSION);
        wp_enqueue_script("paig-listing-table", PAIG_API_PLUGIN_JS_URL."/components/single/listing-table.js", null,
            PAIG_JS_VERSION);
        wp_enqueue_script("paig-property-description",
            PAIG_API_PLUGIN_JS_URL."/components/single/property-description.js", null, PAIG_JS_VERSION);
        wp_enqueue_script("paig-property-sidebar", PAIG_API_PLUGIN_JS_URL."/components/single/property-sidebar.js",
            null, PAIG_JS_VERSION);
        wp_enqueue_script("paig-property-detail", PAIG_API_PLUGIN_JS_URL."/components/single/property-details.js", null,
            PAIG_JS_VERSION);
        wp_enqueue_script("paig-single-detail", PAIG_API_PLUGIN_JS_URL."/components/single-detail.js", null,
            PAIG_JS_VERSION);

        //Search Page Listings
        wp_enqueue_script("paig-search_results", PAIG_API_PLUGIN_JS_URL."/components/search/search_listings.js", null,
            PAIG_JS_VERSION);
        //Pagination File

        wp_enqueue_script("paig-pagination", PAIG_API_PLUGIN_JS_URL."/components/pagination.js", null, PAIG_JS_VERSION);


        wp_enqueue_script("footable-js",
            "https://cdnjs.cloudflare.com/ajax/libs/jquery-footable/3.1.6/footable.core.js");
        wp_enqueue_script("footable-sorting-js",
            "https://cdnjs.cloudflare.com/ajax/libs/jquery-footable/3.1.6/footable.sorting.js");

        //Main Vue File should always be in bottom
        wp_enqueue_script("paig-main-script", PAIG_API_PLUGIN_JS_URL.'/app.js', null, PAIG_JS_VERSION);

        if (PAIG_API_ENV === "dev") {
            wp_enqueue_script("paig_debug_script", "http://localhost:8098");
        }
    }

    public function paigSendEmail()
    {

        try {
            $nonce = sanitize_text_field($_POST['nonce']);
            if (!wp_verify_nonce($nonce, "paig_contact_api_send")) {
                wp_send_json_error("No Authenticated");
            }

            $to = !empty(Option::getValue("email")) ? Option::getValue("email") : get_theme_mod("email_address",
                get_option('admin_email'));

            $cc = Option::getValue("cc_email");
            $bcc = Option::getValue("bcc_email");
            //sanitize the values for email
            $name = sanitize_text_field($_POST["name"]);
            $subject = sanitize_text_field($_POST["subject"]);
            $message = sanitize_text_field($_POST["message"]);
            $phone = sanitize_text_field($_POST["phone"]);
            $email = sanitize_email($_POST["email"]);
            $url = esc_url($_POST["url"], FILTER_VALIDATE_URL, FILTER_FLAG_PATH_REQUIRED);
            $logo = "https://806mma.bn.files.1drv.com/y4m7gB8VTnl5xKTrV3YQKy5HX1NqGh4vVwHda_4mKJNqWvCN-JQFYyqvqqgTnaqz7non7PfSnnYe8t6coULILZixXOKYsb0-LTl77aySmWY7jmwiKBwVLAyMw3X1pcuVsl75Rn0EY-rES6hGymzJ7cWrvytITc4F4y_SdYwT2Dy89wESaU4tCnBZzvxS0vlPqRg4SS9MJEhpse2ZnH4m7n-zA?width=1097&height=222&cropmode=none";
            $logo_url = home_url();
            //generate template for contact
            ob_start();
            Helper::view(
                "admin/emails/contact",
                compact('name', 'subject', 'message', 'phone', 'email', 'url', 'logo', 'logo_url')
            );
            $content = ob_get_contents();
            ob_end_clean();

            //change content type of
            $headers = array('Content-Type: text/html; charset=UTF-8');
            $headers[] = 'Return-Path: <admin@paigtechnologies.com.au>';
            $headers = array_merge($headers, Helper::generateEmailHeader($cc, "Cc:"));

            if (wp_mail($to, $subject, $content, $headers)) {

                if(!$this->replyBackEmail($email, $name, $subject)){
                    throw new \Exception("No Reply");
                }

                $data = [
                    "msg" => "Successfully Send"
                ];
                wp_send_json_success($data, 200);
            } else {
                wp_send_json_error(["msg" => "Error in sending email"], 200);
            }
        } catch (\Exception $e) {
            wp_send_json_error(["msg" => "Error in sending email"], 200);
        }
    }

    public function replyBackEmail($email, $name, $subject){
        $to = $email;
        $site_name = get_bloginfo('title');
        $subject = "RE: ".$subject." [". $site_name."]";

        $url = esc_url($_POST["url"], FILTER_VALIDATE_URL, FILTER_FLAG_PATH_REQUIRED);
        $logo = "https://806mma.bn.files.1drv.com/y4m7gB8VTnl5xKTrV3YQKy5HX1NqGh4vVwHda_4mKJNqWvCN-JQFYyqvqqgTnaqz7non7PfSnnYe8t6coULILZixXOKYsb0-LTl77aySmWY7jmwiKBwVLAyMw3X1pcuVsl75Rn0EY-rES6hGymzJ7cWrvytITc4F4y_SdYwT2Dy89wESaU4tCnBZzvxS0vlPqRg4SS9MJEhpse2ZnH4m7n-zA?width=1097&height=222&cropmode=none";
        $logo_url = home_url();

        $default_msg = '<b>Thanks for reaching out! </b>
Your message has been successfully sent. All information received will always remain confidential. One of our colleagues will get back in touch with you soon!';

        $msg = wp_kses_post(Option::getValue('reply_back_msg'))?wp_kses_post(Option::getValue('reply_back_msg')):$default_msg;

       $message = apply_filters('the_content',$msg);

        ob_start();
        Helper::view(
            "admin/emails/reply-back",
            compact('to','name', 'subject','logo','url','logo_url','message')
        );
        $body = ob_get_contents();
        ob_end_clean();

        $headers = array('Content-Type: text/html; charset=UTF-8');

        $headers[] = 'Return-Path: <admin@paigtechnologies.com.au>';
       return  wp_mail($to, $subject, $body, $headers)?true:false;
    }

    public function showContentPanel()
    {
        $file_name = PAIG_API_PLUGIN_TEMPLATE."components/compare-properties.php";
        if (file_exists($file_name)) {
            include($file_name);
        }
    }
}
