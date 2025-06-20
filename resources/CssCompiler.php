<?php
/**
 * CSS Compiler
 * 
 * Handles CSS compilation, minification and caching for the Orbuculum website.
 * Works together with AssetManager.php to provide efficient CSS handling.
 */

require_once __DIR__ . '/AssetManager.php';

/**
 * Minify CSS content
 * 
 * @param string $css CSS content to minify
 * @return string Minified CSS content
 */
function minifyCss($css) {
    $css = preg_replace('!/\*.*?\*/!s', '', $css);
    $css = preg_replace('/\s+/', ' ', $css);
    $css = preg_replace('/\s*([{}:;,])\s*/', '$1', $css);
    $css = preg_replace('/;}/', '}', $css);
    return trim($css);
}

/**
 * Remove old CSS files from the build directory
 * 
 * @param string $buildDir Path to the build directory
 * @param string $currentHash Current CSS hash to keep
 * @return bool True if operation was successful, false otherwise
 */
function clearOldCssFiles($buildDir, $currentHash) {
    if (!is_dir($buildDir)) {
        if (!mkdir($buildDir, 0755, true)) {
            css_debug_log("Failed to create build directory: {$buildDir}");
            return false;
        }
        return true;
    }

    if (!is_writable($buildDir)) {
        css_debug_log("Build directory is not writable: {$buildDir}");
        return false;
    }

    $files = glob($buildDir . '/css_*.min.css');
    if ($files === false) {
        css_debug_log("Failed to list CSS files in directory: {$buildDir}");
        return false;
    }
    
    $success = true;
    foreach ($files as $file) {
        // Skip the current hash file
        if (strpos($file, "css_{$currentHash}") !== false) {
            continue;
        }
        
        // Try to remove old files
        if (!unlink($file)) {
            css_debug_log("Failed to remove old CSS file: {$file}");
            $success = false;
        } else {
            css_debug_log("Removed old CSS file: {$file}");
        }
    }
    
    return $success;
}

/**
 * Analyze CSS files in directory and subdirectories
 * 
 * @param string $dir Directory to scan for CSS files
 * @param string &$content Output parameter for concatenated CSS content
 * @param array &$stats Output parameter for file statistics
 * @param int &$lastModified Output parameter for latest modification timestamp
 */
function analyzeCssFiles($dir, &$content = '', &$stats = [], &$lastModified = 0) {
    $files = scandir($dir);

    foreach ($files as $file) {
        if ($file === '.' || $file === '..') {
            continue;
        }

        $filePath = $dir . DIRECTORY_SEPARATOR . $file;

        if (is_dir($filePath)) {
            analyzeCssFiles($filePath, $content, $stats, $lastModified);
        } elseif (is_file($filePath) && pathinfo($filePath, PATHINFO_EXTENSION) === 'css') {
            if (!is_readable($filePath)) {
                css_debug_log("No access to file: $filePath");
                continue;
            }

            $fileStats = stat($filePath);
            $fileContent = file_get_contents($filePath);
            $minifiedContent = minifyCss($fileContent);

            // Track the most recent file modification time
            if ($fileStats['mtime'] > $lastModified) {
                $lastModified = $fileStats['mtime'];
            }

            $stats[$filePath] = [
                'size' => $fileStats['size'],
                'minified_size' => strlen($minifiedContent),
                'last_modified' => date('Y-m-d H:i:s', $fileStats['mtime']),
                'mtime' => $fileStats['mtime'],
                'rule_count' => substr_count($fileContent, '{'),
                'comment_count' => substr_count($fileContent, '/*')
            ];

            $content .= "/* File: $filePath | Original: {$stats[$filePath]['size']}b | Minified: {$stats[$filePath]['minified_size']}b */";
            $content .= "\n" . $minifiedContent . "\n\n";
        }
    }

    return $content;
}

/**
 * Generate a hash based on CSS files statistics
 * 
 * @param array $stats Array of file statistics
 * @return string MD5 hash of file modification times
 */
function generateCssHash($stats) {
    // Extract all file modification times
    $modTimes = [];
    foreach ($stats as $file => $fileStats) {
        $modTimes[] = $fileStats['mtime'];
    }
    
    // Create a string representation and hash it
    $modTimeString = implode('|', $modTimes);
    return md5($modTimeString);
}

/**
 * Compile CSS if needed and return the filename
 * 
 * @param string $hash Hash to use for the CSS filename
 * @return string Name of the CSS file (either existing or newly compiled)
 */
