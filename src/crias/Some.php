<?php
namespace crias;

class Some extends Option {
  
  private $value = null;
  
  public function __construct($value) {
    $this->value = $value;
  }

  public function isEmpty() { 
    return false; 
  }
  
  public function map($fn) {
    return new Some($fn($this->value));
  }
  
  public function getOrElse($default) {
    return $this->value;
  }
}