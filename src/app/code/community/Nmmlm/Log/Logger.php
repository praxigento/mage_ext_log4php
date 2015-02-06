<?php
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
class Nmmlm_Log_Logger extends Logger {
	private static $_isInitialized = false;

	/**
	 * Override getter to use '$log = Nmmlm_Log_Logger::getLogger($this)' form in Mage classes.
	 * @static
	 *
	 * @param string $name
	 *
	 * @return Logger
	 */
	public static function getLogger($name) {
		// init logger
		if(!Nmmlm_Log_Logger::$_isInitialized) {
			Nmmlm_Log_Logger::initMageLogger();
		}
		// define logger name
		if(is_object($name)) {
			return parent::getLogger(Nmmlm_Log_Logger::rewriteName(get_class($name)));
		} else {
			return parent::getLogger(Nmmlm_Log_Logger::rewriteName($name));
		}
	}

	/**
	 * Load Log4php configuration file.
	 */
	private static function initMageLogger() {
		$dir  = Mage::getBaseDir('base');
		$file = $dir . DS . Nmmlm_Log_Logger::cfgLog4phpConfigFile();
		Nmmlm_Log_Logger::configure($file);
		Nmmlm_Log_Logger::$_isInitialized = true;
	}

	/**
	 * Return path to Log4php configuration file relative to Magento base directory.
	 * @return string
	 */
	private static function cfgLog4phpConfigFile() {
		return (string)Mage::getStoreConfig('dev/log/nmmlm_log4php_config_file');
	}

	public function __construct($name) {
		parent::__construct(Nmmlm_Log_Logger::rewriteName($name));
	}

	/**
	 * Convert Magento style package (Company_Module_Directory_Class) and PHP namespace (Company\Module\Directory\Class) to log4php style package (Company.Module.Directory.Class).
	 * @static
	 *
	 * @param $name
	 *
	 * @return mixed
	 */
	private static function rewriteName($name) {
		return str_replace('\\', '.', str_replace('_', '.', $name));
	}

}

