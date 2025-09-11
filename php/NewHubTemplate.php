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
$text_below_banner = get_field('acf_text_below_banner');
$button_below_banner = get_field('acf_button_below_banner');
$_below_banner_button_url = get_field('acf_below_banner_button_url');

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

                <!-- DESCRIPTION:Banner Section -->
                <div class="contain homepage-banner">
                    <div class="hero-carousel owl-carousel">
                        <?php if (have_rows('acf_homepage_banner_single_slide_contents')) :
                            $index = -1; ?>
                            <?php while (have_rows('acf_homepage_banner_single_slide_contents')): the_row();
                                $index++;
                                $banner_video_url = get_sub_field('acf_banner_video_url') ?: '';
                                $banner_video_thumbnail_image = get_sub_field('acf_banner_video_thumbnail_image') ?: '';
                                $banner_main_heading = get_sub_field('acf_main_heading') ?: '';
                                $banner_sub_heading = get_sub_field('acf_sub_heading') ?: '';
                                $banner_button_text = get_sub_field('acf_button_text') ?: '';
                                $banner_button_url = get_sub_field('acf_button_url') ?: '';
                                $banner_slide_logo = get_sub_field('acf_banner_slide_logo') ?: '';

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
                                                data-src="
                                    <?php echo $logo_data_src; ?>"
                                                <?php endif; ?> src="
                                    <?php echo $fallback_svg; ?>" alt="Client Logo">

                                        </div>
                                        <?php if ($index == 0) : ?>
                                            <!-- First slide: Use H1 -->
                                            <h1 class="largest-size banner-main-header">
                                                <?php echo ($banner_main_heading); ?>
                                            </h1>
                                        <?php else : ?>
                                            <!-- Other slides: Use H2 -->
                                            <h2 class="largest-size banner-main-header">
                                                <?php echo ($banner_main_heading); ?>
                                            </h2>
                                        <?php endif; ?>
                                        <p class="small-size banner-description">
                                            <?php echo $banner_sub_heading; ?>
                                        </p>

                                        <?php if ($index == 1 || $index == 2) : ?>
                                            <!-- For index 1 and 2: Open Vimeo video in a popup -->
                                            <button class="custom-button play-video-button"
                                                data-vimeo-url="<?php echo esc_url($banner_button_url); ?>">
                                                <?php echo esc_html($banner_button_text); ?>
                                            </button>
                                        <?php else: ?>
                                            <!-- For other indexes: Redirect to page URL -->
                                            <a href="<?php echo esc_url($banner_button_url); ?>">
                                                <button class="custom-button">
                                                    <?php echo esc_html($banner_button_text); ?>
                                                </button>
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                        <?php else : ?>
                            <p>No banners found.</p>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="below-homepage-banner">
                    <p class="has-text-align-center medium-size text-below-homepage-banner">
                        <?php echo ($text_below_banner); ?>
                    </p><a href="<?php echo esc_html($_below_banner_button_url) ?>" class="link-below-the-banner">
                        <button class="custom-button"
                            onclick="window.location.href='<?php echo esc_html($_below_banner_button_url) ?>';">
                            <svg width="27" height="22" viewBox="0 0 27 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M22.3535 0.999878C24.4148 0.999878 26 2.74342 26 4.78503V16.62C26 18.6616 24.4148 20.4052 22.3535 20.4052H4.64648C2.58521 20.4052 1 18.6616 1 16.62V4.78503C1 2.74342 2.58521 0.999878 4.64648 0.999878H22.3535Z" fill="white" stroke="#1A2C47" stroke-width="2" />
                                <path d="M25 1.99988L14.3399 13.1502C13.8876 13.6941 13.1124 13.6941 12.6601 13.1502L2 1.99988M2 19.4053L10.3343 10.7026M25 19.4053L16.6657 10.7026" stroke="#1A2C47" stroke-width="2" />
                            </svg>

                            <?php echo esc_html($button_below_banner); ?>
                        </button>
                    </a>
                </div>


                <!-- REMOVEME:Spacer -->

                <div class="spacer" style="height: 300px;"></div>


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



            <!-- REMOVEME: -->
            <div class="spacer" style="height: 300px;"></div>

            <!-- DESCRIPTION:Social Section -->
            <div class="contact-us-get-social">
                <div class="contact-left">
                    <h2 class="large-size main-header font-bold"> <?php echo esc_html($contact_us_social_media_heading); ?> </h2>
                    <p class="small-size description font-bold"> <?php echo esc_html($contact_us_social_media_sub_heading); ?> </p>
                    <p class="smaller-size sub-line"><?php echo esc_html($contact_us_statement_below_sub_heading); ?></p>

                    <button class="custom-button contact-btn openSubscribeModal" onclick="console.log('clicked'); openSubscribeModal()">
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
</div>
</article>
</main>
<?php the_content(); ?>
</div>
<?php
get_footer(); ?>