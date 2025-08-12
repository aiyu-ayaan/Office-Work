<?php
/**
 * Calculate reading time from an array of strings
 * 
 * @param array $content_array Array of strings (paragraphs, sections, etc.)
 * @param int $words_per_minute Average reading speed (default: 200 words per minute)
 * @return array Returns array with minutes, seconds, and formatted string
 */
function calculate_reading_time($content_array, $words_per_minute = 200) {
    // Validate input
    if (!is_array($content_array) || empty($content_array)) {
        return [
            'minutes' => 0,
            'seconds' => 0,
            'formatted' => '0 min read'
        ];
    }
    
    // Join all content and count words
    $full_content = implode(' ', $content_array);
    
    // Remove HTML tags if present
    $clean_content = strip_tags($full_content);
    
    // Count words (handles multiple spaces and line breaks)
    $word_count = str_word_count($clean_content);
    
    // Calculate reading time in minutes
    $reading_time_minutes = $word_count / $words_per_minute;
    
    // Split into minutes and seconds
    $minutes = floor($reading_time_minutes);
    $seconds = round(($reading_time_minutes - $minutes) * 60);
    
    // If seconds are 60, convert to additional minute
    if ($seconds >= 60) {
        $minutes++;
        $seconds = 0;
    }
    
    // Format the output
    $formatted = format_reading_time($minutes, $seconds);
    
    return [
        'minutes' => $minutes,
        'seconds' => $seconds,
        'word_count' => $word_count,
        'formatted' => $formatted
    ];
}

/**
 * Format reading time into a readable string
 * 
 * @param int $minutes
 * @param int $seconds
 * @return string
 */
function format_reading_time($minutes, $seconds) {
    if ($minutes == 0 && $seconds < 30) {
        return "Less than 1 min read";
    } elseif ($minutes == 0) {
        return "1 min read";
    } elseif ($minutes == 1) {
        return "1 min read";
    } else {
        return $minutes . " min read";
    }
}


$content_frame_data = get_field('acf_post_content_frame_section',14256);

calculate_reading_time($content_frame_data);