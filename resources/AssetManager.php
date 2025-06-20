<?php
/**
 * Asset Manager
 * 
 * Handles all asset versioning, compilation and cache management functions
 * for the Orbuculum website.
 */

// Debug flag - set to true to enable debug logging, false to disable
$css_compilation_debug = false;

/**
 * Helper function for debug logging
 * 
 * @param string $message Message to log
 */
function css_debug_log($message) {
    global $css_compilation_debug;
    if ($css_compilation_debug) {
        error_log("CSS Compilation Debug: " . $message);
    }
}

/**
 * Get the current Git commit hash for cache busting
 * 
 * @return string First 8 characters of the current Git commit hash or timestamp if not available
 */
function getGitCommitHash() {
    // Path to the .git directory
    $gitDir = dirname(__DIR__) . '/.git';
    
    // Check if .git directory exists
    if (!file_exists($gitDir)) {
        return 'no-git';
    }
    
    // Read the HEAD file to get the ref
    $headFile = $gitDir . '/HEAD';
    if (!file_exists($headFile)) {
        return 'no-head';
    }
    
    $head = file_get_contents($headFile);
    $head = trim($head);
    
    // If it's a direct commit hash
    if (preg_match('/^[0-9a-f]{40}$/', $head)) {
        return substr($head, 0, 8); // Return first 8 characters of hash
    }
    
    // If it's a ref, get the actual commit hash
    if (strpos($head, 'ref: ') === 0) {
        $ref = substr($head, 5); // Remove 'ref: ' prefix
        
        // Try to read the ref file
        $refFile = $gitDir . '/' . $ref;
        if (file_exists($refFile)) {
            $hash = file_get_contents($refFile);
            return substr(trim($hash), 0, 8); // Return first 8 characters of hash
        }
        
        // If ref file doesn't exist directly, try in refs/heads
        $packedRefsFile = $gitDir . '/packed-refs';
        if (file_exists($packedRefsFile)) {
            $packedRefs = file_get_contents($packedRefsFile);
            $lines = explode("\n", $packedRefs);
            foreach ($lines as $line) {
                if (strpos($line, '#') === 0) continue; // Skip comments
                $parts = explode(' ', trim($line));
                if (count($parts) == 2 && $parts[1] == $ref) {
                    return substr($parts[0], 0, 8); // Return first 8 characters of hash
                }
            }
        }
    }
    
    // Fallback to timestamp if we couldn't get the hash
    return 'v-' . time();
}

/**
 * Generate a versioned URL for static files (CSS, JS, images)
 * 
 * @param string $path Path to the static file
 * @return string Path with version query parameter
 */
function getVersionedUrl($path) {
    global $staticVersion;
    
    // Ensure the path starts with a slash
    if (substr($path, 0, 1) !== '/') {
        $path = '/' . $path;
    }
    
    // Remove /public prefix if it exists since the web server already serves from public
    if (strpos($path, '/public/') === 0) {
        $path = substr($path, 7); // Remove '/public'
    }
    
    // Add version parameter for cache busting
    return $path . '?v=' . $staticVersion;
}

// Initialize static version variables based on configuration
$configPath = dirname(__DIR__) . '/config/config.php';
$config = [];
$no_cache_static = false;

if (file_exists($configPath)) {
    $config = include $configPath;
    // Check if no_cache_static is set to true in the config
    if (isset($config['no_cache_static']) && $config['no_cache_static'] === true) {
        $no_cache_static = true;
    }
}

// Global vars used across the site
$staticVersion = $no_cache_static ? 'v-' . time() : getGitCommitHash();
