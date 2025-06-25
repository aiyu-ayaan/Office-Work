<?php
function get_minutes($post_id, $field_names = null, $videoId = null, $direct_content = null) {
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

function calculate_direct_content_reading_time($content) {
    // Handle array of content
    if (is_array($content)) {
        $total_content = '';
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
function get_acf_reading_time($post_id, $field_names = ['acf_posts_content']) {
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
                $content = implode(' ', array_map(function($item) {
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
     } else {
         $minutes = get_minutes($post_id, ['acf_post_content_frame_section']);
         if (is_numeric($minutes)) {
             $minutes = $minutes . ' minute' . ($minutes == 1 ? '' : 's');
         } 
     }
 
     return $minutes !== null ? $minutes : "N/A";
}
?>