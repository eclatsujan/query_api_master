<div class="container">
    <div class="flex flex-wrap -mx-5">
        <div class="w-full md:w-4/6 sp-content px-5 order-0 md:order-none">
            <?php load_template(PAIG_API_PLUGIN_TEMPLATE."components/single/description.php",true); ?>
        </div>
        <!-- Property Description / End -->
        <!-- Sidebar -->
        <div class="w-full md:w-2/6 v-si px-5 order-1 md:order-none">
            <?php load_template(PAIG_API_PLUGIN_TEMPLATE."components/single/sidebar.php",true); ?>
        </div>
        <div class="w-100 px-3 order-0 md:order-none">
            <div v-if="singleProperty.lists.length > 0">
                <?php load_template(PAIG_API_PLUGIN_TEMPLATE . "components/single/listing-table.php", true); ?>
            </div>
        </div>
    </div>

</div>