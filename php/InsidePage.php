<?php

/**
 * Astra Child Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Astra Child
 * @since 1.0.0
 */

/**
 * Define Constants
 */
define('CHILD_THEME_ASTRA_CHILD_VERSION', '1.0.0');


// this will buffer output until headers are set.
//ob_start(); CFPK

/**
 * Enqueue styles
 */

function child_enqueue_styles() {
    wp_enqueue_style('astra-child-theme-css', get_stylesheet_directory_uri() . '/style.css', array('astra-theme-css'), CHILD_THEME_ASTRA_CHILD_VERSION, 'all');

    // Your custom CSS files, identified by the glob() function output
    wp_enqueue_style('cookie-css', get_stylesheet_directory_uri() . '/css/cookie.css', array(), filemtime(get_stylesheet_directory() . '/css/cookie.css'), 'all');
    wp_enqueue_style('footer-css', get_stylesheet_directory_uri() . '/css/footer.css', array(), filemtime(get_stylesheet_directory() . '/css/footer.css'), 'all');
    wp_enqueue_style('global-settings-css', get_stylesheet_directory_uri() . '/css/global-settings.css', array(), filemtime(get_stylesheet_directory() . '/css/global-settings.css'), 'all');
    wp_enqueue_style('header-css', get_stylesheet_directory_uri() . '/css/header.css', array(), filemtime(get_stylesheet_directory() . '/css/header.css'), 'all');
}
add_action('wp_enqueue_scripts', 'child_enqueue_styles', 15);


function child_enqueue_scripts() {
    // Your custom JS files, identified by the glob() function output
    wp_enqueue_script('custom-navigation-js', get_stylesheet_directory_uri() . '/js/custom_navigation.js', array('jquery'), filemtime(get_stylesheet_directory() . '/js/custom_navigation.js'), true);
    wp_enqueue_script('header-js', get_stylesheet_directory_uri() . '/js/header.js', array('jquery'), filemtime(get_stylesheet_directory() . '/js/header.js'), true);
    wp_enqueue_script('lazy-load-js', get_stylesheet_directory_uri() . '/js/lazy-load.js', array('jquery'), filemtime(get_stylesheet_directory() . '/js/lazy-load.js'), true);
	// Enqueue combined custom header scripts
wp_enqueue_script('custom-header-combined-js', get_stylesheet_directory_uri() . '/js/custom-header-scripts.js', array('jquery'), CHILD_THEME_ASTRA_CHILD_VERSION, true);
}
add_action('wp_enqueue_scripts', 'child_enqueue_scripts');

/**
 * Enqueue Google Fonts with preconnect.
 * Preconnect is still best placed directly in <head> for earliest effect.
 */
function enqueue_google_fonts() {
    echo '<link rel="preconnect" href="https://fonts.googleapis.com">' . "\n";
    echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>' . "\n";
    wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap', array(), null);
}
add_action('wp_head', 'enqueue_google_fonts', 5);



function custom_logo_link_script()
{
    wp_add_inline_script('jquery', "
        jQuery(document).ready(function($) {
       
			       $('.custom-logo-link').attr('href', '" . esc_url(home_url()) . "');
        });
    ");
}
add_action('wp_enqueue_scripts', 'custom_logo_link_script');

function custom_logo_dynamic_url_script() {
    // Add inline script to modify the logo link based on domain
    wp_add_inline_script('jquery', "
        jQuery(document).ready(function($) {
            // Get the current domain
            var currentDomain = window.location.hostname;
           
            // Set the logo link to match the current domain
            $('.custom-logo-link').attr('href', 'https://' + currentDomain);
            $('.custom-mobile-logo-link').attr('href', 'https://' + currentDomain);
        });
    ");
}
add_action('wp_enqueue_scripts', 'custom_logo_dynamic_url_script');

//GDPR Cookie code


// GDPR Cookie code
function gdpr_cookie_consent_banner() {
    // Only output the banner and script if the cookie is not set or explicitly 'no'
    if (!isset($_COOKIE['gdpr_cooike_accept']) || ($_COOKIE['gdpr_cooike_accept'] === 'no')) {
        ?>
        <div id="cookieConsent" class="show" style="position: fixed; bottom: 0; width: 100%; background: var(--adro-mid-blue); z-index: 1000;">
            <p class="smaller-size statement">We use cookies to deliver the best possible experience on our website. To learn more, visit our <a href="/wp-content/uploads/2024/09/ADROSONIC_GDPR_Policy.pdf" style="color:var(--adro-electric-blue);font-weight:500;" target="_blank;">Privacy Policy</a>. By continuing to use this site, or closing this box, you consent to our use of cookies. We value your privacy.</p>
            <div class="buttons">
                <button id="openCookiePopup" class=" custom-button">Cookie settings</button>
                <button id="acceptCookies" class=" custom-button">Accept</button>
            </div>
            <a id="rejectCookies"><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32" fill="none">
                        <path d="M9 9L23 23" stroke="white" stroke-width="2" stroke-linecap="round" />
                        <path d="M9 23L23 9" stroke="white" stroke-width="2" stroke-linecap="round" />
                        <circle cx="16" cy="16" r="15.5" stroke="white" />
                    </svg></a>
        </div>
        <div class="popup-overlay">
            <div id="cookiePopupBox" style="max-height: 90vh; overflow-y: auto;">
                <div style="position:relative; color:#000;">
                    <h3 class="smaller-size font-bold" style="color:var(--adro-electric-blue); margin-bottom:1.34em">Privacy Overview</h3>
                    <a id="closePopup" onclick="closePopupFunc();"><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32" fill="none">
                                <path d="M9 9L23 23" stroke="white" stroke-width="2" stroke-linecap="round"></path>
                                <path d="M9 23L23 9" stroke="white" stroke-width="2" stroke-linecap="round"></path>
                                <circle cx="16" cy="16" r="15.5" stroke="white"></circle>
                            </svg></a>
                    <p id="privacy-content-text" class="smaller-size">This website uses cookies to improve your experience while you navigate through
                        the website. Out of these cookies, the cookies that are categorized as necessary are stored on your
                        browser as they are essential for the working of basic functionalities...</p>
                    <a id="showmorebtn" class="underline-on-hover learn-more-btn" onclick="toggleShowMoreText();"><span>See more</span></a>
                    <div>
                        <div class="cli-tab-header" id="toggleContentButton" onclick="toggleNeccesaryText();">
                            <a class="font-bold smaller-size" style="color:var(--adro-deep-blue); padding-left: 1em;"><span id="icNeccesaryDrop"><svg xmlns="http://www.w3.org/2000/svg" width="10" height="18" viewBox="0 0 10 18" fill="none">
                                                <path d="M1 1L9 9.00038L1 17" stroke="#1A2C47" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg></span> &nbsp;Necessary</a>
                            <span class="font-bold smaller-size" style="position:absolute; right:0; padding-right: 2em;">Always Enabled</span>
                        </div>
                        <div style="display: block;" id="extraContentNeccesary">
                        </div>
                    </div>
                    <div class="save-accept-container">
                        <button class="save-accept-btn custom-button" onclick="closeAcceptPopupFunc();">SAVE &amp; ACCEPT</button>
                    </div>
                </div>
            </div>
        </div>
        <div id="cookie-banner-again">
            <span>Privacy &amp; Cookies Policy</span>
        </div>
        <?php
        // Enqueue the GDPR specific script only when the banner is shown
        wp_enqueue_script('gdpr-cookie-consent-js', get_stylesheet_directory_uri() . '/js/gdpr-cookie-consent.js', array('jquery'), CHILD_THEME_ASTRA_CHILD_VERSION, true);
        // Localize script to pass admin_url safely to JavaScript
        wp_localize_script('gdpr-cookie-consent-js', 'gdpr_ajax_object', array(
            'ajax_url' => admin_url('admin-ajax.php')
        ));
    }
}
add_action('wp_footer', 'gdpr_cookie_consent_banner');

function create_gdpr_consent_table() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'gdpr_consent';

    $charset_collate = $wpdb->get_charset_collate();
    $sql = "CREATE TABLE IF NOT EXISTS $table_name (
        id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
        user_ip VARCHAR(45) NOT NULL,
        consent_status VARCHAR(10) NOT NULL,
        consent_date DATETIME DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (id)
    ) $charset_collate;";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
}
add_action('after_switch_theme', 'create_gdpr_consent_table');

function save_gdpr_consent_for_forms() {
    if (isset($_POST['gdpr-consent'])) {
        global $wpdb;
        $table_name = $wpdb->prefix . 'gdpr_consent';
        $user_ip = $_SERVER['REMOTE_ADDR'];

        $data = array(
            'user_ip'        => $user_ip,
            'consent_status' => sanitize_text_field($_POST['gdpr-consent']), // Sanitize input
        );

        $format = array(
            '%s',
            '%s',
        );

        $wpdb->insert($table_name, $data, $format);
    }
    wp_die(); // Always die for AJAX requests
}
add_action('wp_ajax_save_gdpr_consent', 'save_gdpr_consent_for_forms');
add_action('wp_ajax_nopriv_save_gdpr_consent', 'save_gdpr_consent_for_forms');
// GDPR cookie code ends here

//GDPR cookie code ends here

//header code starts here

//for language switcher
function custom_click_effect_script()
{
?>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const languageSwitcher = document.querySelector('.pll-switcher-select');
            const languageOptions = document.getElementsByTagName('option');
            languageSwitcher.addEventListener('click', function() {
                this.classList.add('clicked');
                for (let i = 0; i < languageOptions.length; i++) {
                    languageOptions[i].classList.add('language-dropdown');
                }
            });
            // Select all elements with the ID "lang_choice_polylang-4" 
            const all_languages = document.querySelectorAll('#lang_choice_polylang-4');

            // Add event listener to each element
            all_languages.forEach(language => {
                language.addEventListener('change', function(event) {
                    location.href = event.currentTarget.value;
                });
            });
        });
    </script>
<?php
}
add_action('wp_footer', 'custom_click_effect_script');

function custom_search_toggle_display_js()
{
?>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const searchIcon = document.querySelector(".ast-search-icon");
            const contactUsButton = document.querySelector(".ast-builder-layout-element.ast-flex.site-header-focus-item.ast-header-button-1");
            const quadmenuContainer = document.querySelector("#quadmenu .quadmenu-container");
            let isHeaderItemsHidden = false; // Flag to track if header items are hidden
            if (searchIcon) {
                searchIcon.addEventListener("click", function(event) {
                    event.stopPropagation();
                    // Add the class to change the background image
                    searchIcon.classList.add("search-icon-active");
                    if (isHeaderItemsHidden) {

                        // Show the items
                        if (contactUsButton) {
                            contactUsButton.style.display = "block";
                        }
                        if (quadmenuContainer) {
                            quadmenuContainer.style.display = "block";
                        }

                        // Reset the background image class
                        searchIcon.classList.remove("search-icon-active");
                    } else {
                        // Hide the items
                        if (contactUsButton) {
                            contactUsButton.style.display = "none";
                        }
                        if (quadmenuContainer) {
                            quadmenuContainer.style.display = "none";
                        }
                        // Add the class to change the background image
                        searchIcon.classList.add("search-icon-active");

                    }
                    // Toggle the visibility state
                    isHeaderItemsHidden = !isHeaderItemsHidden;
                });
            } else {
                console.error("Search Icon not found!");
            }

            document.addEventListener("click", function(event) {
                if (isHeaderItemsHidden && !searchIcon.contains(event.target) &&!(document.querySelector('.search-form')).contains(event.target)) {
                    // Remove the class to reset the background image
                    searchIcon.classList.remove("search-icon-active");

                    // Reset the display of Contact Us button and Quadmenu container
                    if (contactUsButton) {
                        contactUsButton.style.display = "block";
                    }
                    if (quadmenuContainer) {
                        quadmenuContainer.style.display = "block";
                    }

                    // Reset the visibility state
                    isHeaderItemsHidden = false;
                }
            });
        });
    </script>
<?php
}
add_action('wp_footer', 'custom_search_toggle_display_js');




//header code ends here



// function add_csp_header() {
//     // Ensure header is sent only in frontend, not admin area (optional)
//     if (is_admin()) {
//         return;
//     }
	
// 	 $nonce = get_csp_nonce();

//     // Define Content Security Policy
//     header("Content-Security-Policy: default-src 'none'; script-src 'self' https://cdnjs.cloudflare.com https://www.googletagmanager.com https://www.google-analytics.com https://wordpressa-02147638b0-b9fmbyckh4cgashk.a01.azurefd.net https://player.vimeo.com 'unsafe-inline'; style-src 'self' 'unsafe-inline' https://default-webapp-endpoint-9a734fc0-evgzcugwe7bgawfn.a03.azurefd.net https://fonts.googleapis.com https://cdnjs.cloudflare.com; connect-src 'self' https://api.ipgeolocation.io https://www.google-analytics.com; img-src 'self' https://wordpressa-02147638b0-b9fmbyckh4cgashk.a01.azurefd.net data: https:; frame-src 'self' https://wordpressa-02147638b0-b9fmbyckh4cgashk.a01.azurefd.net https://www.adrosonic.com https://go.demo.pardot.com https://player.vimeo.com; font-src 'self' https://fonts.gstatic.com; media-src 'self' https://wordpressa-02147638b0-b9fmbyckh4cgashk.a01.azurefd.net https://s3-figma-videos-production-sig.figma.com https://vimeo.com https://player.vimeo.com; block-all-mixed-content;");
// }
// add_action('send_headers', 'add_csp_header', 1);

//enqueue owl carousel scripts and styles
// enqueue owl carousel scripts and styles
function enqueue_owlcarousel_assets() {
    $theme_dir = get_stylesheet_directory_uri(); // Use this for child theme paths

    // CSS
    wp_enqueue_style(
        'owl-carousel',
        $theme_dir . '/owl-carousel/owl.carousel.min.css',
        array(),
        '2.3.4'
    );

    wp_enqueue_style(
        'owl-carousel-theme',
        $theme_dir . '/owl-carousel/owl.theme.default.min.css',
        array('owl-carousel'),
        '2.3.4'
    );

    // JS
    wp_enqueue_script(
        'owl-carousel-js',
        $theme_dir . '/owl-carousel/owl.carousel.min.js',
        array('jquery'),
        '2.3.4',
        true
    );
}
add_action('wp_enqueue_scripts', 'enqueue_owlcarousel_assets');


// To change the Tablet Breakpoint:
add_filter('astra_tablet_breakpoint', function () {
    return 1024;
});
// To change the Mobile Breakpoint:
add_filter('astra_mobile_breakpoint', function () {
    return 767.5;
});

/* QUAD MENU SHORT CODE */

function get_spotlight_posts_by_ids($atts)
{
    // Extract the category slug from shortcode attributes
    $atts = shortcode_atts(
        array(

            'spotlight_posts' => '', // Spotlight post IDs

        ),
        $atts,
        'spotlight_posts' // Shortcode name
    );

    // If no spotlight posts are provided, return a message
    if (empty($atts['spotlight_posts'])) {
        return '';
    }

    // Split the provided post IDs into an array
    $spotlight_posts = explode(',', $atts['spotlight_posts']);



    // Query for the spotlight posts based on the provided IDs
    $args = array(
        'post__in' => $spotlight_posts, // Only fetch these post IDs
        'orderby' => 'post__in', // Maintain the order of the provided IDs
        'posts_per_page' => -1, // Get all the spotlight posts
    );

    $query = new WP_Query($args);
    // Check if any spotlight posts are found
    if (!$query->have_posts()) {
        return '';
    }


    // Check if posts are available
    $output = '<div class="quadmenu-item-widget widget widget_post">';
    $output .= '<span class="quadmenu-title">Spotlight</span>';
    $output .= '<ul class="menu sub">';
    if (!$query->have_posts()) {
        $output .= '<li class="spotlight-menu menu-item menu-item-type-post_type menu-item-object-page">No posts found in this category.</li>';
    }

    // Build the output
    while ($query->have_posts()) {
        $query->the_post();
        $output .= '<li class="spotlight-menu menu-item menu-item-type-post_type menu-item-object-page"><a href="' . get_permalink() . '">' . get_the_title() . '</a>  </li>';
    }
    $output .= '</ul>';
    $output .= '</div>';
    // Reset post data
    wp_reset_postdata();

    return $output;
}

// Register the shortcode
add_shortcode('spotlight_posts', 'get_spotlight_posts_by_ids');


function get_tags_list($atts) // for industry drop-down-menu
{
    // Extract the spotlight_posts and order_by attributes from shortcode attributes
    $atts = shortcode_atts(
        array(
            'spotlight_posts' => '', // Spotlight post IDs to display
            'order_by' => '', // Order Industries by tag IDs 
        ),
        $atts,
        'industries'
    );

    // Get all tags
    $tags = get_terms(array(
        'taxonomy' => 'post_tag',
        'hide_empty' => false,
    ));

    // Check if there are any tags
    if (empty($tags) || is_wp_error($tags)) {
        return 'No tags found.';
    }

    // If order_by attribute is provided, sort the tags accordingly
    if (!empty($atts['order_by'])) {
        $order_by_ids = explode(',', $atts['order_by']);
        usort($tags, function ($a, $b) use ($order_by_ids) {
            $pos_a = array_search($a->term_id, $order_by_ids);
            $pos_b = array_search($b->term_id, $order_by_ids);
            return $pos_a - $pos_b;
        });
    }

    $output = '<nav class="menu-tags-drop-down-container">';
    $output .= '<div class="menu-container">';
    $output .= '<div class="main-menu"><ul class="menu">';
    $is_first_item = true;

    foreach ($tags as $tag) {
        $additional_class = !$is_first_item ? 'service-padding-top' : '';

        $custom_url = home_url('/industries/' . sanitize_title($tag->name));

        $output .= '<li class="services-drop-down menu-item menu-item-type-post_type menu-item-object-page ' .  $additional_class . ' '  . $tag->term_id . ' ' . $tag->name . '">';
        $output .= '<a href="' . esc_url($custom_url) . '">' . $tag->name . '</a>';
        $output .= '</li>';
        $is_first_item = false;
    }

    $output .= '</ul></div>';
    $output .= '<div class="sub-menu">';

    // Pass the spotlight_posts to get_spotlight_posts_by_ids() here
    if (!empty($atts['spotlight_posts'])) {
        // Include spotlight posts logic by passing the spotlight_posts attribute
        $cateatts['spotlight_posts'] = $atts['spotlight_posts']; // Pass the spotlight_posts parameter
        $output .= get_spotlight_posts_by_ids($cateatts);
    }

    $output .= '</div>';
    $output .= '</div>';
    $output .= '</nav>';
    $output .= '<style>';
    $output .= '.sub-menu { width: 38.7% !important; float: right; }';
    $output .= '.main-menu { float: left; width: 50%; }';
    $output .= '</style>';
    return $output;
}

// Register the shortcode
add_shortcode('industries', 'get_tags_list');


function get_subcategories_by_parent_slug($atts) //for service drop-down menu
{
    // Extract the parent category slug from shortcode attributes
    $atts = shortcode_atts(
        array(
            'slug' => '', // Default value for 'slug'
            'order_by' => '', // Order Services by Category IDs 
            'spotlight_posts' => '',
        ),
        $atts,
        'subcategories'
    );

    // Check if the parent category slug is provided
    if (empty($atts['slug'])) {
        return 'Please provide a parent category slug.';
    }

    // Get the parent category by slug
    $parent_category = get_category_by_slug($atts['slug']);
    if (!$parent_category) {
        return 'Parent category not found.';
    }

    // Get the subcategories of the parent category
    $args = array(
        'parent' => $parent_category->term_id, // Parent category ID
        'hide_empty' => false, // Include empty subcategories
        'orderby' => 'name',
        'order' => 'ASC',
    );

    $subcategories = get_terms('category', $args);

    // Check if there are any subcategories
    if (empty($subcategories) || is_wp_error($subcategories)) {
        return 'No subcategories found.';
    }
    // If order_by attribute is provided, sort the tags accordingly
    if (!empty($atts['order_by'])) {
        $order_by_ids = explode(',', $atts['order_by']);
        usort($subcategories, function ($a, $b) use ($order_by_ids) {
            $pos_a = array_search($a->term_id, $order_by_ids);
            $pos_b = array_search($b->term_id, $order_by_ids);
            return $pos_a - $pos_b;
        });
    }

    $output = '<nav class="menu-services-drop-down-container">';
    $output .= '<div class="menu-container">';
    $output .= '<div class="main-menu"><ul class="menu">';
    $is_first_item = true;

    foreach ($subcategories as $subcategory) {
        $additional_class = !$is_first_item ? 'service-padding-top' : '';

        // Custom URL logic: Use the subcategory's name as part of the URL
        $custom_url = home_url('/services/' . sanitize_title($subcategory->name));

        $output .= '<li class="services-drop-down menu-item menu-item-type-post_type menu-item-object-page ' . $additional_class . ' ' . $subcategory->term_id . ' ' . $subcategory->name . '">';
        $output .= '<a href="' . esc_url($custom_url) . '">' . $subcategory->name . '</a>';
        $output .= '</li>';

        $is_first_item = false;
    }

    $output .= '</ul></div>';
    $output .= '<div class="sub-menu">';

    foreach ($subcategories as $subcategory) {
        // Custom URL for the parent subcategory
        $custom_url = home_url('/services/' . sanitize_title($subcategory->name));  // This is for the parent
        $output .= '<div class="quadmenu-item-widget widget widget_nav_menu ' . $subcategory->term_id . ' ' . $subcategory->name . '">';

        $childSUbcats = getChildCategory($subcategory->term_id);
        if (!empty($childSUbcats)) {
            $output .= '<span class="quadmenu-title">Sub-Service</span>';
            $output .= '<ul class="menu sub">';

            foreach ($childSUbcats as $childSUbcat) {

                // Custom URL for the child subcategory
                $child_custom_url = home_url('/service/' . sanitize_title($childSUbcat->name));

                // Output the list item with the custom URL for the child subcategory
                $output .= '<li class="menu-item menu-item-type-post_type menu-item-object-page"><a href="' . esc_url($child_custom_url) . '">' . esc_html($childSUbcat->name) . '</a></li>';
            }

            // Add "See All" link
            $output .= '<li class="menu-item menu-item-type-post_type menu-item-object-page see-all"><a href="' . esc_url($custom_url)  . '">See All</a></li>';
            $output .= '</ul>';
        }
        $output .= '</div>';
    }
    // Pass the spotlight_posts to get_recent_posts_by_category() here
    if (!empty($atts['spotlight_posts'])) {
        // Include spotlight posts logic by passing the spotlight_posts attribute
        $cateatts['slug'] = $atts['slug'];
        $cateatts['spotlight_posts'] = $atts['spotlight_posts']; // Pass the spotlight_posts parameter
        $output .= get_spotlight_posts_by_ids($cateatts);
    }

    $output .= '</div>';
    $output .= '</div>';
    $output .= '</nav>';
    $output .= '<style>';
    $output .= '.sub-menu { width: 38.7% !important; float: right; }';
    $output .= '.main-menu { float: left; width: 50%; }';
    $output .= '</style>';

    $output .= '<script>';
    $output .= 'document.addEventListener("DOMContentLoaded", function () {
    const menuItems = document.querySelectorAll(".menu-services-drop-down-container .main-menu li");
    const subMenus = document.querySelectorAll(".menu-services-drop-down-container .sub-menu > div");
    const spotlightMenu = document.querySelector(".menu-services-drop-down-container .sub-menu > .widget_post"); // Spotlight menu

    menuItems.forEach((menuItem, index) => {
        menuItem.addEventListener("mouseover", function () {    
		
			menuItems.forEach((el) => el.classList.remove("active"));
			menuItem.classList.add("active");
			
			// Hide all sub-menu divs, including Spotlight menu
            subMenus.forEach(function (subMenu) {
                subMenu.style.display = "none";
            });

            // Show the corresponding sub-menu div
            const correspondingSubMenu = subMenus[index];
            if (correspondingSubMenu) {
                correspondingSubMenu.style.display = "block";
            }
        });
    });


});';
    $output .= '</script>';
    return $output;
}

