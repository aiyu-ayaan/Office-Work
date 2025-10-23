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
// Foundation Section ACF fields
$adrosonic_foundation_section = get_field('csr_page_adrosonic_foundation_section');
// this is ACF group field
$adrosonic_foundation_section_heading = $adrosonic_foundation_section['csr_page_adrosonic_foundation_main_heading'];
$adrosonic_foundation_video_url = $adrosonic_foundation_section['csr_page_adrosonic_foundation_video_url'];
$adrosonic_foundation_video_thumbnail = $adrosonic_foundation_section['csr_page_adrosonic_foundation_video_thumbnail'];
$adrosonic_foundation_section_description1 = $adrosonic_foundation_section['csr_page_adrosonic_foundation_description_para_1'];
$adrosonic_foundation_section_description2 = $adrosonic_foundation_section['csr_page_adrosonic_foundation_description_para_2'];
// $adrosonic_foundation_section_items= $adrosonic_foundation_section['csr_page_adrosonic_foundation_section_items'];


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

                <div class="newshub-page-carousel-wrapper">
                    <div class="owl-carousel newshub-page-carousel">
                        <?php
                        $card_items = $adrosonic_foundation_section['csr_page_adrosonic_foundation_section_items'] ?: [];
                        ?>
                        <?php if ($card_items && is_array($card_items)) : ?>
                            <?php foreach ($card_items as $item):
                                $card_title = $item['csr_page_adrosonic_foundation_section_items_card_description'] ?: '';
                                $card_image = $item['csr_page_adrosonic_foundation_section_items_card_image'] ?: '';
                                $cta_url = $item['csr_page_adrosonic_foundation_section_items_cta_url'] ?: '';
                                $cta_text = $item['csr_page_adrosonic_foundation_section_items_cta_text'] ?: '';

                                // Check if both CTA text and URL have values
                                $has_cta = !empty($cta_text) && !empty($cta_url);
                            ?>
                                <div class="item newshub-page-item">
                                    <?php if ($has_cta) : ?>
                                        <a href="<?php echo esc_url($cta_url); ?>" class="carousel-link">
                                        <?php else : ?>
                                            <div class="carousel-link">
                                            <?php endif; ?>
                                            <!-- Image -->
                                            <img decoding="async" src="<?php echo esc_html($card_image); ?>"
                                                alt="<?php echo esc_attr($card_title); ?>" class="carousel-image" />
                                            <div class="description-text smallest-size">
                                                <?php echo esc_html($card_title); ?>
                                            </div>
                                            <?php if ($has_cta) : ?>
                                                <div class="underline-on-hover service-button-cta font-bold">
                                                    <span class="smaller-size"><?php echo esc_html($cta_text); ?></span>
                                                </div>
                                            <?php endif; ?>
                                            <?php if ($has_cta) : ?>
                                        </a>
                                    <?php else : ?>
                                </div>
                            <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
                </div>
            </div>

            <!-- REMOVEME:Spacer 80px-->
            <div role="presentation" aria-hidden="true" style="height:80px; width:100%;"></div>


            <!-- DESCRIPTION:Initiative section-->
            <?php
            $events_section = get_field('csr_page_initiative_section');
            $events_and_highlights_section_main_heading =  $events_section['csr_page_initiative_section_heading'] ?? '';
            $events_and_highlights_section_sub_heading = $events_section['csr_page_initiative_sub_heading'] ?? '';

            ?>
            <div class="events-and-highlights-section">
                <div class="our-events-and-highlights-header">
                    <h2 class="main-header large-size font-bold"><?php echo $events_and_highlights_section_main_heading; ?></h2>
                    <h3 class="sub-header small-size"><?php echo $events_and_highlights_section_sub_heading; ?></h3>

                </div>
                <div class="card-section">
                    <div class="main-card" id="mainCard">
                        <h2 class="main-card-title small-size font-bold" id="mainTitle"></h2>
                        <div class="main-card-scrollable">
                            <p class="main-card-content smaller-size" id="mainContent"></p>
                        </div>
                        <a href="#" class="main-card-cta service-button-cta underline-on-hover smaller-size">
                            <span id="mainCtaText"></span>
                        </a>
                    </div>
                    <div class="small-cards owl-carousel">



                        <?php if (!empty($events_section['csr_page_initiative_items'])): ?>
                            <?php foreach ($events_section['csr_page_initiative_items'] as $index => $item):
                                $card_image = $item['csr_page_initiative_item_image'] ?: '';
                                $card_title = $item['csr_page_initiative_item_card_title'] ?: '';
                                $card_description_para1 = $item['csr_page_initiative_item_card_description_para_1'] ?: '';
                                $card_description_para2 = $item['csr_page_initiative_item_card_description_para_2'] ?: '';
                                $card_button_text = $item['csr_page_initiative_item_button_text'] ?: '';
                                $card_button_url = $item['csr_page_initiative_item_button_url'] ?: '';
                                $card_image_alignment = $item['csr_page_initiative_item_image_alignment'] ?: 'center';

                            ?>

                                <div class="item card card-wrapper manual-lazy-load" data-index="<?php echo esc_html($index); ?>"
                                    data-bg="<?php echo esc_html($card_image); ?>"
                                    data-title="<?php echo esc_html($card_title); ?>"
                                    data-desc="<?php echo esc_html($card_description_para1); ?>&lt;br&gt;&lt;br&gt;<?php echo esc_html($card_description_para2); ?>"
                                    data-cta="<?php echo !empty($card_button_url) ? esc_url($card_button_url) : ''; ?>"
                                    data-alignment="<?php echo esc_html($card_image_alignment); ?>"

                                    data-cta-text="<?php echo !empty($card_button_text) ? esc_html($card_button_text) : ''; ?>">

                                    <div class="card-content">
                                        <h2 class="card-title small-size font-bold"></h2>
                                        <p class="card-description smaller-size"></p>

                                        <?php if (!empty($card_button_url) && !empty($card_button_text)) : ?>
                                            <a href="#" class="card-cta service-button-cta underline-on-hover smaller-size">
                                                <span></span>
                                            </a>
                                        <?php endif; ?>

                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <p>No events-and-highlights found.</p>
                        <?php endif; ?>
                    </div>
                </div>

            </div>

</div>
</article>
</main>
<?php the_content(); ?>
</div>

<?php get_footer(); ?>