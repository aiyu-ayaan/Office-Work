<?php
/*
    Template Name: Home 
*/

/**
 * Custom homepage template for Astra child theme.
 *
 * This template is specifically for the homepage of the site.
 *
 * @package Astra Child
 * @since 1.0.0
 */

if (! defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

get_header(); ?>

<?php

$our_innovations_section_main_heading = get_field('acf_home_page_adro_innovations_section_heading');
$our_innovations_sub_heading = get_field('acf_home_page_adro_innovations_sub_heading');
$our_innovations_button_text = get_field('acf_home_adro_innovations_button_text');
$our_innovations_button_url = get_field('acf_home_adro_innovations_button_url');

$text_below_banner = get_field('acf_text_below_banner');
$button_below_banner = get_field('acf_button_below_banner');
$_below_banner_button_url = get_field('acf_below_banner_button_url');

$service_section_heading = get_field('acf_section_heading');
$sub_service_heading = get_field('acf_sub_service_heading');
$repeater_data = get_field('acf_homepage_single_service_fields');
$ia_sub_service_list = [];
if (have_rows('acf_ia_sub_service_list')) {

    while (have_rows('acf_ia_sub_service_list')) {
        the_row();
        $sub_service_name = get_sub_field('acf_ia_sub-service_list_items');

        if ($sub_service_name) {
            $ia_sub_service_list[] = $sub_service_name;
        }
    }
}
$qe_sub_service_list  = [];
if (have_rows('acf_qe_sub_service_list')) {

    while (have_rows('acf_qe_sub_service_list')) {
        the_row();
        $sub_service_name = get_sub_field('acf_qe_sub-service_list_items');
        if ($sub_service_name) {
            $qe_sub_service_list[] = $sub_service_name;
        }
    }
}
$dea_sub_service_list = [];
if (have_rows('acf_dea_sub_service_list')) {

    while (have_rows('acf_dea_sub_service_list')) {
        the_row();
        $sub_service_name = get_sub_field('acf_dea_sub-service_list_items');

        if ($sub_service_name) {
            $dea_sub_service_list[] = $sub_service_name;
        }
    }
}
$de_sub_service_list = [];
if (have_rows('acf_de_sub_service_list')) {

    while (have_rows('acf_de_sub_service_list')) {
        the_row();
        $sub_service_name = get_sub_field('acf_de_sub-service_list_items');

        if ($sub_service_name) {
            $de_sub_service_list[] = $sub_service_name;
        }
    }
}

$featured_insights_section_heading = get_field('acf_featured_insights_section_heading');
$text_below_featured_insights_heading = get_field('acf_text_below_featured_insights_heading');
$filter_slider_shortcode = get_field('acf_filter_slider_shortcode');
$featured_insights_button_text = get_field('acf_featured_insights_button_text');
$featured_insights_button_url = get_field('acf_featured_insights_button_url');

$our_clients_section_heading = get_field('acf_our_clients_section_heading');

$our_industry_cards_shortcode = get_field('acf_our_industry_cards_shortcode');

$who_we_are_main_header = get_field('acf_who_we_are_main_header');
$text_below_who_we_are_header = get_field('acf_text_below_who_we_are_header');
$left_landscape_image_group = get_field('acf_left_landscape_image_group');
if (!empty($left_landscape_image_group)) {
    $left_landscape_image = $left_landscape_image_group['acf_left_landscape_image'] ?? '';
    $left_landscape_image_overlay_text = $left_landscape_image_group['acf_left_landscape_image_overlay_text'] ?? '';
    $left_landscape_image_button_text = $left_landscape_image_group['acf_left_landscape_image_button_text'] ?? '';
    $left_landscape_image_button_url = $left_landscape_image_group['acf_left_landscape_image_button_url'] ?? '';
}
$left_video_group = get_field('acf_left_video_group');
if (!empty($left_video_group)) {
    $left_video_url = $left_video_group['acf_left_video_url'] ?? '';
    $left_video_thumbnail = $left_video_group['acf_left_video_thumbnail'] ?? '';
    $left_video_cta_text = $left_video_group['acf_left_video_cta_text'] ?? '';
    $left_video_cta_url = $left_video_group['acf_left_video_cta_url'] ?? '';
}
$right_grid_top_left_group = get_field('acf_right_grid_top_left_group');
if (!empty($right_grid_top_left_group)) {
    $right_grid_top_left_image = $right_grid_top_left_group['acf_right_grid_top_left_image'];
    $right_grid_top_left_image_overlay_text = $right_grid_top_left_group['acf_right_grid_top_left_image_overlay_text'];
    $right_grid_top_left_image_cta_text = $right_grid_top_left_group['acf_right_grid_top_left_cta_text'];
    $right_grid_top_left_image_button_url = $right_grid_top_left_group['acf_right_grid_top_left_image_button_url'];
}
$right_grid_top_right_group = get_field('acf_right_grid_top_right_group');
if (!empty($right_grid_top_right_group)) {
    $right_grid_top_right_image = $right_grid_top_right_group['acf_right_grid_top_right_image'] ?? '';
    $right_grid_top_right_image_overlay_text = $right_grid_top_right_group['acf_right_grid_top_right_image_overlay_text'] ?? '';
    $right_grid_top_right_cta_text = $right_grid_top_right_group['acf_right_grid_top_right_cta_text'];
    $right_grid_top_right_image_button_url = $right_grid_top_right_group['acf_right_grid_top_right_image_button_url'] ?? '';
}
$right_grid_bottom_left_group = get_field('acf_right_grid_bottom_left_group');
if (!empty($right_grid_bottom_left_group)) {
    $right_grid_bottom_left_image = $right_grid_bottom_left_group['acf_right_grid_bottom_left_image'] ?? '';
    $right_grid_bottom_left_image_overlay_text = $right_grid_bottom_left_group['acf_right_grid_bottom_left_image_overlay_text'] ?? '';
    $right_grid_bottom_left_cta_text = $right_grid_bottom_left_group['acf_right_grid_bottom_left_cta_text'];
    $right_grid_bottom_left_image_button_url = $right_grid_bottom_left_group['acf_right_grid_bottom_left_image_button_url'] ?? '';
}
$right_grid_bottom_right_group = get_field('acf_right_grid_bottom_right_group');
if (!empty($right_grid_bottom_right_group)) {
    $right_grid_bottom_right_image = $right_grid_bottom_right_group['acf_right_grid_bottom_right_image'] ?? '';
    $right_grid_bottom_right_image_overlay_text = $right_grid_bottom_right_group['acf_right_grid_bottom_right_image_overlay_text'] ?? '';
    $right_grid_bottom_right_cta_text = $right_grid_bottom_right_group['acf_right_grid_bottom_right_cta_text'];
    $right_grid_bottom_right_image_button_url = $right_grid_bottom_right_group['acf_right_grid_bottom_right_image_button_url'] ?? '';
}
$discover_button_text = get_field('acf_who_we_are_bottom_button_text');
$discover_button_url = get_field('acf_who_we_are_bottom_button_url');

$adro_innovation_main_header = get_field('acf_adro_innovation_main_header');
$text_below_adro_innovation_header = get_field('acf_text_below_adro_innovation_header');
?>
<?php if (astra_page_layout() == 'left-sidebar') : ?>
    <?php get_sidebar(); ?>
<?php endif ?>
<div id="primary" <?php astra_primary_class(); ?>>
    <main id="main" class="site-main">
        <article id="post-<?php the_ID(); ?>" <?php post_class('ast-article-single'); ?> itemscope
            itemtype="https://schema.org/CreativeWork">
            <div class="entry-content clear" data-ast-blocks-layout="true" itemprop="text">
                <!-- banner section -->
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
                    </p><a href="<?php echo esc_html($_below_banner_button_url) ?>">
                        <button class="custom-button"
                            onclick="window.location.href='<?php echo esc_html($_below_banner_button_url) ?>';">
                            <?php echo esc_html($button_below_banner); ?>
                        </button></a>
                </div>
                <!-- space below banner  -->
                <div aria-hidden="true" class="wp-block-spacer space-homepage-below-banner-text"></div>


                <!-- Modal Popup for Vimeo Video -->
                <div id="vimeo-video-modal" class="vimeo-modal" style="display:none;">
                    <div class="modal-content">
                        <span id="close-modal" class="close-btn">&times;</span>
                        <div id="vimeo-video-container">
                            <!-- Vimeo iframe will be dynamically added here -->
                        </div>
                    </div>
                </div>
                <!-- our services -->
                <style>
                    body {
                        margin: 0;
                    }

                    .our-services-container {

                        .circle-bg,
                        .circle-fg {
                            fill: none;
                        }

                        .circle-bg {
                            stroke: #e6e6e6;
                            stroke-width: 0.5px;
                        }

                        .circle-fg.active {
                            opacity: 1;
                            stroke-dashoffset: 274 !important;
                        }

                        .circle-fg {
                            stroke-dasharray: 364;
                            opacity: 0;
                            stroke-dashoffset: 364;
                            transition: stroke-dashoffset 5s linear;
                            stroke-width: 2px;
                            stroke-linecap: round;
                            transform-origin: center;
                        }

                        .inner-circle-bg {
                            fill: white;
                        }

                        .inner-circle-bg {
                            pointer-events: all;
                            /* make sure it's hoverable */
                        }

                        .circle-content {
                            width: 69%;
                            position: absolute;
                            top: 50%;
                            left: 48%;
                            transform: translate(-50%, -50%);
                            text-align: center;
                            pointer-events: all;
                        }

                        .circle-content h2 {
                            margin: 0;
                            color: var(--adro-deep-blue);
                        }

                        .circle-content p {
                            margin: 4.8% 0% 11% 0;
                            color: var(--adro-deep-blue);
                            line-height: 1.2;
                        }

                    }
                </style>


                <div class="our-services-container">
                    <div class="section-central-heading large-size">
                        <?php echo esc_html($service_section_heading) ?>
                    </div>
                    <div class="owl-carousel btn-group">
                        <?php if (have_rows('acf_homepage_single_service_fields')) :
                            $index = -1; ?>
                            <?php while (have_rows('acf_homepage_single_service_fields')): the_row();
                                $index++;
                                $service_name = get_sub_field('acf_service_name') ?: ''; ?>
                                <h2 class="item progress-button small-size" onclick="autoPlay(<?php echo $index ?>)">
                                    <?php echo $service_name ?>
                                </h2>
                            <?php endwhile; ?>
                        <?php else : ?>
                            <p>No services found.</p>
                        <?php endif; ?>
                    </div>
                    <div class="all-circles-wrapper">
                        <div class="half-circle manual-lazy-load"></div>
                        <div class="progress-wrapper">
                            <svg class="circle-chart" viewBox="0 0 120 120">
                                <circle class="circle-bg" cx="60" cy="60" r="58" />
                                <circle class="circle-fg red" cx="60" cy="60" r="58" />
                                <circle class="circle-fg green" cx="60" cy="60" r="58" />
                                <circle class="circle-fg blue" cx="60" cy="60" r="58" />
                                <circle class="circle-fg yellow" cx="60" cy="60" r="58" />
                                <circle class="inner-circle-bg" cx="60" cy="60" r="54" />
                            </svg>
                            <div class="circle-content">

                                <h2 id="circle-heading" class="medium-size font-bold"></h2>
                                <p id="circle-description" class="smaller-size"></p>
                                <button id="circle-button" class="smaller-size"></button>
                            </div>
                        </div>
                        <div class="pagination-dots">
                            <div class="dot"></div>
                            <div class="dot"></div>
                            <div class="dot"></div>
                            <div class="dot"></div>
                        </div>
                        <div class="lottie-container">

                            <p class="carousel-heading medium-size">
                                <?php echo esc_html($sub_service_heading); ?>
                            </p>
                            <div class="wrapper">
                                <?php
                                $all_sub_services = [
                                    'ia' => $ia_sub_service_list,
                                    'qe' => $qe_sub_service_list,
                                    'dea' => $dea_sub_service_list,
                                    'de' => $de_sub_service_list,
                                ];

                                $i = 0;
                                foreach ($all_sub_services as $key => $sub_service_list) {
                                    if (!empty($sub_service_list) && is_array($sub_service_list)) {

                                        echo '<div class="carousel" id="sub-service-carousel-' . $i . '" style="' . ($i === 0 ? '' : 'display:none;') . '">';
                                        foreach ($sub_service_list as $item) {
                                            echo '<div class="carousel__item smaller-size">' . esc_html($item) . '</div>';
                                        }
                                        echo '</div>';
                                    }
                                    $i++;
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php $wp_data = [
                    'headings' => [],
                    'descriptions' => [],
                    'buttonTexts' => [],
                    'btn_urls' => [],
                    'img_urls' => [],
                ];

                if (have_rows('acf_homepage_single_service_fields')) {
                    while (have_rows('acf_homepage_single_service_fields')) {
                        the_row();

                        $wp_data['headings'][] = get_sub_field('acf_service_heading_inside_circle');
                        $wp_data['descriptions'][] = get_sub_field('acf_service_description');
                        $wp_data['buttonTexts'][] = get_sub_field('acf_service_button_text');
                        $wp_data['btn_urls'][] = get_sub_field('acf_service_button_url');
                        $wp_data['img_urls'][] = get_sub_field('acf_image_behind_circle');
                    }
                } ?>
                <script>
                    var wpData = <?php echo json_encode($wp_data); ?>;

                    let currentIndex = 0;
                    let dots;
                    let autoplayInterval;
                    const electricBlue = '#00ccff';
                    const magenta = '#b175ff';
                    const seaGreen = '#03b7b7';
                    const lilac = '#78a0f6';

                    const colors = [electricBlue, magenta, seaGreen, lilac];

                    const headings = wpData.headings;
                    const descriptions = wpData.descriptions;
                    const buttonTexts = wpData.buttonTexts;
                    const btn_hoverColors = ["#007A99", "#7F48C5", "#018484", "#5173BD"];
                    const btn_urls = wpData.btn_urls;
                    const img_urls = wpData.img_urls;

                    dots = document.querySelectorAll(".our-services-container .dot");

                    function autoPlay(index) {
                        const carousels = document.querySelectorAll('.carousel');
                        carousels.forEach(c => c.style.display = 'none');

                        const activeCarousel = document.getElementById('sub-service-carousel-' + index);
                        if (activeCarousel) {
                            activeCarousel.style.display = 'flex';
                            startVerticalScroll(activeCarousel);
                        }
                        const all_circle_fg = document.querySelectorAll(".circle-fg");
                        [...all_circle_fg].forEach((element) => {
                            element.classList.remove("active");
                        });
                        const circle_fg = all_circle_fg[index];

                        // start

                        void circle_fg.offsetWidth;

                        //end
                        circle_fg.classList.add("active");
                        circle_fg.style.stroke = colors[index];

                        const all_progress_buttons =
                            document.querySelectorAll(".progress-button");
                        [...all_progress_buttons].forEach((element) => {
                            element.classList.remove("active");
                            element.classList.remove("partial-left");
                            element.classList.remove("partial-right");
                            element.style.color = "white";
                        });
                        const progress_button = all_progress_buttons[index];
                        progress_button.classList.add("active");
                        progress_button.style.color = colors[index];
                        all_progress_buttons[(index + 1) % 4].classList.add("partial-left");
                        all_progress_buttons[(index + 3) % 4].classList.add("partial-right");
                        dots.forEach((dot) => dot.classList.remove("active"));
                        dots[index].classList.add("active");


                        const dotsContainer = document.querySelector('.pagination-dots');
                        if (dotsContainer) {
                            applyCustomDotColors(dotsContainer, '#00ccff');
                        }

                        const divHalfCircle = document.querySelector(".half-circle");
                        // 						divHalfCircle.classList.remove("show"); 
                        divHalfCircle.setAttribute("data-src", img_urls[index]);

                        divHalfCircle.classList.remove("lazy-loaded");
                        window.manualLazyObserve(divHalfCircle);
                        document.getElementById("circle-heading").innerText = headings[index];
                        document.getElementById("circle-description").innerText =
                            descriptions[index];
                        if (window.innerWidth < 1025) {
                            document.getElementById("circle-button").innerText = "Explore More";
                        } else {
                            document.getElementById("circle-button").innerText = buttonTexts[index];
                        }
                        const circleButton = document.getElementById("circle-button");
                        circleButton.style.backgroundColor = colors[index];
                        circleButton.setAttribute("onclick", `window.location.href='${btn_urls[index]}'`);

                        circleButton.addEventListener('mouseenter', () => {
                            circleButton.style.backgroundColor = btn_hoverColors[index];
                            circleButton.style.color = "white";
                        });

                        circleButton.addEventListener('mouseleave', () => {
                            circleButton.style.backgroundColor = colors[index];
                            circleButton.style.color = "var(--adro-deep-blue)";
                        });
                        currentIndex = index;
                    }

                    function startInterval() {
                        clearTimeout(autoplayInterval);
                        autoPlay(currentIndex);

                        autoplayInterval = setTimeout(function next() {
                            currentIndex = (currentIndex + 1) % 4;
                            autoPlay(currentIndex);
                            autoplayInterval = setTimeout(next, 5500); // > 5s stroke duration
                        }, 5500);
                    }

                    function stopInterval() {
                        console.log("Paused autoplay");
                        clearInterval(autoplayInterval);
                    }


                    function resumeInterval() {
                        console.log("Resumed autoplay after delay");
                        clearTimeout(autoplayInterval);

                        autoplayInterval = setTimeout(() => {
                            // Immediately trigger current animation again
                            autoPlay(currentIndex);

                            // Then restart normal loop
                            autoplayInterval = setTimeout(function next() {
                                currentIndex = (currentIndex + 1) % 4;
                                autoPlay(currentIndex);
                                autoplayInterval = setTimeout(next, 5500); // keep >5s
                            }, 5500);
                        }, 100); // wait 2s before resuming
                    }

                    const handleTouchStart = (event) => {
                        stopInterval();
                        startX = event.touches[0].clientX;
                    };
                    const handleTouchMove = (event) => {
                        endX = event.touches[0].clientX;
                    };
                    const handleTouchEnd = () => {
                        resumeInterval();
                        const diffX = startX - endX;
                        if (Math.abs(diffX) > 100) {
                            if (diffX > 0) {
                                changeIndex("left");
                            } else {
                                changeIndex("right");
                            }
                        }
                    };
                    const changeIndex = (direction) => {
                        stopInterval();
                        if (direction === "left") {
                            currentIndex = (currentIndex + 1) % 4;
                        } else if (direction === "right") {
                            currentIndex = (currentIndex + 3) % 4;
                        }

                        autoPlay(currentIndex);
                        resumeInterval();
                    };
                    document.addEventListener("DOMContentLoaded", function(event) {
                        //             autoPlay(currentIndex);
                        startInterval();

                        dots.forEach((dot, index) => {
                            dot.addEventListener("click", function() {
                                stopInterval();
                                autoPlay(index);
                                resumeInterval();
                            });
                        });

                        const dotsContainer = document.querySelector('.pagination-dots');
                        if (dotsContainer) {
                            applyCustomDotColors(dotsContainer, '#00ccff');
                        }

                        const completeContainer = document.querySelector(".progress-wrapper");
                        completeContainer.addEventListener("touchstart", handleTouchStart);
                        completeContainer.addEventListener("touchmove", handleTouchMove);
                        completeContainer.addEventListener("touchend", handleTouchEnd);

                        const pauseElements = [
                            document.querySelector(".inner-circle-bg"),
                            document.querySelector(".circle-content"),
                            document.getElementById("circle-button")
                        ];

                        pauseElements.forEach(el => {
                            if (!el) return;

                            el.addEventListener("mouseover", stopInterval);
                            el.addEventListener("mouseout", (e) => {
                                // resume only when cursor truly leaves the element (not just moving inside)
                                if (!el.contains(e.relatedTarget)) {
                                    resumeInterval();
                                }
                            });
                        });


                    });
                    window.addEventListener('pageshow', function(event) {
                        if (event.persisted) {
                            autoPlay(currentIndex);
                            startInterval();
                        }
                    });

                    function moveElement() {
                        const paginationDots = document.getElementsByClassName('pagination-dots')[0];
                        const newLocation = document.getElementsByClassName('our-services-container')[0];
                        const currentParent = document.getElementsByClassName('all-circles-wrapper')[0];
                        if (window.matchMedia('(min-width: 768px) and (max-width: 1024px) and (orientation: landscape)').matches) {
                            newLocation.appendChild(paginationDots);
                        } else {
                            currentParent.insertBefore(paginationDots, currentParent.lastElementChild);
                        }
                    }
                    window.addEventListener('resize', moveElement);
                    moveElement();
                </script>



                <!-- space below our services -->
                <div aria-hidden="true" class="wp-block-spacer space-homepage-below-our-services"></div>
                <!-- counters  -->
                <div class="counters-container">
                    <div class="background">
                        <div class="gradients gradient1"></div>
                        <div class="gradients gradient2"></div>
                        <div class="gradients gradient3"></div>
                    </div>
                    <div class="content">
                        <div class="number-container">

                            <?php if (have_rows('acf_homepage_counters_single_slide')) : ?>
                                <?php while (have_rows('acf_homepage_counters_single_slide')): the_row();
                                    $counter = get_sub_field('acf_counter') ?: '';
                                    $counter_text = get_sub_field('acf_counter_text') ?: ''; ?>
                                    <div class="items">
                                        <p class="counter home-counter-number-font">
                                            <?php echo esc_html($counter); ?>
                                        </p>
                                        <p class="counter-text">
                                            <?php echo esc_html($counter_text); ?>
                                        </p>
                                    </div>
                                <?php endwhile; ?>
                            <?php else : ?>
                                <p>No counters found.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <!-- space below counters   -->
                <div aria-hidden="true" class="wp-block-spacer space-homepage-below-counters"></div>
                <!-- featured insights -->
                <div class="section-header-container featured-insight-header-area">
                    <h2 class="main-header large-size font-bold">
                        <?php echo ($featured_insights_section_heading) ?>
                    </h2>
                    <h3 class="sub-header small-size">
                        <?php echo ($text_below_featured_insights_heading) ?>
                    </h3>
                </div>
                <?php if (!empty($filter_slider_shortcode)) {
                    echo do_shortcode($filter_slider_shortcode);
                } ?>
                <a class="below-featured-insight-button" href="<?php echo ($featured_insights_button_url) ?>">
                    <button class="custom-button"><?php echo ($featured_insights_button_text) ?></button></a>
                <!-- space below featured insights   -->
                <div aria-hidden="true" class="wp-block-spacer space-homepage-below-featured-insights"></div>

                <!-- innovation  -->
                <div class="innovation-section">
                    <div class="desktop-screen">
                        <div class="our-innovation-header">
                            <h2 class="main-header large-size font-bold"><?php echo $our_innovations_section_main_heading; ?></h2>
                            <h3 class="sub-header inno-sub-header small-size"><?php echo $our_innovations_sub_heading; ?></h3>
                        </div>

                        <div class="card-section">
                            <?php if (have_rows('acf_home_adro_innovations_innovation_cards')) :
                                $index = -1; ?>
                                <?php while (have_rows('acf_home_adro_innovations_innovation_cards')): the_row();
                                    $index++;
                                    $card_image = get_sub_field('acf_home_adro_innovations_card_image') ?: '';
                                    $card_title = get_sub_field('acf_home_adro_innovations_card_title') ?: '';
                                    $card_description_para1 = get_sub_field('acf_home_adro_innovations_card_description_para1') ?: '';
                                    $card_description_para2 = get_sub_field('acf_home_adro_innovations_card_description_para2') ?: ''; ?>

                                    <div class="item card card-wrapper manual-lazy-load" data-index="<?php echo esc_html($index); ?>"
                                        data-bg="<?php echo esc_html($card_image); ?>"
                                        data-title="<?php echo esc_html($card_title); ?>" data-desc="<?php echo esc_html($card_description_para1); ?>&lt;br&gt;&lt;br&gt;  <?php echo esc_html($card_description_para2); ?>">

                                        <div class="card-content">
                                            <h2 class="card-title small-size font-bold"></h2>
                                            <p class="card-description smaller-size"></p>
                                        </div>
                                    </div>
                                <?php
                                    $count++;
                                endwhile;
                            else : ?>
                                <p>No innovations found.</p>
                            <?php endif; ?>
                        </div>

                        <div class="button-box">
                            <a href="<?php echo esc_html($our_innovations_button_url); ?>" class="our-innovation-button">
                                <button class="custom-button"><?php echo esc_html($our_innovations_button_text); ?></button>
                            </a>
                        </div>
                    </div>



                    <!--                  <div class="innovation-section"> -->
                    <div class="small-screen">
                        <div class="our-innovation-header">
                            <h2 class="main-header large-size font-bold"><?php echo $our_innovations_section_main_heading; ?></h2>
                            <h3 class="sub-header inno-sub-header small-size"><?php echo $our_innovations_sub_heading; ?></h3>

                        </div>
                        <div class="card-section">
                            <div class="main-card" id="mainCard">
                                <h2 class="main-card-title small-size font-bold" id="mainTitle"></h2>
                                <div class="main-card-scrollable">
                                    <p class="main-card-content smaller-size" id="mainContent"></p>
                                </div>
                            </div>
                            <div class="small-cards">
                                <?php if (have_rows('acf_home_adro_innovations_innovation_cards')) :
                                    $index = -1; ?>
                                    <?php while (have_rows('acf_home_adro_innovations_innovation_cards')): the_row();
                                        $index++;
                                        $card_image = get_sub_field('acf_home_adro_innovations_card_image') ?: '';
                                        $card_title = get_sub_field('acf_home_adro_innovations_card_title') ?: '';
                                        $card_description_para1 = get_sub_field('acf_home_adro_innovations_card_description_para1') ?: '';
                                        $card_description_para2 = get_sub_field('acf_home_adro_innovations_card_description_para2') ?: ''; ?>



                                        <div class="item card card-wrapper manual-lazy-load" data-index="<?php echo esc_html($index); ?>"
                                            data-bg="<?php echo esc_html($card_image); ?>"
                                            data-title="<?php echo esc_html($card_title); ?>" data-desc="<?php echo esc_html($card_description_para1); ?>&lt;br&gt;&lt;br&gt;  <?php echo esc_html($card_description_para2); ?>">

                                            <div class="card-content">
                                                <h2 class="card-title small-size font-bold"></h2>
                                                <p class="card-description"></p>
                                            </div>
                                        </div>
                                    <?php endwhile; ?>
                                <?php else : ?>
                                    <p>No innovations found.</p>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="button-box">
                            <a href="<?php echo esc_html($our_innovations_button_url); ?>" class="our-innovation-button">
                                <button class="custom-button"><?php echo esc_html($our_innovations_button_text); ?></button>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- space below innovation  -->
                <div aria-hidden="true" class="wp-block-spacer space-homepage-below-adro-innovation"></div>

                <!-- our industries  -->
                <?php if (!empty($our_industry_cards_shortcode)) {
                    echo do_shortcode($our_industry_cards_shortcode); // Execute and render the shortcode
                } ?>
                <!-- space below our industries  -->
                <div aria-hidden="true" class="wp-block-spacer space-homepage-below-our-industries"></div>


                <!-- our clients testimonial  -->
                <div class="testimonial-carousel carousel-container">
                    <div class="testimonial-heading section-header-container">
                        <h2 class="large-size font-bold">
                            <?php echo $our_clients_section_heading ?>
                        </h2>
                    </div>
                    <div class="owl-carousel">

                        <?php if (have_rows('acf_homepage_our_clients_single_slide')) : ?>
                            <?php while (have_rows('acf_homepage_our_clients_single_slide')): the_row();
                                $our_clients_text = get_sub_field('acf_text') ?: '';
                                $our_clients_logo = get_sub_field('acf_clients_logo') ?: '';
                                $our_clients_signature = get_sub_field('acf_testimonial_signature') ?: ''; ?>

                                <div class="item">
                                    <div class="logo">
                                        <img class="manual-lazy-load"
                                            data-src="<?php echo esc_html($our_clients_logo) ?>" alt=""
                                            src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 5 1'%3E%3C/svg%3E">
                                    </div>
                                    <p class="custom-font-size"><span>“</span>
                                        <?php echo esc_html($our_clients_text) ?><span>”</span>
                                    </p>
                                    <p class="custom-font-size-author our-client-auther">
                                        <?php echo esc_html($our_clients_signature) ?>
                                    </p>
                                </div>
                            <?php endwhile; ?>
                        <?php else : ?>
                            <p>No client testimonials found.</p>
                        <?php endif; ?>
                    </div>
                </div>
                <!-- spece below our clients testimonial  -->
                <div aria-hidden="true" class="wp-block-spacer space-homepage-below-our-clients"></div>

                <!-- who we are -->
                <?php if (!empty($who_we_are_main_header)): ?>
                    <div class="who-we-are-section  fade-in-on-scroll">
                        <div class="section-header-container header">
                            <h2 class="large-size font-bold">
                                <?php echo esc_html($who_we_are_main_header) ?>
                            </h2>
                            <p class="small-size">
                                <?php echo esc_html($text_below_who_we_are_header) ?>
                            </p>
                        </div>
                        <div class="container desktop-grid">
                            <div class="column">
                                <div class="item fade-in-on-scroll no-radius-left"
                                    data-url="<?php echo esc_html($left_landscape_image_button_url) ?>">
                                    <img class="manual-lazy-load no-radius-left"
                                        data-src="<?php echo esc_html($left_landscape_image) ?>" alt="Image 1"
                                        src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1 1'%3E%3C/svg%3E">
                                    <div class="item-content">
                                        <p class="small-size">
                                            <?php echo esc_html($left_landscape_image_overlay_text) ?>
                                        </p>
                                        <a href="<?php echo esc_html($discover_button_url); ?>"
                                            class="learn-more-btn smaller-size underline-on-hover"
                                            onclick="setTargetSection(<?php echo esc_html($left_landscape_image_button_url) ?>)"><span>
                                                <?php echo esc_html($left_landscape_image_button_text) ?>
                                            </span></a>
                                    </div>

                                </div>
                                <div class="fade-in-on-scroll item no-grey video-block bottom-left"
                                    data-url="<?php echo esc_html($left_video_url) ?>">

                                    <?php if (!empty($left_video_url)) : ?>
                                        <video class="who-we-are-video manual-lazy-load"
                                            data-src="<?php echo esc_html($left_video_url) ?>"
                                            poster="<?php echo esc_html($left_video_thumbnail) ?>" autoplay loop muted
                                            playsinline></video>
                                    <?php else : ?>

                                        <img class="who-we-are-video manual-lazy-load"
                                            data-src="<?php echo esc_html($left_video_thumbnail) ?>"
                                            src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1 1'%3E%3C/svg%3E" />

                                    <?php endif; ?>

                                    <?php if (!empty($left_video_url)) : ?>
                                        <svg class="play-icon" xmlns="http://www.w3.org/2000/svg" width="120" height="120"
                                            viewBox="0 0 120 120" fill="none">
                                            <path
                                                d="M120 60C120 71.8668 116.481 83.4672 109.888 93.3341C103.295 103.201 93.9247 110.891 82.9612 115.433C71.9977 119.974 59.9338 121.162 48.2949 118.847C36.6561 116.532 25.9651 110.818 17.574 102.427C9.18277 94.0357 3.46825 83.3448 1.15303 71.706C-1.16219 60.0672 0.0258704 48.0032 4.56698 37.0396C9.10809 26.0761 16.7983 16.7053 26.6651 10.1123C36.5319 3.51928 48.1322 0.000187218 59.9991 0C75.912 0.000251046 91.1731 6.32174 102.425 17.5739C113.677 28.826 119.999 44.0871 119.999 60"
                                                fill="#00CCFF"></path>
                                            <path class="pause" d="M44 42L44 78" stroke="#1A2C47" stroke-width="4"
                                                stroke-linecap="round"></path>
                                            <path class="pause" d="M76 42L76 78" stroke="#1A2C47" stroke-width="4"
                                                stroke-linecap="round"></path>
                                        </svg>
                                    <?php endif; ?>
                                    <div class="item-content">

                                        <?php if (!empty($left_video_url)) : ?>
                                            <a class="page-video-popup learn-more-btn smaller-size underline-on-hover" href="javascript:void(0)" onclick="openPageVideoPopup('<?php echo esc_html($left_video_cta_url) ?>','')">
                                                <span>
                                                    Full Video
                                                </span></a>
                                        <?php else : ?>
                                            <p class="small-size">
                                                <?php echo esc_html($left_video_cta_text) ?>
                                            </p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="column">
                                <div class="fade-in-on-scroll item bottom-left "
                                    data-url="<?php echo esc_html($right_grid_top_left_image_button_url) ?>">
                                    <img class="manual-lazy-load"
                                        data-src="<?php echo esc_html($right_grid_top_left_image) ?>" alt="Image 3"
                                        src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1 1'%3E%3C/svg%3E" />
                                    <div class="item-content">
                                        <p class="smaller-size who-we-are-desc">
                                            <?php echo esc_html($right_grid_top_left_image_overlay_text) ?>
                                        </p>
                                        <a href="<?php echo esc_html($discover_button_url); ?>"
                                            class="learn-more-btn smaller-size underline-on-hover"
                                            onclick="setTargetSection(<?php echo esc_html($right_grid_top_left_image_button_url) ?>)"><span><?php echo esc_html($right_grid_top_left_image_cta_text) ?></span></a>
                                    </div>
                                </div>
                                <div class="fade-in-on-scroll item bottom-left " data-url="">
                                    <img class="manual-lazy-load"
                                        data-src="<?php echo esc_html($right_grid_bottom_left_image) ?>" alt="Image 4"
                                        src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1 1'%3E%3C/svg%3E" />
                                    <div class="item-content">
                                        <p class="smaller-size who-we-are-desc">
                                            <?php echo esc_html($right_grid_bottom_left_image_overlay_text) ?>
                                        </p>
                                        <a href="<?php echo esc_html($discover_button_url); ?>"
                                            class="learn-more-btn smaller-size underline-on-hover"
                                            onclick="setTargetSection(<?php echo esc_html($right_grid_bottom_left_image_button_url) ?>)"><span><?php echo esc_html($right_grid_bottom_left_cta_text) ?></span></a>
                                    </div>
                                </div>
                            </div>
                            <div class="column">
                                <div class="fade-in-on-scroll no-radius-right item bottom-left " data-url="">
                                    <img class="manual-lazy-load no-radius-right"
                                        data-src="<?php echo esc_html($right_grid_top_right_image) ?>" alt="Image 5"
                                        src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1 1'%3E%3C/svg%3E" />
                                    <div class="item-content">
                                        <p class="smaller-size who-we-are-desc">
                                            <?php echo esc_html($right_grid_top_right_image_overlay_text) ?>
                                        </p>
                                        <a href="<?php echo esc_html($discover_button_url); ?>"
                                            class="learn-more-btn smaller-size underline-on-hover"
                                            onclick="setTargetSection(<?php echo esc_html($right_grid_top_right_image_button_url) ?>)"><span><?php echo esc_html($right_grid_top_right_cta_text) ?></span></a>
                                    </div>

                                </div>
                                <div class="fade-in-on-scroll item no-radius-right bottom-left " data-url="">
                                    <img class="no-radius-right manual-lazy-load"
                                        data-src="<?php echo esc_html($right_grid_bottom_right_image) ?>" alt="Image 6"
                                        src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1 1'%3E%3C/svg%3E" />
                                    <div class="item-content">
                                        <p class="smaller-size who-we-are-desc">
                                            <?php echo esc_html($right_grid_bottom_right_image_overlay_text) ?>
                                        </p>
                                        <a href="<?php echo esc_html($discover_button_url); ?>"
                                            class="learn-more-btn smaller-size underline-on-hover"
                                            onclick="setTargetSection(<?php echo esc_html($right_grid_bottom_right_image_button_url) ?>)"><span><?php echo esc_html($right_grid_bottom_right_cta_text) ?></span></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="container owl-carousel owl-carousel-mobile" style="display: none;"></div>

                    </div>
                <?php endif; ?>

                <div
                    class="who-we-are-btn-block wp-block-buttons is-content-justification-center is-layout-flex wp-container-core-buttons-is-layout-1 wp-block-buttons-is-layout-flex">
                    <div class="wp-block-button who-we-are-btn">
                        <a class="wp-block-button__link wp-element-button"
                            href="<?php echo esc_html($discover_button_url); ?>">
                            <?php echo esc_html($discover_button_text) ?>
                        </a>
                    </div>
                </div>
                <!-- space below who we are  -->
                <div aria-hidden="true" class="wp-block-spacer space-homepage-below-who-we-are"></div>

                <!-- Modal Popup for Vimeo Video -->
                <div id="vimeo-video-modal" class="vimeo-modal" style="display:none;">
                    <div class="modal-content">
                        <span id="close-modal" class="close-btn">&times;</span>
                        <div id="vimeo-video-container">
                            <!-- Vimeo iframe will be dynamically added here -->
                        </div>
                    </div>
                </div>

                <?php the_content(); ?>
            </div>
        </article>
    </main>



</div><!-- #primary -->
<?php
if (astra_page_layout() == 'right-sidebar') :
    get_sidebar();
endif;
get_footer();
