<div class="isLoading py-24 flex items-center">
    <div class="loader"></div>
</div>
<div id="paigApp" class="cs_paig_theme hidden">
    <properties-carousel inline-template>
        <div class="container py-24" v-if="properties.length>0&&!isLoading">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="headline margin-bottom-25">Newly Added</h3>
                </div>
                <div class="col-md-12">
                    <div v-if="isLoading">
                        <div class="container my4">
                            <div class="loader mx-auto"></div>
                        </div>
                    </div>
                    <div class="carousel">
                        <div class="carousel-item" v-for="property in properties">
                            <div>
                                <div class="relative">
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
                                            <a v-bind:href="'/properties/detail/'+property.display_id"
                                               class="listing-img-content block" target="_blank">
                                                <div class="price text-bold">
                                                    <span class="listing-price" v-if="property.display_price_text!==''">
                                                            <span>{{property.display_price_text}}</span>
                                                    </span>
                                                    <span class="listing-price" v-else>
                                                            <span v-if="property.parent_property_id == '0'">FROM</span>
                                                            <span>{{formatPropertyPrice(property.from_price)}}</span>
                                                    </span>
                                                </div>
                                            </a>
                                            <div class="icon-block absolute z-99 bottom-0 right-0  flex flex-wrap items-center">
                                                <span v-bind:class="'like-icon with-tip  cursor-pointer '+isSaved(property.display_id)"
                                                      data-tip-content="Add to Bookmarks"
                                                      v-on:click="saveProperty(property)"></span>
                                                <span class="compare-button with-tip hidden"
                                                      data-tip-content="Add to Compare"></span>
                                            </div>
                                        </div>
                                    </div>


                                </div>


                                <div class="listing-content">
                                    <div class="listing-title">
                                        <h4>
                                            <a v-bind:href="generateURL('/properties/detail/'+property.display_id)"
                                               target="_blank">
                                                {{property.title}}
                                            </a>
                                        </h4>
                                        <div>
                                            <i class="fas fa-map-marker-alt"></i>
                                            <span>{{property.address}}</span>
                                        </div>
                                    </div>
                                    <ul class="listing-features flex">
                                        <li class="block">Property Id <span>{{property.display_id}}</span></li>
                                        <li class="block">Property Type <span>{{property.property_type}}</span></li>
                                        <li class="block">Strategy Type <span>{{property.strategy_type}}</span></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </properties-carousel>
</div>