<?php

/**
 * Template Name: ROI
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

?>

<div id="primary" <?php astra_primary_class(); ?>>
    <main id="main" class="site-main">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class('ast-article-single'); ?> itemscope itemtype="https://schema.org/CreativeWork">
                    <div class="ast-post-format- single-layout-1">
                        <div class="entry-content clear" data-ast-blocks-layout="true" itemprop="text">




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