<?php
/**
 * Enhanced PDF Content Extractor Class
 * Extracts text and form fields from PDF with improved handling
 */
class PDFExtractor {
    
    private $pdf_content;
    private $form_fields = [];
    private $text_content = '';
    
    public function __construct($pdf_path_or_url) {
        if (filter_var($pdf_path_or_url, FILTER_VALIDATE_URL)) {
            $this->pdf_content = $this->download_pdf($pdf_path_or_url);
        } else {
            $this->pdf_content = file_get_contents($pdf_path_or_url);
        }
    }
    
    private function download_pdf($url) {
        $context = stream_context_create([
            'http' => [
                'timeout' => 30,
                'user_agent' => 'Mozilla/5.0 PDF Extractor'
            ]
        ]);
        
        $content = @file_get_contents($url, false, $context);
        
        if ($content === false || substr($content, 0, 4) !== '%PDF') {
            throw new Exception("Invalid PDF file or URL");
        }
        
        return $content;
    }
    
    public function extract() {
        if (!$this->pdf_content) {
            throw new Exception("No PDF content loaded");
        }
        
        echo "Starting PDF extraction...\n";
        
        $this->extract_text();
        $this->extract_form_fields();
        
        $this->print_results();
        
        return [
            'text' => $this->text_content,
            'form_fields' => $this->form_fields,
            'form_data' => $this->get_form_data_array()
        ];
    }
    
    private function extract_text() {
        echo "Extracting text content...\n";
        $text = '';
        
        // Extract text from objects with streams
        preg_match_all('/(\d+)\s+\d+\s+obj.*?>>\s*stream[\r\n]+(.*?)[\r\n]*endstream/s', $this->pdf_content, $obj_matches, PREG_SET_ORDER);
        
        foreach ($obj_matches as $match) {
            $obj_num = $match[1];
            $stream_data = $match[2];
            
            // Get the object dictionary to check filters and length
            if (preg_match('/' . $obj_num . '\s+\d+\s+obj\s*<<(.*?)>>/s', $this->pdf_content, $dict_match)) {
                $dict = $dict_match[1];
                
                // Handle stream length
                if (preg_match('/\/Length\s+(\d+)/', $dict, $len_match)) {
                    $stream_length = (int)$len_match[1];
                    $stream_data = substr($stream_data, 0, $stream_length);
                }
                
                // Handle FlateDecode compression
                if (strpos($dict, '/Filter/FlateDecode') !== false) {
                    $decoded = @gzuncompress($stream_data);
                    if ($decoded !== false) {
                        $stream_data = $decoded;
                    }
                }
                
                // Extract text from the stream
                $text .= $this->extract_text_from_stream($stream_data);
            }
        }
        
        // Extract text using operators
        $text .= $this->extract_text_from_operators($this->pdf_content);
        
        // Clean and store the final text
        $this->text_content = $this->clean_text($text);
        echo "Text extraction completed. Length: " . strlen($this->text_content) . " characters\n";
    }
    
    private function extract_text_from_stream($stream_data) {
        $text = '';
        
        // Extract text using TJ/Tj operators in streams
        if (preg_match_all('/\((.*?)\)\s*Tj|\[(.*?)\]\s*TJ/s', $stream_data, $matches, PREG_SET_ORDER)) {
            foreach ($matches as $match) {
                if (!empty($match[1])) {
                    $text .= $this->decode_text($match[1]) . ' ';
                } elseif (!empty($match[2])) {
                    // Handle TJ arrays
                    preg_match_all('/\((.*?)\)/', $match[2], $tj_matches);
                    foreach ($tj_matches[1] as $tj_text) {
                        $text .= $this->decode_text($tj_text) . ' ';
                    }
                }
            }
        }
        
        return $text;
    }
    
    private function extract_text_from_operators($content) {
        $text = '';
        
        // Extract text using operators in content
        if (preg_match_all('/\((.*?)\)\s*Tj|\[(.*?)\]\s*TJ|<(.*?)>\s*Tj/s', $content, $matches, PREG_SET_ORDER)) {
            foreach ($matches as $match) {
                if (!empty($match[1])) {
                    // Regular text
                    $text .= $this->decode_text($match[1]) . ' ';
                } elseif (!empty($match[2])) {
                    // TJ array
                    preg_match_all('/\((.*?)\)/', $match[2], $tj_matches);
                    foreach ($tj_matches[1] as $tj_text) {
                        $text .= $this->decode_text($tj_text) . ' ';
                    }
                } elseif (!empty($match[3])) {
                    // Hex string
                    $hex = str_replace(' ', '', $match[3]);
                    $text .= $this->decode_hex_text($hex) . ' ';
                }
            }
        }
        
        return $text;
    }
    
