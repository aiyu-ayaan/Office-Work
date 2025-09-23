<?php
/*
Template Name: Careers
*/

/**
 * Custom career template for Astra child theme.
 *
 * This template is specifically for the career of the site.
 *
 * @package Astra Child
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

get_header(); ?>

<?php
$careers_banner_background_image = get_field('acf_career_banner_background_image');
$careers_banner_title = get_field('acf_career_banner_title');
$careers_banner_description = get_field('acf_career_banner_description');
$careers_banner_button_text = get_field('acf_career_banner_button_text');
$careers_banner_button_url = get_field('acf_career_banner_button_url');

$our_expertise_section_main_heading = get_field('acf_our_expertise_section_main_heading');
$our_expertise_video_url = get_field('acf_our_expertise_video_url');
$our_expertise_video_thumbnail = get_field('our_expertise_video_thumbnail');
$our_expertise_description_para_1 = get_field('acf_our_expertise_description_para_1');
$our_expertise_description_para_2 = get_field('acf_our_expertise_description_para_2');

$life_at_adrosonic_section_heading = get_field('acf_careers_life_at_adrosonic_section_heading');
$life_at_adrosonic_sub_heading = get_field('acf_careers_life_at_adrosonic_sub-heading');
$life_at_adrosonic_button_text = get_field('acf_careers_life_at_adrosonic_button_text');
$life_at_adrosonic_button_url = get_field('acf_careers_life_at_adrosonic_button_url');

$diversity_section_heading = get_field('acf_careers_page_diversity_section_heading');
$diversity_section_description = get_field('acf_careers_page_diversity_section_description');
$diversity_section_image = get_field('acf_careers_page_diversity_section_image');
$diversity_section_button_text = get_field('acf_careers_page_diversity_section_button_text');
$diversity_section_button_url = get_field('acf_careers_page_diversity_section_button_url');

$stay_connected_section_heading = get_field('acf_careers_page_stay_connected_section_heading');

$careers_social_media_heading = get_field('acf_contact_us_social_media_heading');
$careers_social_media_sub_heading = get_field('acf_contact_us_social_media_sub_heading');
$careers_statement_below_sub_heading = get_field('acf_contact_us_statement_below_sub_heading');
$careers_social_media_button_text = get_field('acf_contact_us_social_media_button_text');
$careers_social_media_button_url = get_field('acf_contact_us_social_media_button_url');
$careers_social_media_linkedin_url = get_field('acf_contact_us_social_media_linkedin_url');
$careers_social_media_twitter_url = get_field('acf_contact_us_social_media_twitter_url');
$careers_social_media_youtube_url = get_field('acf_contact_us_social_media_youtube_url');
$careers_social_media_image = get_field('acf_contact_us_social_media_image');

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
        <article id="post-<?php the_ID(); ?>" <?php post_class('ast-article-single'); ?> itemscope itemtype="https://schema.org/CreativeWork">
            <div class="entry-content clear" data-ast-blocks-layout="true" itemprop="text">

                <!-- banner section -->
                <div class="service-banner-sub-menu-together">
                    <div class="service-hero-banner manual-lazy-load"
                        style="background: linear-gradient(0deg, rgba(67, 102, 143, 0.14) 27.62%, rgba(35, 51, 70, 0.60) 88.81%), url('data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' viewBox=\'0 0 1 1\'%3E%3C/svg%3E'); background-color: lightgray;"
                        data-src="<?php echo esc_html($careers_banner_background_image); ?>">

                        <div class="left-text-box">
                            <h1 class="largest-size"><?php echo esc_html($careers_banner_title); ?></h1>
                            <p class="small-size"><?php echo esc_html($careers_banner_description); ?></p>
                            <button class="custom-button career-get-in-touch" onclick="window.location.href='<?php echo esc_html($careers_banner_button_url) ?>';"><?php echo esc_html($careers_banner_button_text); ?></button>
                        </div>
                    </div>
                </div>
                <div aria-hidden="true" class="spacer-below-banner"></div>
                <!-- our expertise section-->
                <div class="our_expertise_container" id="expertise">
                    <h2 class="large-size font-bold portrait-only-header"><?php echo esc_html($our_expertise_section_main_heading); ?></h2>
                    <div class="video-container">
                        <video class="manual-lazy-load" data-src="<?php echo esc_html($our_expertise_video_url) ?>" autoplay muted loop playsinline poster="<?php echo esc_html($our_expertise_video_thumbnail) ?>">
                            <!--                 <source class="manual-lazy-load"  type="video/mp4"> -->
                            Your browser does not support the video tag.
                        </video>
                    </div>
                    <div class="content">
                        <h2 class="large-size font-bold main-header"><?php echo esc_html($our_expertise_section_main_heading); ?></h2>
                        <p class="small-size description"><?php echo esc_html($our_expertise_description_para_1); ?></p><br>
                        <p class="small-size description"><?php echo esc_html($our_expertise_description_para_2); ?></p>
                    </div>
                </div>
                <div aria-hidden="true" class="spacer-below-expertise"></div>
                <!-- counters section  -->
                <div class="about-us-counters-container">
                    <div class="content">
                        <div class="number-container">
                            <?php if (have_rows('acf_homepage_counters_single_slide')) : ?>
                                <?php while (have_rows('acf_homepage_counters_single_slide')): the_row();
                                    $counter = get_sub_field('acf_counter') ?: '';
                                    $counter_text = get_sub_field('acf_counter_text') ?: '';  ?>
                                    <div class="items">
                                        <p class="counter"><?php echo esc_html($counter) ?></p>
                                        <p class="counter-text"><?php echo $counter_text ?></p>
                                    </div>
                                <?php endwhile; ?>
                            <?php else : ?>
                                <p>No counters found.</p>
                            <?php endif; ?>

                        </div>
                    </div>
                </div>
                <div aria-hidden="true" class="spacer-below-counter"></div>

                <!-- 				life at adrosonic -->

                <div class="who-we-are fade-in-on-scroll">
                    <div class="section-header-container header">
                        <h2 class="large-size font-bold"><?php echo esc_html($life_at_adrosonic_section_heading); ?></h2>
                        <p class="small-size"><?php echo esc_html($life_at_adrosonic_sub_heading); ?></p>
                    </div>

                    <div class="container desktop-grid">
                        <?php
                        if (have_rows('acf_careers_life_at_adrosonic_items')) :
                            $items = [];

                            // Gather repeater items correctly
                            while (have_rows('acf_careers_life_at_adrosonic_items')) : the_row();
                                $items[] = [
                                    'acf_careers_life_at_adrosonic_quote' => get_sub_field('acf_careers_life_at_adrosonic_quote'),
                                    'acf_careers_life_at_adrosonic_author' => get_sub_field('acf_careers_life_at_adrosonic_author'),
                                    'acf_careers_life_at_adrosonic_card_image' => get_sub_field('acf_careers_life_at_adrosonic_card_image'),
                                ];
                            endwhile;

                            $chunks = array_chunk($items, 2); // Split into chunks of 2 per column

                            foreach ($chunks as $column_items) :
                        ?>
                                <div class="column">
                                    <?php foreach ($column_items as $item) :
                                        $quote = $item['acf_careers_life_at_adrosonic_quote'] ?? '';
                                        $author = $item['acf_careers_life_at_adrosonic_author'] ?? '';
                                        $card_image = isset($item['acf_careers_life_at_adrosonic_card_image'])
                                            ? $item['acf_careers_life_at_adrosonic_card_image']
                                            : '/wp-content/uploads/2025/06/life-at-adrosonic-fallback.jpg';
                                    ?>
                                        <div class="item fade-in-on-scroll bottom-left" data-url="">
                                            <img class="manual-lazy-load"
                                                data-src="<?php echo esc_url($card_image); ?>"
                                                alt="<?php echo esc_attr($author); ?>"
                                                src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1 1'%3E%3C/svg%3E" />
                                            <div class="item-content">
                                                <p class="smaller-size who-we-are-desc italic-text font-bold">
                                                    <span>“ </span><?php echo esc_html($quote); ?><span>”</span>
                                                </p>
                                                <p class="authore-text smallest-size font-bold"><?php echo esc_html($author); ?></p>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                        <?php
                            endforeach;
                        endif;
                        ?>
                    </div>

                    <div class="container owl-carousel owl-carousel-mobile" style="display: none;"></div>
                </div>

                <div class="who-we-are-btn-block wp-block-buttons is-content-justification-center is-layout-flex wp-container-core-buttons-is-layout-1 wp-block-buttons-is-layout-flex">
                    <div class="wp-block-button who-we-are-btn">
                        <a class="wp-block-button__link wp-element-button" href="<?php echo esc_html($life_at_adrosonic_button_url); ?>"><?php echo esc_html($life_at_adrosonic_button_text); ?></a>
                    </div>
                </div>

                <div aria-hidden="true" class="spacer-below-life-at-adrosonic"></div>

                <!-- 	Diversity section			 -->

                <div class="careers-diversity-banner">
                    <div class="careers-diversity-hero-banner">
                        <div class="left-text-box">
                            <h2 class="large-size careers-diversity-text-above-title"><?php echo esc_html($diversity_section_heading); ?>
                            </h2>
                            <p class="small-size careers-diversity-title">
                                <?php echo esc_html($diversity_section_description); ?>
                            </p>

                            <a href="<?php echo esc_url($diversity_section_button_url); ?>">
                                <button class="custom-button careers-diversity-download-button">
                                    <?php echo esc_html($diversity_section_button_text); ?>
                                </button>
                            </a>

                        </div>
                        <div class="right-container">
                            <div class="careers-diversity-border">

                            </div>
                            <div class="right-img manual-lazy-load" data-src="<?php echo esc_html($diversity_section_image); ?>"
                                src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 3 1'%3E%3C/svg%3E">
                            </div>

                        </div>
                        <h2 class="large-size diversity-title-tablet-mobile"><?php echo esc_html($diversity_section_heading); ?>
                        </h2>
                    </div>
                </div>

                <!-- Space below -->
                <div aria-hidden="true" class="wp-block-spacer spacer-below-diversity"></div>


                <!-- stay connected section -->
                <div class="careers-page-carousel-wrapper">
                    <div class="section-central-heading">
                        <h2 class="large-size font-bold"><?php echo esc_html($stay_connected_section_heading); ?></h2>
                    </div>

                    <div class="owl-carousel careers-page-carousel">
                        <?php if (have_rows('acf_careers_page_stay_connected_section_cards')) : ?>
                            <?php while (have_rows('acf_careers_page_stay_connected_section_cards')) : the_row();
                                $card_label = get_sub_field('acf_careers_page_stay_connected_section_card_label') ?: '';
                                $card_image = get_sub_field('acf_careers_page_stay_connected_section_card_image') ?: '/wp-content/uploads/2025/06/Careers-page-Stay-connected-Join-our-Team-image.webp';
                                $text_below_card = get_sub_field('acf_careers_page_stay_connected_section_text_below_card') ?: '';
                                $cta_text = get_sub_field('acf_careers_page_stay_connected_section_cta_text') ?: '';
                                $cta_url = get_sub_field('acf_careers_page_stay_connected_section_cta_url') ?: '#';

                            ?>
                                <div class="item careers-page-item">
                                    <a href="<?php echo esc_url($cta_url); ?>" class="carousel-link">

                                        <img decoding="async"
                                            data-src="<?php echo esc_url($card_image); ?>"
                                            alt="<?php echo esc_attr($card_label); ?>"
                                            src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 3 1'%3E%3C/svg%3E"
                                            class="carousel-image manual-lazy-load" />

                                        <div class="card-label small-size"><?php echo esc_html($card_label); ?></div>

                                        <div class="description-text smaller-size"><?php echo esc_html($text_below_card); ?></div>

                                        <p class="cta-with-icon smaller-size">
                                            <?php echo esc_html($cta_text); ?>
                                            <!-- SVG remains unchanged -->
                                            <svg class="title-icon" xmlns="http://www.w3.org/2000/svg" width="56" height="28" viewBox="0 0 56 28" fill="none" aria-hidden="true">
                                                <path d="M42 14L2 14" stroke="currentColor" stroke-width="2" stroke-linecap="round"></path>
                                                <path d="M30.2354 14C30.2354 16.3734 30.9391 18.6935 32.2577 20.6668C33.5763 22.6402 35.4504 24.1783 37.6431 25.0866C39.8359 25.9948 42.2487 26.2324 44.5764 25.7694C46.9042 25.3064 49.0424 24.1635 50.7206 22.4853C52.3989 20.807 53.5417 18.6689 54.0048 16.3411C54.4678 14.0133 54.2302 11.6005 53.3219 9.4078C52.4137 7.21508 50.8756 5.34094 48.9022 4.02236C46.9288 2.70379 44.6087 2 42.2353 2C39.0528 2 36.0005 3.26428 33.7501 5.51472C31.4996 7.76515 30.2354 10.8174 30.2354 14Z"
                                                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                        </p>
                                    </a>
                                </div>
                            <?php endwhile; ?>
                        <?php endif; ?>
                    </div>
                </div>

                <div aria-hidden="true" class="spacer-below-stay-connected"></div>

                <!-- social media section -->
                <div class="contact-us-get-social">
                    <div class="contact-left">
                        <h2 class="large-size main-header font-bold"> <?php echo esc_html($careers_social_media_heading); ?> </h2>
                        <p class="small-size description font-bold"> <?php echo esc_html($careers_social_media_sub_heading); ?> </p>
                        <p class="smaller-size sub-line"><?php echo esc_html($careers_statement_below_sub_heading); ?></p>

                        <button class="custom-button contact-btn openSubscribeModal" onclick="console.log('clicked'); openSubscribeModal()">
                            <?php echo esc_html($careers_social_media_button_text); ?>
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
                            <a href="<?php echo esc_html($careers_social_media_linkedin_url); ?>" aria-label="LinkedIn" target="_blank" rel="noopener noreferrer" class="icon-a">
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
                            <a href="<?php echo esc_html($careers_social_media_twitter_url); ?>" aria-label="Twitter / X" target="_blank" rel="noopener noreferrer" class="icon-a">
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
                            <a href="<?php echo esc_html($careers_social_media_youtube_url); ?>" aria-label="Youtube" target="_blank" rel="noopener noreferrer" class="icon-a">
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
                    <div class="contact-right"><img data-src="<?php echo esc_html($careers_social_media_image); ?>" alt="Contact Us Image" src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1 1'%3E%3C/svg%3E"></div>
                </div>
            </div>
        </article>
    </main>
    <?php the_content(); ?>
</div>

<?php get_footer(); ?>
<script>
    let scrollPosition = 0; // Declare globally to use in open/close

    document.addEventListener("DOMContentLoaded", function() {
        const modal = document.getElementById("subscribeModal");
        const iframe = document.getElementById("subscribeModalIframe");
        const closeBtn = document.getElementById("closeSubscribeModal");
        const contactBtn = document.querySelector(".contact-btn"); // Target button for focus

        if (!modal || !iframe) {
            console.error("Modal or iframe not found.");
            return;
        }

        // Function to open the subscribe modal
        window.openSubscribeModal = function() {
            console.log("Opening modal...");
            const iframe = document.getElementById("subscribeModalIframe");
            const loader = document.getElementById("iframeLoader");

            // Show loader
            loader.style.display = "block";
            loader.style.position = "absolute";
            iframe.style.opacity = "0";

            // Reset iframe to fresh state
            iframe.setAttribute("src", iframe.getAttribute("data-src"));
            //       iframe.src = iframe.src;

            iframe.onload = () => {
                // Hide loader and show iframe
                loader.style.display = "none";
                iframe.style.opacity = "1";

            };
            // Save scroll position and lock scrolling
            scrollPosition = window.scrollY;
            document.body.style.position = "fixed";
            document.body.style.top = `-${scrollPosition}px`;
            document.body.style.width = "100%";

            // Show and center modal
            modal.style.display = "flex";
            modal.style.position = "fixed";
            modal.style.left = "50%";
            modal.style.transform = "translateX(-50%)";
        };

        // Function to close the modal
        function closeSubscribeModal() {
            modal.style.display = "none";

            // Restore scroll position and unlock scroll
            document.body.style.position = "";
            document.body.style.top = "";
            window.scrollTo(0, scrollPosition);

            // Ensure scroll is restored and THEN focus the button
            setTimeout(() => {
                window.scrollTo({
                    top: scrollPosition,
                    behavior: "instant" // or "auto"
                });

                // Focus back on .contact-btn (if exists)
                if (contactBtn) {
                    contactBtn.focus({
                        preventScroll: true
                    });
                }
            }, 0); // Short delay ensures scroll restoration finishes
        }

        // Close button
        if (closeBtn) {
            closeBtn.addEventListener("click", closeSubscribeModal);
        }

        // Close on outside click
        modal.addEventListener("click", function(e) {
            if (e.target === modal) {
                closeSubscribeModal();
            }
        });
    });
</script>