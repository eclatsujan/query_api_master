<div id="paigApp" class="cs_paig_theme hidden py-24">
    <searchlistings inline-template>
        <div>
            <div class="container">
                <div class="row margin-bottom-15">

                    <div class="col-md-4">
                        <!-- Sort by -->
                        <div class="sort-by flex flex-wrap items-center">
                            <label class="mr-3">Sort by:</label>
                            <div class="sort-by-select">
                                <select v-model="sortOn">
                                    <option value="">Default Order</option>
                                    <option value="from_price|asc">Price Low to High</option>
                                    <option value="from_price|desc">Price High to Low</option>
                                    <option value="date_listed|desc">Newest Properties</option>
                                    <option value="date_listed|asc" selected>Oldest Properties</option>
                                </select>
                            </div>

                        </div>
                    </div>

                    <?php /* ?>
                    <div class="col-md-6" v-if="displayDeveloperFilter === '1'">
                        <!-- Sort by -->
                        <div class="sort-by flex flex-wrap items-center">
                            <label class="mr-3 ">Filter By Builders:</label>
                            <div class="sort-by-select flex-1">
                                <v-select
                                        ref="strategy_select"
                                        placeholder="All Builders"
                                        label="All"
                                        class="strategy-type-select w-full w-1/6"
                                        :options="buildContractDevelopers"
                                        :selectable="option => ! selectedDeveloper.includes(option)"
                                        :searchable="true"
                                        v-model="selectedDeveloper"
                                        multiple>
                                </v-select>
                            </div>

                        </div>
                    </div>
                    <?php */ ?>


                    <div class="col-md-6"></div>
                    <div class="col-md-2 pull-right">
                        <!-- Layout Switcher -->
                        <div class="layout-switcher">
                            <a href="#" class="list"
                               v-on:click="(e)=>{e.preventDefault();changeListClass('list-layout')}"><i
                                        class="fas fa-th-list"></i></a>
                            <a href="#" class="grid"
                               v-on:click="(e)=>{e.preventDefault();changeListClass('grid-layout')}"><i
                                        class="fas fa-th-large"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div v-if="isLoading">
                <div class="container my4 py-20">
                    <div class="loader mx-auto"></div>
                </div>
            </div>


            <div v-if="!isLoading" class="container">
                <div v-if="properties.length > 0" class="row fullwidth-layout">
                    <div class="col-md-12">
                        <!-- Sorting / Layout Switcher -->

                        <!-- Listings -->
                        <div v-bind:class="'listings-container flex flex-wrap '+list_class ">
                            <!-- Listing Item -->

                            <div v-for="property in properties" class="listing-item flex flex-wrap">

                                <div class="listing-img-container relative">
                                    <a v-bind:href="generateURL('/properties/detail/'+property.display_id)"
                                       class="relative block flow-hidden" target="_blank">
                                        <div>
                                            <span class="featured ribbon absolute z-10 theme-bg"
                                                  v-if="property.build_contract_pricing!==''">
                                                {{property.build_contract_pricing}}
                                            </span>
                                            <span class="absolute z-10 right-10 p-status theme-bg">{{property.status}}</span>

                                            <div class="listing-carousel">
                                                <div class="relative" v-for="image in property.attachments.photo">
                                                    <div class="absolute z-10 bg-black-o35 w-full h-full"></div>
                                                    <img v-bind:src="image" alt=""/>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                    <div class="absolute bottom-0 w-100 listing_price_block">
                                        <div class="relative">
                                            <a v-bind:href="generateURL('/properties/detail/'+property.display_id)"
                                               class="listing-img-content" target="_blank">
                                                <div class="price text-bold">
                                                    <span class="listing-price"
                                                          v-if="property.display_price_text !==''">
                                                        <span>{{property.display_price_text}}</span>
                                                    </span>
                                                    <span class="listing-price" v-else>
                                                        <span v-if="property.parent_property_id == '0'">FROM</span>
                                                        <span>{{formatPrice(property.from_price)}}</span>
                                                    </span>
                                                </div>
                                            </a>
                                            <div class="icon-block absolute z-99 bottom-0 right-0 flex flex-wrap items-center">
                                                <span v-bind:class="'like-icon with-tip  cursor-pointer '+isSaved(property.display_id)"
                                                      data-tip-content="Add to Bookmarks"
                                                      v-on:click="saveProperty(property)"></span>
                                                <span class="compare-button with-tip hidden"
                                                      data-tip-content="Add to Compare"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="listing-content flex flex-wrap  w-full">
                                    <div class="listing-title">
                                        <h4>
                                            <a v-bind:href="generateURL('/properties/detail/'+property.display_id)"
                                               target="_blank">{{property.title}}</a>
                                        </h4>
                                        <a v-bind:href="getMapFullAddress(property)" target="_blank"
                                           class="listing-address popup-gmaps">
                                            <i class="fas fa-map-marker-alt"></i>
                                            {{getFullAddress(property)}}
                                        </a>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <p class="mb0">
                                                    <span>Property ID:</span>
                                                    <span>{{property.display_id}}</span>
                                                </p>
                                                <p class="mb0">
                                                    <span v-if="property.bedroom!==''">
                                                        <i class="fas fa-bed"></i> {{property["bedroom"]}}
                                                    </span>
                                                    <span v-if="property.bathroom!==''">
                                                        <i class="fas fa-bath"></i> {{property["bathroom"]}}
                                                    </span>
                                                    <span v-if="property.garage!==''">
                                                        <i class="fas fa-car"></i> {{property["garage"]}}
                                                    </span>
                                                </p>
                                            </div>
                                            <div class="col-md-12">
                                                <p class="mb0" v-if="property.land_area!==''">
                                                    <span>Land Area:</span>
                                                    <span>{{property["land_area"]}} </span> <span
                                                            v-html="getShortMetricText(property['land_area_metric'])"></span>
                                                </p>
                                                <p class="mb0" v-if="property.floor_area!==''">
                                                    <span>Total Floor Area:</span>
                                                    <span>{{property["floor_area"]}}</span><span
                                                            v-html="getShortMetricText(property['floor_area_metric'])"></span>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <ul class="listing-details self-end">
                                        <li class="block"><span>Strategy Type: </span><span>{{property["strategy_type"]}}</span>
                                        </li>
                                        <li class="block"><span>Property Type: </span><span>{{property["property_type"]}}</span>
                                        </li>
                                    </ul>
                                </div>

                            </div>
                            <!-- Listing Item / End -->
                        </div>
                        <!-- Listings Container / End -->


                        <div class="clearfix"></div>

                        <div>
                            <!-- Pagination -->
                            <?php load_template(PAIG_API_PLUGIN_TEMPLATE."components/pagination.php", true); ?>
                            <!-- Pagination / End -->
                        </div>

                    </div>

                </div>

                <div v-else class="row m-h-300">
                    <h1 class="text-center">Sorry ! Property Not Found</h1>
                </div>


            </div>
        </div>
    </searchlistings>
</div>