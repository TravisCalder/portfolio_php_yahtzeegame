<?php
class None implements Option {
  
  public function __construct() {}

  public function isEmpty() { 
    return true; 
  }

  public function isDefined() { 
    return false; 
  }
  
  public function map($fn) {
    return new None;
  }
  
  public function getOrElse($default) {
    return $default;
  }
}