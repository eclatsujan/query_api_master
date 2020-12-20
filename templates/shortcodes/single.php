<?php
global $wp_query;
$display_id = $wp_query->query_vars['display_id'];

?>
<div class="isSingleLoading py-5">
    <div class="loader"></div>
</div>
<div id="paigApp" class="cs_single_paig_theme hidden">
    <single-detail display_id="<?php echo $display_id ?>" inline-template>
        <div>
            <div v-if="Object.keys(singleProperty).length>0">
                <?php
                load_template(PAIG_API_PLUGIN_TEMPLATE . "components/single/titlebar.php", true);
                load_template(PAIG_API_PLUGIN_TEMPLATE . "components/single/carousel.php", true);
                load_template(PAIG_API_PLUGIN_TEMPLATE . "components/single/detail.php", true);
                ?>
            </div>
            <div v-else class="row m-h-300 py-20">
                <h1 class="text-center">Sorry ! Property Not Found</h1>
            </div>
        </div>
    </single-detail>
</div>