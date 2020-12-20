<property-description v-bind:prop_desc="singleProperty" inline-template>

    <div class="property-description">
        <!-- Main Features -->
        <ul class="property-main-features" v-if="prop_desc.land_area !== '' || prop_desc.bedroom !=='' ||  prop_desc.bathroom !=='' || prop_desc.garage !=='' ">

            <li v-if="prop_desc.land_area!==''">Land Area <span v-html="prop_desc.land_area+''+getShortMetricText(prop_desc.land_area_metric)"></span></li>

            <li v-if="prop_desc.bedroom !==''"><i class="fas fa-bed"></i> <span>{{prop_desc.bedroom}}</span></li>
            <li v-if="prop_desc.bathroom !==''"><i class="fas fa-shower"></i> <span>{{prop_desc.bathroom}}</span></li>
            <li v-if="prop_desc.garage !==''"><i class="fas fa-car"></i> <span>{{prop_desc.garage}}</span></li>
        </ul>
        <!-- Description -->
        <h3 class="desc-headline">Property Description </h3>
        <div class="show-more-1">
            <div v-html="prop_desc.description"></div>
            <!-- <a href="#" class="show-more-button ">Show More <i class="fa fa-angle-down"></i></a> -->
        </div>
        <!-- Details -->
        <h3 class="desc-headline">Property Data</h3>



        <ul class="fa-ul property-features checkboxes color margin-top-0">
            <li v-if="prop_desc.strategy_type!==''"><i class="fa-li fas fa-check-square "></i>Strategy Type: <span class="block md:inline-block">{{prop_desc.strategy_type}}</span></li>
            <li v-if="prop_desc.property_type!==''"><i class="fa-li fas fa-check-square "></i>Property Type: <span class="block md:inline-block">{{prop_desc.property_type}}</span></li>
            <li v-if="prop_desc.storey_type!==''"><i class="fa-li fas fa-check-square "></i>Storey Type: <span class="block md:inline-block ">{{prop_desc.storey_type}}</span></li>
            <li v-if="prop_desc.estimate_rental_return !==''"><i class="fa-li fas fa-check-square "></i>Estimated Rent: <span class="block md:inline-block ">$ {{prop_desc.estimate_rental_return}}</span></li>
            <li v-if="prop_desc.land_area!==''"><i class="fa-li fas fa-check-square "></i>Land Area: <span class="block md:inline-block" v-html="prop_desc.land_area+''+getShortMetricText(prop_desc.land_area_metric)"></span></li>
            <li v-if="prop_desc.land_width!==''"><i class="fa-li fas fa-check-square "></i>Width Land: <span class="block md:inline-block">{{prop_desc.land_width}} {{getShortMetricText(prop_desc.land_width_metric)}}</span></li>
            <li v-if="prop_desc.land_length!==''"><i class="fa-li fas fa-check-square "></i>Length Land: <span class="block md:inline-block ">{{prop_desc.land_length}} {{getShortMetricText(prop_desc.land_length_metric)}}</span></li>
            <li v-if="prop_desc.orientation!==''"><i class="fa-li fas fa-check-square "></i>Orientation Type: <span class="block md:inline-block ">{{prop_desc.orientation}}</span></li>
            <li v-if="prop_desc.land_reg_date!==''"><i class="fa-li fas fa-check-square "></i>Land Reg. Date: <span class="block md:inline-block ">{{prop_desc.land_reg_date}}</span></li>
            <li v-if="prop_desc.land_price!==''"><i class="fa-li fas fa-check-square "></i>Land Price: <span class="block md:inline-block ">{{formatPropertyPrice(prop_desc.land_price)}}</span></li>

            <!-- <li v-if="prop_desc.land_price!==''">Total Land Price: <span>{{prop_desc.land_price}}</span></li> -->
            <li v-if="prop_desc.build_price!==''"><i class="fa-li fas fa-check-square "></i>Total Build Price: <span class="block md:inline-block ">{{formatPropertyPrice(prop_desc.build_price)}}</span></li>
