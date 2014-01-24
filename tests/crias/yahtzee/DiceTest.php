<?php
namespace crias\yahtzee;
use Exception;
use InvalidArgumentException;
use PHPUnit_Framework_TestCase;
use crias\testing\ExceptionTesting;

class DiceTest extends PHPUnit_Framework_TestCase {
  use ExceptionTesting;
  
  public function testConstruct_shouldSucceed_withValidDiceValues() {
    $this->assertEquals(new Dice(1), dice(1));
    $this->assertEquals(1, dice(1)->value());
    $this->assertEquals(2, dice(2)->value());
    $this->assertEquals(3, dice(3)->value());
    $this->assertEquals(4, dice(4)->value());
    $this->assertEquals(5, dice(5)->value());
    $this->assertEquals(6, dice(6)->value());
  }

  public function testConstruct_shouldFail_withInvalidDiceValues() {
    $this->assertException(new InvalidArgumentException("Invalid dice value: -1"), function() { 
      dice(-1); 
    });

    $this->assertException(new InvalidArgumentException("Invalid dice value: 0"), function() { 
      dice(0); 
    });

    $this->assertException(new InvalidArgumentException("Invalid dice value: 7"), function() { 
      dice(7); 
    });

    $this->assertException(new InvalidArgumentException("Invalid dice value: 8"), function() { 
      dice(8); 
    });
  }
}