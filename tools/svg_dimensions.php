<?php
/**
 * SVG Dimensions Extraction Tool
 * 
 * This tool helps developers extract dimensions from SVG files to use in the code.
 * Run this script from the command line to get dimensions of SVG files.
 * 
 * Usage:
 *   php svg_dimensions.php [path/to/svg/file.svg]
 *   php svg_dimensions.php --all
 */

// Include the SVG helper functions
require_once __DIR__ . '/../resources/SvgHelper.php';

// Function to scan directory for SVG files
function scanForSvgFiles($directory) {
    $results = [];
    $files = scandir($directory);
    
    foreach ($files as $file) {
        if ($file === '.' || $file === '..') {
            continue;
        }
        
        $path = $directory . '/' . $file;
        
        if (is_dir($path)) {
            $results = array_merge($results, scanForSvgFiles($path));
        } else if (pathinfo($path, PATHINFO_EXTENSION) === 'svg') {
            $results[] = $path;
        }
    }
    
    return $results;
}

// Main execution
if (count($argv) < 2) {
    echo "Usage:\n";
    echo "  php svg_dimensions.php [path/to/svg/file.svg]\n";
    echo "  php svg_dimensions.php --all\n";
    exit(1);
}

$basePath = dirname(__DIR__);

if ($argv[1] === '--all') {
    // Scan all SVG files in the public/svg directory
    $svgDirectory = $basePath . '/public/svg';
    $svgFiles = scanForSvgFiles($svgDirectory);
    
    echo "Found " . count($svgFiles) . " SVG files:\n\n";
    
    foreach ($svgFiles as $svgFile) {
        // Convert absolute path to relative path for the getSvgDimensions function
        $relativePath = str_replace($basePath . '/public', '', $svgFile);
        $dimensions = getSvgDimensions($relativePath);
        
        $width = !empty($dimensions['width']) ? $dimensions['width'] : 'unknown';
        $height = !empty($dimensions['height']) ? $dimensions['height'] : 'unknown';
        
        echo "File: " . $relativePath . "\n";
        echo "Width: " . $width . ", Height: " . $height . "\n";
        echo "Usage: getSvgImage('" . $relativePath . "', 'Alt Text', 'svg-icon', '" . $width . "', '" . $height . "');\n\n";
    }
} else {
    // Process a single SVG file
    $svgPath = $argv[1];
    
    // If the path is relative, make it absolute
    if (strpos($svgPath, '/') !== 0 && strpos($svgPath, $basePath) !== 0) {
        $svgPath = '/' . $svgPath;
    }
    
    $dimensions = getSvgDimensions($svgPath);
    $width = !empty($dimensions['width']) ? $dimensions['width'] : 'unknown';
    $height = !empty($dimensions['height']) ? $dimensions['height'] : 'unknown';
    
    echo "File: " . $svgPath . "\n";
    echo "Width: " . $width . ", Height: " . $height . "\n";
    echo "Usage: getSvgImage('" . $svgPath . "', 'Alt Text', 'svg-icon', '" . $width . "', '" . $height . "');\n";
}
