<?php

require_once 'fonts/Prosyl.php';

/**
 * Test class for Prosyl.
 * Generated by PHPUnit on 2010-05-17 at 15:52:40.
 */
class ProsylTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var Prosyl
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->object = new Prosyl;
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
    }

    /**
     * @todo Implement testUnicode_a_legacy().
     */
    public function testUnicode_a_legacy()
    {
    	$arru = array(0xE1,0x90,0x83,0xE1,0x93,0x84,0xE1,0x90,0x83,0xE1,0x91,0xA6);
    	$u = implode('',array_map('chr',$arru));
    	$au = 'wkw5';
    	$ru = Prosyl::unicodeToLegacy($u);
    	$this->assertEquals($au,$ru);
    }

    public function testLegacy_a_unicode()
    {
    	$lu = 'wkw5';
    	$arru = array(0xE1,0x90,0x83,0xE1,0x93,0x84,0xE1,0x90,0x83,0xE1,0x91,0xA6);
    	$au = implode('',array_map('chr',$arru));
    	$ru = Prosyl::legacyToUnicode($lu, FALSE);
    	$this->assertEquals($au,$ru);
    }

}
?>
