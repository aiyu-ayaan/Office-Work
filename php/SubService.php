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


$banner_graphic_url = get_field('acf_sub_service_banner_graphic_url');
$banner_title = get_field('acf_sub_service_banner_title');
$banner_description = get_field('acf_sub_service_banner_description');
$banner_button_text = get_field('acf_sub_service_banner_button_text');
$banner_button_url = get_field('acf_sub_service_banner_button_url');

$submenu_section_main_heading = get_field('acf_service_submenu_section_main_heading');
$submenu_hrefs = [
    "our-features",
    "benefits",
    "offerings",
    "partners",
    //         "insights",
    "about-sub-service"
];

$our_features_main_heading = get_field('acf_sub_service_our_features_section_main_heading');

$adrosonic_benefits_section_main_header = get_field('acf_industry_our_capabilities_section_main_heading');

$our_offerings_and_capabilities_main_heading = get_field('acf_our_offerings_and_capabilities_main_heading');

$platform_partners_main_heading = get_field('acf_sub_service_platform_partners_section_main_heading');

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
                            <p class="small-size"><?php echo esc_html($banner_description); ?></p>
                            <button class="custom-button service-get-in-touch" onclick="window.location.href='<?php echo esc_html($banner_button_url) ?>';"><?php echo esc_html($banner_button_text); ?></button>
                        </div>
                        <div class="right-img manual-lazy-load" data-src="<?php echo esc_html($banner_graphic_url); ?>" src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 7 5'%3E%3C/svg%3E"></div>
                    </div>
                    <nav class="service-scroll-menu">
                        <div class="service-menu-dropdown-container open">
                            <p class="service-menu-dropdown-toggle small-size font-bold"><?php echo esc_html($submenu_section_main_heading); ?></p>
                            <ul class="service-scroll-list">

                                <?php if (have_rows('acf_submenu_items')) :
                                    $index = -1; ?>
                                    <?php while (have_rows('acf_submenu_items')): the_row();
                                        $index++;
                                        $submenu_item = get_sub_field('acf_submenu_single_item_name') ?: ''; ?>
                                        <li class="smaller-size font-bold submenu"><a href="#<?php echo esc_html($submenu_hrefs[$index]); ?>"><?php echo esc_html($submenu_item); ?></a></li>
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
                        <h2 class="large-size font-bold main-header"><?php echo esc_html($our_features_main_heading); ?></h2>
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
                                        <h3 class="small-size font-boldest"><?php echo esc_html($heading); ?></h3>
                                        <p class="smaller-size"><?php echo esc_html($description); ?></p>
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
                                        <li data-category="benefit-<?php echo esc_html($index + 1); ?>" class="li-item active small-size"><?php echo esc_html($benefits_menu_item); ?></li>
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
                    <h2 class="large-size our-offerings-main-header font-bold"><?php echo esc_html($our_offerings_and_capabilities_main_heading); ?></h2>
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
                                    $right_description_2 = get_sub_field('acf_right_description_2') ?: '';  ?>
                                    <div class="item smaller-size" data-id="<?php echo esc_attr($index); ?>" data-heading="<?php echo esc_html($horizontal_tab); ?>"
                                        data-text="<?php echo esc_html($left_description); ?>"
                                        data-cta-text="<?php echo esc_html($left_cta_text); ?>"
                                        data-link="<?php echo esc_html($left_cta_url); ?>" data-right-heading1="<?php echo esc_html($right_heading_1); ?>"
                                        data-right-desc1="<?php echo esc_html($right_description_1); ?>" data-right-heading2="<?php echo esc_html($right_heading_2); ?>"
                                        data-right-desc2="<?php echo esc_html($right_description_2); ?>"
                                        data-portrait-only-paragraph="<?php echo esc_html($left_description); ?>">
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

                <!-- Platform Partners Section -->

                <div class="platform-partners-carousel owlslider" id="partners">
                    <h2 class="platform-partners-heading section-central-heading large-size"><?php echo esc_html($platform_partners_main_heading); ?></h2>
                    <section id="slider">
                        <div class="container">
                            <div class="slider">
                                <div class="owl-carousel">
                                    <?php if (have_rows('acf_sub-service_page_platform_partners_items')) : ?>
                                        <?php while (have_rows('acf_sub-service_page_platform_partners_items')) : the_row();
                                            $partner_logo = get_sub_field('acf_sub_service_partner_logo') ?: '';
                                            $partner_description = get_sub_field('acf_sub_service_partner_description') ?: '';
                                            $button_text = get_sub_field('acf_sub_service_partner_button_text') ?: '';
                                            $button_url = get_sub_field('acf_sub_service_partner_button_url') ?: '';
                                        ?>
                                            <div class="slide">
                                                <div class="slide-content">
                                                    <img class="manual-lazy-load"
                                                        data-src="<?php echo esc_html($partner_logo); ?>"
                                                        src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 3 1'%3E%3C/svg%3E"
                                                        alt="partner logo"
                                                        data-content="<?php echo esc_html($partner_description); ?>"
                                                        data-button-text="<?php echo esc_attr($button_text); ?>"
                                                        data-button-url="<?php echo esc_url($button_url); ?>" />
                                                </div>
                                            </div>
                                        <?php endwhile; ?>
                                    <?php else : ?>
                                        <p>No partners found.</p>
                                    <?php endif; ?>
                                </div>

                                <!-- Description + Global Button -->
                                <div class="description-text smaller-size"></div>
                                <div class="platform-partners-button-wrapper">
                                    <button class="platform-partners-button custom-button font-bold smaller-size" style="display:none;">
                                        <span class="button-text"></span>
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 74 34" fill="none">
                                            <path d="M57 17L1 17" stroke="#1A2C47" stroke-width="2" stroke-linecap="round" />
                                            <path d="M41 17C41 20.1645 41.9384 23.2579 43.6965 25.8891C45.4546 28.5203 47.9534 30.5711 50.8771 31.7821C53.8007 32.9931 57.0177 33.3099 60.1214 32.6926C63.2251 32.0752 66.0761 30.5513 68.3137 28.3137C70.5513 26.0761 72.0752 23.2251 72.6926 20.1214C73.3099 17.0177 72.9931 13.8007 71.7821 10.8771C70.5711 7.95345 68.5203 5.45459 65.8891 3.69649C63.2579 1.93838 60.1645 1 57 1C52.7565 1 48.6869 2.68571 45.6863 5.68629C42.6857 8.68687 41 12.7565 41 17Z" stroke="#1A2C47" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>


                <!-- space below Platform Partners Section -->
                <div aria-hidden="true" class="wp-block-spacer space-subservicepage-below-strategic-partners"></div>
                <!-- Innovation Section -->
                <!-- 			this is commented for phase 1 -->
                <?php /* if (!empty($innovative_solutions_shortcode)) { 
                    echo do_shortcode($innovative_solutions_shortcode); 
                } */ ?>
                <!-- space below Innovation Section -->
                <!-- 			this is commented for phase 1 -->
                <!--                 <div aria-hidden="true" class="wp-block-spacer space-subservicepage-below-insights"></div> -->
                <!-- About RPA Section -->
                <div class="about-sub-service" id="about-sub-service">
                    <div class="section-header-container">
                        <h2 class="large-size font-bold"><?php echo esc_html($about_sub_service_main_heading) ?></h2>
                    </div>
                    <div class="content-wrapper">
                        <div class="left-container">
                            <p class="small-size"><?php echo esc_html($about_sub_service_text1) ?></p>
                            <p class="small-size"><?php echo esc_html($about_sub_service_text2) ?></p>
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
