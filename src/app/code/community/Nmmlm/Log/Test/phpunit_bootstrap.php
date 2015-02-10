<?php
/**
 * Traverse up and lookup for the './mage/' folder to add to 'include_path'.
 */
// Set custom memory limit
ini_set('memory_limit', '512M');
// Magento root folder name (see "magento-root-dir" extra var in test/composer.json)
$mageRoot = 'mage';
// Magento main file relative to the Magento root.
$mageApp = 'app' . DIRECTORY_SEPARATOR . 'Mage.php';
// Directory of the current file (phpunit_bootstrap.php)
$path = __DIR__;
// Clear cache for file_exists()
clearstatcache();
for($i = 0; $i < 32; $i++) {
    $pathToMage = $path . DIRECTORY_SEPARATOR . $mageRoot . DIRECTORY_SEPARATOR . $mageApp;
    if(file_exists($pathToMage)) {
        $ini_set = ini_get('include_path') . PATH_SEPARATOR . $path . DIRECTORY_SEPARATOR . $mageRoot;
        ini_set('include_path', $ini_set);
        require_once $mageApp;
        break;
    } else {
        $path = dirname($path);
    }
}
// Start Magento application
Mage::app('default');
//Avoid issues "Headers already send"
session_start();