    private function decode_text($text) {
        // Handle escape sequences
        $text = preg_replace_callback('/\\\\([0-7]{1,3})/', function($m) {
            return chr(octdec($m[1]));
        }, $text);
        
        // Handle common escape sequences
        $replacements = [
            '\\\\' => '\\',
            '\\n' => "\n",
            '\\r' => "\r",
            '\\t' => "\t",
            '\\b' => "\b",
            '\\f' => "\f",
            '\\(' => '(',
            '\\)' => ')',
        ];
        
        $text = strtr($text, $replacements);
        
        return $text;
    }
    
    private function decode_hex_text($hex) {
        // Convert hex string to binary
        $bin = hex2bin($hex);
        if ($bin === false) {
            return '';
        }
        
        // Check for UTF-16 BOM
        if (substr($bin, 0, 2) === "\xFE\xFF") {
            return mb_convert_encoding(substr($bin, 2), 'UTF-8', 'UTF-16BE');
        }
        
        return $bin;
    }
    
    private function clean_text($text) {
        // Normalize whitespace
        $text = preg_replace('/\s+/', ' ', $text);
        
        // Remove control characters (keep basic whitespace)
        $text = preg_replace('/[\x00-\x08\x0B\x0C\x0E-\x1F]/', '', $text);
        
        // Convert to UTF-8 if not already
        if (!mb_check_encoding($text, 'UTF-8')) {
            $text = mb_convert_encoding($text, 'UTF-8');
        }
        
        return trim($text);
    }
    
    private function extract_form_fields() {
        echo "Extracting form fields...\n";
        $this->extract_acroform_fields();
        $this->extract_widget_annotations();
        echo "Found " . count($this->form_fields) . " form fields\n";
    }
    
    private function extract_acroform_fields() {
        if (preg_match('/\/AcroForm\s*<<([^>]*)>>/s', $this->pdf_content, $matches)) {
            echo "Found AcroForm dictionary\n";
            $acroform_dict = $matches[1];
            
            if (preg_match('/\/Fields\s*\[([^\]]*)\]/s', $acroform_dict, $field_matches)) {
                $fields_refs = $field_matches[1];
                preg_match_all('/(\d+)\s+\d+\s+R/', $fields_refs, $ref_matches);
                
                echo "Found " . count($ref_matches[1]) . " field references\n";
                
                foreach ($ref_matches[1] as $obj_num) {
                    $this->extract_field_object($obj_num);
                }
            }
        } else {
            echo "No AcroForm dictionary found\n";
        }
    }
    
    private function extract_field_object($obj_num) {
        $pattern = '/' . $obj_num . '\s+\d+\s+obj\s*<<([^>]*)>>/s';
        
        if (preg_match($pattern, $this->pdf_content, $matches)) {
            $field_dict = $matches[1];
            $field_data = $this->parse_field_dict($field_dict);
            
            if (!empty($field_data['name'])) {
                $this->form_fields[] = $field_data;
                echo "Extracted field: " . $field_data['name'] . "\n";
            }
        }
    }
    
    private function parse_field_dict($dict) {
        $field = [];
        
        // Field name
        if (preg_match('/\/T\s*\(([^)]*)\)/', $dict, $matches)) {
            $field['name'] = $this->decode_text($matches[1]);
        }
        
        // Field value
        if (preg_match('/\/V\s*\(([^)]*)\)/', $dict, $matches)) {
            $field['value'] = $this->decode_text($matches[1]);
        } elseif (preg_match('/\/V\s*\/([^\s\/]*)/', $dict, $matches)) {
            $field['value'] = $matches[1];
        }
        
        // Field type
        if (preg_match('/\/FT\s*\/([^\s\/]*)/', $dict, $matches)) {
            $field['type'] = $matches[1];
        }
        
        // Default value
        if (preg_match('/\/DV\s*\(([^)]*)\)/', $dict, $matches)) {
            $field['default'] = $this->decode_text($matches[1]);
        }
        
        // Field flags
        if (preg_match('/\/Ff\s*(\d+)/', $dict, $matches)) {
            $field['flags'] = intval($matches[1]);
        }
        
        // Options for choice fields
        if (preg_match('/\/Opt\s*\[([^\]]*)\]/', $dict, $matches)) {
            preg_match_all('/\(([^)]*)\)/', $matches[1], $opt_matches);
            $field['options'] = array_map([$this, 'decode_text'], $opt_matches[1]);
        }
        
        return $field;
    }
    
