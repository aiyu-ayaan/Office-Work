<?php
    /*
    Template Name: Service
    */ 
/**
 * Custom service page template for Astra child theme.
 *
 * This template is specifically for all the service pages of the site.
 *
 * @package Astra Child
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header(); ?>
<?php 
    // $pods = pods('page', get_the_ID());

    // $banner_graphic_url = $pods->field('banner_graphic_url');
    // $banner_title = $pods->field('banner_title');
    // $banner_description = $pods->field('banner_description');
    // $banner_button_text = $pods->field('banner_button_text');
    // $banner_button_url = $pods->field('banner_button_url');

    $service_submenu_section_main_heading = the_field('acf_service_submenu_section_main_heading');
    $submenu_items = the_field('acf_submenu_single_item_name');
    $submenu_hrefs = [
        "expertise",
        "offerings",
        "benefits",
		"approach",
        "industry",
        "business-impact",
//         "insights",
        "testimonials"
    ];

//     $our_expertise_section_main_heading = $pods->field('our_expertise_section_main_heading');
//     $our_expertise_video_url = $pods->field('our_expertise_video_url');
//     $our_expertise_video_thumbnail = $pods->field('our_expertise_video_thumbnail');
//     $our_expertise_description_para_1 = $pods->field('our_expertise_description_para_1');
//     $our_expertise_description_para_2 = $pods->field('our_expertise_description_para_2');

//     $keyword_section_heading = $pods->field('keyword_section_heading');
//     $keywords = $pods->field('keywords');

//     $our_offerings_and_capabilities_main_heading = $pods->field('our_offerings_and_capabilities_main_heading');
//     $horizontal_tabs = $pods->field('horizontal_tabs');
//     $left_descriptions = $pods->field('left_description');
//     $left_cta_texts = $pods->field('left_cta_text');
//     $left_cta_urls = $pods->field('left_cta_url');
//     $right_headings_1 = $pods->field('right_heading_1');
//     $right_descriptions_1 = $pods->field('right_description_1');
//     $right_headings_2 = $pods->field('right_heading_2');
//     $right_descriptions_2 = $pods->field('right_description_2');
//     $portrait_view_descriptions = $pods->field('portrait_view_description');

//     $strategic_partner_main_header = $pods->field('strategic_partner_main_header');
//     $upload_partner_logos = $pods->field('upload_partner_logo');

//     $our_approach_main_heading = $pods->field('our_approach_main_heading');

//     $adrosonic_benefits_section_main_header = $pods->field('adrosonic_benefits_section_main_header');
//     $left_images = $pods->field('left_image');
//     $left_image_overlay_texts = $pods->field('left_image_overlay_text');
//     $benefits_menu_items = $pods->field('benefits_menu_items');

//     $our_approach_section_main_heading = $pods->field('our_approach_main_heading');
//     $our_approach_text_below_heading = $pods->field('service_page_our_approach_text_below_heading');
//     $our_approach_levels = $pods->field('service_page_our_approach_levels');
//     $our_approach_level_names = $pods->field('service_page_our_approach_level_names');
//     $our_approach_popup_contents = $pods->field('service_page_our_approach_popup_content');
//     $our_approach_figure_graphics = [
// 		  "/wp-content/uploads/2025/04/Our%20Approach%20Optimise.svg",
//         "/wp-content/uploads/2025/04/Our%20Approach%20Measure.svg",
// 		"/wp-content/uploads/2025/04/Our%20Approach%20Define.svg",
//         "/wp-content/uploads/2025/04/Our%20Approach%20Manage.svg",
//         "/wp-content/uploads/2025/04/Our%20Approach%20Start.svg",
//         "/wp-content/uploads/2025/04/Our%20Approach%20Struggle.svg"

//     ];
//     $our_approach_popup_colors = [
//        '#C2D0D8',
//        '#2C79A5',
//        '#00CBFF',
//        '#00B7B6',
//        '#789FF5',
//        '#B074FF'
//     ];

//     $our_industry_main_heading = $pods->field('our_industry_main_heading');
//     $industry_names = $pods->field('industry_name');
//     $industry_descriptions = $pods->field('industry_description');
//     $industry_cta_texts = $pods->field('industry_cta_text');
//     $industry_cta_urls = $pods->field('industry_cta_url');
//     $industry_right_images = $pods->field('industry_right_image');

//     $business_impact_main_heading = $pods->field('business_impact_main_heading');
//     $circular_progress_bar_percentages = $pods->field('circular_progress_bar_percentage');
//     $text_below_progress_circles = $pods->field('text_below_progress_circle');
//     $numerical_insights = $pods->field('numerical_insights');
//     $text_below_numerical_insights = $pods->field('text_below_numerical_insights');
//     $animated_text = $pods->field('animated_text');
//     $business_impact_button_text = $pods->field('business_impact_button_text');
//     $business_impact_button_url = $pods->field('business_impact_button_url');
//     $people_frame = $pods->field('people_frame');

//     $innovative_solutions_shortcode = $pods->field('innovative_solutions_shortcode');

//     $service_page_our_clients_section_heading = $pods->field('service_page_our_clients_section_heading');
//     $left_descriptions_ = $pods->field('left_description_');
//     $client_logos = $pods->field('client_logo');
//     $author_lines = $pods->field('author_line');
//     $how_we_help_heading = $pods->field('how_we_help_heading');
//     $how_we_help_paras_1 = $pods->field('how_we_help_para_1');
//     $how_we_help_paras_2 = $pods->field('how_we_help_para_2');

//     $service_related_faq_heading = $pods->field('service_related_faq_heading');
//     $questions = $pods->field('question');
//     $answers = $pods->field('answer');
?>
<!-- <?php if ( astra_page_layout() == 'left-sidebar' ) : ?>
	<?php get_sidebar(); ?>
<?php endif ?>
        <nav class="service-scroll-menu">
            <div class="service-menu-dropdown-container open">
                <p class="service-menu-dropdown-toggle small-size font-bold"><?php echo esc_html($service_submenu_section_main_heading); ?></p>
                <ul class="service-scroll-list">
                    <?php if (!empty($submenu_items)) : ?>
                        <?php foreach ($submenu_items as $index => $desc) :
                            $submenu_item = isset($submenu_items[$index]) ? $submenu_items[$index] : ''; ?> 
                            <li class="smaller-size font-bold submenu"><a href="#<?php echo esc_html($submenu_hrefs[$index]); ?>"><?php echo esc_html($submenu_item); ?></a></li>      
                        <?php endforeach; ?>
                    <?php else : ?>
                        <p>No submenu items found.</p>
                    <?php endif; ?>
                </ul>
            </div>
        </nav>
    </div>	 
    </div>
    </article>
</main>
    <?php the_content(); ?>
</div>
<?php
    if ( astra_page_layout() == 'right-sidebar' ) :
	    get_sidebar();
    endif;
    get_footer();
