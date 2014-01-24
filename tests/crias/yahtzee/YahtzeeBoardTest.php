<?php
namespace crias\yahtzee;
use PHPUnit_Framework_TestCase;

class YahtzeeBoardTest extends PHPUnit_Framework_TestCase {
  
  public function testTotalScore_shouldReturnZero_whenNoScoringHasOccurred() {
    $y = new YahtzeeBoard();

    $this->assertEquals(0, $y->totalScore());
  }

  public function testOnes_totalScoreShouldReturnScoreEqualToTotalNumberOfOnes_whenScoringOnes() {
    $this->assertEquals(0, $this->boardWithOnes(dice(2), dice(3), dice(4), dice(5), dice(6))->totalScore());
    $this->assertEquals(1, $this->boardWithOnes(dice(1), dice(3), dice(4), dice(5), dice(6))->totalScore());
    $this->assertEquals(2, $this->boardWithOnes(dice(1), dice(1), dice(4), dice(5), dice(6))->totalScore());
    $this->assertEquals(3, $this->boardWithOnes(dice(1), dice(1), dice(1), dice(5), dice(6))->totalScore());
    $this->assertEquals(4, $this->boardWithOnes(dice(1), dice(1), dice(1), dice(1), dice(6))->totalScore());
    $this->assertEquals(5, $this->boardWithOnes(dice(1), dice(1), dice(1), dice(1), dice(1))->totalScore());
  }
  
  public function testOnes_positionOfTheDiceDoesntMatter() {
    $this->assertEquals(1, $this->boardWithOnes(dice(1), dice(2), dice(2), dice(2), dice(2))->totalScore());
    $this->assertEquals(1, $this->boardWithOnes(dice(2), dice(1), dice(2), dice(2), dice(2))->totalScore());
    $this->assertEquals(1, $this->boardWithOnes(dice(2), dice(2), dice(1), dice(2), dice(2))->totalScore());
    $this->assertEquals(1, $this->boardWithOnes(dice(2), dice(2), dice(2), dice(1), dice(2))->totalScore());
    $this->assertEquals(1, $this->boardWithOnes(dice(2), dice(2), dice(2), dice(2), dice(1))->totalScore());
  }

  public function testOnes_cannotModifyOnesAfterTheyAreScored() {
    $y = new YahtzeeBoard();
    
    $y->scoreOnes(dice(1), dice(2), dice(1), dice(3), dice(1));
    $this->assertEquals(3, $y->totalScore());

    $y->scoreOnes(dice(1), dice(1), dice(1), dice(1), dice(1)); // Should this throw?
    $this->assertEquals(3, $y->totalScore());

    $y->scoreOnes(dice(2), dice(3), dice(4), dice(5), dice(6)); // Should this throw?
    $this->assertEquals(3, $y->totalScore());
  }

  public function testTwos_totalScoreShouldReturnScoreEqualToTotalNumberOfTwos_whenScoringTwos() {
    $this->assertEquals(0, $this->boardWithTwos(dice(1), dice(3), dice(4), dice(5), dice(6))->totalScore());
    $this->assertEquals(2, $this->boardWithTwos(dice(2), dice(3), dice(4), dice(5), dice(6))->totalScore());
    $this->assertEquals(4, $this->boardWithTwos(dice(2), dice(2), dice(4), dice(5), dice(6))->totalScore());
    $this->assertEquals(6, $this->boardWithTwos(dice(2), dice(2), dice(2), dice(5), dice(6))->totalScore());
    $this->assertEquals(8, $this->boardWithTwos(dice(2), dice(2), dice(2), dice(2), dice(6))->totalScore());
    $this->assertEquals(10, $this->boardWithTwos(dice(2), dice(2), dice(2), dice(2), dice(2))->totalScore());
  }
  
  public function testTwos_positionOfTheDiceDoesntMatter() {
    $this->assertEquals(2, $this->boardWithTwos(dice(2), dice(1), dice(1), dice(1), dice(1))->totalScore());
    $this->assertEquals(2, $this->boardWithTwos(dice(1), dice(2), dice(1), dice(1), dice(1))->totalScore());
    $this->assertEquals(2, $this->boardWithTwos(dice(1), dice(1), dice(2), dice(1), dice(1))->totalScore());
    $this->assertEquals(2, $this->boardWithTwos(dice(1), dice(1), dice(1), dice(2), dice(1))->totalScore());
    $this->assertEquals(2, $this->boardWithTwos(dice(1), dice(1), dice(1), dice(1), dice(2))->totalScore());
  }

  public function testTwos_cannotModifyTwosAfterTheyAreScored() {
    $y = new YahtzeeBoard();
    
    $y->scoreTwos(dice(2), dice(1), dice(2), dice(3), dice(2));
    $this->assertEquals(6, $y->totalScore());

    $y->scoreTwos(dice(2), dice(2), dice(2), dice(2), dice(2)); // Should this throw?
    $this->assertEquals(6, $y->totalScore());

    $y->scoreTwos(dice(1), dice(3), dice(4), dice(5), dice(6)); // Should this throw?
    $this->assertEquals(6, $y->totalScore());
  }

  private function boardWithOnes(Dice $first, Dice $second, Dice $third, Dice $fourth, Dice $fifth) {
    $y = new YahtzeeBoard();
    $y->scoreOnes($first, $second, $third, $fourth, $fifth);
    return $y;
  }

  private function boardWithTwos(Dice $first, Dice $second, Dice $third, Dice $fourth, Dice $fifth) {
    $y = new YahtzeeBoard();
    $y->scoreTwos($first, $second, $third, $fourth, $fifth);
    return $y;
  }

}
