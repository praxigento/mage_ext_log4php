<?php
 
class Nmmlm_Log_Logger_Test extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        /* You'll have to load Magento app in any test classes in this method */
        $app = Mage::app('default');
        /* You will need a layout for block tests */
        //$this->_layout = $app->getLayout();
        /* Let's create the block instance for further tests */
        //$this->_block = new Company_Module_Block_Blockname;
        /* We are required to set layouts before we can do anything with blocks */
        //$this->_block->setLayout($this->_layout);
    }
 
    public function testTrace()
    {
      $log = Nmmlm_Log_Logger::getLogger(__CLASS__);
      $log->trace("trace level message");
    }
 
    public function testDebug()
    {
      $log = Nmmlm_Log_Logger::getLogger(__CLASS__);
      $log->debug("debug level message");
    }
    
    public function testInfo()
    {
      $log = Nmmlm_Log_Logger::getLogger(__CLASS__);
      $log->info("info level message");
    }
    
    public function testWarn()
    {
      $log = Nmmlm_Log_Logger::getLogger(__CLASS__);
      $log->warn("warn level message");
    }
    
    public function testError()
    {
      $log = Nmmlm_Log_Logger::getLogger(__CLASS__);
      $log->error("error level message");
    }
    
    public function testFatal()
    {
      $log = Nmmlm_Log_Logger::getLogger(__CLASS__);
      $log->fatal("fatal level message");
    }
}