    private function extract_widget_annotations() {
        $pattern = '/\/Subtype\s*\/Widget.*?\/T\s*\(([^)]*)\).*?(?:\/V\s*\(([^)]*)\)|\/V\s*\/([^\s\/]*))?/s';
        preg_match_all($pattern, $this->pdf_content, $matches, PREG_SET_ORDER);
        
        echo "Found " . count($matches) . " widget annotations\n";
        
        foreach ($matches as $match) {
            $field = [
                'name' => $this->decode_text($match[1]),
                'value' => isset($match[2]) ? $this->decode_text($match[2]) : (isset($match[3]) ? $match[3] : ''),
                'type' => 'widget'
            ];
            
            if (!$this->field_exists($field['name'])) {
                $this->form_fields[] = $field;
                echo "Extracted widget field: " . $field['name'] . "\n";
            }
        }
    }
    
    private function field_exists($name) {
        foreach ($this->form_fields as $field) {
            if ($field['name'] === $name) {
                return true;
            }
        }
        return false;
    }
    
    public function get_form_data_array() {
        $data = [];
        foreach ($this->form_fields as $field) {
            if (isset($field['name']) && isset($field['value'])) {
                $data[$field['name']] = $field['value'];
            }
        }
        return $data;
    }
    
    private function print_results() {
        echo "\n" . str_repeat("=", 50) . "\n";
        echo "PDF EXTRACTION RESULTS\n";
        echo str_repeat("=", 50) . "\n";
        
        if (!empty($this->text_content)) {
            echo "\nTEXT CONTENT (first 500 chars):\n";
            echo str_repeat("-", 30) . "\n";
            echo substr($this->text_content, 0, 500) . (strlen($this->text_content) > 500 ? "..." : "") . "\n";
        } else {
            echo "\nNo text content found.\n";
        }
        
        if (!empty($this->form_fields)) {
            echo "\nFORM FIELDS:\n";
            echo str_repeat("-", 20) . "\n";
            
            foreach ($this->form_fields as $i => $field) {
                echo ($i + 1) . ". Field Name: " . ($field['name'] ?? 'N/A') . "\n";
                echo "   Value: " . ($field['value'] ?? 'N/A') . "\n";
                echo "   Type: " . ($field['type'] ?? 'N/A') . "\n";
                if (isset($field['default'])) {
                    echo "   Default: " . $field['default'] . "\n";
                }
                if (isset($field['options'])) {
                    echo "   Options: " . implode(', ', $field['options']) . "\n";
                }
                echo "\n";
            }
            
            echo "FORM DATA (Key-Value Pairs):\n";
            echo str_repeat("-", 30) . "\n";
            $form_data = $this->get_form_data_array();
            foreach ($form_data as $key => $value) {
                echo "$key: $value\n";
            }
        } else {
            echo "\nNo form fields found.\n";
        }
        
        echo "\n" . str_repeat("=", 50) . "\n";
    }
}

function extract_pdf_content($pdf_path_or_url) {
    try {
        $extractor = new PDFExtractor($pdf_path_or_url);
        return $extractor->extract();
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage() . "\n";
        return false;
    }
}

// Example usage
$result = extract_pdf_content('https://websitedev-db0c5dadd1-endpoint.azureedge.net/wp-content/uploads/2025/04/Knowledgemill_CaseStudyv1.6-1.pdf');
if ($result) {
    file_put_contents('extracted_text.txt', $result['text']);
    file_put_contents('form_data.json', json_encode($result['form_data'], JSON_PRETTY_PRINT));
    echo "Results saved to extracted_text.txt and form_data.json\n";
}
?>