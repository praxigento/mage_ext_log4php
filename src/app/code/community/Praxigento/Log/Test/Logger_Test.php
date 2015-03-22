<?php

/**
 * Copyright (c) 2015, Praxigento
 * All rights reserved.
 */
class Praxigento_Log_Test_Logger_Test extends PHPUnit_Framework_TestCase
{

    public function test_constructor()
    {
        $nameLog4php = 'Company.Module.Directory.Class';
        $nameMage = 'Company_Module_Directory_Class';
        $namePhp = 'Company\Module\Directory\Class';
        $log = Praxigento_Log_Logger::getLogger($nameMage);
        $this->assertEquals($nameLog4php, $log->getName());
        $log = Praxigento_Log_Logger::getLogger($namePhp);
        $this->assertEquals($nameLog4php, $log->getName());
    }

    public function test_syscfg_log_on_off()
    {
        $currentState = Mage::getStoreConfig('dev/log/active');
        /* switch logging off */
        Mage::app()->getStore()->setConfig('dev/log/active', 0);
        Praxigento_Log_Logger::resetConfiguration();
        $log = Praxigento_Log_Logger::getLogger(__CLASS__);
        $threshold = $log->getHierarchy()->getThreshold();
        $this->assertEquals(LoggerLevel::OFF, $threshold->toInt());
        $log->debug('logger should be disabled');
        /* switch logging on */
        Praxigento_Log_Logger::resetConfiguration();
        Mage::app()->getStore()->setConfig('dev/log/active', 1);
        $log = Praxigento_Log_Logger::getLogger(__CLASS__);
        $threshold = $log->getHierarchy()->getThreshold();
        $this->assertNotEquals(LoggerLevel::OFF, $threshold->toInt());
        $log->debug('logger should be enabled');
        /* restore logging */
        Mage::app()->getStore()->setConfig('dev/log/active', $currentState);
    }

    public function test_levels()
    {
        $currentState = Mage::getStoreConfig('dev/log/active');
        /* switch logging on */
        Praxigento_Log_Logger::resetConfiguration();
        Mage::app()->getStore()->setConfig('dev/log/active', 1);
        $log = Praxigento_Log_Logger::getLogger(__CLASS__);
        $log->trace('trace level message');
        $log->debug('debug level message');
        $log->info('info level message');
        $log->warn('warn level message');
        $log->error('error level message');
        $log->fatal('fatal level message');
        /* restore logging */
        Mage::app()->getStore()->setConfig('dev/log/active', $currentState);
    }
}
