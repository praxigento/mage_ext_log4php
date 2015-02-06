<?php
ini_set('include_path', ini_get('include_path') . PATH_SEPARATOR 
     . dirname(__FILE__) . '/../../app' . PATH_SEPARATOR . dirname(__FILE__));
//Set custom memory limit
ini_set('memory_limit', '512M');
//Include Magento libraries
$mage = 'mage/app/Mage.php';
$path = '';
for ($i = 0; $i < 32; $i++) {
    if (file_exists($path . $mage)) {
        require_once $path . $mage;
        break;
    } else {
        $path = '../' . $path;
    }
}
Mage::app();

//Avoid issues "Headers already send"
session_start();
