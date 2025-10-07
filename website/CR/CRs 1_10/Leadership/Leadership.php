<?php
/*
    Template Name: Leadership
    */

/**
 * Custom leadership page template for Astra child theme.
 *
 * This template is specifically for all the leadership page of the site.
 *
 * @package Astra Child
 * @since 1.0.0
 */

if (! defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

get_header(); ?>
<?php
$banner_title = get_field('acf_leadership_banner_title');
$banner_description = get_field('acf_leadership_banner_description');
$banner_button_text = get_field('acf_leadership_banner_button_text');
$banner_button_url = get_field('acf_leadership_banner_button_url');

$leadership_what_we_believe_in_heading = get_field('acf_leadership_what_we_believe_in_heading');

$leadership_what_we_believe_in_description = get_field('acf_leadership_what_we_believe_in_description');
$leadership_what_we_believe_in_button_text = get_field('acf_leadership_what_we_believe_in_button_text');
$leadership_what_we_believe_in_button_url = get_field('acf_leadership_what_we_believe_in_button_url');

$adrosonic_benefits_section_main_header = get_field('acf_industry_our_capabilities_section_main_heading');


$leadership_gradient_heading = get_field('acf_about_us_our_difference_gradient_heading');
$leadership_gradient_description = get_field('acf_about_us_our_difference_gradient_description');
$leadership_gradient_cta_text = get_field('acf_about_us_our_difference_gradient_button_text');
$leadership_gradient_cta_url = get_field('acf_about_us_our_difference_gradient_button_url');
// var_dump(get_fields()); 
?>
<?php if (astra_page_layout() == 'left-sidebar') : ?>
    <?php get_sidebar(); ?>
<?php endif ?>
<div id="primary" <?php astra_primary_class(); ?>>
    <main id="main" class="site-main">
        <article id="post-<?php the_ID(); ?>" <?php post_class('ast-article-single'); ?> itemscope itemtype="https://schema.org/CreativeWork">
            <div class="entry-content clear" data-ast-blocks-layout="true" itemprop="text">

                <!-- banner section -->
                <div class="leadership-page-banner">
                    <h1 class="headline largest-size"><?php echo ($banner_title); ?></h1>
                    <div class="desc small-size"><?php echo esc_html($banner_description); ?></div>
                    <button class="custom-button" onclick="window.location.href='<?php echo esc_html($banner_button_url) ?>';"><?php echo esc_html($banner_button_text); ?></button>
                </div>
                <!-- space below banner -->
                <div aria-hidden="true" class="wp-block-spacer below-banner-space"></div>


                <!-- meet our leaders  -->
                <div class="meet-our-leaders">
                    <h2 class="large-size font-bold meet-our-leaders-heading animate-on-scroll">Meet Our Leaders</h2>

                    <div class="button-container animate-on-scroll">
                        <?php
                        $terms = get_terms([
                            'taxonomy'   => 'leader-category',
                            'hide_empty' => false,
                            'meta_key'   => 'acf_order',
                            'orderby'    => 'meta_value_num',
                            'order'      => 'ASC',
                        ]);

                        if (!empty($terms) && !is_wp_error($terms)) {
                            foreach ($terms as $term) {
                                echo '<button data-category="' . esc_attr($term->slug) . '">' . esc_html($term->name) . '</button>';
                            }
                        }
                        ?>
                    </div>

                    <div id="grid-container" class="animate-on-scroll"></div>
                    <div class="pagination animate-on-scroll" id="desktop-nav">
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
                            <button id="close-popup"><img src="/wp-content/uploads/2025/03/ic-leader-popup-cross.svg"
                                    alt="Close"></button>
                            <div class="popup-body">
                                <div class="leader-img"><img id="popup-img" alt="leader-img"></div>
                                <div class="popup-text">
                                    <h2 class="leader-name small-size font-bold" id="popup-name">Mayank</h2>
                                    <h3 class="leader-designation smaller-size font-bold" id="popup-designation">Founder, CEO & MD</h3>
                                    <a class="leader-linkedin font-bold" id="popup-linkedin" href="#" target="_blank">https://www.linkedin.com/in/mayank-50248037/</a>
                                    <div class="scrollable-text">
                                        <p class="leader-description smallest-size" id="popup-description">
                                            Mayank sets the strategic direction for ADROSONIC, ensuring that the company’s culture is rooted in its core ethos — “We Care” — and culminates in delivering measurable business outcomes for clients. A strategic leader with a vision rooted in innovation, Mayank has been instrumental in positioning ADROSONIC as a trusted partner for enterprises seeking innovative and effective digital solutions. He has championed the company’s research & innovation initiatives, leading to the creation of the Digital Innovation Lab in collaboration with BIT Mesra — a pioneering Industry-Academia model aimed at democratising innovation. His leadership seamlessly blends disciplined governance with deep empathy, reflected in his efforts to nurture internal talent through structured mentorship programmes designed to identify, develop and empower future leaders from within the organisation. Mayank’s leadership philosophy canters on value delivery, stakeholder trust and sustainable growth. With a relentless focus on execution and a clear long-term vision, he continues to steer ADROSONIC on its mission to become a globally admired brand known for its care-driven, innovation-led approach. Based in Mumbai, Mayank lives with his wife and two sons. Outside of work, he finds joy in cooking global cuisines, traveling and road trips — often choosing to drive himself to lesser-known destinations. These journeys and the conversations with strangers along the way, provide grounding and fresh perspectives that continue to shape his leadership and life outlook.
                                        </p>
                                        <p class="leader-note smaller-size" id="popup-author">
                                            Leadership, to me, is about creating space – for ideas to thrive, for people to grow and for innovation to deliver real impact.
                                        </p>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- space below meet out leaders -->
                <div aria-hidden="true" class="wp-block-spacer below-meet-our-leaders-space"></div>
                <!-- what we believe in  -->
                <div class="leader-sec">
                    <div class="we-belive">
                        <h2 class="belive-heading large-size"><?php echo ($leadership_what_we_believe_in_heading); ?></h2>
                        <p class="belive medium-size"><?php echo ($leadership_what_we_believe_in_description); ?></p>
                        <button class="about-btn smaller-size" onclick="window.location.href='<?php echo esc_html($leadership_what_we_believe_in_button_url) ?>';"><?php echo esc_html($leadership_what_we_believe_in_button_text); ?></button>
                    </div>
                </div>
                <!-- space below we believe in -->
                <div aria-hidden="true" class="wp-block-spacer below-we-believe-space"></div>
                <!-- How Adrosonic Benefits Section  -->
                <div class="adro-benefits" id="benefits">
                    <div class="section-header-container">
                        <h2 class="large-size font-bold"><?php echo $adrosonic_benefits_section_main_header ?></h2>
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
                <!-- space below benefits -->
                <div aria-hidden="true" class="wp-block-spacer below-benefits-space"></div>

                <!-- gradiant section  -->
                <div class="leader-grad-sec">
                    <div class="gradient-container-leadership">
                        <div class="bg">
                            <div class="gradient gradient-1"></div>
                            <div class="gradient gradient-2"></div>
                            <div class="gradient gradient-3"></div>
                        </div>
                        <div class="content">
                            <h2 class="large-size"><?php echo esc_html($leadership_gradient_heading); ?></h2>
                            <p class="small-size"><?php echo esc_html($leadership_gradient_description); ?></p>
                        </div>
                        <div class="button-container">
                            <button class="join-btn custom-button smaller-size" onclick="window.location.href='<?php echo esc_html($leadership_gradient_cta_url) ?>';"><?php echo esc_html($leadership_gradient_cta_text); ?></button>
                        </div>
                    </div>
                    <div class="button-mob-tab">
                        <button class="join-btn custom-button  smaller-size" onclick="window.location.href='<?php echo esc_html($leadership_gradient_cta_url) ?>';"><?php echo esc_html($leadership_gradient_cta_text); ?></button>
                    </div>
                </div>
                <!-- space below gradiant -->
                <div aria-hidden="true" class="wp-block-spacer below-gradiant-space"></div>
                <?php
                $terms = get_terms(array(
                    'taxonomy'   => 'leader-category',
                    'hide_empty' => true,
                ));
                $data = [];

                if (!empty($terms) && !is_wp_error($terms)) {
                    foreach ($terms as $term) {

                        $posts = get_posts([
                            'post_type'      => 'leader',
                            'posts_per_page' => -1,
                            'tax_query'      => [
                                [
                                    'taxonomy' => 'leader-category',
                                    'field'    => 'term_id',
                                    'terms'    => $term->term_id,
                                ],
                            ],
                        ]);
                        $post_data = [];

                        foreach ($posts as $post) {
                            $term_slug = $term->slug;
                            $order_field = $term_slug . '_order';
                            $post_data[] = [
                                'img' => get_the_post_thumbnail_url($post->ID, 'full'),
                                'name' => get_field('acf_leader_name', $post->ID),
                                'designation' => get_field('acf_leader_designation', $post->ID),
                                'description' => get_field('acf_leader_description', $post->ID),
                                'linkedinText' => get_field('acf_leader_linkedin_text', $post->ID),
                                'linkedin' => get_field('acf_leader_linkedin_url', $post->ID),
                                'leaderNote' => get_field('acf_leader_note', $post->ID),
                                'order_value' => (int) get_field($order_field, $post->ID),
                            ];
                        }
                        usort($post_data, function ($a, $b) {
                            return $a['order_value'] <=> $b['order_value'];
                        });
                        foreach ($post_data as &$p) {
                            unset($p['order_value']);
                        }

                        $data[$term->name] = $post_data;
                    }
                }
                ?>
                <script>
                    var wpDataService = <?php echo json_encode($wpDataService); ?>;
                    const leadersData = <?php echo json_encode($data, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE); ?>;
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
