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


<!-- DESCRIPTION:All veriables -->

<?php
$adrosonic_foundation_section = get_field('csr_page_adrosonic_foundation_section');
// this is ACF group field
$adrosonic_foundation_section_heading = $adrosonic_foundation_section['csr_page_adrosonic_foundation_main_heading'];
$adrosonic_foundation_video_url = $adrosonic_foundation_section['csr_page_adrosonic_foundation_video_url'];
$adrosonic_foundation_video_thumbnail = $adrosonic_foundation_section['csr_page_adrosonic_foundation_video_thumbnail'];
$adrosonic_foundation_section_description1 = $adrosonic_foundation_section['csr_page_adrosonic_foundation_description_para_1'];
$adrosonic_foundation_section_description2 = $adrosonic_foundation_section['csr_page_adrosonic_foundation_description_para_2'];

?>

<!-- END: -->



<?php if (astra_page_layout() == 'left-sidebar') : ?>
    <?php get_sidebar(); ?>
<?php endif; ?>

<div id="primary" <?php astra_primary_class(); ?>>
    <main id="main" class="site-main">
        <article id="post-<?php the_ID(); ?>" <?php post_class('ast-article-single'); ?> itemscope itemtype="https://schema.org/CreativeWork">
            <div class="entry-content clear" data-ast-blocks-layout="true" itemprop="text">

                <!-- REMOVEME:Spacer 80px-->
                <div role="presentation" aria-hidden="true" style="height:80px; width:100%;"></div>

                <!-- DESCRIPTION:Foundation Section -->
                <div class="our_expertise_container" id="expertise">
                    <div class="section-header animate-on-scroll slide-in-top">
                        <h2 class="large-size font-bold"><?php echo esc_html($adrosonic_foundation_section_heading); ?></h2>
                    </div>

                    <div class="content-wrapper">
                        <div class="video-container animate-on-scroll slide-in-left">
                            <video class="manual-lazy-load" data-src="<?php echo esc_html($adrosonic_foundation_video_url); ?>" autoplay muted loop playsinline poster="<?php echo esc_html($adrosonic_foundation_video_thumbnail); ?>">
                                Your browser does not support the video tag.
                            </video>
                        </div>
                        <div class="content animate-on-scroll slide-in-right">
                            <p class="small-size description"><?php echo esc_html($adrosonic_foundation_section_description1); ?></p><br>
                            <p class="small-size description"><?php echo esc_html($adrosonic_foundation_section_description2); ?></p>
                        </div>
                    </div>
                </div>

            </div>
        </article>
    </main>
    <?php the_content(); ?>
</div>

<?php get_footer(); ?>