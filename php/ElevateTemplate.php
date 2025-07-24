<?php
/*
Template Name: Elevate connect
*/

/**
 * Custom Elevate template for Astra child theme.
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

$our_expertise_section_main_heading = get_field('acf_our_expertise_section_main_heading');
$our_expertise_video_url = get_field('acf_our_expertise_video_url');
$our_expertise_video_thumbnail = get_field('our_expertise_video_thumbnail');
$our_expertise_description_para_1 = get_field('acf_our_expertise_description_para_1');
$our_expertise_description_para_2 = get_field('acf_our_expertise_description_para_2');

$our_innovations_section_main_heading = get_field('acf_innovation_page_our_innovations_section_heading');
$our_innovations_sub_heading = get_field('acf_innovation_page_our_innovations_sub_heading');
// // $our_innovations_card_titles = get_field('our_innovations_card_title');
// // $our_innovations_card_description = get_field('our_innovations_card_description');
// // $our_innovations_card_background_image = get_field('our_innovations_card_background_image');
$our_innovations_button_text = get_field('acf_our_innovations_button_text');
$our_innovations_button_url = get_field('acf_our_innovations_button_url');

$our_clients_section_heading = get_field('acf_our_clients_section_heading');

$banner_section_fields = get_field('acf_elevate_banner_section_fields');
$elevate_leader_section_fields = get_field('acf_elevate_leader_section_fields');
$keynote_section_fields = get_field('acf_elevate_keynote_section_fields');
$elevate_glimpse_section_fields = get_field('acf_elevate_glimpse_section_fields');
$elevate_agenda_section_fields = get_field('acf_elevate_agenda_section_fields');
$elevate_join_us_at_section_fields = get_field('acf_elevate_join_us_at_section_fields');


// DESCRIPTION: fetching banner section fields from $banner_seaction_fields group
$banner_text_above_logo = $banner_section_fields['acf_elevate_banner_text_above_logo'];
$banner_logo = $banner_section_fields['acf_elevate_banner_logo'];
$banner_title = $banner_section_fields['acf_elevate_banner_title'];
$banner_text_below_title = $banner_section_fields['acf_elevate_banner_text_below_title'];
$banner_button_text = $banner_section_fields['acf_elevate_banner_button_text'];
$banner_button_url = $banner_section_fields['acf_elevate_banner_button_url'];
$counter_left_size_title = $banner_section_fields['acf_elevate_counter_left_side_title'];
$counter_date_picker = $banner_section_fields['acf_elevate_counter_date_picker'];


// DESCRIPTION: fetching elevate leader section fields from $elevate_leader_section_fields group
$elevate_leader_title = $elevate_leader_section_fields['acf_elevate_leader_section_title'];
$elevate_leader_section_sub_title = $elevate_leader_section_fields['acf_elevate_leader_section_sub_title'];


// DESCRIPTION:Glimpse section fields from $elevate_glimpse_section_fields group
$elevate_glimpse_section_title = $elevate_glimpse_section_fields['acf_elevate_glimpse_section_heading'];
$elevate_glimpse_section_sub_title = $elevate_glimpse_section_fields['acf_elevate_glimpse_section_sub_heading'];
$elevate_glimpse_section_video_url = $elevate_glimpse_section_fields['acf_elevate_glimpse_section_vimeo_video_url'];


// DESCRIPTION: Agenda section fields from $elevate_agenda_section_fields group
$agenda_section_heading = $elevate_agenda_section_fields['acf_elevate_agenda_section_heading'];
$agenda_section_items = $elevate_agenda_section_fields['acf_elevate_agenda_section_items'] ?? [];


// DESCRIPTION: Join us at section fields from $elevate_join_us_at_section_fields group
$join_us_section_heading = $elevate_join_us_at_section_fields['acf_elevate_join_us_at_section_heading'];
$join_us_address_card = $elevate_join_us_at_section_fields['acf_elevate_join_us_at_address_card'];
$join_us_description = $elevate_join_us_at_section_fields['acf_elevate_join_us_at_description'];
$tranpost_info_station = $elevate_join_us_at_section_fields['acf_elevate_join_us_at_transport_info_tube_icon'];
$tranpost_info_overground = $elevate_join_us_at_section_fields['acf_elevate_join_us_at_transport_info_train_icon'];
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
                <!-- ECL Banner section -->

                <div class="elevate-banner">
                    <!-- <div class="banner-bg manual-lazy-load" data-src="/wp-content/uploads/2025/07/Isolation_Mode.png"
        src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 3 1'%3E%3C/svg%3E">
    </div> -->
                    <div class="animated-svg">
                        <svg viewBox="0 0 1920 1074" fill="none" xmlns="http://www.w3.org/2000/svg"
                            preserveAspectRatio="xMidYMid slice">
                            <g clip-path="url(#clip0_17466_1413)">
                                <g opacity="0.3">
                                    <path d="M1749.12 229.891L1477.5 229.829" stroke="#00CCFF" stroke-width="2.65241"
                                        stroke-miterlimit="10" stroke-dasharray="8.77 8.77" />
                                    <path d="M1417.83 261.53V40.7959" stroke="#00CCFF" stroke-width="2.65241" stroke-miterlimit="10" />
                                    <path d="M1465.5 657.931H1878.07" stroke="#00CCFF" stroke-width="2.65241" stroke-miterlimit="10" />
                                    <path d="M1878.07 799.568H2098.77" stroke="#00CCFF" stroke-width="2.65241" stroke-miterlimit="10" />
                                    <path d="M1313 406.103H1417.01" stroke="#00CCFF" stroke-width="2.65241" stroke-miterlimit="10"
                                        stroke-dasharray="8.84 12.38" />
                                    <path d="M111.985 623.786H414.984" stroke="#00CCFF" stroke-width="2.65241" stroke-miterlimit="10" />
                                    <path d="M414.983 481.666V893.38" stroke="#00CCFF" stroke-width="2.65241" stroke-miterlimit="10" />
                                    <path d="M1106.59 40.7959V182" stroke="#00CCFF" stroke-width="2.65241" stroke-miterlimit="10" />
                                    <path d="M680.901 1224.18V917.914" stroke="#00CCFF" stroke-width="2.65241" stroke-miterlimit="10" />
                                    <path d="M1878.07 40.7959V261.53" stroke="#00CCFF" stroke-width="2.65241" stroke-miterlimit="10"
                                        stroke-dasharray="8.84 12.38" />
                                    <path d="M803 41V175.204" stroke="#00CCFF" stroke-width="2.65241" stroke-miterlimit="10"
                                        stroke-dasharray="8.84 12.38" />
                                    <path d="M-108.207 917.914H112.49" stroke="#00CCFF" stroke-width="2.65241" stroke-miterlimit="10"
                                        stroke-dasharray="8.84 12.38" />
                                    <path d="M1878.07 261.53V267.278" stroke="#00CCFF" stroke-width="2.65241" stroke-miterlimit="10" />
                                    <path d="M1878.07 283.258V1178.75" stroke="#00CCFF" stroke-width="2.65241" stroke-miterlimit="10"
                                        stroke-dasharray="8.77 12.29" />
                                    <path d="M57.3154 261.53L613 261.53M1933.24 261.53H1248" stroke="#00CCFF" stroke-width="2.65241"
                                        stroke-miterlimit="10" />
                                    <path d="M112.49 482.103V476.354" stroke="#00CCFF" stroke-width="2.65241" stroke-miterlimit="10" />
                                    <path d="M112.49 460.259V275.326" stroke="#00CCFF" stroke-width="2.65241" stroke-miterlimit="10"
                                        stroke-dasharray="8.84 12.36" />
                                    <path d="M112.49 267.278V261.53" stroke="#00CCFF" stroke-width="2.65241" stroke-miterlimit="10" />
                                    <path
                                        d="M56.5371 261.111L56.3125 261.53L56.5371 261.948L63.8262 275.529L25.8047 261.529L63.8262 247.529L56.5371 261.111Z"
                                        fill="#00CCFF" stroke="#00CCFF" stroke-width="1.76827" />
                                    <path d="M1106.59 1168.45V856.5" stroke="#00CCFF" stroke-width="2.65241" stroke-miterlimit="10" />
                                    <path d="M282.055 482.103L500 482.002" stroke="#00CCFF" stroke-width="2.65241"
                                        stroke-miterlimit="10" />
                                    <path d="M414.983 261.53V482.103" stroke="#00CCFF" stroke-width="2.65241" stroke-miterlimit="10"
                                        stroke-dasharray="8.84 12.38" />
                                    <path d="M858 918L858 1200" stroke="#00CCFF" stroke-width="2.65241" stroke-miterlimit="10" />
                                    <path d="M1354.83 1192.47V799.568" stroke="#00CCFF" stroke-width="2.65241" stroke-miterlimit="10"
                                        stroke-dasharray="8.84 12.38" />
                                    <path d="M1417.83 255.85V453.5" stroke="#00CCFF" stroke-width="2.65241" stroke-miterlimit="10" />
                                    <path d="M112.49 917.914H858.263" stroke="#00CCFF" stroke-width="2.65241" stroke-miterlimit="10"
                                        stroke-dasharray="8.84 12.38" />
                                    <path d="M1654.08 799.568V657.931" stroke="#00CCFF" stroke-width="2.65241" stroke-miterlimit="10" />
                                    <path d="M1654.08 1199.65V799.568" stroke="#00CCFF" stroke-width="2.65241" stroke-miterlimit="10"
                                        stroke-dasharray="8.84 12.38" />
                                    <path
                                        d="M1863.56 799.568L1825.55 813.57L1832.82 799.986L1833.05 799.569L1832.82 799.151L1825.55 785.567L1863.56 799.568Z"
                                        fill="#00CCFF" stroke="#00CCFF" stroke-width="1.76827" />
                                    <path d="M1377.5 799.568H1832.04" stroke="#00CCFF" stroke-width="2.65241" stroke-miterlimit="10" />
                                    <path d="M415 -19L415 262" stroke="#00CCFF" stroke-width="2.65241" stroke-miterlimit="10"
                                        stroke-dasharray="8.84 12.38" />
                                    <path d="M2098.77 657.931H1878.07" stroke="#00CCFF" stroke-width="2.65241" stroke-miterlimit="10"
                                        stroke-dasharray="8.84 12.38" />
                                    <path d="M111.985 756.962H414.984" stroke="#00CCFF" stroke-width="2.65241" stroke-miterlimit="10" />
                                    <path
                                        d="M126.487 527.771L112.908 520.481L112.49 520.256L112.072 520.481L98.4922 527.771L112.49 489.745L126.487 527.771Z"
                                        fill="#00CCFF" stroke="#00CCFF" stroke-width="1.76827" />
                                    <path d="M112.49 1164.88V521.26" stroke="#00CCFF" stroke-width="2.65241" stroke-miterlimit="10" />
                                </g>
                                <g opacity="0.85">
                                    <path d="M158.768 703.25C61.1435 685.773 -29.6313 648.541 -109.275 595.839" stroke="#00CCFF"
                                        stroke-width="2.65241" stroke-miterlimit="10" />
                                    <path d="M257.69 713.942C227.988 712.792 198.722 709.826 170.055 705.159" stroke="#00CCFF"
                                        stroke-width="2.65241" stroke-miterlimit="10" stroke-dasharray="8.95 8.95" />
                                    <path d="M164.423 704.239C162.538 703.917 160.653 703.595 158.768 703.25" stroke="#ECEAFF"
                                        stroke-width="2.65241" stroke-miterlimit="10" />
                                    <path d="M2079.96 617.923C2079.96 744.109 1980.42 847.049 1855.59 852.476" stroke="#78A0F6"
                                        stroke-width="2.65241" stroke-miterlimit="10" />
                                    <path d="M1855.84 383.394C1980.56 388.935 2079.96 491.829 2079.96 617.923" stroke="#78A0F6"
                                        stroke-width="2.65241" stroke-miterlimit="10" stroke-dasharray="8.77 8.77" />
                                    <path d="M1614.66 573.707C1628.96 498.681 1668.23 440.612 1735.57 409.272" stroke="#23E4BA"
                                        stroke-width="2.65241" stroke-miterlimit="10" stroke-dasharray="9.39 9.39" />
                                    <path
                                        d="M1646.06 741.312C1627.32 707.713 1615.48 669.559 1612.59 628.647C1611.36 611.273 1611.8 594.152 1613.79 577.455"
                                        stroke="#23E4BA" stroke-width="2.65241" stroke-miterlimit="10" />
                                    <path d="M1719.21 816.008C1690 798.5 1668 782.5 1646.21 741" stroke="#00CCFF" stroke-width="2.65241"
                                        stroke-miterlimit="10" />
                                    <path d="M1834.62 852.453C1802 851.004 1771.12 842.887 1743.31 829.459" stroke="#23E4BA"
                                        stroke-width="2.65241" stroke-miterlimit="10" />
                                    <path d="M1795.12 417.074C1788.64 597.34 1680.57 757.721 1526.43 830.632" stroke="#00CCFF"
                                        stroke-width="2.65241" stroke-miterlimit="10" stroke-dasharray="8.77 8.77" />
                                    <path d="M172.847 291.421H527.378" stroke="#23E4BA" stroke-width="2.65241" stroke-miterlimit="10" />
                                    <path d="M-47.3545 291.421H146.261" stroke="#23E4BA" stroke-width="2.65241" stroke-miterlimit="10"
                                        stroke-dasharray="8.95 8.95" />
                                    <path d="M541.172 875.446V881.194" stroke="#23E4BA" stroke-width="2.65241" stroke-miterlimit="10" />
                                    <path d="M541.172 888.391V1071.32" stroke="#23E4BA" stroke-width="2.65241" stroke-miterlimit="10"
                                        stroke-dasharray="9.07 9.07" />
                                    <path d="M542.074 -205.775L540.976 275.954" stroke="#23E4BA" stroke-width="2.65241"
                                        stroke-miterlimit="10" stroke-dasharray="8.95 8.95" />
                                    <path d="M146 875L-11 875" stroke="#78A0F6" stroke-width="2.65241" stroke-miterlimit="10" />
                                    <path d="M307.577 875.446H173.496" stroke="#78A0F6" stroke-width="2.65241" stroke-miterlimit="10" />
                                    <path d="M541.172 875.446H328.773" stroke="#23E4BA" stroke-width="2.65241" stroke-miterlimit="10" />
                                    <path d="M257.691 482.517H179.347" stroke="#78A0F6" stroke-width="2.65241" stroke-miterlimit="10" />
                                    <path d="M1845.24 870.157V1046.49" stroke="#00CCFF" stroke-width="2.65241" stroke-miterlimit="10"
                                        stroke-dasharray="9.02 9.02" />
                                    <path d="M1845.24 1053.41V1192.24" stroke="#00CCFF" stroke-width="2.65241" stroke-miterlimit="10" />
                                    <path d="M1845.24 699.434V842.428" stroke="#23E4BA" stroke-width="2.65241" stroke-miterlimit="10" />
                                    <path d="M1845.24 393.763V699.433" stroke="#00CCFF" stroke-width="2.65241" stroke-miterlimit="10" />
                                    <path d="M328.773 875.699C443.49 881.079 535.539 973.144 540.919 1087.88" stroke="#23E4BA"
                                        stroke-width="2.65241" stroke-miterlimit="10" />
                                    <path d="M328.796 864.846H307.577V886.068H328.796V864.846Z" stroke="#23E4BA" stroke-width="2.65241"
                                        stroke-miterlimit="10" />
                                    <path
                                        d="M1662.59 742.796C1662.59 750.43 1656.4 756.592 1648.79 756.592C1641.18 756.592 1635 750.407 1635 742.796C1635 735.185 1641.18 729 1648.79 729C1656.4 729 1662.59 735.185 1662.59 742.796Z"
                                        fill="#23E4BA" />
                                    <path
                                        d="M554.965 875.4C554.965 883.034 548.781 889.196 541.172 889.196C533.562 889.196 527.378 883.011 527.378 875.4C527.378 867.789 533.562 861.604 541.172 861.604C548.781 861.604 554.965 867.789 554.965 875.4Z"
                                        fill="#23E4BA" />
                                    <path
                                        d="M1528.29 837.53C1528.29 845.164 1522.11 851.326 1514.5 851.326C1506.89 851.326 1500.71 845.141 1500.71 837.53C1500.71 829.92 1506.89 823.734 1514.5 823.734C1522.11 823.734 1528.29 829.92 1528.29 837.53Z"
                                        fill="#00CCFF" />
                                    <path d="M159.986 699.433V500.944" stroke="#78A0F6" stroke-width="2.65241" stroke-miterlimit="10" />
                                    <path d="M159.986 463.235V304.597" stroke="#23E4BA" stroke-width="2.65241" stroke-miterlimit="10" />
                                    <path
                                        d="M285.278 483.137C285.278 490.771 279.093 496.933 271.484 496.933C263.875 496.933 257.69 490.748 257.69 483.137C257.69 475.526 263.875 469.341 271.484 469.341C279.093 469.341 285.278 475.526 285.278 483.137Z"
                                        fill="#23E4BA" stroke="#23E4BA" stroke-width="2.65241" stroke-miterlimit="10" />
                                    <path
                                        d="M405.42 291.421C405.42 299.055 399.236 305.217 391.627 305.217C384.017 305.217 377.833 299.032 377.833 291.421C377.833 283.81 384.017 277.625 391.627 277.625C399.236 277.625 405.42 283.81 405.42 291.421Z"
                                        fill="#00CCFF" stroke="#00CCFF" stroke-width="2.65241" stroke-miterlimit="10" />
                                    <path d="M1465.28 1182.76L1464.86 1038.12" stroke="#78A0F6" stroke-width="2.65241"
                                        stroke-miterlimit="10" stroke-dasharray="9.02 9.02" />
                                    <path d="M232.356 158.429C255.139 194.413 269.116 236.513 271.231 281.741" stroke="#78A0F6"
                                        stroke-width="2.65241" stroke-miterlimit="10" />
                                    <path d="M284.382 279.441H258.588V305.24H284.382V279.441Z" fill="#78A0F6" stroke="#78A0F6"
                                        stroke-width="2.65241" stroke-miterlimit="10" />
                                    <path d="M554.459 422.321H527.378V441.336H554.459V422.321Z" fill="#00CCFF" stroke="#00CCFF"
                                        stroke-width="2.65241" stroke-miterlimit="10" />
                                    <path
                                        d="M173.78 703.503C173.78 711.137 167.595 717.299 159.986 717.299C152.377 717.299 146.192 711.114 146.192 703.503C146.192 695.892 152.377 689.707 159.986 689.707C167.595 689.707 173.78 695.892 173.78 703.503Z"
                                        fill="#00CCFF" stroke="#00CCFF" stroke-width="2.65241" stroke-miterlimit="10" />
                                    <path d="M391.626 291.421V425.241" stroke="#00CCFF" stroke-width="2.65241" stroke-miterlimit="10" />
                                    <path d="M402.225 435.863H540.919" stroke="#00CCFF" stroke-width="2.65241" stroke-miterlimit="10" />
                                    <path d="M-46.8711 146.609L210.548 146.609" stroke="#78A0F6" stroke-width="2.65241"
                                        stroke-miterlimit="10" stroke-dasharray="8.79 8.79" />
                                    <path d="M402.224 425.241H381.005V446.463H402.224V425.241Z" stroke="#00CCFF" stroke-width="2.65241"
                                        stroke-miterlimit="10" />
                                    <path d="M172.883 278.522H147.089V304.32H172.883V278.522Z" stroke="#23E4BA" stroke-width="2.65241"
                                        stroke-miterlimit="10" />
                                    <path d="M1474.45 1046.49H1719.31" stroke="#23E4BA" stroke-width="2.65241" stroke-miterlimit="10" />
                                    <path d="M2004.12 1046.49H1844.99" stroke="#00CCFF" stroke-width="2.65241" stroke-miterlimit="10" />
                                    <path d="M158.768 899.635V991.814" stroke="#78A0F6" stroke-width="2.65241" stroke-miterlimit="10"
                                        stroke-dasharray="8.79 8.79" />
                                    <path d="M148.147 1002.44H-10.9619" stroke="#78A0F6" stroke-width="2.65241"
                                        stroke-miterlimit="10" />
                                    <path d="M172.975 988.204H144.537V1016.65H172.975V988.204Z" fill="#78A0F6" />
                                    <path d="M1514.5 582.214V831" stroke="#00CCFF" stroke-width="2.65241" stroke-miterlimit="10" />
                                    <path d="M1784.07 405.904H1526.65" stroke="#00CCFF" stroke-width="2.65241" stroke-miterlimit="10" />
                                    <path d="M1523 574H1615" stroke="#78A0F6" stroke-width="2.65241" stroke-miterlimit="10" />
                                    <path d="M1621 574H1765" stroke="#23E4BA" stroke-width="2.65241" stroke-miterlimit="10" />
                                    <path d="M1514.5 560.109V417.147" stroke="#78A0F6" stroke-width="2.65241" stroke-miterlimit="10" />
                                    <path d="M1746.29 230.052H1825.92" stroke="#78A0F6" stroke-width="2.65241" stroke-miterlimit="10" />
                                    <path d="M1845.24 699.434H1924.55" stroke="#23E4BA" stroke-width="2.65241" stroke-miterlimit="10" />
                                    <path d="M1855.61 688.834H1834.39V710.057H1855.61V688.834Z" fill="#23E4BA" stroke="#23E4BA"
                                        stroke-width="2.65241" stroke-miterlimit="10" />
                                    <path d="M1845.24 372.541V248.034" stroke="#78A0F6" stroke-width="2.65241" stroke-miterlimit="10" />
                                    <path d="M1957.7 230.052H1864.27" stroke="#78A0F6" stroke-width="2.65241" stroke-miterlimit="10" />
                                    <path d="M1625.47 564.01H1604.25V585.232H1625.47V564.01Z" fill="#23E4BA" stroke="#23E4BA"
                                        stroke-width="2.65241" stroke-miterlimit="10" />
                                    <path
                                        d="M238.449 146.978C238.449 154.612 232.265 160.774 224.656 160.774C217.046 160.774 210.862 154.589 210.862 146.978C210.862 139.368 217.046 133.183 224.656 133.183C232.265 133.183 238.449 139.368 238.449 146.978Z"
                                        stroke="#78A0F6" stroke-width="2.65241" stroke-miterlimit="10" />
                                    <path
                                        d="M173.131 875.577C173.131 883.211 166.947 889.373 159.338 889.373C151.728 889.373 145.544 883.188 145.544 875.577C145.544 867.966 151.728 861.781 159.338 861.781C166.947 861.781 173.131 867.966 173.131 875.577Z"
                                        fill="#78A0F6" stroke="#78A0F6" stroke-width="2.65241" stroke-miterlimit="10" />
                                    <path
                                        d="M179.346 481.44C179.346 491.873 170.895 500.295 160.495 500.295C150.095 500.295 141.644 491.841 141.644 481.44C141.644 471.039 150.095 462.585 160.495 462.585C170.895 462.585 179.346 471.039 179.346 481.44Z"
                                        stroke="#78A0F6" stroke-width="2.65241" stroke-miterlimit="10" />
                                    <path
                                        d="M1864.27 229.179C1864.27 239.612 1855.82 248.034 1845.42 248.034C1835.02 248.034 1826.57 239.581 1826.57 229.179C1826.57 218.778 1835.02 210.325 1845.42 210.325C1855.82 210.325 1864.27 218.778 1864.27 229.179Z"
                                        stroke="#78A0F6" stroke-width="2.65241" stroke-miterlimit="10" />
                                    <path d="M1844.99 1046.49H1742.71" stroke="#00CCFF" stroke-width="2.65241" stroke-miterlimit="10" />
                                    <path d="M1730.94 1034.72V837.07" stroke="#00CCFF" stroke-width="2.65241" stroke-miterlimit="10" />
                                    <path d="M1855.61 1035.87H1834.39V1057.09H1855.61V1035.87Z" fill="#00CCFF" stroke="#00CCFF"
                                        stroke-width="2.65241" stroke-miterlimit="10" />
                                    <path d="M1805.22 394.969H1784V416.191H1805.22V394.969Z" stroke="#00CCFF" stroke-width="2.65241"
                                        stroke-miterlimit="10" />
                                    <path d="M1514.5 394.66V231.294" stroke="#23E4BA" stroke-width="2.65241" stroke-miterlimit="10" />
                                    <path d="M1525.12 217.314H1503.9V238.537H1525.12V217.314Z" fill="#23E4BA" stroke="#23E4BA"
                                        stroke-width="2.65241" stroke-miterlimit="10" />
                                    <path d="M271.484 483.137V700.537" stroke="#23E4BA" stroke-width="2.65241" stroke-miterlimit="10" />
                                    <path
                                        d="M285.278 714.356C285.278 721.99 279.093 728.152 271.484 728.152C263.875 728.152 257.69 721.967 257.69 714.356C257.69 706.745 263.875 700.56 271.484 700.56C279.093 700.56 285.278 706.745 285.278 714.356Z"
                                        stroke="#00CCFF" stroke-width="2.65241" stroke-miterlimit="10" />
                                    <path d="M1760.5 215.819H1732.06V244.262H1760.5V215.819Z" fill="#78A0F6" />
                                    <path d="M1528.44 558.809H1500V587.251H1528.44V558.809Z" fill="#78A0F6" />
                                    <path d="M1855.86 372.541H1834.64V393.763H1855.86V372.541Z" stroke="#00CCFF" stroke-width="2.65241"
                                        stroke-miterlimit="10" />
                                    <path
                                        d="M1744.75 823.274C1744.75 830.908 1738.57 837.07 1730.96 837.07C1723.35 837.07 1717.17 830.885 1717.17 823.274C1717.17 815.664 1723.35 809.479 1730.96 809.479C1738.57 809.479 1744.75 815.664 1744.75 823.274Z"
                                        stroke="#00CCFF" stroke-width="2.65241" stroke-miterlimit="10" />
                                    <path
                                        d="M1856 854C1856 860.087 1851.07 865 1845 865C1838.93 865 1834 860.068 1834 854C1834 847.932 1838.93 843 1845 843C1851.07 843 1856 847.932 1856 854Z"
                                        stroke="#00CCFF" stroke-width="2.65241" stroke-miterlimit="10" />
                                    <path
                                        d="M1514.5 417.147C1520.71 417.147 1525.74 412.113 1525.74 405.904C1525.74 399.694 1520.71 394.66 1514.5 394.66C1508.29 394.66 1503.26 399.694 1503.26 405.904C1503.26 412.113 1508.29 417.147 1514.5 417.147Z"
                                        stroke="#23E4BA" stroke-width="2.65241" stroke-miterlimit="10" />
                                    <path
                                        d="M554.736 288.8C554.736 296.433 548.551 302.596 540.942 302.596C533.333 302.596 527.148 296.41 527.148 288.8C527.148 281.189 533.333 275.004 540.942 275.004C548.551 275.004 554.736 281.189 554.736 288.8Z"
                                        stroke="#23E4BA" stroke-width="2.65241" stroke-miterlimit="10" />
                                    <path
                                        d="M1744.95 1045.92C1744.95 1053.55 1738.77 1059.71 1731.16 1059.71C1723.55 1059.71 1717.36 1053.53 1717.36 1045.92C1717.36 1038.31 1723.55 1032.12 1731.16 1032.12C1738.77 1032.12 1744.95 1038.31 1744.95 1045.92Z"
                                        fill="#23E4BA" />
                                    <path
                                        d="M1479.03 1044.25C1479.03 1051.88 1472.84 1058.05 1465.23 1058.05C1457.63 1058.05 1451.44 1051.86 1451.44 1044.25C1451.44 1036.64 1457.63 1030.46 1465.23 1030.46C1472.84 1030.46 1479.03 1036.64 1479.03 1044.25Z"
                                        fill="#23E4BA" />
                                    <path
                                        d="M1780.42 574.121C1780.42 581.755 1774.23 587.917 1766.62 587.917C1759.01 587.917 1752.83 581.732 1752.83 574.121C1752.83 566.51 1759.01 560.325 1766.62 560.325C1774.23 560.325 1780.42 566.51 1780.42 574.121Z"
                                        fill="#00CCFF" />
                                </g>
                            </g>
                            <defs>
                                <clipPath id="clip0_17466_1413">
                                    <rect width="1920" height="1206" fill="white" transform="translate(0 -132)" />
                                </clipPath>
                            </defs>
                        </svg>

                    </div>

                    <div class="banner-content">
                        <div class="text-above-logo smaller-size">
                            <?php echo esc_html($banner_text_above_logo); ?>
                        </div>

                        <div class="elevate-logo manual-lazy-load" data-src="<?php echo esc_url($banner_logo); ?>"
                            src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 3 1'%3E%3C/svg%3E">
                        </div>


                        <div class="elevate-title largest-size">
                            <?php echo esc_html($banner_title); ?>
                        </div>

                        <div class="text-below-title small-size">
                            <?php echo esc_html($banner_text_below_title); ?>
                        </div>

                        <a href="<?php echo esc_url($banner_button_url); ?>">
                            <button class=" custom-button elevate-get-in-touch">
                                <?php echo esc_html($banner_button_text); ?>
                            </button>
                        </a>
                    </div>
                </div>

                <!--DESCRIPTION: ECL Counter section -->
                <div class="counter-section">
                    <h1 class="medium-size event-start-title">
                        <?php echo esc_html($counter_left_size_title); ?>
                    </h1>

                    <div class="counter" endDate="<?php echo esc_html($counter_date_picker); ?>">
                        <div class="counter-day counter-style">
                            <span class="counter-number-day largest-size"></span>
                            <span class="counter-label-day smaller-size">Days</span>
                        </div>

                        <div class="counter-hours counter-style">
                            <span class="counter-number-hours largest-size"></span>
                            <span class="counter-label-hours smaller-size">Hours</span>
                        </div>
                        <div class="counter-minutes counter-style">
                            <span class="counter-number-minutes largest-size"></span>
                            <span class="counter-label-minutes smaller-size">Minutes</span>
                        </div>

                        <div class="counter-seconds counter-style">
                            <span class="counter-number-seconds largest-size"></span>
                            <span class="counter-label-seconds smaller-size">Seconds</span>
                        </div>
                    </div>
                </div>

                <!-- DESCRIPTION:Spacer b/w banner and Introduction -->

                <div aria-hidden="true" class="spacer-between-banner-introduction wp-block-spacer"></div>

                <!--DESCRIPTION: Introduction section-->
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

                <!--DESCRIPTION:Spacer b/w Introduction and Speakers section -->

                <div aria-hidden="true" class="spacer-between-introduction-speakers wp-block-spacer"></div>

                <!-- DESCRIPTION:Speaker section -->

                <div class="speakers-page-carousel-wrapper">
                    <div class="section-central-heading">
                        <h2 class="large-size font-bold"><?php echo esc_html($elevate_leader_title); ?></h2>
                        <h3 class="sub-heading small-size"><?php echo esc_html($elevate_leader_section_sub_title); ?></h3>
                    </div>

                    <div class="owl-carousel speakers-page-carousel">
                        <?php
                        // Get the repeater field items from the group
                        $elevate_leader_section_items = $elevate_leader_section_fields['acf_elevate_leader_section_items'] ?? [];
                        ?>

                        <?php if ($elevate_leader_section_items && is_array($elevate_leader_section_items)) : ?>
                            <?php foreach ($elevate_leader_section_items as $item) :
                                $name_and_designation = $item['acf_elevate_leader_section_item_name_and_designation'] ?? '';
                                $description = $item['acf_elevate_leader_section_item_description'] ?? '';
                                $image = $item['acf_elevate_leader_section_item_image'] ?? '';
                            ?>
                                <div class="item speakers-page-item">
                                    <div class="carousel-link">
                                        <div class="image-wrapper">
                                            <img decoding="async" src="<?php echo esc_url($image); ?>"
                                                alt="Real-Time Data Analytics: Zeroing Down On Better Business Decisions" class="carousel-image" />
                                            <div class="speaker-name smaller-size">
                                                <?php echo esc_html($name_and_designation); ?>
                                            </div>
                                        </div>
                                        <div class="description-text smaller-size">
                                            <?php echo esc_html($description); ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- DESCRIPTION:Spacer b/w Speakers and Keynote section -->

                <div aria-hidden="true" class="spacer-between-speakers-keynote wp-block-spacer"></div>


                <!--DESCRIPTION: Keynote Section-->
                <div class="keynotes">

                    <?php
                    $elevate_keynote_section_item = $keynote_section_fields['acf_elevate_keynote_section_item'] ?? [];
                    ?>
                    <?php if ($elevate_keynote_section_item && is_array($elevate_keynote_section_item)): ?>
                        <?php foreach ($elevate_keynote_section_item as $item):
                            $elevate_keynote_section_item_title = $item['acf_elevate_keynote_section_item_title'] ?? '';
                            $elevate_keynote_section_item_description = $item['acf_elevate_keynote_section_item_description'] ?? '';
                            $elevate_keynote_section_item_image = $item['acf_elevate_keynote_section_item_image'] ?? '';
                            $elevate_keynote_section_item_person_name = $item['acf_elevate_keynote_section_item_person_name'] ?? '';
                            $elevate_keynote_section_item_person_designation = $item['acf_elevate_keynote_section_item_person_designation'] ?? '';
                        ?>

                            <div class="section-wrapper">
                                <div class="background-layout">
                                    <div class="background-left animate-on-scroll"></div>
                                    <div class="background-right"></div>
                                </div>
                                <div class="content-overlay">
                                    <div class="content-left animate-on-scroll">
                                        <h2 class="large-size font-bold"><?php echo esc_html($elevate_keynote_section_item_title); ?></h2>
                                        <p class="small-size">
                                            <?php echo ($elevate_keynote_section_item_description); ?>
                                        </p>
                                    </div>
                                    <div class="content-right animate-on-scroll">
                                        <div class="image-wrapper">
                                            <img src="<?php echo esc_url($elevate_keynote_section_item_image); ?>" alt="<?php echo esc_attr($elevate_keynote_section_item_person_name); ?>" />
                                            <div class="info-overlay">
                                                <div class="person-name large-size font-bold">
                                                    <?php echo esc_html($elevate_keynote_section_item_person_name); ?>
                                                </div>
                                                <div class="person-designation small-size font-bold">
                                                    <?php echo esc_html($elevate_keynote_section_item_person_designation); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>

                <!-- Spacer between Keynote and Innovation Showcase -->
                <div aria-hidden="true" class="spacer-between-keynote-innovation wp-block-spacer"></div>

                <!-- DESCRIPTION: Innovation Showcase  -->
                <div class="innovation-section">
                    <div class="our-innovation-header">
                        <h2 class="main-header large-size font-bold"><?php echo $our_innovations_section_main_heading; ?></h2>
                        <h3 class="sub-header small-size"><?php echo $our_innovations_sub_heading; ?></h3>

                    </div>
                    <div class="card-section">
                        <div class="main-card" id="mainCard">
                            <h2 class="main-card-title small-size font-bold" id="mainTitle"></h2>
                            <div class="main-card-scrollable">
                                <p class="main-card-content smaller-size" id="mainContent"></p>
                            </div>
                        </div>
                        <div class="small-cards">
                            <?php if (have_rows('acf_our_innovations_innovation_cards')) :
                                $index = -1; ?>
                                <?php while (have_rows('acf_our_innovations_innovation_cards')): the_row();
                                    $index++;
                                    $card_image = get_sub_field('acf_our_innovations_card_image') ?: '';
                                    $card_title = get_sub_field('acf_our_innovations_card_title') ?: '';
                                    $card_description_para1 = get_sub_field('acf_our_innovations_card_description_para1') ?: '';
                                    $card_description_para2 = get_sub_field('acf_our_innovations_card_description_para2') ?: ''; ?>



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


                <!-- Spacer between Innovation Showcase and Glimpse Section -->
                <div aria-hidden="true" class="spacer-between-innovation-glimpse wp-block-spacer"></div>

                <!--DESCRIPTION:Glimpse Section-->
                <div class="glimpse-container">
                    <div class="background-container">
                        <div class="background-image manual-lazy-load"
                            data-src="/wp-content/uploads/2025/07/Adrosonic%20Innovation%20main%20frame.svg"
                            src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 3 1'%3E%3C/svg%3E">
                        </div>
                    </div>
                    <div class="content-container">
                        <div class="content">
                            <h1 class="content-heading large-size"><?php echo esc_html($elevate_glimpse_section_title); ?></h1>
                            <p class="content-description small-size"><?php echo esc_html($elevate_glimpse_section_sub_title); ?></p>
                            <div class="video-container">
                                <?php
                                // Ensure the video URL ends with the required Vimeo params
                                $glimpse_video_url = trim($elevate_glimpse_section_video_url);
                                $vimeo_params = '?badge=0&amp;autopause=0&amp;player_id=0&amp;app_id=58479';

                                // Remove any existing query string
                                $glimpse_video_url = preg_replace('/\?.*$/', '', $glimpse_video_url);

                                // Append the required params
                                $glimpse_video_url .= $vimeo_params;
                                ?>
                                <iframe src="<?php echo esc_url($glimpse_video_url); ?>"
                                    class="video-player" frameborder="0" allow="autoplay; fullscreen; picture-in-picture; clipboard-write"
                                    title="Elevate 2024 Glimpse">
                                </iframe>
                                <!-- <img src="/wp-content/uploads/2025/07/image-245.png" alt="Elevate 2024 Glimpse" class="video-player"> -->
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 		Spacer between glimpse and testimonial		 -->
                <div aria-hidden="true" class="spacer-between-glimpse-testimonial wp-block-spacer"></div>

                <!-- DESCRIPTION:Testimonial  -->
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
                                    <p class="custom-font-size-author">
                                        <?php echo esc_html($our_clients_signature) ?>
                                    </p>
                                </div>
                            <?php endwhile; ?>
                        <?php else : ?>
                            <p>No client testimonials found.</p>
                        <?php endif; ?>
                    </div>
                </div>


                <!-- Spacer between testimonial and agenda section -->
                <div aria-hidden="true" class="spacer-between-testimonial-agenda wp-block-spacer"></div>

                <!-- DESCRIPTION:Agenda section -->
                <div class="agenda-section-head">
                    <h2 class="large-size section-head"><?php echo esc_html($agenda_section_heading); ?></h2>
                </div>
                <section class="svg-background-section">
                    <div class="only-space-div"></div>
                    <div class="timeline-container content">
                        <div class="timeline-line-wrapper">
                            <div class="timeline-head">
                                <svg xmlns="http://www.w3.org/2000/svg" width="17" height="23" viewBox="0 0 17 23" fill="none">
                                    <path
                                        d="M8.1543 1.73535L15.2012 20.8662L8.4375 17.2441L8.1543 17.0928L7.87207 17.2441L1.10742 20.8652L8.1543 1.73535Z"
                                        fill="#23E4BA" stroke="#23E4BA" stroke-width="1.19921" />
                                </svg>
                            </div>
                            <div class="timeline-line"></div>
                            <div class="timeline-foot">
                                <svg xmlns="http://www.w3.org/2000/svg" width="17" height="23" viewBox="0 0 17 23" fill="none">
                                    <path
                                        d="M8.1543 20.4023L15.2012 1.27148L8.4375 4.89355L8.1543 5.04492L7.87207 4.89355L1.10742 1.27246L8.1543 20.4023Z"
                                        fill="#23E4BA" stroke="#23E4BA" stroke-width="1.19921" />
                                </svg>
                            </div>
                        </div>
                        <div class="only-space-empty"></div>

                        <?php if ($agenda_section_items && is_array($agenda_section_items)): ?>
                            <?php foreach ($agenda_section_items as $items):
                                $event_duration = $items['acf_elevate_agenda_section_item_time'] ?? '';
                                $event_name = $items['acf_elevate_agenda_section_item_title'] ?? '';
                                $event_brief_description = $items['acf_elevate_agenda_section_item_description'] ?? '';
                            ?>

                                <div class="timeline-item">
                                    <div class="svg-connector"></div>
                                    <div class="content">
                                        <p class="smallest-size font-bold"><?php echo esc_html($event_duration); ?></p>
                                        <h3 class="smaller-size font-bold"><?php echo esc_html($event_name); ?></h3>
                                        <p class="smallest-size"><?php echo esc_html($event_brief_description); ?></p>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                        <div class="only-space-empty"></div>
                    </div>
                    <div class="only-space-div-bottom"></div>
                </section>


                <!-- Spacer between agenda and Join Us section -->
                <div aria-hidden="true" class="spacer-between-agenda-join-us wp-block-spacer"></div>

                <!-- DESCRIPTION:Join US at section -->


                <div class="join-us-at-wrapper">
                    <div class="section-header-container">
                        <h2 class="large-size font-bold"><?php echo esc_html($join_us_section_heading); ?></h2>
                    </div>
                    <div class="map-content-wrapper">
                        <div class="google-map-container">
                            <iframe width="600" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"
                                src="https://www.openstreetmap.org/export/embed.html?bbox=-0.07995270810946493%2C51.5091704563712%2C-0.07595270810946493%2C51.5111704563712&layer=mapnik&marker=51.5101704563712%2C-0.07795270810946493&zoom=19">
                            </iframe>
                            <div class="map-label smaller-size">
                                <?php echo esc_html($join_us_address_card); ?>
                            </div>
                        </div>
                        <p class="shortdesc small-size">
                            <?php echo esc_html($join_us_description); ?>
                        </p>
                        <div class="transport-info">
                            <div class="info">
                                <svg xmlns="http://www.w3.org/2000/svg" width="130" height="114" viewBox="0 0 130 114" fill="none">
                                    <path d="M0 56.957L129.997 56.9601" stroke="#23E4BA" stroke-width="16.3101"
                                        stroke-miterlimit="10" />
                                    <path
                                        d="M107.063 54.1419C105.601 32.2809 87.3262 15 64.9997 15C42.6732 15 24.3987 32.2809 22.9365 54.1419"
                                        stroke="#23E4BA" stroke-width="16.3101" stroke-miterlimit="10" />
                                    <path
                                        d="M22.9336 59.7812C24.3865 81.6546 42.661 98.9478 64.9999 98.9478C87.3388 98.9478 105.613 81.6546 107.066 59.7812"
                                        stroke="#23E4BA" stroke-width="16.3101" stroke-miterlimit="10" />
                                </svg>
                                <p class="small-size text"><?php echo esc_html($tranpost_info_station); ?></p>
                            </div>
                            <div class="info">
                                <svg xmlns="http://www.w3.org/2000/svg" width="130" height="114" viewBox="0 0 130 114" fill="none">
                                    <g clip-path="url(#clip0_17721_8027)">
                                        <path
                                            d="M74.8839 111.401C83.0302 111.401 92.2639 111.401 101.114 111.407C101.281 111.407 101.438 111.407 101.585 111.407H101.92C104.089 111.407 104.351 111.531 105.914 113.331C106.176 113.632 106.624 113.855 107.058 114.066L107.154 114.114C107.664 114.367 108.14 114.105 108.447 113.841C108.664 113.655 108.714 113.328 108.624 112.708C108.551 112.19 108.207 111.824 107.734 111.365C105.458 109.159 103.182 106.956 100.906 104.753L100.588 104.444C99.1286 103.032 97.6694 101.618 96.2103 100.207C94.2554 98.314 92.3033 96.4183 90.354 94.5226C90.2667 94.438 90.216 94.3451 90.1822 94.2831C90.1709 94.2634 90.1681 94.2578 90.1625 94.2493C89.9343 93.993 89.985 93.5789 90.109 93.2803C90.2949 92.8353 90.5907 92.7536 90.7512 92.7451C91.0723 92.7282 91.3935 92.7057 91.7118 92.6831C92.5963 92.624 93.5117 92.562 94.4216 92.5733C96.3849 92.5958 98.337 92.1817 100.224 91.3451C104.148 89.6071 106.596 86.5255 107.497 82.1903C107.869 80.3988 107.9 78.5566 107.9 76.9707C107.897 67.4976 107.895 58.0245 107.892 48.5514V47.4979C107.892 40.9036 107.889 34.3094 107.886 27.7151C107.886 27.4616 107.889 27.2081 107.895 26.9546C107.906 26.2898 107.914 25.6053 107.85 24.9518C107.816 24.625 107.788 24.2983 107.757 23.9715C107.624 22.5603 107.489 21.1011 107.159 19.7321C105.889 14.4449 102.889 10.2844 98.2413 7.36611C95.799 5.83093 93.1934 4.58869 90.4921 3.66758C84.7767 1.71831 78.6106 0.543682 72.1656 0.180307C68.0811 -0.0506755 63.9657 -0.0140568 60.1038 0.0422804C54.2475 0.129603 48.1293 1.05072 41.9182 2.78027C37.3492 4.05349 33.5267 5.88445 30.2366 8.38018C28.6817 9.56045 27.3325 10.9407 26.2311 12.4872C23.8424 15.8336 22.5184 19.7237 22.2959 24.0447C22.2114 25.6757 22.2114 27.3461 22.2114 28.9602V29.3658C22.2058 36.1798 22.2086 43.0811 22.2114 49.7542V53.2894C22.2114 55.1823 22.2114 57.078 22.2114 58.971C22.2114 64.6779 22.2086 70.5708 22.2424 76.3651C22.2508 77.9679 22.2903 79.8242 22.6227 81.5988C23.5776 86.6748 26.5944 90.148 31.5887 91.9254C32.8281 92.3648 34.2197 92.5761 35.8478 92.5648C36.8901 92.5592 37.9464 92.5845 38.9661 92.6099C39.2421 92.6155 39.5182 92.624 39.7971 92.6296C40.0224 92.6353 40.3914 92.8015 40.4703 93.1423L40.4872 93.2099C40.5463 93.4465 40.6252 93.7705 40.4308 94.0493C40.152 94.4521 39.8309 94.8352 39.4844 95.1845C37.6591 97.0211 35.5013 99.1929 33.3155 101.359C31.862 102.798 30.4085 104.235 28.9522 105.669L28.9127 105.708C27.3437 107.258 25.7184 108.858 24.1072 110.458C23.51 111.052 22.8227 111.745 22.2339 112.477C22.0142 112.75 21.9466 113.069 22.0424 113.37C22.1551 113.717 22.4649 113.99 22.879 114.103C23.4762 114.266 24.0142 114.136 24.524 113.7C24.91 113.373 25.248 112.981 25.6057 112.565L25.617 112.55C25.6846 112.472 25.7522 112.396 25.8198 112.317C26.3466 111.714 27.0339 111.407 27.9212 111.381C28.186 111.373 28.4479 111.376 28.7014 111.379C28.8226 111.379 28.9409 111.379 29.062 111.379H65.8643V111.398H74.8839V111.401ZM37.2506 90.2184H37.1661C35.2563 90.2184 33.6619 90.0888 32.0901 89.4578C27.6592 87.6776 25.1776 84.4072 24.7184 79.7369C24.6536 79.0777 24.6593 78.4129 24.6677 77.7707C24.6677 77.5651 24.6733 77.3594 24.6733 77.1566V71.8581C24.6649 57.0837 24.6593 41.805 24.6677 26.7799V26.5602C24.6677 25.1377 24.6677 23.6645 24.8536 22.225C25.5071 17.1491 28.062 12.9548 32.4451 9.75763C34.276 8.42244 36.4225 7.28724 39.0027 6.28726C41.9632 5.14079 45.2702 4.2732 49.4166 3.56054C55.656 2.48731 62.4784 2.14084 70.2755 2.49576C76.1655 2.76337 81.3767 3.5211 86.2133 4.81122C91.2019 6.14078 94.9737 7.86188 98.0835 10.2309C100.478 12.0534 102.123 13.8843 103.258 15.9942C104.441 18.1941 105.069 20.273 105.179 22.3434L105.185 22.4729C105.303 24.7405 105.424 27.0841 105.433 29.3968C105.461 37.7995 105.461 46.3458 105.464 54.6105V60.6386C105.464 64.9709 105.464 69.3004 105.458 73.6327V77.8073L105.455 78.1594C105.455 78.6918 105.455 79.2439 105.438 79.7932C105.255 85.2832 101.196 89.517 95.5652 90.0888C94.3343 90.2128 93.0808 90.2128 91.8695 90.2099H91.2977C84.7485 90.2156 78.0923 90.2156 71.6529 90.2156H64.7009C62.5995 90.2156 60.4982 90.2128 58.3968 90.2128H58.0024C51.5546 90.2128 44.2477 90.2099 37.2619 90.224L37.2506 90.2184ZM40.2506 97.5394C41.4984 96.2465 42.7829 94.9338 44.1801 93.5198C44.7491 92.9451 45.4674 92.624 46.2646 92.593C46.8589 92.5676 47.5068 92.5564 48.2505 92.5564C57.7996 92.5564 67.3459 92.5564 76.8951 92.5564H83.0894C83.2133 92.5564 83.3401 92.5564 83.464 92.5564C83.7147 92.5564 83.9598 92.5564 84.2048 92.5564C85.0189 92.5451 85.7316 92.8409 86.3259 93.4324C87.6808 94.7902 89.2808 96.3958 90.8667 98.0267C91.1174 98.2859 91.0526 98.6521 91.0076 98.8971L90.9963 98.9647C90.9343 99.3422 90.5062 99.4802 90.309 99.4859C89.6273 99.5084 89.1034 99.5197 88.6104 99.5197C83.9372 99.5197 79.2641 99.5197 74.5909 99.5197H65.0812V99.4943H60.3742C54.4335 99.4943 48.2927 99.4943 42.2534 99.4887C41.7125 99.4887 41.1435 99.4408 40.5097 99.345C40.0365 99.2746 39.89 98.6464 39.8956 98.3732C39.9013 98.0831 40.0393 97.7591 40.2478 97.5422L40.2506 97.5394ZM64.977 109.094V109.072H60.9573C51.4842 109.072 42.0111 109.072 32.5352 109.072H32.4873C32.1577 109.072 31.7493 109.072 31.3521 109.024C31.0873 108.99 30.7268 108.815 30.5578 108.511C30.4169 108.255 30.3409 107.736 30.6282 107.435C32.0366 105.951 33.4817 104.46 34.8816 103.015L35.3126 102.57C35.7746 102.091 36.3802 101.81 37.1098 101.725C37.5661 101.675 38.0253 101.675 38.4647 101.675H38.5689C44.9068 101.677 51.242 101.68 57.5799 101.683H58.4447C69.4586 101.689 80.4725 101.694 91.4864 101.697H91.7822C94.5793 101.697 94.7033 101.745 96.2244 103.311C96.43 103.522 96.6666 103.765 96.9427 104.044C98.1821 105.28 99.3736 106.536 100.275 107.494C100.534 107.77 100.543 108.263 100.399 108.562C100.247 108.877 99.8271 109.074 99.5257 109.074C91.2667 109.089 82.8697 109.094 74.7486 109.097H74.1909C73.1092 109.097 72.0276 109.097 70.9459 109.097H64.9713L64.977 109.094Z"
                                            fill="#23E4BA" />
                                        <path
                                            d="M40.0903 56.5019C40.4537 56.5019 40.8199 56.5019 41.1832 56.5075H41.2001C41.5804 56.5075 41.9607 56.5131 42.341 56.5131C47.3972 56.5131 52.4535 56.5131 57.5126 56.5131H65.3463V56.5272H70.3321C76.0081 56.5272 81.6869 56.5272 87.3628 56.5272C87.7121 56.5272 88.0642 56.5216 88.4135 56.5159C88.9093 56.5075 89.4079 56.5019 89.9008 56.5075H89.991C94.081 56.5075 97.8641 52.7244 97.9261 48.5668L97.9317 48.1865C97.9373 47.84 97.943 47.502 97.943 47.1668V46.4851C97.943 41.3669 97.9429 36.2486 97.9373 31.1276V30.8825C97.9373 30.2346 97.9373 29.5642 97.8782 28.922C97.543 25.2573 94.5374 21.2122 89.6191 20.9362C88.9853 20.8996 88.3318 20.9024 87.7008 20.9024H87.3966C72.4842 20.9024 57.5689 20.9024 42.6565 20.9024C42.0227 20.9024 41.3663 20.9024 40.7156 20.939C36.4932 21.1756 32.8735 24.4432 32.3017 28.5445C32.1158 29.8741 32.0172 31.1727 32.0059 32.4036C31.9721 36.6177 31.9693 40.9415 32.0059 45.6203C32.0144 46.9133 32.1552 48.2147 32.2763 49.2062C32.4284 50.4456 32.8538 51.609 33.5467 52.6681C35.2312 55.2484 37.3748 56.5019 40.0931 56.5047L40.0903 56.5019ZM34.6369 46.7076C34.6256 41.8176 34.6369 36.8824 34.6453 32.1079V31.2346C34.6453 30.9614 34.6622 30.691 34.6763 30.429C34.6932 30.1248 34.7073 29.8403 34.7016 29.5586C34.6594 26.9023 37.0847 23.77 40.7607 23.3362C41.2987 23.2742 41.8367 23.277 42.3551 23.2826H42.4452C42.5579 23.2826 42.6677 23.2855 42.786 23.2826C57.414 23.2798 72.0419 23.2798 86.6699 23.2798C86.7966 23.2798 86.9206 23.2798 87.0473 23.2798H87.1347C87.7347 23.277 88.3431 23.2742 88.9487 23.3108C92.6839 23.5446 95.1374 25.8882 95.5092 29.5727C95.5881 30.3417 95.5937 31.1276 95.5965 31.8684C95.6021 36.136 95.6078 41.0936 95.5937 45.9358C95.5909 46.8597 95.5683 47.8456 95.4331 48.809C94.9824 51.9752 92.8839 53.8963 89.6755 54.0794C88.7741 54.1301 87.8614 54.1301 86.9797 54.1301H86.5544C81.2756 54.1301 75.994 54.1301 70.7152 54.1301H65.597L65.1772 54.1329H54.6337C50.6451 54.1329 46.6592 54.1329 42.6705 54.1301H42.2424C41.4452 54.1329 40.6227 54.1357 39.8086 54.0484C37.3213 53.7808 35.2228 51.7836 34.82 49.3048C34.6988 48.5668 34.6453 47.764 34.6425 46.7048L34.6369 46.7076Z"
                                            fill="#23E4BA" />
                                        <path
                                            d="M42.4142 65.9219H42.4058C38.3749 65.9275 34.7975 69.4373 34.7496 73.4373C34.7242 75.7048 35.5805 77.7809 37.1693 79.2822C38.603 80.6428 40.4988 81.3864 42.2424 81.2709H42.2762H42.3016C44.4058 81.2709 46.3494 80.4766 47.7775 79.0315C49.1972 77.5949 49.9606 75.6485 49.9296 73.5527C49.8592 68.8401 45.9748 65.9219 42.4142 65.9219ZM42.2959 78.8513H42.279C39.6425 78.8513 37.1862 76.3809 37.1214 73.6711C37.0904 72.3049 37.7523 70.8514 38.8932 69.7866C39.9608 68.7866 41.2903 68.2796 42.541 68.3923C45.4508 68.6542 47.3494 70.688 47.4959 73.6964V73.7189C47.493 76.395 45.0142 78.84 42.2988 78.8513H42.2959Z"
                                            fill="#23E4BA" />
                                        <path
                                            d="M93.8133 68.5281C92.3485 66.8915 90.3767 65.9141 88.5373 65.9141C83.0839 65.9141 80.6248 70.3112 80.6191 73.4323C80.6135 77.7195 83.805 81.173 87.8838 81.2941C90.0331 81.3561 92.1373 80.5082 93.6612 78.9646C95.0612 77.5449 95.7879 75.7224 95.7034 73.8351V73.8013V73.759C95.9006 71.9985 95.2105 70.0915 93.8105 68.5281H93.8133ZM91.6556 77.3815C90.6359 78.3111 89.357 78.8434 88.1402 78.8434C88.0528 78.8434 87.9655 78.8434 87.881 78.835C85.9064 78.7111 83.8642 77.0632 83.3318 75.159C82.6867 72.8604 83.4416 70.6689 85.2979 69.4351C85.4698 69.3196 85.6444 69.2211 85.8162 69.1281C85.8951 69.083 85.9712 69.0408 86.0472 68.9957C87.4979 68.1478 89.2021 68.1873 90.7232 69.1027C92.4274 70.1281 93.526 71.99 93.4584 73.7393C93.419 75.0463 92.7626 76.3759 91.6556 77.3843V77.3815Z"
                                            fill="#23E4BA" />
                                        <path
                                            d="M52.1181 13.5095C52.7153 13.5658 53.3153 13.5799 54.0308 13.5799C56.7547 13.5855 59.4786 13.5855 62.2025 13.5827H68.4165C69.0531 13.5827 69.6869 13.5827 70.3235 13.5827C71.0221 13.5827 71.7206 13.5827 72.4192 13.5884H72.453C73.8699 13.5912 75.3375 13.5968 76.7797 13.5884C77.3882 13.5884 77.9121 13.5489 78.3853 13.4785C78.8417 13.4109 79.2416 12.8757 79.2416 12.3377C79.2416 11.7687 78.8867 11.363 78.3431 11.3067C77.8276 11.2532 77.2783 11.225 76.7121 11.225C68.4672 11.2138 60.9349 11.2109 53.6815 11.2109C53.1237 11.2109 52.5829 11.2476 52.0702 11.3152C51.6139 11.3771 51.1857 11.9236 51.2026 12.4166C51.2224 12.9349 51.6674 13.4644 52.1181 13.5067V13.5095Z"
                                            fill="#23E4BA" />
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_17721_8027">
                                            <rect width="130" height="114" fill="white" />
                                        </clipPath>
                                    </defs>
                                </svg>
                                <p class="small-size text"><?php echo esc_html($tranpost_info_station); ?></p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </article>
    </main>
    <?php the_content(); ?>
</div>

<?php get_footer(); ?>