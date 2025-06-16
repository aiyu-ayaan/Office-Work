<?php

function get_acf_reading_time($post_id, $field_names = ['acf_posts_content']) {
    $total_content = '';
    
    // Handle both string and array inputs for field names
    if (is_string($field_names)) {
        $field_names = [$field_names];
    }
    
    // Loop through each field and concatenate content
    foreach ($field_names as $field_name) {
        $content = get_field($field_name, $post_id);
        
        if ($content) {
            // Handle different field types
            if (is_array($content)) {
                // If it's an array (like repeater fields), extract text from each item
                $content = implode(' ', array_map(function($item) {
                    return is_array($item) ? implode(' ', $item) : $item;
                }, $content));
            }
            
            $total_content .= ' ' . $content;
        }
    }

    if (empty(trim($total_content))) {
        return '0 min read';
    }

    // Strip HTML tags and shortcodes to get plain text
    $text_content = wp_strip_all_tags(strip_shortcodes($total_content));

    // Count words
    $word_count = str_word_count($text_content);

    // Calculate read time (assuming 200 words per minute)
    $minutes = ceil($word_count / 200);

    // Return formatted string
    return $minutes . ' min' . ($minutes > 1 ? 's' : '') . ' read';
}

// Usage examples:

// Single field (backward compatible)
$read_time = get_acf_reading_time(get_the_ID());

// Multiple fields as array
$read_time = get_acf_reading_time(get_the_ID(), [
    'acf_posts_content',
    'acf_posts_excerpt',
    'acf_additional_content'
]);

// Multiple fields as string (if you only have one additional field)
$read_time = get_acf_reading_time(get_the_ID(), 'acf_posts_content');

echo "Estimated reading time: " . $total_read_time;

?>