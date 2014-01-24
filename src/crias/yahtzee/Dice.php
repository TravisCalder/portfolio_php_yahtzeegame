<?php
namespace crias\yahtzee;
use InvalidArgumentException;

function dice($value) {
  return new Dice($value);
}

class Dice {
  private $_value;
  
  public function __construct($value) {
    if($value < 1 || $value > 6) {
      throw new InvalidArgumentException("Invalid dice value: $value");
    }
    $this->_value = $value;
  }
  
  public function value() {
    return $this->_value;
  }
}