<?php
/*
    Template Name: Innovation
    */

/**
 * Custom innovation page test template for Astra child theme.
 *
 * @package Astra Child
 * @since 1.0.0
 */

if (! defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

get_header(); ?>
<?php


$what_we_do_heading = get_field('acf_innovation_what_we_do_heading');
$what_we_do_sub_heading = get_field('acf_innovation_what_we_do_description');
$what_we_do_button_text = get_field('acf_innovation_what_we_do_button_text');
$what_we_do_button_url = get_field('acf_innovation_what_we_do_button_url');

$our_innovations_section_main_heading = get_field('acf_innovation_page_our_innovations_section_heading');
$our_innovations_sub_heading = get_field('acf_innovation_page_our_innovations_sub_heading');
// // $our_innovations_card_titles = get_field('our_innovations_card_title');
// // $our_innovations_card_description = get_field('our_innovations_card_description');
// // $our_innovations_card_background_image = get_field('our_innovations_card_background_image');
$our_innovations_button_text = get_field('acf_our_innovations_button_text');
$our_innovations_button_url = get_field('acf_our_innovations_button_url');

$our_innovation_focus_section_main_heading = get_field('acf_heading');
// $our_innovation_focus_sub_headings = get_field('innovation_page_our_innovation_focus_sub_heading');
// $our_innovation_focus_left_images = get_field('our_innovation_focus_left_image');
// $our_innovation_focus_right_descriptions = get_field('our_innovation_focus_right_description');

$innovation_page_quote = get_field('acf_quote_text');
$innovation_page_quote_author_name = get_field('acf_quote_author');

$why_partner_with_adro_section_main_heading = get_field('acf_partner_section_heading');

$how_we_do_it_section_main_heading = get_field('acf_innovation_how_we_do_it_section_heading');
$how_we_do_it_common_text_below_image = get_field('acf_innovation_page_text_below_the_section');
$how_we_do_it_button_text = get_field('acf_innovation_page_button_text_below_the_section');
$how_we_do_it_button_url = get_field('acf_innovation_page_button_url_below_the_section');
$how_do_index = -1;

$service_page_our_clients_section_heading = get_field('acf_service_page_our_clients_section_heading');
$how_we_help_heading = get_field('acf_how_we_help_heading');

$you_may_be_interested_plugin_shortcode = get_field('you_might_be_interested_plugin_shortcode');
?>
<?php if (astra_page_layout() == 'left-sidebar') : ?>
    <?php get_sidebar(); ?>
<?php endif ?>
<div id="primary" <?php astra_primary_class(); ?>>
    <main id="main" class="site-main">
        <article id="post-<?php the_ID(); ?>" <?php post_class('ast-article-single'); ?> itemscope itemtype="https://schema.org/CreativeWork">
            <div class="entry-content clear" data-ast-blocks-layout="true" itemprop="text">


                <!--banner section -->

                <div class="innovation-banner">
                    <div class="service-banner-sub-menu-together">
                        <div class="owl-carousel">
                            <?php if (have_rows('acf_innovation_banner_slides')) :
                                $slide_index = -1; ?>
                                <?php while (have_rows('acf_innovation_banner_slides')): the_row();
                                    $slide_index++;
                                    $banner_background_image = get_sub_field('acf_innovation_background_image') ?: '';
                                    $banner_title = get_sub_field('acf_innovation_banner_title') ?: '';
                                    $banner_button_text = get_sub_field('acf_innovation_banner_button_text') ?: '';
                                    $banner_button_url = get_sub_field('acf_innovation_banner_button_url') ?: '';
                                    if (!empty($banner_background_image) && strpos($banner_background_image, 'http') !== 0) {
                                        $banner_background_image = home_url($banner_background_image);
                                    } ?>
                                    <div class="service-hero-banner item" style="background: linear-gradient(180deg, rgba(67, 102, 143, 0.39) 0.03%, rgba(55, 82, 114, 0.45) 38.69%, rgba(5, 9, 14, 0.60) 128.89%), url('<?php echo esc_url($banner_background_image); ?>') lightgray;">
                                        <div class="left-text-box">
                                            <?php if ($slide_index == 0) : ?>
                                                <h1 class="innovatio-h1 largest-size"><?php echo esc_html($banner_title); ?></h1>
                                            <?php else : ?>
                                                <h2 class="innovatio-h1 largest-size"><?php echo esc_html($banner_title); ?></h2>
                                            <?php endif; ?>
                                            <a href="<?php echo esc_html($banner_button_url); ?>"><button class="custom-button industry-get-in-touch"><?php echo esc_html($banner_button_text); ?></button></a>
                                        </div>
                                    </div>
                                <?php endwhile; ?>
                            <?php else : ?>
                                <p>No banners found.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <!--text below banner section -->
                <div class="below-innovation-banner">
                    <h2 class="text-below-innovation-heading has-text-align-center large-size"><?php echo $what_we_do_heading ?></h2>
                    <p class="has-text-align-center medium-size text-below-innovation-banner animated-text-transition" id="animatedParagraph"><?php echo $what_we_do_sub_heading ?></p>
                    <a href="<?php echo esc_html($what_we_do_button_url) ?>"><button class="custom-button"><?php echo esc_html($what_we_do_button_text) ?></button></a>
                </div>
                <!-- our innovation section  -->
                <div class="innovation-section">
                    <div class="our-innovation-header">
                        <h2 class="main-header large-size font-bold"><?php echo $our_innovations_section_main_heading; ?></h2>
                        <h3 class="sub-header small-size"><?php echo $our_innovations_sub_heading; ?></h3>

                    </div>
                    <div class="card-section">
                        <div class="main-card" id="mainCard">
                            <h2 class="main-card-title small-size font-bold" id="mainTitle"></h2>
                            <div class="main-card-scrollable">
                                <p class="main-card-content smaller-size" id="mainContent"></p>
                            </div>
                        </div>
                        <div class="small-cards">
                            <?php if (have_rows('acf_our_innovations_innovation_cards')) :
                                $index = -1; ?>
                                <?php while (have_rows('acf_our_innovations_innovation_cards')): the_row();
                                    $index++;
                                    $card_image = get_sub_field('acf_our_innovations_card_image') ?: '';
                                    $card_title = get_sub_field('acf_our_innovations_card_title') ?: '';
                                    $card_description_para1 = get_sub_field('acf_our_innovations_card_description_para1') ?: '';
                                    $card_description_para2 = get_sub_field('acf_our_innovations_card_description_para2') ?: ''; ?>



                                    <div class="item card card-wrapper manual-lazy-load" data-index="<?php echo esc_html($index); ?>"
                                        data-bg="<?php echo esc_html($card_image); ?>"
                                        data-title="<?php echo esc_html($card_title); ?>" data-desc="<?php echo esc_html($card_description_para1); ?>&lt;br&gt;&lt;br&gt;  <?php echo esc_html($card_description_para2); ?>">

                                        <div class="card-content">
                                            <h2 class="card-title small-size font-bold"></h2>
                                            <p class="card-description"></p>
                                        </div>
                                    </div>
                                <?php endwhile; ?>
                            <?php else : ?>
                                <p>No innovations found.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="button-box">
                        <a href="<?php echo esc_html($our_innovations_button_url); ?>" class="our-innovation-button">
                            <button class="custom-button"><?php echo esc_html($our_innovations_button_text); ?></button>
                        </a>
                    </div>
                </div>
                <!-- our innovation focus section  -->
                <div class="our-innovation-focus">
                    <div class="section-header">
                        <h2 class="main-header large-size font-bold"><?php echo $our_innovation_focus_section_main_heading; ?></h2>
                    </div>
                    <div class="focus-carousel-container owl-carousel">
                        <?php if (have_rows('acf_innovation_page_innovation_focus_section_items')) :
                            $focus_index = -1; ?>
                            <?php while (have_rows('acf_innovation_page_innovation_focus_section_items')): the_row();
                                $our_innovation_focus_slide_title = get_sub_field('acf_slide_title') ?: '';
                                $our_innovation_focus_video_url = get_sub_field('acf_video') ?: '';
                                $our_innovation_focus_img_url = get_sub_field('acf_thumbnail_img') ?: '';
                                $our_innovation_focus_para1 = get_sub_field('acf_paragram_1') ?: '';
                                $our_innovation_focus_para2 = get_sub_field('acf_paragram_2') ?: '';
                                $focus_index++; ?>
                                <div class="focus-item item" data-id="<?php echo $focus_index; ?>">
                                    <h2 class="small-size item-header"><?php echo $our_innovation_focus_slide_title; ?></h2>
                                    <div class="our_expertise_container" id="expertise">

                                        <div class="video-container">
                                            <?php if (!empty($our_innovation_focus_video_url)) : ?>
                                                <iframe style="width:100%;height:100%;" class="manual-lazy-load" src="<?php echo esc_html($our_innovation_focus_video_url); ?>" frameborder="0" allow="autoplay; fullscreen" allowfullscreen=""></iframe>
                                            <?php else : ?>
                                                <img class="manual-lazy-load" src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 5 1'%3E%3C/svg%3E" data-src="<?php echo esc_html($our_innovation_focus_img_url); ?>" alt="<?php echo esc_attr($our_innovation_focus_slide_title); ?>" />
                                            <?php endif; ?>
                                        </div>
                                        <div class="content">
                                            <p class="small-size description"><?php echo $our_innovation_focus_para1; ?></p><br>
                                            <p class="small-size description"><?php echo $our_innovation_focus_para2; ?></p>
                                        </div>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                        <?php else : ?>
                            <p>No focus found.</p>
                        <?php endif; ?>

                    </div>
                </div>
                <!-- quotes section  -->

                <div class="innovation-Quote">
                    <h2 class="Quote large-size"><span class="comma">"</span><?php echo $innovation_page_quote; ?><span class="comma">"</span></h2>
                    <span class="Quote-wrt"><?php echo $innovation_page_quote_author_name; ?></span>
                </div>
                <!-- why partner with Adrosonic section  -->
                <div class="why-partner-with-adrosonic">
                    <div class="section-header-container">
                        <h2 class="large-size font-bold"><?php echo $why_partner_with_adro_section_main_heading; ?></h2>
                    </div>

                    <div class="container">
                        <div class="left-column"></div>
                        <div class="right-column"></div>
                    </div>

                    <div style="display: none">

                        <?php if (have_rows('acf_innovation_page_why_partner_section_items')) : ?>
                            <?php while (have_rows('acf_innovation_page_why_partner_section_items')): the_row();
                                $why_partner_with_adro_card_label = get_sub_field('acf_card_title') ?: '';
                                $why_partner_with_adro_card_text = get_sub_field('acf_card_description') ?: ''; ?>
                                <div class="card" data-heading="<?php echo esc_html($why_partner_with_adro_card_label); ?>"
                                    data-description="<?php echo esc_html($why_partner_with_adro_card_text); ?>"></div>
                            <?php endwhile; ?>
                        <?php else : ?>
                            <p>No reasons found.</p>
                        <?php endif; ?>
                    </div>
                </div>
                <!-- how we do it section  -->
                <div id="" class="how-we-do-it-container">
                    <div class="section-header-container">
                        <h2 class="large-size font-bold"><?php echo $how_we_do_it_section_main_heading; ?></h2>
                    </div>
                    <div class="how-we-do-it-container-inner">

                        <div class="owl-carousel owl-theme">
                            <?php if (have_rows('acf_innovation_page_how_we_do_it_items')) :
                            ?>
                                <?php while (have_rows('acf_innovation_page_how_we_do_it_items')): the_row();
                                    $how_do_index++;
                                    $how_we_do_it_tab_title = get_sub_field('acf_innovation_how_we_do_it_tab_title') ?: '';
                                    $how_we_do_it_corresponding_image_svg = get_sub_field('acf_how_we_do_it_corresponding_image_svg') ?: ''; ?>
                                    <div class="item smaller-size" data-id="<?php echo $how_do_index; ?>"
                                        data-img-path="<?php echo esc_html($how_we_do_it_corresponding_image_svg); ?>"><?php echo esc_html($how_we_do_it_tab_title); ?></div>
                                <?php endwhile; ?>
                            <?php else : ?>
                                <p>No how we do found.</p>
                            <?php endif; ?>
                        </div>
                        <div class="content-box">

                            <div class="graphic-container">
                                <div class="whole-graphic">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="1792" viewBox="0 0 1792 543" fill="none">
                                        <g clip-path="url(#clip0_11605_543)">
                                            <g filter="url(#filter0_f_11605_543)">
                                                <circle cx="125.673" cy="325.892" r="111.97" fill="url(#paint0_radial_11605_543)"
                                                    fill-opacity="0.51"></circle>
                                            </g>
                                            <g filter="url(#filter1_f_11605_543)">
                                                <circle cx="380.24" cy="328.767" r="111.97" fill="url(#paint1_radial_11605_543)"
                                                    fill-opacity="0.51"></circle>
                                            </g>
                                            <path d="M242.87 342C242.574 341.826 242.287 341.643 242.005 341.455C237.148 338.208 233.954 332.712 233.954 326.475C233.954 319.821 237.588 314.009 243 310.872C237.343 250.924 186.338 204 124.259 204C58.3935 204 5 256.818 5 321.973" stroke="white" stroke-width="2.39252" stroke-miterlimit="10" stroke-linecap="round" />
                                            <path
                                                d="M508 341.21C516.456 341.21 523.312 334.355 523.312 325.898C523.312 317.441 516.456 310.586 508 310.586C499.543 310.586 492.688 317.441 492.688 325.898C492.688 334.355 499.543 341.21 508 341.21Z"
                                                fill="#00CCFF"></path>
                                            <path d="M508.012 318.711L508.006 334.03" stroke="#1A2C47" stroke-width="1.91402"
                                                stroke-linecap="round"></path>
                                            <path d="M500.352 326.367L515.67 326.373" stroke="#1A2C47" stroke-width="1.91402"
                                                stroke-linecap="round"></path>
                                            <path
                                                d="M763.308 341.132C771.765 341.132 778.62 334.277 778.62 325.82C778.62 317.363 771.765 310.508 763.308 310.508C754.852 310.508 747.996 317.363 747.996 325.82C747.996 334.277 754.852 341.132 763.308 341.132Z"
                                                fill="#00CCFF"></path>
                                            <path d="M763.32 318.633L763.314 333.952" stroke="#1A2C47" stroke-width="1.91402"
                                                stroke-linecap="round"></path>
                                            <path d="M755.66 326.289L770.979 326.295" stroke="#1A2C47" stroke-width="1.91402"
                                                stroke-linecap="round"></path>
                                            <path
                                                d="M252.957 341.687C261.413 341.687 268.269 334.831 268.269 326.375C268.269 317.918 261.413 311.062 252.957 311.062C244.5 311.062 237.645 317.918 237.645 326.375C237.645 334.831 244.5 341.687 252.957 341.687Z"
                                                fill="#00CCFF"></path>
                                            <path d="M252.961 318.711L252.955 334.03" stroke="#1A2C47" stroke-width="1.91402"
                                                stroke-linecap="round"></path>
                                            <path d="M245.301 326.367L260.62 326.373" stroke="#1A2C47" stroke-width="1.91402"
                                                stroke-linecap="round"></path>
                                            <path
                                                d="M497.919 310.359C497.626 310.533 497.342 310.716 497.063 310.904C492.259 314.147 489.099 319.636 489.099 325.867C489.099 332.513 492.694 338.318 498.047 341.452C492.451 401.331 441.997 448.201 380.588 448.201C319.179 448.201 268.725 401.331 263.129 341.452C268.483 338.318 272.078 332.513 272.078 325.867C272.078 319.636 268.918 314.147 264.114 310.904C263.834 310.716 263.546 310.533 263.257 310.359"
                                                stroke="white" stroke-width="2.39252" stroke-miterlimit="10" stroke-linecap="round"></path>
                                            <g filter="url(#filter2_f_11605_543)">
                                                <circle cx="890.29" cy="328.244" r="111.97" fill="url(#paint2_radial_11605_543)"
                                                    fill-opacity="0.51"></circle>
                                            </g>
                                            <path
                                                d="M1007.97 309.859C1007.68 310.033 1007.4 310.216 1007.12 310.404C1002.31 313.647 999.153 319.136 999.153 325.367C999.153 332.013 1002.75 337.818 1008.1 340.952C1002.51 400.831 952.052 447.701 890.643 447.701C829.234 447.701 778.78 400.831 773.184 340.952C778.537 337.818 782.132 332.013 782.132 325.367C782.132 319.136 778.972 313.647 774.168 310.404C773.889 310.216 773.6 310.033 773.312 309.859"
                                                stroke="white" stroke-width="2.39252" stroke-miterlimit="10" stroke-linecap="round"></path>
                                            <g filter="url(#filter3_f_11605_543)">
                                                <circle cx="111.97" cy="111.97" r="111.97" transform="matrix(1 0 0 -1 523.141 434.664)"
                                                    fill="url(#paint3_radial_11605_543)" fill-opacity="0.51"></circle>
                                            </g>
                                            <path
                                                d="M752.79 341.086C752.497 340.912 752.213 340.729 751.934 340.542C747.13 337.298 743.97 331.809 743.97 325.579C743.97 318.932 747.565 313.127 752.918 309.994C747.322 250.114 696.868 203.245 635.459 203.245C574.051 203.245 523.596 250.114 518 309.994C523.354 313.127 526.949 318.932 526.949 325.579C526.949 331.809 523.789 337.298 518.985 340.542C518.705 340.729 518.417 340.912 518.128 341.086"
                                                stroke="white" stroke-width="2.39252" stroke-miterlimit="10" stroke-linecap="round"></path>
                                            <g filter="url(#filter4_f_11605_543)">
                                                <circle cx="111.97" cy="111.97" r="111.97" transform="matrix(1 0 0 -1 1033.8 434.664)"
                                                    fill="url(#paint4_radial_11605_543)" fill-opacity="0.51"></circle>
                                            </g>
                                            <path
                                                d="M1273.53 310.243C1281.99 310.243 1288.84 317.098 1288.84 325.555C1288.84 334.012 1281.99 340.867 1273.53 340.867C1265.07 340.867 1258.22 334.012 1258.22 325.555C1258.22 317.098 1265.07 310.243 1273.53 310.243Z"
                                                fill="#00CCFF"></path>
                                            <path d="M1273.54 332.75L1273.54 317.431" stroke="#1A2C47" stroke-width="1.91402"
                                                stroke-linecap="round"></path>
                                            <path d="M1265.88 325.094L1281.2 325.088" stroke="#1A2C47" stroke-width="1.91402"
                                                stroke-linecap="round"></path>
                                            <path
                                                d="M1528.84 310.313C1537.3 310.313 1544.15 317.169 1544.15 325.625C1544.15 334.082 1537.3 340.938 1528.84 340.938C1520.38 340.938 1513.53 334.082 1513.53 325.625C1513.53 317.169 1520.38 310.313 1528.84 310.313Z"
                                                fill="#00CCFF"></path>
                                            <path d="M1528.84 332.812L1528.83 317.494" stroke="#1A2C47" stroke-width="1.91402"
                                                stroke-linecap="round"></path>
                                            <path d="M1521.18 325.156L1536.5 325.15" stroke="#1A2C47" stroke-width="1.91402"
                                                stroke-linecap="round"></path>
                                            <path
                                                d="M1018.48 309.766C1026.94 309.766 1033.8 316.622 1033.8 325.078C1033.8 333.535 1026.94 340.391 1018.48 340.391C1010.03 340.391 1003.17 333.535 1003.17 325.078C1003.17 316.622 1010.03 309.766 1018.48 309.766Z"
                                                fill="#00CCFF"></path>
                                            <path d="M1018.49 332.75L1018.49 317.431" stroke="#1A2C47" stroke-width="1.91402"
                                                stroke-linecap="round"></path>
                                            <path d="M1010.83 325.094L1026.15 325.088" stroke="#1A2C47" stroke-width="1.91402"
                                                stroke-linecap="round"></path>
                                            <path
                                                d="M1263.45 341.086C1263.16 340.912 1262.87 340.729 1262.59 340.542C1257.79 337.298 1254.63 331.809 1254.63 325.579C1254.63 318.932 1258.23 313.127 1263.58 309.994C1257.98 250.114 1207.53 203.245 1146.12 203.245C1084.71 203.245 1034.26 250.114 1028.66 309.994C1034.01 313.127 1037.61 318.932 1037.61 325.579C1037.61 331.809 1034.45 337.298 1029.64 340.542C1029.37 340.729 1029.08 340.912 1028.79 341.086"
                                                stroke="white" stroke-width="2.39252" stroke-miterlimit="10" stroke-linecap="round"></path>
                                            <g filter="url(#filter5_f_11605_543)">
                                                <circle cx="1400.65" cy="328.767" r="111.97" fill="url(#paint5_radial_11605_543)"
                                                    fill-opacity="0.51"></circle>
                                            </g>
                                            <path
                                                d="M1518.32 310.359C1518.03 310.533 1517.74 310.716 1517.47 310.904C1512.66 314.147 1509.5 319.636 1509.5 325.867C1509.5 332.513 1513.1 338.318 1518.45 341.452C1512.85 401.331 1462.4 448.201 1400.99 448.201C1339.58 448.201 1289.13 401.331 1283.53 341.452C1288.88 338.318 1292.48 332.513 1292.48 325.867C1292.48 319.636 1289.32 314.147 1284.52 310.904C1284.24 310.716 1283.95 310.533 1283.66 310.359"
                                                stroke="white" stroke-width="2.39252" stroke-miterlimit="10" stroke-linecap="round"></path>
                                            <g filter="url(#filter6_f_11605_543)">
                                                <circle cx="111.97" cy="111.97" r="111.97" transform="matrix(-1 0 0 1 1768.98 213.102)"
                                                    fill="url(#paint6_radial_11605_543)" fill-opacity="0.51"></circle>
                                            </g>
                                            <path
                                                d="M1539.98 341.076C1540.27 340.902 1540.56 340.719 1540.83 340.531C1545.64 337.288 1548.8 331.799 1548.8 325.568C1548.8 318.922 1545.2 313.117 1539.85 309.983C1545.45 250.104 1595.9 203.234 1657.31 203.234C1722.46 203.234 1775.28 255.991 1775.28 321.072"
                                                stroke="white" stroke-width="2.39252" stroke-miterlimit="10" stroke-linecap="round"></path>
                                        </g>
                                        <defs>
                                            <filter id="filter0_f_11605_543" x="-34.1473" y="166.071" width="319.641" height="319.641"
                                                filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                                                <feFlood flood-opacity="0" result="BackgroundImageFix"></feFlood>
                                                <feBlend mode="normal" in="SourceGraphic" in2="BackgroundImageFix" result="shape"></feBlend>
                                                <feGaussianBlur stdDeviation="23.9252" result="effect1_foregroundBlur_11605_543">
                                                </feGaussianBlur>
                                            </filter>
                                            <filter id="filter1_f_11605_543" x="220.419" y="168.946" width="319.641" height="319.641"
                                                filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                                                <feFlood flood-opacity="0" result="BackgroundImageFix"></feFlood>
                                                <feBlend mode="normal" in="SourceGraphic" in2="BackgroundImageFix" result="shape"></feBlend>
                                                <feGaussianBlur stdDeviation="23.9252" result="effect1_foregroundBlur_11605_543">
                                                </feGaussianBlur>
                                            </filter>
                                            <filter id="filter2_f_11605_543" x="730.47" y="168.423" width="319.641" height="319.641"
                                                filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                                                <feFlood flood-opacity="0" result="BackgroundImageFix"></feFlood>
                                                <feBlend mode="normal" in="SourceGraphic" in2="BackgroundImageFix" result="shape"></feBlend>
                                                <feGaussianBlur stdDeviation="23.9252" result="effect1_foregroundBlur_11605_543">
                                                </feGaussianBlur>
                                            </filter>
                                            <filter id="filter3_f_11605_543" x="475.29" y="162.873" width="319.641" height="319.641"
                                                filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                                                <feFlood flood-opacity="0" result="BackgroundImageFix"></feFlood>
                                                <feBlend mode="normal" in="SourceGraphic" in2="BackgroundImageFix" result="shape"></feBlend>
                                                <feGaussianBlur stdDeviation="23.9252" result="effect1_foregroundBlur_11605_543">
                                                </feGaussianBlur>
                                            </filter>
                                            <filter id="filter4_f_11605_543" x="985.946" y="162.873" width="319.641" height="319.641"
                                                filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                                                <feFlood flood-opacity="0" result="BackgroundImageFix"></feFlood>
                                                <feBlend mode="normal" in="SourceGraphic" in2="BackgroundImageFix" result="shape"></feBlend>
                                                <feGaussianBlur stdDeviation="23.9252" result="effect1_foregroundBlur_11605_543">
                                                </feGaussianBlur>
                                            </filter>
                                            <filter id="filter5_f_11605_543" x="1240.83" y="168.946" width="319.641" height="319.641"
                                                filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                                                <feFlood flood-opacity="0" result="BackgroundImageFix"></feFlood>
                                                <feBlend mode="normal" in="SourceGraphic" in2="BackgroundImageFix" result="shape"></feBlend>
                                                <feGaussianBlur stdDeviation="23.9252" result="effect1_foregroundBlur_11605_543">
                                                </feGaussianBlur>
                                            </filter>
                                            <filter id="filter6_f_11605_543" x="1497.19" y="165.251" width="319.641" height="319.641"
                                                filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                                                <feFlood flood-opacity="0" result="BackgroundImageFix"></feFlood>
                                                <feBlend mode="normal" in="SourceGraphic" in2="BackgroundImageFix" result="shape"></feBlend>
                                                <feGaussianBlur stdDeviation="23.9252" result="effect1_foregroundBlur_11605_543">
                                                </feGaussianBlur>
                                            </filter>
                                            <radialGradient id="paint0_radial_11605_543" cx="0" cy="0" r="1" gradientUnits="userSpaceOnUse"
                                                gradientTransform="translate(125.673 325.892) rotate(90) scale(147.427 111.97)">
                                                <stop stop-color="#00CCFF"></stop>
                                                <stop offset="1" stop-color="#1A2C47"></stop>
                                            </radialGradient>
                                            <radialGradient id="paint1_radial_11605_543" cx="0" cy="0" r="1" gradientUnits="userSpaceOnUse"
                                                gradientTransform="translate(380.24 328.767) rotate(90) scale(147.427 111.97)">
                                                <stop stop-color="#00CCFF"></stop>
                                                <stop offset="1" stop-color="#1A2C47"></stop>
                                            </radialGradient>
                                            <radialGradient id="paint2_radial_11605_543" cx="0" cy="0" r="1" gradientUnits="userSpaceOnUse"
                                                gradientTransform="translate(890.29 328.244) rotate(90) scale(147.427 111.97)">
                                                <stop stop-color="#00CCFF"></stop>
                                                <stop offset="1" stop-color="#1A2C47"></stop>
                                            </radialGradient>
                                            <radialGradient id="paint3_radial_11605_543" cx="0" cy="0" r="1" gradientUnits="userSpaceOnUse"
                                                gradientTransform="translate(111.97 111.97) rotate(90) scale(147.427 111.97)">
                                                <stop stop-color="#00CCFF"></stop>
                                                <stop offset="1" stop-color="#1A2C47"></stop>
                                            </radialGradient>
                                            <radialGradient id="paint4_radial_11605_543" cx="0" cy="0" r="1" gradientUnits="userSpaceOnUse"
                                                gradientTransform="translate(111.97 111.97) rotate(90) scale(147.427 111.97)">
                                                <stop stop-color="#00CCFF"></stop>
                                                <stop offset="1" stop-color="#1A2C47"></stop>
                                            </radialGradient>
                                            <radialGradient id="paint5_radial_11605_543" cx="0" cy="0" r="1" gradientUnits="userSpaceOnUse"
                                                gradientTransform="translate(1400.65 328.767) rotate(90) scale(147.427 111.97)">
                                                <stop stop-color="#00CCFF"></stop>
                                                <stop offset="1" stop-color="#1A2C47"></stop>
                                            </radialGradient>
                                            <radialGradient id="paint6_radial_11605_543" cx="0" cy="0" r="1" gradientUnits="userSpaceOnUse"
                                                gradientTransform="translate(111.97 111.97) rotate(90) scale(147.427 111.97)">
                                                <stop stop-color="#00CCFF"></stop>
                                                <stop offset="1" stop-color="#1A2C47"></stop>
                                            </radialGradient>
                                            <clipPath id="clip0_11605_543">
                                                <rect width="1792" height="543" fill="white"></rect>
                                            </clipPath>
                                        </defs>
                                    </svg>
                                </div>
                                <div class="dot-graphic">
                                    <svg xmlns="http://www.w3.org/2000/svg" id="a" data-name="Layer 3" viewBox="0 0 1792 543">
                                        <defs>
                                            <style>
                                                .b {
                                                    fill: #0cf;
                                                }
                                            </style>
                                        </defs>
                                        <g xmlns="http://www.w3.org/2000/svg">
                                            <path class="b" d="M5.3,351.9c0,1.4,1.1,2.5,2.5,2.5s2.5-1.1,2.5-2.5-1.1-2.5-2.5-2.5-2.5,1.1-2.5,2.5Z" />
                                            <path class="b" d="M2.9,339.51c0,1.4,1.1,2.5,2.5,2.5s2.5-1.1,2.5-2.5-1.1-2.5-2.5-2.5-2.5,1.1-2.5,2.5Z" />
                                            <path class="b" d="M7.9,362.1c0,1.4,1.1,2.5,2.5,2.5s2.5-1.1,2.5-2.5-1.1-2.5-2.5-2.5-2.5,1.1-2.5,2.5Z" />
                                            <path class="b" d="M11.6,371.9c0,1.4,1.1,2.5,2.5,2.5s2.5-1.1,2.5-2.5-1.1-2.5-2.5-2.5-2.5,1.1-2.5,2.5Z" />
                                            <path class="b" d="M15.6,381.6c0,1.4,1.1,2.5,2.5,2.5s2.5-1.1,2.5-2.5-1.1-2.5-2.5-2.5-2.5,1.1-2.5,2.5Z" />
                                            <path class="b" d="M21,390.6c0,1.4,1.1,2.5,2.5,2.5s2.5-1.1,2.5-2.5-1.1-2.5-2.5-2.5-2.5,1.1-2.5,2.5Z" />
                                            <path class="b" d="M27,399.3c0,1.4,1.1,2.5,2.5,2.5s2.5-1.1,2.5-2.5-1.1-2.5-2.5-2.5-2.5,1.1-2.5,2.5Z" />
                                            <path class="b" d="M33.4,407.5c0,1.4,1.1,2.5,2.5,2.5s2.5-1.1,2.5-2.5-1.1-2.5-2.5-2.5-2.5,1.1-2.5,2.5Z" />
                                            <path class="b" d="M41.2,414.5c0,1.4,1.1,2.5,2.5,2.5s2.5-1.1,2.5-2.5-1.1-2.5-2.5-2.5-2.5,1.1-2.5,2.5Z" />
                                            <path class="b" d="M49.1,421.4c0,1.4,1.1,2.5,2.5,2.5s2.5-1.1,2.5-2.5-1.1-2.5-2.5-2.5-2.5,1.1-2.5,2.5Z" />
                                            <path class="b" d="M57.5,427.7c0,1.4,1.1,2.5,2.5,2.5s2.5-1.1,2.5-2.5-1.1-2.5-2.5-2.5-2.5,1.1-2.5,2.5Z" />
                                            <path class="b" d="M66.8,432.5c0,1.4,1.1,2.5,2.5,2.5s2.5-1.1,2.5-2.5-1.1-2.5-2.5-2.5-2.5,1.1-2.5,2.5Z" />
                                            <path class="b" d="M76.2,437.2c0,1.4,1.1,2.5,2.5,2.5s2.5-1.1,2.5-2.5-1.1-2.5-2.5-2.5-2.5,1.1-2.5,2.5Z" />
                                            <path class="b" d="M86.1,440.5c0,1.4,1.1,2.5,2.5,2.5s2.5-1.1,2.5-2.5-1.1-2.5-2.5-2.5-2.5,1.1-2.5,2.5Z" />
                                            <path class="b" d="M96.2,443.4c0,1.4,1.1,2.5,2.5,2.5s2.5-1.1,2.5-2.5-1.1-2.5-2.5-2.5-2.5,1.1-2.5,2.5Z" />
                                            <path class="b" d="M106.6,445.3c0,1.4,1.1,2.5,2.5,2.5s2.5-1.1,2.5-2.5-1.1-2.5-2.5-2.5-2.5,1.1-2.5,2.5Z" />
                                            <path class="b" d="M117,446.6c0,1.4,1.1,2.5,2.5,2.5s2.5-1.1,2.5-2.5-1.1-2.5-2.5-2.5-2.5,1.1-2.5,2.5Z" />
                                            <path class="b" d="M127.4,446.4c0,1.4,1.1,2.5,2.5,2.5s2.5-1.1,2.5-2.5-1.1-2.5-2.5-2.5-2.5,1.1-2.5,2.5Z" />
                                            <path class="b" d="M137.8,444.6c0,1.4,1.1,2.5,2.5,2.5s2.5-1.1,2.5-2.5-1.1-2.5-2.5-2.5-2.5,1.1-2.5,2.5Z" />
                                            <path class="b" d="M148.2,442.9c0,1.4,1.1,2.5,2.5,2.5s2.5-1.1,2.5-2.5-1.1-2.5-2.5-2.5-2.5,1.1-2.5,2.5Z" />
                                            <path class="b" d="M158.3,440.5c0,1.4,1.1,2.5,2.5,2.5s2.5-1.1,2.5-2.5-1.1-2.5-2.5-2.5-2.5,1.1-2.5,2.5Z" />
                                            <path class="b" d="M167.9,436.1c0,1.4,1.1,2.5,2.5,2.5s2.5-1.1,2.5-2.5-1.1-2.5-2.5-2.5-2.5,1.1-2.5,2.5Z" />
                                            <path class="b" d="M177.4,431.7c0,1.4,1.1,2.5,2.5,2.5s2.5-1.1,2.5-2.5-1.1-2.5-2.5-2.5-2.5,1.1-2.5,2.5Z" />
                                            <path class="b" d="M186.5,426.5c0,1.4,1.1,2.5,2.5,2.5s2.5-1.1,2.5-2.5-1.1-2.5-2.5-2.5-2.5,1.1-2.5,2.5Z" />
                                            <path class="b" d="M194.7,419.9c0,1.4,1.1,2.5,2.5,2.5s2.5-1.1,2.5-2.5-1.1-2.5-2.5-2.5-2.5,1.1-2.5,2.5Z" />
                                            <path class="b" d="M202.8,413.3c0,1.4,1.1,2.5,2.5,2.5s2.5-1.1,2.5-2.5-1.1-2.5-2.5-2.5-2.5,1.1-2.5,2.5Z" />
                                            <path class="b" d="M210,405.7c0,1.4,1.1,2.5,2.5,2.5s2.5-1.1,2.5-2.5-1.1-2.5-2.5-2.5-2.5,1.1-2.5,2.5Z" />
                                            <path class="b" d="M216.3,397.3c0,1.4,1.1,2.5,2.5,2.5s2.5-1.1,2.5-2.5-1.1-2.5-2.5-2.5-2.5,1.1-2.5,2.5Z" />
                                            <path class="b" d="M222.6,388.9c0,1.4,1.1,2.5,2.5,2.5s2.5-1.1,2.5-2.5-1.1-2.5-2.5-2.5-2.5,1.1-2.5,2.5Z" />
                                            <path class="b" d="M227.1,379.5c0,1.4,1.1,2.5,2.5,2.5s2.5-1.1,2.5-2.5-1.1-2.5-2.5-2.5-2.5,1.1-2.5,2.5Z" />
                                            <path class="b" d="M231.1,369.7c0,1.4,1.1,2.5,2.5,2.5s2.5-1.1,2.5-2.5-1.1-2.5-2.5-2.5-2.5,1.1-2.5,2.5Z" />
                                            <path class="b" d="M235,360c0,1.4,1.1,2.5,2.5,2.5s2.5-1.1,2.5-2.5-1.1-2.5-2.5-2.5-2.5,1.1-2.5,2.5Z" />
                                            <path class="b" d="M236.7,349.6c0,1.4,1.1,2.5,2.5,2.5s2.5-1.1,2.5-2.5-1.1-2.5-2.5-2.5-2.5,1.1-2.5,2.5Z" />
                                        </g>
                                        <g xmlns="http://www.w3.org/2000/svg">
                                            <path class="b" d="M260.4,301.7c0-1.4,1.1-2.5,2.5-2.6s2.5,1.1,2.6,2.5-1.1,2.5-2.4,2.6-2.5-1.1-2.6-2.5h-.1Z" />
                                            <path class="b" d="M262.7,291.5c0-1.4,1.1-2.5,2.5-2.6s2.5,1.1,2.6,2.5-1.1,2.5-2.4,2.6-2.5-1.1-2.6-2.5h-.1Z" />
                                            <path class="b" d="M266.1,281.6c0-1.4,1.1-2.5,2.5-2.6s2.5,1.1,2.6,2.5-1.1,2.5-2.4,2.6-2.5-1.1-2.6-2.5h-.1Z" />
                                            <path class="b" d="M270,271.8c0-1.4,1.1-2.5,2.5-2.6s2.5,1.1,2.6,2.5-1.1,2.5-2.4,2.6-2.5-1.1-2.6-2.5h-.1Z" />
                                            <path class="b" d="M275.2,262.7c0-1.4,1.1-2.5,2.5-2.6s2.5,1.1,2.6,2.5-1.1,2.5-2.4,2.6-2.5-1.1-2.6-2.5h-.1Z" />
                                            <path class="b" d="M280.9,253.9c0-1.4,1.1-2.5,2.5-2.6s2.5,1.1,2.6,2.4-1.1,2.5-2.4,2.6-2.5-1.1-2.6-2.4h-.1Z" />
                                            <path class="b" d="M287.1,245.5c0-1.4,1.1-2.5,2.5-2.6s2.5,1.1,2.6,2.4-1.1,2.5-2.4,2.6-2.5-1.1-2.6-2.4h-.1Z" />
                                            <path class="b" d="M294.8,238.4c0-1.4,1.1-2.5,2.5-2.6s2.5,1.1,2.6,2.4-1.1,2.5-2.4,2.6-2.5-1.1-2.6-2.4h-.1Z" />
                                            <path class="b" d="M302.5,231.2c0-1.4,1.1-2.5,2.5-2.6s2.5,1.1,2.6,2.4-1.1,2.5-2.4,2.6-2.5-1.1-2.6-2.4h-.1Z" />
                                            <path class="b" d="M310.7,224.8c0-1.4,1.1-2.5,2.5-2.6s2.5,1.1,2.6,2.4-1.1,2.5-2.4,2.6-2.5-1.1-2.6-2.4h-.1Z" />
                                            <path class="b" d="M319.9,219.8c0-1.4,1.1-2.5,2.5-2.6s2.5,1.1,2.6,2.4-1.1,2.5-2.4,2.6-2.5-1.1-2.6-2.4h-.1Z" />
                                            <path class="b" d="M329.2,214.8c0-1.4,1.1-2.5,2.5-2.6s2.5,1.1,2.6,2.4-1.1,2.5-2.4,2.6-2.5-1.1-2.6-2.4h-.1Z" />
                                            <path class="b" d="M339,211.2c0-1.4,1.1-2.5,2.5-2.6s2.5,1.1,2.6,2.4-1.1,2.5-2.4,2.6-2.5-1.1-2.6-2.4h-.1Z" />
                                            <path class="b" d="M349.1,208.1c0-1.4,1.1-2.5,2.5-2.6s2.5,1.1,2.6,2.4-1.1,2.5-2.4,2.6-2.5-1.1-2.6-2.4h-.1Z" />
                                            <path class="b" d="M359.3,205.9c0-1.4,1.1-2.5,2.5-2.6s2.5,1.1,2.6,2.4-1.1,2.5-2.4,2.6-2.5-1.1-2.6-2.4h-.1Z" />
                                            <path class="b" d="M369.7,204.4c0-1.4,1.1-2.5,2.5-2.6s2.5,1.1,2.6,2.4-1.1,2.5-2.4,2.6-2.5-1.1-2.6-2.4h-.1Z" />
                                            <path class="b" d="M380.2,204.4c0-1.4,1.1-2.5,2.5-2.6s2.5,1.1,2.6,2.4-1.1,2.5-2.4,2.6-2.5-1.1-2.6-2.4h-.1Z" />
                                            <path class="b" d="M390.6,205.9c0-1.4,1.1-2.5,2.5-2.6s2.5,1.1,2.6,2.4-1.1,2.5-2.4,2.6-2.5-1.1-2.6-2.4h-.1Z" />
                                            <path class="b" d="M401,207.4c0-1.4,1.1-2.5,2.5-2.6s2.5,1.1,2.6,2.4-1.1,2.5-2.4,2.6-2.5-1.1-2.6-2.4h-.1Z" />
                                            <path class="b" d="M411.2,209.5c0-1.4,1.1-2.5,2.5-2.6s2.5,1.1,2.6,2.4-1.1,2.5-2.4,2.6-2.5-1.1-2.6-2.4h-.1Z" />
                                            <path class="b" d="M420.9,213.7c0-1.4,1.1-2.5,2.5-2.6s2.5,1.1,2.6,2.4-1.1,2.5-2.4,2.6-2.5-1.1-2.6-2.4h-.1Z" />
                                            <path class="b" d="M430.5,217.9c0-1.4,1.1-2.5,2.5-2.6s2.5,1.1,2.6,2.4-1.1,2.5-2.4,2.6-2.5-1.1-2.6-2.4h-.1Z" />
                                            <path class="b" d="M439.7,222.8c0-1.4,1.1-2.5,2.5-2.6s2.5,1.1,2.6,2.4-1.1,2.5-2.4,2.6-2.5-1.1-2.6-2.4h-.1Z" />
                                            <path class="b" d="M448,229.2c0-1.4,1.1-2.5,2.5-2.6s2.5,1.1,2.6,2.4-1.1,2.5-2.4,2.6-2.5-1.1-2.6-2.4h-.1Z" />
                                            <path class="b" d="M456.4,235.6c0-1.4,1.1-2.5,2.5-2.6s2.5,1.1,2.6,2.4-1.1,2.5-2.4,2.6-2.5-1.1-2.6-2.4h-.1Z" />
                                            <path class="b" d="M463.7,243c0-1.4,1.1-2.5,2.5-2.6s2.5,1.1,2.6,2.4-1.1,2.5-2.4,2.6-2.5-1.1-2.6-2.4h-.1Z" />
                                            <path class="b" d="M470.2,251.2c0-1.4,1.1-2.5,2.5-2.6s2.5,1.1,2.6,2.4-1.1,2.5-2.4,2.6-2.5-1.1-2.6-2.4h-.1Z" />
                                            <path class="b" d="M476.7,259.5c0-1.4,1.1-2.5,2.5-2.6s2.5,1.1,2.6,2.5-1.1,2.5-2.4,2.6-2.5-1.1-2.6-2.5h-.1Z" />
                                            <path class="b" d="M481.4,268.8c0-1.4,1.1-2.5,2.5-2.6s2.5,1.1,2.6,2.5-1.1,2.5-2.4,2.6-2.5-1.1-2.6-2.5h-.1Z" />
                                            <path class="b" d="M485.6,278.5c0-1.4,1.1-2.5,2.5-2.6s2.5,1.1,2.6,2.5-1.1,2.5-2.4,2.6-2.5-1.1-2.6-2.5h-.1Z" />
                                            <path class="b" d="M489.8,288.1c0-1.4,1.1-2.5,2.5-2.6s2.5,1.1,2.6,2.5-1.1,2.5-2.4,2.6-2.5-1.1-2.6-2.5h-.1Z" />
                                            <path class="b" d="M491.8,298.4c0-1.4,1.1-2.5,2.5-2.6s2.5,1.1,2.6,2.5-1.1,2.5-2.4,2.6-2.5-1.1-2.6-2.5h-.1Z" />
                                        </g>
                                        <g xmlns="http://www.w3.org/2000/svg">
                                            <path class="b" d="M517.8,351.4c0,1.4,1.1,2.5,2.5,2.6s2.5-1.1,2.6-2.5-1.1-2.5-2.4-2.6-2.5,1.1-2.6,2.5h-.1Z" />
                                            <path class="b" d="M520.2,361.6c0,1.4,1.1,2.5,2.5,2.6s2.5-1.1,2.6-2.5-1.1-2.5-2.4-2.6-2.5,1.1-2.6,2.5h-.1Z" />
                                            <path class="b" d="M523.6,371.5c0,1.4,1.1,2.5,2.5,2.6s2.5-1.1,2.6-2.5-1.1-2.5-2.4-2.6-2.5,1.1-2.6,2.5h-.1Z" />
                                            <path class="b" d="M527.5,381.3c0,1.4,1.1,2.5,2.5,2.6s2.5-1.1,2.6-2.5-1.1-2.5-2.4-2.6-2.5,1.1-2.6,2.5h-.1Z" />
                                            <path class="b" d="M532.7,390.4c0,1.4,1.1,2.5,2.5,2.6s2.5-1.1,2.6-2.5-1.1-2.5-2.4-2.6-2.5,1.1-2.6,2.5h-.1Z" />
                                            <path class="b" d="M538.4,399.2c0,1.4,1.1,2.5,2.5,2.6s2.5-1.1,2.6-2.5-1.1-2.5-2.4-2.6-2.5,1.1-2.6,2.5h-.1Z" />
                                            <path class="b" d="M544.6,407.6c0,1.4,1.1,2.5,2.5,2.6s2.5-1.1,2.6-2.5-1.1-2.5-2.4-2.6-2.5,1.1-2.6,2.5h-.1Z" />
                                            <path class="b" d="M552.3,414.7c0,1.4,1.1,2.5,2.5,2.6s2.5-1.1,2.6-2.5-1.1-2.5-2.4-2.6-2.5,1.1-2.6,2.5h-.1Z" />
                                            <path class="b" d="M560,421.9c0,1.4,1.1,2.5,2.5,2.6s2.5-1.1,2.6-2.5-1.1-2.5-2.4-2.6-2.5,1.1-2.6,2.5h-.1Z" />
                                            <path class="b" d="M568.2,428.3c0,1.4,1.1,2.5,2.5,2.6s2.5-1.1,2.6-2.5-1.1-2.5-2.4-2.6-2.5,1.1-2.6,2.5h-.1Z" />
                                            <path class="b" d="M577.4,433.3c0,1.4,1.1,2.5,2.5,2.6s2.5-1.1,2.6-2.5-1.1-2.5-2.4-2.6-2.5,1.1-2.6,2.5h-.1Z" />
                                            <path class="b" d="M586.7,438.3c0,1.4,1.1,2.5,2.5,2.6s2.5-1.1,2.6-2.5-1.1-2.5-2.4-2.6-2.5,1.1-2.6,2.5h-.1Z" />
                                            <path class="b" d="M596.5,441.9c0,1.4,1.1,2.5,2.5,2.6s2.5-1.1,2.6-2.5-1.1-2.5-2.4-2.6-2.5,1.1-2.6,2.5h-.1Z" />
                                            <path class="b" d="M606.5,445c0,1.4,1.1,2.5,2.5,2.6s2.5-1.1,2.6-2.5-1.1-2.5-2.4-2.6-2.5,1.1-2.6,2.5h-.1Z" />
                                            <path class="b" d="M616.8,447.2c0,1.4,1.1,2.5,2.5,2.6s2.5-1.1,2.6-2.5-1.1-2.5-2.4-2.6-2.5,1.1-2.6,2.5h-.1Z" />
                                            <path class="b" d="M627.2,448.7c0,1.4,1.1,2.5,2.5,2.6s2.5-1.1,2.6-2.5-1.1-2.5-2.4-2.6-2.5,1.1-2.6,2.5h-.1Z" />
                                            <path class="b" d="M637.7,448.7c0,1.4,1.1,2.5,2.5,2.6s2.5-1.1,2.6-2.5-1.1-2.5-2.4-2.6-2.5,1.1-2.6,2.5h-.1Z" />
                                            <path class="b" d="M648.1,447.2c0,1.4,1.1,2.5,2.5,2.6s2.5-1.1,2.6-2.5-1.1-2.5-2.4-2.6-2.5,1.1-2.6,2.5h-.1Z" />
                                            <path class="b" d="M658.5,445.7c0,1.4,1.1,2.5,2.5,2.6s2.5-1.1,2.6-2.5-1.1-2.5-2.4-2.6-2.5,1.1-2.6,2.5h-.1Z" />
                                            <path class="b" d="M668.7,443.6c0,1.4,1.1,2.5,2.5,2.6s2.5-1.1,2.6-2.5-1.1-2.5-2.4-2.6-2.5,1.1-2.6,2.5h-.1Z" />
                                            <path class="b" d="M678.3,439.4c0,1.4,1.1,2.5,2.5,2.6s2.5-1.1,2.6-2.5-1.1-2.5-2.4-2.6-2.5,1.1-2.6,2.5h-.1Z" />
                                            <path class="b" d="M688,435.2c0,1.4,1.1,2.5,2.5,2.6s2.5-1.1,2.6-2.5-1.1-2.5-2.4-2.6-2.5,1.1-2.6,2.5h-.1Z" />
                                            <path class="b" d="M697.2,430.3c0,1.4,1.1,2.5,2.5,2.6s2.5-1.1,2.6-2.5-1.1-2.5-2.4-2.6-2.5,1.1-2.6,2.5h-.1Z" />
                                            <path class="b" d="M705.5,423.9c0,1.4,1.1,2.5,2.5,2.6s2.5-1.1,2.6-2.5-1.1-2.5-2.4-2.6-2.5,1.1-2.6,2.5h-.1Z" />
                                            <path class="b" d="M713.8,417.5c0,1.4,1.1,2.5,2.5,2.6s2.5-1.1,2.6-2.5-1.1-2.5-2.4-2.6-2.5,1.1-2.6,2.5h-.1Z" />
                                            <path class="b" d="M721.2,410.1c0,1.4,1.1,2.5,2.5,2.6s2.5-1.1,2.6-2.5-1.1-2.5-2.4-2.6-2.5,1.1-2.6,2.5h-.1Z" />
                                            <path class="b" d="M727.7,401.9c0,1.4,1.1,2.5,2.5,2.6s2.5-1.1,2.6-2.5-1.1-2.5-2.4-2.6-2.5,1.1-2.6,2.5h-.1Z" />
                                            <path class="b" d="M734.2,393.6c0,1.4,1.1,2.5,2.5,2.6s2.5-1.1,2.6-2.5-1.1-2.5-2.4-2.6-2.5,1.1-2.6,2.5h-.1Z" />
                                            <path class="b" d="M738.9,384.3c0,1.4,1.1,2.5,2.5,2.6s2.5-1.1,2.6-2.5-1.1-2.5-2.4-2.6-2.5,1.1-2.6,2.5h-.1Z" />
                                            <path class="b" d="M743.1,374.6c0,1.4,1.1,2.5,2.5,2.6s2.5-1.1,2.6-2.5-1.1-2.5-2.4-2.6-2.5,1.1-2.6,2.5h-.1Z" />
                                            <path class="b" d="M747.3,365c0,1.4,1.1,2.5,2.5,2.6s2.5-1.1,2.6-2.5-1.1-2.5-2.4-2.6-2.5,1.1-2.6,2.5h-.1Z" />
                                            <path class="b" d="M749.3,354.7c0,1.4,1.1,2.5,2.5,2.6s2.5-1.1,2.6-2.5-1.1-2.5-2.4-2.6-2.5,1.1-2.6,2.5h-.1Z" />
                                        </g>
                                        <g xmlns="http://www.w3.org/2000/svg">
                                            <path class="b" d="M771.6,301.7c0-1.4,1.1-2.5,2.5-2.6s2.5,1.1,2.6,2.5-1.1,2.5-2.4,2.6-2.5-1.1-2.6-2.5h-.1Z" />
                                            <path class="b" d="M773.9,291.5c0-1.4,1.1-2.5,2.5-2.6s2.5,1.1,2.6,2.5-1.1,2.5-2.4,2.6-2.5-1.1-2.6-2.5h-.1Z" />
                                            <path class="b" d="M777.4,281.6c0-1.4,1.1-2.5,2.5-2.6s2.5,1.1,2.6,2.5-1.1,2.5-2.4,2.6-2.5-1.1-2.6-2.5h-.1Z" />
                                            <path class="b" d="M781.2,271.8c0-1.4,1.1-2.5,2.5-2.6s2.5,1.1,2.6,2.5-1.1,2.5-2.4,2.6-2.5-1.1-2.6-2.5h-.1Z" />
                                            <path class="b" d="M786.4,262.7c0-1.4,1.1-2.5,2.5-2.6s2.5,1.1,2.6,2.5-1.1,2.5-2.4,2.6-2.5-1.1-2.6-2.5h-.1Z" />
                                            <path class="b" d="M792.1,253.9c0-1.4,1.1-2.5,2.5-2.6s2.5,1.1,2.6,2.4-1.1,2.5-2.4,2.6-2.5-1.1-2.6-2.4h-.1Z" />
                                            <path class="b" d="M798.3,245.5c0-1.4,1.1-2.5,2.5-2.6s2.5,1.1,2.6,2.4-1.1,2.5-2.4,2.6-2.5-1.1-2.6-2.4h-.1Z" />
                                            <path class="b" d="M806,238.4c0-1.4,1.1-2.5,2.5-2.6s2.5,1.1,2.6,2.4-1.1,2.5-2.4,2.6-2.5-1.1-2.6-2.4h-.1Z" />
                                            <path class="b" d="M813.7,231.2c0-1.4,1.1-2.5,2.5-2.6s2.5,1.1,2.6,2.4-1.1,2.5-2.4,2.6-2.5-1.1-2.6-2.4h-.1Z" />
                                            <path class="b" d="M821.9,224.8c0-1.4,1.1-2.5,2.5-2.6s2.5,1.1,2.6,2.4-1.1,2.5-2.4,2.6-2.5-1.1-2.6-2.4h-.1Z" />
                                            <path class="b" d="M831.2,219.8c0-1.4,1.1-2.5,2.5-2.6s2.5,1.1,2.6,2.4-1.1,2.5-2.4,2.6-2.5-1.1-2.6-2.4h-.1Z" />
                                            <path class="b" d="M840.4,214.8c0-1.4,1.1-2.5,2.5-2.6s2.5,1.1,2.6,2.4-1.1,2.5-2.4,2.6-2.5-1.1-2.6-2.4h-.1Z" />
                                            <path class="b" d="M850.3,211.2c0-1.4,1.1-2.5,2.5-2.6s2.5,1.1,2.6,2.4-1.1,2.5-2.4,2.6-2.5-1.1-2.6-2.4h-.1Z" />
                                            <path class="b" d="M860.3,208.1c0-1.4,1.1-2.5,2.5-2.6s2.5,1.1,2.6,2.4-1.1,2.5-2.4,2.6-2.5-1.1-2.6-2.4h-.1Z" />
                                            <path class="b" d="M870.5,205.9c0-1.4,1.1-2.5,2.5-2.6s2.5,1.1,2.6,2.4-1.1,2.5-2.4,2.6-2.5-1.1-2.6-2.4h-.1Z" />
                                            <path class="b" d="M880.9,204.4c0-1.4,1.1-2.5,2.5-2.6s2.5,1.1,2.6,2.4-1.1,2.5-2.4,2.6-2.5-1.1-2.6-2.4h-.1Z" />
                                            <path class="b" d="M891.4,204.4c0-1.4,1.1-2.5,2.5-2.6s2.5,1.1,2.6,2.4-1.1,2.5-2.4,2.6-2.5-1.1-2.6-2.4h-.1Z" />
                                            <path class="b" d="M901.8,205.9c0-1.4,1.1-2.5,2.5-2.6s2.5,1.1,2.6,2.4-1.1,2.5-2.4,2.6-2.5-1.1-2.6-2.4h-.1Z" />
                                            <path class="b" d="M912.2,207.4c0-1.4,1.1-2.5,2.5-2.6s2.5,1.1,2.6,2.4-1.1,2.5-2.4,2.6-2.5-1.1-2.6-2.4h-.1Z" />
                                            <path class="b" d="M922.4,209.5c0-1.4,1.1-2.5,2.5-2.6s2.5,1.1,2.6,2.4-1.1,2.5-2.4,2.6-2.5-1.1-2.6-2.4h-.1Z" />
                                            <path class="b" d="M932.1,213.7c0-1.4,1.1-2.5,2.5-2.6s2.5,1.1,2.6,2.4-1.1,2.5-2.4,2.6-2.5-1.1-2.6-2.4h-.1Z" />
                                            <path class="b" d="M941.7,217.9c0-1.4,1.1-2.5,2.5-2.6s2.5,1.1,2.6,2.4-1.1,2.5-2.4,2.6-2.5-1.1-2.6-2.4h-.1Z" />
                                            <path class="b" d="M950.9,222.8c0-1.4,1.1-2.5,2.5-2.6s2.5,1.1,2.6,2.4-1.1,2.5-2.4,2.6-2.5-1.1-2.6-2.4h-.1Z" />
                                            <path class="b" d="M959.2,229.2c0-1.4,1.1-2.5,2.5-2.6s2.5,1.1,2.6,2.4-1.1,2.5-2.4,2.6-2.5-1.1-2.6-2.4h-.1Z" />
                                            <path class="b" d="M967.6,235.6c0-1.4,1.1-2.5,2.5-2.6s2.5,1.1,2.6,2.4-1.1,2.5-2.4,2.6-2.5-1.1-2.6-2.4h-.1Z" />
                                            <path class="b" d="M974.9,243c0-1.4,1.1-2.5,2.5-2.6s2.5,1.1,2.6,2.4-1.1,2.5-2.4,2.6-2.5-1.1-2.6-2.4h-.1Z" />
                                            <path class="b" d="M981.5,251.2c0-1.4,1.1-2.5,2.5-2.6s2.5,1.1,2.6,2.4-1.1,2.5-2.4,2.6-2.5-1.1-2.6-2.4h-.1Z" />
                                            <path class="b" d="M988,259.5c0-1.4,1.1-2.5,2.5-2.6s2.5,1.1,2.6,2.5-1.1,2.5-2.4,2.6-2.5-1.1-2.6-2.5h-.1Z" />
                                            <path class="b" d="M992.7,268.8c0-1.4,1.1-2.5,2.5-2.6s2.5,1.1,2.6,2.5-1.1,2.5-2.4,2.6-2.5-1.1-2.6-2.5h-.1Z" />
                                            <path class="b" d="M996.9,278.5c0-1.4,1.1-2.5,2.5-2.6s2.5,1.1,2.6,2.5-1.1,2.5-2.4,2.6-2.5-1.1-2.6-2.5h-.1Z" />
                                            <path class="b" d="M1001,288.1c0-1.4,1.1-2.5,2.5-2.6s2.5,1.1,2.6,2.5-1.1,2.5-2.4,2.6-2.5-1.1-2.6-2.5h-.1Z" />
                                            <path class="b" d="M1003,298.4c0-1.4,1.1-2.5,2.5-2.6s2.5,1.1,2.6,2.5-1.1,2.5-2.4,2.6-2.5-1.1-2.6-2.5h-.1Z" />
                                        </g>
                                        <g xmlns="http://www.w3.org/2000/svg">
                                            <path class="b" d="M1027.2,351.4c0,1.4,1.1,2.5,2.4,2.6s2.5-1.1,2.6-2.5-1.1-2.5-2.4-2.6-2.5,1.1-2.6,2.5h0Z" />
                                            <path class="b" d="M1029.6,361.6c0,1.4,1.1,2.5,2.4,2.6s2.5-1.1,2.6-2.5-1.1-2.5-2.4-2.6-2.5,1.1-2.6,2.5h0Z" />
                                            <path class="b" d="M1033,371.5c0,1.4,1.1,2.5,2.4,2.6s2.5-1.1,2.6-2.5-1.1-2.5-2.4-2.6-2.5,1.1-2.6,2.5h0Z" />
                                            <path class="b" d="M1036.8,381.3c0,1.4,1.1,2.5,2.4,2.6s2.5-1.1,2.6-2.5-1.1-2.5-2.4-2.6-2.5,1.1-2.6,2.5h0Z" />
                                            <path class="b" d="M1042,390.4c0,1.4,1.1,2.5,2.4,2.6s2.5-1.1,2.6-2.5-1.1-2.5-2.4-2.6-2.5,1.1-2.6,2.5h0Z" />
                                            <path class="b" d="M1047.7,399.2c0,1.4,1.1,2.5,2.4,2.6s2.5-1.1,2.6-2.5-1.1-2.5-2.4-2.6-2.5,1.1-2.6,2.5h0Z" />
                                            <path class="b" d="M1053.9,407.6c0,1.4,1.1,2.5,2.4,2.6s2.5-1.1,2.6-2.5-1.1-2.5-2.4-2.6-2.5,1.1-2.6,2.5h0Z" />
                                            <path class="b" d="M1061.7,414.7c0,1.4,1.1,2.5,2.4,2.6s2.5-1.1,2.6-2.5-1.1-2.5-2.4-2.6-2.5,1.1-2.6,2.5h0Z" />
                                            <path class="b" d="M1069.4,421.9c0,1.4,1.1,2.5,2.4,2.6s2.5-1.1,2.6-2.5-1.1-2.5-2.4-2.6-2.5,1.1-2.6,2.5h0Z" />
                                            <path class="b" d="M1077.6,428.3c0,1.4,1.1,2.5,2.4,2.6s2.5-1.1,2.6-2.5-1.1-2.5-2.4-2.6-2.5,1.1-2.6,2.5h0Z" />
                                            <path class="b" d="M1086.8,433.3c0,1.4,1.1,2.5,2.4,2.6s2.5-1.1,2.6-2.5-1.1-2.5-2.4-2.6-2.5,1.1-2.6,2.5h0Z" />
                                            <path class="b" d="M1096.1,438.3c0,1.4,1.1,2.5,2.4,2.6s2.5-1.1,2.6-2.5-1.1-2.5-2.4-2.6-2.5,1.1-2.6,2.5h0Z" />
                                            <path class="b" d="M1105.9,441.9c0,1.4,1.1,2.5,2.4,2.6s2.5-1.1,2.6-2.5-1.1-2.5-2.4-2.6-2.5,1.1-2.6,2.5h0Z" />
                                            <path class="b" d="M1115.9,445c0,1.4,1.1,2.5,2.4,2.6s2.5-1.1,2.6-2.5-1.1-2.5-2.4-2.6-2.5,1.1-2.6,2.5h0Z" />
                                            <path class="b" d="M1126.2,447.2c0,1.4,1.1,2.5,2.4,2.6s2.5-1.1,2.6-2.5-1.1-2.5-2.4-2.6-2.5,1.1-2.6,2.5h0Z" />
                                            <path class="b" d="M1136.6,448.7c0,1.4,1.1,2.5,2.4,2.6s2.5-1.1,2.6-2.5-1.1-2.5-2.4-2.6-2.5,1.1-2.6,2.5h0Z" />
                                            <path class="b" d="M1147.1,448.7c0,1.4,1.1,2.5,2.4,2.6s2.5-1.1,2.6-2.5-1.1-2.5-2.4-2.6-2.5,1.1-2.6,2.5h0Z" />
                                            <path class="b" d="M1157.4,447.2c0,1.4,1.1,2.5,2.4,2.6s2.5-1.1,2.6-2.5-1.1-2.5-2.4-2.6-2.5,1.1-2.6,2.5h0Z" />
                                            <path class="b" d="M1167.8,445.7c0,1.4,1.1,2.5,2.4,2.6s2.5-1.1,2.6-2.5-1.1-2.5-2.4-2.6-2.5,1.1-2.6,2.5h0Z" />
                                            <path class="b" d="M1178.1,443.6c0,1.4,1.1,2.5,2.4,2.6s2.5-1.1,2.6-2.5-1.1-2.5-2.4-2.6-2.5,1.1-2.6,2.5h0Z" />
                                            <path class="b" d="M1187.7,439.4c0,1.4,1.1,2.5,2.4,2.6s2.5-1.1,2.6-2.5-1.1-2.5-2.4-2.6-2.5,1.1-2.6,2.5h0Z" />
                                            <path class="b" d="M1197.4,435.2c0,1.4,1.1,2.5,2.4,2.6s2.5-1.1,2.6-2.5-1.1-2.5-2.4-2.6-2.5,1.1-2.6,2.5h0Z" />
                                            <path class="b" d="M1206.6,430.3c0,1.4,1.1,2.5,2.4,2.6s2.5-1.1,2.6-2.5-1.1-2.5-2.4-2.6-2.5,1.1-2.6,2.5h0Z" />
                                            <path class="b" d="M1214.9,423.9c0,1.4,1.1,2.5,2.4,2.6s2.5-1.1,2.6-2.5-1.1-2.5-2.4-2.6-2.5,1.1-2.6,2.5h0Z" />
                                            <path class="b" d="M1223.2,417.5c0,1.4,1.1,2.5,2.4,2.6s2.5-1.1,2.6-2.5-1.1-2.5-2.4-2.6-2.5,1.1-2.6,2.5h0Z" />
                                            <path class="b" d="M1230.6,410.1c0,1.4,1.1,2.5,2.4,2.6s2.5-1.1,2.6-2.5-1.1-2.5-2.4-2.6-2.5,1.1-2.6,2.5h0Z" />
                                            <path class="b" d="M1237.1,401.9c0,1.4,1.1,2.5,2.4,2.6s2.5-1.1,2.6-2.5-1.1-2.5-2.4-2.6-2.5,1.1-2.6,2.5h0Z" />
                                            <path class="b" d="M1243.6,393.6c0,1.4,1.1,2.5,2.4,2.6s2.5-1.1,2.6-2.5-1.1-2.5-2.4-2.6-2.5,1.1-2.6,2.5h0Z" />
                                            <path class="b" d="M1248.3,384.3c0,1.4,1.1,2.5,2.4,2.6s2.5-1.1,2.6-2.5-1.1-2.5-2.4-2.6-2.5,1.1-2.6,2.5h0Z" />
                                            <path class="b" d="M1252.5,374.6c0,1.4,1.1,2.5,2.4,2.6s2.5-1.1,2.6-2.5-1.1-2.5-2.4-2.6-2.5,1.1-2.6,2.5h0Z" />
                                            <path class="b" d="M1256.6,365c0,1.4,1.1,2.5,2.4,2.6s2.5-1.1,2.6-2.5-1.1-2.5-2.4-2.6-2.5,1.1-2.6,2.5h0Z" />
                                            <path class="b" d="M1258.7,354.7c0,1.4,1.1,2.5,2.4,2.6s2.5-1.1,2.6-2.5-1.1-2.5-2.4-2.6-2.5,1.1-2.6,2.5h0Z" />
                                        </g>
                                        <g xmlns="http://www.w3.org/2000/svg">
                                            <path class="b" d="M1280.9,301.7c0-1.4,1.1-2.5,2.4-2.6s2.5,1.1,2.6,2.5-1.1,2.5-2.4,2.6-2.5-1.1-2.6-2.5h0Z" />
                                            <path class="b" d="M1283.2,291.5c0-1.4,1.1-2.5,2.4-2.6s2.5,1.1,2.6,2.5-1.1,2.5-2.4,2.6-2.5-1.1-2.6-2.5h0Z" />
                                            <path class="b" d="M1286.7,281.6c0-1.4,1.1-2.5,2.4-2.6s2.5,1.1,2.6,2.5-1.1,2.5-2.4,2.6-2.5-1.1-2.6-2.5h0Z" />
                                            <path class="b" d="M1290.5,271.8c0-1.4,1.1-2.5,2.4-2.6s2.5,1.1,2.6,2.5-1.1,2.5-2.4,2.6-2.5-1.1-2.6-2.5h0Z" />
                                            <path class="b" d="M1295.7,262.7c0-1.4,1.1-2.5,2.4-2.6s2.5,1.1,2.6,2.5-1.1,2.5-2.4,2.6-2.5-1.1-2.6-2.5h0Z" />
                                            <path class="b" d="M1301.4,253.9c0-1.4,1.1-2.5,2.4-2.6s2.5,1.1,2.6,2.4-1.1,2.5-2.4,2.6-2.5-1.1-2.6-2.4h0Z" />
                                            <path class="b" d="M1307.6,245.5c0-1.4,1.1-2.5,2.4-2.6s2.5,1.1,2.6,2.4-1.1,2.5-2.4,2.6-2.5-1.1-2.6-2.4h0Z" />
                                            <path class="b" d="M1315.3,238.4c0-1.4,1.1-2.5,2.4-2.6s2.5,1.1,2.6,2.4-1.1,2.5-2.4,2.6-2.5-1.1-2.6-2.4h0Z" />
                                            <path class="b" d="M1323.1,231.2c0-1.4,1.1-2.5,2.4-2.6s2.5,1.1,2.6,2.4-1.1,2.5-2.4,2.6-2.5-1.1-2.6-2.4h0Z" />
                                            <path class="b" d="M1331.2,224.8c0-1.4,1.1-2.5,2.4-2.6s2.5,1.1,2.6,2.4-1.1,2.5-2.4,2.6-2.5-1.1-2.6-2.4h0Z" />
                                            <path class="b" d="M1340.5,219.8c0-1.4,1.1-2.5,2.4-2.6s2.5,1.1,2.6,2.4-1.1,2.5-2.4,2.6-2.5-1.1-2.6-2.4h0Z" />
                                            <path class="b" d="M1349.8,214.8c0-1.4,1.1-2.5,2.4-2.6s2.5,1.1,2.6,2.4-1.1,2.5-2.4,2.6-2.5-1.1-2.6-2.4h0Z" />
                                            <path class="b" d="M1359.6,211.2c0-1.4,1.1-2.5,2.4-2.6s2.5,1.1,2.6,2.4-1.1,2.5-2.4,2.6-2.5-1.1-2.6-2.4h0Z" />
                                            <path class="b" d="M1369.6,208.1c0-1.4,1.1-2.5,2.4-2.6s2.5,1.1,2.6,2.4-1.1,2.5-2.4,2.6-2.5-1.1-2.6-2.4h0Z" />
                                            <path class="b" d="M1379.9,205.9c0-1.4,1.1-2.5,2.4-2.6s2.5,1.1,2.6,2.4-1.1,2.5-2.4,2.6-2.5-1.1-2.6-2.4h0Z" />
                                            <path class="b" d="M1390.3,204.4c0-1.4,1.1-2.5,2.4-2.6s2.5,1.1,2.6,2.4-1.1,2.5-2.4,2.6-2.5-1.1-2.6-2.4h0Z" />
                                            <path class="b" d="M1400.8,204.4c0-1.4,1.1-2.5,2.4-2.6s2.5,1.1,2.6,2.4-1.1,2.5-2.4,2.6-2.5-1.1-2.6-2.4h0Z" />
                                            <path class="b" d="M1411.2,205.9c0-1.4,1.1-2.5,2.4-2.6s2.5,1.1,2.6,2.4-1.1,2.5-2.4,2.6-2.5-1.1-2.6-2.4h0Z" />
                                            <path class="b" d="M1421.5,207.4c0-1.4,1.1-2.5,2.4-2.6s2.5,1.1,2.6,2.4-1.1,2.5-2.4,2.6-2.5-1.1-2.6-2.4h0Z" />
                                            <path class="b" d="M1431.8,209.5c0-1.4,1.1-2.5,2.4-2.6s2.5,1.1,2.6,2.4-1.1,2.5-2.4,2.6-2.5-1.1-2.6-2.4h0Z" />
                                            <path class="b" d="M1441.4,213.7c0-1.4,1.1-2.5,2.4-2.6s2.5,1.1,2.6,2.4-1.1,2.5-2.4,2.6-2.5-1.1-2.6-2.4h0Z" />
                                            <path class="b" d="M1451.1,217.9c0-1.4,1.1-2.5,2.4-2.6s2.5,1.1,2.6,2.4-1.1,2.5-2.4,2.6-2.5-1.1-2.6-2.4h0Z" />
                                            <path class="b" d="M1460.2,222.8c0-1.4,1.1-2.5,2.4-2.6s2.5,1.1,2.6,2.4-1.1,2.5-2.4,2.6-2.5-1.1-2.6-2.4h0Z" />
                                            <path class="b" d="M1468.6,229.2c0-1.4,1.1-2.5,2.4-2.6s2.5,1.1,2.6,2.4c0,1.4-1.1,2.5-2.4,2.6s-2.5-1.1-2.6-2.4h0Z" />
                                            <path class="b" d="M1476.9,235.6c0-1.4,1.1-2.5,2.4-2.6s2.5,1.1,2.6,2.4-1.1,2.5-2.4,2.6-2.5-1.1-2.6-2.4h0Z" />
                                            <path class="b" d="M1484.3,243c0-1.4,1.1-2.5,2.4-2.6s2.5,1.1,2.6,2.4-1.1,2.5-2.4,2.6-2.5-1.1-2.6-2.4h0Z" />
                                            <path class="b" d="M1490.8,251.2c0-1.4,1.1-2.5,2.4-2.6s2.5,1.1,2.6,2.4-1.1,2.5-2.4,2.6-2.5-1.1-2.6-2.4h0Z" />
                                            <path class="b" d="M1497.3,259.5c0-1.4,1.1-2.5,2.4-2.6s2.5,1.1,2.6,2.5-1.1,2.5-2.4,2.6-2.5-1.1-2.6-2.5h0Z" />
                                            <path class="b" d="M1502,268.8c0-1.4,1.1-2.5,2.4-2.6s2.5,1.1,2.6,2.5-1.1,2.5-2.4,2.6-2.5-1.1-2.6-2.5h0Z" />
                                            <path class="b" d="M1506.2,278.5c0-1.4,1.1-2.5,2.4-2.6s2.5,1.1,2.6,2.5-1.1,2.5-2.4,2.6-2.5-1.1-2.6-2.5h0Z" />
                                            <path class="b" d="M1510.3,288.1c0-1.4,1.1-2.5,2.4-2.6s2.5,1.1,2.6,2.5-1.1,2.5-2.4,2.6-2.5-1.1-2.6-2.5h0Z" />
                                            <path class="b" d="M1512.4,298.4c0-1.4,1.1-2.5,2.4-2.6s2.5,1.1,2.6,2.5-1.1,2.5-2.4,2.6-2.5-1.1-2.6-2.5h0Z" />
                                        </g>
                                        <g xmlns="http://www.w3.org/2000/svg">
                                            <path class="b" d="M1539.1,351.9c0,1.4,1.1,2.5,2.5,2.5s2.5-1.1,2.5-2.5-1.1-2.5-2.5-2.5-2.5,1.1-2.5,2.5Z" />
                                            <path class="b" d="M1541.6,362.1c0,1.4,1.1,2.5,2.5,2.5s2.5-1.1,2.5-2.5-1.1-2.5-2.5-2.5-2.5,1.1-2.5,2.5Z" />
                                            <path class="b" d="M1545.3,371.9c0,1.4,1.1,2.5,2.5,2.5s2.5-1.1,2.5-2.5-1.1-2.5-2.5-2.5-2.5,1.1-2.5,2.5Z" />
                                            <path class="b" d="M1549.4,381.6c0,1.4,1.1,2.5,2.5,2.5s2.5-1.1,2.5-2.5-1.1-2.5-2.5-2.5-2.5,1.1-2.5,2.5Z" />
                                            <path class="b" d="M1554.8,390.6c0,1.4,1.1,2.5,2.5,2.5s2.5-1.1,2.5-2.5-1.1-2.5-2.5-2.5-2.5,1.1-2.5,2.5Z" />
                                            <path class="b" d="M1560.7,399.2c0,1.4,1.1,2.5,2.5,2.5s2.5-1.1,2.5-2.5-1.1-2.5-2.5-2.5-2.5,1.1-2.5,2.5Z" />
                                            <path class="b" d="M1567.2,407.5c0,1.4,1.1,2.5,2.5,2.5s2.5-1.1,2.5-2.5-1.1-2.5-2.5-2.5-2.5,1.1-2.5,2.5Z" />
                                            <path class="b" d="M1575,414.5c0,1.4,1.1,2.5,2.5,2.5s2.5-1.1,2.5-2.5-1.1-2.5-2.5-2.5-2.5,1.1-2.5,2.5Z" />
                                            <path class="b" d="M1582.9,421.4c0,1.4,1.1,2.5,2.5,2.5s2.5-1.1,2.5-2.5-1.1-2.5-2.5-2.5-2.5,1.1-2.5,2.5Z" />
                                            <path class="b" d="M1591.3,427.7c0,1.4,1.1,2.5,2.5,2.5s2.5-1.1,2.5-2.5-1.1-2.5-2.5-2.5-2.5,1.1-2.5,2.5Z" />
                                            <path class="b" d="M1600.6,432.4c0,1.4,1.1,2.5,2.5,2.5s2.5-1.1,2.5-2.5-1.1-2.5-2.5-2.5-2.5,1.1-2.5,2.5Z" />
                                            <path class="b" d="M1610,437.2c0,1.4,1.1,2.5,2.5,2.5s2.5-1.1,2.5-2.5-1.1-2.5-2.5-2.5-2.5,1.1-2.5,2.5Z" />
                                            <path class="b" d="M1619.9,440.5c0,1.4,1.1,2.5,2.5,2.5s2.5-1.1,2.5-2.5-1.1-2.5-2.5-2.5-2.5,1.1-2.5,2.5Z" />
                                            <path class="b" d="M1630,443.4c0,1.4,1.1,2.5,2.5,2.5s2.5-1.1,2.5-2.5-1.1-2.5-2.5-2.5-2.5,1.1-2.5,2.5Z" />
                                            <path class="b" d="M1640.3,445.3c0,1.4,1.1,2.5,2.5,2.5s2.5-1.1,2.5-2.5-1.1-2.5-2.5-2.5-2.5,1.1-2.5,2.5Z" />
                                            <path class="b" d="M1650.8,446.6c0,1.4,1.1,2.5,2.5,2.5s2.5-1.1,2.5-2.5-1.1-2.5-2.5-2.5-2.5,1.1-2.5,2.5Z" />
                                            <path class="b" d="M1661.2,446.4c0,1.4,1.1,2.5,2.5,2.5s2.5-1.1,2.5-2.5-1.1-2.5-2.5-2.5-2.5,1.1-2.5,2.5Z" />
                                            <path class="b" d="M1671.6,444.6c0,1.4,1.1,2.5,2.5,2.5s2.5-1.1,2.5-2.5-1.1-2.5-2.5-2.5-2.5,1.1-2.5,2.5Z" />
                                            <path class="b" d="M1681.9,442.8c0,1.4,1.1,2.5,2.5,2.5s2.5-1.1,2.5-2.5-1.1-2.5-2.5-2.5-2.5,1.1-2.5,2.5Z" />
                                            <path class="b" d="M1692.1,440.4c0,1.4,1.1,2.5,2.5,2.5s2.5-1.1,2.5-2.5-1.1-2.5-2.5-2.5-2.5,1.1-2.5,2.5Z" />
                                            <path class="b" d="M1701.7,436c0,1.4,1.1,2.5,2.5,2.5s2.5-1.1,2.5-2.5-1.1-2.5-2.5-2.5-2.5,1.1-2.5,2.5Z" />
                                            <path class="b" d="M1711.2,431.6c0,1.4,1.1,2.5,2.5,2.5s2.5-1.1,2.5-2.5-1.1-2.5-2.5-2.5-2.5,1.1-2.5,2.5Z" />
                                            <path class="b" d="M1720.3,426.5c0,1.4,1.1,2.5,2.5,2.5s2.5-1.1,2.5-2.5-1.1-2.5-2.5-2.5-2.5,1.1-2.5,2.5Z" />
                                            <path class="b" d="M1728.4,419.9c0,1.4,1.1,2.5,2.5,2.5s2.5-1.1,2.5-2.5-1.1-2.5-2.5-2.5-2.5,1.1-2.5,2.5Z" />
                                            <path class="b" d="M1736.6,413.3c0,1.4,1.1,2.5,2.5,2.5s2.5-1.1,2.5-2.5-1.1-2.5-2.5-2.5-2.5,1.1-2.5,2.5Z" />
                                            <path class="b" d="M1743.8,405.7c0,1.4,1.1,2.5,2.5,2.5s2.5-1.1,2.5-2.5-1.1-2.5-2.5-2.5-2.5,1.1-2.5,2.5Z" />
                                            <path class="b" d="M1750.1,397.3c0,1.4,1.1,2.5,2.5,2.5s2.5-1.1,2.5-2.5-1.1-2.5-2.5-2.5-2.5,1.1-2.5,2.5Z" />
                                            <path class="b" d="M1756.4,388.9c0,1.4,1.1,2.5,2.5,2.5s2.5-1.1,2.5-2.5-1.1-2.5-2.5-2.5-2.5,1.1-2.5,2.5Z" />
                                            <path class="b" d="M1760.9,379.5c0,1.4,1.1,2.5,2.5,2.5s2.5-1.1,2.5-2.5-1.1-2.5-2.5-2.5-2.5,1.1-2.5,2.5Z" />
                                            <path class="b" d="M1764.8,369.7c0,1.4,1.1,2.5,2.5,2.5s2.5-1.1,2.5-2.5-1.1-2.5-2.5-2.5-2.5,1.1-2.5,2.5Z" />
                                            <path class="b" d="M1768.8,360c0,1.4,1.1,2.5,2.5,2.5s2.5-1.1,2.5-2.5-1.1-2.5-2.5-2.5-2.5,1.1-2.5,2.5Z" />
                                            <path class="b" d="M1770.5,349.6c0,1.4,1.1,2.5,2.5,2.5s2.5-1.1,2.5-2.5-1.1-2.5-2.5-2.5-2.5,1.1-2.5,2.5Z" />
                                            <path class="b" d="M1772.3,339.3c0,1.4,1.1,2.5,2.5,2.5s2.5-1.1,2.5-2.5-1.1-2.5-2.5-2.5-2.5,1.1-2.5,2.5Z" />
                                        </g>
                                        <g xmlns="http://www.w3.org/2000/svg">
                                            <path class="b" d="M377.8,188.5c0,1.5,1.2,2.6,2.6,2.6s2.6-1.2,2.6-2.6-1.2-2.6-2.6-2.6-2.6,1.2-2.6,2.6Z" />
                                            <path class="b" d="M377.8,177.9c0,1.5,1.2,2.6,2.6,2.6s2.6-1.2,2.6-2.6-1.2-2.6-2.6-2.6-2.6,1.2-2.6,2.6Z" />
                                            <path class="b" d="M377.8,167.2c0,1.5,1.2,2.6,2.6,2.6s2.6-1.2,2.6-2.6-1.2-2.6-2.6-2.6-2.6,1.2-2.6,2.6Z" />
                                            <path class="b" d="M377.8,156.5c0,1.5,1.2,2.6,2.6,2.6s2.6-1.2,2.6-2.6-1.2-2.6-2.6-2.6-2.6,1.2-2.6,2.6Z" />
                                            <path class="b" d="M377.8,145.9c0,1.5,1.2,2.6,2.6,2.6s2.6-1.2,2.6-2.6-1.2-2.6-2.6-2.6-2.6,1.2-2.6,2.6Z" />
                                            <path class="b" d="M377.8,135.2c0,1.5,1.2,2.6,2.6,2.6s2.6-1.2,2.6-2.6-1.2-2.6-2.6-2.6-2.6,1.2-2.6,2.6Z" />
                                            <path class="b" d="M377.8,124.5c0,1.5,1.2,2.6,2.6,2.6s2.6-1.2,2.6-2.6-1.2-2.6-2.6-2.6-2.6,1.2-2.6,2.6Z" />
                                            <path class="b" d="M380.7,114.5c0,1.5,1.2,2.6,2.6,2.6s2.6-1.2,2.6-2.6-1.2-2.6-2.6-2.6-2.6,1.2-2.6,2.6Z" />
                                            <path class="b" d="M388.1,107c0,1.5,1.2,2.6,2.6,2.6s2.6-1.2,2.6-2.6-1.2-2.6-2.6-2.6-2.6,1.2-2.6,2.6Z" />
                                            <path class="b" d="M397.9,103.2c0,1.5,1.2,2.6,2.6,2.6s2.6-1.2,2.6-2.6-1.2-2.6-2.6-2.6-2.6,1.2-2.6,2.6Z" />
                                            <path class="b" d="M408.5,102.9c0,1.5,1.2,2.6,2.6,2.6s2.6-1.2,2.6-2.6-1.2-2.6-2.6-2.6-2.6,1.2-2.6,2.6Z" />
                                            <path class="b" d="M419.2,102.9c0,1.5,1.2,2.6,2.6,2.6s2.6-1.2,2.6-2.6-1.2-2.6-2.6-2.6-2.6,1.2-2.6,2.6Z" />
                                            <path class="b" d="M429.8,102.9c0,1.5,1.2,2.6,2.6,2.6s2.6-1.2,2.6-2.6-1.2-2.6-2.6-2.6-2.6,1.2-2.6,2.6Z" />
                                            <path class="b" d="M440.5,102.9c0,1.5,1.2,2.6,2.6,2.6s2.6-1.2,2.6-2.6-1.2-2.6-2.6-2.6-2.6,1.2-2.6,2.6Z" />
                                            <path class="b" d="M451.2,102.9c0,1.5,1.2,2.6,2.6,2.6s2.6-1.2,2.6-2.6-1.2-2.6-2.6-2.6-2.6,1.2-2.6,2.6Z" />
                                            <path class="b" d="M461.8,102.9c0,1.5,1.2,2.6,2.6,2.6s2.6-1.2,2.6-2.6-1.2-2.6-2.6-2.6-2.6,1.2-2.6,2.6Z" />
                                            <path class="b" d="M472.5,102.9c0,1.5,1.2,2.6,2.6,2.6s2.6-1.2,2.6-2.6-1.2-2.6-2.6-2.6-2.6,1.2-2.6,2.6Z" />
                                            <path class="b" d="M483.2,102.9c0,1.5,1.2,2.6,2.6,2.6s2.6-1.2,2.6-2.6-1.2-2.6-2.6-2.6-2.6,1.2-2.6,2.6Z" />
                                            <path class="b" d="M493.9,102.9c0,1.5,1.2,2.6,2.6,2.6s2.6-1.2,2.6-2.6-1.2-2.6-2.6-2.6-2.6,1.2-2.6,2.6Z" />
                                            <path class="b" d="M504.5,102.9c0,1.5,1.2,2.6,2.6,2.6s2.6-1.2,2.6-2.6-1.2-2.6-2.6-2.6-2.6,1.2-2.6,2.6Z" />
                                            <path class="b" d="M515.2,102.9c0,1.5,1.2,2.6,2.6,2.6s2.6-1.2,2.6-2.6-1.2-2.6-2.6-2.6-2.6,1.2-2.6,2.6Z" />
                                            <path class="b" d="M525.9,102.9c0,1.5,1.2,2.6,2.6,2.6s2.6-1.2,2.6-2.6-1.2-2.6-2.6-2.6-2.6,1.2-2.6,2.6Z" />
                                            <path class="b" d="M536.5,102.9c0,1.5,1.2,2.6,2.6,2.6s2.6-1.2,2.6-2.6-1.2-2.6-2.6-2.6-2.6,1.2-2.6,2.6Z" />
                                            <path class="b" d="M547.2,102.9c0,1.5,1.2,2.6,2.6,2.6s2.6-1.2,2.6-2.6-1.2-2.6-2.6-2.6-2.6,1.2-2.6,2.6Z" />
                                            <path class="b" d="M557.9,102.9c0,1.5,1.2,2.6,2.6,2.6s2.6-1.2,2.6-2.6-1.2-2.6-2.6-2.6-2.6,1.2-2.6,2.6Z" />
                                            <path class="b" d="M568.5,102.9c0,1.5,1.2,2.6,2.6,2.6s2.6-1.2,2.6-2.6-1.2-2.6-2.6-2.6-2.6,1.2-2.6,2.6Z" />
                                            <path class="b" d="M579.2,102.9c0,1.5,1.2,2.6,2.6,2.6s2.6-1.2,2.6-2.6-1.2-2.6-2.6-2.6-2.6,1.2-2.6,2.6Z" />
                                            <path class="b" d="M589.9,102.9c0,1.5,1.2,2.6,2.6,2.6s2.6-1.2,2.6-2.6-1.2-2.6-2.6-2.6-2.6,1.2-2.6,2.6Z" />
                                            <path class="b" d="M600.5,102.9c0,1.5,1.2,2.6,2.6,2.6s2.6-1.2,2.6-2.6-1.2-2.6-2.6-2.6-2.6,1.2-2.6,2.6Z" />
                                            <path class="b" d="M611.2,102.9c0,1.5,1.2,2.6,2.6,2.6s2.6-1.2,2.6-2.6-1.2-2.6-2.6-2.6-2.6,1.2-2.6,2.6Z" />
                                            <path class="b" d="M621.9,102.9c0,1.5,1.2,2.6,2.6,2.6s2.6-1.2,2.6-2.6-1.2-2.6-2.6-2.6-2.6,1.2-2.6,2.6Z" />
                                            <path class="b" d="M632.5,102.9c0,1.5,1.2,2.6,2.6,2.6s2.6-1.2,2.6-2.6-1.2-2.6-2.6-2.6-2.6,1.2-2.6,2.6Z" />
                                            <path class="b" d="M643.2,102.9c0,1.5,1.2,2.6,2.6,2.6s2.6-1.2,2.6-2.6-1.2-2.6-2.6-2.6-2.6,1.2-2.6,2.6Z" />
                                            <path class="b" d="M653.9,102.9c0,1.5,1.2,2.6,2.6,2.6s2.6-1.2,2.6-2.6-1.2-2.6-2.6-2.6-2.6,1.2-2.6,2.6Z" />
                                            <path class="b" d="M664.6,102.9c0,1.5,1.2,2.6,2.6,2.6s2.6-1.2,2.6-2.6-1.2-2.6-2.6-2.6-2.6,1.2-2.6,2.6Z" />
                                            <path class="b" d="M675.2,102.9c0,1.5,1.2,2.6,2.6,2.6s2.6-1.2,2.6-2.6-1.2-2.6-2.6-2.6-2.6,1.2-2.6,2.6Z" />
                                            <path class="b" d="M685.9,102.9c0,1.5,1.2,2.6,2.6,2.6s2.6-1.2,2.6-2.6-1.2-2.6-2.6-2.6-2.6,1.2-2.6,2.6Z" />
                                            <path class="b" d="M696.6,102.9c0,1.5,1.2,2.6,2.6,2.6s2.6-1.2,2.6-2.6-1.2-2.6-2.6-2.6-2.6,1.2-2.6,2.6Z" />
                                            <path class="b" d="M707.2,102.9c0,1.5,1.2,2.6,2.6,2.6s2.6-1.2,2.6-2.6-1.2-2.6-2.6-2.6-2.6,1.2-2.6,2.6Z" />
                                            <path class="b" d="M717.9,102.9c0,1.5,1.2,2.6,2.6,2.6s2.6-1.2,2.6-2.6-1.2-2.6-2.6-2.6-2.6,1.2-2.6,2.6Z" />
                                            <path class="b" d="M728.6,102.9c0,1.5,1.2,2.6,2.6,2.6s2.6-1.2,2.6-2.6-1.2-2.6-2.6-2.6-2.6,1.2-2.6,2.6Z" />
                                            <path class="b" d="M739.2,102.9c0,1.5,1.2,2.6,2.6,2.6s2.6-1.2,2.6-2.6-1.2-2.6-2.6-2.6-2.6,1.2-2.6,2.6Z" />
                                            <path class="b" d="M749.9,102.9c0,1.5,1.2,2.6,2.6,2.6s2.6-1.2,2.6-2.6-1.2-2.6-2.6-2.6-2.6,1.2-2.6,2.6Z" />
                                            <path class="b" d="M760.6,102.9c0,1.5,1.2,2.6,2.6,2.6s2.6-1.2,2.6-2.6-1.2-2.6-2.6-2.6-2.6,1.2-2.6,2.6Z" />
                                            <path class="b" d="M771.2,102.9c0,1.5,1.2,2.6,2.6,2.6s2.6-1.2,2.6-2.6-1.2-2.6-2.6-2.6-2.6,1.2-2.6,2.6Z" />
                                            <path class="b" d="M781.9,102.9c0,1.5,1.2,2.6,2.6,2.6s2.6-1.2,2.6-2.6-1.2-2.6-2.6-2.6-2.6,1.2-2.6,2.6Z" />
                                            <path class="b" d="M792.6,102.9c0,1.5,1.2,2.6,2.6,2.6s2.6-1.2,2.6-2.6-1.2-2.6-2.6-2.6-2.6,1.2-2.6,2.6Z" />
                                            <path class="b" d="M803.2,102.9c0,1.5,1.2,2.6,2.6,2.6s2.6-1.2,2.6-2.6-1.2-2.6-2.6-2.6-2.6,1.2-2.6,2.6Z" />
                                            <path class="b" d="M813.9,102.9c0,1.5,1.2,2.6,2.6,2.6s2.6-1.2,2.6-2.6-1.2-2.6-2.6-2.6-2.6,1.2-2.6,2.6Z" />
                                            <path class="b" d="M824.6,102.9c0,1.5,1.2,2.6,2.6,2.6s2.6-1.2,2.6-2.6-1.2-2.6-2.6-2.6-2.6,1.2-2.6,2.6Z" />
                                            <path class="b" d="M835.2,102.9c0,1.5,1.2,2.6,2.6,2.6s2.6-1.2,2.6-2.6-1.2-2.6-2.6-2.6-2.6,1.2-2.6,2.6Z" />
                                            <path class="b" d="M845.9,102.9c0,1.5,1.2,2.6,2.6,2.6s2.6-1.2,2.6-2.6-1.2-2.6-2.6-2.6-2.6,1.2-2.6,2.6Z" />
                                            <path class="b" d="M856.6,102.9c0,1.5,1.2,2.6,2.6,2.6s2.6-1.2,2.6-2.6-1.2-2.6-2.6-2.6-2.6,1.2-2.6,2.6Z" />
                                            <path class="b" d="M867.2,102.9c0,1.5,1.2,2.6,2.6,2.6s2.6-1.2,2.6-2.6-1.2-2.6-2.6-2.6-2.6,1.2-2.6,2.6Z" />
                                            <path class="b" d="M877.9,102.9c0,1.5,1.2,2.6,2.6,2.6s2.6-1.2,2.6-2.6-1.2-2.6-2.6-2.6-2.6,1.2-2.6,2.6Z" />
                                            <path class="b" d="M888.6,102.9c0,1.5,1.2,2.6,2.6,2.6s2.6-1.2,2.6-2.6-1.2-2.6-2.6-2.6-2.6,1.2-2.6,2.6Z" />
                                            <path class="b" d="M899.2,102.9c0,1.5,1.2,2.6,2.6,2.6s2.6-1.2,2.6-2.6-1.2-2.6-2.6-2.6-2.6,1.2-2.6,2.6Z" />
                                            <path class="b" d="M909.9,102.9c0,1.5,1.2,2.6,2.6,2.6s2.6-1.2,2.6-2.6-1.2-2.6-2.6-2.6-2.6,1.2-2.6,2.6Z" />
                                            <path class="b" d="M920.6,102.9c0,1.5,1.2,2.6,2.6,2.6s2.6-1.2,2.6-2.6-1.2-2.6-2.6-2.6-2.6,1.2-2.6,2.6Z" />
                                            <path class="b" d="M931.2,102.9c0,1.5,1.2,2.6,2.6,2.6s2.6-1.2,2.6-2.6-1.2-2.6-2.6-2.6-2.6,1.2-2.6,2.6Z" />
                                            <path class="b" d="M941.9,102.9c0,1.5,1.2,2.6,2.6,2.6s2.6-1.2,2.6-2.6-1.2-2.6-2.6-2.6-2.6,1.2-2.6,2.6Z" />
                                            <path class="b" d="M952.6,102.9c0,1.5,1.2,2.6,2.6,2.6s2.6-1.2,2.6-2.6-1.2-2.6-2.6-2.6-2.6,1.2-2.6,2.6Z" />
                                            <path class="b" d="M963.2,102.9c0,1.5,1.2,2.6,2.6,2.6s2.6-1.2,2.6-2.6-1.2-2.6-2.6-2.6-2.6,1.2-2.6,2.6Z" />
                                            <path class="b" d="M973.9,102.9c0,1.5,1.2,2.6,2.6,2.6s2.6-1.2,2.6-2.6-1.2-2.6-2.6-2.6-2.6,1.2-2.6,2.6Z" />
                                            <path class="b" d="M984.6,102.9c0,1.5,1.2,2.6,2.6,2.6s2.6-1.2,2.6-2.6-1.2-2.6-2.6-2.6-2.6,1.2-2.6,2.6Z" />
                                            <path class="b" d="M995.2,102.9c0,1.5,1.2,2.6,2.6,2.6s2.6-1.2,2.6-2.6-1.2-2.6-2.6-2.6-2.6,1.2-2.6,2.6Z" />
                                            <path class="b" d="M1005.9,102.9c0,1.5,1.2,2.6,2.6,2.6s2.6-1.2,2.6-2.6-1.2-2.6-2.6-2.6-2.6,1.2-2.6,2.6Z" />
                                            <path class="b" d="M1016.6,102.9c0,1.5,1.2,2.6,2.6,2.6s2.6-1.2,2.6-2.6-1.2-2.6-2.6-2.6-2.6,1.2-2.6,2.6Z" />
                                            <path class="b" d="M1027.3,102.9c0,1.5,1.2,2.6,2.6,2.6s2.6-1.2,2.6-2.6-1.2-2.6-2.6-2.6-2.6,1.2-2.6,2.6Z" />
                                            <path class="b" d="M1037.9,102.9c0,1.5,1.2,2.6,2.6,2.6s2.6-1.2,2.6-2.6-1.2-2.6-2.6-2.6-2.6,1.2-2.6,2.6Z" />
                                            <path class="b" d="M1048.6,102.9c0,1.5,1.2,2.6,2.6,2.6s2.6-1.2,2.6-2.6-1.2-2.6-2.6-2.6-2.6,1.2-2.6,2.6Z" />
                                            <path class="b" d="M1059.3,102.9c0,1.5,1.2,2.6,2.6,2.6s2.6-1.2,2.6-2.6-1.2-2.6-2.6-2.6-2.6,1.2-2.6,2.6Z" />
                                            <path class="b" d="M1069.9,102.9c0,1.5,1.2,2.6,2.6,2.6s2.6-1.2,2.6-2.6-1.2-2.6-2.6-2.6-2.6,1.2-2.6,2.6Z" />
                                            <path class="b" d="M1080.6,102.9c0,1.5,1.2,2.6,2.6,2.6s2.6-1.2,2.6-2.6-1.2-2.6-2.6-2.6-2.6,1.2-2.6,2.6Z" />
                                            <path class="b" d="M1091.3,102.9c0,1.5,1.2,2.6,2.6,2.6s2.6-1.2,2.6-2.6-1.2-2.6-2.6-2.6-2.6,1.2-2.6,2.6Z" />
                                            <path class="b" d="M1101.9,102.9c0,1.5,1.2,2.6,2.6,2.6s2.6-1.2,2.6-2.6-1.2-2.6-2.6-2.6-2.6,1.2-2.6,2.6Z" />
                                            <path class="b" d="M1112.6,102.9c0,1.5,1.2,2.6,2.6,2.6s2.6-1.2,2.6-2.6-1.2-2.6-2.6-2.6-2.6,1.2-2.6,2.6Z" />
                                            <path class="b" d="M1123.3,102.9c0,1.5,1.2,2.6,2.6,2.6s2.6-1.2,2.6-2.6-1.2-2.6-2.6-2.6-2.6,1.2-2.6,2.6Z" />
                                            <path class="b" d="M1133.9,102.9c0,1.5,1.2,2.6,2.6,2.6s2.6-1.2,2.6-2.6-1.2-2.6-2.6-2.6-2.6,1.2-2.6,2.6Z" />
                                            <path class="b" d="M1144.6,102.9c0,1.5,1.2,2.6,2.6,2.6s2.6-1.2,2.6-2.6-1.2-2.6-2.6-2.6-2.6,1.2-2.6,2.6Z" />
                                            <path class="b" d="M1155.3,102.9c0,1.5,1.2,2.6,2.6,2.6s2.6-1.2,2.6-2.6-1.2-2.6-2.6-2.6-2.6,1.2-2.6,2.6Z" />
                                            <path class="b" d="M1165.9,102.9c0,1.5,1.2,2.6,2.6,2.6s2.6-1.2,2.6-2.6-1.2-2.6-2.6-2.6-2.6,1.2-2.6,2.6Z" />
                                            <path class="b" d="M1176.6,102.9c0,1.5,1.2,2.6,2.6,2.6s2.6-1.2,2.6-2.6-1.2-2.6-2.6-2.6-2.6,1.2-2.6,2.6Z" />
                                            <path class="b" d="M1187.3,102.9c0,1.5,1.2,2.6,2.6,2.6s2.6-1.2,2.6-2.6-1.2-2.6-2.6-2.6-2.6,1.2-2.6,2.6Z" />
                                            <path class="b" d="M1198,102.9c0,1.5,1.2,2.6,2.6,2.6s2.6-1.2,2.6-2.6-1.2-2.6-2.6-2.6-2.6,1.2-2.6,2.6Z" />
                                            <path class="b" d="M1208.6,102.9c0,1.5,1.2,2.6,2.6,2.6s2.6-1.2,2.6-2.6-1.2-2.6-2.6-2.6-2.6,1.2-2.6,2.6Z" />
                                            <path class="b" d="M1219.3,102.9c0,1.5,1.2,2.6,2.6,2.6s2.6-1.2,2.6-2.6-1.2-2.6-2.6-2.6-2.6,1.2-2.6,2.6Z" />
                                            <path class="b" d="M1230,102.9c0,1.5,1.2,2.6,2.6,2.6s2.6-1.2,2.6-2.6-1.2-2.6-2.6-2.6-2.6,1.2-2.6,2.6Z" />
                                            <path class="b" d="M1240.6,102.9c0,1.5,1.2,2.6,2.6,2.6s2.6-1.2,2.6-2.6-1.2-2.6-2.6-2.6-2.6,1.2-2.6,2.6Z" />
                                            <path class="b" d="M1251.3,102.9c0,1.5,1.2,2.6,2.6,2.6s2.6-1.2,2.6-2.6-1.2-2.6-2.6-2.6-2.6,1.2-2.6,2.6Z" />
                                            <path class="b" d="M1262,102.9c0,1.5,1.2,2.6,2.6,2.6s2.6-1.2,2.6-2.6-1.2-2.6-2.6-2.6-2.6,1.2-2.6,2.6Z" />
                                            <path class="b" d="M1272.6,102.9c0,1.5,1.2,2.6,2.6,2.6s2.6-1.2,2.6-2.6-1.2-2.6-2.6-2.6-2.6,1.2-2.6,2.6Z" />
                                            <path class="b" d="M1283.3,102.9c0,1.5,1.2,2.6,2.6,2.6s2.6-1.2,2.6-2.6-1.2-2.6-2.6-2.6-2.6,1.2-2.6,2.6Z" />
                                            <path class="b" d="M1294,102.9c0,1.5,1.2,2.6,2.6,2.6s2.6-1.2,2.6-2.6-1.2-2.6-2.6-2.6-2.6,1.2-2.6,2.6Z" />
                                            <path class="b" d="M1304.6,102.9c0,1.5,1.2,2.6,2.6,2.6s2.6-1.2,2.6-2.6-1.2-2.6-2.6-2.6-2.6,1.2-2.6,2.6Z" />
                                            <path class="b" d="M1315.3,102.9c0,1.5,1.2,2.6,2.6,2.6s2.6-1.2,2.6-2.6-1.2-2.6-2.6-2.6-2.6,1.2-2.6,2.6Z" />
                                            <path class="b" d="M1326,102.9c0,1.5,1.2,2.6,2.6,2.6s2.6-1.2,2.6-2.6-1.2-2.6-2.6-2.6-2.6,1.2-2.6,2.6Z" />
                                            <path class="b" d="M1336.6,102.9c0,1.5,1.2,2.6,2.6,2.6s2.6-1.2,2.6-2.6-1.2-2.6-2.6-2.6-2.6,1.2-2.6,2.6Z" />
                                            <path class="b" d="M1347.3,102.9c0,1.5,1.2,2.6,2.6,2.6s2.6-1.2,2.6-2.6-1.2-2.6-2.6-2.6-2.6,1.2-2.6,2.6Z" />
                                            <path class="b" d="M1358,102.9c0,1.5,1.2,2.6,2.6,2.6s2.6-1.2,2.6-2.6-1.2-2.6-2.6-2.6-2.6,1.2-2.6,2.6Z" />
                                            <path class="b" d="M1368.6,102.9c0,1.5,1.2,2.6,2.6,2.6s2.6-1.2,2.6-2.6-1.2-2.6-2.6-2.6-2.6,1.2-2.6,2.6Z" />
                                            <path class="b" d="M1379.3,102.9c0,1.5,1.2,2.6,2.6,2.6s2.6-1.2,2.6-2.6-1.2-2.6-2.6-2.6-2.6,1.2-2.6,2.6Z" />
                                            <path class="b" d="M1389.7,105.1c0,1.5,1.2,2.6,2.6,2.6s2.6-1.2,2.6-2.6-1.2-2.6-2.6-2.6-2.6,1.2-2.6,2.6Z" />
                                            <path class="b" d="M1397.5,112.2c0,1.5,1.2,2.6,2.6,2.6s2.6-1.2,2.6-2.6-1.2-2.6-2.6-2.6-2.6,1.2-2.6,2.6Z" />
                                            <path class="b" d="M1400.7,122.2c0,1.5,1.2,2.6,2.6,2.6s2.6-1.2,2.6-2.6-1.2-2.6-2.6-2.6-2.6,1.2-2.6,2.6Z" />
                                            <path class="b" d="M1400.7,132.8c0,1.5,1.2,2.6,2.6,2.6s2.6-1.2,2.6-2.6-1.2-2.6-2.6-2.6-2.6,1.2-2.6,2.6Z" />
                                            <path class="b" d="M1400.7,143.5c0,1.5,1.2,2.6,2.6,2.6s2.6-1.2,2.6-2.6-1.2-2.6-2.6-2.6-2.6,1.2-2.6,2.6Z" />
                                            <path class="b" d="M1400.7,154.2c0,1.5,1.2,2.6,2.6,2.6s2.6-1.2,2.6-2.6-1.2-2.6-2.6-2.6-2.6,1.2-2.6,2.6Z" />
                                            <path class="b" d="M1400.7,164.8c0,1.5,1.2,2.6,2.6,2.6s2.6-1.2,2.6-2.6-1.2-2.6-2.6-2.6-2.6,1.2-2.6,2.6Z" />
                                            <path class="b" d="M1400.7,175.5c0,1.5,1.2,2.6,2.6,2.6s2.6-1.2,2.6-2.6-1.2-2.6-2.6-2.6-2.6,1.2-2.6,2.6Z" />
                                            <path class="b" d="M1400.7,186.2c0,1.5,1.2,2.6,2.6,2.6s2.6-1.2,2.6-2.6-1.2-2.6-2.6-2.6-2.6,1.2-2.6,2.6Z" />
                                            <path class="b" d="M1400.7,196.8c0,1.5,1.2,2.6,2.6,2.6s2.6-1.2,2.6-2.6-1.2-2.6-2.6-2.6-2.6,1.2-2.6,2.6Z" />
                                        </g>
                                        <g xmlns="http://www.w3.org/2000/svg">
                                            <path class="b" d="M889.4,196.9c0,1.4,1.1,2.5,2.5,2.5s2.5-1.1,2.5-2.5-1.1-2.5-2.5-2.5-2.5,1.1-2.5,2.5Z" />
                                            <path class="b" d="M889.4,186.2c0,1.4,1.1,2.5,2.5,2.5s2.5-1.1,2.5-2.5-1.1-2.5-2.5-2.5-2.5,1.1-2.5,2.5Z" />
                                            <path class="b" d="M889.4,175.6c0,1.4,1.1,2.5,2.5,2.5s2.5-1.1,2.5-2.5-1.1-2.5-2.5-2.5-2.5,1.1-2.5,2.5Z" />
                                            <path class="b" d="M889.4,164.9c0,1.4,1.1,2.5,2.5,2.5s2.5-1.1,2.5-2.5-1.1-2.5-2.5-2.5-2.5,1.1-2.5,2.5Z" />
                                            <path class="b" d="M889.8,154.3c0,1.4,1.1,2.5,2.5,2.5s2.5-1.1,2.5-2.5-1.1-2.5-2.5-2.5-2.5,1.1-2.5,2.5Z" />
                                            <path class="b" d="M895.4,145.4c0,1.4,1.1,2.5,2.5,2.5s2.5-1.1,2.5-2.5-1.1-2.5-2.5-2.5-2.5,1.1-2.5,2.5Z" />
                                            <path class="b" d="M904.9,140.8c0,1.4,1.1,2.5,2.5,2.5s2.5-1.1,2.5-2.5-1.1-2.5-2.5-2.5-2.5,1.1-2.5,2.5Z" />
                                            <path class="b" d="M915.5,140.5c0,1.4,1.1,2.5,2.5,2.5s2.5-1.1,2.5-2.5-1.1-2.5-2.5-2.5-2.5,1.1-2.5,2.5Z" />
                                            <path class="b" d="M926.2,140.5c0,1.4,1.1,2.5,2.5,2.5s2.5-1.1,2.5-2.5-1.1-2.5-2.5-2.5-2.5,1.1-2.5,2.5Z" />
                                            <path class="b" d="M936.8,140.5c0,1.4,1.1,2.5,2.5,2.5s2.5-1.1,2.5-2.5-1.1-2.5-2.5-2.5-2.5,1.1-2.5,2.5Z" />
                                            <path class="b" d="M947.5,140.5c0,1.4,1.1,2.5,2.5,2.5s2.5-1.1,2.5-2.5-1.1-2.5-2.5-2.5-2.5,1.1-2.5,2.5Z" />
                                            <path class="b" d="M958.2,140.5c0,1.4,1.1,2.5,2.5,2.5s2.5-1.1,2.5-2.5-1.1-2.5-2.5-2.5-2.5,1.1-2.5,2.5Z" />
                                            <path class="b" d="M968.8,140.5c0,1.4,1.1,2.5,2.5,2.5s2.5-1.1,2.5-2.5-1.1-2.5-2.5-2.5-2.5,1.1-2.5,2.5Z" />
                                            <path class="b" d="M979.5,140.5c0,1.4,1.1,2.5,2.5,2.5s2.5-1.1,2.5-2.5-1.1-2.5-2.5-2.5-2.5,1.1-2.5,2.5Z" />
                                            <path class="b" d="M990.2,140.5c0,1.4,1.1,2.5,2.5,2.5s2.5-1.1,2.5-2.5-1.1-2.5-2.5-2.5-2.5,1.1-2.5,2.5Z" />
                                            <path class="b" d="M1000.8,140.5c0,1.4,1.1,2.5,2.5,2.5s2.5-1.1,2.5-2.5-1.1-2.5-2.5-2.5-2.5,1.1-2.5,2.5Z" />
                                            <path class="b" d="M1011.5,140.5c0,1.4,1.1,2.5,2.5,2.5s2.5-1.1,2.5-2.5-1.1-2.5-2.5-2.5-2.5,1.1-2.5,2.5Z" />
                                            <path class="b" d="M1022.2,140.5c0,1.4,1.1,2.5,2.5,2.5s2.5-1.1,2.5-2.5-1.1-2.5-2.5-2.5-2.5,1.1-2.5,2.5h0Z" />
                                            <path class="b" d="M1032.8,140.5c0,1.4,1.1,2.5,2.5,2.5s2.5-1.1,2.5-2.5-1.1-2.5-2.5-2.5-2.5,1.1-2.5,2.5Z" />
                                            <path class="b" d="M1043.5,140.5c0,1.4,1.1,2.5,2.5,2.5s2.5-1.1,2.5-2.5-1.1-2.5-2.5-2.5-2.5,1.1-2.5,2.5Z" />
                                            <path class="b" d="M1054.2,140.5c0,1.4,1.1,2.5,2.5,2.5s2.5-1.1,2.5-2.5-1.1-2.5-2.5-2.5-2.5,1.1-2.5,2.5Z" />
                                            <path class="b" d="M1064.9,140.5c0,1.4,1.1,2.5,2.5,2.5s2.5-1.1,2.5-2.5-1.1-2.5-2.5-2.5-2.5,1.1-2.5,2.5Z" />
                                            <path class="b" d="M1075.5,140.5c0,1.4,1.1,2.5,2.5,2.5s2.5-1.1,2.5-2.5-1.1-2.5-2.5-2.5-2.5,1.1-2.5,2.5Z" />
                                            <path class="b" d="M1086.2,140.5c0,1.4,1.1,2.5,2.5,2.5s2.5-1.1,2.5-2.5-1.1-2.5-2.5-2.5-2.5,1.1-2.5,2.5Z" />
                                            <path class="b" d="M1096.9,140.5c0,1.4,1.1,2.5,2.5,2.5s2.5-1.1,2.5-2.5-1.1-2.5-2.5-2.5-2.5,1.1-2.5,2.5Z" />
                                            <path class="b" d="M1107.5,140.5c0,1.4,1.1,2.5,2.5,2.5s2.5-1.1,2.5-2.5-1.1-2.5-2.5-2.5-2.5,1.1-2.5,2.5Z" />
                                            <path class="b" d="M1118.2,140.5c0,1.4,1.1,2.5,2.5,2.5s2.5-1.1,2.5-2.5-1.1-2.5-2.5-2.5-2.5,1.1-2.5,2.5Z" />
                                            <path class="b" d="M1128.9,140.5c0,1.4,1.1,2.5,2.5,2.5s2.5-1.1,2.5-2.5-1.1-2.5-2.5-2.5-2.5,1.1-2.5,2.5Z" />
                                            <path class="b" d="M1138.8,143.5c0,1.4,1.1,2.5,2.5,2.5s2.5-1.1,2.5-2.5-1.1-2.5-2.5-2.5-2.5,1.1-2.5,2.5Z" />
                                            <path class="b" d="M1145,151.8c0,1.4,1.1,2.5,2.5,2.5s2.5-1.1,2.5-2.5-1.1-2.5-2.5-2.5-2.5,1.1-2.5,2.5Z" />
                                            <path class="b" d="M1145.9,162.4c0,1.4,1.1,2.5,2.5,2.5s2.5-1.1,2.5-2.5-1.1-2.5-2.5-2.5-2.5,1.1-2.5,2.5Z" />
                                            <path class="b" d="M1145.9,173c0,1.4,1.1,2.5,2.5,2.5s2.5-1.1,2.5-2.5-1.1-2.5-2.5-2.5-2.5,1.1-2.5,2.5Z" />
                                            <path class="b" d="M1145.9,183.7c0,1.4,1.1,2.5,2.5,2.5s2.5-1.1,2.5-2.5-1.1-2.5-2.5-2.5-2.5,1.1-2.5,2.5Z" />
                                            <path class="b" d="M1145.9,194.4c0,1.4,1.1,2.5,2.5,2.5s2.5-1.1,2.5-2.5-1.1-2.5-2.5-2.5-2.5,1.1-2.5,2.5Z" />
                                        </g>
                                    </svg>
                                </div>
                                <div class="circle-texts small-size">
                                    <?php if (have_rows('acf_how_we_do_it_first_slide_items')) :
                                    ?>
                                        <?php while (have_rows('acf_how_we_do_it_first_slide_items')): the_row();
                                            $circle_text = get_sub_field('acf_how_we_do_it_circle_title') ?: ''; ?>
                                            <h3 class="words"><?php echo $circle_text; ?></h3>
                                        <?php endwhile; ?>
                                    <?php else : ?>
                                        <p></p>
                                    <?php endif; ?>
                                </div>
                                <div class="circle-graphics small-size">
                                    <?php if (have_rows('acf_how_we_do_it_first_slide_items')) :
                                    ?>
                                        <?php while (have_rows('acf_how_we_do_it_first_slide_items')): the_row();
                                            $circle_graphic = get_sub_field('acf_how_we_do_it_circle_graphic_url') ?: '';
                                            $circle_text = get_sub_field('acf_how_we_do_it_circle_title') ?: 'Circle Graphic'; ?>

                                            <img class="graphic manual-lazy-load" data-src="<?php echo $circle_graphic; ?>" src="" alt="<?php echo esc_attr($circle_text); ?>">
                                        <?php endwhile; ?>
                                    <?php else : ?>
                                        <p></p>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <img class="content-image manual-lazy-load" src="" alt="How we do it illustration"/>


                        </div>
                    </div>
                    <div class="content">
                        <div class="text-container small-size"><?php echo $how_we_do_it_common_text_below_image; ?></div>
                        <a href="<?php echo esc_html($how_we_do_it_button_url); ?>" class="cta">
                            <button class="custom-button "><?php echo esc_html($how_we_do_it_button_text); ?></button>
                        </a>

                    </div>
                </div>
                <!-- space below how we do it section  -->
                <div aria-hidden="true" class="wp-block-spacer space-below-how-we-do-it"></div>
                <!-- Our Clients Section -->
                <div class="service-our-clients-section" id="testimonials">
                    <h2 class="main-header large-size font-bold"><?php echo $service_page_our_clients_section_heading ?></h2>
                    <div class="owl-carousel">
                        <?php if (have_rows('acf_our_clients_section_items')) : ?>
                            <?php while (have_rows('acf_our_clients_section_items')): the_row();
                                $left_description_ = get_sub_field('acf_left_description_') ?: '';
                                $client_logo = get_sub_field('acf_client_logo') ?: '';
                                $author_line = get_sub_field('acf_author_line') ?: '';
                                $how_we_help_para_1 = get_sub_field('acf_how_we_help_para_1') ?: '';
                                $how_we_help_para_2 = get_sub_field('acf_how_we_help_para_2') ?: ''; ?>
                                <div class="item service-our-clients-slide">
                                    <div class="main-container">
                                        <img class="img-logo portrait-only manual-lazy-load" data-src="<?php echo esc_html($client_logo) ?>" alt="Logo" src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 5 1'%3E%3C/svg%3E">
                                        <div class="box left-box">
                                            <p class="left-desc smaller-size"><span class="color-ia">"</span><?php echo esc_html($left_description_) ?><span class="color-ia">"</span></p>
                                            <div class="logo-author-box">
                                                <img class="landscape-only img-logo manual-lazy-load" data-src="<?php echo esc_html($client_logo) ?>" alt="Logo" src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 5 1'%3E%3C/svg%3E">
                                                <p class="author-line smaller-size"><?php echo $author_line ?></p>
                                            </div>
                                        </div>
                                        <div class="separator"></div>
                                        <div class="box right-box">
                                            <h2 class="how-we-help-header large-size font-bold"><?php echo esc_html($how_we_help_heading) ?></h2>
                                            <p class="how-we-help-line smaller-size"><?php echo ($how_we_help_para_1) ?></p>
                                            <p class="how-we-help-line smaller-size"><?php echo ($how_we_help_para_2) ?></p>
                                        </div>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                        <?php else : ?>
                            <p>No clients found.</p>
                        <?php endif; ?>
                    </div>
                </div>
                <!-- space below our clients section  -->
                <div aria-hidden="true" class="wp-block-spacer space-below-our-clients"></div>

                <!-- 				you may be interested section -->
                <?php if (!empty($you_may_be_interested_plugin_shortcode)) {
                    echo do_shortcode($you_may_be_interested_plugin_shortcode);
                } ?>
            </div>
        </article>
    </main>
    <?php the_content(); ?>
</div><!-- #primary -->
<?php
if (astra_page_layout() == 'right-sidebar') :
    get_sidebar();
endif;
get_footer();
?>