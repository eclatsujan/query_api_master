<?php
// $color =  get_theme_mod();
use PAIG\Common\Option;

$color = Option::getValue("theme_color");
$theme_color = $color ? $color : "#5caee2";

//  $theme_color = "#a8d69d";
?>

<style>
    /* ------------------------------------------------------------------- */
    /* Main theme color
    ---------------------------------------------------------------------- */
    .csm-trigger,
    .csm-content h4,
    #backtotop a,
    #top-bar {
        background-color: <?php echo $theme_color; ?>;
    }


    body .saved:before,
    body .saved:after,
    body .saved i{
        color:#ff0000!important;
    }

    .custom-zoom-in:hover:before,
    .custom-zoom-out:hover:before,
    .infoBox-close:hover {
        -webkit-text-stroke: 1px <?php echo $theme_color; ?>;
    }

    .bg-theme-color{
        background:<?php echo $theme_color; ?> !important;
    }

    .list-4 li:before,
    .list-3 li:before,
    .list-2 li:before,
    .list-1 li:before {
        color: <?php echo $theme_color; ?>;
    }

    .numbered.color ol>li::before {
        border: 1px solid <?php echo $theme_color; ?>;
        color: <?php echo $theme_color; ?>;
    }

    .numbered.color.filled ol>li::before {
        border: 1px solid <?php echo $theme_color; ?>;
        background-color: <?php echo $theme_color; ?>;
    }

    .change-photo-btn:hover,
    table.manage-table th,
    mark.color {
        background-color: <?php echo $theme_color; ?>;
    }

    .user-menu ul li a:hover,
    .user-menu.active .user-name:after,
    .user-menu:hover .user-name:after,
    .user-menu.active .user-name,
    .user-menu:hover .user-name,
    table.manage-table td.action a:hover,
    table.manage-table .title-container .title h4 a:hover,
    .my-account-nav li a.current,
    .my-account-nav li a:hover,
    #footer .social-icons li a:hover i,
    #navigation.style-1 .current,
    #posts-nav li a:hover,
    #top-bar .social-icons li a:hover i,
    .agent .social-icons li a:hover i,
    .agent-contact-details li a:hover,
    .agent-page .agent-name h4,
    .footer-links li a:hover,
    .header-style-2 .header-widget li i,
    .header-widget .sign-in:hover,
    .home-slider-desc .read-more i,
    .info-box,
    .info-box h4,
    .listing-title h4 a:hover,
    .map-box h4 a:hover,
    .plan-price .value,
    .plan.featured .listing-badges .featured,
    .post-content a.read-more,
    .post-content h3 a:hover,
    .post-meta li a:hover,
    .property-pricing,
    .style-2 .trigger a:hover,
    .style-2 .trigger.active a,
    .style-2 .ui-accordion .ui-accordion-header-active,
    .style-2 .ui-accordion .ui-accordion-header-active:hover,
    .style-2 .ui-accordion .ui-accordion-header:hover,
    .tabs-nav li a:hover,
    .tabs-nav li.active a,
    .testimonial-author h4,
    .widget-button:hover,
    .widget-text h5 a:hover,
    a,
    a.button.border,
    a.button.border.white:hover {
        color: <?php echo $theme_color; ?>
    }

    #header-container.top-border {
        border-top: 4px solid <?php echo $theme_color; ?>
    }

    #navigation.style-1 .current {
        background-color: transparent;
        border: 1px solid <?php echo $theme_color; ?>
    }

    #navigation.style-1 ul li:hover {
        background-color: <?php echo $theme_color; ?>
    }

    #navigation.style-2 {
        background-color: <?php echo $theme_color; ?>
    }

    .menu-responsive i {
        background: linear-gradient(to bottom, rgba(255, 255, 255, .07) 0, transparent);
        background-color: <?php echo $theme_color; ?>
    }

    .checkboxes input[type=checkbox]:checked+label:before,
    .range-slider .ui-widget-header,
    .search-type label.active,
    .search-type label:hover {
        background-color: <?php echo $theme_color; ?>
    }

    .range-slider .ui-slider .ui-slider-handle {
        border: 2px solid <?php echo $theme_color; ?>
    }

    .agent-avatar a:before {
        background: <?php echo $theme_color; ?>;
        background: linear-gradient(to bottom, transparent 50%, <?php echo $theme_color; ?>)
    }

    .view-profile-btn {
        background-color: <?php echo $theme_color; ?>
    }

    .listing-img-container:after {
        background: linear-gradient(to bottom, transparent 60%, <?php echo $theme_color; ?>)
    }

    .listing-badges .featured {
        background-color: <?php echo $theme_color; ?>
    }


    .listing-badges span {
        color: #fff;
        display: inline-block;
        padding: 1px 10px;
        float: right;
        background-color: <?php echo $theme_color; ?>;
        border-radius: 3px;
        top: 15px;
        right: 15px;
        position: absolute;
    }

    .list-layout .listing-img-container:after {
        background: linear-gradient(to bottom, transparent 55%, <?php echo $theme_color; ?>)
    }

    #titlebar.property-titlebar span.property-badge,
    .back-to-listings:hover,
    .home-slider-price,
    .img-box:hover:before,
    .layout-switcher a.active,
    .layout-switcher a:hover,
    .listing-hidden-content,
    .office-address h3:after,
    .pagination .current,
    .pagination ul li a.current-page,
    .pagination ul li a:hover,
    .pagination-next-prev ul li a:hover,
    .property-features.checkboxes li:before {
        background-color: <?php echo $theme_color; ?>
    }

    .post-img:after,
    .tip {
        background: <?php echo $theme_color; ?>
    }

    .property-slider-nav .item.slick-current.slick-active:before {
        border-color: <?php echo $theme_color; ?>
    }

    .post-img:after {
        background: linear-gradient(to bottom, transparent 40%, <?php echo $theme_color; ?>)
    }

    .comment-by a.reply:hover,
    .post-img:before {
        background-color: <?php echo $theme_color; ?>
    }

    .map-box .listing-img-container:after {
        background: linear-gradient(to bottom, transparent 50%, <?php echo $theme_color; ?>)
    }

    #geoLocation:hover,
    #mapnav-buttons a:hover,
    #scrollEnabling.enabled,
    #scrollEnabling:hover,
    #streetView:hover,
    .cluster div,
    .custom-zoom-in:hover,
    .custom-zoom-out:hover,
    .infoBox-close:hover,
    .listing-carousel.owl-theme .owl-controls .owl-next:after,
    .listing-carousel.owl-theme .owl-controls .owl-prev:before,
    .listing-carousel.owl-theme.outer .owl-controls .owl-next:hover::after,
    .listing-carousel.owl-theme.outer .owl-controls .owl-prev:hover::before,
    .slick-next:after,
    .slick-prev:after {
        background-color: <?php echo $theme_color; ?>;
        background-color: rgba(0, 0, 0, 0) !important;
        color: <?php echo $theme_color; ?>;
    }

    .listing-carousel.owl-theme .owl-controls .owl-buttons div {
        color: #fff;
    }

    .cluster div:before {
        border: 7px solid <?php echo $theme_color; ?>;
        box-shadow: inset 0 0 0 4px <?php echo $theme_color; ?>
    }

    .mfp-arrow:hover {
        background: <?php echo $theme_color; ?>
    }

    .dropzone:hover {
        border: 2px dashed <?php echo $theme_color; ?>
    }

    .dropzone:before {
        background: linear-gradient(to bottom, rgba(255, 255, 255, .95), rgba(255, 255, 255, .9));
        background-color: <?php echo $theme_color; ?>
    }

    .chosen-container .chosen-results li.highlighted,
    .chosen-container-multi .chosen-choices li.search-choice,
    .select-options li:hover,
    a.button,
    a.button.border:hover,
    button.button,
    input[type=button],
    input[type=submit] {
        background-color: <?php echo $theme_color; ?>
    }

    .dropzone:hover .dz-message,
    .sort-by .chosen-container-single .chosen-default,
    .sort-by .chosen-container-single .chosen-single div b:after {
        color: <?php echo $theme_color; ?>
    }

    a.button.border {
        border: 1px solid <?php echo $theme_color; ?>
    }

    .plan.featured .plan-price {
        background: linear-gradient(to bottom, rgba(255, 255, 255, .1) 0, transparent);
        background-color: <?php echo $theme_color; ?>
    }

    .fp-accordion .accordion h3.ui-accordion-header-active,
    .trigger.active a,
    .ui-accordion .ui-accordion-header-active,
    .ui-accordion .ui-accordion-header-active:hover {
        background-color: <?php echo $theme_color; ?>;
        border-color: <?php echo $theme_color; ?>
    }

    .tabs-nav li a:hover,
    .tabs-nav li.active a {
        border-color: <?php echo $theme_color; ?>
    }

    .style-3 .tabs-nav li a:hover,
    .style-3 .tabs-nav li.active a {
        border-color: <?php echo $theme_color; ?>;
        background-color: <?php echo $theme_color; ?>
    }

    .style-4 .tabs-nav li.active a,
    .style-5 .tabs-nav li.active a,
    table.basic-table th {
        background-color: <?php echo $theme_color; ?>
    }

    .info-box {
        border-top: 2px solid <?php echo $theme_color; ?>;
        background: linear-gradient(to bottom, rgba(255, 255, 255, .98), rgba(255, 255, 255, .95));
        background-color: <?php echo $theme_color; ?>
    }

    .info-box.no-border {
        background: linear-gradient(to bottom, rgba(255, 255, 255, .96), rgba(255, 255, 255, .93));
        background-color: <?php echo $theme_color; ?>
    }

    .icon-box-1 .icon-container {
        background-color: <?php echo $theme_color; ?>
    }


    .qtyTotal {
        background-color: <?php echo $theme_color; ?>;
    }

    .daterangepicker td.available:hover,
    .daterangepicker th.available:hover {
        background-color: <?php echo $theme_color; ?>;
    }

    .daterangepicker td.in-range {
        background-color: rgba(39, 74, 187, 0.07);
        color: <?php echo $theme_color; ?>;
    }

    .daterangepicker td.active,
    .daterangepicker td.active:hover {
        background-color: <?php echo $theme_color; ?>;
    }

    .daterangepicker .drp-buttons button.applyBtn,
    .daterangepicker .drp-buttons button.cancelBtn {
        background-color: <?php echo $theme_color; ?>;
    }

    .daterangepicker .drp-buttons button.applyBtn {
        background-color: <?php echo $theme_color; ?>;
    }

    #booking-date-range:hover {
        color: <?php echo $theme_color; ?>;
    }

    #booking-date-range span:after {
        color: <?php echo $theme_color; ?>;
    }

    .daterangepicker .ranges li.active {
        background-color: <?php echo $theme_color; ?>;
        color: #fff;
    }

    .panel-dropdown a:after {
        color: <?php echo $theme_color; ?>;
    }

    .time-slot input~label:hover {
        color: <?php echo $theme_color; ?>;
        background-color: rgba(39, 74, 187, 0.06);
    }

    .time-slot input:checked~label {
        background-color: <?php echo $theme_color; ?>;
    }

    .time-slot label:hover span {
        color: <?php echo $theme_color; ?>;
    }



    .table thead {
        background: <?php echo $theme_color; ?>;
        color: #fff;
    }

    .table a:hover {
        color: <?php echo $theme_color; ?>;
    }

    ul li a:hover {
        color: <?php echo $theme_color; ?>;
    }

    .top-bar-menu ul li a:hover {
        color: #ccc;
    }

    #titlebar .back-to-listings:hover {
        background-color: <?php echo $theme_color; ?> !important;
        color: #fff !important;
        text-decoration:none;
    }

    .suggestion-block ul li:hover{
        color:<?php echo $theme_color; ?>;
    }


    .theme-bg {
        background-color: <?php echo $theme_color; ?>;
    }

    .theme-color{
        color: <?php echo $theme_color; ?>!important;
    }


    .property-features li i{
        color: <?php echo $theme_color; ?>!important;
    }

    .suggestion-block ::-webkit-scrollbar-thumb{
        background-color: <?php echo $theme_color; ?>!important;;
    }



    .loader {
        border: 16px solid #eee;
        border-radius: 50%;
        width: 120px;
        height: 120px;
        -webkit-animation: spin 2s linear infinite;
        /* Safari */
        animation: spin 2s linear infinite;
        margin:0px auto;
    }

    .loader {
        border-top: 16px solid <?php echo $theme_color; ?>;
    }



    /* Safari */
    @-webkit-keyframes spin {
        0% {
            -webkit-transform: rotate(0deg);
        }

        100% {
            -webkit-transform: rotate(360deg);
        }
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }
</style>