// Register the shortcode
add_shortcode('subcategories', 'get_subcategories_by_parent_slug');

function getChildCategory($termid)
{
    $args = array(
        'parent' => $termid, // Parent category ID
        'hide_empty' => false, // Include empty subcategories
        'orderby' => 'term_order',
        'order' => 'ASC',
    );

    return $subcategories = get_terms('category', $args);
}


// enable category taxanomy for pages
function add_category_taxonomy_to_pages()
{
    register_taxonomy_for_object_type('category', 'page');
}

add_action('init', 'add_category_taxonomy_to_pages');

function custom_widget_title_with_image($title, $instance, $id_base)
{
    // Check for a specific widget by ID base if needed
    if ('polylang' === $id_base) {
        // Append your HTML or image to the title
        $title .= ' <img src="/wp-content/uploads/2025/01/Icon-akar-globe.png" alt="Globe Icon" />';
    }
    return $title;
}
add_filter('widget_title', 'custom_widget_title_with_image', 10, 3);


// add custom taxanomy for post type
function create_post_type_taxonomy()
{
    // Arguments for the custom taxonomy
    $args = [
        'hierarchical'      => false, // Set to false for tag-like behavior
        'labels'            => [
            'name'                       => _x('Post Types', 'taxonomy general name'),
            'singular_name'              => _x('Post Type', 'taxonomy singular name'),
            'search_items'               => __('Search Post Types'),
            'popular_items'              => __('Popular Post Types'),
            'all_items'                  => __('All Post Types'),
            'edit_item'                  => __('Edit Post Type'),
            'update_item'                => __('Update Post Type'),
            'add_new_item'               => __('Add New Post Type'),
            'new_item_name'              => __('New Post Type Name'),
            'separate_items_with_commas' => __('Separate post types with commas'),
            'add_or_remove_items'        => __('Add or remove post types'),
            'choose_from_most_used'      => __('Choose from the most used post types'),
            'menu_name'                  => __('Post Types'),
        ],
        'show_ui'           => true,       // Display in admin UI
        'show_admin_column' => true,       // Add to admin post table
        'update_count_callback' => '_update_post_term_count',
        'query_var'         => true,       // Enable querying by this taxonomy
        'rewrite'           => ['slug' => 'post-type'], // URL slug
    ];

    // Register the taxonomy for the default 'post' post type
    register_taxonomy('post_type_category', 'post', $args);
}

add_action('init', 'create_post_type_taxonomy');

// Add custom taxonomy radio buttons to Quick Edit
function add_radio_buttons_to_quick_edit($column_name, $post_type)
{
    if ($column_name === 'post_type_category' && $post_type === 'post') {
        // Fetch all terms of the custom taxonomy
        $terms = get_terms([
            'taxonomy'   => 'post_type_category',
            'hide_empty' => false,
        ]);

    ?>
        <fieldset class="inline-edit-col-right">
            <div class="inline-edit-col">
                <label class="inline-edit-group">
                    <p class="title"><?php esc_html_e('Post Type'); ?></p>
                    <div>
                        <?php foreach ($terms as $term) : ?>
                            <label style="margin-right: 10px;">
                                <input
                                    type="radio"
                                    name="post_type_category"
                                    value="<?php echo esc_attr($term->slug); ?>" />
                                <?php echo esc_html($term->name); ?>
                            </label>
                        <?php endforeach; ?>
                        <label>
                            <input
                                type="radio"
                                name="post_type_category"
                                value="" />
                            <?php esc_html_e('None'); ?>
                        </label>
                    </div>
                </label>
            </div>
        </fieldset>
    <?php
    }
}
add_action('quick_edit_custom_box', 'add_radio_buttons_to_quick_edit', 10, 2);

// Save the selected taxonomy term on Quick Edit
function save_quick_edit_radio_selection($post_id)
{
    // Check permissions
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    // Ensure this is not an auto-save
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    // Save the selected taxonomy term
    if (isset($_POST['post_type_category'])) {
        $term_slug = sanitize_text_field($_POST['post_type_category']);
        if ($term_slug) {
            wp_set_object_terms($post_id, $term_slug, 'post_type_category');
        } else {
            // If "None" is selected, remove taxonomy terms
            wp_set_object_terms($post_id, null, 'post_type_category');
        }
    }
}
add_action('save_post', 'save_quick_edit_radio_selection');

// Add the taxonomy column to the posts table
function add_post_type_column($columns)
{
    $columns['post_type_category'] = __('Post Type');
    return $columns;
}
add_filter('manage_post_posts_columns', 'add_post_type_column');

// Populate the taxonomy column with the selected term
function populate_post_type_column($column_name, $post_id)
{
    if ('post_type_category' === $column_name) {
        $terms = get_the_terms($post_id, 'post_type_category');
        if (!empty($terms)) {
            echo esc_html($terms[0]->name); // Display only the first term (radio button behavior)
        } else {
            _e('None');
        }
    }
}
add_action('manage_post_posts_custom_column', 'populate_post_type_column', 10, 2);





// fetch posts by category
function fetch_posts_by_category()
{
    if (!isset($_POST['slug']) || !isset($_POST['type'])) {
        wp_send_json([]);
        return;
    }

    $slug = sanitize_text_field($_POST['slug']);
    $type = sanitize_text_field($_POST['type']);

    // Determine taxonomy (category or tag)
    $taxonomy = ($type === 'industry') ? 'post_tag' : 'category';

    // Get the term ID of the selected category
    $term = get_term_by('slug', $slug, $taxonomy);
    if (!$term) {
        wp_send_json([]);
        return;
    }

    // Fetch posts under this category and associated post type category
    $args = [
        'post_type'      => 'post', // Change if using custom post types
        'posts_per_page' => -1,
        'tax_query'      => [
            'relation' => 'AND',
            [
                'taxonomy' => $taxonomy,
                'field'    => 'term_id',
                'terms'    => $term->term_id,
            ],
            [
                'taxonomy' => 'post_type_category', // Your post type taxonomy
                'field'    => 'term_id',
                'operator' => 'EXISTS', // Ensure it has a post type category
            ],
        ],
    ];

    $posts = get_posts($args);
    $response = [];

    if ($posts) {
        // Group posts by post type
        $grouped_posts = [];

        foreach ($posts as $index => $post) {
            // Get the post type categories for this post
            $post_type_categories = get_the_terms($post->ID, 'post_type_category');
            if ($post_type_categories) {
                foreach ($post_type_categories as $category) {
                    // Group posts by their post type category
                    $grouped_posts[$category->term_id]['category_name'] = $category->slug;
                    $grouped_posts[$category->term_id]['posts'][] = [
                        'id'      => (int)$post->ID,
                        'title'   => get_the_title($post->ID),

                    ];
                }
            }
        }

        // Prepare the response
        foreach ($grouped_posts as $post_type_id => $group) {
            $response[] = [
                'post_type_category' => $group['category_name'],
                'posts'              => $group['posts'],
            ];
        }
    }

    wp_send_json($response);
}

add_action('wp_ajax_fetch_posts_by_category', 'fetch_posts_by_category');
add_action('wp_ajax_nopriv_fetch_posts_by_category', 'fetch_posts_by_category');

// Add duplicate link to the page actions
function add_duplicate_page_link($actions, $post)
{
    if ($post->post_type == 'page') {
        $url = wp_nonce_url('admin.php?action=duplicate_page&post=' . $post->ID, 'duplicate_page_' . $post->ID);
        $actions['duplicate'] = '<a href="' . $url . '" title="Duplicate this page">Duplicate</a>';
    }
    return $actions;
}
add_filter('page_row_actions', 'add_duplicate_page_link', 10, 2);

// Duplicate page action
function duplicate_page()
{
    if (!isset($_GET['post']) || !current_user_can('edit_pages')) {
        wp_die('You do not have permission to duplicate this page.');
    }

    $post_id = intval($_GET['post']);
    $original_post = get_post($post_id);

    if (!$original_post) {
        wp_die('Page not found.');
    }

    $args = array(
        'post_title'   => $original_post->post_title . ' (Copy)',
        'post_content' => $original_post->post_content,
        'post_status'  => 'draft',
        'post_type'    => $original_post->post_type,
        'post_author'  => $original_post->post_author,
    );

    $new_post_id = wp_insert_post($args);

    if ($new_post_id) {
        wp_redirect(admin_url('post.php?action=edit&post=' . $new_post_id));
        exit;
    } else {
        wp_die('Error duplicating page.');
    }
}
add_action('admin_action_duplicate_page', 'duplicate_page');



// function restrict_pods_meta_boxes_by_template($post_type, $post)
// {
//     if (!$post || $post_type !== 'page') {
//         return;
//     }

//     $template = get_page_template_slug($post->ID);

//     // Define allowed templates and their corresponding Pods meta box field groups
//     $allowed_templates = array(
//         'template_homepage.php' => array(
//             'home-page-banner-section-fields',
//             'home-page-our-services-section-fields',
//             'home-page-counter-section-fields',
//             'home-page-featured-insights-section-fields',
//             'home-page-our-clients-section-fields',
//             'home-page-our-industries-section-fields',
//             'home-page-who-we-are-fields',
//             'home-page-adro-innovation-fields',
// 			'some-fields-of-who-we-are'
//         ),
//         'service_template.php' => array(
//             'service-page-banner-section-fields',
//             'service-page-submenu',
//             'service-page-our-expertise-section-fields',
//             'service-page-keywords-section-fields',
//             'service-page-our-offerings-and-capabilities-section-fields',
//             'service-page-strategic-partner-section-fields',
//             'service-page-adrosonic-benefits-section-fields',
//             'service-page-our-approach-section-fields',
//             'service-page-our-industries-section-fields',
//             'service-page-business-impact-section-fields',
//             'service-page-innovative-solutions-section-fields',
//             'service-page-our-clients-section-fields',
//             'service-page-faq-fields'
//         ),
//         'industry_template.php' => array(
//             'industry-page-banner-section-fields',
//             'industry-page-submenu',
//             'industry-page-our-capabilities-section-fields',
//             'industry-page-business-impact-section-fields',
//             'industry-page-our-offerings-section-fields',
//             'industry-page-innovative-solutions-section-fields',
//             'industry-page-our-clients-section-fields',
//         ),
//         'sub-service_template.php' => array(
//             'sub-service-page-banner-section-fields',
//             'sub-service-page-submenu-fields',
//             'sub-service-page-our-features-section-fields',
//             'sub-service-page-adrosonic-benefits-section-fields',
//             'sub-service-page-our-offerings-section-fields',
//             'sub-service-page-platform-partners-section-fields',
//             'sub-service-page-innovative-solutions-section-fields',
//             'sub-service-page-about-section-fields'
//         ),
//         'leadership_template.php' => array(
//             'leadership-page-banner-section-fields',
//             'leadership-page-what-we-believe-in-section-fields',
//             'leadership-page-making-a-difference-section-fields',
//             'leadership-page-gradients-section-fields'
//         ),

//         'about_us_template.php' => array(
//             'about-us-page-banner-section-fields',
//             'about-us-page-our-commitment-section-fields',
//             'about-us-page-our-people-section-fields',
//             'about-us-page-our-difference-section-fields',
//             'about-us-page-counter-section-fields',
//             'about-us-page-featured-insights-section-fields',
//             'about-us-page-innovation-gradient-fields',
//             'about-us-page-our-approach-section-fields',
//             'about-us-page-get-to-know-us-better-section-fields'

//         ),
//         'contact_us_template.php' => array(
//             'contact-us-page-banner-section-fields',
//             'contact-us-page-social-media-section-fields',
//             'contact-us-page-offices-section-fields',
//             'south-america-office-data'
//         ),
// 		'Insight_template.php' => array(
// 		    'insight-page',
// 		)

//     );

//     // If the current template is in the allowed list, allow only its meta boxes
//     if (array_key_exists($template, $allowed_templates)) {
//         $allowed_meta_boxes = $allowed_templates[$template]; // Get allowed meta boxes for the template

//         add_action('admin_head', function () use ($allowed_meta_boxes, $allowed_templates) {
//             global $wp_meta_boxes;

//             // Get all possible meta boxes from all templates
//             $all_meta_boxes = array_merge(...array_values($allowed_templates));

//             // Find the ones that are NOT allowed for this template and remove them
//             $meta_boxes_to_remove = array_diff($all_meta_boxes, $allowed_meta_boxes);

//             foreach ($meta_boxes_to_remove as $group) {
//                 $meta_box_id = 'pods-meta-' . $group;
//                 remove_meta_box($meta_box_id, 'page', 'normal');
//             }
//         }, 99);
//     }
// }
// add_action('add_meta_boxes', 'restrict_pods_meta_boxes_by_template', 99, 2);


// add functionality to choose template for posts
function astra_enable_post_templates()
{
    add_theme_support('post-templates');
}
add_action('after_setup_theme', 'astra_enable_post_templates');

// Redirect empty page to homepage
function redirect_empty_page_shortcode($atts, $content = null)
{
    if (empty($content)) {
        wp_redirect(home_url());
        exit();
    }
    return $content;
}
add_shortcode('redirect_empty', 'redirect_empty_page_shortcode');


// DESCRIPTION: My Code 
function get_minutes($post_id, $field_names = null, $videoId = null) {
    // Validate required post_id parameter
    if (empty($post_id)) {
        return "N/A";
    }
    
    $results = [];
    
    // Check if field_names is provided and get reading time
    if (!empty($field_names)) {
        $reading_time = get_acf_reading_time($post_id, $field_names);
        if ($reading_time !== '0 minute read') {
            $results[] = $reading_time;
        }
    }
    
    // Check if videoId is provided and get video duration
    if (!empty($videoId)) {
        $video_duration = getVimeoVideoDuration($videoId);
        // Only add if it's not an error message
        if (strpos($video_duration, 'Error:') === false) {
            $results[] = $video_duration;
        }
    }
    
    // Return combined results or N/A if nothing found
    if (empty($results)) {
        return "N/A";
    }
    
    return implode(' + ', $results);
}

