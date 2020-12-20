<?php

use PAIG\Common\Helper;
use PAIG\Common\Option;

$nds_add_meta_nonce = wp_create_nonce('paig_admin_filter_form');
$default_property = Option::getValue("default_property");
$single_property_type=Option::getValue("isSinglePropertyType");
$strategy_property = Option::getValue("default_strategy");
$single_strategy_type=Option::getValue("isSingleStrategyType");
$b2b_partner=Option::getValue("b2b_partner");
$b2b_partner1=Option::getValue("b2b_partner1");
$selected_state=Option::getValue("selected_state");
$display_developer_filter=Option::getValue("display_developer_filter");
$display_area_filter=Option::getValue("display_area_filter");


$default_property=!is_null($default_property)?$default_property:"Property";
$single_property_type=!is_null($single_property_type)?$single_property_type:false;
$strategy_property=!is_null($strategy_property)?$strategy_property:"All";
$single_strategy_type=!is_null($single_strategy_type)?$single_strategy_type:false;

$b2b_partner=!is_null($b2b_partner)?$b2b_partner:null;
$b2b_partner1=!is_null($b2b_partner1)?$b2b_partner1:null;
$selected_state=!is_null($selected_state)?$selected_state:null;
$display_developer_filter=!is_null($display_developer_filter)?$display_developer_filter:false;
$display_area_filter=!is_null($display_area_filter)?$display_area_filter:false;

?>
<div id="filter-settings">
    <h4 class="h6">Filter Settings</h4>
    <form action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="post" id="nds_add_user_meta_form" class="col s12">
        <input type="hidden" name="action" value="paig_admin_filter_form">
        <input type="hidden" name="paig_admin_filter_nonce" value="<?php echo $nds_add_meta_nonce ?>" />
        <div class="row">
            <div class="input-field col s6">
                <div class="">
                    <label for="default_property">Default Property</label>
                </div>

                <select data-property_type="<?php echo $default_property ?>" name="defaultPropertyType" id="property_type_select" style="display:block;">

                </select>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s12">
                <div>
                    <label for="isSingleType">Is Single Property Type</label>
                </div>
                <select name="isSinglePropertyType" id="single_type" style="display:block">
                    <option <?php selected( $single_property_type, false); ?> value="0">No</option>
                    <option <?php selected( $single_property_type, true ); ?> value="1">Yes</option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s6">
                <div class="">
                    <label for="default_property">Default Strategy </label>
                </div>
                <select data-strategy_type="<?php echo $strategy_property ?>" name="defaultStrategyType" id="strategy_type_select" style="display:block;">
                </select>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s12">
                <div>
                    <label for="isSingleType">Is Single Strategy Type</label>
                </div>
                <select name="isSingleStrategyType" id="single_type" style="display:block">
                    <option <?php selected( $single_strategy_type, false); ?> value="0">No</option>
                    <option <?php selected( $single_strategy_type, true ); ?> value="1">Yes</option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s6">
                <div class="">
                    <label for="b2b_partner">B2B Partner</label>
                </div>
                <select data-b2b_partner="<?php echo $b2b_partner; ?>" name="b2bPartner" id="b2b_partner_select" style="display:block;">

                </select>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s6">
                <div class="">
                    <label for="b2b_partner1">B2B Partner Text</label>
                </div>
                <input type="text" name="b2bPartner1" id="b2b_partner1" value="<?php echo $b2b_partner1; ?>" />
            </div>
        </div>
        <div class="row">
            <div class="input-field col s6">
                <div class="">
                    <label for="state">Selected State</label>
                </div>

                <select data-state="" name="state" id="state_select" style="display:block;">
                    <option value="">All</option>
                    <option <?php selected( $selected_state, 'NSW'); ?> value="NSW">New South Wales</option>
                    <option <?php selected( $selected_state, 'VIC'); ?> value="VIC">Victoria</option>
                    <option <?php selected( $selected_state, 'QLD'); ?>   value="QLD">Queensland</option>
                    <option <?php selected( $selected_state, 'WA'); ?>  value="WA">Western Australia</option>
                    <option <?php selected( $selected_state, 'SA'); ?>  value="SA">South Australia</option>
                    <option <?php selected( $selected_state, 'TAS'); ?>  value="TAS">Tasmania</option>
                    <option <?php selected( $selected_state, 'ACT'); ?>  value="ACT">Australian Capital Territory</option>
                    <option <?php selected( $selected_state, 'NT'); ?>   value="NT">Northern Territory</option>
                </select>
            </div>
        </div>

        <div class="row">
            <div class="input-field col s12">
                <div>
                    <label for="display_developer_filter">Show Developer Filter</label>
                </div>
                <select name="display_developer_filter" id="display_b2b_filter" style="display:block">
                    <option <?php selected( $display_developer_filter, false); ?>  value="0">No</option>
                    <option <?php selected( $display_developer_filter, true); ?>  value="1">Yes</option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s12">
                <div>
                    <label for="display_area_filter">Show Area Filter</label>
                </div>
                <select name="display_area_filter" id="display_area_filter" style="display:block">
                    <option <?php selected( $display_area_filter, false); ?>  value="0">No</option>
                    <option <?php selected( $display_area_filter, true); ?>  value="1">Yes</option>
                </select>
            </div>
        </div>


        <div class="row">
            <div class="s12">
                <button class="btn waves-effect waves-light">Save</button>
            </div>
        </div>
    </form>
</div>