<!--            <li v-if="prop_desc.developer!==''"><i class="fa-li fas fa-check-square "></i>Developer: <span class="block md:inline-block  ">{{prop_desc.developer}}</span></li>-->
<!--            <li v-if="prop_desc.developer_land!==''"><i class="fa-li fas fa-check-square "></i>Developer Land Only: <span class="block md:inline-block ">{{prop_desc.developer_land}}</span></li>-->
           
            <li v-if="prop_desc.date_listed!==''"><i class="fa-li fas fa-check-square "></i>Date Listed: <span class="block md:inline-block">{{getDatePattern(prop_desc.date_listed)}}</span></li>
            <li v-if="prop_desc.floor_area!==''"><i class="fa-li fas fa-check-square "></i>
                Total Floor Area:

                <span v-html="prop_desc.floor_area+''+getShortMetricText(prop_desc.floor_area_metric)" class="block md:inline-block"></span>

            </li>
            <li v-if="prop_desc.property_id!==''"><i class="fa-li fas fa-check-square "></i>Property ID: <span class="block md:inline-block ">{{prop_desc.display_id}}</span></li>
            <li v-if="prop_desc.build_length!==''"><i class="fa-li fas fa-check-square "></i>Length Build: <span class="block md:inline-block">{{prop_desc.build_length}} {{getShortMetricText(prop_desc.build_length_metric)}}</span></li>
            <li v-if="prop_desc.build_width!==''"><i class="fa-li fas fa-check-square "></i>Width Build: <span class="block md:inline-block ">{{prop_desc.build_width}} {{getShortMetricText(prop_desc.build_width_metric)}}</span></li>
            <li v-if="prop_desc.yield_gross!==''"><i class="fa-li fas fa-check-square "></i>Yield Gross: <span class="block md:inline-block">{{prop_desc.yield_gross}} %</span></li>
            <li v-if="prop_desc.build_contract_type!==''"><i class="fa-li fas fa-check-square "></i>Build Contract Type: <span class="block md:inline-block ">{{prop_desc.build_contract_type}}</span></li>
            <li v-if="prop_desc.build_contract_upgrade!==''"><i class="fa-li fas fa-check-square "></i>Build Contract Upgrade: <span class="block md:inline-block ">{{prop_desc.build_contract_upgrade}}</span></li>
            <!-- <li v-if="prop_desc.strata_title!==''">Title Type: <span>{{prop_desc.strata_title}}</span></li> -->
            <li v-if="prop_desc.contract_type!==''"><i class="fa-li fas fa-check-square "></i>Contract Type: <span class="block md:inline-block ">{{prop_desc.contract_type}}</span></li>
            <li v-if="prop_desc.tax_rate!==''"><i class="fa-li fas fa-check-square "></i>Council Rates: <span class="block md:inline-block ">{{prop_desc.tax_rate}}</span></li>
            <li v-if="prop_desc.water_rate!==''"><i class="fa-li fas fa-check-square "></i>Water Rates: <span class="block md:inline-block ">{{prop_desc.water_rate}}</span></li>
            <li v-if="prop_desc.condo_strata_fee!==''"><i class="fa-li fas fa-check-square "></i>Strata Rates: <span class="block md:inline-block ">{{prop_desc.condo_strata_fee}}</span></li>
