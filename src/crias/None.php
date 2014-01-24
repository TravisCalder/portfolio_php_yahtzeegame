<?php
namespace crias;

class None extends Option {
  
  public function __construct() {}

  public function isEmpty() { 
    return true; 
  }

  public function map($fn) {
    return new None;
  }
  
  public function getOrElse($default) {
    return $default;
  }
}