<!-- Titlebar ================================================== -->


<titlebar v-bind:property="singleProperty" v-bind:suburb="singleProperty.suburb" v-bind:state="singleProperty.state" v-bind:postcode="singleProperty.postcode" v-bind:name="singleProperty.title" v-bind:status="singleProperty.status" v-bind:property_price="singleProperty.price" v-bind:address="singleProperty.address" v-bind:parent_property_id="singleProperty.parent_property_id" v-bind:from_price="singleProperty.from_price" inline-template>
	
	<div class="property-titlebar margin-bottom-0" id="titlebar">
		<div class="container">
			<div class="row">
				<div class="col-md-12">


					<div class="title-section flex flex-wrap justify-between items-center">

						<div class="property-title w-full md:w-2/3">
							<div class="flex flex-wrap">
								<div class="back-btn" v-if="property.parent_property_id !== '0'" >
									<span >
										<a v-bind:href="generateURL('/properties/detail/'+property.parent_property_data.display_id)" class="back-to-listings"></a>
									</span>
									
								</div>
								<div class="title-address flex-1">
									<h2>{{name}}
										<span class="property-badge with-tip">{{status}}
											<span v-if="property.property_type!=='Project'&&property.status==='Sold'">
												{{property.completion_date}}
											</span>
										</span>
									</h2>
									<span>
										<a v-bind:href="getMapFullAddress(property)" class="listing-address" target="#">
											<i class="fas fa-map-marker-alt"></i>
											{{getFullAddress(property)}}
										</a>
									</span>
								</div>

							</div>



						</div>

						<div class="property-pricing ">
							<div class="property-price" v-if="property.display_price_text !==''">
                                <span><p class="display-price">{{property.display_price_text}}</p></span>
							</div>
                            <div class="property-price" v-else>
								<span v-if='property.parent_property_id == "0"'>FROM</span>
                                {{formatPrice(property.from_price)}}
							</div>

						</div>
					</div>

				</div>
			</div>
		</div>
	</div>
</titlebar>