<?php
namespace crias;
use PHPUnit_Framework_TestCase;

class OptionTest extends PHPUnit_Framework_TestCase {

  public function testSome_shouldBeDefined() {
    $some = new Some(1);
    
    $this->assertEquals(true, $some->isDefined());
    $this->assertEquals(false, $some->isEmpty());
  }

  public function testNone_shouldBeDefined() {
    $none = new None;
    
    $this->assertEquals(false, $none->isDefined());
    $this->assertEquals(true, $none->isEmpty());
  }

  public function testSome_returnsStoredValue_whenGetOrElse() {
    $some = new Some(1);
    
    $this->assertEquals(1, $some->getOrElse(2));
  }

  public function testNone_returnsDefaultValue_whenGetOrElse() {
    $none = new None;
    
    $this->assertEquals(2, $none->getOrElse(2));
  }

  public function testSome_returnsSomeOfMappedValue_whenMap() {
    $some = new Some(1);
    
    $this->assertEquals(new Some(2), $some->map(function ($x) { 
      return ($x * 2); 
    }));
  }

  public function testNone_returnsNone_whenMap() {
    $none = new None;
    
    $this->assertEquals(new None, $none->map(function ($x) { 
      return ($x * 2); 
    }));
  }

  public function testSome_returnsOriginalValue_whenOrElse() {
    $some = new Some(1);
    
    $this->assertEquals(new Some(1), $some->orElse(1));
  }

  public function testNone_returnsAlternateValue_whenOrElse() {
    $none = new None;
    
    $this->assertEquals(new Some(2), $none->orElse(2));
  }

}