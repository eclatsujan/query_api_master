<?php get_header(); ?>
<div class="isLoading w-full .py-20 flex items-center">
    <div class="loader"></div>
</div>

<?php

$frontpage_id = get_option('page_on_front');


$args = array(
    'post_type' => 'page',
    'page_id' => $frontpage_id,   // id of the post you want to query
);
// The Query
$query1 = new WP_Query($args);

// The Loop
while ($query1->have_posts()) {
    $query1->the_post();
}
?>

<div id="paigSearch" class="cs_paig_theme hidden">
    <section class="search ">
        <div class="parallax" data-background="<?php echo get_the_post_thumbnail_url(); ?>" style="background:url(<?php echo get_the_post_thumbnail_url(); ?>);" data-color="#36383e" data-color-opacity="0.45" data-img-width="2500" data-img-height="1600">
            <div class="parallax-content">
                <?php echo do_shortcode("[paig_property_search]"); ?>
            </div>
        </div>

    </section>
</div>
<?php echo do_shortcode("[paig_property_listings]"); ?>

<?php get_footer(); ?>