<?php

/**
 * Template Name: Who We Are
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
// Banner fields
$banner_title = get_field('acf_who_we_are_page_banner_title') ?? '';
$banner_image = get_field('acf_who_we_are_page_banner_image') ?? '';
$banner_animated_text = get_field('acf_who_we_are_page_banner_animated_text') ?? '';
$banner_button_text = get_field('acf_who_we_are_page_banner_button_text') ?? '';
$banner_button_url = get_field('acf_who_we_are_page_banner_button_url') ?? '';
$text_below_banner = get_field('acf_who_we_are_page_text_below_banner') ?? '';
$button_below_banner_text = get_field('acf_who_we_are_page_button_below_banner_text') ?? '';
$button_below_banner_url = get_field('acf_who_we_are_page_button_below_banner_url') ?? '';

// Cards and end section fields
$who_we_are_card = get_field('acf_who_we_are_page_who_we_are_cards');
$statement_at_the_end_of_the_page = get_field('acf_who_we_are_page_statement_at_the_end_of_the_page') ?? '';
$button_at_then_end_of_the_page_text = get_field('acf_who_we_are_page_button_at_the_end_of_page_text') ?? '';
$button_at_then_end_of_the_page_url = get_field('acf_who_we_are_page_button_at_the_end_of_page_url') ?? '';

$post_content_frame_section = get_field('acf_post_content_frame_section') ?? '';
?>

<div id="primary" <?php astra_primary_class(); ?>>
    <main id="main" class="site-main">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class('ast-article-single'); ?> itemscope itemtype="https://schema.org/CreativeWork">
                    <div class="ast-post-format- single-layout-1">
                        <div class="entry-content clear" data-ast-blocks-layout="true" itemprop="text">

                            <!-- DESCRIPTION: Banner section -->
                            <div class="who-we-are-banner-container">
                                <div class="who-we-are-bg-container">
                                    <div class="who-we-are-banner-bg-img manual-lazy-load"
                                        data-src="<?php echo esc_url($banner_image) ?>"
                                        src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 3 1'%3E%3C/svg%3E">
                                    </div>
                                    <div class="overlay"></div>
                                </div>
                                <div class="who-we-are-banner-content">
                                    <div class="top-section">
                                        <h1 class="banner-heading largest-size">
                                            <span><?php echo wp_kses_post($banner_title); ?></span>
                                            <div class="animated-text">
                                                <?php if (have_rows('acf_who_we_are_page_banner_animated_text')): ?>
                                                    <?php while (have_rows('acf_who_we_are_page_banner_animated_text')): the_row(); ?>
                                                        <div><?php the_sub_field('acf_who_we_are_page_card_animated_text_value'); ?></div>
                                                    <?php endwhile; ?>
                                                <?php endif; ?>
                                            </div>
                                        </h1>
                                        <a href="<?php echo esc_url($banner_button_url); ?>">
                                            <button class="custom-button who-we-are-banner-button">
                                                <?php echo esc_html($banner_button_text); ?>
                                            </button>
                                        </a>
                                    </div>
                                    <div class="who-we-are-banner-quote">
                                        <p class="who-we-are-banner-quote-text medium-size">
                                            <?php echo $text_below_banner; ?>
                                        </p>
                                        <a href="<?php echo esc_url($button_below_banner_url); ?>">
                                            <button class="custom-button who-we-are-banner-learn-more-button">
                                                <?php echo esc_html($button_below_banner_text); ?>
                                            </button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <!-- END: Banner Ends here -->

                            <!-- DESCRIPTION:Content frame section -->
                            <div class="content-cards">
                                <?php if (have_rows('acf_who_we_are_page_who_we_are_cards')): ?>
                                    <?php while (have_rows('acf_who_we_are_page_who_we_are_cards')): the_row(); ?>
                                        <div class="section-wrapper">
                                            <div class="background-layout">
                                                <div class="background-left animate-on-scroll" style="border-color: <?php the_sub_field('acf_who_we_are_page_card_border_color'); ?>;"></div>
                                                <div class="background-right"></div>
                                            </div>
                                            <div class="content-overlay">
                                                <div class="content-left animate-on-scroll small-size" style="border-color: <?php the_sub_field('acf_who_we_are_page_card_border_color'); ?>;">
                                                    <h2 class="large-size font-bold"><?php the_sub_field('acf_who_we_are_page_card_title'); ?></h2>
                                                    <?php the_sub_field('acf_who_we_are_page_card_description'); ?>
                                                    <a class="underline-on-hover service-button-cta" href="<?php echo esc_url(get_sub_field('acf_who_we_are_page_card_button_url')); ?>">
                                                        <span class="smaller-size"><?php echo esc_html(get_sub_field('acf_who_we_are_page_card_button_text')); ?></span>
                                                    </a>
                                                </div>
                                                <div class="content-right animate-on-scroll">
                                                    <img src="<?php echo esc_url(get_sub_field('acf_who_we_are_page_card_image')); ?>" alt="<?php echo esc_attr(get_sub_field('acf_who_we_are_page_card_title')); ?>">
                                                </div>
                                            </div>
                                        </div>
                                    <?php endwhile; ?>
                                <?php endif; ?>
                            </div>
                            <!-- END:Content Frame Ends Here  -->

                            <!-- DESCRIPTION: -->

                            <div class="statement-section">
                                <p class="text medium-size">
                                    <?php echo $statement_at_the_end_of_the_page; ?>
                                </p>
                                <a href="<?php echo esc_url($button_at_then_end_of_the_page_url); ?>">
                                    <button class="custom-button smaller-size"><?php echo (esc_html($button_at_then_end_of_the_page_text)); ?></button>
                                </a>
                            </div>

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