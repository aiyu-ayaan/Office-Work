<?php

/**
 * Template Name: Press Release 
 * Template Post Type: post,press-release
 */
/**
 * The template for displaying all press_releases.
 *
 * @package Astra
 * @since 1.0.0
 */

if (! defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

get_header(); ?>
<?php

$post_type = get_the_terms(get_the_ID(), 'post_type_category')[0]->name;

function formatDateWithSuperscript($format = 'F Y')
{
    $day = get_the_date('j');
    $month = get_the_date('F');
    $year = get_the_date('Y');

    // Determine suffix
    if ($day >= 11 && $day <= 13) {
        $suffix = 'th';
    } else {
        $suffix = match ($day % 10) {
            1 => 'st',
            2 => 'nd',
            3 => 'rd',
            default => 'th'
        };
    }

    return $day . '<sup>' . $suffix . '</sup> ' . $month . ' ' . $year;
}

$creation_date = formatDateWithSuperscript();

$press_release_author_section = get_field('acf_press_release_author_section');
if (!empty($press_release_author_section)) {
    $section_heading = $press_release_author_section['acf_press_release_author_section_heading'] ?? '';
    $text_above_button = $press_release_author_section['acf_press_release_author_card_text_above_button'] ?? '';
    $button_text = $press_release_author_section['acf_press_release_author_card_button_text'] ?? '';
    $button_url = $press_release_author_section['acf_press_release_author_card_button_url'] ?? '';
    $author_groups = $press_release_author_section['acf_press_release_single_author'] ?? '';
}
$banner_title = get_field('acf_press_release_banner_title');
$banner_image = get_field('acf_press_release_banner_image');
// DESCRIPTION: For the press_release content frame 
$minute_read =  get_post_read_minutes(get_the_ID(), $post_type);
?>
<div id="primary" <?php astra_primary_class(); ?>>
    <main id="main" class="site-main">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class('ast-article-single'); ?> itemscope itemtype="https://schema.org/press_releasePosting">
                    <div class="ast-post-format single-layout-1">
                        <div class="entry-content clear" data-ast-blocks-layout="true" itemprop="text">
                            <!-- press_release Banner            -->
                            <section class="press_release-banner">
                                <div class="press_release-bg-image manual-lazy-load"
                                    data-src="<?php echo ($banner_image); ?>"
                                    role="img"
                                    aria-label="Background image for press_release banner"
                                    style="background-image: url('data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' viewBox=\'0 0 3 1\'%3E%3C/svg%3E');">
                                </div>

                                <div class="press_release-hero-banner">
                                    <header>
                                        <h1 class="largest-size press_release-title">
                                            <?php echo ($banner_title); ?>
                                        </h1>
                                    </header>

                                    <div class="press_release-button-container">
                                        <p class="small-size press_release-bottom-text"><?php echo $creation_date; ?></p>
                                    </div>
                                </div>
                            </section>
                            <!-- 							press_release sticky progress bar  -->
                            <div class="progress-bar-wrapper">
                                <div class="scroll-progress-bar"></div>
                            </div>
                            <!-- press_release Content Frame -->
                            <div class="press_release-complete-content-wrapper post-content">
                                <div class="outer">
                                    <div class="share-frame">
                                        <div class="share-icons">
                                            <button class="share-toggle" aria-label="Toggle share options" aria-expanded="false"
                                                aria-controls="share-list">
                                                <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="36" height="69"
                                                    viewBox="0 0 36 69" fill="none" focusable="false">
                                                    <path d="M36 20C36 8.9543 27.0457 0 16 0H0V69H16C27.0457 69 36 60.0457 36 49V20Z"
                                                        fill="#1A2C47" />
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M25.043 38.2513C23.9417 38.2513 22.9586 38.7284 22.2659 39.4783L14.6891 36.1593C14.7223 35.9576 14.7513 35.7541 14.7513 35.543C14.7513 35.1485 14.674 34.7756 14.5623 34.418L22.2808 30.5424C22.9727 31.2822 23.95 31.7513 25.043 31.7513C27.137 31.7513 28.8346 30.0537 28.8346 27.9596C28.8346 25.8656 27.137 24.168 25.043 24.168C22.9489 24.168 21.2513 25.8656 21.2513 27.9596C21.2513 28.18 21.2801 28.393 21.3162 28.6031L13.3356 32.6102C12.6838 32.0813 11.8644 31.7513 10.9596 31.7513C8.86557 31.7513 7.16797 33.4489 7.16797 35.543C7.16797 37.637 8.86557 39.3346 10.9596 39.3346C12.061 39.3346 13.044 38.8575 13.7367 38.1077L21.3135 41.4266C21.2803 41.6284 21.2513 41.8318 21.2513 42.043C21.2513 44.137 22.9489 45.8346 25.043 45.8346C27.137 45.8346 28.8346 44.137 28.8346 42.043C28.8346 39.9489 27.137 38.2513 25.043 38.2513ZM25.043 26.3346C25.939 26.3346 26.668 27.0636 26.668 27.9596C26.668 28.8556 25.939 29.5846 25.043 29.5846C24.147 29.5846 23.418 28.8556 23.418 27.9596C23.418 27.0636 24.147 26.3346 25.043 26.3346ZM10.9596 37.168C10.0636 37.168 9.33464 36.439 9.33464 35.543C9.33464 34.647 10.0636 33.918 10.9596 33.918C11.8556 33.918 12.5846 34.647 12.5846 35.543C12.5846 36.439 11.8556 37.168 10.9596 37.168ZM25.043 43.668C24.147 43.668 23.418 42.939 23.418 42.043C23.418 41.147 24.147 40.418 25.043 40.418C25.939 40.418 26.668 41.147 26.668 42.043C26.668 42.939 25.939 43.668 25.043 43.668Z"
                                                        fill="white" />
                                                </svg>
                                            </button>
                                            <div class="share-list share-hidden">
                                                <span class="share-title smaller-size font-bold">SHARE</span>
                                                <div id="linkedin-share-btn" class="ic_share">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48" fill="none">
                                                        <path d="M44.4554 0H3.54671C1.58775 0 0 1.53922 0 3.43897V44.56C0 46.4597 1.58828 48.0005 3.54671 48.0005H44.4554C46.4144 48.0005 48 46.4592 48 44.56V3.43897C48 1.53975 46.4144 0 44.4554 0ZM14.5522 40.1796H7.29981V18.5079H14.5522V40.1796ZM10.9265 15.5474H10.878C8.44596 15.5474 6.86941 13.8839 6.86941 11.8017C6.86941 9.67744 8.49236 8.05929 10.9724 8.05929C13.4529 8.05929 14.9788 9.67691 15.0268 11.8017C15.0268 13.8844 13.4535 15.5474 10.9265 15.5474ZM40.6954 40.1796H33.4452V28.5848C33.4452 25.6707 32.3945 23.6829 29.7726 23.6829C27.7667 23.6829 26.5763 25.0243 26.0536 26.3187C25.8595 26.7816 25.812 27.428 25.812 28.0744V40.1791H18.5629C18.5629 40.1791 18.6578 20.54 18.5629 18.5074H25.8126V21.58C26.7752 20.1037 28.4947 17.9975 32.3454 17.9975C37.1172 17.9975 40.6954 21.093 40.6954 27.7528V40.1796ZM25.7656 21.6488C25.7784 21.6285 25.7955 21.6034 25.8126 21.58V21.6488H25.7656Z" fill="#1A2C47" />
                                                    </svg>
                                                </div>
                                                <div id="email-share-btn" class="ic_share"><svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48" fill="none">
                                                        <path d="M43 0C45.7614 5.15405e-07 48 2.23858 48 5V43C48 45.7614 45.7614 48 43 48H5C2.23858 48 0 45.7614 0 43V5C5.15422e-07 2.23858 2.23858 0 5 0H43ZM8.60254 10C6.06079 10 4 12.0062 4 14.4805V33.5195C4 35.9938 6.06079 38 8.60254 38H39.3975C41.9392 38 44 35.9938 44 33.5195V14.4805C44 12.0062 41.9392 10 39.3975 10H8.60254Z" fill="#1A2C47" />
                                                        <path d="M44 10L25.4607 27.9375C24.6742 28.8125 23.3258 28.8125 22.5393 27.9375L4 10M4 38L18.4944 24M44 38L29.5056 24" stroke="#1A2C47" stroke-width="2" />
                                                    </svg></div>
                                                <div id="copy-link-btn" class="ic_share"><svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48" fill="none">
                                                        <path d="M43 0C45.7614 5.15405e-07 48 2.23858 48 5V43C48 45.7614 45.7614 48 43 48H5C2.23858 48 0 45.7614 0 43V5C5.15422e-07 2.23858 2.23858 0 5 0H43ZM29.0566 21.9121C26.4403 17.2984 19.9192 16.5988 16.124 20.3936L9.36816 27.1494C6.21084 30.3068 6.21036 35.4735 9.36719 38.6318C12.5248 41.7894 17.6923 41.7894 20.8506 38.6318L26.54 32.9424C27.0387 32.4437 27.4709 31.8824 27.8242 31.2715C25.9728 31.733 23.9879 31.5379 22.25 30.6865L17.5889 35.3477C16.1631 36.7733 13.8265 36.7747 12.3994 35.3477C10.9726 33.9206 10.9725 31.5852 12.3994 30.1582L18.999 23.5586C20.3511 22.2066 23.0499 21.8037 25.0898 23.6709C27.064 23.4631 27.8303 23.086 29.0566 21.9121ZM38.6318 9.36816C35.4736 6.20992 30.3061 6.21067 27.1484 9.36816L21.6602 14.8574C21.1788 15.3388 20.759 15.8785 20.4131 16.4648C22.0952 16.1574 23.858 16.3807 25.4238 17.1338L30.1572 12.4004C31.583 10.9746 33.9196 10.9733 35.3467 12.4004C36.7737 13.8275 36.7737 16.1628 35.3467 17.5898L28.7471 24.1885C27.662 25.2733 26.0944 25.5758 24.7578 25.0107C22.4876 24.0506 21.3255 23.3812 18.9424 25.4521C21.1132 30.423 27.8886 31.5926 31.875 27.6074L38.6309 20.8516C41.7885 17.6939 41.7885 12.5258 38.6309 9.36816H38.6318Z" fill="#1A2C47" />
                                                    </svg></div>
                                                <!--                       here -->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="main-content">
                                        <?php if (have_rows('acf_press_release_content_blocks')): ?>
                                            <?php while (have_rows('acf_press_release_content_blocks')): the_row(); ?>

                                                <!-- Text Block -->
                                                <?php if (get_row_layout() === 'acf_press_release_text_block'): ?>
                                                    <section class="acf-press_release-content-block">
                                                        <div class="container">
                                                            <?php the_sub_field('acf_press_release_text_content'); ?>
                                                        </div>
                                                    </section>

                                                    <!-- Image Block -->
                                                <?php elseif (get_row_layout() === 'acf_press_release_image_block'): ?>
                                                    <?php
                                                    $image = get_sub_field('acf_press_release_image');
                                                    $alignment = get_sub_field('acf_press_release_image_alignment');
                                                    $image_width = get_sub_field('acf_press_release_image_width');
                                                    if (!$image_width) {
                                                        $image_width = 100; // default width
                                                    }

                                                    ?>
                                                    <?php if ($image): ?>
                                                        <section class="acf-press_release-image-block align-<?php echo esc_attr($alignment); ?>">
                                                            <div class="container">
                                                                <img src="<?php echo esc_url($image['url']); ?>" alt="" style="width: <?php echo esc_attr($image_width); ?>%;">
                                                            </div>
                                                        </section>
                                                    <?php endif; ?>

                                                    <!-- Blue Divider Block -->
                                                <?php elseif (get_row_layout() === 'acf_press_release_blue_divider'): ?>
                                                    <section class="acf-press_release-blue-divider">
                                                        <div class="container">
                                                            <p><?php the_sub_field('acf_press_release_divider_content'); ?></p>
                                                        </div>
                                                    </section>


                                                    <!-- person card -->
                                                <?php elseif (get_row_layout() === 'acf_press_release_person_card'): ?>
                                                    <section class="acf-press_release-person-card-block">
                                                        <div class="container person-card-container">
                                                            <div class="person-card-wrapper">
                                                                <div class="left-section">
                                                                    <?php
                                                                    $image = get_sub_field('acf_press_release_person_image');
                                                                    if ($image):
                                                                    ?>
                                                                        <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" class="person-image" />
                                                                    <?php endif; ?>
                                                                    <div class="person-meta">
                                                                        <h4 class="person-name small-size font-bold"><?php the_sub_field('acf_press_release_person_name'); ?></h4>
                                                                        <p class="person-designation smaller-size font-bold"><?php the_sub_field('acf_press_release_person_designation'); ?></p>
                                                                    </div>
                                                                </div>
                                                                <div class="right-section">
                                                                    <div class="person-description small-size">
                                                                        <?php the_sub_field('acf_press_release_person_description'); ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </section>

                                                    <!-- Two Column WYSIWYG Block -->
                                                <?php elseif (get_row_layout() === 'acf_press_release_two_column_layout'): ?>
                                                    <section class="acf-press_release-two-column-block">
                                                        <div class="container">
                                                            <div class="two-column-layout">
                                                                <div class="column left-column">
                                                                    <?php the_sub_field('acf_press_release_left_column_content'); ?>
                                                                </div>
                                                                <div class="column right-column">
                                                                    <?php the_sub_field('acf_press_release_right_column_content'); ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </section>


                                                <?php endif; ?>

                                            <?php endwhile; ?>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <div id="copy-notification">
                                Link copied to clipboard!
                            </div>


                            <?php the_content(); ?>
                        </div>
                    </div>
                </article>
        <?php endwhile;
        endif; ?>
    </main>


</div><!-- #primary -->
<?php

get_footer(); ?>