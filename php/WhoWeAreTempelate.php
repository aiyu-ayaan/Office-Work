<?php

/**
 * Template Name: Webinar
 * Template Post Type: post
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

$banner_title = get_field('acf_who_we_are_page_banner_title') ?? '';
$banner_image = get_field('acf_who_we_are_page_banner_image') ?? '';
$banner_button_text = get_field('acf_who_we_are_page_banner_button_text') ?? '';
$banner_button_url = get_field('acf_who_we_are_page_banner_button_url') ?? '';
$text_below_banner = get_field('acf_who_we_are_page_text_below_banner') ?? '';
$button_below_banner_text = get_field('acf_who_we_are_page_button_below_banner_text') ?? '';
$button_below_banner_url = get_field('acf_who_we_are_page_button_below_banner_url') ?? '';

$who_we_are_card = get_field('acf_who_we_are_page_who_we_are_cards');

$statement_at_the_end_of_the_page = get_field('acf_who_we_are_page_statement_at_the_end_of_the_page') ?? '';
$button_at_then_end_of_the_page_text = get_field('acf_who_we_are_page_button_at_the_end_of_page_text') ?? '';
$button_at_then_end_of_the_page_url = get_field('acf_who_we_are_page_button_at_the_end_of_page_url') ?? '';


// Check if get_minutes function exists before using it
// if (function_exists('get_minutes')) {
//     $minute_read = get_minutes(get_the_ID(), ['acf_post_content_frame_section']);
// } else {
//     $minute_read = get_field('acf_read_minutes') ?? '';
// }

// $text_above_watch_now_button_content_frame = get_field('acf_webinar_text_above_watch_now_button_in_content_frame') ?? '';

// $webinar_author_card = get_field('acf_webinar_author_card');
// $author_card_photo = '';
// $author_card_name_of_the_person = '';
// $author_card_designation_of_person = '';
// $author_card_brief_description = '';

// if (!empty($webinar_author_card)) {
//     $author_card_photo = $webinar_author_card['acf_webinar_author_card_photo'] ?? '';
//     $author_card_name_of_the_person = $webinar_author_card['acf_webinar_name_of_the_person'] ?? '';
//     $author_card_designation_of_person = $webinar_author_card['acf_webinar_designation_of_person'] ?? '';
//     $author_card_brief_description = $webinar_author_card['acf_webinar_author_card_brief_description'] ?? '';
// }

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
                                            <span>We are </span>
                                            <div class="animated-text">
                                                <div>Collaborative</div>
                                                <div>Innovative</div>
                                                <div>Passionate</div>
                                            </div>
                                        </h1>
                                        <a href="http://">
                                            <button class="custom-button who-we-are-banner-button">
                                                Get in touch
                                            </button>
                                        </a>
                                    </div>
                                    <div class="who-we-are-banner-quote">
                                        <p class="who-we-are-banner-quote-text medium-size">
                                            Lorem ipsum dolor sit amet, consetetur
                                            sadipscing elitr, sed diam nonumy eirmod
                                            tempor invidunt ut <span>labore et dolore magna</span>
                                            aliquyam erat, sed diam
                                        </p>
                                        <button class="custom-button who-we-are-banner-learn-more-button">
                                            Learn about us
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- END:Banner Ends here -->

                        <!-- Content frame section -->
                        <div class="main-frame">
                            <div class="outer">
                                <div class="share-frame">
                                    <div class="share-icons">
                                        <button class="share-toggle" aria-label="Toggle share options" aria-expanded="false" aria-controls="share-list">
                                            <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="36" height="69" viewBox="0 0 36 69" fill="none" focusable="false">
                                                <path class="svg-path-fill" d="M36 20C36 8.9543 27.0457 0 16 0H0V69H16C27.0457 69 36 60.0457 36 49V20Z" fill="#00ccff" />
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M25.043 38.2513C23.9417 38.2513 22.9586 38.7284 22.2659 39.4783L14.6891 36.1593C14.7223 35.9576 14.7513 35.7541 14.7513 35.543C14.7513 35.1485 14.674 34.7756 14.5623 34.418L22.2808 30.5424C22.9727 31.2822 23.95 31.7513 25.043 31.7513C27.137 31.7513 28.8346 30.0537 28.8346 27.9596C28.8346 25.8656 27.137 24.168 25.043 24.168C22.9489 24.168 21.2513 25.8656 21.2513 27.9596C21.2513 28.18 21.2801 28.393 21.3162 28.6031L13.3356 32.6102C12.6838 32.0813 11.8644 31.7513 10.9596 31.7513C8.86557 31.7513 7.16797 33.4489 7.16797 35.543C7.16797 37.637 8.86557 39.3346 10.9596 39.3346C12.061 39.3346 13.044 38.8575 13.7367 38.1077L21.3135 41.4266C21.2803 41.6284 21.2513 41.8318 21.2513 42.043C21.2513 44.137 22.9489 45.8346 25.043 45.8346C27.137 45.8346 28.8346 44.137 28.8346 42.043C28.8346 39.9489 27.137 38.2513 25.043 38.2513ZM25.043 26.3346C25.939 26.3346 26.668 27.0636 26.668 27.9596C26.668 28.8556 25.939 29.5846 25.043 29.5846C24.147 29.5846 23.418 28.8556 23.418 27.9596C23.418 27.0636 24.147 26.3346 25.043 26.3346ZM10.9596 37.168C10.0636 37.168 9.33464 36.439 9.33464 35.543C9.33464 34.647 10.0636 33.918 10.9596 33.918C11.8556 33.918 12.5846 34.647 12.5846 35.543C12.5846 36.439 11.8556 37.168 10.9596 37.168ZM25.043 43.668C24.147 43.668 23.418 42.939 23.418 42.043C23.418 41.147 24.147 40.418 25.043 40.418C25.939 40.418 26.668 41.147 26.668 42.043C26.668 42.939 25.939 43.668 25.043 43.668Z" fill="#1A2C47" />
                                            </svg>
                                        </button>
                                        <div class="share-list share-hidden">
                                            <span class="share-title smaller-size font-bold">SHARE</span>
                                            <div id="linkedin-share-btn" class="ic_share">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48" fill="none">
                                                    <path class="svg-path-fill" d="M44.4554 0H3.54671C1.58775 0 0 1.53922 0 3.43897V44.56C0 46.4597 1.58828 48.0005 3.54671 48.0005H44.4554C46.4144 48.0005 48 46.4592 48 44.56V3.43897C48 1.53975 46.4144 0 44.4554 0ZM14.5522 40.1796H7.29981V18.5079H14.5522V40.1796ZM10.9265 15.5474H10.878C8.44596 15.5474 6.86941 13.8839 6.86941 11.8017C6.86941 9.67744 8.49236 8.05929 10.9724 8.05929C13.4529 8.05929 14.9788 9.67691 15.0268 11.8017C15.0268 13.8844 13.4535 15.5474 10.9265 15.5474ZM40.6954 40.1796H33.4452V28.5848C33.4452 25.6707 32.3945 23.6829 29.7726 23.6829C27.7667 23.6829 26.5763 25.0243 26.0536 26.3187C25.8595 26.7816 25.812 27.428 25.812 28.0744V40.1791H18.5629C18.5629 40.1791 18.6578 20.54 18.5629 18.5074H25.8126V21.58C26.7752 20.1037 28.4947 17.9975 32.3454 17.9975C37.1172 17.9975 40.6954 21.093 40.6954 27.7528V40.1796ZM25.7656 21.6488C25.7784 21.6285 25.7955 21.6034 25.8126 21.58V21.6488H25.7656Z" fill="#00ccff" />
                                                </svg>
                                            </div>
                                            <div id="email-share-btn" class="ic_share">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48" fill="none">
                                                    <rect x="1.78735" y="5.76465" width="44.426" height="38.364" fill="#1A2C47" />
                                                    <path class="svg-path-fill" d="M43.001 0C45.7622 0.0002585 48.001 2.23874 48.001 5V43C48.001 45.7613 45.7622 47.9997 43.001 48H5C2.23859 48 1.44103e-05 45.7614 0 43V5C0 2.23858 2.23858 4.26579e-08 5 0H43.001ZM8.60254 10C6.06076 10 4 12.0062 4 14.4805V33.5205C4.00022 35.9946 6.0609 38 8.60254 38H39.3984C41.9399 37.9998 43.9998 35.9945 44 33.5205V14.4805C44 12.0063 41.9401 10.0002 39.3984 10H8.60254Z" fill="#00ccff" />
                                                    <path class="svg-path-stroke" d="M44.0004 10L25.4609 27.9375C24.6744 28.8125 23.326 28.8125 22.5395 27.9375L4 10M4 38L18.4945 24M44.0004 38L29.5059 24" stroke="#00ccff" stroke-width="2" />
                                                </svg>
                                            </div>
                                            <div id="copy-link-btn" class="ic_share">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48" fill="none">
                                                    <path class="svg-path-fill" d="M43 0C45.7614 5.15405e-07 48 2.23858 48 5V43C48 45.7614 45.7614 48 43 48H5C2.23858 48 0 45.7614 0 43V5C5.15422e-07 2.23858 2.23858 0 5 0H43ZM29.0576 21.9121C26.4413 17.2984 19.9202 16.5988 16.125 20.3936L9.36914 27.1494C6.21181 30.3068 6.21134 35.4735 9.36816 38.6318C12.5258 41.7894 17.6933 41.7894 20.8516 38.6318L26.541 32.9424C27.0397 32.4437 27.4719 31.8824 27.8252 31.2715C25.9738 31.733 23.9888 31.5379 22.251 30.6865L17.5898 35.3477C16.1641 36.7733 13.8274 36.7747 12.4004 35.3477C10.9736 33.9206 10.9735 31.5852 12.4004 30.1582L19 23.5586C20.352 22.2066 23.0509 21.8037 25.0908 23.6709C27.0649 23.4631 27.8313 23.086 29.0576 21.9121ZM38.6328 9.36816C35.4746 6.20992 30.307 6.21067 27.1494 9.36816L21.6611 14.8574C21.1798 15.3388 20.76 15.8785 20.4141 16.4648C22.0961 16.1574 23.8589 16.3807 25.4248 17.1338L30.1582 12.4004C31.5839 10.9746 33.9206 10.9733 35.3477 12.4004C36.7746 13.8275 36.7747 16.1628 35.3477 17.5898L28.748 24.1885C27.663 25.2733 26.0954 25.5758 24.7588 25.0107C22.4885 24.0506 21.3265 23.3812 18.9434 25.4521C21.1142 30.423 27.8896 31.5926 31.876 27.6074L38.6318 20.8516C41.7895 17.6939 41.7895 12.5258 38.6318 9.36816H38.6328Z" fill="#00ccff" />
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="main-content">
                                    <div class="inner top">
                                        <div class="text-content-box">
                                            <div class="small-size desc-text collapsed" id="textContent">
                                                <?php echo wp_kses_post($post_content_frame_section) ?>
                                            </div>
                                            <button class="toggle-btn collapsed" id="toggleBtn">
                                                <span class="toggle-text">See more</span>
                                                <svg class="arrow-svg" width="50" height="24" viewBox="0 0 50 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M38 12L2 12" stroke="#00CCFF" stroke-width="2" stroke-linecap="round" />
                                                    <path d="M28.2354 12C28.2354 13.9778 28.8218 15.9112 29.9207 17.5557C31.0195 19.2002 32.5813 20.4819 34.4085 21.2388C36.2358 21.9957 38.2464 22.1937 40.1863 21.8078C42.1261 21.422 43.9079 20.4696 45.3064 19.0711C46.7049 17.6725 47.6573 15.8907 48.0432 13.9509C48.4291 12.0111 48.231 10.0004 47.4741 8.17316C46.7173 6.3459 45.4355 4.78412 43.7911 3.6853C42.1466 2.58649 40.2132 2 38.2353 2C35.5832 2 33.0396 3.05357 31.1643 4.92893C29.2889 6.8043 28.2354 9.34783 28.2354 12Z" stroke="#00CCFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                                </svg>
                                            </button>
                                        </div>
                                        <div class="inner-download-block">
                                            <p class="download-text medium-size font-bold"><?php echo esc_html($text_above_watch_now_button_content_frame) ?></p>
                                            <button class="custom-button open-pardot-play-popup"><?php echo esc_html($vimeo_popup_button_text); ?></button>
                                        </div>
                                    </div>
                                    <div class="bottom"></div>
                                </div>
                            </div>
                            <div class="overlay-wrapper">
                                <div class="edge-card">
                                    <div class="profile-box">
                                        <div class="profile">
                                            <?php if ($author_card_photo): ?>
                                                <img src="<?php echo esc_url($author_card_photo) ?>" alt="<?php echo esc_attr($author_card_name_of_the_person) ?>">
                                            <?php endif; ?>
                                            <div class="info">
                                                <div class="name small-size font-bold"><?php echo esc_html($author_card_name_of_the_person); ?></div>
                                                <div class="designation smaller-size"><?php echo esc_html($author_card_designation_of_person); ?></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="section">
                                        <h3 class="small-size"><?php echo esc_html($author_card_brief_description); ?></h3>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="copy-notification">
                            Link copied to clipboard!
                        </div>

                        <!-- Space below content frame -->
                        <div aria-hidden="true" class="wp-block-spacer spacer-below-content-frame"></div>

                        <?php the_content(); ?>
                    </div>
</div>
</article>
<?php endwhile;
        endif; ?>
</main>
</div><!-- #primary -->

<?php get_footer(); ?>