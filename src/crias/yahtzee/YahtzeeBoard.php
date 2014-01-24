<?php
namespace crias\yahtzee;
use crias\Some;
use crias\None;

class YahtzeeBoard {
  private $ones;
  private $twos;
  
  public function __construct() {
    $this->ones = new None;
    $this->twos = new None;
  }
  
  public function totalScore() {
    return $this->ones->getOrElse(0) + $this->twos->getOrElse(0);
  }
  
  public function scoreOnes(Dice $first, Dice $second, Dice $third, Dice $fourth, Dice $fifth) {
    $this->ones = $this->ones->orElse($this->sumValuesEqualTo(1, [$first, $second, $third, $fourth, $fifth]));
  }
  
  public function scoreTwos(Dice $first, Dice $second, Dice $third, Dice $fourth, Dice $fifth) {
    $this->twos = $this->twos->orElse($this->sumValuesEqualTo(2, [$first, $second, $third, $fourth, $fifth]));
  }

  private function sumValuesEqualTo($value, array $dice) {
    $total = 0;
    for($i = 0; $i < sizeof($dice); $i++) {
      if($dice[$i]->value() == $value) {
        $total = $total + $value;
      }
    }
    return $total;
  }
}