function get_acf_reading_time($post_id, $field_names = ['acf_posts_content']) {
    $total_content = '';
    
    // Handle both string and array inputs for field names
    if (is_string($field_names)) {
        $field_names = [$field_names];
    }
    
    // Loop through each field and concatenate content
    foreach ($content as $item) {
        if (is_array($item)) {
            // If nested array, flatten it
            $total_content .= ' ' . implode(' ', array_map(function($subitem) {
                $subitem = is_array($subitem) ? implode(' ', $subitem) : $subitem;
                return html_entity_decode($subitem, ENT_QUOTES | ENT_HTML5, 'UTF-8');
            }, $item));
        } else {
            $total_content .= ' ' . html_entity_decode($item, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        }
    }

    if (empty(trim($total_content))) {
        return '0 minute read';
    }

    // Strip HTML tags and shortcodes to get plain text
    $text_content = wp_strip_all_tags(strip_shortcodes($total_content));

    // Count words
    $word_count = str_word_count($text_content);

    // Calculate read time (assuming 200 words per minute)
    $minutes = ceil($word_count / 200);

    // Return formatted string
    return $minutes . ' minute' . ($minutes > 1 ? 's' : '') . ' read';
}

function getVimeoVideoDuration($videoUrl) {
    // Extract video ID from URL
    $videoId = extractVimeoVideoId($videoUrl);
    
    // Validate video ID
    if (empty($videoId) || !is_numeric($videoId)) {
        return 'N/A';
    }
    
    // Vimeo oEmbed API endpoint
    $url = "https://vimeo.com/api/oembed.json?url=https://vimeo.com/" . $videoId;
    
    // Create context for file_get_contents
    $context = stream_context_create([
        'http' => [
            'method' => 'GET',
            'header' => [
                'User-Agent: Mozilla/5.0',
                'Accept: application/json'
            ],
            'timeout' => 30
        ]
    ]);
    
    // Get response using file_get_contents
    $response = @file_get_contents($url, false, $context);
    
    // Check for HTTP or network errors
    if ($response === false) {
        return 'N/A';
    }
    
    // Decode JSON
    $data = json_decode($response, true);
    
    if (json_last_error() !== JSON_ERROR_NONE || !isset($data['duration']) || !is_numeric($data['duration'])) {
        return 'N/A';
    }
    
    // Format duration
    $seconds = (int)$data['duration'];
    $hours = floor($seconds / 3600);
    $minutes = floor(($seconds % 3600) / 60);
    
    $formatted = '';
    if ($hours > 0) {
        $formatted .= $hours . ' hour' . ($hours > 1 ? 's' : '') . ' watch';
    }
    if ($minutes > 0) {
        $formatted .= $minutes . ' minute' . ($minutes > 1 ? 's' : ' ') . ' watch';
    }
    if ($hours == 0 && $minutes == 0) {
        $formatted = 'Less than 1 minute';
    }
    
    return trim($formatted);
}

function extractVimeoVideoId($url) {
    if (is_numeric($url)) {
        return $url;
    }

    $patterns = [
        '/vimeo\.com\/(\d+)/',
        '/vimeo\.com\/video\/(\d+)/',
        '/player\.vimeo\.com\/video\/(\d+)/',
        '/vimeo\.com\/channels\/[^\/]+\/(\d+)/',
        '/vimeo\.com\/groups\/[^\/]+\/videos\/(\d+)/',
        '/vimeo\.com\/album\/\d+\/video\/(\d+)/',
        '/vimeo\.com\/ondemand\/[^\/]+\/(\d+)/',
    ];

    foreach ($patterns as $pattern) {
        if (preg_match($pattern, $url, $matches)) {
            return $matches[1];
        }
    }

    return null;
}

function get_post_read_minutes($post_id, $post_type_name) {
    if ($post_type_name === 'Webinar' || $post_type_name === 'Video') {
         $videoId = get_field('acf_pardot_vimeo_video_url', $post_id);
         $minutes = get_minutes($post_id, null, $videoId);
     }elseif($post_type_name === 'Use Case' || $post_type_name ==='Case Study'){
        $content_frame_left_container =''
        $content_frame_text_above_button = '';
        $content_frame_button_text = '';
        $content_frame_benefits = '';
        $content_frame_accordion = '';
        $post_content_frame_section = get_field('acf_usecase_content_frame',$post_id)?? '';
        if (!empty($post_content_frame_section)) {
            $content_frame_left_container = $post_content_frame_section['acf_usecase_content_frame_left_container']?? '';
            $content_frame_text_above_button = $post_content_frame_section['acf_usecase_text_above_button']?? '';
            $content_frame_button_text = $post_content_frame_section['acf_content_frame_usecase_button_text']?? '';
            $content_frame_benefits = $post_content_frame_section['acf_usecase_content_frame_benefits']?? '';
            $content_frame_accordion = $post_content_frame_section['acf_usecase_content_frame_accordion']?? '';
        } 
        // Collect all accordion titles and contents into a single string
        $accordion_text = '';
        if (!empty($content_frame_accordion)&& is_array($content_frame_accordion)) {
            foreach ($content_frame_accordion as $row) {
            $accordion_title = isset($row['acf_usecase_accordion_title']) ? strip_tags($row['acf_usecase_accordion_title']) : '';
            $accordion_content = isset($row['acf_usecase_accordion_content']) ? strip_tags($row['acf_usecase_accordion_content']) : '';
            $accordion_text .= $accordion_title . ' ' . $accordion_content . ' ';
            }
        }

        $minutes = get_minutes($post_id, null, null, [$content_frame_left_container, $content_frame_benefits,$accordion_text]);
     }
      else {
         $minutes = get_minutes($post_id, ['acf_post_content_frame_section']);
         if (is_numeric($minutes)) {
             $minutes = $minutes . ' minute' . ($minutes == 1 ? '' : 's');
         } 
     }
 
     return $minutes !== null ? $minutes : "N/A";
}
 

// DESCRIPTION: Fetch posts with pagination and featured posts logic

function fetch_posts() {
	if (!function_exists('get_field')) {
        wp_send_json_error(['message' => 'ACF not initialized']);
        return;
    }
    $currentPage = isset($_GET['page']) ? intval($_GET['page']) : 1;
    $postsPerPage = isset($_GET['postsPerPage']) ? intval($_GET['postsPerPage']) : 6;

    // Get featured post IDs from ACF field on page ID 8223
    $featured_ids_string = get_field('acf_insight', 8223);
    $featured_ids = array_filter(array_map('intval', explode(',', trim($featured_ids_string))), function ($id) {
        return $id > 0;
    });

    // Fetch featured posts (only on page 1)
    $featured_posts = [];
    if (!empty($featured_ids) && $currentPage === 1) {
        $args_featured = [
            'post_type'      => 'post',
            'post__in'       => $featured_ids,
            'post_status'    => 'publish',
            'orderby'        => 'post__in',
            'posts_per_page' => count($featured_ids),
        ];

        $featured_query = new WP_Query($args_featured);
        while ($featured_query->have_posts()) {
            $featured_query->the_post();
            $image = get_the_post_thumbnail_url(get_the_ID(), 'full') ?: '/wp-content/uploads/2025/04/Service-Sub-Service-General-Our-Offerings-and-Capabilities-Texture.webp';
            $post_types = get_the_terms(get_the_ID(), 'post_type_category');
            $post_type_name = !empty($post_types) && !is_wp_error($post_types) ? $post_types[0]->name : 'Uncategorized';
            
            $cal_read_minutes = get_post_read_minutes(get_the_ID(), $post_type_name);
            // check cal_read_minutes is N/A or not
            $read_minutes = $cal_read_minutes !== 'N/A' ? $cal_read_minutes : get_field('acf_read_minutes', get_the_ID());
            $read_minutes_display = !empty($read_minutes) ? esc_html($read_minutes) : 'N/A';
         

            $featured_posts[] = [
                'id'           => get_the_ID(),
                'title'        => get_the_title(),
                'image'        => $image,
                'post_type'    => $post_type_name,
                'permalink'    => get_permalink(),
                'read_minutes' => $read_minutes_display,
            ];
        }
        wp_reset_postdata();
    }

    // Handle featured/regular count logic
    $featuredCount = ($postsPerPage === 3) ? count($featured_posts) : 3;
    $regularCountForPage1 = ($postsPerPage === 3) ? 0 : ($postsPerPage - $featuredCount);

    // Calculate offset and number of posts to fetch for regular posts
    if ($currentPage === 1) {
        $offset = 0;
        $postsToFetch = $regularCountForPage1;
    } else {
        $offset = $regularCountForPage1 + ($currentPage - 2) * $postsPerPage;
        $postsToFetch = $postsPerPage;
    }

    // Fetch regular (non-featured) posts
    $args_regular = [
        'post_type'      => 'post',
        'post_status'    => 'publish',
        'posts_per_page' => $postsToFetch,
        'offset'         => $offset,
        'post__not_in'   => $featured_ids,
        'orderby'        => 'date',
        'order'          => 'DESC',
    ];

    $regular_query = new WP_Query($args_regular);
    $regular_posts = [];

    while ($regular_query->have_posts()) {
        $regular_query->the_post();
        $image = get_the_post_thumbnail_url(get_the_ID(), 'full') ?: '/wp-content/uploads/2025/04/Service-Sub-Service-General-Our-Offerings-and-Capabilities-Texture.webp';
        $post_types = get_the_terms(get_the_ID(), 'post_type_category');
        $post_type_name = !empty($post_types) && !is_wp_error($post_types) ? $post_types[0]->name : 'Uncategorized';

        // Get read_minutes from ACF
        // check if post_type_name is 'Webinar' or 'Video' then get_minutes with videoId
        $cal_read_minutes = get_post_read_minutes(get_the_ID(), $post_type_name);
        // check cal_read_minutes is N/A or not
        $read_minutes = $cal_read_minutes !== 'N/A' ? $cal_read_minutes : get_field('acf_read_minutes', get_the_ID());
        $read_minutes_display = !empty($read_minutes) ? esc_html($read_minutes) : 'N/A';
    

        $regular_posts[] = [
            'id'           => get_the_ID(),
            'title'        => get_the_title(),
            'image'        => $image,
            'post_type'    => $post_type_name,
            'permalink'    => get_permalink(),
            'read_minutes' => $read_minutes_display,
        ];
    }
    wp_reset_postdata();

    // Total posts count (excluding featured ones)
    $total_query = new WP_Query([
        'post_type'      => 'post',
        'post_status'    => 'publish',
        'posts_per_page' => -1,
        'post__not_in'   => $featured_ids,
    ]);
    $totalPosts = $total_query->found_posts;

    // Calculate total pages
    $totalPages = ceil($totalPosts / $postsPerPage);

    // Adjust regular_posts if on Page 1 with custom logic
    if ($currentPage === 1) {
        if ($postsPerPage === 3) {
            $regular_posts = []; // Only featured
        } elseif ($postsPerPage === 4) {
            $regular_posts = array_slice($regular_posts, 0, 1); // 3 featured + 1 regular
        }
    }

    wp_send_json([
        'featured_posts' => $featured_posts,
        'regular_posts'  => $regular_posts,
        'totalPages'     => $totalPages,
    ]);
}
add_action('wp_ajax_fetch_posts', 'fetch_posts');
add_action('wp_ajax_nopriv_fetch_posts', 'fetch_posts');


// 1. Add Meta Box to Post Editor
function add_adrosonic_oldurl_meta_box()
{
    add_meta_box(
        'adrosonic_oldurl_box',                // ID
        'Old URL (Adrosonic)',                 // Title
        'render_adrosonic_oldurl_field',       // Callback
        'post',                                // Post type
        'normal',                              // Context
        'default'                              // Priority
    );
}
add_action('add_meta_boxes', 'add_adrosonic_oldurl_meta_box');

// 2. Render Input Field
function render_adrosonic_oldurl_field($post)
{
    $value = get_post_meta($post->ID, 'adrosonic_oldurl', true);
    wp_nonce_field('adrosonic_oldurl_save_nonce_action', 'adrosonic_oldurl_nonce');
    ?>
    <label for="adrosonic_oldurl"><strong>Old URL:</strong></label><br>
    <input type="url" name="adrosonic_oldurl" id="adrosonic_oldurl" value="<?php echo esc_attr($value); ?>" style="width:100%; padding: 8px;" placeholder="https://example.com/old-url" />
<?php
}

// 3. Save the Field When the Post is Saved
function save_adrosonic_oldurl_meta($post_id)
{
    if (
        !isset($_POST['adrosonic_oldurl_nonce']) ||
        !wp_verify_nonce($_POST['adrosonic_oldurl_nonce'], 'adrosonic_oldurl_save_nonce_action')
    ) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;

    if (isset($_POST['adrosonic_oldurl'])) {
        update_post_meta($post_id, 'adrosonic_oldurl', esc_url_raw($_POST['adrosonic_oldurl']));
    }
}
add_action('save_post', 'save_adrosonic_oldurl_meta');

function adrosonic_redirect_to_old_url()
{
    if (is_singular('post')) {
        global $post;
        $old_url = get_post_meta($post->ID, 'adrosonic_oldurl', true);

        if (!empty($old_url) && filter_var($old_url, FILTER_VALIDATE_URL)) {
            // Optional: prevent redirect in admin or preview
            if (is_admin() || isset($_GET['preview'])) {
                return;
            }

            // Perform the redirect
            wp_redirect($old_url, 301);
            exit;
        }
    }
}
add_action('template_redirect', 'adrosonic_redirect_to_old_url');


function get_user_country()
{
    // Get IP Address
    $ip = $_SERVER['REMOTE_ADDR'];

    // Use ipapi.co to fetch location info
    $response = wp_remote_get("https://ipapi.co/{$ip}/json/");
    if (is_wp_error($response)) return null;

    $body = wp_remote_retrieve_body($response);
    $data = json_decode($body);

    if (!empty($data->country_name)) {
        return $data->country_name; // e.g., "United States"
    }

    return null;
}
//Lazy

function lazy_load_enqueue_script() {
    $js = <<<JS
document.addEventListener("DOMContentLoaded", function () {
    function loadLazy(el) {
        if (el.tagName === 'IMG') {
            el.src = el.dataset.src;
            if (el.dataset.srcset) el.srcset = el.dataset.srcset;
        } else if (el.tagName === 'DIV') {
            el.style.backgroundImage = 'url(' + el.dataset.src + ')';
        } else if (el.tagName === 'VIDEO') {
            if (el.dataset.src) {
                el.src = el.dataset.src;
            }
            const sources = el.querySelectorAll('source[data-src]');
            sources.forEach(source => {
                source.src = source.dataset.src;
            });
            if (el.dataset.poster) {
                el.poster = el.dataset.poster;
            }
            el.load(); 
        } else if (el.tagName.toLowerCase() === 'image') {
            el.setAttribute('href', el.dataset.src);
            el.setAttributeNS('http://www.w3.org/1999/xlink', 'xlink:href', el.dataset.src);
        } else {
            el.src = el.dataset.src;
        }
        el.classList.add('lazy-loaded');
    }
    function observe(el) {
        if (el.classList.contains('lazy-loaded')) return;
        if ('IntersectionObserver' in window) {
            lazyObserver.observe(el);
        } else {
            loadLazy(el);
        }
    }
    window.manualLazyObserve = observe;
    const lazyObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                loadLazy(entry.target);
                lazyObserver.unobserve(entry.target);
            }
        });
    }, {
        rootMargin: '500px',
        threshold: 0.01
    });
    document.querySelectorAll('[data-src]').forEach(observe);
    const mutationObserver = new MutationObserver((mutations) => {
        mutations.forEach(mutation => {
            mutation.addedNodes.forEach(node => {
                if (!(node instanceof HTMLElement)) return;

                if (node.hasAttribute && node.hasAttribute('data-src')) {
                    observe(node);
                }
                node.querySelectorAll?.('[data-src]').forEach(observe);
            });
        });
    });
    mutationObserver.observe(document.body, {
        childList: true,
        subtree: true
    });
});
JS;

    wp_register_script('lazy-load-handler', '');
    wp_enqueue_script('lazy-load-handler');
    wp_add_inline_script('lazy-load-handler', $js);
}
add_action('wp_enqueue_scripts', 'lazy_load_enqueue_script', 20);



//leadership page adding option to customize the ordering
add_filter('manage_leaders_posts_columns', function($columns) {
    // Add columns dynamically based on terms in leader_category
    $terms = get_terms([
        'taxonomy' => 'leader_category',
        'hide_empty' => false,
    ]);

    foreach ($terms as $term) {
        $columns['order_' . $term->slug] = 'Order: ' . $term->name;
    }

    return $columns;
});

 

// Add 'order' field to the term edit screen for 'leader_categories'
function add_order_field_to_leader_categories($term) {
    // Get the current order value for the term
    $order = get_term_meta($term->term_id, '_order', true);
    ?>
    <tr class="form-field term-order-wrap">
        <th scope="row">
            <label for="order"><?php _e('Order', 'textdomain'); ?></label>
        </th>
        <td>
            <input type="number" id="order" name="order" value="<?php echo esc_attr($order); ?>" />
            <p class="description"><?php _e('Order for posts within this category.', 'textdomain'); ?></p>
        </td>
    </tr>
    <?php
}
add_action('leader_categories_edit_form_fields', 'add_order_field_to_leader_categories');
add_action('leader_categories_add_form_fields', 'add_order_field_to_leader_categories');

function custom_subscribe_modal_code() {
    ?>
   <style>
  .custom-modal {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    display: none; /* hidden initially */
    justify-content: center;
    align-items: center;
    z-index: 10000;
    background-color: rgba(0, 0, 0, 0.4);
  }

  .custom-modal-content {
    position: relative;
    background-color: #144074;
    width: 71.1%;
    min-height: 57.7%;
    box-shadow: 0 0 30px rgba(0, 0, 0, 0.5);
    border-radius: 12px;
    overflow: hidden;
    padding: 2.1% 3.36%;
  }

  .custom-modal-content iframe {
    width: 100%;
    height: 400px;
    border: none;
    display: block;
  }

  .close-modal-btn {
    position: absolute;
    top: 40px;
    right: 40px;
    background: transparent;
    border: none;
    cursor: pointer;
    z-index: 10001;
  }

  .close-modal-btn svg {
    width: 32px;
    height: 32px;
  }

  .contact-subscribe-heading {
    color: #0cf !important;
    margin: 0 0 0.84em 0 !important;
	width:90% !important;
  }

  .consent-txt a {
    text-decoration: none !important;
    color: #0cf;
  }
#subscribeModalIframe {

  transition: opacity 0.3s ease-in-out;
}

.loader {
	margin:auto;
  text-align: center;
  font-size: 1rem;
  padding: 20px;
  color: #fff;
}
  /* Tablet landscape */
  @media (min-width: 768px) and (max-width: 1280px) and (orientation: landscape) {
    .custom-modal-content iframe {
      height: 340px !important;
    }
	  .close-modal-btn {
   top:15px !important;
   right: 10px !important;
  }
  }

  /* Tablet portrait */
  @media (min-width: 768px) and (max-width: 1280px) and (orientation: portrait) {
    .custom-modal-content iframe {
      height: 310px !important;
    }
	  .close-modal-btn {
   top:15px !important;
   right: 10px !important;
  }
  }

  /* Mobile */
  @media screen and (max-width: 767.5px) {
    .custom-modal-content {
      width: 90%;
    }
    .close-modal-btn {
   top:15px !important;
   right: 10px !important;
  }
    .custom-modal-content iframe {
      height: 320px;
    }
  }

  /* Lock scroll when modal is open */
  .no-scroll {
    overflow: hidden !important;
  }
</style>

<div id="subscribeModal" class="custom-modal">
  <div class="custom-modal-content">
    <h1 class="contact-subscribe-heading large-size font-bold">Subscribe to our newsletter</h1>
    <button id="closeSubscribeModal" class="close-modal-btn" aria-label="Close modal">
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" fill="none">
        <path d="M9 9L23 23" stroke="white" stroke-width="2" stroke-linecap="round" />
        <path d="M9 23L23 9" stroke="white" stroke-width="2" stroke-linecap="round" />
        <circle cx="16" cy="16" r="15.5" stroke="white" />
      </svg>
    </button>
	  <div id="iframeLoader" class="loader">Loading...</div>
    <iframe id="subscribeModalIframe" src="/subscribeIframe.html"></iframe>
    <p class="consent-txt smaller-size">
      By clicking the “Subscribe Now” button, you are agreeing to the
      <a class="font-bold" href="/wp-content/uploads/2025/04/data-protection-policy-pdf.pdf" target="_blank" rel="noreferrer noopener" >Personal Data Protection Policy</a> and
      <a class="font-bold" href="/wp-content/uploads/2025/04/ADROSONIC-GDPR-Policy.pdf" target="_blank"  rel="noreferrer noopener" >Privacy Policy</a>. Your Privacy is important to us.
    </p>
  </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const modal = document.getElementById("subscribeModal");
        const closeBtn = document.getElementById("closeSubscribeModal");
        const footerBtn = document.querySelector('a.wp-block-button__link.wp-element-button[rel="/contact-us"]');
		const opensubscribebtn = document.querySelector('.open-subscribe-btn');
        let scrollPosition = 0;

        function openSubscribeModal() {

            scrollPosition = window.scrollY;
const iframe = document.getElementById("subscribeModalIframe");
    const loader = document.getElementById("iframeLoader");

    // Show loader
    loader.style.display = "block";
			loader.style.position="absolute";
    iframe.style.opacity = "0";
    iframe.style.pointerEvents = "none";

    // Reset iframe to fresh state
    iframe.src = iframe.src;

    iframe.onload = () => {
        // Hide loader and show iframe
        loader.style.display = "none";
        iframe.style.opacity = "1";
        iframe.style.pointerEvents = "auto";
    };

            // Lock scroll
            document.body.style.position = "fixed";
            document.body.style.top = `-${scrollPosition}px`;
            document.body.style.left = "0";
            document.body.style.right = "0";
            document.body.classList.add("no-scroll");

            // Show modal
            modal.style.display = "flex";
            modal.style.position = "fixed";
            modal.style.left = "50%";
            modal.style.transform = "translateX(-50%)";
        }

        function closeSubscribeModal() {
            // Hide modal
            modal.style.display = "none";

            // Unlock scroll: must be done before scrollTo
            document.body.classList.remove("no-scroll");
            document.body.style.position = "";
            document.body.style.top = "";
            document.body.style.left = "";
            document.body.style.right = "";

            // Restore scroll after layout resets (using timeout)
            setTimeout(() => {
                window.scrollTo({
                    top: scrollPosition,
                    behavior: "instant" // or "auto"
                });

                // Focus on the subscribe button without scrolling
                if (footerBtn || opensubscribebtn) {
                    footerBtn.focus({ preventScroll: true });
					opensubscribebtn.focus({ preventScroll: true });
                }
            }, 0);
        }

        if (closeBtn) {
            closeBtn.addEventListener("click", closeSubscribeModal);
        }

        modal.addEventListener("click", function (e) {
            if (e.target === modal) {
                closeSubscribeModal();
            }
        });

        if (footerBtn || opensubscribebtn) {
            footerBtn.addEventListener("click", function (e) {
                e.preventDefault();
                openSubscribeModal();
            });
			opensubscribebtn.addEventListener("click", function (e) {
                e.preventDefault();
                openSubscribeModal();
            });
        } else {
            console.warn("Subscribe footer button not found.");
        }
    });
</script>


    <?php
}
add_action('wp_footer', 'custom_subscribe_modal_code');





add_action('wp_head', function() {
    echo '<meta name="robots" content="noindex, nofollow">' . "\n";
});
 
add_filter('wpseo_robots', 'force_noindex_nofollow_all_pages');
 
function force_noindex_nofollow_all_pages($robots) {
    return 'noindex, nofollow';
}

// functions.php or a custom plugin
add_action('send_headers', function() {
    header_remove('Server'); // Remove existing Server header
    header('Server: adroserver'); // Set your own custom server name
});

add_action('template_redirect', function () {
    if (strpos($_SERVER['REQUEST_URI'], '/data-management-and-analytics') !== false) {
        wp_redirect(home_url('/services/data-engineering-and-analytics/'), 301);
        exit;
    }
});

add_action('template_redirect', function () {
    if (strpos($_SERVER['REQUEST_URI'], '/careers') !== false) {
        wp_redirect(home_url('/contact-us/'), 301);
        exit;
    }
});


//From UAT instance


function enforce_admin_cache_headers() {
	if (is_admin() || strpos($_SERVER['REQUEST_URI'], 'wp-login.php') !== false) {
    	nocache_headers(); // WordPress native function

    	// Override more strictly
    	header('Cache-Control: no-store, no-cache, must-revalidate, private', true);
    	header('Pragma: no-cache', true);
    	header('Expires: 0', true);
	}
}
add_action('admin_init', 'enforce_admin_cache_headers');
add_action('login_init', 'enforce_admin_cache_headers');


function get_csp_nonce() {
    static $nonce = null;
    if ($nonce === null) {
        $nonce = base64_encode(random_bytes(16));
    }
    return $nonce;
}


add_filter('xmlrpc_enabled', '__return_false');

add_filter( 'rest_pre_dispatch', function( $result, $server, $request ) {
    // Check if user is NOT logged in
    if ( ! is_user_logged_in() ) {
        $method = $request->get_method();
        $allowed_methods = ['GET', 'POST']; // Allowed for logged-out users

        if ( ! in_array( $method, $allowed_methods ) ) {
            // Log the blocked attempt
            $ip      = $_SERVER['REMOTE_ADDR'] ?? 'unknown IP';
            $uri     = $_SERVER['REQUEST_URI'] ?? 'unknown URI';
            $agent   = $_SERVER['HTTP_USER_AGENT'] ?? 'unknown agent';

            error_log("Blocked REST API request from logged-out user: Method=$method, URI=$uri, IP=$ip, Agent=$agent");

            // Block the request for logged-out user
            return new WP_Error( 'rest_forbidden_method', 'HTTP method not allowed for unauthenticated users.', array( 'status' => 403 ) );
        }
    }

    // For logged-in users or allowed methods, continue as normal
    return $result;
}, 10, 3 );



//search code

function disable_special_chars_in_search() {
    ?>
    <script>
    document.addEventListener('DOMContentLoaded', function () {
      // Select all search input fields by type or class
      const searchInputs = document.querySelectorAll('input[type="search"], input.search-field');

      // Define forbidden characters regex: < > ( ) [ ] { } / \
      const forbiddenChars = /[<>()[\]{}\/\\]/g;

      searchInputs.forEach(input => {
        input.addEventListener('input', function () {
          // Remove forbidden characters as user types
          this.value = this.value.replace(forbiddenChars, '');
        });
      });
    });
    </script>
    <?php
}
add_action('wp_footer', 'disable_special_chars_in_search');



function sanitize_search_query_param() {
    if (isset($_GET['s'])) {
        // Sanitize the search query by removing dangerous characters
        $_GET['s'] = preg_replace('/[<>()[\]{}\/\\\\]/', '', $_GET['s']);
        // Update the global $wp_query search value
        add_filter('get_search_query', function($query) {
            return preg_replace('/[<>()[\]{}\/\\\\]/', '', $query);
        });
    }
}
add_action('template_redirect', 'sanitize_search_query_param');

add_action('init', function () {
	$attachments = [
            14216 => '2025/04/Data-engineering-and-analytics.webp',
    	14217 => '2025/04/Digital-Engineering.webp',
    	14219 => '2025/04/Quality-Engineering.webp',
    	14765 => '2025/05/Our-Service-Image-Circle-Intelligent-Automation-1.webp',
	];

	global $wpdb;

	foreach ($attachments as $post_id => $filename) {
    	$cdn_url = "https://websitedev-db0c5dadd1-endpoint.azureedge.net/wp-content/uploads/$filename";
    	$relative_path = "/$filename";

    	// 1. Update guid
    	$wpdb->update(
        	$wpdb->posts,
        	['guid' => $cdn_url],
        	['ID' => $post_id]
    	);

    	// 2. Update _wp_attached_file
    	update_post_meta($post_id, '_wp_attached_file', $relative_path);

    	// 3.Refresh metadata
    	$metadata = wp_get_attachment_metadata($post_id);
    	if ($metadata) {
        	wp_update_attachment_metadata($post_id, $metadata);
    	}
	}

	// Run only once, then remove this hook
	remove_action('init', __FUNCTION__);
});

//ACF custom field for pdf attachment


