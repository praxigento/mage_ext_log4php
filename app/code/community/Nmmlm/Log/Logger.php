<?php
/**
 * Copyright (c) 2010, F. Lancer, SIA
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without modification, are permitted provided that the
 * following conditions are met:
 *  - Redistributions of source code must retain the above copyright notice, this list of conditions and the following
 *      disclaimer.
 *  - Redistributions in binary form must reproduce the above copyright notice, this list of conditions and the
 *      following disclaimer in the documentation and/or other materials provided with the distribution.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES,
 * INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
 * DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT HOLDER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL,
 * SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR
 * SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY,
 * WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE
 * OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 */
/**
 * Override original logger to adopt it to Magento.
 * User: Flancer
 * Date: 9/20/12
 * Time: 3:24 AM
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
class Nmmlm_Log_Logger extends Logger
{
    private static $isInitialized = false;

    /**
     * Override getter to use '$log = Nmmlm_Log_Logger::getLogger($this)' form in Mage classes.
     * @static
     *
     * @param string $name
     *
     * @return Logger
     */
    public static function getLogger($name)
    {
        // init logger
        if (!Nmmlm_Log_Logger::$isInitialized) {
            Nmmlm_Log_Logger::initMageLogger();
        }
        // define logger name
        if (is_object($name)) {
            return parent::getLogger(Nmmlm_Log_Logger::rewriteName(get_class($name)));
        } else {
            return parent::getLogger(Nmmlm_Log_Logger::rewriteName($name));
        }
    }

    private static function initMageLogger()
    {
        $dir = Mage::getBaseDir('base');
        $file = $dir . DS . Nmmlm_Log_Logger::cfgLog4phpConfigFile();
        Nmmlm_Log_Logger::configure($file);
        Nmmlm_Log_Logger::$isInitialized = true;
    }

    private static function cfgLog4phpConfigFile()
    {
        return (string)Mage::getStoreConfig('dev/log/nmmlm_log4php_config_file');
    }

    public function __construct($name)
    {
        parent::__construct(Nmmlm_Log_Logger::rewriteName($name));
    }

    public function setName($name)
    {
        parent::setName(Nmmlm_Log_Logger::rewriteName($name));
    }

    /**
     * Convert Magento style package (Company_Module_Directory_Class) and PHP namespace (Company\Module\Directory\Class) to log4php style package (Company.Module.Directory.Class).
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

