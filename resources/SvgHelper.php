<?php
/**
 * SVG Helper Functions
 * 
 * This file contains helper functions for handling SVG files in the Orbuculum website.
 * It provides functions to generate HTML for SVG files loaded via browser instead of inline includes.
 * Includes functionality to improve CLS (Cumulative Layout Shift) by adding explicit dimensions.
 */

require_once __DIR__ . '/AssetManager.php';

/**
 * Generate a versioned URL for SVG files instead of including them inline
 * 
 * @param string $svgPath Path to the SVG file (relative to public directory)
 * @return string Versioned URL to the SVG file
 */
function getSvgUrl($svgPath) {
    // Extract the relative path from the full path
    $basePath = dirname(__DIR__);
    $relativePath = '';
    
    if (strpos($svgPath, $basePath) === 0) {
        // If it's an absolute path, convert to relative
        $relativePath = substr($svgPath, strlen($basePath));
    } else {
        // If it's already a relative path, use it as is
        $relativePath = $svgPath;
    }
    
    return getVersionedUrl($relativePath);
}

/**
 * Extract width and height from an SVG file
 * Developer tool to use when adding new SVG files to the project
 * 
 * @param string $svgPath Path to the SVG file (relative to public directory)
 * @return array Associative array with 'width' and 'height' values, or empty values if not found
 */
function getSvgDimensions($svgPath) {
    // Default dimensions if extraction fails
    $dimensions = [
        'width' => '',
        'height' => ''
    ];
    
    // Convert to absolute path if it's a relative path
    $basePath = dirname(__DIR__);
    $absolutePath = '';
    
    if (strpos($svgPath, $basePath) === 0) {
        // If it's already an absolute path, use it as is
        $absolutePath = $svgPath;
    } else {
        // If it's a relative path, convert to absolute
        // Remove leading slash if present
        $svgPath = ltrim($svgPath, '/');
        
        // Check if path starts with 'svg/'
        if (strpos($svgPath, 'svg/') === 0) {
            $absolutePath = $basePath . '/public/' . $svgPath;
        } else {
            $absolutePath = $basePath . '/public/svg/' . $svgPath;
        }
    }
    
    // Check if file exists
    if (!file_exists($absolutePath)) {
        return $dimensions;
    }
    
    // Read the SVG file
    $svgContent = file_get_contents($absolutePath);
    if ($svgContent === false) {
        return $dimensions;
    }
    
    // Extract width and height using regular expressions
    $widthPattern = '/width="([^"]+)"/';
    $heightPattern = '/height="([^"]+)"/';
    
    if (preg_match($widthPattern, $svgContent, $widthMatches)) {
        $dimensions['width'] = $widthMatches[1];
    }
    
    if (preg_match($heightPattern, $svgContent, $heightMatches)) {
        $dimensions['height'] = $heightMatches[1];
    }
    
    return $dimensions;
}

/**
 * Developer tool to print the dimensions of an SVG file
 * Use this when adding new SVG files to get their dimensions
 * 
 * @param string $svgPath Path to the SVG file (relative to public directory)
 * @return string Formatted string with the SVG path and its dimensions
 */
function printSvgDimensions($svgPath) {
    $dimensions = getSvgDimensions($svgPath);
    $width = !empty($dimensions['width']) ? $dimensions['width'] : 'unknown';
    $height = !empty($dimensions['height']) ? $dimensions['height'] : 'unknown';
    
    return "SVG: {$svgPath} - Width: {$width}, Height: {$height}";
}

/**
 * Get an SVG as an image tag with proper versioning and explicit dimensions
 * 
 * @param string $svgPath Path to the SVG file (relative to public directory)
 * @param string $altText Alternative text for accessibility
 * @param string $cssClass CSS class to apply to the image
 * @param string $width Width of the SVG (optional, will be used if provided)
 * @param string $height Height of the SVG (optional, will be used if provided)
 * @return string HTML img tag with the SVG including width and height attributes
 */
function getSvgImage($svgPath, $altText = '', $cssClass = 'svg-icon', $width = '', $height = '') {
    // If dimensions are not provided, extract them from the SVG file
    if (empty($width) || empty($height)) {
        $dimensions = getSvgDimensions($svgPath);
        $width = !empty($width) ? $width : $dimensions['width'];
        $height = !empty($height) ? $height : $dimensions['height'];
    }
    
    // Add width and height attributes if available
    $widthAttr = !empty($width) ? ' width="' . $width . '"' : '';
    $heightAttr = !empty($height) ? ' height="' . $height . '"' : '';
    
    return '<img src="' . getSvgUrl($svgPath) . '" alt="' . $altText . '" class="' . $cssClass . '"' . $widthAttr . $heightAttr . '>';
}

/**
 * Helper function for submenu icon files
 * 
 * @param string $svgPath Path to the SVG file (relative to public directory)
 * @param string $altText Alternative text for accessibility
 * @param string $width Width of the SVG (optional)
 * @param string $height Height of the SVG (optional)
 * @return string HTML img tag with the SVG
 */
function getSubmenuIcon($svgPath, $altText = 'Menu Icon', $width = '', $height = '') {
    return getSvgImage($svgPath, $altText, 'svg-icon', $width, $height);
}
