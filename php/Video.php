<?php

function getVimeoVideoDuration($videoId) {
    // Validate video ID
    if (empty($videoId) || !is_numeric($videoId)) {
        return "N/A";
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
        return "N/A";
    }
    
    // Parse JSON response
    $data = json_decode($response, true);
    
    // Check if JSON parsing was successful
    if (json_last_error() !== JSON_ERROR_NONE) {
        return "N/A";
    }
    
    // Check if duration is available
    if (!isset($data['duration']) || !is_numeric($data['duration'])) {
        return "N/A";
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

// Usage examples:
echo getVimeoVideoDuration("866043708") . "\n";  // Returns formatted duration or N/A
echo getVimeoVideoDuration("invalid") . "\n";    // Returns N/A
echo getVimeoVideoDuration("") . "\n";           // Returns N/A

?>