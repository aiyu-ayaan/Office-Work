<?php
/*
Template Name: CSR page
*/

/**
 * Custom Elevate template for Astra child theme.
 *
 * This template is specifically for the elevate connect london landing page of the site.
 *
 * @package Astra Child
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

get_header(); ?>


<?php if (astra_page_layout() == 'left-sidebar') : ?>
    <?php get_sidebar(); ?>
<?php endif; ?>

<div id="primary" <?php astra_primary_class(); ?>>
    <main id="main" class="site-main">
        <article id="post-<?php the_ID(); ?>" <?php post_class('ast-article-single'); ?> itemscope itemtype="https://schema.org/CreativeWork">
            <div class="entry-content clear" data-ast-blocks-layout="true" itemprop="text">


            </div>
        </article>
    </main>
    <?php the_content(); ?>
</div>

<?php get_footer(); ?>