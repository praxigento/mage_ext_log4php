<?php
/**
 * Copyright (c) 2015, Praxigento
 * All rights reserved.
 */
/**
 * Override original logger to adopt it to Magento.
 * Authors: Alex Gusev <alex@flancer64.com>
 */
/* add log4php folders to include path */
$inc_base = Mage::getBaseDir('lib') . DS . 'Log4php';
$add_path = $inc_base . PS;
$add_path .= $inc_base . DS . 'appenders' . PS;
$add_path .= $inc_base . DS . 'configurators' . PS;
$add_path .= $inc_base . DS . 'filters' . PS;
$add_path .= $inc_base . DS . 'helpers' . PS;
$add_path .= $inc_base . DS . 'pattern' . PS;
$add_path .= $inc_base . DS . 'layouts' . PS;
$add_path .= $inc_base . DS . 'renderers';
set_include_path(get_include_path() . PS . $add_path);

//
class Praxigento_Log_Logger extends Logger
{
    private static $_isInitialized = false;

    /**
     * Override getter to use '$log = Praxigento_Log_Logger::getLogger($this)' form in Mage classes.
     * @static
     *
     * @param string $name
     *
     * @return Logger
     */
    public static function getLogger($name)
    {
        // init logger
        if (!Praxigento_Log_Logger::$_isInitialized) {
            Praxigento_Log_Logger::initMageLogger();
        }
        // define logger name
        if (is_object($name)) {
            $loggerName = get_class($name);
        } else {
            $loggerName = (string)$name;
        }
        $fixedName = Praxigento_Log_Logger::rewriteName($loggerName);
        return parent::getLogger($fixedName);
    }

    /**
     * Analyze Magento configuration and load Log4php configuration file.
     */
    private static function initMageLogger()
    {
        $dir = Mage::getBaseDir('base');
        $isActive = (string)Mage::getStoreConfig('dev/log/active');
        $isActive = filter_var($isActive, FILTER_VALIDATE_BOOLEAN);
        if ($isActive) {
            /* use configuration file*/
            $cfg = (string)Mage::getStoreConfig('dev/log/prxgt_log4php_config_file');
            $file = $dir . DS . $cfg;
            Praxigento_Log_Logger::configure($file);
        } else {
            /* disable Log4php output */
            $options = array('threshold' => 'off');
            Praxigento_Log_Logger::configure($options);
        }
        Praxigento_Log_Logger::$_isInitialized = true;
    }

    public function __construct($name)
    {
        parent::__construct(Praxigento_Log_Logger::rewriteName($name));
    }

    /**
     * Convert Magento style package (Company_Module_Directory_Class) and PHP namespace
     * (Company\Module\Directory\Class) to log4php style package (Company.Module.Directory.Class).
     * @static
     *
     * @param $name
     *
     * @return mixed
     */
    private static function rewriteName($name)
    {
        return str_replace('\\', '.', str_replace('_', '.', $name));
    }

}

