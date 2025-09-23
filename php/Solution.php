<?php
/*
    Template Name: Solution
    */

/**
 * Custom solution page template for Astra child theme.
 *
 * This template is specifically for all the solution pages of the site which will be connected as child of either service or sub-service page.
 *
 * @package Astra Child
 * @since 1.0.0
 */

if (! defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

get_header(); ?>

<?php
/*
    Template Name: Sub Service
    */
/**
 * Custom sub-service page template for Astra child theme.
 *
 * This template is specifically for all the sub-service pages of the site.
 *
 * @package Astra Child
 * @since 1.0.0
 */

if (! defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

get_header(); ?>
<?php


$banner_graphic_url = get_field('acf_solution_banner_graphic_url');
$banner_title = get_field('acf_solution_banner_title');
$banner_description = get_field('acf_solution_banner_description');
$banner_button_text = get_field('acf_solution_banner_button_text');
$banner_button_url = get_field('acf_solution_banner_button_url');

$submenu_section_main_heading = get_field('acf_service_submenu_section_main_heading');
$submenu_hrefs = [
    "our-features",
    "benefits",
    "offerings",
    "technology-prowess",
    //         "insights",
    "about-sub-service"
];

$our_features_main_heading = get_field('acf_sub_service_our_features_section_main_heading');

$adrosonic_benefits_section_main_header = get_field('acf_industry_our_capabilities_section_main_heading');

$our_offerings_and_capabilities_main_heading = get_field('acf_our_offerings_and_capabilities_main_heading');

$technology_prowess_section_heading = get_field('acf_technology_prowess_section_heading');

$innovative_solutions_shortcode = get_field('acf_industry_innovative_solutions_shortcode');

$about_sub_service_main_heading = get_field('acf_sub_service_about_section_main_heading');
$about_sub_service_image = get_field('acf_sub_service_circular_image');
$about_sub_service_text1 = get_field('acf_sub_service_text_box_1');
$about_sub_service_text2 = get_field('acf_sub_service_text_box_2');

?>
<?php if (astra_page_layout() == 'left-sidebar') : ?>
    <?php get_sidebar(); ?>
<?php endif ?>
<div id="primary" <?php astra_primary_class(); ?>>
    <main id="main" class="site-main">
        <article id="post-<?php the_ID(); ?>" <?php post_class('ast-article-single'); ?> itemscope itemtype="https://schema.org/CreativeWork">
            <div class="entry-content clear" data-ast-blocks-layout="true" itemprop="text">

                <!-- banner section -->
                <div class="service-banner-sub-menu-together">
                    <div class="service-hero-banner">
                        <div class="left-text-box">
                            <h1 class="largest-size"><?php echo $banner_title; ?></h1>
                            <p class="small-size"><?php echo ($banner_description); ?></p>
                            <button class="custom-button service-get-in-touch" onclick="window.location.href='<?php echo esc_html($banner_button_url) ?>';"><?php echo esc_html($banner_button_text); ?></button>
                        </div>
                        <div class="right-img manual-lazy-load" data-src="<?php echo esc_html($banner_graphic_url); ?>" src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 7 5'%3E%3C/svg%3E"></div>
                    </div>
                    <nav class="service-scroll-menu">
                        <div class="service-menu-dropdown-container open">
                            <p class="service-menu-dropdown-toggle small-size font-bold"><?php echo ($submenu_section_main_heading); ?></p>
                            <ul class="service-scroll-list">

                                <?php if (have_rows('acf_submenu_items')) :
                                    $index = -1; ?>
                                    <?php while (have_rows('acf_submenu_items')): the_row();
                                        $index++;
                                        $submenu_item = get_sub_field('acf_submenu_single_item_name') ?: ''; ?>
                                        <li class="smaller-size font-bold submenu"><a href="#<?php echo esc_html($submenu_hrefs[$index]); ?>"><?php echo ($submenu_item); ?></a></li>
                                    <?php endwhile; ?>
                                <?php else : ?>
                                    <p>No submenu items found.</p>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </nav>
                </div>

                <!-- our features section-->
                <div class="our-features-container" id="our-features">
                    <div class="main-header-container">
                        <h2 class="large-size font-bold main-header"><?php echo ($our_features_main_heading); ?></h2>
                    </div>
                    <div class="items">
                        <?php if (have_rows('acf_sub-service_page_our_features_items')) : ?>
                            <?php while (have_rows('acf_sub-service_page_our_features_items')): the_row();
                                $heading = get_sub_field('acf_sub_service_our_features_heading') ?: '';
                                $logo = get_sub_field('acf_sub_service_our_features_logo') ?: '';
                                $description = get_sub_field('acf_sub_service_our_features_description') ?: ''; ?>

                                <div class="item">
                                    <div class="logo">
                                        <img src="<?php echo esc_html($logo); ?>" alt="">
                                    </div>
                                    <div class="item-content">
                                        <h3 class="small-size font-boldest"><?php echo ($heading); ?></h3>
                                        <p class="smaller-size"><?php echo ($description); ?></p>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                        <?php else : ?>
                            <p>No features found.</p>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- spece below Our features Section  -->
                <div aria-hidden="true" class="wp-block-spacer space-subservicepage-below-our-features"></div>
                <!-- How Adrosonic Benefits Section  -->
                <div class="adro-benefits" id="benefits">
                    <div class="section-header-container">
                        <h2 class="large-size  font-bold"><?php echo $adrosonic_benefits_section_main_header ?></h2>
                    </div>
                    <div class="container">
                        <div class="left-box">
                            <div class="content"></div>
                        </div>
                        <div class="right-box">
                            <ul class="benefits-menu">
                                <?php if (have_rows('acf_our_capabilities_section_fields_items')) :
                                    $index = -1; ?>
                                    <?php while (have_rows('acf_our_capabilities_section_fields_items')): the_row();
                                        $index++;
                                        $benefits_menu_item = get_sub_field('acf_industry_right_menu_items') ?: ''; ?>
                                        <li data-category="benefit-<?php echo esc_html($index + 1); ?>" class="li-item active small-size"><?php echo ($benefits_menu_item); ?></li>
                                    <?php endwhile; ?>
                                <?php else : ?>
                                    <p>No benefits found.</p>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- space below How Adrosonic Benefits  Section  -->
                <div aria-hidden="true" class="wp-block-spacer space-subservicepage-below-adrosonic-benefits"></div>

                <!-- Our Offerings and Capabilities Section -->
                <div id="offerings" class="our-offerings-container manual-lazy-load" data-src="/wp-content/uploads/2025/04/Service-Sub-Service-General-Our-Offerings-and-Capabilities-Texture.webp" src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 7 5'%3E%3C/svg%3E">
                    <h2 class="large-size our-offerings-main-header font-bold"><?php echo ($our_offerings_and_capabilities_main_heading); ?></h2>
                    <div class="our-offerings-container-inner">
                        <div class="owl-carousel owl-theme">
                            <?php if (have_rows('acf_our_offerings_and_capabilities_items')) :
                                $index = -1;
                            ?>
                                <?php while (have_rows('acf_our_offerings_and_capabilities_items')): the_row();
                                    $index++;
                                    $horizontal_tab = get_sub_field('acf_horizontal_tabs') ?: '';
                                    $left_description = get_sub_field('acf_left_description') ?: '';
                                    $left_cta_text = get_sub_field('acf_left_cta_text') ?: '';
                                    $left_cta_url = get_sub_field('acf_left_cta_url') ?: '';
                                    $right_heading_1 = get_sub_field('acf_right_heading_1') ?: '';
                                    $right_description_1 = get_sub_field('acf_right_description_1') ?: '';
                                    $right_heading_2 = get_sub_field('acf_right_heading_2') ?: '';
                                    $right_description_2 = get_sub_field('acf_right_description_2') ?: '';
                                    $portrait_view_description = get_sub_field('acf_portrait_view_description') ?: ''; ?>
                                    <div class="item smaller-size" data-id="<?php echo esc_attr($index); ?>" data-heading="<?php echo esc_html($horizontal_tab); ?>"
                                        data-text="<?php echo esc_html($left_description); ?>"
                                        data-cta-text="<?php echo esc_html($left_cta_text); ?>"
                                        data-link="<?php echo esc_html($left_cta_url); ?>" data-right-heading1="<?php echo esc_html($right_heading_1); ?>"
                                        data-right-desc1="<?php echo esc_html($right_description_1); ?>" data-right-heading2="<?php echo esc_html($right_heading_2); ?>"
                                        data-right-desc2="<?php echo esc_html($right_description_2); ?>"
                                        data-portrait-only-paragraph="<?php echo esc_html($portrait_view_description); ?>">
                                        <?php echo esc_html($horizontal_tab); ?>
                                    </div>
                                <?php endwhile; ?>
                            <?php else : ?>
                                <p>No offerings found.</p>
                            <?php endif; ?>
                        </div>
                        <div class="content-box">
                            <div class="left-box">
                                <h3 id="content-heading" class="content-heading font-bold large-size"></h3>
                                <p id="content-text" class="content-text small-size"></p>
                                <a id="content-link" href="" class="service-button-cta smaller-size underline-on-hover"><span></span></a>
                                <a class="no-text-decor" href=""><button class="service-btn-solid custom-button" onclick="window.location.href='';"></button></a>
                            </div>
                            <div class="right-box">
                                <h3 id="right-heading1" class="right-heading1 font-bold small-size"></h3>
                                <p id="right-desc1" class="right-desc1 smaller-size"></p>
                                <h3 id="right-heading2" class="right-heading2 font-bold small-size"></h3>
                                <p id="right-desc2" class="right-desc2 smaller-size"></p>
                            </div>
                            <div class="portrait-only-box">
                                <p id="portrait-only-paragraph" class="portrait-only-paragraph small-size"></p>
                                <a class="no-text-decor" href=""><button class="service-btn-solid custom-button" onclick="window.location.href='';"></button></a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Technology prowess Section -->
                <div id="technology-prowess" class="technology-prowess-container">
                    <h2 class="large-size technology-prowess-main-header font-bold">
                        <?php echo ($technology_prowess_section_heading); ?>
                    </h2>
                    <div class="technology-prowess-container-inner">
                        <div class="owl-carousel owl-theme">
                            <?php if (have_rows('acf_technology_prowess_individual_tab_items')) :
                                $index = -1;
                            ?>
                                <?php while (have_rows('acf_technology_prowess_individual_tab_items')): the_row();
                                    $index++;
                                    $horizontal_tab = get_sub_field('acf_technology_prowess_horizontal_tab_title') ?: '';
                                    $left_description = get_sub_field('acf_technology_prowess_left_description') ?: '';
                                    $right_illustration = get_sub_field('acf_technlogy_prowess_right_illustration') ?: ''; ?>
                                    <div class="item smaller-size" data-id="<?php echo esc_attr($index); ?>"
                                        data-heading="<?php echo esc_html($horizontal_tab); ?>"
                                        data-text="<?php echo esc_html($left_description); ?>"
                                        data-image="<?php echo esc_html($right_illustration); ?>">
                                        <?php echo esc_html($horizontal_tab); ?>
                                    </div>
                                <?php endwhile; ?>
                            <?php else : ?>
                                <p>No technology prowess found.</p>
                            <?php endif; ?>
                        </div>
                        <div class="content-box">
                            <div class="left-box">
                                <div id="content-text" class="content-text small-size font-bold"></div>
                            </div>
                            <div class="right-box">
                                <img id="content-image" class="manual-lazy-load" data-src="" src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 7 5'%3E%3C/svg%3E" alt="" />
                            </div>
                        </div>
                    </div>
                </div>
                <!-- space below Platform Partners Section -->
                <div aria-hidden="true" class="wp-block-spacer space-subservicepage-below-strategic-partners"></div>
                <!-- About RPA Section -->
                <div class="about-sub-service" id="about-sub-service">
                    <div class="section-header-container">
                        <h2 class="large-size font-bold"><?php echo ($about_sub_service_main_heading) ?></h2>
                    </div>
                    <div class="content-wrapper">
                        <div class="left-container">
                            <p class="small-size"><?php echo ($about_sub_service_text1) ?></p>
                            <p class="small-size"><?php echo ($about_sub_service_text2) ?></p>
                        </div>
                        <div class="right-container">
                            <svg class="circle-chart" viewBox="0 0 120 120">
                                <circle class="circle-bg" cx="60" cy="60" r="59.5" />
                                <circle class="inner-circle-bg" cx="60" cy="60" r="57" />
                                <image class="manual-lazy-load" href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1 1'%3E%3C/svg%3E" data-src="<?php echo esc_html($about_sub_service_image) ?>" x="3" y="3" width="114" height="114" />
                            </svg>
                        </div>
                    </div>
                </div>
                <!-- space below About RPA Section -->
                <div aria-hidden="true" class="wp-block-spacer space-subservicepage-below-about-subservice"></div>
                <?php $wpDataService = [
                    'left_images' => [],
                    'left_image_overlay_texts' => []
                ];
                if (have_rows('acf_our_capabilities_section_fields_items')) {
                    while (have_rows('acf_our_capabilities_section_fields_items')) {
                        the_row();
                        $wpDataService['left_images'][] = get_sub_field('acf_industry_left_image');
                        $wpDataService['left_image_overlay_texts'][] = get_sub_field('acf_industry_left_image_overlay_text');
                    }
                } ?>
                <script>
                    var wpDataService = <?php echo json_encode($wpDataService); ?>;
                </script>
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
