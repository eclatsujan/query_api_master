<property-sidebar v-bind:display_id="display_id" v-bind:prop_desc="singleProperty" inline-template>
    <div class="sidebar pb-6 flex flex-wrap">
        <!-- Widget -->
        <div class="widget margin-bottom-30 order-first w-full">
            <button class="widget-button with-tip" v-on:click="printPage" data-tip-content="Print"><i
                        class="fas fa-print"></i></button>
            <button v-bind:class="'widget-button with-tip '+isSaved(prop_desc.display_id)"
                    v-on:click="saveProperty(prop_desc)" data-tip-content="Add to Bookmarks">
                <i class="far fa-heart"></i>
            </button>
            <a :href="shareFacebook()" target="_blank" class="widget-button with-tip" data-tip-content="Add to Compare">
                <i class="fab fa-facebook-f"></i>
            </a>
            <a :href="shareTwitter()" target="_blank" class="widget-button with-tip" data-tip-content="Add to Compare">
                <i class="fab fa-twitter"></i>
            </a>
            <a :href="shareLinkedIn()" target="_blank" class="widget-button with-tip" data-tip-content="Add to Compare">
                <i class="fab fa-linkedin-in"></i>
            </a>
            <a :href="'mailto:?'+getEmailLine()" target="_blank" class="widget-button with-tip"
               data-tip-content="Add to Compare">
                <i class="far fa-envelope"></i>
            </a>
			<?php if (PAIG\Common\Option::getValue("enable_flyer") === 1): ?>
                <a :href="'http://phpstack-430853-1437296.cloudwaysapps.com/flyer/generate/'+prop_desc.property_id"
                   target="_blank" class="widget-button with-tip" data-tip-content="Flyer">
                    <i class="fas fa-book"></i>
                </a>
			<?php endif; ?>
            <button class="widget-button with-tip compare-widget-button hidden" data-tip-content="Add to Compare">
                <i class="icon-compare"></i>
            </button>
            <div class="clearfix"></div>
        </div>
        <!-- Widget / End -->
        <div class="widget order-last md:order-none w-full">
			<?php require(PAIG_API_PLUGIN_TEMPLATE . "components/widgets/single-contact-form.php"); ?>
        </div>
        <div class="widget agent-widget margin-top-30 w-full" v-if="prop_desc.parent_property_id !== '0'">
            <div class="mb-10">
                <a v-bind:href="generateURL('/properties/detail/'+prop_desc.parent_property_data.display_id)"
                   class="button btn-paig medium">
                    <i class="fas fa-arrow-left"></i> Go Back To Project</a>
            </div>

            <div class="mb-10" v-if="prop_desc.parent_property_data.attachments.floorplan.length >0">
                <h3 class="desc-headline">Project Estate Plan</h3>
                <ul class="fa-ul file-list color">
                    <li v-for="fp in prop_desc.parent_property_data.attachments.floorplan">
                        <a v-if="fp!==''" v-bind:href="fp" target="_blank">
                            <i v-bind:class="'fa-li fa '+renderIconClass(fp)"></i>
                            {{extractFileName(fp)}}
                        </a>
                    </li>
                </ul>
            </div>
            <div class="mb-10" v-if="prop_desc.parent_property_data.attachments.inclusion.length > 0">
                <h3 class="desc-headline">Project Estate Brochure</h3>
                <ul class="fa-ul file-list color">
                    <li v-for="fp in prop_desc.parent_property_data.attachments.inclusion">
                        <a v-if="fp!==''" v-bind:href="fp" target="_blank">
                            <i v-bind:class="'fa-li fa '+renderIconClass(fp)"></i>
                            {{extractFileName(fp)}}
                        </a>
                    </li>
                </ul>
            </div>
            <div class="mb-10" v-if="prop_desc.parent_property_data.attachments.documents.length > 0">
                <h3 class="desc-headline">Project Other Documents</h3>
                <ul class="fa-ul file-list color">
                    <li v-for="fp in prop_desc.parent_property_data.attachments.documents">
                        <a v-if="fp!==''" v-bind:href="fp" target="_blank">
                            <i v-bind:class="'fa-li fa '+renderIconClass(fp)"></i>
                            {{extractFileName(fp)}}
                        </a>
                    </li>
                </ul>
            </div>

        </div>

    </div>
    <!-- Sidebar / End -->
</property-sidebar>