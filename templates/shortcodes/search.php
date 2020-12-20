<div class="isLoading py-20">
    <div class="loader"></div>
</div>
<div id="paigSearch" class="cs_paig_theme hidden">
    <searchbar search_url="<?php echo \PAIG\Common\Helper::getSearchRoute(); ?>" inline-template>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <!-- Main Search Container -->
                    <div class="main-search-container">

                        <!-- Main Search -->
                        <form class="main-search-form" method="GET">
                            <!-- Type -->
                            <div class="search-type hidden-xs">
                                <label class="active">
                                    <input v-model="status" class="first-tab" value="sale" name="tab" checked="checked"
                                           type="radio">
                                    For Sale
                                </label>
                                <label>
                                    <input name="tab" value="lease" type="radio" v-model="status">For
                                    Lease
                                </label>
                                <label>
                                    <input name="tab" value="sold" type="radio" v-model="status">Sold
                                </label>
                                <label>
                                    <input name="tab" value="leased" type="radio" v-model="status">Leased
                                </label>
                                <div class="search-type-arrow" style="left:30.5px;"></div>
                            </div>

                            <!-- Box -->
                            <div class="main-search-box flex flex-wrap items-end">
                                <div class="main-search-input larger-input w-5/6 order-none mb-0">
                                    <div class="relative flex-1">
                                        <label for="autocomplete-input" class="text-left w-full text-bold">Search by Property ID or
                                            Keyword</label>
                                        <input name="search_keyword"
                                               v-model="keyword"
                                               @input="suggestKeyword"
                                               type="text"
                                               class="ico-01 mb-0 search_keyword"
                                               id="autocomplete-input"
                                               placeholder="Enter suburb or Post Code or State or Property ID or Keyword"
                                               value=""
                                               autocomplete="new-password"/>

                                        <div v-if="displaySuggestionBox == true"
                                             class="suggestion-block absolute bg-gray-100 z-50 w-2/3 rounded"
                                             style="top:90px;">
                                            <ul class="suggest-list list-none pl-0">
                                                <li v-for="search_keyword in suggestedList"
                                                    @click="changeKeywordState(search_keyword)" class="py-3 px-5">
                                                    {{search_keyword}}
                                                </li>
                                            </ul>

                                        </div>
                                    </div>


                                </div>
                                <button class="button flex-1 order-1 md:order-none" v-on:click="search">Search</button>
                                <!-- Row -->
                                <div class="flex flex-wrap w-full -mx-2 with-forms order-none my-6">
                                    <!-- Strategy Type -->
                                    <div class="w-full md:w-2/6 px-2">
                                        <label for="strategy_type" class="text-left ml-0 text-bold w-full">Strategy
                                            Type</label>
                                        <v-select
                                                ref="strategy_select"
                                                placeholder="All"
                                                label="All"
                                                class="strategy-type-select"
                                                :options="strategy_types"
                                                :searchable="false"
                                                :selectable="option => ! strategy_type.includes(option)"
                                                v-model="strategy_type"
                                                multiple>
                                        </v-select>
                                    </div>
                                    <!-- Property Type -->
                                    <div class="w-full md:w-2/6 px-2">
                                        <label for="property_type" class="text-left ml-0 text-bold w-full">Property
                                            Type</label>
                                        <v-select
                                                ref="property_select"
                                                placeholder="All"
                                                label="All"
                                                class="strategy-type-select"
                                                :options="property_types"
                                                :searchable="false"
                                                :selectable="option => ! property_type.includes(option)"
                                                @click="()=>{console.log('ok')}"
                                                v-model="property_type"
                                                multiple>
                                        </v-select>
                                    </div>

                                    <!-- Min Price -->
                                    <div class="w-full md:w-1/6 px-2 hidden-xs">
                                        <div class="form-group md:block">
                                            <label for="min_price" class="text-left ml-0 text-bold w-full">Minimum
                                                Price</label>
                                            <v-select
                                                    ref="min_price_select"
                                                    placeholder="Min Price"
                                                    :options="defaultPrices"
                                                    :clearable="true"
                                                    :searchable="false"
                                                    :value="''"
                                                    v-model="min_price">
                                                <template v-slot:option="option">
                                                    {{ formatPrice(option.label) }}
                                                </template>
                                            </v-select>
                                            <!-- Select Input / End -->
                                        </div>
                                    </div>
                                    <!-- Max Price -->
                                    <div class="w-full md:w-1/6 px-2 hidden-xs">
                                        <label for="max_price" class="text-left ml-0 text-bold w-full">Maximum Price</label>
                                        <v-select
                                                ref="max_price_select"
                                                placeholder="Max Price"
                                                :options="defaultPrices"
                                                :searchable="false"
                                                v-model="max_price">
                                            <template v-slot:option="option">
                                                {{ formatPrice(option.label) }}
                                            </template>
                                        </v-select>
                                        <!-- Select Input / End -->
                                    </div>

                                    <!--   builder type filter-->
                                    <div class="w-full md:w-2/6 px-2"  v-if="displayDeveloperFilter === '1'">
                                        <label for="builder_select" class="text-left ml-0 text-bold w-full  pt-6">Filter By Builders</label>
                                        <v-select
                                                ref="builder_select"
                                                placeholder="All Builders"
                                                label="All"
                                                class="strategy-type-select w-full w-1/6"
                                                :options="buildContractDevelopers"
                                                :selectable="option => ! business_name.includes(option)"
                                                :searchable="true"
                                                v-model="business_name"
                                                multiple>
                                        </v-select>
                                    </div>
                                    <!-- end builder type filter-->

                                    <!-- min area filter -->
                                    <div class="w-full md:w-2/6 lg:w-2/6 px-2" v-if="displayAreaFilter==='1'">
                                        <label for="min_floor_area" class="text-left ml-0 text-bold w-full  pt-6">Min Floor Area (m2)</label>
                                        <v-select
                                                ref="min_floor_area"
                                                placeholder="Min Floor Area"
                                                class="min-floor-area-select w-full w-1/6"
                                                :options="areaOptions"
                                                v-model="min_floor_area"
                                                >
                                            <template v-slot:option="option">
                                                {{ option.label }} m<sup>2</sup>
                                            </template>
                                        </v-select>
                                    </div>
                                    <!-- max area filter -->

                                    <!-- min area filter -->
                                    <div class="w-full md:w-2/6 lg:w-2/6 px-2" v-if="displayAreaFilter==='1'">
                                        <label for="max_floor_area" class="text-left ml-0 text-bold w-full  pt-6">Max Floor Area (m2)</label>
                                        <v-select
                                                ref="max_floor_area"
                                                placeholder="Max Floor Area"
                                                class="max-floor-area-select w-full w-1/6"
                                                :options="areaOptions"
                                                v-model="max_floor_area"
                                        >
                                            <template v-slot:option="option">
                                                {{ option.label }} m<sup>2</sup>
                                            </template>
                                        </v-select>
                                    </div>
                                    <!-- max area filter -->


                                    <div class="w-full md:hidden hidden-xs">
                                        <label for="status" class="text-left ml-0 text-bold w-full">Select Status</label>
                                        <!-- Main Search Input -->
                                        <select class="form-control" name="purpose" id="status" v-model="status">
                                            <option value=" " selected>Select Status</option>
                                            <option value="sale">For Sale</option>
                                            <option value="lease">Lease</option>
                                            <option value="sold">Sold</option>
                                            <option value="leased">Leased</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="more-options-mobile block md:hidden w-100 pb-10">
                                    <!-- More Search Options -->
                                    <a class="refine-btn theme-color md:hidden w-100"
                                       v-on:click="toggleRefine">
                                      <i v-bind:class="'fa '+getRefineClass()"></i>  Refine
                                    </a>

                                    <div v-show="showRefine" >
                                        <div class="more-search-options-container">
                                            <!-- Min Price -->
                                            <div class="w-full md:w-1/6 px-2">
                                                <div class="form-group md:block">
                                                    <label for="min_price" class="text-left ml-0 text-bold w-full">Minimum
                                                        Price</label>

                                                    <select v-model="min_price" id="min_price" data-unit="AUD">
                                                        <option value="" selected>
                                                            Any
                                                        </option>
                                                        <option :value="price" v-for="price in defaultPrices">
                                                            {{formatPrice(price)}}
                                                        </option>
                                                    </select>
                                                    <!-- Select Input / End -->
                                                </div>
                                            </div>
                                            <!-- Max Price -->
                                            <div class="w-full md:w-1/6 px-2 ">
                                                <label for="max_price" class="text-left ml-0 text-bold w-full">Maximum
                                                    Price</label>
                                                <select v-model="max_price" id="max_price" data-unit="AUD">
                                                    <option value="" selected>
                                                        Any
                                                    </option>
                                                    <option :value="price" v-for="price in defaultPrices">
                                                        {{formatPrice(price)}}
                                                    </option>
                                                </select>

                                                <!-- Select Input / End -->
                                            </div>
                                            <div class="w-full md:hidden ">
                                                <label for="status" class="text-left ml-0 text-bold w-full">Select
                                                    Status</label>
                                                <!-- Main Search Input -->
                                                <select class="form-control" name="purpose" id="status"
                                                        v-model="status">
                                                    <option value=" " selected>Select Status</option>
                                                    <option value="sale">For Sale</option>
                                                    <option value="lease">Lease</option>
                                                    <option value="sold">Sold</option>
                                                    <option value="leased">Leased</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- More Search Options -->
                                </div>

                                <!-- Row / End -->
                            </div>
                            <!-- Box / End -->
                        </form>
                        <!-- Main Search -->
                    </div>
                    <!-- Main Search Container / End -->
                </div>
            </div>
        </div>
    </searchbar>
</div>