function compileCssIfNeeded($hash) {
    $sourceDir = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'resources' . DIRECTORY_SEPARATOR . 'css';
    $buildDir = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . 'build';
    $outputFile = $buildDir . DIRECTORY_SEPARATOR . "css_{$hash}.min.css";
    
    // Ensure build directory exists and is writable
    if (!is_dir($buildDir)) {
        if (!mkdir($buildDir, 0755, true)) {
            css_debug_log("Failed to create build directory: {$buildDir}");
            return 'css_error.min.css';
        }
    }
    
    if (!is_writable($buildDir)) {
        css_debug_log("Build directory is not writable: {$buildDir}");
        return 'css_error.min.css';
    }
    
    // Clear old CSS files
    clearOldCssFiles($buildDir, $hash);
    
    // Check if file already exists
    if (file_exists($outputFile)) {
        return basename($outputFile);
    }
    
    // Compile CSS
    $cssContent = '';
    $fileStats = [];
    $lastModified = 0;
    
    try {
        analyzeCssFiles($sourceDir, $cssContent, $fileStats, $lastModified);
        
        if (!empty($cssContent)) {
            $summary = "/*\n";
            $summary .= " Minified CSS Files Compilation\n";
            $summary .= " Total files: " . count($fileStats) . "\n";
            $summary .= " Original size: " . array_sum(array_column($fileStats, 'size')) . " bytes\n";
            $summary .= " Minified size: " . array_sum(array_column($fileStats, 'minified_size')) . " bytes\n";
            $summary .= " Total rules: " . array_sum(array_column($fileStats, 'rule_count')) . "\n";
            $summary .= " Generated: " . date('Y-m-d H:i:s') . "\n";
            $summary .= " Hash: {$hash}\n";
            $summary .= "*/\n\n";
            
            $finalContent = $summary . $cssContent;
            
            // Try to write the file
            if (file_put_contents($outputFile, $finalContent) === false) {
                css_debug_log("CSS Compilation Error: Failed to write to output file: {$outputFile}");
                return 'css_compilation_error.min.css'; // Return a fallback name
            }
            
            css_debug_log("CSS Compilation Success: Created new CSS file with hash: {$hash}");
            return basename($outputFile);
        } else {
            css_debug_log("CSS Compilation Warning: No CSS content found to compile");
            return 'css_empty.min.css'; // Return a fallback name
        }
    } catch (Exception $e) {
        css_debug_log("CSS Compilation Error: " . $e->getMessage());
        return 'css_compilation_error.min.css'; // Return a fallback name
    }
}

// Initialize CSS hash and file variables based on configuration
$cssHash = '';
$cssFile = '';

if (isset($no_cache_static) && $no_cache_static) {
    // In development mode, use file modification times for CSS hash
    $sourceDir = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'resources' . DIRECTORY_SEPARATOR . 'css';
    $cssContent = '';
    $fileStats = [];
    $lastModified = 0;
    
    analyzeCssFiles($sourceDir, $cssContent, $fileStats, $lastModified);
    $cssHash = generateCssHash($fileStats);
} else {
    // In production mode, use git commit hash for CSS
    $cssHash = $staticVersion;
}

// Debug information
css_debug_log("Mode = " . (isset($no_cache_static) && $no_cache_static ? 'development' : 'production'));
css_debug_log("Hash = {$cssHash}");
css_debug_log("Static Version = {$staticVersion}");

// Always check if a CSS file with the current hash exists
$buildDir = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . 'build';
$expectedCssFile = $buildDir . DIRECTORY_SEPARATOR . "css_{$cssHash}.min.css";

// Debug directory information
css_debug_log("Build Dir = {$buildDir}");
css_debug_log("Expected CSS File = {$expectedCssFile}");
css_debug_log("Build Dir exists = " . (is_dir($buildDir) ? 'yes' : 'no'));
css_debug_log("Build Dir writable = " . (is_writable($buildDir) ? 'yes' : 'no'));

// Check if compiled file with current hash exists
if (file_exists($expectedCssFile)) {
    // Use existing file
    $cssFile = basename($expectedCssFile);
    css_debug_log("Using existing file = {$cssFile}");
} else {
    css_debug_log("Need to compile new CSS file");
    // If no matching CSS file exists, compile a new one with the current hash
    $cssFile = compileCssIfNeeded($cssHash);
    css_debug_log("Compilation result = {$cssFile}");
}
