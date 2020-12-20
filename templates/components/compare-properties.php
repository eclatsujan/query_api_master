<!-- Compare Properties Widget
================================================== -->
<div id="compareProperties" class="cs_paig_theme hidden">
    <compare-properties inline-template>
        <div v-bind:class="'compare-slide-menu '+getActiveClass()">
            <div class="csm-trigger" v-on:click="toggleActive()"></div>
            <div class="csm-content">
                <h4>Saved Properties <div class="csm-mobile-trigger" v-on:click="toggleActive()"></div>
                </h4>
                <div class="csm-properties" v-if="savedItems.length > 0">
                    <!-- Property -->
                    <div v-for="savedItem in  savedItems" class="listing-item compact">
                        <div class="listing-img-container">
                        <div class="remove-from-compare cursor-pointer" v-on:click="removeProperty(savedItem)">
                            <i class="fas fa-times"></i>
                        </div>
                        <a v-bind:href="'/properties/detail/'+savedItem.display_id" class="" target="_blank">
                            <div class="listing-badges">
                                <span>{{savedItem.status}}</span>
                            </div>
                            <div class="listing-img-content">
                                <span class="listing-compact-title">{{savedItem.title}} <i>{{formatPropertyPrice(savedItem.from_price)}} </i></span>
                            </div>
                            <img v-bind:src="savedItem.images[0]" alt="" class="compare-images">
                        </a>
                        </div>
                    </div>
                    <!-- Property end -->
                </div>
                <div class="csm-properties" v-else>
                    <div class="listing-item1 compact p-10">
                        <div class="notification notice closeable">No properties in the favourite lists</div>
                    </div>
                </div>
                <div class="csm-buttons">
                    <a href="compare-properties.html" class="button invisible">Compare</a>
                    <a v-on:click="resetFavouriteListings" class="button reset">Reset</a>
                </div>
            </div>
        </div>
    </compare-properties>

</div>
<!-- Compare Properties Widget / End -->