function add_pardot_download_script() {
	if (!function_exists('get_field')) {
        wp_send_json_error(['message' => 'ACF not initialized']);
        return;
    }
//$pdf = get_field('acf_posts_pdf_download');  // Returns an array if file exists
if (is_single()) {
$pdf = get_field('acf_posts_pdf_download');
if ($pdf && isset($pdf['url'])) {
?>
<script>
    window.addEventListener('message', function (event) {
        try {
            const trustedOriginIs = 'https://go.website-dev.adrosonic.com';

            if (event.origin !== trustedOriginIs) {
                console.warn('Blocked message from untrusted origin:', event.origin);
                return;
            }

            if (event.data === 'pardot') {
                jQuery('.download-pardot-popup-overlay').hide();
                handlePardotFormSuccess();
                console.log("Handled pardot message from trusted origin");
            }

        } catch (e) {
            console.log("Error while handling postMessage securely:", e);
        }
    });


    function handlePardotFormSuccess() {
        triggerPDFDownload();
		function triggerPDFDownload() {
			window.open('<?php echo esc_url($pdf['url']); ?>', '_blank');
        }
      location.reload();
    }
</script>
<?php
        }
    }
}
add_action('wp_footer', 'add_pardot_download_script');

// Passes product interest on the basis of services assgined to the post
add_action('wp_footer', 'inject_pardot_iframe_with_Product_Interest');

function inject_pardot_iframe_with_Product_Interest() {
    if (!is_single()) return;

    global $post;
    if (!$post) return;
    if (strpos($post->post_content, 'open-download-popup') === false) return;
    

    // Fetch parent category ID for "Service"
    $service_parent = get_term_by('name', 'Service', 'category');
    $service_parent_id = $service_parent ? $service_parent->term_id : 0;

    // Get assigned categories
    $post_categories = get_the_category($post->ID);

    function is_descendant_of_service($cat_id, $service_id) {
    $term = get_category($cat_id);
    while ($term && $term->parent != 0) {
        if ($term->parent == $service_id) return true;
        $term = get_category($term->parent);
    }
    return false;
    }

    $relevant_categories = array_filter($post_categories, function($cat) use ($service_parent_id) {
    return ($cat->term_id == $service_parent_id) || is_descendant_of_service($cat->term_id, $service_parent_id);
   });


    // Extract names
    $Product_Interest_values = array_map(function($cat) {
        return $cat->name;
    }, $relevant_categories);

    $Product_Interest_encoded = urlencode(implode(',', $Product_Interest_values));
    	
	$terms = get_the_terms($post->ID, 'post_type_category');
    if (!empty($terms) && !is_wp_error($terms)) {
    $post_label = $terms[0]->name;
    } else {
    // Fallback
    $post_label = 'Resource';
   }
    ?>
<!-- The Popup -->
<div class="download-pardot-popup-overlay">
    <div class="download-pardot-popup-content">
        <span class="close-popup">
            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32" fill="none">
                <path d="M9 9L23 23" stroke="white" stroke-width="2" stroke-linecap="round" />
                <path d="M9 23L23 9" stroke="white" stroke-width="2" stroke-linecap="round" />
                <circle cx="16" cy="16" r="15.5" stroke="white" />
            </svg></span>
        <h2 class="popup-heading font-bold large-size">Download Our <?php echo esc_html($post_label);?></h2>
        <!-- Pardot Form Embed -->
        <div class="pardot-form-container">
            <iframe src="" width="100%" class="download-iframe" type="text/html" frameborder="0"
                allowTransparency="true" style="border: 0"></iframe>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const popupOverlay = document.querySelector('.download-pardot-popup-overlay');
        const closeButton = document.querySelector('.download-pardot-popup-overlay .close-popup');
        const openButtons = document.querySelectorAll('.open-download-popup');
		let pardotPopupScrollY = 0;
		function lockBodyScrollForPardotPopup() {
        pardotPopupScrollY = window.scrollY || window.pageYOffset;
        document.body.style.position = 'fixed';
        document.body.style.top = `-${pardotPopupScrollY}px`;
        document.body.style.left = '0';
        document.body.style.right = '0';
        document.body.style.width = '100%';
       }
		function unlockBodyScrollForPardotPopup() {
        document.body.style.position = '';
        document.body.style.top = '';
        document.body.style.left = '';
        document.body.style.right = '';
        document.body.style.width = '';
        window.scrollTo(0, pardotPopupScrollY);
       }

        // Handle all "Download" buttons
        openButtons.forEach(button => {
            button.addEventListener('click', function () {
                popupOverlay.style.display = 'flex';
				lockBodyScrollForPardotPopup();
            });
        });

        // Close popup on close button click
        closeButton.addEventListener('click', function () {
            popupOverlay.style.display = 'none';
			unlockBodyScrollForPardotPopup();
        });

        // Close popup on background click
        window.addEventListener('click', function (e) {
            if (e.target === popupOverlay) {
                popupOverlay.style.display = 'none';
				unlockBodyScrollForPardotPopup();
            }
        });
        const productInterest = "<?php echo $Product_Interest_encoded; ?>";

        fetch('https://api.ipgeolocation.io/ipgeo?apiKey=31bc120625344a6389c602f3bec22805')
            .then(response => response.json())
            .then(data => {
                const country = encodeURIComponent(data.country_name || '');
                const region = encodeURIComponent(data.state_prov || '');
                const iframe = document.querySelector('.download-iframe');
                const baseUrl = 'https://go.website-dev.adrosonic.com/l/791983/2025-05-28/2w63';

                iframe.src = `${baseUrl}?country=${country}&territory=${region}&Product_Interest=${productInterest}`;
            })
            .catch(error => {
                console.error('IPGeolocation failed:', error);
            });
    });
</script>
<?php
}




// play pardot code
 
function add_pardot_video_play_script() {
	if (!function_exists('get_field')) {
        wp_send_json_error(['message' => 'ACF not initialized']);
        return;
    }
//$video = get_field('acf_pardot_vimeo_video_url');
if (is_single()) {
$video = get_field('acf_pardot_vimeo_video_url');
if ($video) {
?>
<script>
    window.addEventListener('message', function (event) {
        try {
			const trustedOriginVideoSub = 'https://go.website-dev.adrosonic.com';

            if (event.origin !== trustedOriginVideoSub) {
                console.warn('Blocked message from untrusted origin:', event.origin);
                return;
            }
			
            if (event.data === 'pardotvid') {
                //jQuery('.play-popup-overlay').hide();
                handleVideoPardotFormSuccess();
                console.log("here");
				isFormSubmitted = true;
            }
        } catch (e) {
            console.log("Error while handling postMessage");
        }
    });

    function handleVideoPardotFormSuccess() {
        triggerVideoPlay();
        function triggerVideoPlay() {
            

            document.getElementById("formContainer").style.display = "none";
            document.getElementById("videoContainer").style.display = "block";
            document.querySelector(".play-popup-content").style.padding = '0';
            document.querySelector(".form-header").style.display = "none";
            // Autoplay video
            const video = document.getElementById("videoIframe");
            if (!video.dataset.originalSrc) {
             video.dataset.originalSrc = '<?php echo esc_url($video); ?>';
            }
            const baseSrc = video.dataset.originalSrc;
            if (video && !video.src.includes("autoplay=1")) {
                video.src = baseSrc + "?autoplay=1&muted=1&playsinline=1";
            }
            document.querySelector(".play-popup-overlay").classList.add("video-mode");
            const postHead = document.querySelector(".post-head");
            if(postHead) {
                postHead.style.opacity = "1";
                postHead.style.transform = "scale(1)";
            }
        }
    }
</script>
<?php
        }
    }
}
add_action('wp_footer', 'add_pardot_video_play_script');

// Passes product interest on the basis of services assgined to the post
add_action('wp_footer', 'inject_pardot_video_iframe_with_Product_Interest');

function inject_pardot_video_iframe_with_Product_Interest() {
    if (!is_single()) return;

    global $post;
    if (!$post) return;
    if (strpos($post->post_content, 'open-pardot-play-popup') === false) return;
    

    // Fetch parent category ID for "Service"
    $service_parent = get_term_by('name', 'Service', 'category');
    $service_parent_id = $service_parent ? $service_parent->term_id : 0;

    // Get assigned categories
    $post_categories = get_the_category($post->ID);

    function is_descendant_of_service($cat_id, $service_id) {
    $term = get_category($cat_id);
    while ($term && $term->parent != 0) {
        if ($term->parent == $service_id) return true;
        $term = get_category($term->parent);
    }
    return false;
    }

    $relevant_categories = array_filter($post_categories, function($cat) use ($service_parent_id) {
    return ($cat->term_id == $service_parent_id) || is_descendant_of_service($cat->term_id, $service_parent_id);
   });


    // Extract names
    $Product_Interest_values = array_map(function($cat) {
        return $cat->name;
    }, $relevant_categories);

    $Product_Interest_encoded = urlencode(implode(',', $Product_Interest_values));
	
	$terms = get_the_terms($post->ID, 'post_type_category');
    if (!empty($terms) && !is_wp_error($terms)) {
    $post_label = $terms[0]->name;
    } else {
    // Fallback
    $post_label = 'Resource';
	}
    ?>
    <!-- The Popup -->
    <div class="play-popup-overlay" id="popup">
		<div class="head-container">
    <div class="empty-div"></div>
        <p class="post-head medium-size font-bold"><?php echo get_the_title(); ?></p>
        <span class="play-close-btn video-close">
            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32" fill="none">
                <path d="M9 9L23 23" stroke="white" stroke-width="2" stroke-linecap="round" />
                <path d="M9 23L23 9" stroke="white" stroke-width="2" stroke-linecap="round" />
                <circle cx="16" cy="16" r="15.5" stroke="white" />
            </svg>
        </span>
		</div>
        <div class="play-popup-content">
            <span class="play-close-btn pardot-close">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32" fill="none">
                    <path d="M9 9L23 23" stroke="white" stroke-width="2" stroke-linecap="round" />
                    <path d="M9 23L23 9" stroke="white" stroke-width="2" stroke-linecap="round" />
                    <circle cx="16" cy="16" r="15.5" stroke="white" />
                </svg>
            </span>
            <h3 class="large-size font-bold form-header">Watch Now our <?php echo esc_html($post_label);?></h3>
            <div id="formContainer" class="form-wrapper">
                <iframe id="pardotIframe"  width="100%" height="100%" type="text/html" frameborder="0" allowTransparency="true" style="border: 0"></iframe>
            </div>
            <div id="videoContainer" class="video-wrapper" style="display: none;">
                <iframe id="videoIframe" width="100%" height="100%" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe>
            </div>
        </div>
    </div>
<script>
	var isFormSubmitted = window.isFormSubmitted || false;
    document.addEventListener('DOMContentLoaded', function () {
     
        const popup = document.getElementById("popup");
        const openButtons = document.querySelectorAll(".open-pardot-play-popup");
        const closeBtns = document.querySelectorAll(".play-close-btn");
        let scrollPosition = 0;

        function openPopup() {

scrollPosition = window.scrollY;
popup.classList.add("active");
document.body.style.position = "fixed";
document.body.style.top = `-${scrollPosition}px`;
document.body.style.left = "0";
document.body.style.right = "0";
document.body.classList.add("no-scroll");
		popup.classList.remove("video-mode", "form-mode");

    if (!isFormSubmitted) {
        popup.classList.add("form-mode");
    } else {
        popup.classList.add("video-mode");

        const video = document.getElementById("videoIframe");
        if (video && video.dataset.originalSrc) {
            video.src = video.dataset.originalSrc + "?autoplay=1&muted=1&playsinline=1";
        }
    }
}
function closePopup() {
popup.classList.remove("active","video-mode");
document.body.classList.remove("no-scroll");
document.body.style.position = "";
document.body.style.top = "";
document.body.style.left = "";
document.body.style.right = "";
window.scrollTo(0, scrollPosition);
	
	const video = document.getElementById("videoIframe");
    if (video && video.contentWindow) {
        video.contentWindow.postMessage('{"method":"pause"}', '*');
    }

}
		
        // Handle all "Play" buttons
        openButtons.forEach(button => {
            button.addEventListener('click', function () {
                openPopup();
            });
        });

        // Close popup on close button click
        closeBtns.forEach(button => {
  button.addEventListener("click", () => {
    closePopup();

});
});

        // Close popup on background click
        popup.addEventListener("click", (e) => {
  if (e.target === popup) {
    closePopup();
  }
});
		
        const productInterest = "<?php echo $Product_Interest_encoded; ?>";

        fetch('https://api.ipgeolocation.io/ipgeo?apiKey=31bc120625344a6389c602f3bec22805')
            .then(response => response.json())
            .then(data => {
                const country = encodeURIComponent(data.country_name || '');
                const region = encodeURIComponent(data.state_prov || '');
                const iframe = document.getElementById("pardotIframe");
                const baseUrl = 'https://go.website-dev.adrosonic.com/l/791983/2025-05-28/2w66';

                iframe.src = `${baseUrl}?country=${country}&territory=${region}&Product_Interest=${productInterest}`;
            })
            .catch(error => {
                console.error('IPGeolocation failed:', error);
            });
    });
</script>
<?php
}
// vimeo video popup for podcast client story coffee with adrosonic without pardot form
function is_video_popup_no_pardot_post_type() {
    if (!function_exists('get_field')) return false;
    if (!is_singular('post')) return false;

    $post_id = get_the_ID();
    $terms = wp_get_object_terms($post_id, 'post_type_category', ['fields' => 'slugs']);
    $allowed_categories = ['video', 'podcast', 'client-story'];

    return !empty(array_intersect($allowed_categories, $terms));
}
// function enqueue_video_popup_no_pardot_script() {
//     if (!is_video_popup_no_pardot_post_type()) return;

//     wp_enqueue_script(
//         'video-popup-script',
//         get_template_directory_uri() . '/js/video-popup-no-pardot.js',
//         [],
//         null,
//         true
//     );
// }
// add_action('wp_enqueue_scripts', 'enqueue_video_popup_no_pardot_script');
function inject_vimeo_video_popup_no_pardot() {
	 if (!is_video_popup_no_pardot_post_type()) return;
    $post_id = get_the_ID();
    $video_url = get_field('acf_pardot_vimeo_video_url', $post_id); 
    $post_title = get_the_title($post_id);
    if (!$video_url) return; 
    ?>
    <div class="play-popup-overlay-no-pardot" id="video-popup-no-pardot"
         data-video-src="<?php echo esc_url($video_url); ?>"
         data-post-title="<?php echo esc_attr($post_title); ?>">
      <div class="head-container">
        <div class="empty-div"></div>
        <p class="post-head medium-size font-bold"><?php echo esc_html($post_title); ?></p>
        <span class="play-close-btn video-close">
          <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32" fill="none">
            <path d="M9 9L23 23" stroke="white" stroke-width="2" stroke-linecap="round" />
            <path d="M9 23L23 9" stroke="white" stroke-width="2" stroke-linecap="round" />
            <circle cx="16" cy="16" r="15.5" stroke="white" />
          </svg>
        </span>
      </div>
      <div class="play-popup-content">
        <div class="video-wrapper">
          <iframe class="video-iframe-no-pardot" width="100%" height="100%" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe>
        </div>
      </div>
    </div>
    <script>
      document.addEventListener('DOMContentLoaded', function () {
        const popup = document.querySelector("#video-popup-no-pardot");
        const openButtons = document.querySelectorAll(".open-play-popup-no-pardot");
        const video = popup.querySelector(".video-iframe-no-pardot");
        const closeBtn = popup.querySelector(".video-close");
        let scrollPosition = 0;

        const videoSrc = popup.dataset.videoSrc;
        const postTitle = popup.dataset.postTitle;

        function openPopup() {
          scrollPosition = window.scrollY;
          popup.classList.add("active");
          document.body.style.position = "fixed";
          document.body.style.top = `-${scrollPosition}px`;
          document.body.classList.add("no-scroll");

          if (videoSrc) {
            video.src = videoSrc + "?autoplay=1&muted=1&playsinline=1";
          }
        }

        function closePopup() {
          popup.classList.remove("active");
          document.body.classList.remove("no-scroll");
          document.body.style.position = "";
          document.body.style.top = "";
          window.scrollTo(0, scrollPosition);
          if (video) {
            video.contentWindow?.postMessage('{"method":"pause"}', '*');
            video.src = "";
          }
        }

        openButtons.forEach(button => {
          button.addEventListener("click", function (e) {
            e.preventDefault();
            openPopup();
          });
        });

        closeBtn.addEventListener("click", closePopup);
        popup.addEventListener("click", (e) => {
          if (e.target === popup) closePopup();
        });
      });
    </script>

    <?php
}
add_action('wp_footer', 'inject_vimeo_video_popup_no_pardot');



//New relic RUM integration 

