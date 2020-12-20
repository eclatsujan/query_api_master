<?php

use PAIG\Common\Helper;
use PAIG\Common\Option;

$nds_add_meta_nonce = wp_create_nonce('paig_admin_layout_nonce');
$theme_color = Option::getValue("theme_color");
$enable_flyer = Option::getValue("enable_flyer");

?>
<div id="layout-settings">
    <h4 class="h6">Layout Settings</h4>
    <form action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="post" id="nds_add_user_meta_form" class="col s12">
        <input type="hidden" name="action" value="paig_admin_layout_form">
        <input type="hidden" name="paig_admin_layout_nonce" value="<?php echo $nds_add_meta_nonce ?>" />
        <div class="row">
            <div class="input-field col s6">
                <div class="">
                    <label for="theme_color_picker">Theme Color</label>
                </div>
                <input id="theme_color_picker" value="<?php echo $theme_color; ?>" name="theme_color_picker" placeholder="Paste color code for theme" type="color" class="validate">
            </div>
        </div>
        <div class="row">
            <div class="input-field col s6">
                <div class="">
                    <label for="enable_flyer">Enable Flyer</label>
                </div>
                <select id="enable_flyer" name="enable_flyer" style="display:block">
                    <option <?php selected($enable_flyer,0) ?> value="0">No</option>
                    <option <?php selected($enable_flyer,1) ?> value="1">Yes</option>
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