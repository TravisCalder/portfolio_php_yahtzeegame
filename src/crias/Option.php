<?php
namespace crias;

abstract class Option {
  abstract function isEmpty();
  abstract function map($fn);
  abstract function getOrElse($default);

  public function isDefined() {
    return !$this->isEmpty();
  }
  
  public function orElse($val) {
    return new Some($this->getOrElse($val));
  }
}
