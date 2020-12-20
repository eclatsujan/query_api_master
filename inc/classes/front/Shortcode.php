<?php

namespace PAIG\Front;

class Shortcode
{
    public function __construct()
    {
        add_shortcode("paig_property_search", array($this, 'displayPaigPropertySearch'));
        add_shortcode("paig_property_carousel", array($this, 'displayPaigPropertyCarousel'));
        add_shortcode("paig_property_listings", array($this, 'displayPaigPropertyListings'));
        add_shortcode("property_single_detail", array($this, 'displayPaigSingleDetail'));
    }

    public function displayPaigPropertySearch($atts)
    {
        $atts = shortcode_atts([
            "default_property_type" => "Project",
            "is_restricted" => "false"
        ], $atts);

        return $this->showContent("search", $atts);
    }

    // display property listings
    public function displayPaigPropertyListings($atts)
    {
        $atts = shortcode_atts([
            "default_property_type" => "Project",
            "is_restricted" => "false"
        ], $atts);

        return $this->showContent("property-listings", $atts);
    }

    // shortcode carousel
    public function displayPaigPropertyCarousel($atts)
    {
        $atts = shortcode_atts([
            "default_property_type" => "Project",
            "is_restricted" => "false"
        ], $atts);

        return $this->showContent("properties-carousel", $atts);
    }

    public function displayPaigSingleDetail($atts)
    {
        $atts = shortcode_atts([], $atts);
        return $this->showContent("single", $atts);
    }

    public function getShortcodeTemplateFile($file_name, $atts = [])
    {
        extract($atts);
        $file_name = PAIG_API_PLUGIN_TEMPLATE . "shortcodes/" . $file_name . ".php";
        if (file_exists($file_name)) {
            include($file_name);
        }
    }

    public function showContent($template_name, $atts)
    {
        ob_start();
        $this->getShortcodeTemplateFile($template_name, $atts);
        $output_string = ob_get_contents();
        ob_end_clean();
        return shortcode_unautop($output_string);
    }
}
