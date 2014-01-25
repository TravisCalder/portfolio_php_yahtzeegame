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

  private $threeOfAKind;
  private $fourOfAKind;
  private $fullHouse;
  private $smallStraight;
  private $largeStraight;
  private $yahtzee;
  private $chance;
  private $yahtzeeBonusCount;

  public function __construct() {
    $this->ones = new None;
    $this->twos = new None;
    $this->threes = new None;
    $this->fours = new None;
    $this->fives = new None;
    $this->sixes = new None;

    $this->threeOfAKind = new None;
    $this->fourOfAKind = new None;
    $this->fullHouse = new None;
    $this->smallStraight = new None;
    $this->largeStraight = new None;
    $this->yahtzee = new None;
    $this->chance = new None;
    $this->yahtzeeBonusCount = 0;
  }

  public function totalScore() {
    return $this->upperScore() + $this->bonus() + $this->lowerScore() + $this->yahtzeeBonus();
  }
  
  public function yahtzeeBonus() {
    return $this->yahtzeeBonusCount * 100;
  }
  
  public function lowerScore() {
    return $this->threeOfAKind->getOrElse(0) +
      $this->fourOfAKind->getOrElse(0) +
      $this->fullHouse->getOrElse(0) +
      $this->smallStraight->getOrElse(0) +
      $this->largeStraight->getOrElse(0) +
      $this->yahtzee->getOrElse(0) +
      $this->chance->getOrElse(0);
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
    return ($this->upperScore() >= 63) ? 35 : 0;
  }

  public function scoreOnes(Dice $first, Dice $second, Dice $third, Dice $fourth, Dice $fifth) {
    $dice = [$first, $second, $third, $fourth, $fifth];
    $this->ones = $this->ones->orElse($this->sumValuesEqualTo(1, $dice));
    $this->scoreBonusYahtzeeIfApplicable($dice);
  }
  
  public function scoreTwos(Dice $first, Dice $second, Dice $third, Dice $fourth, Dice $fifth) {
    $dice = [$first, $second, $third, $fourth, $fifth];
    $this->twos = $this->twos->orElse($this->sumValuesEqualTo(2, $dice));
    $this->scoreBonusYahtzeeIfApplicable($dice);
  }

  public function scoreThrees(Dice $first, Dice $second, Dice $third, Dice $fourth, Dice $fifth) {
    $dice = [$first, $second, $third, $fourth, $fifth];
    $this->threes = $this->threes->orElse($this->sumValuesEqualTo(3, $dice));
    $this->scoreBonusYahtzeeIfApplicable($dice);
  }

  public function scoreFours(Dice $first, Dice $second, Dice $third, Dice $fourth, Dice $fifth) {
    $dice = [$first, $second, $third, $fourth, $fifth];
    $this->fours = $this->fours->orElse($this->sumValuesEqualTo(4, $dice));
    $this->scoreBonusYahtzeeIfApplicable($dice);
  }

  public function scoreFives(Dice $first, Dice $second, Dice $third, Dice $fourth, Dice $fifth) {
    $dice = [$first, $second, $third, $fourth, $fifth];
    $this->fives = $this->fives->orElse($this->sumValuesEqualTo(5, $dice));
    $this->scoreBonusYahtzeeIfApplicable($dice);
  }

  public function scoreSixes(Dice $first, Dice $second, Dice $third, Dice $fourth, Dice $fifth) {
    $dice = [$first, $second, $third, $fourth, $fifth];
    $this->sixes = $this->sixes->orElse($this->sumValuesEqualTo(6, $dice));
    $this->scoreBonusYahtzeeIfApplicable($dice);
  }

  public function scoreThreeOfAKind(Dice $first, Dice $second, Dice $third, Dice $fourth, Dice $fifth) {
    $values = $this->diceValues([$first, $second, $third, $fourth, $fifth]);
    
    $this->threeOfAKind = $this->threeOfAKind->orElse(
      (sizeof(array_intersect([3, 4, 5], array_count_values($values))) > 0) ? array_sum($values) : 0
    );
  }

  public function scoreFourOfAKind(Dice $first, Dice $second, Dice $third, Dice $fourth, Dice $fifth) {
    $values = $this->diceValues([$first, $second, $third, $fourth, $fifth]);
    
    $this->fourOfAKind = $this->fourOfAKind->orElse(
      (sizeof(array_intersect([4, 5], array_count_values($values))) > 0) ? array_sum($values) : 0
    );
  }

  public function scoreFullHouse(Dice $first, Dice $second, Dice $third, Dice $fourth, Dice $fifth) {
    $values = $this->diceValues([$first, $second, $third, $fourth, $fifth]);
    
    $this->fullHouse = $this->fullHouse->orElse(
      (sizeof(array_intersect([2, 3], array_count_values($values))) == 2) ? 25 : 0
    );
  }

  public function scoreSmallStraight(Dice $first, Dice $second, Dice $third, Dice $fourth, Dice $fifth) {
    $values = $this->diceValues([$first, $second, $third, $fourth, $fifth]);

    $this->smallStraight = $this->smallStraight->orElse(
      ($this->containsRange(1, 4, $values) || $this->containsRange(2, 5, $values) || $this->containsRange(3, 6, $values)) ? 30 : 0
    );
  }

  public function scoreLargeStraight(Dice $first, Dice $second, Dice $third, Dice $fourth, Dice $fifth) {
    $values = $this->diceValues([$first, $second, $third, $fourth, $fifth]);

    $this->largeStraight = $this->largeStraight->orElse(
      ($this->containsRange(1, 5, $values) || $this->containsRange(2, 6, $values)) ? 40 : 0
    );
  }

  public function scoreYahtzee(Dice $first, Dice $second, Dice $third, Dice $fourth, Dice $fifth) {
    $values = $this->diceValues([$first, $second, $third, $fourth, $fifth]);
    
    $this->yahtzee = $this->yahtzee->orElse(
      (sizeof(array_intersect([5], array_count_values($values))) > 0) ? 50 : 0
    );
  }

  public function scoreChance(Dice $first, Dice $second, Dice $third, Dice $fourth, Dice $fifth) {
    $values = $this->diceValues([$first, $second, $third, $fourth, $fifth]);

    $this->chance = $this->chance->orElse(array_sum($values));
  }
  
  private function scoreBonusYahtzeeIfApplicable(array $dice) {
    $values = $this->diceValues($dice);
    
    if($this->yahtzee->isDefined()) {
      $this->yahtzeeBonusCount += (sizeof(array_intersect([5], array_count_values($values))) > 0) ? 1 : 0;
    }
  }

  private function containsRange($start, $end, array $diceValues) {
    $testValues = range($start, $end);

    return sizeof(array_intersect($testValues, $diceValues)) >= sizeof($testValues);
  }

  private function diceValues(array $dice) {
    return array_map(function($d) { return $d->value(); }, $dice);
  }

  private function sumValuesEqualTo($value, array $dice) {
    $counted = array_count_values($this->diceValues($dice));
    return isset($counted[$value]) ? $counted[$value] * $value : 0;
  }
}