<?php

/**
 * Template Name: Partner
 * Template Post Type: page
 */
/**
 * The template for displaying all webinar posts.
 *
 * @package Astra
 * @since 1.0.0
 */

if (! defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

$GLOBALS['should_show_play_popup_form'] = true;
get_header(); ?>

<?php

$banner_title = get_field('acf_partner_page_banner_title') ?? '';
$banner_image = get_field('acf_partner_page_banner_image') ?? '';
$banner_svg_url = get_field('acf_partner_page_banner_svg_url') ?? '';
$banner_button_text = get_field('acf_partner_page_banner_button_text') ?? '';
$banner_button_url = get_field('acf_partner_page_banner_button_url') ?? '';

$partnership_section = get_field('acf_partner_page_partnership_section') ?? '';


$partnership_content_section = get_field('acf_partner_page_content_section') ?? '';

// On Advance custom fields $partnership_section is an group field
$partnership_section_title = $partnership_section['acf_partner_page_partnership_title'] ?? '';
$partnership_section_description = $partnership_section['acf_partner_page_partnership_description'] ?? '';
$partnership_section_button_text = $partnership_section['acf_partner_page_partnership_button_text'] ?? '';
$partnership_section_button_url = $partnership_section['acf_partner_page_partnership_button_url'] ?? '';
$partnership_section_image = $partnership_section['acf_partner_page_partnership_image'] ?? '';

$you_may_be_interested_plugin_shortcode = get_field('you_might_be_interested_plugin_shortcode');
?>

<div id="primary" <?php astra_primary_class(); ?>>
    <main id="main" class="site-main">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class('ast-article-single'); ?> itemscope itemtype="https://schema.org/CreativeWork">
                    <div class="ast-post-format- single-layout-1">
                        <div class="entry-content clear" data-ast-blocks-layout="true" itemprop="text">

                            <!-- DESCRIPTION: Banner section -->

                            <div class="patner-banner">
                                <div class="patner-hero-banner">
                                    <div class="left-text-box">

                                        <p class="large-size patner-title">
                                            <?php echo wp_kses_post($banner_title); ?>
                                        </p>


                                        <a href="<?php echo esc_url($banner_button_url); ?>">
                                            <button class="open-download-popup custom-button patner-download-button">
                                                <?php echo esc_html($banner_button_text); ?>
                                            </button>
                                        </a>

                                    </div>
                                    <div class="right-container">
                                        <div class="right-img manual-lazy-load"
                                            data-src="<?php echo esc_url($banner_svg_url ? $banner_svg_url : $banner_image); ?>"
                                            src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 3 1'%3E%3C/svg%3E">
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <!-- 		DESCRIPTION:Spacer below banner frame 					 -->

                            <div aria-hidden="true" class="spacer-below-banner wp-block-spacer"></div>

                            <!-- DESCRIPTION: Content Frame -->

                            <div class="partners-section">
                                <div class="button-container">
                                    <?php if (have_rows('acf_partner_page_content_section')): ?>
                                        <?php while (have_rows('acf_partner_page_content_section')): the_row(); ?>
                                            <?php
                                            static $first_tab = true;
                                            $category_title = get_sub_field('acf_partner_page_category_title');
                                            ?>
                                            <button class="tab-btn<?php echo $first_tab ? ' active' : ''; ?>"
                                                data-category="<?php echo esc_attr($category_title); ?>">
                                                <?php echo esc_html($category_title); ?>
                                            </button>
                                            <?php $first_tab = false; ?>
                                        <?php endwhile; ?>
                                    <?php endif; ?>

                                </div>
                                <div id="grid-container">
                                    <?php if (have_rows('acf_partner_page_content_section')): ?>
                                        <?php while (have_rows('acf_partner_page_content_section')): the_row(); ?>
                                            <?php
                                            $category_title = get_sub_field('acf_partner_page_category_title');
                                            ?>
                                            <section class="category-section" data-category="<?php echo esc_attr($category_title); ?>">
                                                <h2 class="medium-size font-bold partner-category-header"><?php echo esc_html($category_title); ?></h2>
                                                <div class="grid">
                                                    <?php if (have_rows('acf_partner_page_section_items')): ?>
                                                        <?php while (have_rows('acf_partner_page_section_items')): the_row(); ?>
                                                            <?php
                                                            $item_logo = get_sub_field('acf_partner_page_content_section_item_logo');
                                                            $item_description = get_sub_field('acf_partner_page_content_section_item_description');
                                                            ?>
                                                            <div class="card">
                                                                <div class="partner-img">
                                                                    <img class="manual-lazy-load" data-src="<?php echo esc_url($item_logo); ?>" alt="">
                                                                    <a class="see-more underline-on-hover service-button-cta">
                                                                        <span class="see-more-text">See More</span>
                                                                    </a>
                                                                </div>
                                                                <p class="partner-description smallest-size">
                                                                    <?php echo esc_html($item_description); ?>
                                                                </p>
                                                            </div>
                                                        <?php endwhile; ?>
                                                    <?php endif; ?>
                                                </div>
                                                <!-- Mobile Dots -->

                                                <div class="mobile-dots"></div>

                                            </section>
                                        <?php endwhile; ?>
                                    <?php endif; ?>
                                </div>
                                <div class="pagination" id="desktop-nav">
                                    <button id="prev-btn" aria-label="Previous"><svg xmlns="http://www.w3.org/2000/svg" width="34" height="34" viewBox="0 0 34 34"
                                            fill="none">
                                            <circle cx="16" cy="16" r="16" transform="matrix(-1 0 0 1 33 1)" stroke="white" stroke-width="2" />
                                            <path
                                                d="M25 16C25.5523 16 26 16.4477 26 17C26 17.5523 25.5523 18 25 18L25 16ZM8.29289 17.7071C7.90237 17.3166 7.90237 16.6834 8.29289 16.2929L14.6569 9.92893C15.0474 9.53841 15.6805 9.53841 16.0711 9.92893C16.4616 10.3195 16.4616 10.9526 16.0711 11.3431L10.4142 17L16.0711 22.6569C16.4616 23.0474 16.4616 23.6805 16.0711 24.0711C15.6805 24.4616 15.0474 24.4616 14.6569 24.0711L8.29289 17.7071ZM25 18L9 18L9 16L25 16L25 18Z"
                                                fill="white" />
                                        </svg></button>
                                    <button id="next-btn" aria-label="Next"><svg xmlns="http://www.w3.org/2000/svg" width="34" height="34" viewBox="0 0 34 34"
                                            fill="none">
                                            <circle cx="16" cy="16" r="16" transform="matrix(-1 0 0 1 33 1)" stroke="white" stroke-width="2" />
                                            <path
                                                d="M25 16C25.5523 16 26 16.4477 26 17C26 17.5523 25.5523 18 25 18L25 16ZM8.29289 17.7071C7.90237 17.3166 7.90237 16.6834 8.29289 16.2929L14.6569 9.92893C15.0474 9.53841 15.6805 9.53841 16.0711 9.92893C16.4616 10.3195 16.4616 10.9526 16.0711 11.3431L10.4142 17L16.0711 22.6569C16.4616 23.0474 16.4616 23.6805 16.0711 24.0711C15.6805 24.4616 15.0474 24.4616 14.6569 24.0711L8.29289 17.7071ZM25 18L9 18L9 16L25 16L25 18Z"
                                                fill="white" />
                                        </svg></button>
                                </div>
                                <div id="popup-modal" class="hidden">
                                    <div class="popup-content">
                                        <button id="close-popup" aria-label="Close Popup"><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32"
                                                fill="none">
                                                <path d="M9 9L23 23" stroke="#1A2C47" stroke-width="2" stroke-linecap="round" />
                                                <path d="M9 23L23 9" stroke="#1A2C47" stroke-width="2" stroke-linecap="round" />
                                                <circle cx="16" cy="16" r="15.5" stroke="#1A2C47" />
                                            </svg></button>
                                        <div class="popup-body">
                                            <div class="partner-img"><img class="manual-lazy-load" id="popup-img" src="" alt=""></div>
                                            <div class="popup-text">
                                                <div class="scrollable-text">
                                                    <p class="partner-description smallest-size" id="popup-description"></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- 		DESCRIPTION:Spacer below content frame 					 -->

                            <div aria-hidden="true" class="spacer-below-content-frame wp-block-spacer"></div>

                            <!-- DESCRIPTION:Partner Page- Partnership Section -->

                            <div class="harness-the-power">
                                <div class="content-wrapper">
                                    <div class="left-container">
                                        <!-- SVG Circle Chart -->
                                        <svg class="circle-chart" viewBox="0 0 120 120">
                                            <circle class="circle-bg" cx="60" cy="60" r="59.5" />
                                            <!-- Inner circle with the background image -->
                                            <circle class="inner-circle-bg" cx="60" cy="60" r="57" />
                                            <!-- Image inside the inner circle -->
                                            <image href="<?php echo esc_url($partnership_section_image) ?>" x="3" y="3" width="114"
                                                height="114" />
                                        </svg>
                                    </div>
                                    <div class="right-container">
                                        <h2 class="header largest-size">
                                            <?php echo wp_kses_post($partnership_section_title); ?>
                                        </h2>
                                        <p class="description-text small-size">
                                            <?php echo wp_kses_post($partnership_section_description); ?>
                                        </p>
                                        <a href="<?php echo esc_url($partnership_section_button_url); ?>">
                                            <button class="custom-button">
                                                <?php echo esc_html($partnership_section_button_text); ?>
                                            </button>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <!-- Spacer between Partner page and you might be interested -->
                            <div aria-hidden="true" class="spacer-above-related-posts wp-block-spacer"></div>

                            <!-- DESCRIPTION:You might be interested -->
                            <?php if (!empty($you_may_be_interested_plugin_shortcode)) {
                                echo do_shortcode($you_may_be_interested_plugin_shortcode);
                            } ?>
                            <!-- WordPress content -->
                            <?php the_content(); ?>
                        </div>
                    </div>
                </article>
        <?php endwhile;
        endif; ?>
    </main>
</div><!-- #primary -->

<?php get_footer(); ?>