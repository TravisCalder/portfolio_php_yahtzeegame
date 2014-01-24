<?php
namespace crias\yahtzee;
use crias\Some;
use crias\None;

class YahtzeeBoard {
  private $ones;
  private $twos;
  private $threes;
  private $fours;
  private $fives;
  private $sixes;

  public function __construct() {
    $this->ones = new None;
    $this->twos = new None;
    $this->threes = new None;
    $this->fours = new None;
    $this->fives = new None;
    $this->sixes = new None;
  }
  
  // Intentionally bad implementation - fix it with a test!
  public function totalScore() {
    return $this->upperScore();
  }
  
  public function upperScore() {
    return $this->ones->getOrElse(0) +
      $this->twos->getOrElse(0) +
      $this->threes->getOrElse(0) +
      $this->fours->getOrElse(0) +
      $this->fives->getOrElse(0) +
      $this->sixes->getOrElse(0);
  }
  
  public function bonus() {
    return 0;
  }
  
  public function scoreOnes(Dice $first, Dice $second, Dice $third, Dice $fourth, Dice $fifth) {
    $this->ones = $this->ones->orElse($this->sumValuesEqualTo(1, [$first, $second, $third, $fourth, $fifth]));
  }
  
  public function scoreTwos(Dice $first, Dice $second, Dice $third, Dice $fourth, Dice $fifth) {
    $this->twos = $this->twos->orElse($this->sumValuesEqualTo(2, [$first, $second, $third, $fourth, $fifth]));
  }

  public function scoreThrees(Dice $first, Dice $second, Dice $third, Dice $fourth, Dice $fifth) {
    $this->threes = $this->threes->orElse($this->sumValuesEqualTo(3, [$first, $second, $third, $fourth, $fifth]));
  }

  public function scoreFours(Dice $first, Dice $second, Dice $third, Dice $fourth, Dice $fifth) {
    $this->fours = $this->fours->orElse($this->sumValuesEqualTo(4, [$first, $second, $third, $fourth, $fifth]));
  }

  public function scoreFives(Dice $first, Dice $second, Dice $third, Dice $fourth, Dice $fifth) {
    $this->fives = $this->fives->orElse($this->sumValuesEqualTo(5, [$first, $second, $third, $fourth, $fifth]));
  }

  public function scoreSixes(Dice $first, Dice $second, Dice $third, Dice $fourth, Dice $fifth) {
    $this->sixes = $this->sixes->orElse($this->sumValuesEqualTo(6, [$first, $second, $third, $fourth, $fifth]));
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