<!--            <li v-if="prop_desc.builder_wholesale !==''"><i class="fa-li fas fa-check-square "></i>Builder Wholesale: <span class="block md:inline-block ">{{prop_desc.builder_wholesale}}</span></li>-->
<!--            <li v-if="prop_desc.builder_retail!==''"><i class="fa-li fas fa-check-square "></i>Builder Retail: <span class="block md:inline-block ">{{prop_desc.builder_retail}}</span></li>-->
<!--            <li v-if="prop_desc.builder_aggregator!==''"><i class="fa-li fas fa-check-square "></i>Builder Aggregator: <span class="block md:inline-block ">{{prop_desc.builder_aggregator}}</span></li>-->
<!--            <li v-if="prop_desc.investor_name!==''"><i class="fa-li fas fa-check-square "></i>Investors: <span class="block md:inline-block ">{{prop_desc.investor_name}}</span></li>-->
            <li v-if="prop_desc.build_price!==''"><i class="fa-li fas fa-check-square "></i>Build Price: <span class="block md:inline-block ">{{formatPropertyPrice(prop_desc.build_price)}}</span></li>
            <!-- <li v-if="prop_desc.floor_area!==''">Internal Area : <span>{{prop_desc.floor_area}}</span></li> -->
            <!-- <li v-if="prop_desc.land_area!==''">External Area : <span></span></li> -->
            <li v-if="prop_desc.acquisition_type!==''"><i class="fa-li fas fa-check-square "></i>Acquisition Type: <span class="block md:inline-block ">{{prop_desc.acquisition_type}}</span></li>
            <li v-if="prop_desc.completion_date!==''"><i class="fa-li fas fa-check-square "></i>Completion Date: <span class="block md:inline-block ">{{prop_desc.completion_date}}</span></li>
            <li v-if="prop_desc.min_width_land!==''"><i class="fa-li fas fa-check-square "></i>Min Width Land Req:

                <span class="block md:inline-block ">{{prop_desc.min_width_land}} {{getShortMetricText(prop_desc.min_width_land_metric)}}</span>
            </li>
            <li v-if="prop_desc.min_length_land!==''"><i class="fa-li fas fa-check-square "></i>
                Min Length Land Req:
                <span class="block md:inline-block">{{prop_desc.min_length_land}} {{getShortMetricText(prop_desc.min_length_land_metric)}}</span></li>
            <li v-if="prop_desc.deposit!==''"><i class="fa-li fas fa-check-square "></i>Deposit: <span class="block md:inline-block">{{prop_desc.deposit}}</span></li>
        </ul>
        <!-- Features -->
        <!--
        <h3 class="desc-headline">Property Features</h3>
        <ul class="property-features checkboxes margin-top-0">
            <li>Air Conditioning</li>
            <li>Swimming Pool</li>
            <li>Central Heating</li>
            <li>Laundry Room</li>
            <li>Gym</li>
            <li>Alarm</li>
            <li>Window Covering</li>
            <li>Internet</li>
        </ul> -->
        <hr />


        <div class="row print-hide py-10">
            <div class="col-md-4" v-if="prop_desc.attachments.floorplan.length > 0 ">
                <h3 class="desc-headline no-border">
                    <span v-if="prop_desc.property_type !== 'Project'">Floor Plan</span>
                    <span v-else>Estate Plan</span>
                </h3>
                <ul class="fa-ul file-list color">
                    <li v-for="fp in prop_desc.attachments.floorplan">
                        <a v-if="fp!==''" v-bind:href="fp" target="_blank">
                            <i v-bind:class="'fa-li fa '+renderIconClass(fp)"></i>
                            {{extractFileName(fp)}}
                        </a>
                    </li>
                </ul>
            </div>
            <div class="col-md-4" v-if="prop_desc.attachments.inclusion.length > 0">
                <h3 class="desc-headline no-border">
                    <span v-if="prop_desc.property_type !== 'Project'"> Inclustion List</span>
                    <span v-else>Estate Brochure</span>
                </h3>
                <ul class="fa-ul file-list color">
                    <li v-for="incl in prop_desc.attachments.inclusion">
                        <a v-if="incl!==''" v-bind:href="incl" target="_blank">
                            <i v-bind:class="'fa-li fa '+renderIconClass(incl)"></i>
                            {{extractFileName(incl)}}
                        </a>
                    </li>
                </ul>
            </div>
            <div class="col-md-4" v-if="prop_desc.attachments.documents.length > 0">
                <h3 class="desc-headline no-border">
                    <span v-if="prop_desc.property_type !== 'Project'"> Documents</span>
                    <span v-else>Other Documents</span>
                </h3>
                <ul class="fa-ul file-list color">
                    <li v-for="doc in prop_desc.attachments.documents">
                        <a v-if="doc!==''" v-bind:href="doc" target="_blank">
                            <i v-bind:class="'fa-li fa '+renderIconClass(doc)"></i>
                            {{extractFileName(doc)}}
                        </a>
                    </li>
                </ul>
            </div>
            <div class="col-md-12" v-if="prop_desc.attachments.house_land_documents.length > 0">
                <h3 class="desc-headline no-border">
                    House and Land Brochures
                </h3>
                <ul class="fa-ul file-list color">
                    <li v-for="doc in prop_desc.attachments.house_land_documents">
                        <a v-if="doc!==''" v-bind:href="doc" target="_blank">
                            <i v-bind:class="'fa-li fa '+renderIconClass(doc)"></i>
                            {{extractFileName(doc)}}
                        </a>
                    </li>
                </ul>
            </div>
        </div>



        

        <div class="row">
            <div class="col-md-12">



                <!-- Video -->
                <!--
        <h3 class="desc-headline no-border">Video</h3>
        <div class="responsive-iframe">
            <iframe width="560" height="315" src="https://www.youtube-nocookie.com/embed/UPBJKppEXoQ?rel=0&amp;showinfo=0" frameborder="0" allowfullscreen></iframe>
        </div>
            -->
                <!-- Location 
                <h3 class="desc-headline no-border" id="location">Location</h3>

                
        <div id="propertyMap-container">
            <div id="propertyMap" data-latitude="40.7427837" data-longitude="-73.11445617675781"></div>
            <a href="#" id="streetView">Street View</a>
        </div>
        <div id="mapid" style="height:350px;"></div>
            -->
        


            </div>
        </div>

    
    </div>
</property-description>