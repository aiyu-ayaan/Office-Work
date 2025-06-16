<?php
function get_minutes($post_id, $field_names = null, $videoId = null) {
    // Validate required post_id parameter
    if (empty($post_id)) {
        return "N/A";
    }
    
    $results = [];
    
    // Check if field_names is provided and get reading time
    if (!empty($field_names)) {
        $reading_time = get_acf_reading_time($post_id, $field_names);
        if ($reading_time !== '0 min read') {
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

function getVimeoVideoDuration($videoUrl) {
    // Extract video ID from URL
    $videoId = extractVimeoVideoId($videoUrl);
    
    // Validate video ID
    if (empty($videoId) || !is_numeric($videoId)) {
        return "Error: Invalid Vimeo video URL or ID provided";
    }
    
    // Vimeo oEmbed API endpoint
    $url = "https://vimeo.com/api/oembed.json?url=https://vimeo.com/" . $videoId;
    
    // Create context for file_get_contents
    $context = stream_context_create([
        'http' => [
            'method' => 'GET',
            'header' => [
                'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36',
                'Accept: application/json'
            ],
            'timeout' => 30
        ]
    ]);
    
    // Get response using file_get_contents
    $response = @file_get_contents($url, false, $context);
    
    // Check for HTTP errors
    if ($response === false) {
        return "Error: Unable to fetch video data from Vimeo";
    }
    
    // Parse JSON response
    $data = json_decode($response, true);
    
    // Check if JSON parsing was successful
    if (json_last_error() !== JSON_ERROR_NONE) {
        return "Error: Invalid response from Vimeo API";
    }
    
    // Check if duration is available
    if (!isset($data['duration']) || !is_numeric($data['duration'])) {
        return "Error: Video duration not available";
    }
    
    // Format and return duration with labels (ignore seconds)
    $seconds = (int)$data['duration'];
    $hours = floor($seconds / 3600);
    $minutes = floor(($seconds % 3600) / 60);
    
    $formatted = "";
    
    if ($hours > 0) {
        $formatted .= $hours . " hour" . ($hours > 1 ? "s" : "") . " ";
    }
    
    if ($minutes > 0) {
        $formatted .= $minutes . " min" . ($minutes > 1 ? "s" : "");
    }
    
    // If video is less than 1 minute, show "Less than 1 min"
    if ($hours == 0 && $minutes == 0) {
        $formatted = "Less than 1 min";
    }
    
    return trim($formatted);
}


function extractVimeoVideoId($url) {
    // If it's already just a numeric ID, return it
    if (is_numeric($url)) {
        return $url;
    }
    
    // Handle different Vimeo URL formats
    $patterns = [
        '/vimeo\.com\/(\d+)/',                    // https://vimeo.com/123456789
        '/vimeo\.com\/video\/(\d+)/',             // https://vimeo.com/video/123456789
        '/player\.vimeo\.com\/video\/(\d+)/',     // https://player.vimeo.com/video/123456789
        '/vimeo\.com\/channels\/[^\/]+\/(\d+)/',  // https://vimeo.com/channels/channel/123456789
        '/vimeo\.com\/groups\/[^\/]+\/videos\/(\d+)/', // https://vimeo.com/groups/group/videos/123456789
        '/vimeo\.com\/album\/\d+\/video\/(\d+)/', // https://vimeo.com/album/123/video/456789
        '/vimeo\.com\/ondemand\/[^\/]+\/(\d+)/',  // https://vimeo.com/ondemand/movie/123456789
    ];
    
    foreach ($patterns as $pattern) {
        if (preg_match($pattern, $url, $matches)) {
            return $matches[1];
        }
    }
    
    return null;
}

// Usage examples:
// get_minutes(123); // Returns "N/A" (no field_names or videoId provided)
// get_minutes(123, 'content_field'); // Returns reading time only
// get_minutes(123, null, '123456789'); // Returns video duration only
// get_minutes(123, 'content_field', '123456789'); // Returns "X mins read + Y mins"
// get_minutes(123, ['field1', 'field2']); // Returns reading time from multiple fields
?>