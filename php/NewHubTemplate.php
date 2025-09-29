<?php

/**
 * Template Name: News Hub
 * Template Post Type: page
 */
/**
 * The template for displaying all blogs.
 *
 * @package Astra
 * @since 1.0.0
 */

if (! defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}
get_header(); ?>

<?php

$banner_section_fields = get_field('acf_news_hub_banner_section_fields');

$text_below_banner = $banner_section_fields['acf_news_hub_banner_text_below_banner'] ?: '';
$button_below_banner = $banner_section_fields['acf_news_hub_banner_below_banner_button_text'] ?: '';
$_below_banner_button_url = $banner_section_fields['acf_news_hub_banner_below_banner_button_url'] ?: '';

$contact_us_social_media_heading = get_field('acf_contact_us_social_media_heading');
$contact_us_social_media_sub_heading = get_field('acf_contact_us_social_media_sub_heading');
$contact_us_statement_below_sub_heading = get_field('acf_contact_us_statement_below_sub_heading');
$contact_us_social_media_button_text = get_field('acf_contact_us_social_media_button_text');
$contact_us_social_media_button_url = get_field('acf_contact_us_social_media_button_url');
$contact_us_social_media_linkedin_url = get_field('acf_contact_us_social_media_linkedin_url');
$contact_us_social_media_twitter_url = get_field('acf_contact_us_social_media_twitter_url');
$contact_us_social_media_youtube_url = get_field('acf_contact_us_social_media_youtube_url');
$contact_us_social_media_image = get_field('acf_contact_us_social_media_image');


// DESCRIPTION:Check for left sidebar
$award_and_recognition_section = get_field('acf_news_hub_awards_and_recognition_section');
$section_title = $award_and_recognition_section['acf_news_hub_awards_and_recognition_section_title'] ?: '';
$section_subtitle = $award_and_recognition_section['acf_news_hub_awards_and_recognition_section_description'] ?: '';


$events_section = get_field('acf_news_hub_events_and_highlights_section');
$events_and_highlights_section_main_heading =  $events_section['acf_news_hub_events_and_highlights_section_heading'] ?? '';
$events_and_highlights_section_sub_heading = $events_section['acf_news_hub_events_and_highlights_sub_heading'] ?? '';


// For Latest News section
$latest_news_section = get_field('acf_news_hub_latest_news_section');
$latest_news_section_main_heading =  $latest_news_section['acf_news_hub_latest_news_section_heading'] ?? '';
$latest_news_section_sub_heading = $latest_news_section['acf_news_hub_latest_news_sub_heading'] ?? '';

//For Up and Coming
$up_and_coming_section = get_field('acf_news_hub_up_and_coming_section');
if (!empty($up_and_coming_section)) {
    $up_and_coming_heading = $up_and_coming_section['acf_news_hub_up_and_coming_section_heading'] ?? '';
    $up_and_coming_sub_heading = $up_and_coming_section['acf_news_hub_up_and_coming_section_sub_heading'] ?? '';
}

// DESCRIPTION:All Press Release Section

$all_press_release_section = get_field('acf_news_hub_all_press_releases_section_fields');
$all_press_release_section_heading = $all_press_release_section['acf_news_hub_us_in_the_news_tab_fields_section_title'] ?? '';
$news_hub_section_tab_groups = $all_press_release_section['acf_news_hub_section_tab_groups'] ?? '';
$all_press_release_title = $news_hub_section_tab_groups['acf_news_hub_all_press_release_title'] ?? '';
$us_in_the_news_title = $news_hub_section_tab_groups['acf_news_hub_us_in_the_news_title'] ?? '';
?>

<?php if (astra_page_layout() == 'left-sidebar') : ?>
    <?php get_sidebar(); ?>
<?php endif; ?>

<script nonce="<?php echo esc_attr(get_csp_nonce()); ?>">
    // Your inline JavaScript
    console.log("Secure CSP script: <?php echo esc_attr(get_csp_nonce()); ?>");
</script>


