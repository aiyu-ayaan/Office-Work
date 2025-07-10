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

function child_enqueue_styles()
{
    wp_enqueue_style('astra-child-theme-css', get_stylesheet_directory_uri() . '/style.css', array('astra-theme-css'), CHILD_THEME_ASTRA_CHILD_VERSION, 'all');

    // Your custom CSS files, identified by the glob() function output
    wp_enqueue_style('cookie-css', get_stylesheet_directory_uri() . '/css/cookie.css', array(), filemtime(get_stylesheet_directory() . '/css/cookie.css'), 'all');
    wp_enqueue_style('footer-css', get_stylesheet_directory_uri() . '/css/footer.css', array(), filemtime(get_stylesheet_directory() . '/css/footer.css'), 'all');
    wp_enqueue_style('global-settings-css', get_stylesheet_directory_uri() . '/css/global-settings.css', array(), filemtime(get_stylesheet_directory() . '/css/global-settings.css'), 'all');
    wp_enqueue_style('header-css', get_stylesheet_directory_uri() . '/css/header.css', array(), filemtime(get_stylesheet_directory() . '/css/header.css'), 'all');
}
add_action('wp_enqueue_scripts', 'child_enqueue_styles', 15);


function child_enqueue_scripts()
{
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
function enqueue_google_fonts()
{
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

function custom_logo_dynamic_url_script()
{
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
                if (isHeaderItemsHidden && !searchIcon.contains(event.target) && !(document.querySelector('.search-form')).contains(event.target)) {
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
//     header("Content-Security-Policy: default-src 'none'; script-src 'self' https://cdnjs.cloudflare.com https://www.googletagmanager.com go.website-dev.adrosonic.com cdn.jsdelivr.net https://www.google-analytics.com https://wordpressa-02147638b0-b9fmbyckh4cgashk.a01.azurefd.net https://websitedev-db0c5dadd1-endpoint.azureedge.net https://player.vimeo.com 'unsafe-inline'; style-src 'self' 'unsafe-inline' https://default-webapp-endpoint-9a734fc0-evgzcugwe7bgawfn.a03.azurefd.net https://websitedev-db0c5dadd1-endpoint.azureedge.net https://fonts.googleapis.com https://websitedev-db0c5dadd1-endpoint.azureedge.net https://cdnjs.cloudflare.com; connect-src 'self' go.website-dev.adrosonic.com cdn.jsdelivr.net https://api.ipgeolocation.io https://www.google-analytics.com; img-src 'self' https://wordpressa-02147638b0-b9fmbyckh4cgashk.a01.azurefd.net https://websitedev-db0c5dadd1-endpoint.azureedge.net data: https:; frame-src 'self' go.website-dev.adrosonic.com https://wordpressa-02147638b0-b9fmbyckh4cgashk.a01.azurefd.net https://www.adrosonic.com https://go.demo.pardot.com  https://player.vimeo.com; font-src 'self' https://websitedev-db0c5dadd1-endpoint.azureedge.net https://fonts.gstatic.com; media-src 'self' https://wordpressa-02147638b0-b9fmbyckh4cgashk.a01.azurefd.net https://websitedev-db0c5dadd1-endpoint.azureedge.net https://s3-figma-videos-production-sig.figma.com https://vimeo.com https://player.vimeo.com; block-all-mixed-content;");
// }
// add_action('send_headers', 'add_csp_header', 1);

//enqueue owl carousel scripts and styles
// enqueue owl carousel scripts and styles
function enqueue_owlcarousel_assets()
{
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

    $output .= '<script>';
    $output .= 'document.addEventListener("DOMContentLoaded", function () {
	const menuContainer = document.querySelector("#dropdown-4717");
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

    // Reset menu state when mouse leaves the dropdown container
    menuContainer.addEventListener("mouseleave", function () {
        menuItems.forEach((el) => el.classList.remove("active"));
        subMenus.forEach((subMenu) => subMenu.style.display = "none");
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


// TODO:My Code 


function get_minutes($post_id, $field_names = null, $videoId = null, $direct_content = null)
{
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

    // Check if direct_content is provided and calculate reading time
    if (!empty($direct_content)) {
        $direct_reading_time = calculate_direct_content_reading_time($direct_content);
        if ($direct_reading_time !== '0 minute read') {
            $results[] = $direct_reading_time;
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
function calculate_direct_content_reading_time($content)
{
    // Handle array of content
    if (is_array($content)) {
        $total_content = '';
        foreach ($content as $item) {
            if (is_array($item)) {
                // If nested array, flatten it
                $total_content .= ' ' . implode(' ', array_map(function ($subitem) {
                    // Handle null values and ensure we have a string
                    if ($subitem === null) {
                        return '';
                    }

                    $subitem = is_array($subitem) ? implode(' ', $subitem) : (string)$subitem;
                    return html_entity_decode($subitem, ENT_QUOTES | ENT_HTML5, 'UTF-8');
                }, $item));
            } else {
                // Handle null values before passing to html_entity_decode
                if ($item !== null) {
                    $total_content .= ' ' . html_entity_decode((string)$item, ENT_QUOTES | ENT_HTML5, 'UTF-8');
                }
            }
        }
        $content = $total_content;
    }

    // Convert to string if not already
    $content = (string)$content;

    if (empty(trim($content))) {
        return '0 minute read';
    }

    // Strip HTML tags and shortcodes to get plain text
    // First strip shortcodes, then HTML tags for better cleaning
    $text_content = strip_shortcodes($content);
    $text_content = wp_strip_all_tags($text_content);

    // Additional HTML cleaning in case wp_strip_all_tags doesn't catch everything
    $text_content = html_entity_decode($text_content, ENT_QUOTES | ENT_HTML5, 'UTF-8');
    $text_content = strip_tags($text_content);

    // Remove extra whitespaces and normalize
    $text_content = preg_replace('/\s+/', ' ', trim($text_content));

    // Count words
    $word_count = str_word_count($text_content);

    // Calculate read time (assuming 200 words per minute)
    $minutes = ceil($word_count / 200);

    // Return formatted string
    return $minutes . ' minute' . ($minutes > 1 ? 's' : '') . ' read';
}

function get_acf_reading_time($post_id, $field_names = ['acf_posts_content'])
{
    $total_content = '';

    // Handle both string and array inputs for field names
    if (is_string($field_names)) {
        $field_names = [$field_names];
    }

    // Loop through each field and concatenate content
    foreach ($field_names as $field_name) {
        $content = get_field($field_name, $post_id);

        // Check if content exists and is not false/null/empty
        if ($content && !empty($content)) {
            // Handle different field types
            if (is_array($content)) {
                // If it's an array (like repeater fields), extract text from each item
                $content = implode(' ', array_map(function ($item) {
                    return is_array($item) ? implode(' ', $item) : $item;
                }, $content));
            }

            $total_content .= ' ' . $content;
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

function getVimeoVideoDuration($videoUrl)
{
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

function extractVimeoVideoId($url)
{
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

function get_post_read_minutes($post_id, $post_type_name)
{
    if ($post_type_name === 'Webinar' || $post_type_name === 'Video') {
        $videoId = get_field('acf_pardot_vimeo_video_url', $post_id);
        $minutes = get_minutes($post_id, null, $videoId);
    } elseif ($post_type_name === 'Use Case' || $post_type_name === 'Case Study') {
        $post_content_frame_section = get_field('acf_usecase_content_frame', $post_id) ?? '';
        $content_frame_left_container = '';
        $content_frame_button_text = '';
        $content_frame_benefits = '';
        $content_frame_accordion = '';

        if (!empty($post_content_frame_section)) {
            $content_frame_left_container = $post_content_frame_section['acf_usecase_content_frame_left_container'] ?? '';
            $content_frame_button_text = $post_content_frame_section['acf_content_frame_usecase_button_text'] ?? '';
            $content_frame_benefits = $post_content_frame_section['acf_usecase_content_frame_benefits'] ?? '';
            $content_frame_accordion = $post_content_frame_section['acf_usecase_content_frame_accordion'] ?? '';
        }
        $accordion_text = '';
        if (!empty($content_frame_accordion) && is_array($content_frame_accordion)) {
            foreach ($content_frame_accordion as $row) {
                $accordion_title = isset($row['acf_usecase_accordion_title']) ? strip_tags($row['acf_usecase_accordion_title']) : '';
                $accordion_content = isset($row['acf_usecase_accordion_content']) ? strip_tags($row['acf_usecase_accordion_content']) : '';
                $accordion_text .= $accordion_title . ' ' . $accordion_content . ' ';
            }
        }
        $minutes = get_minutes($post_id, null, null, [$content_frame_left_container, $content_frame_benefits, $accordion_text]);
    } elseif ($post_type_name === 'Blog') {
        $all_text_content = '';
        $all_divider_content = '';
        $all_takeaways_heading = '';
        $all_takeaways_content = '';

        if (have_rows('acf_blog_content_blocks', $post_id)) {
            while (have_rows('acf_blog_content_blocks', $post_id)) {
                the_row();
                if (get_row_layout() === 'acf_blog_text_block') {
                    $text_content = get_sub_field('acf_blog_text_content', $post_id);
                    $all_text_content .= strip_tags($text_content) . ' ';
                } elseif (get_row_layout() === 'acf_blog_blue_divider') {
                    $divider_content = get_sub_field('acf_blog_divider_content', $post_id);
                    $all_divider_content .= strip_tags($divider_content) . ' ';
                }
            }
        }

        // Collect key takeaways content (removing HTML tags)
        $acf_blog_key_takeaways_section = get_field('acf_blog_key_takeaways_section', $post_id);
        if ($acf_blog_key_takeaways_section) {
            if (!empty($acf_blog_key_takeaways_section['acf_key_takeaways_section_heading'])) {
                $all_takeaways_heading = strip_tags($acf_blog_key_takeaways_section['acf_key_takeaways_section_heading']);
            }

            if (!empty($acf_blog_key_takeaways_section['acf_key_takeaways_list_items'])) {
                $all_takeaways_content = strip_tags($acf_blog_key_takeaways_section['acf_key_takeaways_list_items']);
            }
        }


        $quote_text = get_field('acf_quote_text', $post_id);
        $quote_author = get_field('acf_quote_author', $post_id);

        $minutes = get_minutes($post_id, null, null, [
            $all_text_content,
            $all_divider_content,
            $all_takeaways_heading,
            $all_takeaways_content,
            $quote_text,
            $quote_author
        ]);
        // 		var_dump($minutes);
        // END:
    } else {
        $minutes = get_minutes($post_id, ['acf_post_content_frame_section']);
        if (is_numeric($minutes)) {
            $minutes = $minutes . ' minute' . ($minutes == 1 ? '' : 's');
        }
    }

    return $minutes !== null ? $minutes : "N/A";
}

// DESCRIPTION: Fetch posts with pagination and featured posts logic

function fetch_posts()
{
    if (!function_exists('get_field')) {
        wp_send_json_error(['message' => 'ACF not initialized']);
        return;
    }

    $currentPage   = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
    $postsPerPage  = isset($_GET['postsPerPage']) ? max(1, intval($_GET['postsPerPage'])) : 6;
    $default_image = '/wp-content/uploads/2025/04/Service-Sub-Service-General-Our-Offerings-and-Capabilities-Texture.webp';

    // Cache key based on page and postsPerPage
    $cache_key = "fetch_posts_cache_{$currentPage}_{$postsPerPage}";
    $cached    = get_transient($cache_key);
    if ($cached !== false) {
        wp_send_json($cached);
    }

    // Get featured post IDs
    $featured_ids = array_filter(array_map('intval', explode(',', trim(get_field('acf_insight', 8223) ?? ''))));
    $featured_posts = [];

    if (!empty($featured_ids) && $currentPage === 1) {
        $featured_query = new WP_Query([
            'post_type'      => 'post',
            'post__in'       => $featured_ids,
            'post_status'    => 'publish',
            'orderby'        => 'post__in',
            'posts_per_page' => count($featured_ids),
            'fields'         => 'ids', // optimization: get only IDs
        ]);

        foreach ($featured_query->posts as $post_id) {
            $featured_posts[] = get_post_data_for_output($post_id, $default_image);
        }
        wp_reset_postdata();
    }

    // Determine how many regular posts to show
    $featuredCount        = ($postsPerPage === 3) ? count($featured_posts) : 3;
    $regularCountPageOne  = ($postsPerPage === 3) ? 0 : ($postsPerPage - $featuredCount);
    $offset               = ($currentPage === 1) ? 0 : $regularCountPageOne + (($currentPage - 2) * $postsPerPage);
    $postsToFetch         = ($currentPage === 1) ? $regularCountPageOne : $postsPerPage;

    // Get regular posts
    $regular_posts = [];
    if ($postsToFetch > 0) {
        $regular_query = new WP_Query([
            'post_type'      => 'post',
            'post_status'    => 'publish',
            'posts_per_page' => $postsToFetch,
            'offset'         => $offset,
            'post__not_in'   => $featured_ids,
            'orderby'        => 'date',
            'order'          => 'DESC',
            'fields'         => 'ids', // optimization: get only IDs
        ]);

        foreach ($regular_query->posts as $post_id) {
            $regular_posts[] = get_post_data_for_output($post_id, $default_image);
        }
        wp_reset_postdata();
    }

    // Get total post count
    $total_query = new WP_Query([
        'post_type'      => 'post',
        'post_status'    => 'publish',
        'posts_per_page' => -1,
        'post__not_in'   => $featured_ids,
        'fields'         => 'ids', // optimization
    ]);
    $totalPosts = count($total_query->posts);
    $totalPages = ceil($totalPosts / $postsPerPage);

    // Handle Page 1 logic overrides
    if ($currentPage === 1) {
        if ($postsPerPage === 3) {
            $regular_posts = [];
        } elseif ($postsPerPage === 4) {
            $regular_posts = array_slice($regular_posts, 0, 1);
        }
    }

    $response = [
        'featured_posts' => $featured_posts,
        'regular_posts'  => $regular_posts,
        'totalPages'     => $totalPages,
    ];

    // Cache response for 10 minutes
    set_transient($cache_key, $response, 10 * MINUTE_IN_SECONDS);

    wp_send_json($response);
}
add_action('wp_ajax_fetch_posts', 'fetch_posts');
add_action('wp_ajax_nopriv_fetch_posts', 'fetch_posts');
function get_post_data_for_output($post_id, $default_image)
{
    $image = get_the_post_thumbnail_url($post_id, 'full') ?: $default_image;

    $terms = get_the_terms($post_id, 'post_type_category');
    $post_type_name = (!empty($terms) && !is_wp_error($terms)) ? $terms[0]->name : 'Uncategorized';


    $cal_read_minutes = get_post_read_minutes($post_id, $post_type_name);
    // check cal_read_minutes is N/A or not
    $read_minutes = $cal_read_minutes !== 'N/A' ? $cal_read_minutes : get_field('acf_read_minutes', $post_id);
    $read_minutes_display = !empty($read_minutes) ? esc_html($read_minutes) : 'N/A';
    return [
        'id'           => $post_id,
        'title'        => get_the_title($post_id),
        'image'        => $image,
        'post_type'    => $post_type_name,
        'permalink'    => get_permalink($post_id),
        'read_minutes' => $read_minutes_display
    ];
}


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

function lazy_load_enqueue_script()
{
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
add_filter('manage_leaders_posts_columns', function ($columns) {
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
function add_order_field_to_leader_categories($term)
{
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

function custom_subscribe_modal_code()
{
?>
    <style>
        .custom-modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: none;
            /* hidden initially */
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
            width: 90% !important;
        }

        .consent-txt a {
            text-decoration: none !important;
            color: #0cf;
        }

        #subscribeModalIframe {

            transition: opacity 0.3s ease-in-out;
        }

        .loader {
            margin: auto;
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
                top: 15px !important;
                right: 10px !important;
            }
        }

        /* Tablet portrait */
        @media (min-width: 768px) and (max-width: 1280px) and (orientation: portrait) {
            .custom-modal-content iframe {
                height: 310px !important;
            }

            .close-modal-btn {
                top: 15px !important;
                right: 10px !important;
            }
        }

        /* Mobile */
        @media screen and (max-width: 767.5px) {
            .custom-modal-content {
                width: 90%;
            }

            .close-modal-btn {
                top: 15px !important;
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
                <a class="font-bold" href="/wp-content/uploads/2025/04/data-protection-policy-pdf.pdf" target="_blank" rel="noreferrer noopener">Personal Data Protection Policy</a> and
                <a class="font-bold" href="/wp-content/uploads/2025/04/ADROSONIC-GDPR-Policy.pdf" target="_blank" rel="noreferrer noopener">Privacy Policy</a>. Your Privacy is important to us.
            </p>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
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
                loader.style.position = "absolute";
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
                        footerBtn.focus({
                            preventScroll: true
                        });
                        opensubscribebtn.focus({
                            preventScroll: true
                        });
                    }
                }, 0);
            }

            if (closeBtn) {
                closeBtn.addEventListener("click", closeSubscribeModal);
            }

            modal.addEventListener("click", function(e) {
                if (e.target === modal) {
                    closeSubscribeModal();
                }
            });

            if (footerBtn || opensubscribebtn) {
                footerBtn.addEventListener("click", function(e) {
                    e.preventDefault();
                    openSubscribeModal();
                });
                opensubscribebtn.addEventListener("click", function(e) {
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





add_action('wp_head', function () {
    echo '<meta name="robots" content="noindex, nofollow">' . "\n";
});

add_filter('wpseo_robots', 'force_noindex_nofollow_all_pages');

function force_noindex_nofollow_all_pages($robots)
{
    return 'noindex, nofollow';
}


add_action('template_redirect', function () {
    if (strpos($_SERVER['REQUEST_URI'], '/data-management-and-analytics') !== false) {
        wp_redirect(home_url('/services/data-engineering-and-analytics/'), 301);
        exit;
    }
});




//From UAT instance


function enforce_admin_cache_headers()
{
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


function get_csp_nonce()
{
    static $nonce = null;
    if ($nonce === null) {
        $nonce = base64_encode(random_bytes(16));
    }
    return $nonce;
}


add_filter('xmlrpc_enabled', '__return_false');

add_filter('rest_pre_dispatch', function ($result, $server, $request) {
    // Check if user is NOT logged in
    if (! is_user_logged_in()) {
        $method = $request->get_method();
        $allowed_methods = ['GET', 'POST']; // Allowed for logged-out users

        if (! in_array($method, $allowed_methods)) {
            // Log the blocked attempt
            $ip      = $_SERVER['REMOTE_ADDR'] ?? 'unknown IP';
            $uri     = $_SERVER['REQUEST_URI'] ?? 'unknown URI';
            $agent   = $_SERVER['HTTP_USER_AGENT'] ?? 'unknown agent';

            error_log("Blocked REST API request from logged-out user: Method=$method, URI=$uri, IP=$ip, Agent=$agent");

            // Block the request for logged-out user
            return new WP_Error('rest_forbidden_method', 'HTTP method not allowed for unauthenticated users.', array('status' => 403));
        }
    }

    // For logged-in users or allowed methods, continue as normal
    return $result;
}, 10, 3);



//search code

function disable_special_chars_in_search()
{
?>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Select all search input fields by type or class
            const searchInputs = document.querySelectorAll('input[type="search"], input.search-field');

            // Define forbidden characters regex: < > ( ) [ ] { } / \
            const forbiddenChars = /[<>()[\]{}\/\\]/g;

            searchInputs.forEach(input => {
                input.addEventListener('input', function() {
                    // Remove forbidden characters as user types
                    this.value = this.value.replace(forbiddenChars, '');
                });
            });
        });
    </script>
    <?php
}
add_action('wp_footer', 'disable_special_chars_in_search');



function sanitize_search_query_param()
{
    if (isset($_GET['s'])) {
        // Sanitize the search query by removing dangerous characters
        $_GET['s'] = preg_replace('/[<>()[\]{}\/\\\\]/', '', $_GET['s']);
        // Update the global $wp_query search value
        add_filter('get_search_query', function ($query) {
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


function add_pardot_download_script()
{
    if (!function_exists('get_field')) {
        wp_send_json_error(['message' => 'ACF not initialized']);
        return;
    }
    //$pdf = get_field('acf_posts_pdf_download'); // Returns an array if file exists
    if (is_single()) {
        $pdf = get_field('acf_posts_pdf_download');
        if ($pdf && isset($pdf['url'])) {
    ?>
            <script>
                window.addEventListener('message', function(event) {
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
                        const pdfUrl = '<?php echo esc_url($pdf['url']); ?>';

                        const isSafari = /^((?!chrome|android).)*safari/i.test(navigator.userAgent);
                        const isIOS = /iP(ad|hone|od)/i.test(navigator.userAgent);

                        if (isSafari && isIOS) {
                            // For iOS Safari — open in same tab
                            window.location.href = pdfUrl;
                        } else {
                            // For all other browsers — open in new tab
                            window.open(pdfUrl, '_blank');
                            location.reload(); // Reload only for non-Safari
                        }
                    }
                }
            </script>
    <?php
        }
    }
}
add_action('wp_footer', 'add_pardot_download_script');

// Passes product interest on the basis of services assgined to the post
add_action('wp_footer', 'inject_pardot_iframe_with_Product_Interest');

function inject_pardot_iframe_with_Product_Interest()
{
    if (!is_single()) return;

    global $post;
    if (!$post) return;
    if (empty($GLOBALS['should_show_download_popup_form']) && strpos($post->post_content, 'open-download-popup') === false) return;

    // Get all categories assigned to the post
    $post_categories = get_the_category($post->ID);

    // Get the "Service" category ID
    $service_parent = get_term_by('name', 'Service', 'category');
    $service_parent_id = $service_parent ? $service_parent->term_id : 0;

    $included_names = [];

    foreach ($post_categories as $cat) {
        if ($cat->term_id == $service_parent_id) {
            // Skip the top-level "Service" category
            continue;
        }

        if ($cat->parent == $service_parent_id) {
            // It's a direct child of "Service"
            $included_names[] = $cat->name;
        } else {
            // It's a grandchild; check its parent
            $parent_cat = get_category($cat->parent);
            if ($parent_cat && $parent_cat->parent == $service_parent_id) {
                // Include the parent (which is a direct child of "Service")
                $included_names[] = $parent_cat->name;
            }
        }
    }

    // Fallback if nothing relevant was found
    if (empty($included_names)) {
        $included_names[] = 'General';
    }

    // Remove duplicates and URL encode
    $Product_Interest_values = array_unique($included_names);
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
            <h2 class="popup-heading font-bold large-size">Download Our
                <?php echo esc_html($post_label); ?>
            </h2>
            <!-- Pardot Form Embed -->
            <div class="pardot-form-container">
                <iframe src="" width="100%" class="download-iframe" type="text/html" frameborder="0" allowTransparency="true"
                    style="border: 0"></iframe>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
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
                button.addEventListener('click', function() {
                    popupOverlay.style.display = 'flex';
                    lockBodyScrollForPardotPopup();
                });
            });

            // Close popup on close button click
            closeButton.addEventListener('click', function() {
                popupOverlay.style.display = 'none';
                unlockBodyScrollForPardotPopup();
            });

            // Close popup on background click
            window.addEventListener('click', function(e) {
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

function add_pardot_video_play_script()
{
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
                window.addEventListener('message', function(event) {
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
                        if (postHead) {
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

function inject_pardot_video_iframe_with_Product_Interest()
{
    if (!is_single()) return;

    global $post;
    if (!$post) return;
    //     if (strpos($post->post_content, 'open-pardot-play-popup') === false) return;
    if (empty($GLOBALS['should_show_play_popup_form']) && strpos($post->post_content, 'open-pardot-play-popup') === false) return;

    // Get all categories assigned to the post
    $post_categories = get_the_category($post->ID);

    // Get the "Service" category ID
    $service_parent = get_term_by('name', 'Service', 'category');
    $service_parent_id = $service_parent ? $service_parent->term_id : 0;

    $included_names = [];

    foreach ($post_categories as $cat) {
        if ($cat->term_id == $service_parent_id) {
            // Skip the top-level "Service" category
            continue;
        }

        if ($cat->parent == $service_parent_id) {
            // It's a direct child of "Service"
            $included_names[] = $cat->name;
        } else {
            // It's a grandchild; check its parent
            $parent_cat = get_category($cat->parent);
            if ($parent_cat && $parent_cat->parent == $service_parent_id) {
                // Include the parent (which is a direct child of "Service")
                $included_names[] = $parent_cat->name;
            }
        }
    }

    // Fallback if nothing relevant was found
    if (empty($included_names)) {
        $included_names[] = 'General';
    }

    // Remove duplicates and URL encode
    $Product_Interest_values = array_unique($included_names);
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
            <h3 class="large-size font-bold form-header">Watch Now our <?php echo esc_html($post_label); ?></h3>
            <div id="formContainer" class="form-wrapper">
                <iframe id="pardotIframe" width="100%" height="100%" type="text/html" frameborder="0" allowTransparency="true" style="border: 0"></iframe>
            </div>
            <div id="videoContainer" class="video-wrapper" style="display: none;">
                <iframe id="videoIframe" width="100%" height="100%" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe>
            </div>
        </div>
    </div>
    <script>
        var isFormSubmitted = window.isFormSubmitted || false;
        document.addEventListener('DOMContentLoaded', function() {

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
                popup.classList.remove("active", "video-mode");
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
                button.addEventListener('click', function() {
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
function is_video_popup_no_pardot_post_type()
{
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
function inject_vimeo_video_popup_no_pardot()
{
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
        document.addEventListener('DOMContentLoaded', function() {
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
                button.addEventListener("click", function(e) {
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
function get_ranked_post_ids_by_keyword($keyword)
{
    global $wpdb;
    $keyword_like = '%' . $wpdb->esc_like($keyword) . '%';
    $posts = [];

    $thank_you_page = get_page_by_path('thank-you');
    $exclude_id = $thank_you_page ? $thank_you_page->ID : null;

    // Title match (exact and partial)
    $title_matches = $wpdb->get_results($wpdb->prepare(
        "SELECT ID, post_title, post_type, post_date FROM $wpdb->posts
         WHERE post_status = 'publish' AND post_type IN ('post', 'page')
         AND post_title LIKE %s",
        $keyword_like
    ));

    foreach ($title_matches as $post) {
        if ($exclude_id && $post->ID == $exclude_id) continue;
        $score = (strtolower(trim($post->post_title)) === strtolower(trim($keyword))) ? 1000 : 900;
        $posts[$post->ID] = ['score' => $score, 'type' => $post->post_type, 'date' => $post->post_date];
    }

    // Slug match
    $slug_matches = $wpdb->get_results($wpdb->prepare(
        "SELECT ID, post_type, post_date FROM $wpdb->posts
         WHERE post_status = 'publish' AND post_type IN ('post', 'page')
         AND post_name LIKE %s",
        $keyword_like
    ));
    foreach ($slug_matches as $post) {
        if ($exclude_id && $post->ID == $exclude_id) continue;
        $posts[$post->ID]['score'] = max($posts[$post->ID]['score'] ?? 800, 800);
        $posts[$post->ID]['type'] = $post->post_type;
        $posts[$post->ID]['date'] = $post->post_date;
    }

    // Meta value match
    $meta_matches = $wpdb->get_results($wpdb->prepare(
        "SELECT post_id FROM $wpdb->postmeta WHERE meta_value LIKE %s",
        $keyword_like
    ));
    foreach ($meta_matches as $meta) {
        if ($exclude_id && $meta->post_id == $exclude_id) continue;
        $post_data = get_post($meta->post_id);
        if ($post_data && $post_data->post_status === 'publish' && in_array($post_data->post_type, ['post', 'page'])) {
            $posts[$meta->post_id]['score'] = max($posts[$meta->post_id]['score'] ?? 700, 700);
            $posts[$meta->post_id]['type'] = $post_data->post_type;
            $posts[$meta->post_id]['date'] = $post_data->post_date;
        }
    }

    // Content match
    $content_matches = $wpdb->get_results($wpdb->prepare(
        "SELECT ID, post_type, post_date FROM $wpdb->posts
         WHERE post_status = 'publish' AND post_type IN ('post', 'page')
         AND post_content LIKE %s",
        $keyword_like
    ));
    foreach ($content_matches as $post) {
        if ($exclude_id && $post->ID == $exclude_id) continue;
        $posts[$post->ID]['score'] = max($posts[$post->ID]['score'] ?? 600, 600);
        $posts[$post->ID]['type'] = $post->post_type;
        $posts[$post->ID]['date'] = $post->post_date;
    }

    // ACF field match
    $acf_matches = $wpdb->get_results($wpdb->prepare(
        "SELECT post_id FROM $wpdb->postmeta WHERE meta_value LIKE %s",
        $keyword_like
    ));
    foreach ($acf_matches as $meta) {
        if ($exclude_id && $meta->post_id == $exclude_id) continue;
        $post_data = get_post($meta->post_id);
        if ($post_data && $post_data->post_status === 'publish' && in_array($post_data->post_type, ['post', 'page'])) {
            $posts[$meta->post_id]['score'] = max($posts[$meta->post_id]['score'] ?? 500, 500);
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
            $posts[$post->ID]['score'] = max($posts[$post->ID]['score'] ?? 450, 450);
            $posts[$post->ID]['type'] = $post->post_type;
            $posts[$post->ID]['date'] = $post->post_date;
        }
    }

    // Final sorting: score desc → page before post → recent first
    uasort($posts, function ($a, $b) {
        return $b['score'] <=> $a['score']
            ?: strcmp($a['type'], $b['type']) // 'page' before 'post'
            ?: strtotime($b['date']) <=> strtotime($a['date']);
    });

    return array_keys($posts);
}


// AJAX Search Handler
function acf_live_search()
{
    global $wpdb;

    $keyword = isset($_POST['keyword']) ? trim(wp_unslash($_POST['keyword'])) : '';
    $results = [];

    $thank_you_page = get_page_by_path('thank-you');
    $exclude_id = $thank_you_page ? $thank_you_page->ID : null;

    if (mb_strlen($keyword) < 2 && !preg_match('/[^a-zA-Z0-9]/', $keyword)) {
        echo json_encode([['title' => 'No matching found. Try anything else.', 'url' => '#']]);
        wp_die();
    }

    // Handle quick match shortcuts
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
            if (count($matched_posts) >= 10) break;
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

    if (!empty($matched_posts)) {
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

    // ACF leader name check
    $keyword_like = '%' . $wpdb->esc_like($keyword) . '%';
    $acf_leader_match = $wpdb->get_var($wpdb->prepare(
        "SELECT COUNT(*) FROM $wpdb->postmeta pm
         INNER JOIN $wpdb->posts p ON pm.post_id = p.ID
         WHERE p.post_status = 'publish'
         AND p.post_type = 'leader'
         AND pm.meta_key = 'acf_leader_name'
         AND pm.meta_value LIKE %s",
        $keyword_like
    ));
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

    if (empty($results)) {
        $results[] = [
            'title'     => 'No matching found. Try anything else.',
            'url'       => '#',
            'image_url' => $fallback_image_url,
        ];
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


// custom color picker option in admin panel
// custom color picker option in admin panel
function add_theme_color_column($columns)
{
    $columns['theme_color'] = 'Theme Color';
    return $columns;
}
add_filter('manage_posts_columns', 'add_theme_color_column');
function show_theme_color_column_content($column, $post_id)
{
    if ($column === 'theme_color') {
        echo esc_html(get_post_meta($post_id, 'theme_color', true) ?: 'generic');
    }
}
add_action('manage_posts_custom_column', 'show_theme_color_column_content', 10, 2);
add_action('admin_head', function () {
    echo '<style>.column-theme_color { display: none; }</style>';
});
function register_theme_color_meta()
{
    register_post_meta('post', 'theme_color', [
        'type' => 'string',
        'single' => true,
        'show_in_rest' => true,
        'default' => 'generic',
    ]);
}
add_action('init', 'register_theme_color_meta');

function add_theme_color_dropdown_meta_box()
{
    add_meta_box(
        'theme_color_meta_box',
        'Theme Color',
        'render_theme_color_dropdown',
        'post',
        'side',
        'default'
    );
}
add_action('add_meta_boxes', 'add_theme_color_dropdown_meta_box');

function render_theme_color_dropdown($post)
{
    $value = get_post_meta($post->ID, 'theme_color', true) ?: 'generic';
?>
    <label for="theme_color">Choose a Theme:</label>
    <select name="theme_color" id="theme_color">
        <option value="generic" <?php selected($value, 'generic'); ?>>Electric Green (default)</option>
        <option value="ia" <?php selected($value, 'ia'); ?>>Intelligent Automation</option>
        <option value="de" <?php selected($value, 'de'); ?>>Digital Engineering</option>
        <option value="qe" <?php selected($value, 'qe'); ?>>Quality Engineering</option>
        <option value="dea" <?php selected($value, 'dea'); ?>>Data Engineering & Analytics</option>
    </select>
<?php
}

function save_theme_color_meta($post_id)
{
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (array_key_exists('theme_color', $_POST)) {
        update_post_meta($post_id, 'theme_color', sanitize_text_field($_POST['theme_color']));
    }
}
add_action('save_post', 'save_theme_color_meta');

function add_theme_color_quick_edit_field($column_name, $post_type)
{
    if ($column_name !== 'theme_color' || $post_type !== 'post') return;
?>
    <fieldset class="inline-edit-col-left">
        <div class="inline-edit-col">
            <span class="title">Theme Color</span>
            <select name="theme_color" class="theme_color">
                <option value="generic">Electric Green(Default)</option>
                <option value="ia">Intelligent Automation</option>
                <option value="de">Digital Engineering</option>
                <option value="qe">Quality Engineering</option>
                <option value="dea">Data Engineering & Analytics</option>
            </select>
        </div>
    </fieldset>
<?php
}
add_action('quick_edit_custom_box', 'add_theme_color_quick_edit_field', 10, 2);

function save_quick_edit_theme_color($post_id)
{
    if (isset($_POST['theme_color'])) {
        update_post_meta($post_id, 'theme_color', sanitize_text_field($_POST['theme_color']));
    }
}
add_action('save_post', 'save_quick_edit_theme_color');

function enqueue_quick_edit_script()
{
?>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const $ = jQuery;

            function setThemeColorInQuickEdit(id) {
                const theme = $(`#post-${id}`).data('theme-color') || 'generic';
                $(`#edit-${id} select.theme_color`).val(theme);
            }

            const inlineEditPost = inlineEditPost || {};
            const original = inlineEditPost.edit;
            inlineEditPost.edit = function(id) {
                original.apply(this, arguments);
                if (typeof id === 'object') id = this.getId(id);
                setThemeColorInQuickEdit(id);
            };
        });
    </script>
<?php
}
add_action('admin_footer-edit.php', 'enqueue_quick_edit_script');

function add_theme_color_data_attribute($column_name, $post_id)
{
    if ($column_name === 'theme_color') {
        $theme = get_post_meta($post_id, 'theme_color', true) ?: 'generic';
        echo "<script>
            jQuery(document).ready(function($) {
                $('#post-{$post_id}').attr('data-theme-color', '{$theme}');
            });
        </script>";
    }
}
add_action('manage_posts_custom_column', 'add_theme_color_data_attribute', 10, 2);

function add_theme_color_body_class($classes)
{
    if (is_singular('post')) {
        $theme_color = get_post_meta(get_the_ID(), 'theme_color', true) ?: 'generic';
        $classes[] = 'theme-' . sanitize_html_class($theme_color);
    }
    return $classes;
}
add_filter('body_class', 'add_theme_color_body_class');

// global search barr suggestion injection

function disable_astra_live_search()
{
    wp_dequeue_script('astra-live-search');
    wp_deregister_script('astra-live-search');
}
function enqueue_custom_live_search_script()
{
    wp_enqueue_script(
        'custom-live-search',
        '/wp-content/themes/astra-child/js/custom-live-search.js',
        array('jquery'),
        null,
        true
    );

    wp_localize_script(
        'custom-live-search',
        'search_ajax_obj',
        array(
            'ajaxurl' => admin_url('admin-ajax.php')
        )
    );
}
add_action('wp_enqueue_scripts', 'enqueue_custom_live_search_script');

function enqueue_custom_template_assets()
{
    // Get current template file name
    $template = basename(get_page_template());

    switch ($template) {
        case 'whitepaper_template.php':
            $css = 'whitepaper.css';
            $js  = 'whitepaper.js';
            break;
        case 'ebook_template.php':
            $css = 'ebook.css';
            $js  = 'ebook.js';
            break;
        case 'webinar.php':
            $css = 'webinar.css';
            $js  = 'webinar.js';
            break;
        case 'cwa.php':
            $css = 'video-cwa.css';
            $js  = 'video-cwa.js';
            break;
        case 'case_study_template.php':
            $css = 'case-study.css';
            $js  = 'case-study.js';
            break;
        case 'use_case.php':
            $css = 'use-case.css';
            $js  = 'use-case.js';
            break;
        case 'flexible.php':
            $css = 'blog.css';
            $js  = 'blog.js';
            break;
        default:
            return;
    }

    // Enqueue the matched CSS and JS
    $css_path = get_stylesheet_directory_uri() . '/css/' . $css;
    $js_path  = get_stylesheet_directory_uri() . '/js/' . $js;

    wp_enqueue_style("template-style-{$template}", $css_path, [], filemtime(get_stylesheet_directory() . '/css/' . $css));
    wp_enqueue_script("template-script-{$template}", $js_path, ['jquery'], filemtime(get_stylesheet_directory() . '/js/' . $js), true);
}
add_action('wp_enqueue_scripts', 'enqueue_custom_template_assets');

add_filter('wp_die_handler', function () {
    return 'my_custom_fatal_error_handler';
});

function my_custom_fatal_error_handler($message, $title = '', $args = [])
{
    status_header(500);

    $error_file_path = get_theme_file_path('critical-error.html');

    if (file_exists($error_file_path)) {
        readfile($error_file_path);
    } else {
        // Fallback if the file is missing
        echo '<h1>Critical Error</h1>';
        echo '<p>A fatal error occurred.</p>';
    }

    exit;
}

if (isset($_GET['test_fatal']) && $_GET['test_fatal'] === '1') {
    non_existing_function(); // triggers fatal error
}


//visual editor 
add_filter('acf/update_value/type=wysiwyg', 'acf_clean_tinymce_bookmarks_before_save', 10, 3);
function acf_clean_tinymce_bookmarks_before_save($value, $post_id, $field)
{
    // Remove TinyMCE bookmark spans
    $value = preg_replace('/<span[^>]*data-mce-type="bookmark"[^>]*>.*?<\/span>/i', '', $value);
    return $value;
}

// ----------------------------
// 1. Smart Cache Headers
// ----------------------------
add_action('send_headers', function () {
    if (!is_user_logged_in()) {
        // Public pages: cache for 1 min in browser, 5 mins in AFD
        header("Cache-Control: public, max-age=60, s-maxage=300");
    } else {
        // Private/admin pages: prevent caching
        header("Cache-Control: private, no-store, no-cache, must-revalidate");
        header("Pragma: no-cache");
        header("Expires: 0");
    }
});

// ----------------------------
// 2. Enable bfcache-safe events
// ----------------------------
function add_bfcache_script()
{
?>
    <script>
        window.addEventListener('pageshow', function(event) {
            if (event.persisted) {
                // You came back via back/forward nav (from bfcache)
                // console.log('Restored from bfcache');
            }
        });
    </script>
<?php
}
add_action('wp_footer', 'add_bfcache_script');

// ----------------------------
// 3. Instant Navigation
// ----------------------------
function load_instant_page()
{
    echo '<script src="https://cdn.jsdelivr.net/npm/instant.page@5.1.0/instantpage.min.js" type="module" defer></script>';
}
add_action('wp_footer', 'load_instant_page');

// ----------------------------
// 4. Preload/prefetch critical internal links
// ----------------------------
function add_prefetch_links()
{
?>
    <link rel="prerender" href="/about-us">
    <link rel="prerender" href="/contact">
    <link rel="prerender" href="/insights">
    <link rel="prerender" href="/">
<?php
}
add_action('wp_head', 'add_prefetch_links');

add_action('send_headers', function () {
    header_remove('Server'); // Remove existing Server header
    header('Server: adroserver'); // Set your own custom server name
});

require_once get_stylesheet_directory() . '/cookie.php';
