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
                            Exclusively by invitation only
                        </div>

                        <div class="elevate-logo manual-lazy-load" data-src="/wp-content/uploads/2025/07/Elevate-Logo.png"
                            src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 3 1'%3E%3C/svg%3E">
                        </div>


                        <div class="elevate-title largest-size">
                            Innovation Blueprints: Turning Vision into Value
                        </div>

                        <div class="text-below-title small-size">
                            16th September 2025 - Four Seasons - Ten Trinity Square London
                        </div>
                        <a href="/contact-us/">
                            <button class=" custom-button elevate-get-in-touch">
                                Get in touch
                            </button>
                        </a>
                    </div>
                </div>

                <!-- ECL Counter section -->
                <div class="counter-section">
                    <h1 class="medium-size event-start-title">
                        Event starts in
                    </h1>
                    <div class="counter" endDate="16-09-2025 12:00 AM">
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

                <!-- Keynote Section-->
                <div class="keynotes">
                    <div class="section-wrapper">
                        <div class="background-layout">
                            <div class="background-left animate-on-scroll"></div>
                            <div class="background-right"></div>
                        </div>
                        <div class="content-overlay">
                            <div class="content-left animate-on-scroll">
                                <h2 class="large-size font-bold">Opening Keynote</h2>
                                <p class="small-size">
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam eu
                                    turpis molestie, dictum est a, mattis tellus. Sed dignissim,
                                </p>
                                <p class="small-size">
                                    Maecenas eget condimentum velit, sit amet feugiat lectus. Class aptent
                                    taciti sociosqu ad litora torquent per conubia nostra, per inceptos
                                    himenaeos.
                                </p>
                            </div>
                            <div class="content-right animate-on-scroll">
                                <div class="image-wrapper">
                                    <img src="/wp-content/uploads/2025/07/Rectangle-3551.png" alt="Overlapping Image" />
                                    <div class="info-overlay">
                                        <div class="person-name large-size font-bold">Mayank</div>
                                        <div class="person-designation small-size font-bold">
                                            Founder, CEO and MD, ADROSONIC
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Repeat above block as needed -->
                    <div class="section-wrapper">
                        <div class="background-layout">
                            <div class="background-left animate-on-scroll"></div>
                            <div class="background-right"></div>
                        </div>
                        <div class="content-overlay">
                            <div class="content-left animate-on-scroll">
                                <h2 class="large-size font-bold">Closing Keynote</h2>
                                <p class="small-size">
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam eu
                                    turpis molestie, dictum est a, mattis tellus. Sed dignissim,
                                </p>
                                <p class="small-size">
                                    Maecenas eget condimentum velit, sit amet feugiat lectus. Class aptent
                                    taciti sociosqu ad litora torquent per conubia nostra, per inceptos
                                    himenaeos.
                                </p>
                            </div>
                            <div class="content-right animate-on-scroll">
                                <div class="image-wrapper">
                                    <img src="/wp-content/uploads/2025/07/Rectangle-3551.png" alt="Overlapping Image" />
                                    <div class="info-overlay">
                                        <div class="person-name large-size font-bold">XYZ</div>
                                        <div class="person-designation small-size font-bold">
                                            Chief Technology Officer
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- our innovation section  -->
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


                <!--Glimpse Section-->
                <div class="glimpse-container">
                    <div class="background-container">
                        <div class="background-image manual-lazy-load"
                            data-src="/wp-content/uploads/2025/07/Adrosonic%20Innovation%20main%20frame.svg"
                            src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 3 1'%3E%3C/svg%3E">
                        </div>
                    </div>
                    <div class="content-container">
                        <div class="content">
                            <h1 class="content-heading large-size">Elevate 2024 Glimpse</h1>
                            <p class="content-description small-size">Catch a glimpse and the radiance of past events.</p>
                            <div class="video-container">
                                <iframe src="https://player.vimeo.com/video/866043708?badge=0&amp;autopause=0&amp;player_id=0&amp;app_id=58479"
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

            </div>
        </article>
    </main>
    <?php the_content(); ?>
</div>

<?php get_footer(); ?>