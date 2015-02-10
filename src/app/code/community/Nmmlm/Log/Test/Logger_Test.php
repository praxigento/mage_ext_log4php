<?php

class Nmmlm_Log_Test_Logger_Test extends PHPUnit_Framework_TestCase {

	public function testTrace() {
		$log = Nmmlm_Log_Logger::getLogger(__CLASS__);
		$log->trace("trace level message");
	}

	public function testDebug() {
		$log = Nmmlm_Log_Logger::getLogger(__CLASS__);
		$log->debug("debug level message");
	}

	public function testInfo() {
		$log = Nmmlm_Log_Logger::getLogger(__CLASS__);
		$log->info("info level message");
	}

	public function testWarn() {
		$log = Nmmlm_Log_Logger::getLogger(__CLASS__);
		$log->warn("warn level message");
	}

	public function testError() {
		$log = Nmmlm_Log_Logger::getLogger(__CLASS__);
		$log->error("error level message");
	}

	public function testFatal() {
		$log = Nmmlm_Log_Logger::getLogger(__CLASS__);
		$log->fatal("fatal level message");
	}
}
