<!-- Content
================================================== -->
<carousel  v-bind:single_images="singleImages" v-if="singleImages.length>0" inline-template>
	<div class="container">
		<div class="row margin-bottom-50">
			<div class="col-md-12">
				<!-- just for print -->
			<img v-bind:src="single_images[0]" class="hidden print-show"/>
				<!-- Slider -->
				<div class="property-slider default">
				

					<a v-for="single_image in single_images" v-bind:href="single_image" v-bind:style="{ 'background-image': 'url(' + single_image + ')' }" class="item mfp-gallery">
					</a>
					
				</div>

				<!-- Slider Thumbs -->
				<div class="property-slider-nav">
					<div class="item" v-for="single_image in single_images"><img v-bind:src="single_image" alt=""></div>
				</div>

			</div>
		</div>
	</div>
</carousel>