<div id="primary" <?php astra_primary_class(); ?>>
    <main id="main" class="site-main">
        <article id="post-<?php the_ID(); ?>" <?php post_class('ast-article-single'); ?> itemscope
            itemtype="https://schema.org/CreativeWork">
            <div class="entry-content clear" data-ast-blocks-layout="true" itemprop="text">

                <?php
                $carousal_item = $banner_section_fields['acf_news_hub_banner_carousel_items'] ?? [];
                ?>
                <!-- DESCRIPTION:Banner Section -->
                <div class="contain homepage-banner">
                    <div class="hero-carousel owl-carousel">
                        <?php if ($carousal_item && is_array($carousal_item)) : ?>
                            <?php foreach ($carousal_item as $index => $card_items): ?>
                                <?php
                                $banner_video_url = $card_items['acf_news_hub_banner_banner_video_url'] ?: '';
                                $banner_video_thumbnail_image = $card_items['acf_news_hub_banner_banner_video_thumbnail'] ?: '';
                                $banner_main_heading = $card_items['acf_news_hub_banner_heading'] ?: '';
                                $banner_sub_heading = $card_items['acf_news_hub_banner_sub-heading'] ?: '';
                                $banner_button_text = $card_items['acf_news_hub_banner_button_text'] ?: '';
                                $banner_button_url = $card_items['acf_news_hub_banner_button_url'] ?: '';
                                $banner_slide_logo = $card_items['acf_news_hub_banner_banner_logo'] ?: '';
                                ?>
                                <div class="item">
                                    <div class="video-background">
                                        <video class="manual-lazy-load bg-img-video" preload="none"
                                            poster="<?php echo esc_html($banner_video_thumbnail_image); ?>"
                                            data-src="<?php echo esc_html($banner_video_url); ?>" autoplay loop muted
                                            playsinline></video>

                                        <div class="overlay"></div>
                                    </div>
                                    <div class="slide-content">
                                        <div class="client-logo">
                                            <?php $fallback_svg = "data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 7 2'%3E%3C/svg%3E";
                                            $logo_data_src = !empty($banner_slide_logo) ? esc_html($banner_slide_logo) : ''; ?>
                                            <img class="manual-lazy-load client-logo-img" <?php if ($logo_data_src): ?>
                                                data-src="<?php echo $logo_data_src; ?>"
                                                <?php endif; ?> src="<?php echo $fallback_svg; ?>" alt="Client Logo">

                                        </div>
                                        <?php if ($index == 0) : ?>
                                            <!-- First slide: Use H1 -->
                                            <h1 class="largest-size banner-main-header">
                                                <?php echo esc_html($banner_main_heading); ?>
                                            </h1>
                                        <?php else : ?>
                                            <!-- Other slides: Use H2 -->
                                            <h2 class="largest-size banner-main-header">
                                                <?php echo esc_html($banner_main_heading); ?>
                                            </h2>
                                        <?php endif; ?>
                                        <p class="small-size banner-description">
                                            <?php echo esc_html($banner_sub_heading); ?>
                                        </p>

                                        <?php if (!empty($banner_button_url)) : ?>
                                            <a href="<?php echo esc_url($banner_button_url); ?>">
                                                <button class="custom-button">
                                                    <?php echo esc_html($banner_button_text); ?>
                                                </button>
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <p>No banners found.</p>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="below-homepage-banner">
                    <p class="has-text-align-center medium-size text-below-homepage-banner">
                        <?php echo ($text_below_banner); ?>
                    </p><a href="<?php echo esc_html($_below_banner_button_url) ?>" class="link-below-the-banner">
                        <button class="custom-button" onclick="sendMail(event)">
                            <svg width="27" height="22" viewBox="0 0 27 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M22.3535 0.999878C24.4148 0.999878 26 2.74342 26 4.78503V16.62C26 18.6616 24.4148 20.4052 22.3535 20.4052H4.64648C2.58521 20.4052 1 18.6616 1 16.62V4.78503C1 2.74342 2.58521 0.999878 4.64648 0.999878H22.3535Z" fill="white" stroke="#1A2C47" stroke-width="2" />
                                <path d="M25 1.99988L14.3399 13.1502C13.8876 13.6941 13.1124 13.6941 12.6601 13.1502L2 1.99988M2 19.4053L10.3343 10.7026M25 19.4053L16.6657 10.7026" stroke="#1A2C47" stroke-width="2" />
                            </svg>

                            <?php echo esc_html($button_below_banner); ?>
                        </button>
                    </a>
                </div>


                <div aria-hidden="true" class="spacer-below-news-hub-banner wp-block-spacer"></div>


                <!-- DESCRIPTION:Latest News -->

                <div class="latest-news-section">
                    <div class="our-latest-news-header">
                        <h2 class="main-header large-size font-bold"><?php echo $latest_news_section_main_heading; ?></h2>
                        <h3 class="sub-header small-size"><?php echo $latest_news_section_sub_heading; ?></h3>

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



                            <?php if (!empty($latest_news_section['acf_news_hub_latest_news_items'])): ?>
                                <?php foreach ($latest_news_section['acf_news_hub_latest_news_items'] as $index => $item):
                                    $card_image = $item['acf_news_hub_latest_news_item_image'] ?: '';
                                    $card_title = $item['acf_news_hub_latest_news_item_card_title'] ?: '';
                                    $card_description_para1 = $item['acf_news_hub_latest_news_item_card_description_para_1'] ?: '';
                                    $card_description_para2 = $item['acf_news_hub_latest_news_item_card_description_para_2'] ?: '';
                                    $card_button_text = $item['acf_news_hub_latest_news_item_card_button_text'] ?: '';
                                    $card_button_url = $item['acf_news_hub_latest_news_item_card_button_url'] ?: '';
                                ?>

                                    <div class="item card card-wrapper manual-lazy-load" data-index="<?php echo esc_html($index); ?>"
                                        data-bg="<?php echo esc_html($card_image); ?>"
                                        data-title="<?php echo esc_html($card_title); ?>"
                                        data-desc="<?php echo esc_html($card_description_para1); ?>&lt;br&gt;&lt;br&gt;<?php echo esc_html($card_description_para2); ?>"
                                        data-cta="<?php echo !empty($card_button_url) ? esc_url($card_button_url) : ''; ?>"
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
                                <p>No latest-news found.</p>
                            <?php endif; ?>
                        </div>
                    </div>

                </div>

                <div aria-hidden="true" class="spacer-below-news-hub-latest-news wp-block-spacer"></div>


                <!--DESCRIPTION: All press release -->
                <div class="all-press-release-section">
                    <h2 class="large-size font-bold main-heading"><?php echo $all_press_release_section_heading ?></h2>
                    <div class="section-header">
                        <!-- Tabs -->
                        <div class="tabs">
                            <button id="tab-all" class="tab-btn active custom-button" data-filter="all"><?php echo ($all_press_release_title); ?></button>
                            <button id="tab-us-news" class="tab-btn custom-button" data-filter="us"><?php echo ($us_in_the_news_title); ?></button>
                        </div>

                        <!-- Search -->
                        <div class="search-container">
                            <input type="text" id="search-input" placeholder="Search press releases..." class="search-bar">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 34 34" fill="none"
                                id="search-icon">
                                <path id="Icon akar-search"
                                    d="M33 33L25.445 25.431M29.632 15.316C29.632 18.1474 28.7924 20.9153 27.2193 23.2695C25.6463 25.6238 23.4104 27.4587 20.7945 28.5423C18.1786 29.6258 15.3001 29.9093 12.5231 29.3569C9.74606 28.8045 7.19519 27.4411 5.19307 25.4389C3.19094 23.4368 1.82747 20.8859 1.27508 18.1089C0.722698 15.3319 1.0062 12.4534 2.08975 9.8375C3.17329 7.2216 5.00821 4.98574 7.36246 3.41268C9.71671 1.83962 12.4846 1 15.316 1C19.1128 1 22.7542 2.50829 25.4389 5.19306C28.1237 7.87783 29.632 11.5192 29.632 15.316Z"
                                    stroke="#00CCFF" stroke-width="2" stroke-linecap="round"></path>
                            </svg>
                            <div id="search-suggestions" class="suggestions-box" style="display:none;"></div>
                        </div>
                    </div>

                    <main class="container">


                        <!-- Section for the posts -->
                        <section>
                            <div id="posts-container" class="posts-grid">
                                <!-- Posts will be loaded here by jQuery -->
                            </div>

                            <!-- Loading indicator -->
                            <div id="loading-indicator" class="loading-container" style="display: none;">
                                <div class="loader"></div>
                            </div>

                            <!-- Pagination buttons -->
                            <div id="pagination-container" class="pagination-container">
                                <!-- Pagination will be rendered here by jQuery -->
                            </div>
                        </section>
                    </main>
                </div>
                <div aria-hidden="true" class="spacer-below-news-hub-press-release wp-block-spacer"></div>

                <!-- DESCRIPTION:Events and Highlights -->
                <?php
                $events_section = get_field('acf_news_hub_events_and_highlights_section');
                $events_and_highlights_section_main_heading =  $events_section['acf_news_hub_events_and_highlights_section_heading'] ?? '';
                $events_and_highlights_section_sub_heading = $events_section['acf_news_hub_events_and_highlights_sub_heading'] ?? '';

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



                            <?php if (!empty($events_section['acf_news_hub_events_and_highlights_items'])): ?>
                                <?php foreach ($events_section['acf_news_hub_events_and_highlights_items'] as $index => $item):
                                    $card_image = $item['acf_news_hub_events_and_highlights_item_image'] ?: '';
                                    $card_title = $item['acf_news_hub_events_and_highlights_item_card_title'] ?: '';
                                    $card_description_para1 = $item['acf_news_hub_events_and_highlights_item_card_description_para_1'] ?: '';
                                    $card_description_para2 = $item['acf_news_hub_events_and_highlights_item_card_description_para_2'] ?: '';
                                    $card_button_text = $item['acf_news_hub_events_and_highlights_item_card_button_text'] ?: '';
                                    $card_button_url = $item['acf_news_hub_events_and_highlights_item_card_button_url'] ?: '';
                                ?>

                                    <div class="item card card-wrapper manual-lazy-load" data-index="<?php echo esc_html($index); ?>"
                                        data-bg="<?php echo esc_html($card_image); ?>"
                                        data-title="<?php echo esc_html($card_title); ?>"
                                        data-desc="<?php echo esc_html($card_description_para1); ?>&lt;br&gt;&lt;br&gt;<?php echo esc_html($card_description_para2); ?>"
                                        data-cta="<?php echo !empty($card_button_url) ? esc_url($card_button_url) : ''; ?>"
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


                <div aria-hidden="true" class="spacer-below-news-hub-events wp-block-spacer"></div>


                <!-- Up and coming -->
                <div class="section-header-container featured-insight-header-area">
                    <h2 class="main-header large-size font-bold">
                        <?php echo ($up_and_coming_heading) ?>
                    </h2>
                    <h3 class="sub-header small-size">
                        <?php echo esc_html($up_and_coming_sub_heading) ?>
                    </h3>
                </div>
                <div class="featured-insights owlslider">
                    <section id="slider">
                        <div class="container">
                            <div class="slider">
                                <div class="owl-carousel">
                                    <?php if (!empty($up_and_coming_section['acf_news_hub_up_and_coming_section_cards'])): ?>
                                        <?php foreach ($up_and_coming_section['acf_news_hub_up_and_coming_section_cards'] as $index => $item):
                                            $card_image = $item['acf_news_hub_up_and_coming_section_card_image'] ?: '';
                                            $card_label = $item['acf_news_hub_up_and_coming_section_card_lab'] ?: '';
                                            $card_desc = $item['acf_news_hub_up_and_coming_section_card_description'] ?: '';
                                            $card_cta_text = $item['acf_news_hub_up_and_coming_section_card_cta_text'] ?: '';
                                            $card_cta_url = $item['acf_news_hub_up_and_coming_section_card_cta_url'] ?: '';
                                        ?>
                                            <div class="insights-featured">
                                                <?php if (! empty($card_cta_url)) : ?>
                                                    <a class="clickable" href="<?php echo esc_url($card_cta_url); ?>">
                                                    <?php else: ?>
                                                        <div class="">
                                                        <?php endif; ?>
                                                        <div class="whole-card-cta"><img class=" manual-lazy-load" data-src="<?php echo  $card_image ?>" alt="Insight Illustration" src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 34 25'%3E%3C/svg%3E"></div>
                                                        <p class="insights-featured-head smaller-size"><?php echo $card_label; ?></p>
                                                        <div class="insights-featured-content">
                                                            <h3 class="insights-featured-text smaller-size"><?php echo $card_desc; ?></h3>
                                                            <?php if (!empty($card_cta_text && $card_cta_url)): ?>
                                                                <a class="insights-featured-cta smallest-size font-bold underline-on-hover service-button-cta" href="<?php echo esc_url($card_cta_url); ?>"><span><?php echo $card_cta_text; ?></span></a>
                                                            <?php endif; ?>

                                                        </div>
                                                        <?php if (! empty($card_cta_url)) : ?>
                                                    </a>
                                                <?php else: ?>
                                            </div>
                                        <?php endif; ?>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                            </div>
                        </div>
                </div>
                </section>
            </div>
            <div aria-hidden="true" class="spacer-below-news-hub-up-and-coming wp-block-spacer"></div>

            <!-- DESCRIPTION:Awards and Recognition -->
            <div class="newshub-page-carousel-wrapper">
                <div class="section-central-heading">
                    <h2 class="large-size font-bold"><?php echo ($section_title); ?></h2>
                    <h3 class="small-size">
                        <?php echo ($section_subtitle); ?>
                    </h3>
                </div>

                <div class="owl-carousel newshub-page-carousel">
                    <?php
                    $card_items = $award_and_recognition_section['acf_news_hub_awards_and_recognition_section_items'] ?: [];
                    ?>
                    <?php if ($card_items && is_array($card_items)) : ?>
                        <?php foreach ($card_items as $item):
                            $card_title = $item['acf_news_hub_awards_and_recognition_section_item_card_description'] ?: '';
                            $card_image = $item['acf_news_hub_awards_and_recognition_section_item_card_image'] ?: '';
                            $cta_url = $item['acf_news_hub_awards_and_recognition_section_item_card_url'] ?: '';
                            $cta_text = $item['acf_news_hub_awards_and_recognition_section_item_card_cta_text'] ?: '';

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



