<?php
/*
    Template Name: About Us
    */

/**
 * Custom about us page template for Astra child theme.
 *
 * This template is specifically for the about us page of the site.
 *
 * @package Astra Child
 * @since 1.0.0
 */

if (! defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

get_header(); ?>
<?php
$banner_background_image = get_field('acf_about_us_banner_background_image');
$banner_title = get_field('acf_about_us_banner_title');
$heading_below_banner = get_field('acf_about_us_heading_below_banner');
$description_below_banner = get_field('acf_about_us_description_below_banner');

$our_commitment_section_main_heading = get_field('acf_about_us_our_commitment_section_main_heading');
//     $svg_our_commitments = get_field('acf_svg_our_commitment');
//     $our_commitment_card_colors = get_field('acf_about_us_our_commitment_card_color');
//     $our_commitment_card_headings = get_field('acf_about_us_our_commitment_card_heading');
//     $our_commitment_card_descriptions = get_field('acf_about_us_our_commitment_card_description');

$our_people_section_main_heading = get_field('acf_about_us_our_people_section_main_heading');
$our_people_sub_heading = get_field('acf_about_us_our_people_sub_heading');
//     $our_people_images = get_field('acf_about_us_our_people_image');
//     $our_people_person_names = get_field('acf_about_us_our_people_person_name');
//     $our_people_designations = get_field('acf_about_us_our_people_designation');
//     $our_people_paragraphs = get_field('acf_about_us_our_people_paragraph');
//     $our_people_button_texts = get_field('acf_about_us_our_people_button_text');
//     $our_people_button_urls = get_field('acf_about_us_our_people_button_url');

$our_difference_gradient_heading = get_field('acf_about_us_our_difference_gradient_heading');
$our_difference_gradient_description = get_field('acf_about_us_our_difference_gradient_description');
$our_difference_gradient_button_text = get_field('acf_about_us_our_difference_gradient_button_text');
$our_difference_gradient_button_url = get_field('acf_about_us_our_difference_gradient_button_url');

//     $counters = get_field('acf_about_us_counter');
//     $counter_texts = get_field('acf_about_us_counter_text');

$featured_insights_section_main_heading = get_field('acf_about_us_featured_insights_section_main_heading');
$featured_insights_text_below_heading = get_field('acf_about_us_featured_insights_text_below_heading');
$featured_insights_plugin_shortcode = get_field('acf_about_us_featured_insights_plugin_shortcode');

$innovation_gradient_heading = get_field('acf_about_us_innovation_gradient_heading');
$innovation_gradient_description = get_field('acf_about_us_innovation_gradient_description');
$innovation_gradient_button_text = get_field('acf_about_us_innovation_gradient_button_text');
$innovation_gradient_button_url = get_field('acf_about_us_innovation_gradient_button_url');

$our_approach_section_main_heading = get_field('acf_our_approach_main_heading');
$our_approach_text_below_heading = get_field('acf_text_below_heading');
//     $our_approach_levels = get_field('acf_about_us_our_approach_levels');
//     $our_approach_level_names = get_field('acf_about_us_our_approach_level_names');
//     $our_approach_popup_contents = get_field('acf_about_us_our_approach_popup_content');
$our_approach_figure_graphics = [
    "/wp-content/uploads/2025/04/Our%20Approach%20Optimise.svg",
    "/wp-content/uploads/2025/04/Our%20Approach%20Measure.svg",
    "/wp-content/uploads/2025/04/Our%20Approach%20Define.svg",
    "/wp-content/uploads/2025/04/Our%20Approach%20Manage.svg",
    "/wp-content/uploads/2025/04/Our%20Approach%20Start.svg",
    "/wp-content/uploads/2025/04/Our%20Approach%20Struggle.svg"
];
$our_approach_popup_colors = [
    '#C2D0D8',
    '#2C79A5',
    '#00CBFF',
    '#00B7B6',
    '#789FF5',
    '#B074FF'
];
$get_to_know_us_section_main_heading = get_field('acf_about_us_get_to_know_us_section_main_heading');
$get_to_know_us_text_below_heading = get_field('acf_about_us_get_to_know_us_text_below_heading');
//     $get_to_know_us_images = get_field('acf_about_us_get_to_know_us_images');
//     $get_to_know_us_image_titles = get_field('acf_about_us_get_to_know_us_image_titles');
//     $get_to_know_us_image_descriptions = get_field('acf_about_us_get_to_know_us_image_descriptions');
//     $get_to_know_us_button_text = get_field('acf_about_us_get_to_know_us_button_text');
//     $get_to_know_us_button_url = get_field('acf_about_us_get_to_know_us_button_url');
$get_to_know_us_discover_button_text = get_field('acf_about_us_get_to_know_us_discover_button_text');
$get_to_know_us_discover_button_url = get_field('acf_about_us_get_to_know_us_discover_button_url');

$rows = get_field('acf_about_us_page_get_to_know_us_better_section_items');
$get_to_know_us_images = [];
$get_to_know_us_image_titles = [];
$get_to_know_us_image_descriptions = [];
$get_to_know_us_button_text = [];
$get_to_know_us_button_url = [];
// $get_to_know_us_images = [
//   $rows[0]['acf_about_us_get_to_know_us_images'],
//   $rows[1]['acf_about_us_get_to_know_us_images'],
// 	$rows[2]['acf_about_us_get_to_know_us_images'],
//   $rows[3]['acf_about_us_get_to_know_us_images']
// ];
// $get_to_know_us_image_titles = [
//  $rows[0]['acf_about_us_get_to_know_us_image_titles'],
//   $rows[1]['acf_about_us_get_to_know_us_image_titles'],
// 	$rows[2]['acf_about_us_get_to_know_us_image_titles'],
//   $rows[3]['acf_about_us_get_to_know_us_image_titles']
// ];
// $get_to_know_us_image_descriptions = [
//   $rows[0]['acf_about_us_get_to_know_us_image_descriptions'],
//   $rows[1]['acf_about_us_get_to_know_us_image_descriptions'],
// 	$rows[2]['acf_about_us_get_to_know_us_image_descriptions'],
//   $rows[3]['acf_about_us_get_to_know_us_image_descriptions']
// ];
// $get_to_know_us_button_text = [
//  $rows[0]['acf_about_us_get_to_know_us_button_text'],
//   $rows[1]['acf_about_us_get_to_know_us_button_text'],
// 	$rows[2]['acf_about_us_get_to_know_us_button_text'],
//   $rows[3]['acf_about_us_get_to_know_us_button_text']
// ];
// $get_to_know_us_button_url = [
//    $rows[0]['acf_about_us_get_to_know_us_button_url'],
//   $rows[1]['acf_about_us_get_to_know_us_button_url'],
// 	$rows[2]['acf_about_us_get_to_know_us_button_url'],
//   $rows[3]['acf_about_us_get_to_know_us_button_url']
// ];
if (!empty($rows) && is_array($rows)) {
    foreach ($rows as $row) {
        $get_to_know_us_images[] = $row['acf_about_us_get_to_know_us_images'] ?? '';
        $get_to_know_us_image_titles[] = $row['acf_about_us_get_to_know_us_image_titles'] ?? '';
        $get_to_know_us_image_descriptions[] = $row['acf_about_us_get_to_know_us_image_descriptions'] ?? '';
        $get_to_know_us_button_text[] = $row['acf_about_us_get_to_know_us_button_text'] ?? '';
        $get_to_know_us_button_url[] = $row['acf_about_us_get_to_know_us_button_url'] ?? '';
    }
}

?>
<?php if (astra_page_layout() == 'left-sidebar') : ?>
    <?php get_sidebar(); ?>
<?php endif ?>
<div id="primary" <?php astra_primary_class(); ?>>
    <main id="main" class="site-main">
        <article id="post-<?php the_ID(); ?>" <?php post_class('ast-article-single'); ?> itemscope itemtype="https://schema.org/CreativeWork">
            <div class="entry-content clear" data-ast-blocks-layout="true" itemprop="text">

                <!-- banner section -->
                <?php if (!empty($banner_background_image)) : ?>
                    <div class="about-us-banner">
                        <div class="banner-area manual-lazy-load" data-src="<?php echo esc_html($banner_background_image) ?>" style="background: linear-gradient(0deg, rgba(67, 102, 143, 0.14) 0%, 
                                        rgba(19, 34, 53, 0.56) 53.5%, 
                                        rgba(49, 77, 109, 0.25) 73.5%, 
                                        rgba(19, 34, 53, 0.56) 100%), 
                        url('data:image/svg+xml,%3Csvgxmlns=\'http://www.w3.org/2000/svg\' viewBox=\'0 0 1 1\'%3E%3C/svg%3E');">
                            <h1 class="about-us-banner-stmt largest-size"><?php echo esc_html($banner_title); ?></h1>
                        </div>
                    </div>
                <?php else : ?>
                    <p>No banner image found.</p>
                <?php endif; ?>

                <!-- text below banner -->
                <div class="about-us-below-banner-sec">
                    <div class="we-belive">
                        <h2 class="belive-heading large-size"><?php echo esc_html($heading_below_banner); ?></h2>
                        <p class="belive medium-size"><?php echo ($description_below_banner); ?></p>
                    </div>
                </div>
                <!-- space-above-our-commitments  -->
                <div aria-hidden="true" class="wp-block-spacer space-above-our-commitments"></div>
                <!-- Our commitment Section -->
                <?php if (!empty($our_commitment_section_main_heading)) : ?>
                    <div class="about-us-our-commitment">
                        <div class="section-header-container">
                            <h2 class="large-size font-bold"><?php echo esc_html($our_commitment_section_main_heading); ?></h2>
                        </div>
                        <div class="brand-pillars">
                            <?php if (have_rows('acf_about_us_page_our_commitment_section_items')) : ?>
                                <?php while (have_rows('acf_about_us_page_our_commitment_section_items')): the_row();


                                    $our_commitment_card_color = get_sub_field('acf_about_us_our_commitment_card_color') ?: '';
                                    $our_commitment_card_description = get_sub_field('acf_about_us_our_commitment_card_description') ?: '';
                                    $our_commitment_card_heading = get_sub_field('acf_about_us_our_commitment_card_heading') ?: '';
                                    $svg_our_commitment = get_sub_field('acf_svg_our_commitment') ?: ''; ?>
                                    <div
                                        class="card-container"
                                        data-circle-image="<?php echo esc_html($svg_our_commitment); ?>"
                                        data-color="<?php echo esc_html($our_commitment_card_color); ?>"
                                        data-heading="<?php echo esc_html($our_commitment_card_heading); ?>"
                                        data-description="<?php echo esc_html($our_commitment_card_description); ?>">
                                        <div class="circle"></div>
                                        <div class="card">
                                            <div class="card-content">
                                                <div class="heading-container">
                                                    <h3 class="small-size font-bold"></h3>
                                                    <svg
                                                        class="toggle-icon"
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        width="21"
                                                        height="16"
                                                        viewBox="0 0 21 16"
                                                        fill="none">
                                                        <path
                                                            d="M11.3452 15.5599C10.949 16.1502 10.0808 16.1502 9.68465 15.5599L0.721698 2.20733C0.27576 1.54299 0.751857 0.649994 1.55199 0.649994L19.4779 0.649996C20.278 0.649996 20.7541 1.54299 20.3082 2.20733L11.3452 15.5599Z"
                                                            fill="#B175FF" />
                                                    </svg>
                                                </div>
                                                <p class="smallest-size"></p>
                                            </div>
                                        </div>
                                    </div>

                                <?php endwhile; ?>
                            <?php else : ?>
                                <p>No commitment head found.</p>
                            <?php endif; ?>

                        </div>
                    </div>
                <?php else : ?>
                    <p>No benefits found.</p>
                <?php endif; ?>


                <!-- space-below-our-commitments  -->
                <div aria-hidden="true" class="wp-block-spacer space-below-our-commitments"></div>
                <!-- our people  -->
                <?php if (!empty($our_people_section_main_heading)) : ?>
                    <div class="about-our-people">
                        <div class="header-subheader">
                            <h2 class="main-header large-size font-bold"><?php echo esc_html($our_people_section_main_heading); ?></h2>
                            <p class="description small-size"><?php echo esc_html($our_people_sub_heading); ?></p>
                        </div>
                        <div class="only-progress-circle">
                            <div class="progress-wrapper">
                                <svg class="circle-chart" viewBox="0 0 120 120">
                                    <circle class="circle-bg" cx="60" cy="60" r="58"></circle>
                                    <circle class="circle-progress" cx="60" cy="60" r="58"></circle>
                                </svg>
                            </div>
                            <div class="empty-right"></div>
                        </div>
                        <div class="owl-carousel">
                            <?php if (have_rows('acf_about_us_page_our_people_section_items')) : ?>
                                <?php while (have_rows('acf_about_us_page_our_people_section_items')): the_row();

                                    $our_people_image = get_sub_field('acf_about_us_our_people_image') ?: '';
                                    $our_people_button_text = get_sub_field('acf_about_us_our_people_button_text') ?: '';
                                    $our_people_button_url = get_sub_field('acf_about_us_our_people_button_url') ?: '';
                                    $our_people_designation = get_sub_field('acf_about_us_our_people_designation') ?: '';
                                    $our_people_paragraph = get_sub_field('acf_about_us_our_people_paragraph') ?: '';
                                    $our_people_person_name = get_sub_field('acf_about_us_our_people_person_name') ?: ''; ?>
                                    <div class="item">
                                        <div class="leader-card">
                                            <div class="leader-img">
                                                <div class="progress-wrapper">
                                                    <div class="circle-content" data-src="<?php echo esc_html($our_people_image) ?>" src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1 1'%3E%3C/svg%3E">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="leader-info">
                                                <p class="leader-name large-size font-bold"><?php echo esc_html($our_people_person_name) ?></p>
                                                <p class="leader-designation small-size font-bold"><?php echo esc_html($our_people_designation) ?></p>
                                                <p class="leader-note medium-size"><?php echo esc_html($our_people_paragraph) ?></p>
                                                <button onclick="window.location.href='<?php echo esc_html($our_people_button_url) ?>';" class="cta-button custom-button"><?php echo esc_html($our_people_button_text) ?></button>
                                            </div>
                                        </div>
                                    </div>


                                <?php endwhile; ?>
                            <?php else : ?>
                                <p>No people profile found.</p>
                            <?php endif; ?>

                        </div>

                    </div>
                <?php else : ?>
                    <p>No section heading found found.</p>
                <?php endif; ?>

                <!-- space-below-our-people/  -->
                <div aria-hidden="true" class="wp-block-spacer space-below-our-people"></div>
                <!-- about us gradient section  -->
                <div class="about-us-grad1">
                    <div class="gradient-container-about-us-1">
                        <div class="bg">
                            <div class="gradient gradient-1"></div>
                            <div class="gradient gradient-2"></div>
                            <div class="gradient gradient-3"></div>
                        </div>
                        <div class="content">
                            <h2 class="large-size"><?php echo esc_html($our_difference_gradient_heading) ?></h2>
                            <p class="small-size abt-grad-desc"><?php echo esc_html($our_difference_gradient_description) ?></p>
                        </div>
                        <div class="button-container">
                            <button class="join-btn custom-button smaller-size" onclick="window.location.href='<?php echo esc_html($our_difference_gradient_button_url) ?>';"><?php echo esc_html($our_difference_gradient_button_text) ?></button>
                        </div>
                    </div>
                    <div class="button-mob-tab">
                        <button class="join-btn custom-button  smaller-size" onclick="window.location.href='<?php echo esc_html($our_difference_gradient_button_url) ?>';"><?php echo esc_html($our_difference_gradient_button_text) ?></button>
                    </div>
                </div>
                <!-- space-above-our-counters -->
                <div aria-hidden="true" class="wp-block-spacer space-above-our-counters"></div>
                <!-- counters section  -->
                <div class="about-us-counters-container">
                    <div class="content">
                        <div class="number-container">
                            <?php if (have_rows('acf_homepage_counters_single_slide')) : ?>
                                <?php while (have_rows('acf_homepage_counters_single_slide')): the_row();
                                    $counter = get_sub_field('acf_counter') ?: '';
                                    $counter_text = get_sub_field('acf_counter_text') ?: '';  ?>
                                    <div class="items">
                                        <p class="counter"><?php echo esc_html($counter) ?></p>
                                        <p class="counter-text"><?php echo $counter_text ?></p>
                                    </div>
                                <?php endwhile; ?>
                            <?php else : ?>
                                <p>No counters found.</p>
                            <?php endif; ?>

                        </div>
                    </div>
                </div>

                <!-- our approach section  -->
                <?php if (!empty($our_approach_section_main_heading)) : ?>
                    <!-- our approach section  -->
                    <!-- space-above-our-approach  -->
                    <div aria-hidden="true" class="wp-block-spacer space-above-our-approach"></div>
                    <div class="our-approach-header-box">
                        <h2 class="main-header large-size font-bold"><?php echo esc_html($our_approach_section_main_heading); ?></h2>
                        <p class="sub-header small-size"><?php echo esc_html($our_approach_text_below_heading); ?></p>
                    </div>

                    <div class="approach-section">
                        <div class="container-fluid">
                            <div class="approach-box">
                                <?php if (have_rows('acf_our_approach_items')) :
                                    $index = -1; ?>
                                    <?php while (have_rows('acf_our_approach_items')) : the_row();
                                        $index++;
                                        $our_approach_level_name = get_sub_field('acf_service_page_our_approach_level_names') ?: '';
                                        $our_approach_level = get_sub_field('acf_service_page_our_approach_levels') ?: '';
                                        $our_approach_figure_graphic = $our_approach_figure_graphics[$index] ?: ''; ?>
                                        <div class="poly-box poly-box<?php echo esc_html(6 - $index); ?>">
                                            <div class="empty-space-box"></div>
                                            <div class="poly">
                                                <span class="number medium-size"><?php echo esc_html($our_approach_level); ?></span>
                                            </div>
                                            <div class="txt">
                                                <a href="javascript:void(0);" class="linkbtn" data-popup="popup<?php echo esc_html(6 - $index); ?>">
                                                    <span class="medium-size font-bold"><?php echo esc_html($our_approach_level_name); ?></span>
                                                    <i class="fa-solid ">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="19" height="27" viewBox="0 0 19 27" fill="none">
                                                            <path d="M1 25.2976L17.1946 13.1438L1 1" stroke="white" stroke-width="2"
                                                                stroke-linecap="round" stroke-linejoin="round" />
                                                        </svg>
                                                    </i>
                                                </a>
                                            </div>
                                            <div class="icon-box">
                                                <div class="icon">
                                                    <img data-src="<?php echo esc_html($our_approach_figure_graphic); ?>" class="manual-lazy-load img-fluid" alt=""
                                                        src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1 1'%3E%3C/svg%3E">
                                                </div>
                                            </div>
                                        </div>
                                    <?php endwhile; ?>
                                <?php else : ?>
                                    <p>No approach items found.</p>
                                <?php endif; ?>
                            </div>
                        </div>

                        <?php if (have_rows('acf_our_approach_items')) :
                            $index = -1; ?>
                            <?php while (have_rows('acf_our_approach_items')) : the_row();
                                $index++;
                                $our_approach_popup_content = get_sub_field('acf_service_page_our_approach_popup_content') ?: ''; ?>
                                <div class="popup" id="popup<?php echo esc_html(6 - $index); ?>">
                                    <div class="popup-content" style="background-color: <?php echo esc_html($our_approach_popup_colors[5 - $index]); ?>;">
                                        <span class="close">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32" fill="none">
                                                <path d="M9.00391 9.00391L23.0039 23.0039" stroke="#1A2C47" stroke-width="2"
                                                    stroke-linecap="round" />
                                                <path d="M9.00391 23L23.0039 8.99999" stroke="#1A2C47" stroke-width="2"
                                                    stroke-linecap="round" />
                                                <circle cx="16" cy="16" r="15.5" stroke="#1A2C47" />
                                            </svg>
                                        </span>
                                        <ul class="list"><?php echo $our_approach_popup_content; ?></ul>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                        <?php else : ?>
                            <p>No approach popups found.</p>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>

                <!-- space-above-featured-insights  -->
                <div aria-hidden="true" class="wp-block-spacer space-above-featured-insights"></div>
                <!-- featured insights section  -->
                <div class="section-header-container featured-insight-header-area">
                    <h2 class="main-header large-size font-bold"><?php echo esc_html($featured_insights_section_main_heading); ?></h2>
                    <h3 class="sub-header small-size"><?php echo esc_html($featured_insights_text_below_heading); ?></h3>
                </div>
                <?php if (!empty($featured_insights_plugin_shortcode)) {
                    echo do_shortcode($featured_insights_plugin_shortcode);
                } ?>
                <a class=" below-featured-insight-button" href="/insights">
                    <button class="custom-button">Discover All Insights</button></a>
                <!-- space-below-featured-insights  -->
                <div aria-hidden="true" class="wp-block-spacer space-below-featured-insights"></div>
                <!-- about us gradient section 2 -->
                <div class="about-us-grad2">
                    <div class="gradient-container-about-us-2">
                        <div class="bg">
                            <div class="gradient gradient-1"></div>
                            <div class="gradient gradient-2"></div>
                            <div class="gradient gradient-3"></div>
                        </div>
                        <div class="content">
                            <h2 class="large-size"><?php echo esc_html($innovation_gradient_heading); ?></h2>
                            <p class="small-size abt-grad-desc"><?php echo esc_html($innovation_gradient_description); ?></p>
                        </div>

                        <div class="button-container">
                            <button class="join-btn custom-button smaller-size" onclick="window.location.href='<?php echo esc_html($innovation_gradient_button_url) ?>';"><?php echo esc_html($innovation_gradient_button_text); ?></button>
                        </div>
                    </div>
                    <div class="button-mob-tab">
                        <button class="join-btn custom-button  smaller-size" onclick="window.location.href='<?php echo esc_html($innovation_gradient_button_url) ?>';"><?php echo esc_html($innovation_gradient_button_text); ?></button>
                    </div>
                </div>
                <!-- space-above-know-us-better  -->
                <div aria-hidden="true" class="wp-block-spacer space-above-know-us-better"></div>
                <!-- get to know us better  -->
                <div class="AboutUs-Innovation-frame">
                    <h2 class="know-us large-size"><?php echo esc_html($get_to_know_us_section_main_heading); ?></h2>
                    <div class="moto">
                        <h3 class="moto-stmt  small-size"><?php echo esc_html($get_to_know_us_text_below_heading); ?></h3>
                        <div class="moto-grid">
                            <div class="grid-item large-left">

                                <img class="manual-lazy-load" data-src="<?php echo esc_html($get_to_know_us_images[0]); ?>" alt="Large Section" src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1 1'%3E%3C/svg%3E" />
                                <div class="know-us-content">
                                    <span class="tag medium-size font-bold"><?php echo esc_html($get_to_know_us_image_titles[0]); ?></span>
                                    <p class="description small-size"><?php echo esc_html($get_to_know_us_image_descriptions[0]); ?></p>
                                    <button class="learn-btn custom-button smaller-size" onclick="window.location.href='<?php echo esc_html($get_to_know_us_button_url[0]) ?>';"><?php echo esc_html($get_to_know_us_button_text[0]); ?><svg xmlns="http://www.w3.org/2000/svg" width="42"
                                            height="24" viewBox="0 0 42 24" fill="none">
                                            <path d="M27 12L3 12" stroke="#1A2C47" stroke-width="2" stroke-linecap="round" />
                                            <path
                                                d="M17 12C17 13.9778 17.5865 15.9112 18.6853 17.5557C19.7841 19.2002 21.3459 20.4819 23.1732 21.2388C25.0004 21.9957 27.0111 22.1937 28.9509 21.8078C30.8907 21.422 32.6725 20.4696 34.0711 19.0711C35.4696 17.6725 36.422 15.8907 36.8078 13.9509C37.1937 12.0111 36.9957 10.0004 36.2388 8.17316C35.4819 6.3459 34.2002 4.78412 32.5557 3.6853C30.9112 2.58649 28.9778 2 27 2C24.3478 2 21.8043 3.05357 19.9289 4.92893C18.0536 6.8043 17 9.34783 17 12Z"
                                                stroke="#1A2C47" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg></button>
                                </div>
                            </div>
                            <div class="grid-right">
                                <div class="grid-item small-right first">

                                    <img class="manual-lazy-load" data-src="<?php echo esc_html($get_to_know_us_images[1]); ?>" src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1 1'%3E%3C/svg%3E" alt="Small Right 1" />
                                    <div class="know-us-content">
                                        <span class="tag tag2 smaller-size font-bold"><?php echo esc_html($get_to_know_us_image_titles[1]); ?></span>
                                        <p class="description desc2 smallest-size"><?php echo esc_html($get_to_know_us_image_descriptions[1]); ?></p>
                                        <button class="learn-btn learn-btn-2 custom-button smallest-size font-bold" onclick="window.location.href='<?php echo esc_html($get_to_know_us_button_url[1]) ?>';"><?php echo esc_html($get_to_know_us_button_text[1]); ?><svg
                                                xmlns="http://www.w3.org/2000/svg" width="42" height="24" viewBox="0 0 42 24"
                                                fill="none">
                                                <path d="M27 12L3 12" stroke="#1A2C47" stroke-width="2" stroke-linecap="round" />
                                                <path
                                                    d="M17 12C17 13.9778 17.5865 15.9112 18.6853 17.5557C19.7841 19.2002 21.3459 20.4819 23.1732 21.2388C25.0004 21.9957 27.0111 22.1937 28.9509 21.8078C30.8907 21.422 32.6725 20.4696 34.0711 19.0711C35.4696 17.6725 36.422 15.8907 36.8078 13.9509C37.1937 12.0111 36.9957 10.0004 36.2388 8.17316C35.4819 6.3459 34.2002 4.78412 32.5557 3.6853C30.9112 2.58649 28.9778 2 27 2C24.3478 2 21.8043 3.05357 19.9289 4.92893C18.0536 6.8043 17 9.34783 17 12Z"
                                                    stroke="#1A2C47" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                                <div class="grid-item small-right second">

                                    <img class="manual-lazy-load" data-src="<?php echo esc_html($get_to_know_us_images[2]); ?>" src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1 1'%3E%3C/svg%3E" alt="Small Right 2" />
                                    <div class="know-us-content">
                                        <span class="tag tag2 smaller-size font-bold"><?php echo esc_html($get_to_know_us_image_titles[2]); ?></span>
                                        <p class="description desc2 smallest-size"><?php echo esc_html($get_to_know_us_image_descriptions[2]); ?></p>
                                        <button class="learn-btn learn-btn-2 custom-button smallest-size font-bold" onclick="window.location.href='<?php echo esc_html($get_to_know_us_button_url[2]) ?>';"><?php echo esc_html($get_to_know_us_button_text[2]); ?><svg
                                                xmlns="http://www.w3.org/2000/svg" width="42" height="24" viewBox="0 0 42 24"
                                                fill="none">
                                                <path d="M27 12L3 12" stroke="#1A2C47" stroke-width="2" stroke-linecap="round" />
                                                <path
                                                    d="M17 12C17 13.9778 17.5865 15.9112 18.6853 17.5557C19.7841 19.2002 21.3459 20.4819 23.1732 21.2388C25.0004 21.9957 27.0111 22.1937 28.9509 21.8078C30.8907 21.422 32.6725 20.4696 34.0711 19.0711C35.4696 17.6725 36.422 15.8907 36.8078 13.9509C37.1937 12.0111 36.9957 10.0004 36.2388 8.17316C35.4819 6.3459 34.2002 4.78412 32.5557 3.6853C30.9112 2.58649 28.9778 2 27 2C24.3478 2 21.8043 3.05357 19.9289 4.92893C18.0536 6.8043 17 9.34783 17 12Z"
                                                    stroke="#1A2C47" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                                <div class="grid-item full-width">

                                    <img class="manual-lazy-load" data-src="<?php echo esc_html($get_to_know_us_images[3]); ?>" alt="Full Width" src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1 1'%3E%3C/svg%3E" />
                                    <div class="know-us-content">
                                        <span class="tag tag3 small-size font-bold"><?php echo esc_html($get_to_know_us_image_titles[3]); ?></span>
                                        <p class="description desc3 smallest-size font-bold"><?php echo esc_html($get_to_know_us_image_descriptions[3]); ?></p>
                                        <button class="learn-btn learn-btn-3 custom-button smallest-size font-bold" onclick="window.location.href='<?php echo esc_html($get_to_know_us_button_url[3]) ?>';"><?php echo esc_html($get_to_know_us_button_text[3]); ?><svg
                                                xmlns="http://www.w3.org/2000/svg" width="42" height="24" viewBox="0 0 42 24"
                                                fill="none">
                                                <path d="M27 12L3 12" stroke="#1A2C47" stroke-width="2" stroke-linecap="round" />
                                                <path
                                                    d="M17 12C17 13.9778 17.5865 15.9112 18.6853 17.5557C19.7841 19.2002 21.3459 20.4819 23.1732 21.2388C25.0004 21.9957 27.0111 22.1937 28.9509 21.8078C30.8907 21.422 32.6725 20.4696 34.0711 19.0711C35.4696 17.6725 36.422 15.8907 36.8078 13.9509C37.1937 12.0111 36.9957 10.0004 36.2388 8.17316C35.4819 6.3459 34.2002 4.78412 32.5557 3.6853C30.9112 2.58649 28.9778 2 27 2C24.3478 2 21.8043 3.05357 19.9289 4.92893C18.0536 6.8043 17 9.34783 17 12Z"
                                                    stroke="#1A2C47" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button class="discover-us custom-button" onclick="window.location.href='<?php echo esc_html($get_to_know_us_discover_button_url) ?>';"><?php echo esc_html($get_to_know_us_discover_button_text); ?></button>
                    </div>
                </div>
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
