<?php
class Some implements Option {
  
  private $value = null;
  
  public function __construct($value) {
    $this->value = $value;
  }

  public function isEmpty() { 
    return false; 
  }

  public function isDefined() { 
    return true; 
  }
  
  public function map($fn) {
    return new Some($fn($this->value));
  }
  
  public function getOrElse($default) {
    return $this->value;
  }
}