add_action( 'astra_head_bottom', function() {
    ?>
<script type="text/javascript">
;window.NREUM||(NREUM={});NREUM.init={distributed_tracing:{enabled:true},privacy:{cookies_enabled:true}};

;NREUM.loader_config={accountID:"6786306",trustKey:"6786306",agentID:"1431840344",licenseKey:"NRJS-ad07deba5b362f586c7",applicationID:"1335777555"};
;NREUM.info={beacon:"bam.nr-data.net",errorBeacon:"bam.nr-data.net",licenseKey:"NRJS-ad07deba5b362f586c7",applicationID:"1335777555",sa:1};
;/*! For license information please see nr-loader-spa-1.291.0.min.js.LICENSE.txt */
(()=>{var e,t,r={8122:(e,t,r)=>{"use strict";r.d(t,{a:()=>i});var n=r(944);function i(e,t){try{if(!e||"object"!=typeof e)return(0,n.R)(3);if(!t||"object"!=typeof t)return(0,n.R)(4);const r=Object.create(Object.getPrototypeOf(t),Object.getOwnPropertyDescriptors(t)),o=0===Object.keys(r).length?e:r;for(let a in o)if(void 0!==e[a])try{if(null===e[a]){r[a]=null;continue}Array.isArray(e[a])&&Array.isArray(t[a])?r[a]=Array.from(new Set([...e[a],...t[a]])):"object"==typeof e[a]&&"object"==typeof t[a]?r[a]=i(e[a],t[a]):r[a]=e[a]}catch(e){r[a]||(0,n.R)(1,e)}return r}catch(e){(0,n.R)(2,e)}}},2555:(e,t,r)=>{"use strict";r.d(t,{D:()=>s,f:()=>a});var n=r(384),i=r(8122);const o={beacon:n.NT.beacon,errorBeacon:n.NT.errorBeacon,licenseKey:void 0,applicationID:void 0,sa:void 0,queueTime:void 0,applicationTime:void 0,ttGuid:void 0,user:void 0,account:void 0,product:void 0,extra:void 0,jsAttributes:{},userAttributes:void 0,atts:void 0,transactionName:void 0,tNamePlain:void 0};function a(e){try{return!!e.licenseKey&&!!e.errorBeacon&&!!e.applicationID}catch(e){return!1}}const s=e=>(0,i.a)(e,o)},9324:(e,t,r)=>{"use strict";r.d(t,{F3:()=>i,Xs:()=>o,Yq:()=>a,xv:()=>n});const n="1.291.0",i="PROD",o="CDN",a="^2.0.0-alpha.18"},6154:(e,t,r)=>{"use strict";r.d(t,{A4:()=>s,OF:()=>d,RI:()=>i,WN:()=>h,bv:()=>o,gm:()=>a,lR:()=>f,m:()=>u,mw:()=>c,sb:()=>l});var n=r(1863);const i="undefined"!=typeof window&&!!window.document,o="undefined"!=typeof WorkerGlobalScope&&("undefined"!=typeof self&&self instanceof WorkerGlobalScope&&self.navigator instanceof WorkerNavigator||"undefined"!=typeof globalThis&&globalThis instanceof WorkerGlobalScope&&globalThis.navigator instanceof WorkerNavigator),a=i?window:"undefined"!=typeof WorkerGlobalScope&&("undefined"!=typeof self&&self instanceof WorkerGlobalScope&&self||"undefined"!=typeof globalThis&&globalThis instanceof WorkerGlobalScope&&globalThis),s="complete"===a?.document?.readyState,c=Boolean("hidden"===a?.document?.visibilityState),u=""+a?.location,d=/iPad|iPhone|iPod/.test(a.navigator?.userAgent),l=d&&"undefined"==typeof SharedWorker,f=(()=>{const e=a.navigator?.userAgent?.match(/Firefox[/\s](\d+\.\d+)/);return Array.isArray(e)&&e.length>=2?+e[1]:0})(),h=Date.now()-(0,n.t)()},7295:(e,t,r)=>{"use strict";r.d(t,{Xv:()=>a,gX:()=>i,iW:()=>o});var n=[];function i(e){if(!e||o(e))return!1;if(0===n.length)return!0;for(var t=0;t<n.length;t++){var r=n[t];if("*"===r.hostname)return!1;if(s(r.hostname,e.hostname)&&c(r.pathname,e.pathname))return!1}return!0}function o(e){return void 0===e.hostname}function a(e){if(n=[],e&&e.length)for(var t=0;t<e.length;t++){let r=e[t];if(!r)continue;0===r.indexOf("http://")?r=r.substring(7):0===r.indexOf("https://")&&(r=r.substring(8));const i=r.indexOf("/");let o,a;i>0?(o=r.substring(0,i),a=r.substring(i)):(o=r,a="");let[s]=o.split(":");n.push({hostname:s,pathname:a})}}function s(e,t){return!(e.length>t.length)&&t.indexOf(e)===t.length-e.length}function c(e,t){return 0===e.indexOf("/")&&(e=e.substring(1)),0===t.indexOf("/")&&(t=t.substring(1)),""===e||e===t}},3241:(e,t,r)=>{"use strict";r.d(t,{W:()=>o});var n=r(6154);const i="newrelic";function o(e={}){try{n.gm.dispatchEvent(new CustomEvent(i,{detail:e}))}catch(e){}}},1687:(e,t,r)=>{"use strict";r.d(t,{Ak:()=>c,Ze:()=>l,x3:()=>u});var n=r(7836),i=r(3606),o=r(860),a=r(2646);const s={};function c(e,t){const r={staged:!1,priority:o.P3[t]||0};d(e),s[e].get(t)||s[e].set(t,r)}function u(e,t){e&&s[e]&&(s[e].get(t)&&s[e].delete(t),h(e,t,!1),s[e].size&&f(e))}function d(e){if(!e)throw new Error("agentIdentifier required");s[e]||(s[e]=new Map)}function l(e="",t="feature",r=!1){if(d(e),!e||!s[e].get(t)||r)return h(e,t);s[e].get(t).staged=!0,f(e)}function f(e){const t=Array.from(s[e]);t.every((([e,t])=>t.staged))&&(t.sort(((e,t)=>e[1].priority-t[1].priority)),t.forEach((([t])=>{s[e].delete(t),h(e,t)})))}function h(e,t,r=!0){const o=e?n.ee.get(e):n.ee,s=i.i.handlers;if(!o.aborted&&o.backlog&&s){if(r){const e=o.backlog[t],r=s[t];if(r){for(let t=0;e&&t<e.length;++t)p(e[t],r);Object.entries(r).forEach((([e,t])=>{Object.values(t||{}).forEach((t=>{t[0]?.on&&t[0]?.context()instanceof a.y&&t[0].on(e,t[1])}))}))}}o.isolatedBacklog||delete s[t],o.backlog[t]=null,o.emit("drain-"+t,[])}}function p(e,t){var r=e[1];Object.values(t[r]||{}).forEach((t=>{var r=e[0];if(t[0]===r){var n=t[1],i=e[3],o=e[2];n.apply(i,o)}}))}},7836:(e,t,r)=>{"use strict";r.d(t,{P:()=>s,ee:()=>c});var n=r(384),i=r(8990),o=r(2646),a=r(5607);const s="nr@context:".concat(a.W),c=function e(t,r){var n={},a={},d={},l=!1;try{l=16===r.length&&u.initializedAgents?.[r]?.runtime.isolatedBacklog}catch(e){}var f={on:p,addEventListener:p,removeEventListener:function(e,t){var r=n[e];if(!r)return;for(var i=0;i<r.length;i++)r[i]===t&&r.splice(i,1)},emit:function(e,r,n,i,o){!1!==o&&(o=!0);if(c.aborted&&!i)return;t&&o&&t.emit(e,r,n);for(var s=h(n),u=g(e),d=u.length,l=0;l<d;l++)u[l].apply(s,r);var p=v()[a[e]];p&&p.push([f,e,r,s]);return s},get:m,listeners:g,context:h,buffer:function(e,t){const r=v();if(t=t||"feature",f.aborted)return;Object.entries(e||{}).forEach((([e,n])=>{a[n]=t,t in r||(r[t]=[])}))},abort:function(){f._aborted=!0,Object.keys(f.backlog).forEach((e=>{delete f.backlog[e]}))},isBuffering:function(e){return!!v()[a[e]]},debugId:r,backlog:l?{}:t&&"object"==typeof t.backlog?t.backlog:{},isolatedBacklog:l};return Object.defineProperty(f,"aborted",{get:()=>{let e=f._aborted||!1;return e||(t&&(e=t.aborted),e)}}),f;function h(e){return e&&e instanceof o.y?e:e?(0,i.I)(e,s,(()=>new o.y(s))):new o.y(s)}function p(e,t){n[e]=g(e).concat(t)}function g(e){return n[e]||[]}function m(t){return d[t]=d[t]||e(f,t)}function v(){return f.backlog}}(void 0,"globalEE"),u=(0,n.Zm)();u.ee||(u.ee=c)},2646:(e,t,r)=>{"use strict";r.d(t,{y:()=>n});class n{constructor(e){this.contextId=e}}},9908:(e,t,r)=>{"use strict";r.d(t,{d:()=>n,p:()=>i});var n=r(7836).ee.get("handle");function i(e,t,r,i,o){o?(o.buffer([e],i),o.emit(e,t,r)):(n.buffer([e],i),n.emit(e,t,r))}},3606:(e,t,r)=>{"use strict";r.d(t,{i:()=>o});var n=r(9908);o.on=a;var i=o.handlers={};function o(e,t,r,o){a(o||n.d,i,e,t,r)}function a(e,t,r,i,o){o||(o="feature"),e||(e=n.d);var a=t[o]=t[o]||{};(a[r]=a[r]||[]).push([e,i])}},3878:(e,t,r)=>{"use strict";function n(e,t){return{capture:e,passive:!1,signal:t}}function i(e,t,r=!1,i){window.addEventListener(e,t,n(r,i))}function o(e,t,r=!1,i){document.addEventListener(e,t,n(r,i))}r.d(t,{DD:()=>o,jT:()=>n,sp:()=>i})},5607:(e,t,r)=>{"use strict";r.d(t,{W:()=>n});const n=(0,r(9566).bz)()},9566:(e,t,r)=>{"use strict";r.d(t,{LA:()=>s,ZF:()=>c,bz:()=>a,el:()=>u});var n=r(6154);const i="xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx";function o(e,t){return e?15&e[t]:16*Math.random()|0}function a(){const e=n.gm?.crypto||n.gm?.msCrypto;let t,r=0;return e&&e.getRandomValues&&(t=e.getRandomValues(new Uint8Array(30))),i.split("").map((e=>"x"===e?o(t,r++).toString(16):"y"===e?(3&o()|8).toString(16):e)).join("")}function s(e){const t=n.gm?.crypto||n.gm?.msCrypto;let r,i=0;t&&t.getRandomValues&&(r=t.getRandomValues(new Uint8Array(e)));const a=[];for(var s=0;s<e;s++)a.push(o(r,i++).toString(16));return a.join("")}function c(){return s(16)}function u(){return s(32)}},2614:(e,t,r)=>{"use strict";r.d(t,{BB:()=>a,H3:()=>n,g:()=>u,iL:()=>c,tS:()=>s,uh:()=>i,wk:()=>o});const n="NRBA",i="SESSION",o=144e5,a=18e5,s={STARTED:"session-started",PAUSE:"session-pause",RESET:"session-reset",RESUME:"session-resume",UPDATE:"session-update"},c={SAME_TAB:"same-tab",CROSS_TAB:"cross-tab"},u={OFF:0,FULL:1,ERROR:2}},1863:(e,t,r)=>{"use strict";function n(){return Math.floor(performance.now())}r.d(t,{t:()=>n})},7485:(e,t,r)=>{"use strict";r.d(t,{D:()=>i});var n=r(6154);function i(e){if(0===(e||"").indexOf("data:"))return{protocol:"data"};try{const t=new URL(e,location.href),r={port:t.port,hostname:t.hostname,pathname:t.pathname,search:t.search,protocol:t.protocol.slice(0,t.protocol.indexOf(":")),sameOrigin:t.protocol===n.gm?.location?.protocol&&t.host===n.gm?.location?.host};return r.port&&""!==r.port||("http:"===t.protocol&&(r.port="80"),"https:"===t.protocol&&(r.port="443")),r.pathname&&""!==r.pathname?r.pathname.startsWith("/")||(r.pathname="/".concat(r.pathname)):r.pathname="/",r}catch(e){return{}}}},944:(e,t,r)=>{"use strict";r.d(t,{R:()=>i});var n=r(3241);function i(e,t){"function"==typeof console.debug&&(console.debug("New Relic Warning: https://github.com/newrelic/newrelic-browser-agent/blob/main/docs/warning-codes.md#".concat(e),t),(0,n.W)({agentIdentifier:null,drained:null,type:"data",name:"warn",feature:"warn",data:{code:e,secondary:t}}))}},5701:(e,t,r)=>{"use strict";r.d(t,{B:()=>o,t:()=>a});var n=r(3241);const i=new Set,o={};function a(e,t){const r=t.agentIdentifier;o[r]??={},e&&"object"==typeof e&&(i.has(r)||(t.ee.emit("rumresp",[e]),o[r]=e,i.add(r),(0,n.W)({agentIdentifier:r,loaded:!0,drained:!0,type:"lifecycle",name:"load",feature:void 0,data:e})))}},8990:(e,t,r)=>{"use strict";r.d(t,{I:()=>i});var n=Object.prototype.hasOwnProperty;function i(e,t,r){if(n.call(e,t))return e[t];var i=r();if(Object.defineProperty&&Object.keys)try{return Object.defineProperty(e,t,{value:i,writable:!0,enumerable:!1}),i}catch(e){}return e[t]=i,i}},6389:(e,t,r)=>{"use strict";function n(e,t=500,r={}){const n=r?.leading||!1;let i;return(...r)=>{n&&void 0===i&&(e.apply(this,r),i=setTimeout((()=>{i=clearTimeout(i)}),t)),n||(clearTimeout(i),i=setTimeout((()=>{e.apply(this,r)}),t))}}function i(e){let t=!1;return(...r)=>{t||(t=!0,e.apply(this,r))}}r.d(t,{J:()=>i,s:()=>n})},3304:(e,t,r)=>{"use strict";r.d(t,{A:()=>o});var n=r(7836);const i=()=>{const e=new WeakSet;return(t,r)=>{if("object"==typeof r&&null!==r){if(e.has(r))return;e.add(r)}return r}};function o(e){try{return JSON.stringify(e,i())??""}catch(e){try{n.ee.emit("internal-error",[e])}catch(e){}return""}}},3496:(e,t,r)=>{"use strict";function n(e){return!e||!(!e.licenseKey||!e.applicationID)}function i(e,t){return!e||e.licenseKey===t.info.licenseKey&&e.applicationID===t.info.applicationID}r.d(t,{A:()=>i,I:()=>n})},5289:(e,t,r)=>{"use strict";r.d(t,{GG:()=>o,sB:()=>a});var n=r(3878);function i(){return"undefined"==typeof document||"complete"===document.readyState}function o(e,t){if(i())return e();(0,n.sp)("load",e,t)}function a(e){if(i())return e();(0,n.DD)("DOMContentLoaded",e)}},384:(e,t,r)=>{"use strict";r.d(t,{NT:()=>o,US:()=>u,Zm:()=>a,bQ:()=>c,dV:()=>s,pV:()=>d});var n=r(6154),i=r(1863);const o={beacon:"bam.nr-data.net",errorBeacon:"bam.nr-data.net"};function a(){return n.gm.NREUM||(n.gm.NREUM={}),void 0===n.gm.newrelic&&(n.gm.newrelic=n.gm.NREUM),n.gm.NREUM}function s(){let e=a();return e.o||(e.o={ST:n.gm.setTimeout,SI:n.gm.setImmediate,CT:n.gm.clearTimeout,XHR:n.gm.XMLHttpRequest,REQ:n.gm.Request,EV:n.gm.Event,PR:n.gm.Promise,MO:n.gm.MutationObserver,FETCH:n.gm.fetch,WS:n.gm.WebSocket}),e}function c(e,t){let r=a();r.initializedAgents??={},t.initializedAt={ms:(0,i.t)(),date:new Date},r.initializedAgents[e]=t}function u(e,t){a()[e]=t}function d(){return function(){let e=a();const t=e.info||{};e.info={beacon:o.beacon,errorBeacon:o.errorBeacon,...t}}(),function(){let e=a();const t=e.init||{};e.init={...t}}(),s(),function(){let e=a();const t=e.loader_config||{};e.loader_config={...t}}(),a()}},2843:(e,t,r)=>{"use strict";r.d(t,{u:()=>i});var n=r(3878);function i(e,t=!1,r,i){(0,n.DD)("visibilitychange",(function(){if(t)return void("hidden"===document.visibilityState&&e());e(document.visibilityState)}),r,i)}},8139:(e,t,r)=>{"use strict";r.d(t,{u:()=>f});var n=r(7836),i=r(3434),o=r(8990),a=r(6154);const s={},c=a.gm.XMLHttpRequest,u="addEventListener",d="removeEventListener",l="nr@wrapped:".concat(n.P);function f(e){var t=function(e){return(e||n.ee).get("events")}(e);if(s[t.debugId]++)return t;s[t.debugId]=1;var r=(0,i.YM)(t,!0);function f(e){r.inPlace(e,[u,d],"-",p)}function p(e,t){return e[1]}return"getPrototypeOf"in Object&&(a.RI&&h(document,f),c&&h(c.prototype,f),h(a.gm,f)),t.on(u+"-start",(function(e,t){var n=e[1];if(null!==n&&("function"==typeof n||"object"==typeof n)){var i=(0,o.I)(n,l,(function(){var e={object:function(){if("function"!=typeof n.handleEvent)return;return n.handleEvent.apply(n,arguments)},function:n}[typeof n];return e?r(e,"fn-",null,e.name||"anonymous"):n}));this.wrapped=e[1]=i}})),t.on(d+"-start",(function(e){e[1]=this.wrapped||e[1]})),t}function h(e,t,...r){let n=e;for(;"object"==typeof n&&!Object.prototype.hasOwnProperty.call(n,u);)n=Object.getPrototypeOf(n);n&&t(n,...r)}},3434:(e,t,r)=>{"use strict";r.d(t,{Jt:()=>o,YM:()=>c});var n=r(7836),i=r(5607);const o="nr@original:".concat(i.W);var a=Object.prototype.hasOwnProperty,s=!1;function c(e,t){return e||(e=n.ee),r.inPlace=function(e,t,n,i,o){n||(n="");const a="-"===n.charAt(0);for(let s=0;s<t.length;s++){const c=t[s],u=e[c];d(u)||(e[c]=r(u,a?c+n:n,i,c,o))}},r.flag=o,r;function r(t,r,n,s,c){return d(t)?t:(r||(r=""),nrWrapper[o]=t,function(e,t,r){if(Object.defineProperty&&Object.keys)try{return Object.keys(e).forEach((function(r){Object.defineProperty(t,r,{get:function(){return e[r]},set:function(t){return e[r]=t,t}})})),t}catch(e){u([e],r)}for(var n in e)a.call(e,n)&&(t[n]=e[n])}(t,nrWrapper,e),nrWrapper);function nrWrapper(){var o,a,d,l;try{a=this,o=[...arguments],d="function"==typeof n?n(o,a):n||{}}catch(t){u([t,"",[o,a,s],d],e)}i(r+"start",[o,a,s],d,c);try{return l=t.apply(a,o)}catch(e){throw i(r+"err",[o,a,e],d,c),e}finally{i(r+"end",[o,a,l],d,c)}}}function i(r,n,i,o){if(!s||t){var a=s;s=!0;try{e.emit(r,n,i,t,o)}catch(t){u([t,r,n,i],e)}s=a}}}function u(e,t){t||(t=n.ee);try{t.emit("internal-error",e)}catch(e){}}function d(e){return!(e&&"function"==typeof e&&e.apply&&!e[o])}},9300:(e,t,r)=>{"use strict";r.d(t,{T:()=>n});const n=r(860).K7.ajax},3333:(e,t,r)=>{"use strict";r.d(t,{$v:()=>u,TZ:()=>n,Zp:()=>i,kd:()=>c,mq:()=>s,nf:()=>a,qN:()=>o});const n=r(860).K7.genericEvents,i=["auxclick","click","copy","keydown","paste","scrollend"],o=["focus","blur"],a=4,s=1e3,c=["PageAction","UserAction","BrowserPerformance"],u={MARKS:"experimental.marks",MEASURES:"experimental.measures",RESOURCES:"experimental.resources"}},6774:(e,t,r)=>{"use strict";r.d(t,{T:()=>n});const n=r(860).K7.jserrors},993:(e,t,r)=>{"use strict";r.d(t,{A$:()=>o,ET:()=>a,TZ:()=>s,p_:()=>i});var n=r(860);const i={ERROR:"ERROR",WARN:"WARN",INFO:"INFO",DEBUG:"DEBUG",TRACE:"TRACE"},o={OFF:0,ERROR:1,WARN:2,INFO:3,DEBUG:4,TRACE:5},a="log",s=n.K7.logging},3785:(e,t,r)=>{"use strict";r.d(t,{R:()=>c,b:()=>u});var n=r(9908),i=r(1863),o=r(860),a=r(8154),s=r(993);function c(e,t,r={},c=s.p_.INFO,u,d=(0,i.t)()){(0,n.p)(a.xV,["API/logging/".concat(c.toLowerCase(),"/called")],void 0,o.K7.metrics,e),(0,n.p)(s.ET,[d,t,r,c,u],void 0,o.K7.logging,e)}function u(e){return"string"==typeof e&&Object.values(s.p_).some((t=>t===e.toUpperCase().trim()))}},8154:(e,t,r)=>{"use strict";r.d(t,{z_:()=>o,XG:()=>s,TZ:()=>n,rs:()=>i,xV:()=>a});r(6154),r(9566),r(384);const n=r(860).K7.metrics,i="sm",o="cm",a="storeSupportabilityMetrics",s="storeEventMetrics"},6630:(e,t,r)=>{"use strict";r.d(t,{T:()=>n});const n=r(860).K7.pageViewEvent},782:(e,t,r)=>{"use strict";r.d(t,{T:()=>n});const n=r(860).K7.pageViewTiming},6344:(e,t,r)=>{"use strict";r.d(t,{BB:()=>d,G4:()=>o,Qb:()=>l,TZ:()=>i,Ug:()=>a,_s:()=>s,bc:()=>u,yP:()=>c});var n=r(2614);const i=r(860).K7.sessionReplay,o={RECORD:"recordReplay",PAUSE:"pauseReplay",ERROR_DURING_REPLAY:"errorDuringReplay"},a=.12,s={DomContentLoaded:0,Load:1,FullSnapshot:2,IncrementalSnapshot:3,Meta:4,Custom:5},c={[n.g.ERROR]:15e3,[n.g.FULL]:3e5,[n.g.OFF]:0},u={RESET:{message:"Session was reset",sm:"Reset"},IMPORT:{message:"Recorder failed to import",sm:"Import"},TOO_MANY:{message:"429: Too Many Requests",sm:"Too-Many"},TOO_BIG:{message:"Payload was too large",sm:"Too-Big"},CROSS_TAB:{message:"Session Entity was set to OFF on another tab",sm:"Cross-Tab"},ENTITLEMENTS:{message:"Session Replay is not allowed and will not be started",sm:"Entitlement"}},d=5e3,l={API:"api"}},5270:(e,t,r)=>{"use strict";r.d(t,{Aw:()=>s,CT:()=>c,SR:()=>a,rF:()=>u});var n=r(384),i=r(7767),o=r(6154);function a(e){return!!(0,n.dV)().o.MO&&(0,i.V)(e)&&!0===e?.session_trace.enabled}function s(e){return!0===e?.session_replay.preload&&a(e)}function c(e,t){const r=t.correctAbsoluteTimestamp(e);return{originalTimestamp:e,correctedTimestamp:r,timestampDiff:e-r,originTime:o.WN,correctedOriginTime:t.correctedOriginTime,originTimeDiff:Math.floor(o.WN-t.correctedOriginTime)}}function u(e,t){try{if("string"==typeof t?.type){if("password"===t.type.toLowerCase())return"*".repeat(e?.length||0);if(void 0!==t?.dataset?.nrUnmask||t?.classList?.contains("nr-unmask"))return e}}catch(e){}return"string"==typeof e?e.replace(/[\S]/g,"*"):"*".repeat(e?.length||0)}},3738:(e,t,r)=>{"use strict";r.d(t,{He:()=>i,Kp:()=>s,Lc:()=>u,Rz:()=>d,TZ:()=>n,bD:()=>o,d3:()=>a,jx:()=>l,uP:()=>c});const n=r(860).K7.sessionTrace,i="bstResource",o="resource",a="-start",s="-end",c="fn"+a,u="fn"+s,d="pushState",l=1e3},3962:(e,t,r)=>{"use strict";r.d(t,{AM:()=>o,O2:()=>c,Qu:()=>u,TZ:()=>s,ih:()=>d,pP:()=>a,tC:()=>i});var n=r(860);const i=["click","keydown","submit","popstate"],o="api",a="initialPageLoad",s=n.K7.softNav,c={INITIAL_PAGE_LOAD:"",ROUTE_CHANGE:1,UNSPECIFIED:2},u={INTERACTION:1,AJAX:2,CUSTOM_END:3,CUSTOM_TRACER:4},d={IP:"in progress",FIN:"finished",CAN:"cancelled"}},7378:(e,t,r)=>{"use strict";r.d(t,{$p:()=>x,BR:()=>b,Kp:()=>w,L3:()=>y,Lc:()=>c,NC:()=>o,SG:()=>d,TZ:()=>i,U6:()=>p,UT:()=>m,d3:()=>R,dT:()=>f,e5:()=>A,gx:()=>v,l9:()=>l,oW:()=>h,op:()=>g,rw:()=>u,tH:()=>E,uP:()=>s,wW:()=>T,xq:()=>a});var n=r(384);const i=r(860).K7.spa,o=["click","submit","keypress","keydown","keyup","change"],a=999,s="fn-start",c="fn-end",u="cb-start",d="api-ixn-",l="remaining",f="interaction",h="spaNode",p="jsonpNode",g="fetch-start",m="fetch-done",v="fetch-body-",b="jsonp-end",y=(0,n.dV)().o.ST,R="-start",w="-end",x="-body",T="cb"+w,A="jsTime",E="fetch"},4234:(e,t,r)=>{"use strict";r.d(t,{W:()=>o});var n=r(7836),i=r(1687);class o{constructor(e,t){this.agentIdentifier=e,this.ee=n.ee.get(e),this.featureName=t,this.blocked=!1}deregisterDrain(){(0,i.x3)(this.agentIdentifier,this.featureName)}}},7767:(e,t,r)=>{"use strict";r.d(t,{V:()=>i});var n=r(6154);const i=e=>n.RI&&!0===e?.privacy.cookies_enabled},1741:(e,t,r)=>{"use strict";r.d(t,{W:()=>o});var n=r(944),i=r(4261);class o{#e(e,...t){if(this[e]!==o.prototype[e])return this[e](...t);(0,n.R)(35,e)}addPageAction(e,t){return this.#e(i.hG,e,t)}register(e){return this.#e(i.eY,e)}recordCustomEvent(e,t){return this.#e(i.fF,e,t)}setPageViewName(e,t){return this.#e(i.Fw,e,t)}setCustomAttribute(e,t,r){return this.#e(i.cD,e,t,r)}noticeError(e,t){return this.#e(i.o5,e,t)}setUserId(e){return this.#e(i.Dl,e)}setApplicationVersion(e){return this.#e(i.nb,e)}setErrorHandler(e){return this.#e(i.bt,e)}addRelease(e,t){return this.#e(i.k6,e,t)}log(e,t){return this.#e(i.$9,e,t)}start(){return this.#e(i.d3)}finished(e){return this.#e(i.BL,e)}recordReplay(){return this.#e(i.CH)}pauseReplay(){return this.#e(i.Tb)}addToTrace(e){return this.#e(i.U2,e)}setCurrentRouteName(e){return this.#e(i.PA,e)}interaction(){return this.#e(i.dT)}wrapLogger(e,t,r){return this.#e(i.Wb,e,t,r)}measure(e,t){return this.#e(i.V1,e,t)}}},4261:(e,t,r)=>{"use strict";r.d(t,{$9:()=>d,BL:()=>c,CH:()=>p,Dl:()=>w,Fw:()=>R,PA:()=>v,Pl:()=>n,Tb:()=>f,U2:()=>a,V1:()=>A,Wb:()=>T,bt:()=>y,cD:()=>b,d3:()=>x,dT:()=>u,eY:()=>g,fF:()=>h,hG:()=>o,hw:()=>i,k6:()=>s,nb:()=>m,o5:()=>l});const n="api-",i=n+"ixn-",o="addPageAction",a="addToTrace",s="addRelease",c="finished",u="interaction",d="log",l="noticeError",f="pauseReplay",h="recordCustomEvent",p="recordReplay",g="register",m="setApplicationVersion",v="setCurrentRouteName",b="setCustomAttribute",y="setErrorHandler",R="setPageViewName",w="setUserId",x="start",T="wrapLogger",A="measure"},5205:(e,t,r)=>{"use strict";r.d(t,{j:()=>S});var n=r(384),i=r(1741);var o=r(2555),a=r(3333);const s=e=>{if(!e||"string"!=typeof e)return!1;try{document.createDocumentFragment().querySelector(e)}catch{return!1}return!0};var c=r(2614),u=r(944),d=r(8122);const l="[data-nr-mask]",f=e=>(0,d.a)(e,(()=>{const e={feature_flags:[],experimental:{marks:!1,measures:!1,resources:!1},mask_selector:"*",block_selector:"[data-nr-block]",mask_input_options:{color:!1,date:!1,"datetime-local":!1,email:!1,month:!1,number:!1,range:!1,search:!1,tel:!1,text:!1,time:!1,url:!1,week:!1,textarea:!1,select:!1,password:!0}};return{ajax:{deny_list:void 0,block_internal:!0,enabled:!0,autoStart:!0},api:{allow_registered_children:!0,duplicate_registered_data:!1},distributed_tracing:{enabled:void 0,exclude_newrelic_header:void 0,cors_use_newrelic_header:void 0,cors_use_tracecontext_headers:void 0,allowed_origins:void 0},get feature_flags(){return e.feature_flags},set feature_flags(t){e.feature_flags=t},generic_events:{enabled:!0,autoStart:!0},harvest:{interval:30},jserrors:{enabled:!0,autoStart:!0},logging:{enabled:!0,autoStart:!0},metrics:{enabled:!0,autoStart:!0},obfuscate:void 0,page_action:{enabled:!0},page_view_event:{enabled:!0,autoStart:!0},page_view_timing:{enabled:!0,autoStart:!0},performance:{get capture_marks(){return e.feature_flags.includes(a.$v.MARKS)||e.experimental.marks},set capture_marks(t){e.experimental.marks=t},get capture_measures(){return e.feature_flags.includes(a.$v.MEASURES)||e.experimental.measures},set capture_measures(t){e.experimental.measures=t},capture_detail:!0,resources:{get enabled(){return e.feature_flags.includes(a.$v.RESOURCES)||e.experimental.resources},set enabled(t){e.experimental.resources=t},asset_types:[],first_party_domains:[],ignore_newrelic:!0}},privacy:{cookies_enabled:!0},proxy:{assets:void 0,beacon:void 0},session:{expiresMs:c.wk,inactiveMs:c.BB},session_replay:{autoStart:!0,enabled:!1,preload:!1,sampling_rate:10,error_sampling_rate:100,collect_fonts:!1,inline_images:!1,fix_stylesheets:!0,mask_all_inputs:!0,get mask_text_selector(){return e.mask_selector},set mask_text_selector(t){s(t)?e.mask_selector="".concat(t,",").concat(l):""===t||null===t?e.mask_selector=l:(0,u.R)(5,t)},get block_class(){return"nr-block"},get ignore_class(){return"nr-ignore"},get mask_text_class(){return"nr-mask"},get block_selector(){return e.block_selector},set block_selector(t){s(t)?e.block_selector+=",".concat(t):""!==t&&(0,u.R)(6,t)},get mask_input_options(){return e.mask_input_options},set mask_input_options(t){t&&"object"==typeof t?e.mask_input_options={...t,password:!0}:(0,u.R)(7,t)}},session_trace:{enabled:!0,autoStart:!0},soft_navigations:{enabled:!0,autoStart:!0},spa:{enabled:!0,autoStart:!0},ssl:void 0,user_actions:{enabled:!0,elementAttributes:["id","className","tagName","type"]}}})());var h=r(6154),p=r(9324);let g=0;const m={buildEnv:p.F3,distMethod:p.Xs,version:p.xv,originTime:h.WN},v={appMetadata:{},customTransaction:void 0,denyList:void 0,disabled:!1,entityManager:void 0,harvester:void 0,isolatedBacklog:!1,isRecording:!1,loaderType:void 0,maxBytes:3e4,obfuscator:void 0,onerror:void 0,ptid:void 0,releaseIds:{},session:void 0,timeKeeper:void 0,get harvestCount(){return++g}},b=e=>{const t=(0,d.a)(e,v),r=Object.keys(m).reduce(((e,t)=>(e[t]={value:m[t],writable:!1,configurable:!0,enumerable:!0},e)),{});return Object.defineProperties(t,r)};var y=r(5701);const R=e=>{const t=e.startsWith("http");e+="/",r.p=t?e:"https://"+e};var w=r(7836),x=r(3241);const T={accountID:void 0,trustKey:void 0,agentID:void 0,licenseKey:void 0,applicationID:void 0,xpid:void 0},A=e=>(0,d.a)(e,T),E=new Set;function S(e,t={},r,a){let{init:s,info:c,loader_config:u,runtime:d={},exposed:l=!0}=t;if(!c){const e=(0,n.pV)();s=e.init,c=e.info,u=e.loader_config}e.init=f(s||{}),e.loader_config=A(u||{}),c.jsAttributes??={},h.bv&&(c.jsAttributes.isWorker=!0),e.info=(0,o.D)(c);const p=e.init,g=[c.beacon,c.errorBeacon];E.has(e.agentIdentifier)||(p.proxy.assets&&(R(p.proxy.assets),g.push(p.proxy.assets)),p.proxy.beacon&&g.push(p.proxy.beacon),function(e){const t=(0,n.pV)();Object.getOwnPropertyNames(i.W.prototype).forEach((r=>{const n=i.W.prototype[r];if("function"!=typeof n||"constructor"===n)return;let o=t[r];e[r]&&!1!==e.exposed&&"micro-agent"!==e.runtime?.loaderType&&(t[r]=(...t)=>{const n=e[r](...t);return o?o(...t):n})}))}(e),(0,n.US)("activatedFeatures",y.B),e.runSoftNavOverSpa&&=!0===p.soft_navigations.enabled&&p.feature_flags.includes("soft_nav")),d.denyList=[...p.ajax.deny_list||[],...p.ajax.block_internal?g:[]],d.ptid=e.agentIdentifier,d.loaderType=r,e.runtime=b(d),E.has(e.agentIdentifier)||(e.ee=w.ee.get(e.agentIdentifier),e.exposed=l,(0,x.W)({agentIdentifier:e.agentIdentifier,drained:!!y.B?.[e.agentIdentifier],type:"lifecycle",name:"initialize",feature:void 0,data:e.config})),E.add(e.agentIdentifier)}},8374:(e,t,r)=>{r.nc=(()=>{try{return document?.currentScript?.nonce}catch(e){}return""})()},860:(e,t,r)=>{"use strict";r.d(t,{$J:()=>d,K7:()=>c,P3:()=>u,XX:()=>i,Yy:()=>s,df:()=>o,qY:()=>n,v4:()=>a});const n="events",i="jserrors",o="browser/blobs",a="rum",s="browser/logs",c={ajax:"ajax",genericEvents:"generic_events",jserrors:i,logging:"logging",metrics:"metrics",pageAction:"page_action",pageViewEvent:"page_view_event",pageViewTiming:"page_view_timing",sessionReplay:"session_replay",sessionTrace:"session_trace",softNav:"soft_navigations",spa:"spa"},u={[c.pageViewEvent]:1,[c.pageViewTiming]:2,[c.metrics]:3,[c.jserrors]:4,[c.spa]:5,[c.ajax]:6,[c.sessionTrace]:7,[c.softNav]:8,[c.sessionReplay]:9,[c.logging]:10,[c.genericEvents]:11},d={[c.pageViewEvent]:a,[c.pageViewTiming]:n,[c.ajax]:n,[c.spa]:n,[c.softNav]:n,[c.metrics]:i,[c.jserrors]:i,[c.sessionTrace]:o,[c.sessionReplay]:o,[c.logging]:s,[c.genericEvents]:"ins"}}},n={};function i(e){var t=n[e];if(void 0!==t)return t.exports;var o=n[e]={exports:{}};return r[e](o,o.exports,i),o.exports}i.m=r,i.d=(e,t)=>{for(var r in t)i.o(t,r)&&!i.o(e,r)&&Object.defineProperty(e,r,{enumerable:!0,get:t[r]})},i.f={},i.e=e=>Promise.all(Object.keys(i.f).reduce(((t,r)=>(i.f[r](e,t),t)),[])),i.u=e=>({212:"nr-spa-compressor",249:"nr-spa-recorder",478:"nr-spa"}[e]+"-1.291.0.min.js"),i.o=(e,t)=>Object.prototype.hasOwnProperty.call(e,t),e={},t="NRBA-1.291.0.PROD:",i.l=(r,n,o,a)=>{if(e[r])e[r].push(n);else{var s,c;if(void 0!==o)for(var u=document.getElementsByTagName("script"),d=0;d<u.length;d++){var l=u[d];if(l.getAttribute("src")==r||l.getAttribute("data-webpack")==t+o){s=l;break}}if(!s){c=!0;var f={478:"sha512-qhYmf6shPnSinz5VJ8c+/nqwM0fPlBJHZwpFQjXvtV1ZvFV2HsegbrhJ9qzJ7AwAULfDvgEboflkT5had5EdvQ==",249:"sha512-x+ISkB1RKrWE4/Ot9t7KKPt5aq/KSmxcvkko8kak5aBL+cI12ZOsLpQrVLTZk+CWk3hHrQwgm8YEmIoM/rvl4w==",212:"sha512-lQsFHSNocGzvem9+Gz/aHEr2QKzlgQEwTxJDsBpzZFwRokit/IVFWzKe/jP7LENep5Hzw6ub2qXPE9V7qTDBLw=="};(s=document.createElement("script")).charset="utf-8",s.timeout=120,i.nc&&s.setAttribute("nonce",i.nc),s.setAttribute("data-webpack",t+o),s.src=r,0!==s.src.indexOf(window.location.origin+"/")&&(s.crossOrigin="anonymous"),f[a]&&(s.integrity=f[a])}e[r]=[n];var h=(t,n)=>{s.onerror=s.onload=null,clearTimeout(p);var i=e[r];if(delete e[r],s.parentNode&&s.parentNode.removeChild(s),i&&i.forEach((e=>e(n))),t)return t(n)},p=setTimeout(h.bind(null,void 0,{type:"timeout",target:s}),12e4);s.onerror=h.bind(null,s.onerror),s.onload=h.bind(null,s.onload),c&&document.head.appendChild(s)}},i.r=e=>{"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},i.p="https://js-agent.newrelic.com/",(()=>{var e={38:0,788:0};i.f.j=(t,r)=>{var n=i.o(e,t)?e[t]:void 0;if(0!==n)if(n)r.push(n[2]);else{var o=new Promise(((r,i)=>n=e[t]=[r,i]));r.push(n[2]=o);var a=i.p+i.u(t),s=new Error;i.l(a,(r=>{if(i.o(e,t)&&(0!==(n=e[t])&&(e[t]=void 0),n)){var o=r&&("load"===r.type?"missing":r.type),a=r&&r.target&&r.target.src;s.message="Loading chunk "+t+" failed.\n("+o+": "+a+")",s.name="ChunkLoadError",s.type=o,s.request=a,n[1](s)}}),"chunk-"+t,t)}};var t=(t,r)=>{var n,o,[a,s,c]=r,u=0;if(a.some((t=>0!==e[t]))){for(n in s)i.o(s,n)&&(i.m[n]=s[n]);if(c)c(i)}for(t&&t(r);u<a.length;u++)o=a[u],i.o(e,o)&&e[o]&&e[o][0](),e[o]=0},r=self["webpackChunk:NRBA-1.291.0.PROD"]=self["webpackChunk:NRBA-1.291.0.PROD"]||[];r.forEach(t.bind(null,0)),r.push=t.bind(null,r.push.bind(r))})(),(()=>{"use strict";i(8374);var e=i(9566),t=i(1741);class r extends t.W{agentIdentifier=(0,e.LA)(16)}var n=i(860);const o=Object.values(n.K7);var a=i(5205);var s=i(9908),c=i(1863),u=i(4261),d=i(3241),l=i(944),f=i(5701),h=i(8154);function p(e,t,i,o){const a=o||i;!a||a[e]&&a[e]!==r.prototype[e]||(a[e]=function(){(0,s.p)(h.xV,["API/"+e+"/called"],void 0,n.K7.metrics,i.ee),(0,d.W)({agentIdentifier:i.agentIdentifier,drained:!!f.B?.[i.agentIdentifier],type:"data",name:"api",feature:u.Pl+e,data:{}});try{return t.apply(this,arguments)}catch(e){(0,l.R)(23,e)}})}function g(e,t,r,n,i){const o=e.info;null===r?delete o.jsAttributes[t]:o.jsAttributes[t]=r,(i||null===r)&&(0,s.p)(u.Pl+n,[(0,c.t)(),t,r],void 0,"session",e.ee)}var m=i(1687),v=i(4234),b=i(5289),y=i(6154),R=i(5270),w=i(7767),x=i(6389);class T extends v.W{constructor(e,t){super(e.agentIdentifier,t),this.abortHandler=void 0,this.featAggregate=void 0,this.onAggregateImported=void 0,this.deferred=Promise.resolve(),!1===e.init[this.featureName].autoStart?this.deferred=new Promise(((t,r)=>{this.ee.on("manual-start-all",(0,x.J)((()=>{(0,m.Ak)(e.agentIdentifier,this.featureName),t()})))})):(0,m.Ak)(e.agentIdentifier,t)}importAggregator(e,t,r={}){if(this.featAggregate)return;let o;this.onAggregateImported=new Promise((e=>{o=e}));const a=async()=>{let a;await this.deferred;try{if((0,w.V)(e.init)){const{setupAgentSession:t}=await i.e(478).then(i.bind(i,6526));a=t(e)}}catch(e){(0,l.R)(20,e),this.ee.emit("internal-error",[e]),this.featureName===n.K7.sessionReplay&&this.abortHandler?.()}try{if(!this.#t(this.featureName,a,e.init))return(0,m.Ze)(this.agentIdentifier,this.featureName),void o(!1);const{Aggregate:n}=await t();this.featAggregate=new n(e,r),e.runtime.harvester.initializedAggregates.push(this.featAggregate),o(!0)}catch(e){(0,l.R)(34,e),this.abortHandler?.(),(0,m.Ze)(this.agentIdentifier,this.featureName,!0),o(!1),this.ee&&this.ee.abort()}};y.RI?(0,b.GG)((()=>a()),!0):a()}#t(e,t,r){switch(e){case n.K7.sessionReplay:return(0,R.SR)(r)&&!!t;case n.K7.sessionTrace:return!!t;default:return!0}}}var A=i(6630);class E extends T{static featureName=A.T;constructor(e){var t;super(e,A.T),t=e,p(u.Fw,(function(e,r){"string"==typeof e&&("/"!==e.charAt(0)&&(e="/"+e),t.runtime.customTransaction=(r||"http://custom.transaction")+e,(0,s.p)(u.Pl+u.Fw,[(0,c.t)()],void 0,void 0,t.ee))}),t),this.ee.on("api-send-rum",((e,t)=>(0,s.p)("send-rum",[e,t],void 0,this.featureName,this.ee))),this.importAggregator(e,(()=>i.e(478).then(i.bind(i,1983))))}}var S=i(384);var _=i(2843),N=i(3878),O=i(782);class P extends T{static featureName=O.T;constructor(e){super(e,O.T),y.RI&&((0,_.u)((()=>(0,s.p)("docHidden",[(0,c.t)()],void 0,O.T,this.ee)),!0),(0,N.sp)("pagehide",(()=>(0,s.p)("winPagehide",[(0,c.t)()],void 0,O.T,this.ee))),this.importAggregator(e,(()=>i.e(478).then(i.bind(i,9917)))))}}class I extends T{static featureName=h.TZ;constructor(e){super(e,h.TZ),y.RI&&document.addEventListener("securitypolicyviolation",(e=>{(0,s.p)(h.xV,["Generic/CSPViolation/Detected"],void 0,this.featureName,this.ee)})),this.importAggregator(e,(()=>i.e(478).then(i.bind(i,8351))))}}var j=i(6774),k=i(3304);class C{constructor(e,t,r,n,i){this.name="UncaughtError",this.message="string"==typeof e?e:(0,k.A)(e),this.sourceURL=t,this.line=r,this.column=n,this.__newrelic=i}}function L(e){return D(e)?e:new C(void 0!==e?.message?e.message:e,e?.filename||e?.sourceURL,e?.lineno||e?.line,e?.colno||e?.col,e?.__newrelic)}function H(e){const t="Unhandled Promise Rejection: ";if(!e?.reason)return;if(D(e.reason)){try{e.reason.message.startsWith(t)||(e.reason.message=t+e.reason.message)}catch(e){}return L(e.reason)}const r=L(e.reason);return(r.message||"").startsWith(t)||(r.message=t+r.message),r}function M(e){if(e.error instanceof SyntaxError&&!/:\d+$/.test(e.error.stack?.trim())){const t=new C(e.message,e.filename,e.lineno,e.colno,e.error.__newrelic);return t.name=SyntaxError.name,t}return D(e.error)?e.error:L(e)}function D(e){return e instanceof Error&&!!e.stack}function K(e,t,r,i,o=(0,c.t)()){"string"==typeof e&&(e=new Error(e)),(0,s.p)("err",[e,o,!1,t,r.runtime.isRecording,void 0,i],void 0,n.K7.jserrors,r.ee)}var U=i(3496),F=i(993),W=i(3785);function B(e,{customAttributes:t={},level:r=F.p_.INFO}={},n,i,o=(0,c.t)()){(0,W.R)(n.ee,e,t,r,i,o)}function G(e,t,r,i,o=(0,c.t)()){(0,s.p)(u.Pl+u.hG,[o,e,t,i],void 0,n.K7.genericEvents,r.ee)}function V(e){p(u.eY,(function(t){return function(e,t){const r={};let i,o;(0,l.R)(54,"newrelic.register"),e.init.api.allow_registered_children||(i=()=>(0,l.R)(55));t&&(0,U.I)(t)||(i=()=>(0,l.R)(48,t));const a={addPageAction:(n,i={})=>{u(G,[n,{...r,...i},e],t)},log:(n,i={})=>{u(B,[n,{...i,customAttributes:{...r,...i.customAttributes||{}}},e],t)},noticeError:(n,i={})=>{u(K,[n,{...r,...i},e],t)},setApplicationVersion:e=>{r["application.version"]=e},setCustomAttribute:(e,t)=>{r[e]=t},setUserId:e=>{r["enduser.id"]=e},metadata:{customAttributes:r,target:t,get connected(){return o||Promise.reject(new Error("Failed to connect"))}}};i?i():o=new Promise(((n,i)=>{try{const o=e.runtime?.entityManager;let s=!!o?.get().entityGuid,c=o?.getEntityGuidFor(t.licenseKey,t.applicationID),u=!!c;if(s&&u)t.entityGuid=c,n(a);else{const d=setTimeout((()=>i(new Error("Failed to connect - Timeout"))),15e3);function l(r){(0,U.A)(r,e)?s||=!0:t.licenseKey===r.licenseKey&&t.applicationID===r.applicationID&&(u=!0,t.entityGuid=r.entityGuid),s&&u&&(clearTimeout(d),e.ee.removeEventListener("entity-added",l),n(a))}e.ee.emit("api-send-rum",[r,t]),e.ee.on("entity-added",l)}}catch(f){i(f)}}));const u=async(t,r,a)=>{if(i)return i();const u=(0,c.t)();(0,s.p)(h.xV,["API/register/".concat(t.name,"/called")],void 0,n.K7.metrics,e.ee);try{await o;const n=e.init.api.duplicate_registered_data;(!0===n||Array.isArray(n)&&n.includes(a.entityGuid))&&t(...r,void 0,u),t(...r,a.entityGuid,u)}catch(e){(0,l.R)(50,e)}};return a}(e,t)}),e)}class z extends T{static featureName=j.T;constructor(e){var t;super(e,j.T),t=e,p(u.o5,((e,r)=>K(e,r,t)),t),function(e){p(u.bt,(function(t){e.runtime.onerror=t}),e)}(e),function(e){let t=0;p(u.k6,(function(e,r){++t>10||(this.runtime.releaseIds[e.slice(-200)]=(""+r).slice(-200))}),e)}(e),V(e);try{this.removeOnAbort=new AbortController}catch(e){}this.ee.on("internal-error",((t,r)=>{this.abortHandler&&(0,s.p)("ierr",[L(t),(0,c.t)(),!0,{},e.runtime.isRecording,r],void 0,this.featureName,this.ee)})),y.gm.addEventListener("unhandledrejection",(t=>{this.abortHandler&&(0,s.p)("err",[H(t),(0,c.t)(),!1,{unhandledPromiseRejection:1},e.runtime.isRecording],void 0,this.featureName,this.ee)}),(0,N.jT)(!1,this.removeOnAbort?.signal)),y.gm.addEventListener("error",(t=>{this.abortHandler&&(0,s.p)("err",[M(t),(0,c.t)(),!1,{},e.runtime.isRecording],void 0,this.featureName,this.ee)}),(0,N.jT)(!1,this.removeOnAbort?.signal)),this.abortHandler=this.#r,this.importAggregator(e,(()=>i.e(478).then(i.bind(i,5928))))}#r(){this.removeOnAbort?.abort(),this.abortHandler=void 0}}var Z=i(8990);let q=1;function X(e){const t=typeof e;return!e||"object"!==t&&"function"!==t?-1:e===y.gm?0:(0,Z.I)(e,"nr@id",(function(){return q++}))}function Y(e){if("string"==typeof e&&e.length)return e.length;if("object"==typeof e){if("undefined"!=typeof ArrayBuffer&&e instanceof ArrayBuffer&&e.byteLength)return e.byteLength;if("undefined"!=typeof Blob&&e instanceof Blob&&e.size)return e.size;if(!("undefined"!=typeof FormData&&e instanceof FormData))try{return(0,k.A)(e).length}catch(e){return}}}var J=i(8139),Q=i(7836),ee=i(3434);const te={},re=["open","send"];function ne(e){var t=e||Q.ee;const r=function(e){return(e||Q.ee).get("xhr")}(t);if(void 0===y.gm.XMLHttpRequest)return r;if(te[r.debugId]++)return r;te[r.debugId]=1,(0,J.u)(t);var n=(0,ee.YM)(r),i=y.gm.XMLHttpRequest,o=y.gm.MutationObserver,a=y.gm.Promise,s=y.gm.setInterval,c="readystatechange",u=["onload","onerror","onabort","onloadstart","onloadend","onprogress","ontimeout"],d=[],f=y.gm.XMLHttpRequest=function(e){const t=new i(e),o=r.context(t);try{r.emit("new-xhr",[t],o),t.addEventListener(c,(a=o,function(){var e=this;e.readyState>3&&!a.resolved&&(a.resolved=!0,r.emit("xhr-resolved",[],e)),n.inPlace(e,u,"fn-",b)}),(0,N.jT)(!1))}catch(e){(0,l.R)(15,e);try{r.emit("internal-error",[e])}catch(e){}}var a;return t};function h(e,t){n.inPlace(t,["onreadystatechange"],"fn-",b)}if(function(e,t){for(var r in e)t[r]=e[r]}(i,f),f.prototype=i.prototype,n.inPlace(f.prototype,re,"-xhr-",b),r.on("send-xhr-start",(function(e,t){h(e,t),function(e){d.push(e),o&&(p?p.then(v):s?s(v):(g=-g,m.data=g))}(t)})),r.on("open-xhr-start",h),o){var p=a&&a.resolve();if(!s&&!a){var g=1,m=document.createTextNode(g);new o(v).observe(m,{characterData:!0})}}else t.on("fn-end",(function(e){e[0]&&e[0].type===c||v()}));function v(){for(var e=0;e<d.length;e++)h(0,d[e]);d.length&&(d=[])}function b(e,t){return t}return r}var ie="fetch-",oe=ie+"body-",ae=["arrayBuffer","blob","json","text","formData"],se=y.gm.Request,ce=y.gm.Response,ue="prototype";const de={};function le(e){const t=function(e){return(e||Q.ee).get("fetch")}(e);if(!(se&&ce&&y.gm.fetch))return t;if(de[t.debugId]++)return t;function r(e,r,n){var i=e[r];"function"==typeof i&&(e[r]=function(){var e,r=[...arguments],o={};t.emit(n+"before-start",[r],o),o[Q.P]&&o[Q.P].dt&&(e=o[Q.P].dt);var a=i.apply(this,r);return t.emit(n+"start",[r,e],a),a.then((function(e){return t.emit(n+"end",[null,e],a),e}),(function(e){throw t.emit(n+"end",[e],a),e}))})}return de[t.debugId]=1,ae.forEach((e=>{r(se[ue],e,oe),r(ce[ue],e,oe)})),r(y.gm,"fetch",ie),t.on(ie+"end",(function(e,r){var n=this;if(r){var i=r.headers.get("content-length");null!==i&&(n.rxSize=i),t.emit(ie+"done",[null,r],n)}else t.emit(ie+"done",[e],n)})),t}var fe=i(7485);class he{constructor(e){this.agentRef=e}generateTracePayload(t){const r=this.agentRef.loader_config;if(!this.shouldGenerateTrace(t)||!r)return null;var n=(r.accountID||"").toString()||null,i=(r.agentID||"").toString()||null,o=(r.trustKey||"").toString()||null;if(!n||!i)return null;var a=(0,e.ZF)(),s=(0,e.el)(),c=Date.now(),u={spanId:a,traceId:s,timestamp:c};return(t.sameOrigin||this.isAllowedOrigin(t)&&this.useTraceContextHeadersForCors())&&(u.traceContextParentHeader=this.generateTraceContextParentHeader(a,s),u.traceContextStateHeader=this.generateTraceContextStateHeader(a,c,n,i,o)),(t.sameOrigin&&!this.excludeNewrelicHeader()||!t.sameOrigin&&this.isAllowedOrigin(t)&&this.useNewrelicHeaderForCors())&&(u.newrelicHeader=this.generateTraceHeader(a,s,c,n,i,o)),u}generateTraceContextParentHeader(e,t){return"00-"+t+"-"+e+"-01"}generateTraceContextStateHeader(e,t,r,n,i){return i+"@nr=0-1-"+r+"-"+n+"-"+e+"----"+t}generateTraceHeader(e,t,r,n,i,o){if(!("function"==typeof y.gm?.btoa))return null;var a={v:[0,1],d:{ty:"Browser",ac:n,ap:i,id:e,tr:t,ti:r}};return o&&n!==o&&(a.d.tk=o),btoa((0,k.A)(a))}shouldGenerateTrace(e){return this.agentRef.init?.distributed_tracing&&this.isAllowedOrigin(e)}isAllowedOrigin(e){var t=!1;const r=this.agentRef.init?.distributed_tracing;if(e.sameOrigin)t=!0;else if(r?.allowed_origins instanceof Array)for(var n=0;n<r.allowed_origins.length;n++){var i=(0,fe.D)(r.allowed_origins[n]);if(e.hostname===i.hostname&&e.protocol===i.protocol&&e.port===i.port){t=!0;break}}return t}excludeNewrelicHeader(){var e=this.agentRef.init?.distributed_tracing;return!!e&&!!e.exclude_newrelic_header}useNewrelicHeaderForCors(){var e=this.agentRef.init?.distributed_tracing;return!!e&&!1!==e.cors_use_newrelic_header}useTraceContextHeadersForCors(){var e=this.agentRef.init?.distributed_tracing;return!!e&&!!e.cors_use_tracecontext_headers}}var pe=i(9300),ge=i(7295),me=["load","error","abort","timeout"],ve=me.length,be=(0,S.dV)().o.REQ,ye=(0,S.dV)().o.XHR;const Re="X-NewRelic-App-Data";class we extends T{static featureName=pe.T;constructor(e){super(e,pe.T),this.dt=new he(e),this.handler=(e,t,r,n)=>(0,s.p)(e,t,r,n,this.ee);try{const e={xmlhttprequest:"xhr",fetch:"fetch",beacon:"beacon"};y.gm?.performance?.getEntriesByType("resource").forEach((t=>{if(t.initiatorType in e&&0!==t.responseStatus){const r={status:t.responseStatus},i={rxSize:t.transferSize,duration:Math.floor(t.duration),cbTime:0};xe(r,t.name),this.handler("xhr",[r,i,t.startTime,t.responseEnd,e[t.initiatorType]],void 0,n.K7.ajax)}}))}catch(e){}le(this.ee),ne(this.ee),function(e,t,r,i){function o(e){var t=this;t.totalCbs=0,t.called=0,t.cbTime=0,t.end=A,t.ended=!1,t.xhrGuids={},t.lastSize=null,t.loadCaptureCalled=!1,t.params=this.params||{},t.metrics=this.metrics||{},e.addEventListener("load",(function(r){E(t,e)}),(0,N.jT)(!1)),y.lR||e.addEventListener("progress",(function(e){t.lastSize=e.loaded}),(0,N.jT)(!1))}function a(e){this.params={method:e[0]},xe(this,e[1]),this.metrics={}}function u(t,r){e.loader_config.xpid&&this.sameOrigin&&r.setRequestHeader("X-NewRelic-ID",e.loader_config.xpid);var n=i.generateTracePayload(this.parsedOrigin);if(n){var o=!1;n.newrelicHeader&&(r.setRequestHeader("newrelic",n.newrelicHeader),o=!0),n.traceContextParentHeader&&(r.setRequestHeader("traceparent",n.traceContextParentHeader),n.traceContextStateHeader&&r.setRequestHeader("tracestate",n.traceContextStateHeader),o=!0),o&&(this.dt=n)}}function d(e,r){var n=this.metrics,i=e[0],o=this;if(n&&i){var a=Y(i);a&&(n.txSize=a)}this.startTime=(0,c.t)(),this.body=i,this.listener=function(e){try{"abort"!==e.type||o.loadCaptureCalled||(o.params.aborted=!0),("load"!==e.type||o.called===o.totalCbs&&(o.onloadCalled||"function"!=typeof r.onload)&&"function"==typeof o.end)&&o.end(r)}catch(e){try{t.emit("internal-error",[e])}catch(e){}}};for(var s=0;s<ve;s++)r.addEventListener(me[s],this.listener,(0,N.jT)(!1))}function l(e,t,r){this.cbTime+=e,t?this.onloadCalled=!0:this.called+=1,this.called!==this.totalCbs||!this.onloadCalled&&"function"==typeof r.onload||"function"!=typeof this.end||this.end(r)}function f(e,t){var r=""+X(e)+!!t;this.xhrGuids&&!this.xhrGuids[r]&&(this.xhrGuids[r]=!0,this.totalCbs+=1)}function p(e,t){var r=""+X(e)+!!t;this.xhrGuids&&this.xhrGuids[r]&&(delete this.xhrGuids[r],this.totalCbs-=1)}function g(){this.endTime=(0,c.t)()}function m(e,r){r instanceof ye&&"load"===e[0]&&t.emit("xhr-load-added",[e[1],e[2]],r)}function v(e,r){r instanceof ye&&"load"===e[0]&&t.emit("xhr-load-removed",[e[1],e[2]],r)}function b(e,t,r){t instanceof ye&&("onload"===r&&(this.onload=!0),("load"===(e[0]&&e[0].type)||this.onload)&&(this.xhrCbStart=(0,c.t)()))}function R(e,r){this.xhrCbStart&&t.emit("xhr-cb-time",[(0,c.t)()-this.xhrCbStart,this.onload,r],r)}function w(e){var t,r=e[1]||{};if("string"==typeof e[0]?0===(t=e[0]).length&&y.RI&&(t=""+y.gm.location.href):e[0]&&e[0].url?t=e[0].url:y.gm?.URL&&e[0]&&e[0]instanceof URL?t=e[0].href:"function"==typeof e[0].toString&&(t=e[0].toString()),"string"==typeof t&&0!==t.length){t&&(this.parsedOrigin=(0,fe.D)(t),this.sameOrigin=this.parsedOrigin.sameOrigin);var n=i.generateTracePayload(this.parsedOrigin);if(n&&(n.newrelicHeader||n.traceContextParentHeader))if(e[0]&&e[0].headers)s(e[0].headers,n)&&(this.dt=n);else{var o={};for(var a in r)o[a]=r[a];o.headers=new Headers(r.headers||{}),s(o.headers,n)&&(this.dt=n),e.length>1?e[1]=o:e.push(o)}}function s(e,t){var r=!1;return t.newrelicHeader&&(e.set("newrelic",t.newrelicHeader),r=!0),t.traceContextParentHeader&&(e.set("traceparent",t.traceContextParentHeader),t.traceContextStateHeader&&e.set("tracestate",t.traceContextStateHeader),r=!0),r}}function x(e,t){this.params={},this.metrics={},this.startTime=(0,c.t)(),this.dt=t,e.length>=1&&(this.target=e[0]),e.length>=2&&(this.opts=e[1]);var r,n=this.opts||{},i=this.target;"string"==typeof i?r=i:"object"==typeof i&&i instanceof be?r=i.url:y.gm?.URL&&"object"==typeof i&&i instanceof URL&&(r=i.href),xe(this,r);var o=(""+(i&&i instanceof be&&i.method||n.method||"GET")).toUpperCase();this.params.method=o,this.body=n.body,this.txSize=Y(n.body)||0}function T(e,t){if(this.endTime=(0,c.t)(),this.params||(this.params={}),(0,ge.iW)(this.params))return;let i;this.params.status=t?t.status:0,"string"==typeof this.rxSize&&this.rxSize.length>0&&(i=+this.rxSize);const o={txSize:this.txSize,rxSize:i,duration:(0,c.t)()-this.startTime};r("xhr",[this.params,o,this.startTime,this.endTime,"fetch"],this,n.K7.ajax)}function A(e){const t=this.params,i=this.metrics;if(!this.ended){this.ended=!0;for(let t=0;t<ve;t++)e.removeEventListener(me[t],this.listener,!1);t.aborted||(0,ge.iW)(t)||(i.duration=(0,c.t)()-this.startTime,this.loadCaptureCalled||4!==e.readyState?null==t.status&&(t.status=0):E(this,e),i.cbTime=this.cbTime,r("xhr",[t,i,this.startTime,this.endTime,"xhr"],this,n.K7.ajax))}}function E(e,r){e.params.status=r.status;var i=function(e,t){var r=e.responseType;return"json"===r&&null!==t?t:"arraybuffer"===r||"blob"===r||"json"===r?Y(e.response):"text"===r||""===r||void 0===r?Y(e.responseText):void 0}(r,e.lastSize);if(i&&(e.metrics.rxSize=i),e.sameOrigin&&r.getAllResponseHeaders().indexOf(Re)>=0){var o=r.getResponseHeader(Re);o&&((0,s.p)(h.rs,["Ajax/CrossApplicationTracing/Header/Seen"],void 0,n.K7.metrics,t),e.params.cat=o.split(", ").pop())}e.loadCaptureCalled=!0}t.on("new-xhr",o),t.on("open-xhr-start",a),t.on("open-xhr-end",u),t.on("send-xhr-start",d),t.on("xhr-cb-time",l),t.on("xhr-load-added",f),t.on("xhr-load-removed",p),t.on("xhr-resolved",g),t.on("addEventListener-end",m),t.on("removeEventListener-end",v),t.on("fn-end",R),t.on("fetch-before-start",w),t.on("fetch-start",x),t.on("fn-start",b),t.on("fetch-done",T)}(e,this.ee,this.handler,this.dt),this.importAggregator(e,(()=>i.e(478).then(i.bind(i,3845))))}}function xe(e,t){var r=(0,fe.D)(t),n=e.params||e;n.hostname=r.hostname,n.port=r.port,n.protocol=r.protocol,n.host=r.hostname+":"+r.port,n.pathname=r.pathname,e.parsedOrigin=r,e.sameOrigin=r.sameOrigin}const Te={},Ae=["pushState","replaceState"];function Ee(e){const t=function(e){return(e||Q.ee).get("history")}(e);return!y.RI||Te[t.debugId]++||(Te[t.debugId]=1,(0,ee.YM)(t).inPlace(window.history,Ae,"-")),t}var Se=i(3738);function _e(e){p(u.BL,(function(t=(0,c.t)()){(0,s.p)(h.XG,[u.BL,{time:t}],void 0,n.K7.metrics,e.ee),e.addToTrace({name:u.BL,start:t+y.WN,origin:"nr"}),(0,s.p)(u.Pl+u.hG,[t,u.BL],void 0,n.K7.genericEvents,e.ee)}),e)}const{He:Ne,bD:Oe,d3:Pe,Kp:Ie,TZ:je,Lc:ke,uP:Ce,Rz:Le}=Se;class He extends T{static featureName=je;constructor(e){var t;super(e,je),t=e,p(u.U2,(function(e){if(!(e&&"object"==typeof e&&e.name&&e.start))return;const r={n:e.name,s:e.start-y.WN,e:(e.end||e.start)-y.WN,o:e.origin||"",t:"api"};(0,s.p)("bstApi",[r],void 0,n.K7.sessionTrace,t.ee)}),t),_e(e);if(!(0,w.V)(e.init))return void this.deregisterDrain();const r=this.ee;let o;Ee(r),this.eventsEE=(0,J.u)(r),this.eventsEE.on(Ce,(function(e,t){this.bstStart=(0,c.t)()})),this.eventsEE.on(ke,(function(e,t){(0,s.p)("bst",[e[0],t,this.bstStart,(0,c.t)()],void 0,n.K7.sessionTrace,r)})),r.on(Le+Pe,(function(e){this.time=(0,c.t)(),this.startPath=location.pathname+location.hash})),r.on(Le+Ie,(function(e){(0,s.p)("bstHist",[location.pathname+location.hash,this.startPath,this.time],void 0,n.K7.sessionTrace,r)}));try{o=new PerformanceObserver((e=>{const t=e.getEntries();(0,s.p)(Ne,[t],void 0,n.K7.sessionTrace,r)})),o.observe({type:Oe,buffered:!0})}catch(e){}this.importAggregator(e,(()=>i.e(478).then(i.bind(i,575))),{resourceObserver:o})}}var Me=i(2614),De=i(6344);class Ke extends T{static featureName=De.TZ;#n;#i;constructor(e){var t;let r;super(e,De.TZ),t=e,p(u.CH,(function(){(0,s.p)(u.CH,[],void 0,n.K7.sessionReplay,t.ee)}),t),function(e){p(u.Tb,(function(){(0,s.p)(u.Tb,[],void 0,n.K7.sessionReplay,e.ee)}),e)}(e),this.#i=e;try{r=JSON.parse(localStorage.getItem("".concat(Me.H3,"_").concat(Me.uh)))}catch(e){}(0,R.SR)(e.init)&&this.ee.on(De.G4.RECORD,(()=>this.#o())),this.#a(r)?(this.#n=r?.sessionReplayMode,this.#s()):this.importAggregator(this.#i,(()=>i.e(478).then(i.bind(i,6167)))),this.ee.on("err",(e=>{this.#i.runtime.isRecording&&(this.errorNoticed=!0,(0,s.p)(De.G4.ERROR_DURING_REPLAY,[e],void 0,this.featureName,this.ee))}))}#a(e){return e&&(e.sessionReplayMode===Me.g.FULL||e.sessionReplayMode===Me.g.ERROR)||(0,R.Aw)(this.#i.init)}#c=!1;async#s(e){if(!this.#c){this.#c=!0;try{const{Recorder:t}=await Promise.all([i.e(478),i.e(249)]).then(i.bind(i,8589));this.recorder??=new t({mode:this.#n,agentIdentifier:this.agentIdentifier,trigger:e,ee:this.ee,agentRef:this.#i}),this.recorder.startRecording(),this.abortHandler=this.recorder.stopRecording}catch(e){this.parent.ee.emit("internal-error",[e])}this.importAggregator(this.#i,(()=>i.e(478).then(i.bind(i,6167))),{recorder:this.recorder,errorNoticed:this.errorNoticed})}}#o(){this.featAggregate?this.featAggregate.mode!==Me.g.FULL&&this.featAggregate.initializeRecording(Me.g.FULL,!0):(this.#n=Me.g.FULL,this.#s(De.Qb.API),this.recorder&&this.recorder.parent.mode!==Me.g.FULL&&(this.recorder.parent.mode=Me.g.FULL,this.recorder.stopRecording(),this.recorder.startRecording(),this.abortHandler=this.recorder.stopRecording))}}var Ue=i(3962);function Fe(e){const t=e.ee.get("tracer");function r(){}p(u.dT,(function(e){return(new r).get("object"==typeof e?e:{})}),e);const i=r.prototype={createTracer:function(r,i){var o={},a=this,d="function"==typeof i;return(0,s.p)(h.xV,["API/createTracer/called"],void 0,n.K7.metrics,e.ee),e.runSoftNavOverSpa||(0,s.p)(u.hw+"tracer",[(0,c.t)(),r,o],a,n.K7.spa,e.ee),function(){if(t.emit((d?"":"no-")+"fn-start",[(0,c.t)(),a,d],o),d)try{return i.apply(this,arguments)}catch(e){const r="string"==typeof e?new Error(e):e;throw t.emit("fn-err",[arguments,this,r],o),r}finally{t.emit("fn-end",[(0,c.t)()],o)}}}};["actionText","setName","setAttribute","save","ignore","onEnd","getContext","end","get"].forEach((t=>{p.apply(this,[t,function(){return(0,s.p)(u.hw+t,[(0,c.t)(),...arguments],this,e.runSoftNavOverSpa?n.K7.softNav:n.K7.spa,e.ee),this},e,i])})),p(u.PA,(function(){e.runSoftNavOverSpa?(0,s.p)(u.hw+"routeName",[performance.now(),...arguments],void 0,n.K7.softNav,e.ee):(0,s.p)(u.Pl+"routeName",[(0,c.t)(),...arguments],this,n.K7.spa,e.ee)}),e)}class We extends T{static featureName=Ue.TZ;constructor(e){if(super(e,Ue.TZ),Fe(e),!y.RI||!(0,S.dV)().o.MO)return;const t=Ee(this.ee);Ue.tC.forEach((e=>{(0,N.sp)(e,(e=>{a(e)}),!0)}));const r=()=>(0,s.p)("newURL",[(0,c.t)(),""+window.location],void 0,this.featureName,this.ee);t.on("pushState-end",r),t.on("replaceState-end",r);try{this.removeOnAbort=new AbortController}catch(e){}(0,N.sp)("popstate",(e=>(0,s.p)("newURL",[e.timeStamp,""+window.location],void 0,this.featureName,this.ee)),!0,this.removeOnAbort?.signal);let n=!1;const o=new((0,S.dV)().o.MO)(((e,t)=>{n||(n=!0,requestAnimationFrame((()=>{(0,s.p)("newDom",[(0,c.t)()],void 0,this.featureName,this.ee),n=!1})))})),a=(0,x.s)((e=>{(0,s.p)("newUIEvent",[e],void 0,this.featureName,this.ee),o.observe(document.body,{attributes:!0,childList:!0,subtree:!0,characterData:!0})}),100,{leading:!0});this.abortHandler=function(){this.removeOnAbort?.abort(),o.disconnect(),this.abortHandler=void 0},this.importAggregator(e,(()=>i.e(478).then(i.bind(i,4393))),{domObserver:o})}}var Be=i(7378);const Ge={},Ve=["appendChild","insertBefore","replaceChild"];function ze(e){const t=function(e){return(e||Q.ee).get("jsonp")}(e);if(!y.RI||Ge[t.debugId])return t;Ge[t.debugId]=!0;var r=(0,ee.YM)(t),n=/[?&](?:callback|cb)=([^&#]+)/,i=/(.*)\.([^.]+)/,o=/^(\w+)(\.|$)(.*)$/;function a(e,t){if(!e)return t;const r=e.match(o),n=r[1];return a(r[3],t[n])}return r.inPlace(Node.prototype,Ve,"dom-"),t.on("dom-start",(function(e){!function(e){if(!e||"string"!=typeof e.nodeName||"script"!==e.nodeName.toLowerCase())return;if("function"!=typeof e.addEventListener)return;var o=(s=e.src,c=s.match(n),c?c[1]:null);var s,c;if(!o)return;var u=function(e){var t=e.match(i);if(t&&t.length>=3)return{key:t[2],parent:a(t[1],window)};return{key:e,parent:window}}(o);if("function"!=typeof u.parent[u.key])return;var d={};function l(){t.emit("jsonp-end",[],d),e.removeEventListener("load",l,(0,N.jT)(!1)),e.removeEventListener("error",f,(0,N.jT)(!1))}function f(){t.emit("jsonp-error",[],d),t.emit("jsonp-end",[],d),e.removeEventListener("load",l,(0,N.jT)(!1)),e.removeEventListener("error",f,(0,N.jT)(!1))}r.inPlace(u.parent,[u.key],"cb-",d),e.addEventListener("load",l,(0,N.jT)(!1)),e.addEventListener("error",f,(0,N.jT)(!1)),t.emit("new-jsonp",[e.src],d)}(e[0])})),t}const Ze={};function qe(e){const t=function(e){return(e||Q.ee).get("promise")}(e);if(Ze[t.debugId])return t;Ze[t.debugId]=!0;var r=t.context,n=(0,ee.YM)(t),i=y.gm.Promise;return i&&function(){function e(r){var o=t.context(),a=n(r,"executor-",o,null,!1);const s=Reflect.construct(i,[a],e);return t.context(s).getCtx=function(){return o},s}y.gm.Promise=e,Object.defineProperty(e,"name",{value:"Promise"}),e.toString=function(){return i.toString()},Object.setPrototypeOf(e,i),["all","race"].forEach((function(r){const n=i[r];e[r]=function(e){let i=!1;[...e||[]].forEach((e=>{this.resolve(e).then(a("all"===r),a(!1))}));const o=n.apply(this,arguments);return o;function a(e){return function(){t.emit("propagate",[null,!i],o,!1,!1),i=i||!e}}}})),["resolve","reject"].forEach((function(r){const n=i[r];e[r]=function(e){const r=n.apply(this,arguments);return e!==r&&t.emit("propagate",[e,!0],r,!1,!1),r}})),e.prototype=i.prototype;const o=i.prototype.then;i.prototype.then=function(...e){var i=this,a=r(i);a.promise=i,e[0]=n(e[0],"cb-",a,null,!1),e[1]=n(e[1],"cb-",a,null,!1);const s=o.apply(this,e);return a.nextPromise=s,t.emit("propagate",[i,!0],s,!1,!1),s},i.prototype.then[ee.Jt]=o,t.on("executor-start",(function(e){e[0]=n(e[0],"resolve-",this,null,!1),e[1]=n(e[1],"resolve-",this,null,!1)})),t.on("executor-err",(function(e,t,r){e[1](r)})),t.on("cb-end",(function(e,r,n){t.emit("propagate",[n,!0],this.nextPromise,!1,!1)})),t.on("propagate",(function(e,r,n){this.getCtx&&!r||(this.getCtx=function(){if(e instanceof Promise)var r=t.context(e);return r&&r.getCtx?r.getCtx():this})}))}(),t}const Xe={},Ye="setTimeout",$e="setInterval",Je="clearTimeout",Qe="-start",et=[Ye,"setImmediate",$e,Je,"clearImmediate"];function tt(e){const t=function(e){return(e||Q.ee).get("timer")}(e);if(Xe[t.debugId]++)return t;Xe[t.debugId]=1;var r=(0,ee.YM)(t);return r.inPlace(y.gm,et.slice(0,2),Ye+"-"),r.inPlace(y.gm,et.slice(2,3),$e+"-"),r.inPlace(y.gm,et.slice(3),Je+"-"),t.on($e+Qe,(function(e,t,n){e[0]=r(e[0],"fn-",null,n)})),t.on(Ye+Qe,(function(e,t,n){this.method=n,this.timerDuration=isNaN(e[1])?0:+e[1],e[0]=r(e[0],"fn-",this,n)})),t}const rt={};function nt(e){const t=function(e){return(e||Q.ee).get("mutation")}(e);if(!y.RI||rt[t.debugId])return t;rt[t.debugId]=!0;var r=(0,ee.YM)(t),n=y.gm.MutationObserver;return n&&(window.MutationObserver=function(e){return this instanceof n?new n(r(e,"fn-")):n.apply(this,arguments)},MutationObserver.prototype=n.prototype),t}const{TZ:it,d3:ot,Kp:at,$p:st,wW:ct,e5:ut,tH:dt,uP:lt,rw:ft,Lc:ht}=Be;class pt extends T{static featureName=it;constructor(e){if(super(e,it),Fe(e),!y.RI)return;try{this.removeOnAbort=new AbortController}catch(e){}let t,r=0;const n=this.ee.get("tracer"),o=ze(this.ee),a=qe(this.ee),u=tt(this.ee),d=ne(this.ee),l=this.ee.get("events"),f=le(this.ee),h=Ee(this.ee),p=nt(this.ee);function g(e,t){h.emit("newURL",[""+window.location,t])}function m(){r++,t=window.location.hash,this[lt]=(0,c.t)()}function v(){r--,window.location.hash!==t&&g(0,!0);var e=(0,c.t)();this[ut]=~~this[ut]+e-this[lt],this[ht]=e}function b(e,t){e.on(t,(function(){this[t]=(0,c.t)()}))}this.ee.on(lt,m),a.on(ft,m),o.on(ft,m),this.ee.on(ht,v),a.on(ct,v),o.on(ct,v),this.ee.on("fn-err",((...t)=>{t[2]?.__newrelic?.[e.agentIdentifier]||(0,s.p)("function-err",[...t],void 0,this.featureName,this.ee)})),this.ee.buffer([lt,ht,"xhr-resolved"],this.featureName),l.buffer([lt],this.featureName),u.buffer(["setTimeout"+at,"clearTimeout"+ot,lt],this.featureName),d.buffer([lt,"new-xhr","send-xhr"+ot],this.featureName),f.buffer([dt+ot,dt+"-done",dt+st+ot,dt+st+at],this.featureName),h.buffer(["newURL"],this.featureName),p.buffer([lt],this.featureName),a.buffer(["propagate",ft,ct,"executor-err","resolve"+ot],this.featureName),n.buffer([lt,"no-"+lt],this.featureName),o.buffer(["new-jsonp","cb-start","jsonp-error","jsonp-end"],this.featureName),b(f,dt+ot),b(f,dt+"-done"),b(o,"new-jsonp"),b(o,"jsonp-end"),b(o,"cb-start"),h.on("pushState-end",g),h.on("replaceState-end",g),window.addEventListener("hashchange",g,(0,N.jT)(!0,this.removeOnAbort?.signal)),window.addEventListener("load",g,(0,N.jT)(!0,this.removeOnAbort?.signal)),window.addEventListener("popstate",(function(){g(0,r>1)}),(0,N.jT)(!0,this.removeOnAbort?.signal)),this.abortHandler=this.#r,this.importAggregator(e,(()=>i.e(478).then(i.bind(i,5592))))}#r(){this.removeOnAbort?.abort(),this.abortHandler=void 0}}var gt=i(3333);class mt extends T{static featureName=gt.TZ;constructor(e){super(e,gt.TZ);const t=[e.init.page_action.enabled,e.init.performance.capture_marks,e.init.performance.capture_measures,e.init.user_actions.enabled,e.init.performance.resources.enabled];var r;if(r=e,p(u.hG,((e,t)=>G(e,t,r)),r),function(e){p(u.fF,(function(){(0,s.p)(u.Pl+u.fF,[(0,c.t)(),...arguments],void 0,n.K7.genericEvents,e.ee)}),e)}(e),_e(e),V(e),function(e){p(u.V1,(function(t,r){const i=(0,c.t)(),{start:o,end:a,customAttributes:d}=r||{},f={customAttributes:d||{}};if("object"!=typeof f.customAttributes||"string"!=typeof t||0===t.length)return void(0,l.R)(57);const h=(e,t)=>null==e?t:"number"==typeof e?e:e instanceof PerformanceMark?e.startTime:Number.NaN;if(f.start=h(o,0),f.end=h(a,i),Number.isNaN(f.start)||Number.isNaN(f.end))(0,l.R)(57);else{if(f.duration=f.end-f.start,!(f.duration<0))return(0,s.p)(u.Pl+u.V1,[f,t],void 0,n.K7.genericEvents,e.ee),f;(0,l.R)(58)}}),e)}(e),y.RI&&(e.init.user_actions.enabled&&(gt.Zp.forEach((e=>(0,N.sp)(e,(e=>(0,s.p)("ua",[e],void 0,this.featureName,this.ee)),!0))),gt.qN.forEach((e=>{const t=(0,x.s)((e=>{(0,s.p)("ua",[e],void 0,this.featureName,this.ee)}),500,{leading:!0});(0,N.sp)(e,t)}))),e.init.performance.resources.enabled&&y.gm.PerformanceObserver?.supportedEntryTypes.includes("resource"))){new PerformanceObserver((e=>{e.getEntries().forEach((e=>{(0,s.p)("browserPerformance.resource",[e],void 0,this.featureName,this.ee)}))})).observe({type:"resource",buffered:!0})}t.some((e=>e))?this.importAggregator(e,(()=>i.e(478).then(i.bind(i,8019)))):this.deregisterDrain()}}var vt=i(2646);const bt=new Map;function yt(e,t,r,n){if("object"!=typeof t||!t||"string"!=typeof r||!r||"function"!=typeof t[r])return(0,l.R)(29);const i=function(e){return(e||Q.ee).get("logger")}(e),o=(0,ee.YM)(i),a=new vt.y(Q.P);a.level=n.level,a.customAttributes=n.customAttributes;const s=t[r]?.[ee.Jt]||t[r];return bt.set(s,a),o.inPlace(t,[r],"wrap-logger-",(()=>bt.get(s))),i}class Rt extends T{static featureName=F.TZ;constructor(e){var t;super(e,F.TZ),t=e,p(u.$9,((e,r)=>B(e,r,t)),t),function(e){p(u.Wb,((t,r,{customAttributes:n={},level:i=F.p_.INFO}={})=>{yt(e.ee,t,r,{customAttributes:n,level:i})}),e)}(e),V(e);const r=this.ee;yt(r,y.gm.console,"log",{level:"info"}),yt(r,y.gm.console,"error",{level:"error"}),yt(r,y.gm.console,"warn",{level:"warn"}),yt(r,y.gm.console,"info",{level:"info"}),yt(r,y.gm.console,"debug",{level:"debug"}),yt(r,y.gm.console,"trace",{level:"trace"}),this.ee.on("wrap-logger-end",(function([e]){const{level:t,customAttributes:n}=this;(0,W.R)(r,e,n,t)})),this.importAggregator(e,(()=>i.e(478).then(i.bind(i,5288))))}}new class extends r{constructor(e){var t;(super(),y.gm)?(this.features={},(0,S.bQ)(this.agentIdentifier,this),this.desiredFeatures=new Set(e.features||[]),this.desiredFeatures.add(E),this.runSoftNavOverSpa=[...this.desiredFeatures].some((e=>e.featureName===n.K7.softNav)),(0,a.j)(this,e,e.loaderType||"agent"),t=this,p(u.cD,(function(e,r,n=!1){if("string"==typeof e){if(["string","number","boolean"].includes(typeof r)||null===r)return g(t,e,r,u.cD,n);(0,l.R)(40,typeof r)}else(0,l.R)(39,typeof e)}),t),function(e){p(u.Dl,(function(t){if("string"==typeof t||null===t)return g(e,"enduser.id",t,u.Dl,!0);(0,l.R)(41,typeof t)}),e)}(this),function(e){p(u.nb,(function(t){if("string"==typeof t||null===t)return g(e,"application.version",t,u.nb,!1);(0,l.R)(42,typeof t)}),e)}(this),function(e){p(u.d3,(function(){e.ee.emit("manual-start-all")}),e)}(this),this.run()):(0,l.R)(21)}get config(){return{info:this.info,init:this.init,loader_config:this.loader_config,runtime:this.runtime}}get api(){return this}run(){try{const e=function(e){const t={};return o.forEach((r=>{t[r]=!!e[r]?.enabled})),t}(this.init),t=[...this.desiredFeatures];t.sort(((e,t)=>n.P3[e.featureName]-n.P3[t.featureName])),t.forEach((t=>{if(!e[t.featureName]&&t.featureName!==n.K7.pageViewEvent)return;if(this.runSoftNavOverSpa&&t.featureName===n.K7.spa)return;if(!this.runSoftNavOverSpa&&t.featureName===n.K7.softNav)return;const r=function(e){switch(e){case n.K7.ajax:return[n.K7.jserrors];case n.K7.sessionTrace:return[n.K7.ajax,n.K7.pageViewEvent];case n.K7.sessionReplay:return[n.K7.sessionTrace];case n.K7.pageViewTiming:return[n.K7.pageViewEvent];default:return[]}}(t.featureName).filter((e=>!(e in this.features)));r.length>0&&(0,l.R)(36,{targetFeature:t.featureName,missingDependencies:r}),this.features[t.featureName]=new t(this)}))}catch(e){(0,l.R)(22,e);for(const e in this.features)this.features[e].abortHandler?.();const t=(0,S.Zm)();delete t.initializedAgents[this.agentIdentifier]?.features,delete this.sharedAggregator;return t.ee.get(this.agentIdentifier).abort(),!1}}}({features:[we,E,P,He,Ke,I,z,mt,Rt,We,pt],loaderType:"spa"})})()})();
</script>


    <?php
});

//New relic RUM integration  --ending 

//for listing purpose 
//
//

//new


//custom search
// Register AJAX handlers
add_action('wp_ajax_acf_live_search', 'acf_live_search');
add_action('wp_ajax_nopriv_acf_live_search', 'acf_live_search');

// Function to rank post IDs based on keyword relevance
function get_ranked_post_ids_by_keyword($keyword) {
    global $wpdb;
    $keyword_like = '%' . $wpdb->esc_like($keyword) . '%';
    $posts = [];

    $thank_you_page = get_page_by_path('thank-you');
    $exclude_id = $thank_you_page ? $thank_you_page->ID : null;

    // Title match
    $title_matches = $wpdb->get_results($wpdb->prepare(
        "SELECT ID, post_type, post_date FROM $wpdb->posts
         WHERE post_status = 'publish' AND post_type IN ('post', 'page')
         AND post_title LIKE %s", $keyword_like));
    foreach ($title_matches as $post) {
        if ($exclude_id && $post->ID == $exclude_id) continue;
        $posts[$post->ID] = ['score' => 100, 'type' => $post->post_type, 'date' => $post->post_date];
    }

    // Content match
    $content_matches = $wpdb->get_results($wpdb->prepare(
        "SELECT ID, post_type, post_date FROM $wpdb->posts
         WHERE post_status = 'publish' AND post_type IN ('post', 'page')
         AND post_content LIKE %s", $keyword_like));
    foreach ($content_matches as $post) {
        if ($exclude_id && $post->ID == $exclude_id) continue;
        $posts[$post->ID]['score'] = ($posts[$post->ID]['score'] ?? 70) + 20;
        $posts[$post->ID]['type'] = $post->post_type;
        $posts[$post->ID]['date'] = $post->post_date;
    }

    // Slug match
    $slug_matches = $wpdb->get_results($wpdb->prepare(
        "SELECT ID, post_type, post_date FROM $wpdb->posts
         WHERE post_status = 'publish' AND post_type IN ('post', 'page')
         AND post_name LIKE %s", $keyword_like));
    foreach ($slug_matches as $post) {
        if ($exclude_id && $post->ID == $exclude_id) continue;
        $posts[$post->ID]['score'] = ($posts[$post->ID]['score'] ?? 60) + 10;
        $posts[$post->ID]['type'] = $post->post_type;
        $posts[$post->ID]['date'] = $post->post_date;
    }

    // ACF/meta match
    $acf_matches = $wpdb->get_results($wpdb->prepare(
        "SELECT post_id FROM $wpdb->postmeta WHERE meta_value LIKE %s", $keyword_like));
    foreach ($acf_matches as $meta) {
        if ($exclude_id && $meta->post_id == $exclude_id) continue;
        $post_data = get_post($meta->post_id);
        if ($post_data && $post_data->post_status === 'publish' && in_array($post_data->post_type, ['post', 'page'])) {
            $posts[$meta->post_id]['score'] = ($posts[$meta->post_id]['score'] ?? 50) + 10;
            $posts[$meta->post_id]['type'] = $post_data->post_type;
            $posts[$meta->post_id]['date'] = $post_data->post_date;
        }
    }

    // Taxonomy match
    $term_matches = get_terms([
        'taxonomy'   => ['category', 'post_tag', 'post_type_category'],
        'hide_empty' => true,
        'search'     => $keyword,
    ]);
    foreach ($term_matches as $term) {
        $term_posts = get_posts([
            'post_type'      => ['post', 'page'],
            'post_status'    => 'publish',
            'posts_per_page' => -1,
            'tax_query'      => [[
                'taxonomy' => $term->taxonomy,
                'field'    => 'slug',
                'terms'    => $term->slug,
            ]]
        ]);
        foreach ($term_posts as $post) {
            if ($exclude_id && $post->ID == $exclude_id) continue;
            $posts[$post->ID]['score'] = ($posts[$post->ID]['score'] ?? 40) + 5;
            $posts[$post->ID]['type'] = $post->post_type;
            $posts[$post->ID]['date'] = $post->post_date;
        }
    }

    uasort($posts, function ($a, $b) {
        return $b['score'] <=> $a['score'] ?: strcmp($a['type'], $b['type']) ?: strtotime($b['date']) <=> strtotime($a['date']);
    });

    return array_keys($posts);
}

// AJAX Search Handler
function acf_live_search() {
    global $wpdb;
    $keyword = isset($_POST['keyword']) ? trim(wp_unslash($_POST['keyword'])) : '';
    $results = [];
    $thank_you_page = get_page_by_path('thank-you');
    $exclude_id = $thank_you_page ? $thank_you_page->ID : null;

    if (mb_strlen($keyword) < 2 && !preg_match('/[^a-zA-Z0-9]/', $keyword)) {
        echo json_encode([['title' => 'No matching found. Try anything else.', 'url' => '#']]);
        wp_die();
    }

    if (strtolower($keyword) === 'posts') {
        $matched_posts = get_posts([
            'post_type'      => 'post',
            'post_status'    => 'publish',
            'posts_per_page' => 10,
            'orderby'        => 'date',
            'order'          => 'DESC',
        ]);
    } elseif (strtolower($keyword) === 'pages') {
        $pages = get_pages([
            'sort_column' => 'menu_order,post_title',
            'sort_order'  => 'ASC',
            'post_status' => 'publish',
        ]);
        $matched_posts = [];
        foreach ($pages as $page) {
            if ($exclude_id && $page->ID == $exclude_id) continue;
            $matched_posts[] = $page;
            if (count($matched_posts) >= 20) break;
        }
    } else {
        $post_ids = get_ranked_post_ids_by_keyword($keyword);
        if ($exclude_id) {
            $post_ids = array_filter($post_ids, fn($id) => $id !== $exclude_id);
        }
        $matched_posts = !empty($post_ids) ? get_posts([
            'post__in'       => $post_ids,
            'orderby'        => 'post__in',
            'post_type'      => ['post', 'page'],
            'post_status'    => 'publish',
            'posts_per_page' => 10,
        ]) : [];
    }

    $fallback_image_url = '/wp-content/uploads/2025/04/Home-Page-Banner-1-Video-Snippet-Bulb-Thumb-nail.webp'; 
    if (empty($matched_posts)) {
        $results[] = [
            'title'     => 'No matching found. Try anything else.',
            'url'       => '#',
            'image_url' => $fallback_image_url,
        ];
    } else {
        foreach ($matched_posts as $post) {
            if ($exclude_id && $post->ID == $exclude_id) continue;
            $image_url = get_the_post_thumbnail_url($post->ID, 'medium') ?: $fallback_image_url;
            $results[] = [
                'title'     => $post->post_title,
                'url'       => get_permalink($post->ID),
                'image_url' => $image_url,
            ];
        }
    }

    // Inject "Leadership" if ACF match found
    $keyword_like = '%' . $wpdb->esc_like($keyword) . '%';
    $acf_leader_match = $wpdb->get_var($wpdb->prepare(
        "SELECT COUNT(*) FROM $wpdb->postmeta pm
         INNER JOIN $wpdb->posts p ON pm.post_id = p.ID
         WHERE p.post_status = 'publish'
         AND p.post_type = 'leader'
         AND pm.meta_key = 'acf_leader_name'
         AND pm.meta_value LIKE %s", $keyword_like));
    if ($acf_leader_match > 0) {
        $leadership_page = get_page_by_path('leadership');
        if ($leadership_page && $leadership_page->ID !== $exclude_id) {
            $results[] = [
                'title'     => 'Leadership',
                'url'       => get_permalink($leadership_page->ID),
                'image_url' => $fallback_image_url,
            ];
        }
    }

    echo json_encode($results);
    wp_die();
}

// Exclude Thank You page from regular WordPress search
add_action('pre_get_posts', function ($query) {
    if ($query->is_main_query() && $query->is_search() && !is_admin()) {
        $thank_you_page = get_page_by_path('thank-you');
        if ($thank_you_page) {
            $existing_exclusions = (array) $query->get('post__not_in');
            $existing_exclusions[] = $thank_you_page->ID;
            $query->set('post__not_in', $existing_exclusions);
        }
        if (isset($_GET['paged']) && !$query->get('paged')) {
            $query->set('paged', (int) $_GET['paged']);
        }
    }
});

// Inject AJAX URL into frontend
add_action('wp_head', function () {
    ?>
    <script type="text/javascript">
        var search_ajax_obj = {
            ajaxurl: "<?php echo esc_js(admin_url('admin-ajax.php')); ?>"
        };
    </script>
    <?php
});