<div aria-hidden="true" class="spacer-below-news-hub-awards wp-block-spacer"></div>

<!-- DESCRIPTION:Social Section -->
<div class="contact-us-get-social">
    <div class="contact-left">
        <h2 class="large-size main-header font-bold"> <?php echo esc_html($contact_us_social_media_heading); ?> </h2>
        <p class="small-size description font-bold"> <?php echo esc_html($contact_us_social_media_sub_heading); ?> </p>
        <p class="smaller-size sub-line"><?php echo esc_html($contact_us_statement_below_sub_heading); ?></p>

        <button class="custom-button contact-btn openSubscribeModal" onclick="sendMail(event)">
            <svg width="27" height="22" viewBox="0 0 27 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M22.3535 0.999878C24.4148 0.999878 26 2.74342 26 4.78503V16.62C26 18.6616 24.4148 20.4052 22.3535 20.4052H4.64648C2.58521 20.4052 1 18.6616 1 16.62V4.78503C1 2.74342 2.58521 0.999878 4.64648 0.999878H22.3535Z" fill="white" stroke="#1A2C47" stroke-width="2" />
                <path d="M25 1.99988L14.3399 13.1502C13.8876 13.6941 13.1124 13.6941 12.6601 13.1502L2 1.99988M2 19.4053L10.3343 10.7026M25 19.4053L16.6657 10.7026" stroke="#1A2C47" stroke-width="2" />
            </svg>

            <?php echo esc_html($contact_us_social_media_button_text); ?>
        </button>

        <div id="subscribeModal" class="custom-modal" style="display: none;">
            <div class="custom-modal-content">
                <h2 class="contact-subscribe-heading large-size font-bold">Subscribe to our newsletter</h2>
                <button id="closeSubscribeModal" class="close-modal-btn" aria-label="Close modal">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32" fill="none">
                        <path d="M9 9L23 23" stroke="white" stroke-width="2" stroke-linecap="round" />
                        <path d="M9 23L23 9" stroke="white" stroke-width="2" stroke-linecap="round" />
                        <circle cx="16" cy="16" r="15.5" stroke="white" />
                    </svg>
                </button>
                <div id="iframeLoader" class="loader">Loading...</div>
                <iframe id="subscribeModalIframe" data-src="/subscribeIframe.php"></iframe>

                <p class="consent-txt smaller-size">
                    By clicking the “Subscribe Now” button, you are agreeing to the
                    the <a class="font-bold" href="/protection-policy">Personal Data Protection Policy</a> and
                    <a class="font-bold" href="/privacy-policy">Privacy Policy</a>. Your Privacy is important to us.
                </p>
            </div>
        </div>



        <div class="social-icons">
            <a href="<?php echo esc_html($contact_us_social_media_linkedin_url); ?>" aria-label="LinkedIn" target="_blank" rel="noopener noreferrer" class="icon-a">
                <span aria-hidden="true" class="">
                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48" fill="none">
                        <g clip-path="url(#clip0_1893_1908)">
                            <path
                                d="M44.4554 0H3.54671C1.58775 0 0 1.53922 0 3.43897V44.56C0 46.4597 1.58828 48.0005 3.54671 48.0005H44.4554C46.4144 48.0005 48 46.4592 48 44.56V3.43897C48 1.53975 46.4144 0 44.4554 0ZM14.5522 40.1796H7.29981V18.5079H14.5522V40.1796ZM10.9265 15.5474H10.878C8.44596 15.5474 6.86941 13.8839 6.86941 11.8017C6.86941 9.67744 8.49236 8.05929 10.9724 8.05929C13.4529 8.05929 14.9788 9.67691 15.0268 11.8017C15.0268 13.8844 13.4535 15.5474 10.9265 15.5474ZM40.6954 40.1796H33.4452V28.5848C33.4452 25.6707 32.3945 23.6829 29.7726 23.6829C27.7667 23.6829 26.5763 25.0243 26.0536 26.3187C25.8595 26.7816 25.812 27.428 25.812 28.0744V40.1791H18.5629C18.5629 40.1791 18.6578 20.54 18.5629 18.5074H25.8126V21.58C26.7752 20.1037 28.4947 17.9975 32.3454 17.9975C37.1172 17.9975 40.6954 21.093 40.6954 27.7528V40.1796ZM25.7656 21.6488C25.7784 21.6285 25.7955 21.6034 25.8126 21.58V21.6488H25.7656Z">
                            </path>
                        </g>
                        <defs>
                            <clipPath id="clip0_1893_1908">
                                <rect width="48" height="48"></rect>
                            </clipPath>
                        </defs>
                    </svg>
                </span>
            </a>
            <a href="<?php echo esc_html($contact_us_social_media_twitter_url); ?>" aria-label="Twitter / X" target="_blank" rel="noopener noreferrer" class="icon-a">
                <span aria-hidden="true" class="">
                    <svg xmlns="http://www.w3.org/2000/svg" width="47" height="48" viewBox="0 0 47 48" fill="none">
                        <g clip-path="url(#clip0_346_440)">
                            <path
                                d="M23.8203 21.229L15.1467 8.81445H10.5107L21.278 24.1963L22.6239 26.1163L31.8317 39.2945H36.4676L25.1876 23.1708L23.8203 21.229Z">
                            </path>
                            <path
                                d="M43.0691 0H3.93091C1.75182 0 0 1.78909 0 4.01455V43.9855C0 46.2109 1.75182 48 3.93091 48H43.0691C45.2482 48 47 46.2109 47 43.9855V4.01455C47 1.78909 45.2482 0 43.0691 0ZM30.4218 41.4545L21.0859 27.9055L9.42136 41.4545H6.40909L19.7614 25.9636L6.40909 6.54545H16.5782L25.4014 19.3745L36.4677 6.54545H39.48L26.7473 21.3382L40.5909 41.4545H30.4218Z">
                            </path>
                        </g>
                        <defs>
                            <clipPath id="clip0_346_440">
                                <rect width="47" height="48"></rect>
                            </clipPath>
                        </defs>
                    </svg>
                </span>
            </a>
            <a href="<?php echo esc_html($contact_us_social_media_youtube_url); ?>" aria-label="Youtube" target="_blank" rel="noopener noreferrer" class="icon-a">
                <span aria-hidden="true" class="">
                    <svg xmlns="http://www.w3.org/2000/svg" width="63" height="48" viewBox="0 0 63 48" fill="none">
                        <g clip-path="url(#clip0_346_437)">
                            <path
                                d="M62.5912 10.5994C62.5912 4.97474 58.5178 0.449977 53.4845 0.449977C46.6668 0.124993 39.7137 0 32.6129 0H30.3978C23.3093 0 16.3439 0.124993 9.52615 0.449977C4.50515 0.449977 0.431745 4.99974 0.431745 10.6244C0.124086 15.0742 -0.011284 19.524 -0.000208302 23.9738C-0.0125147 28.4235 0.122855 32.8733 0.418208 37.3356C0.418208 42.9603 4.49162 47.5225 9.51262 47.5225C16.6749 47.86 24.0218 48.01 31.4918 47.9975C38.9741 48.0225 46.2964 47.8725 53.471 47.5225C58.5043 47.5225 62.5777 42.9603 62.5777 37.3356C62.873 32.8733 63.0084 28.4235 62.9961 23.9613C63.0207 19.5115 62.8853 15.0617 62.59 10.5994H62.5912ZM25.4752 36.2356V11.6744L43.3195 23.9488L25.4752 36.2356Z">
                            </path>
                        </g>
                        <defs>
                            <clipPath id="clip0_346_437">
                                <rect width="63" height="48"></rect>
                            </clipPath>
                        </defs>
                    </svg>
                </span>
            </a>
        </div>
    </div>
    <div class="contact-right"><img data-src="<?php echo esc_html($contact_us_social_media_image); ?>" alt="Contact Us Image" src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1 1'%3E%3C/svg%3E"></div>
</div>

<div aria-hidden="true" class="spacer-below-news-hub-social-media wp-block-spacer"></div>
</div>
</article>
</main>
<?php the_content(); ?>
</div>
<?php
get_footer(); ?>