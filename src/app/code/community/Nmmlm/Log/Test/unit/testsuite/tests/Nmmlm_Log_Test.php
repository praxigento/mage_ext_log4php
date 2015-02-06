<?php
 
class Parxigento_Module_NmmlmLogTest extends PHPUnit_Framework_TestCase
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
 
    public function testFirstMethod()
    {
        /*Here goes the assertions for your block first method*/
      $log = Nmmlm_Log_Logger::getLogger(__CLASS__);
      $log->trace("trace level message");
      $log->debug("debug level message");
      $log->info("info level message");
      $log->warn("warn level message");
      $log->error("error level message");
      $log->fatal("fatal level message");
    }
 
    public function testSecondMethod()
    {
        /*Here goes the assertions for your block second method*/
    }
}
