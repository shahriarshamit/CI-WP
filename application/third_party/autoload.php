<?php

/**
 * auto load function
 *
 *
 * @package		CI-WP
 * @subpackage	CodeIgniter
 * @category	Third_party
 * @author      W3plan Technologies
 */

/**
 * Attempt to load undefined class
 *
 *
 * @param   string  Name of the class to load
 * @return	void  
 */
function __autoload($class) {
    if (substr($class, 0, 1) == '\\') {
        $class = substr($class, 1);
        if (strlen(str_replace('\\', '', $class)) == strlen($class)) {
            return;
        }
    }
    
    $filename = str_replace('\\', DIRECTORY_SEPARATOR, $class);
    $filepath = (substr($filename, -4) == '.php') ? $filename : $filename . '.php';
    
    // uncomment following line to see included php files from browser console 
    // echo '<script>console.log("'. $class . ' --> ' . $filepath . '");</script>';
    
    include_once $filepath;
}

