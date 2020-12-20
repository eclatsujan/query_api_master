<listing-table v-bind:all_lists="singleProperty.lists" v-bind:strategy_type="singleProperty.strategy_type" inline-template>
    <div class="row py-10 md:py-20" v-if="strategy_type == 'New Land Estates'">
        <div class="col-md-12">
            <h3 class="desc-headline no-border">Property Listings</h3>
        </div>
        <div class="col-md-12">
            <table class="table table-striped table-bordered" data-show-toggle="false" data-cascade="true"  data-sorting="true" style="width:100%">
                <thead>
                    <tr>
                        <th data-breakpoints="sm">Property Type</th>
                        <th data-breakpoints="sm" data-sorted="true">Lot No</th>
                        <th data-breakpoints="sm"><i class="fas fa-bed"></i></th>
                        <th data-breakpoints="sm"><i class="fas fa-shower"></i></th>
                        <th data-breakpoints="sm"><i class="fas fa-car"></i></th>
                        <th data-breakpoints="sm">Land Area</th>
                        <th data-breakpoints="sm">Length Land</th>
                        <th data-breakpoints="sm">Width Land</th>
                        <th data-breakpoints="sm">Total Floor Area</th>
                        <th data-breakpoints="sm">Land Price</th>
                        <th data-breakpoints="sm">Build Price</th>
                        <th data-breakpoints="sm">Total Price</th>
                        <th data-breakpoints="sm">Status</th>

                    </tr>
                </thead>
                <tbody>

                    <tr v-for="list in all_lists" data-expanded="true">
                        <td>
                            <span v-if="list.property_type!==''">{{list.property_type}} </span>

                        </td>
                        <td>
                            <span v-if="list.address!==''">
                                <a v-bind:href="generateURL('/properties/detail/'+list.display_id)" target="_self">{{displayFirstTwoWords(list.address)}} </a></span>

                        </td>
                        <td>
                            <span v-if="list.bedroom!==''">{{list.bedroom}} </span>

                        </td>
                        <td><span v-if="list.bathroom!==''">{{list.bathroom}} </span></td>
                        <td><span v-if="list.garage!==''">{{list.garage}} </span> </td>
                        <td> <span v-if="list.land_area!==''">{{list.land_area}} </span><span v-if="list.land_area_metric !== ''">m<sup>2</sup></span></td>
                        <td>
                            <span v-if="list.land_length!==''">{{list.land_length}} </span>
                            <span v-if="list.land_length_metric !== ''">{{getShortMetricText(list.land_length_metric)}}</span>
                        </td>
                        <td>
                            <span v-if="list.land_width!==''">{{list.land_width}} </span>
                            <span v-if="list.land_width_metric!==''">{{getShortMetricText(list.land_width_metric)}}</span>

                        </td>
                        <td> <span v-if="list.floor_area!==''">{{list.floor_area}} </span><span v-if="list.floor_area_metric !== ''">m<sup>2</sup></span></td>
                        <td> <span v-if="list.land_price!==''">{{formatPrice(list.land_price)}} </span></td>
                        <td> <span v-if="list.build_price!==''">{{formatPrice(list.build_price)}} </span></td>
                        <td>
                            <span v-if="list.display_price_text!==''">{{formatPrice(list.display_price_text)}} </span>
                            <span v-else-if="list.from_price!==''">{{formatPrice(list.from_price)}} </span>
                        </td><!-- data conf -->
                        <td class="relative">
                            <span v-if="list.status!==''" class="with-tip">
                                <p v-bind:class="getStatusClassName(list.status)">
                                    <a v-bind:href="generateURL('/properties/detail/'+list.display_id)" target="_self">{{list.status}}</a></p>
                                <div class="tip-content bg-theme-color" v-if="list.paig_status !=='' || list.other_status !== '' || list.land_reg_date !== '' || list.completion_date !== ''">
                                    <p class="text-left" v-if="list.paig_status!==''"><span class="bold">Paig Property Status: </span>{{list.paig_status}}</p>
                                    <p class="text-left" v-if="list.other_status!==''"><span class="bold">Other Status: </span>{{list.other_status}}</p>
                                    <p class="text-left" v-if="list.land_reg_date!==''"><span class="bold">Land Reg Date: </span>{{list.land_reg_date}}</p>
                                    <p class="text-left" v-if="list.completion_date!==''"><span class="bold">Completion Date: </span>{{list.completion_date}}</p>
                                </div>
                            </span>
                        </td>
                    </tr>

                </tbody>

            </table>

        </div>
    </div>
    <div class="row py-20" v-else>
        <div class="col-md-12">
            <h3 class="desc-headline no-border">Property Listings</h3>
        </div>
        <div class="col-md-12">
            <table class="table table-striped table-bordered" data-show-toggle="false" data-cascade="true"   data-sorting="true" style="width:100%">
                <thead>
                    <tr>
                        <th data-breakpoints="sm">Property Type</th>
                        <th data-breakpoints="sm">Lot No</th>
                        <th data-breakpoints="sm"><i class="fas fa-bed"></i></th>
                        <th data-breakpoints="sm"><i class="fas fa-shower"></i></th>
                        <th data-breakpoints="sm"><i class="fas fa-car"></i></th>
                        <th data-breakpoints="sm">Land Area</th>
                        <th data-breakpoints="sm">Int Area</th>
                        <th data-breakpoints="sm">Ext Area</th>
                        <th data-breakpoints="sm">Total Floor Area</th>
                        <th data-breakpoints="sm">Land Price</th>
                        <th data-breakpoints="sm">Build Price</th>
                        <th data-breakpoints="sm">Total Price</th>
                        <th data-breakpoints="sm">Status</th>

                    </tr>
                </thead>
                <tbody>
                    <tr v-for="list in all_lists" data-expanded="true">
                        <td><span v-if="list.property_type!==''">{{list.property_type}} </span></td>
                        <td><span v-if="list.address!==''"><a v-bind:href="generateURL('/properties/detail/'+list.display_id)" target="_self">{{displayFirstTwoWords(list.address)}} </a></span></td>
                        <td><span v-if="list.bedroom!==''">{{list.bedroom}} </span></td>
                        <td><span v-if="list.bathroom!==''">{{list.bathroom}} </span></td>
                        <td><span v-if="list.garage!==''">{{list.garage}} </span> </td>
                        <td> <span v-if="list.land_area!==''">{{list.land_area}} </span><span v-if="list.land_area_metric !== ''">m<sup>2</sup></span></td>
                        <td>
                            <!-- <span v-if="list.land_length!==''">{{list.land_length}} </span>
                            <span v-if="list.land_length_metric === 'Metres'">m</span> -->
                        </td>
                        <td>
                            <!-- <span v-if="list.land_width!==''">{{list.land_width}} </span>
                            <span v-if="list.land_width_metric === 'Metres'">m</span> -->
                        </td>
                        <td> <span v-if="list.floor_area!==''">{{list.floor_area}} </span><span v-if="list.floor_area_metric !== ''">m<sup>2</sup></span></td>
                        <td> <span v-if="list.land_price!==''">{{formatPrice(list.land_price)}}</span></td>
                        <td> <span v-if="list.build_price!==''">{{formatPrice(list.build_price)}} </span></td>
                        <td>
                            <span v-if="list.display_price_text!==''">{{formatPrice(list.display_price_text)}} </span>
                            <span v-else-if="list.from_price!==''">{{formatPrice(list.from_price)}} </span>
                        </td>
                        <td class="relative">
                            <span v-if="list.status!==''" class="with-tip">
                                <p>
                                    <a v-bind:href="generateURL('/properties/detail/'+list.display_id)" v-bind:class="getStatusClassName(list.status)" target="_blank">{{list.status}}</a>
                                </p>
                                <div class="tip-content bg-theme-color" v-if="list.paig_status !=='' || list.other_status !== '' || list.land_reg_date !== '' || list.completion_date !== ''">
                                    <p class="text-left" v-if="list.paig_status!==''"><span class="bold">Paig Property Status: </span>{{list.paig_status}}</p>
                                    <p class="text-left" v-if="list.other_status!==''"><span class="bold">Other Status: </span>{{list.other_status}}</p>
                                    <p class="text-left" v-if="list.land_reg_date!==''"><span class="bold">Land Reg Date: </span>{{list.land_reg_date}}</p>
                                    <p class="text-left" v-if="list.completion_date!==''"><span class="bold">Completion Date: </span>{{list.completion_date}}</p>
                                </div>
                            </span>
                        </td>
                    </tr>

                </tbody>

            </table>

        </div>
    </div>



</listing-table>