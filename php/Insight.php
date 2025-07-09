<?php
/*
Template Name: Insight
*/

/**
 * Custom insight template for Astra child theme.
 *
 * This template is specifically for the insights of the site.
 *
 * @package Astra Child
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

get_header();

// Get Pods object for this page
// $pods = pods('page', get_the_ID());
$page_id = 8223;
// Fetch the custom field containing post IDs
$post_ids = get_field('acf_insight_copy', $page_id); // Comma-separated post IDs
$statement = get_field('acf_statement', $page_id);
$statement_img = get_field('acf_statement-sec-img', $page_id);

// Fetch banner tags (now a repeatable field)
// $banner_tags = get_field('statement_copy',$page_id);
// $banner_tags = is_array($banner_tags) ? $banner_tags : [];


$statement_img_f = $statement_img ?: '/wp-content/uploads/2025/04/Service-Sub-Service-General-Our-Offerings-and-Capabilities-Texture.webp';

// Convert post IDs to array
$post_ids_array = !empty($post_ids) ? explode(',', $post_ids) : [];

// Fetch image URLs from repeatable field
// $image_urls = get_field('acf_statement-sec-img_copy',$page_id);
// $image_urls = is_array($image_urls) ? $image_urls : [];

$post_count = count($post_ids_array);

$image_urls = [];
$repeater_field = get_field('acf_statement-sec-img_copy', $page_id);

if (is_array($repeater_field)) {
    foreach ($repeater_field as $entry) {
        $image_urls[] = isset($entry['acf_banner_image_url']) ? esc_url($entry['acf_banner_image_url']) : '';
    }
}

// Handle missing images
$fallback_image = '/wp-content/uploads/2025/04/Service-Sub-Service-General-Our-Offerings-and-Capabilities-Texture.webp';
$image_count = count($image_urls);
if ($image_count < $post_count) {
    $missing_images = array_fill(0, $post_count - $image_count, $fallback_image);
    $image_urls = array_merge($image_urls, $missing_images);
}
$image_urls = array_slice($image_urls, 0, $post_count);

// Handle missing banner tags
// $banner_tag_count = count($banner_tags);
// if ($banner_tag_count < $post_count) {
//     $missing_tags = array_fill(0, $post_count - $banner_tag_count, 'Recent Post');
//     $banner_tags = array_merge($banner_tags, $missing_tags);
// }
// $banner_tags = array_slice($banner_tags, 0, $post_count);

?>

<?php if (astra_page_layout() == 'left-sidebar') : ?>
    <?php get_sidebar(); ?>
<?php endif; ?>



<script nonce="<?php echo esc_attr(get_csp_nonce()); ?>">
    // Your inline JavaScript
    //console.log("Secure CSP script: <?php echo esc_attr(get_csp_nonce()); ?>");
</script>


<div id="primary" <?php astra_primary_class(); ?>>
    <main id="main" class="site-main">
        <article id="post-<?php the_ID(); ?>" <?php post_class('ast-article-single'); ?> itemscope itemtype="https://schema.org/CreativeWork">
            <div class="entry-content clear" data-ast-blocks-layout="true" itemprop="text">
                <div class="owl-carousel insights-container" id="carousel">
                    <?php
                    if (!empty($post_ids_array)) :
                        $query_args = [
                            'post_type'      => 'post',
                            'post__in'       => $post_ids_array,
                            'orderby'        => 'post__in', // Keep the order as per entered IDs
                            'posts_per_page' => $post_count,
                        ];
                        $custom_posts = new WP_Query($query_args);

                        if ($custom_posts->have_posts()) :
                            $index = 0;
                            while ($custom_posts->have_posts()) : $custom_posts->the_post();
                                $image_url = isset($image_urls[$index]) ? esc_url($image_urls[$index]) : esc_url($fallback_image);

                                $current_post_id = get_the_ID(); // Get current post ID
                                $terms = get_the_terms($current_post_id, 'post_type_category');
                                $post_type_name = (!empty($terms) && !is_wp_error($terms)) ? $terms[0]->name : 'Uncategorized';


                                $cal_read_minutes = get_post_read_minutes($current_post_id, $post_type_name);

                                // check cal_read_minutes is N/A or not
                                $read_minutes = $cal_read_minutes !== 'N/A' ? $cal_read_minutes : get_field('acf_read_minutes', $post_id);
                                $read_minutes_display = !empty($read_minutes) ? esc_html($read_minutes) : 'N/A';

                                // Determine button text
                                $button_text = 'Read More'; // default
                                if (!empty($read_minutes) && strpos(strtolower($read_minutes), 'watch') !== false) {
                                    $button_text = 'Watch Now';
                                } elseif (!empty($read_minutes) && strpos(strtolower($read_minutes), 'read') !== false) {
                                    $button_text = 'Read More';
                                }

                                // Determine tag based on button text
                                if ($button_text === 'Watch Now') {
                                    $banner_tag = 'Our Must Watch';
                                } elseif ($button_text === 'Read More') {
                                    $banner_tag = 'Our Must Read';
                                } else {
                                    $banner_tag = 'Our Recent Post';
                                }
                    ?>
                                <div class="main-container item">
                                    <div class="image-container manual-lazy-load" data-src="<?= esc_url($image_url); ?>" style="background: url('data:image/svg+xml,%3Csvgxmlns=\'http://www.w3.org/2000/svg\' viewBox=\'0 0 1 1\'%3E%3C/svg%3E') center/cover no-repeat;"></div>
                                    <div class="content-container">
                                        <h5 class="must-read small-size"><?= esc_html($banner_tag); ?></h5>
                                        <h1 class="post-title largest-size"><?= esc_html(get_the_title()); ?></h1>
                                        <span class="small-size"><?= $read_minutes_display; ?></span>
                                        <button class="insight-banner-btn underline-on-hover small-size" onclick="window.location.href='<?= esc_url(get_permalink()); ?>'">
                                            <?= esc_html($button_text); ?>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="74" height="34" viewBox="0 0 74 34" fill="none">
                                                <path d="M57 17L1 17" stroke="#00CCFF" stroke-width="2" stroke-linecap="round" />
                                                <path d="M41 17C41 20.1645 41.9384 23.2579 43.6965 25.8891C45.4546 28.5203 47.9534 30.5711 50.8771 31.7821C53.8007 32.9931 57.0177 33.3099 60.1214 32.6926C63.2251 32.0752 66.0761 30.5513 68.3137 28.3137C70.5513 26.0761 72.0752 23.2251 72.6926 20.1214C73.3099 17.0177 72.9931 13.8007 71.7821 10.8771C70.5711 7.95345 68.5203 5.45459 65.8891 3.69649C63.2579 1.93838 60.1645 1 57 1C52.7565 1 48.6869 2.68571 45.6863 5.68629C42.6857 8.68687 41 12.7565 41 17Z" stroke="#00CCFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                    <?php
                                $index++; // Move to the next image in the array
                            endwhile;
                            wp_reset_postdata();
                        else :
                            echo '<p>No posts available.</p>';
                        endif;
                    else :
                        echo '<p>No posts selected in the custom field.</p>';
                    endif;
                    ?>
                </div>

                <div class="below-banner">
                    <div class="container">
                        <?php if (!empty($statement)) : ?>
                            <div class="statement large-size">
                                <p><?= esc_html($statement); ?></p>
                            </div>
                        <?php else : ?>
                            <p>No statement available.</p>
                        <?php endif; ?>

                        <?php if (!empty($statement_img_f)) : ?>
                            <div class="statement-img">
                                <img class="manual-lazy-load" data-src="<?= esc_url($statement_img_f); ?>" alt="insight-statement-img" src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1 1'%3E%3C/svg%3E">
                            </div>
                        <?php else : ?>
                            <p>No statement image available.</p>
                        <?php endif; ?>
                    </div>
                </div>
                <section class="resources-section">
                    <h1 class="large-size">Explore all of Our Resources</h1>

                    <div class="filters-container">
                        <div class="dropdown" id="service-dropdown">
                            <button class="dropdown-btn small-size">Service
                                <svg class="dropdown-icon" xmlns="http://www.w3.org/2000/svg" width="13.747px" height="18.742px" viewBox="0 0 21 16" fill="none">
                                    <path d="M19.7421 1L10.3706 14.747L1.00001 1" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </button>
                            <div class="dropdown-content" id="services-filters">

                            </div>
                        </div>

                        <div class="dropdown" id="industry-dropdown">
                            <button class="dropdown-btn small-size">Industry
                                <svg class="dropdown-icon" xmlns="http://www.w3.org/2000/svg" width="13.747px" height="18.742px" viewBox="0 0 21 16" fill="none">
                                    <path d="M19.7421 1L10.3706 14.747L1.00001 1" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </button>
                            <div class="dropdown-content" id="industries-filters">

                            </div>
                        </div>

                        <div class="dropdown" id="content-dropdown">
                            <button class="dropdown-btn small-size">Content Type
                                <svg class="dropdown-icon" xmlns="http://www.w3.org/2000/svg" width="13.747px" height="18.742px" viewBox="0 0 21 16" fill="none">
                                    <path d="M19.7421 1L10.3706 14.747L1.00001 1" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </button>
                            <div class="dropdown-content" id="content-type-filter">

                            </div>
                        </div>

                        <div class="search-box">
                            <input type="text" id="search-input" placeholder="Search...">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 34 34" fill="none" id="search-icon">
                                <path id="Icon akar-search" d="M33 33L25.445 25.431M29.632 15.316C29.632 18.1474 28.7924 20.9153 27.2193 23.2695C25.6463 25.6238 23.4104 27.4587 20.7945 28.5423C18.1786 29.6258 15.3001 29.9093 12.5231 29.3569C9.74606 28.8045 7.19519 27.4411 5.19307 25.4389C3.19094 23.4368 1.82747 20.8859 1.27508 18.1089C0.722698 15.3319 1.0062 12.4534 2.08975 9.8375C3.17329 7.2216 5.00821 4.98574 7.36246 3.41268C9.71671 1.83962 12.4846 1 15.316 1C19.1128 1 22.7542 2.50829 25.4389 5.19306C28.1237 7.87783 29.632 11.5192 29.632 15.316Z" stroke="#00CCFF" stroke-width="2" stroke-linecap="round" />
                            </svg>
                            <div class="suggestions" id="suggestions-box" style="border: 1px solid #ccc; display: none;"></div>
                        </div>
                    </div>

                    <button class="filter-btn custom-button" onclick="openFilterModal()"> Filter<svg xmlns="http://www.w3.org/2000/svg" width="27" height="22" viewBox="0 0 27 22" fill="none">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M26 1H1L11 12.0367V21H16V12.0367L26 1Z" stroke="#00CCFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg></button>

                    <!-- Filter Modal -->
                    <div class="filter-modal" id="filterModal">
                        <div class="modal-content">
                            <button class="close-btn"><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32" fill="none">
                                    <path d="M9 9L23 23" stroke="white" stroke-width="2" stroke-linecap="round" />
                                    <path d="M9 23L23 9" stroke="white" stroke-width="2" stroke-linecap="round" />
                                    <circle cx="16" cy="16" r="15.5" stroke="white" />
                                </svg></button>
                            <h3 class="modal-heading ">Filter<svg xmlns="http://www.w3.org/2000/svg" width="25" height="20" viewBox="0 0 27 22" fill="none">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M26 1H1L11 12.0367V21H16V12.0367L26 1Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg></h3>
                            <div class="filter-section">
                                <div class="filter-option">
                                    <h4 class="small-size">Services<svg class="dropdown-icon" xmlns="http://www.w3.org/2000/svg" width="13.747px" height="18.742px" viewBox="0 0 21 16" fill="none">
                                            <path d="M19.7421 1L10.3706 14.747L1.00001 1" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg></h4>
                                    <div class="filter-content smaller-size" id="modal-services-filters">

                                    </div>
                                </div>
                                <div class="filter-option">
                                    <h4 class="small-size">Industry<svg class="dropdown-icon" xmlns="http://www.w3.org/2000/svg" width="13.747px" height="18.742px" viewBox="0 0 21 16" fill="none">
                                            <path d="M19.7421 1L10.3706 14.747L1.00001 1" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg></h4>
                                    <div class="filter-content smaller-size" id="modal-industries-filters">

                                    </div>
                                </div>
                                <div class="filter-option">
                                    <h4 class="small-size">Content Type<svg class="dropdown-icon" xmlns="http://www.w3.org/2000/svg" width="13.747px" height="18.742px" viewBox="0 0 21 16" fill="none">
                                            <path d="M19.7421 1L10.3706 14.747L1.00001 1" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg></h4>
                                    <div class="filter-content smaller-size" id="modal-content-type-filter">

                                    </div>
                                </div>
                            </div>
                            <!-- 	<button class="font-bold small-size" id="clearAllBtn"> Clear All
  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
  <path d="M1 1L15 15" stroke="white" stroke-width="2" stroke-linecap="round"/>
  <path d="M1 15L15 0.999997" stroke="white" stroke-width="2" stroke-linecap="round"/>
</svg>
</button> -->
                            <button class="filter-now-btn small-size">Filter Now</button>
                        </div>
                    </div>

                </section>
                <div class="insight-post-sec">
                    <div id="postGrid" class="grid-container">
                        <div id="loading-overlay">
                            <div class="spinner"></div>
                        </div>
                        <!-- Posts will be loaded here -->
                    </div>
                    <div id="default-pagination"></div>
                    <div id="filtered-pagination" style="display: none;"></div>
                    <div id="search-pagination" style="display: none;"></div>
                </div>
            </div>
        </article>
    </main>
    <?php the_content(); ?>
</div>

<?php get_footer(); ?>