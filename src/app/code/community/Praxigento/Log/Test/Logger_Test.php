<?php

/**
 * Copyright (c) 2015, Praxigento
 * All rights reserved.
 */
class Praxigento_Log_Test_Logger_Test extends PHPUnit_Framework_TestCase
{

    public function testTrace()
    {
        $log = Praxigento_Log_Logger::getLogger(__CLASS__);
        $log->trace("trace level message");
    }

    public function testDebug()
    {
        $log = Praxigento_Log_Logger::getLogger(__CLASS__);
        $log->debug("debug level message");
    }

    public function testInfo()
    {
        $log = Praxigento_Log_Logger::getLogger(__CLASS__);
        $log->info("info level message");
    }

    public function testWarn()
    {
        $log = Praxigento_Log_Logger::getLogger(__CLASS__);
        $log->warn("warn level message");
    }

    public function testError()
    {
        $log = Praxigento_Log_Logger::getLogger(__CLASS__);
        $log->error("error level message");
    }

    public function testFatal()
    {
        $log = Praxigento_Log_Logger::getLogger(__CLASS__);
        $log->fatal("fatal level message");
    }
}
