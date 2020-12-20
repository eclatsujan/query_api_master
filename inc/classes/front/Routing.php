<?php

namespace PAIG\Front;
class Routing
{

    public function __construct()
    {
        add_action('init', array($this, 'rewriteForProperty'));
        add_filter('query_vars', array($this, 'filter_query_vars'));
        add_filter('template_include', array($this, 'searchPropertyPage'));
        add_filter('template_include', array($this, 'filterSinglePropertyPage'));
    }

    public function rewriteForProperty()
    {
        //Need to add more ([^/]*) to access to match values
        add_rewrite_rule(
            '^properties/([^/]*)/([^/]*)/?',
            'index.php?display_id=$matches[2]',
            'bottom'
        );

        add_rewrite_rule(
            '^search_properties/([^/]*)/?',
            'index.php?search_properties=$matches[1]',
            'bottom'
        );
    }

    public function filter_query_vars($query_vars)
    {
        $query_vars[] = 'display_id';

        return $query_vars;
    }

    public function searchPropertyPage($template)
    {
        global $wp_query;

        if (isset($wp_query->query['name'])) {
            if ($wp_query->query['name'] === 'search_properties') {
                $wp_query->is_404 = false;
                $wp_query->is_search = true;
                if (file_exists(get_stylesheet_directory() . "/search-listing.php")) {
                    $template = get_stylesheet_directory() . "/search-listing.php";
                } else if (file_exists(PAIG_API_PLUGIN_TEMPLATE . "pages/search-listing.php")) {
                    $template = PAIG_API_PLUGIN_TEMPLATE . "/pages/search-listing.php";
                }
            }
        }

        return $template;
    }

    public function filterSinglePropertyPage($template)
    {
        global $wp_query;
        // You could normally swap out the template WP wants to use here, but we'll just die
        if (isset($wp_query->query_vars['display_id']) && !is_page() && !is_single()) {
            $wp_query->is_404 = false;
            // $wp_query->is_archive = true;
            $wp_query->is_single = true;
            $file_name = get_stylesheet_directory();

            if (file_exists($file_name . "/single-property.php")) {
                return $file_name . "/single-property.php";
            } else if (file_exists(PAIG_API_PLUGIN_TEMPLATE . "pages/single.php")) {
                return PAIG_API_PLUGIN_TEMPLATE . "pages/single.php";
            } else {
                return $template;
            }
        } else {
            return $template;
        }
    }


}