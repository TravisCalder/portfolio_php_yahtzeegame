<?php

 class OptionTest extends PHPUnit_Framework_TestCase {

  public function testSome_shouldBeDefined() {
    $some = new Some(1);
    
    $this->assertEquals($some->isDefined(), true);
    $this->assertEquals($some->isEmpty(), false);
  }

  public function testNone_shouldBeDefined() {
    $none = new None;
    
    $this->assertEquals($none->isDefined(), false);
    $this->assertEquals($none->isEmpty(), true);
  }

  public function testSome_returnsStoredValue_whenGetOrElse() {
    $some = new Some(1);
    
    $this->assertEquals($some->getOrElse(2), 1);
  }

  public function testNone_returnsDefaultValue_whenGetOrElse() {
    $none = new None;
    
    $this->assertEquals($none->getOrElse(2), 2);
  }

  public function testSome_returnsSomeOfMappedValue_whenMap() {
    $some = new Some(1);
    
    $this->assertEquals($some->map(function ($x) { 
      return ($x * 2); 
    }), new Some(2));
  }

  public function testNone_returnsNone_whenMap() {
    $none = new None;
    
    $this->assertEquals($none->map(function ($x) { 
      return ($x * 2); 
    }), new None);
  }

 }