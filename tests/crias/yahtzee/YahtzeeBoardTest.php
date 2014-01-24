<?php
namespace crias\yahtzee;
use PHPUnit_Framework_TestCase;

class YahtzeeBoardTest extends PHPUnit_Framework_TestCase {
  public function testSetting() {
    $a = new YahtzeeBoard();
    $a->value = 10;
    $this->assertEquals(10, $a->value);
  }
}
