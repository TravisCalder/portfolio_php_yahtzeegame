<?php
namespace crias\yahtzee;
use PHPUnit_Framework_TestCase;

class YahtzeeBoardTest extends PHPUnit_Framework_TestCase {
  
  public function testTotalScore_shouldReturnZero_whenNoScoringHasOccurred() {
    $y = new YahtzeeBoard();

    $this->assertEquals(0, $y->totalScore());
  }
  
  /* Ones */

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

  /* Twos */

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

  /* Threes */

  public function testThrees_totalScoreShouldReturnScoreEqualToTotalNumberOfThrees_whenScoringThrees() {
    $this->assertEquals(0, $this->boardWithThrees(dice(1), dice(2), dice(4), dice(5), dice(6))->totalScore());
    $this->assertEquals(3, $this->boardWithThrees(dice(3), dice(2), dice(4), dice(5), dice(6))->totalScore());
    $this->assertEquals(6, $this->boardWithThrees(dice(3), dice(3), dice(4), dice(5), dice(6))->totalScore());
    $this->assertEquals(9, $this->boardWithThrees(dice(3), dice(3), dice(3), dice(5), dice(6))->totalScore());
    $this->assertEquals(12, $this->boardWithThrees(dice(3), dice(3), dice(3), dice(3), dice(6))->totalScore());
    $this->assertEquals(15, $this->boardWithThrees(dice(3), dice(3), dice(3), dice(3), dice(3))->totalScore());
  }
  
  public function testThrees_positionOfTheDiceDoesntMatter() {
    $this->assertEquals(3, $this->boardWithThrees(dice(3), dice(1), dice(1), dice(1), dice(1))->totalScore());
    $this->assertEquals(3, $this->boardWithThrees(dice(1), dice(3), dice(1), dice(1), dice(1))->totalScore());
    $this->assertEquals(3, $this->boardWithThrees(dice(1), dice(1), dice(3), dice(1), dice(1))->totalScore());
    $this->assertEquals(3, $this->boardWithThrees(dice(1), dice(1), dice(1), dice(3), dice(1))->totalScore());
    $this->assertEquals(3, $this->boardWithThrees(dice(1), dice(1), dice(1), dice(1), dice(3))->totalScore());
  }

  public function testThrees_cannotModifyThreesAfterTheyAreScored() {
    $y = new YahtzeeBoard();
    
    $y->scoreThrees(dice(3), dice(1), dice(3), dice(2), dice(3));
    $this->assertEquals(9, $y->totalScore());

    $y->scoreThrees(dice(3), dice(3), dice(3), dice(3), dice(3)); // Should this throw?
    $this->assertEquals(9, $y->totalScore());

    $y->scoreThrees(dice(1), dice(2), dice(4), dice(5), dice(6)); // Should this throw?
    $this->assertEquals(9, $y->totalScore());
  }
  
  /* Fours */

  public function testFours_totalScoreShouldReturnScoreEqualToTotalNumberOfFours_whenScoringFours() {
    $this->assertEquals(0, $this->boardWithFours(dice(1), dice(2), dice(3), dice(5), dice(6))->totalScore());
    $this->assertEquals(4, $this->boardWithFours(dice(4), dice(2), dice(3), dice(5), dice(6))->totalScore());
    $this->assertEquals(8, $this->boardWithFours(dice(4), dice(4), dice(3), dice(5), dice(6))->totalScore());
    $this->assertEquals(12, $this->boardWithFours(dice(4), dice(4), dice(4), dice(5), dice(6))->totalScore());
    $this->assertEquals(16, $this->boardWithFours(dice(4), dice(4), dice(4), dice(4), dice(6))->totalScore());
    $this->assertEquals(20, $this->boardWithFours(dice(4), dice(4), dice(4), dice(4), dice(4))->totalScore());
  }
  
  public function testFours_positionOfTheDiceDoesntMatter() {
    $this->assertEquals(4, $this->boardWithFours(dice(4), dice(1), dice(1), dice(1), dice(1))->totalScore());
    $this->assertEquals(4, $this->boardWithFours(dice(1), dice(4), dice(1), dice(1), dice(1))->totalScore());
    $this->assertEquals(4, $this->boardWithFours(dice(1), dice(1), dice(4), dice(1), dice(1))->totalScore());
    $this->assertEquals(4, $this->boardWithFours(dice(1), dice(1), dice(1), dice(4), dice(1))->totalScore());
    $this->assertEquals(4, $this->boardWithFours(dice(1), dice(1), dice(1), dice(1), dice(4))->totalScore());
  }

  public function testFours_cannotModifyFoursAfterTheyAreScored() {
    $y = new YahtzeeBoard();
    
    $y->scoreFours(dice(4), dice(1), dice(4), dice(2), dice(4));
    $this->assertEquals(12, $y->totalScore());

    $y->scoreFours(dice(4), dice(4), dice(4), dice(4), dice(4)); // Should this throw?
    $this->assertEquals(12, $y->totalScore());

    $y->scoreFours(dice(1), dice(2), dice(3), dice(5), dice(6)); // Should this throw?
    $this->assertEquals(12, $y->totalScore());
  }  

  /* Fives */

  public function testFives_totalScoreShouldReturnScoreEqualToTotalNumberOfFives_whenScoringFives() {
    $this->assertEquals(0, $this->boardWithFives(dice(1), dice(2), dice(3), dice(4), dice(6))->totalScore());
    $this->assertEquals(5, $this->boardWithFives(dice(5), dice(2), dice(3), dice(4), dice(6))->totalScore());
    $this->assertEquals(10, $this->boardWithFives(dice(5), dice(5), dice(3), dice(4), dice(6))->totalScore());
    $this->assertEquals(15, $this->boardWithFives(dice(5), dice(5), dice(5), dice(4), dice(6))->totalScore());
    $this->assertEquals(20, $this->boardWithFives(dice(5), dice(5), dice(5), dice(5), dice(6))->totalScore());
    $this->assertEquals(25, $this->boardWithFives(dice(5), dice(5), dice(5), dice(5), dice(5))->totalScore());
  }
  
  public function testFives_positionOfTheDiceDoesntMatter() {
    $this->assertEquals(5, $this->boardWithFives(dice(5), dice(1), dice(1), dice(1), dice(1))->totalScore());
    $this->assertEquals(5, $this->boardWithFives(dice(1), dice(5), dice(1), dice(1), dice(1))->totalScore());
    $this->assertEquals(5, $this->boardWithFives(dice(1), dice(1), dice(5), dice(1), dice(1))->totalScore());
    $this->assertEquals(5, $this->boardWithFives(dice(1), dice(1), dice(1), dice(5), dice(1))->totalScore());
    $this->assertEquals(5, $this->boardWithFives(dice(1), dice(1), dice(1), dice(1), dice(5))->totalScore());
  }

  public function testFives_cannotModifyFivesAfterTheyAreScored() {
    $y = new YahtzeeBoard();
    
    $y->scoreFives(dice(5), dice(1), dice(5), dice(2), dice(5));
    $this->assertEquals(15, $y->totalScore());

    $y->scoreFives(dice(5), dice(5), dice(5), dice(5), dice(5)); // Should this throw?
    $this->assertEquals(15, $y->totalScore());

    $y->scoreFives(dice(1), dice(2), dice(3), dice(4), dice(6)); // Should this throw?
    $this->assertEquals(15, $y->totalScore());
  }  

  /* Sixes */

  public function testSixes_totalScoreShouldReturnScoreEqualToTotalNumberOfSixes_whenScoringSixes() {
    $this->assertEquals(0, $this->boardWithSixes(dice(1), dice(2), dice(3), dice(4), dice(5))->totalScore());
    $this->assertEquals(6, $this->boardWithSixes(dice(6), dice(2), dice(3), dice(4), dice(5))->totalScore());
    $this->assertEquals(12, $this->boardWithSixes(dice(6), dice(6), dice(3), dice(4), dice(5))->totalScore());
    $this->assertEquals(18, $this->boardWithSixes(dice(6), dice(6), dice(6), dice(4), dice(5))->totalScore());
    $this->assertEquals(24, $this->boardWithSixes(dice(6), dice(6), dice(6), dice(6), dice(5))->totalScore());
    $this->assertEquals(30, $this->boardWithSixes(dice(6), dice(6), dice(6), dice(6), dice(6))->totalScore());
  }
  
  public function testSixes_positionOfTheDiceDoesntMatter() {
    $this->assertEquals(6, $this->boardWithSixes(dice(6), dice(1), dice(1), dice(1), dice(1))->totalScore());
    $this->assertEquals(6, $this->boardWithSixes(dice(1), dice(6), dice(1), dice(1), dice(1))->totalScore());
    $this->assertEquals(6, $this->boardWithSixes(dice(1), dice(1), dice(6), dice(1), dice(1))->totalScore());
    $this->assertEquals(6, $this->boardWithSixes(dice(1), dice(1), dice(1), dice(6), dice(1))->totalScore());
    $this->assertEquals(6, $this->boardWithSixes(dice(1), dice(1), dice(1), dice(1), dice(6))->totalScore());
  }

  public function testSixes_cannotModifySixesAfterTheyAreScored() {
    $y = new YahtzeeBoard();
    
    $y->scoreSixes(dice(6), dice(1), dice(6), dice(2), dice(6));
    $this->assertEquals(18, $y->totalScore());

    $y->scoreSixes(dice(6), dice(6), dice(6), dice(6), dice(6)); // Should this throw?
    $this->assertEquals(18, $y->totalScore());

    $y->scoreSixes(dice(1), dice(2), dice(3), dice(4), dice(5)); // Should this throw?
    $this->assertEquals(18, $y->totalScore());
  }  
  
  /* Upper Board */
  
  public function testUpperBoard_shouldReturnSumOfAllUpperBoardValues_withNoBonus_whenTotalLessThan63() {
    $y = new YahtzeeBoard();
    
    $y->scoreOnes(dice(1), dice(6), dice(6), dice(6), dice(6));
    $y->scoreTwos(dice(2), dice(6), dice(6), dice(6), dice(6));
    $y->scoreThrees(dice(3), dice(6), dice(6), dice(6), dice(6));
    $y->scoreFours(dice(4), dice(6), dice(6), dice(6), dice(6));
    $y->scoreFives(dice(5), dice(6), dice(6), dice(6), dice(6));
    $y->scoreSixes(dice(6), dice(1), dice(1), dice(1), dice(1));
    
    $this->assertEquals(21, $y->totalScore());
    $this->assertEquals(21, $y->upperScore());
    $this->assertEquals(0, $y->bonus());
  }
  

  /* Helpers */
  
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

  private function boardWithThrees(Dice $first, Dice $second, Dice $third, Dice $fourth, Dice $fifth) {
    $y = new YahtzeeBoard();
    $y->scoreThrees($first, $second, $third, $fourth, $fifth);
    return $y;
  }

  private function boardWithFours(Dice $first, Dice $second, Dice $third, Dice $fourth, Dice $fifth) {
    $y = new YahtzeeBoard();
    $y->scoreFours($first, $second, $third, $fourth, $fifth);
    return $y;
  }

  private function boardWithFives(Dice $first, Dice $second, Dice $third, Dice $fourth, Dice $fifth) {
    $y = new YahtzeeBoard();
    $y->scoreFives($first, $second, $third, $fourth, $fifth);
    return $y;
  }
  
  private function boardWithSixes(Dice $first, Dice $second, Dice $third, Dice $fourth, Dice $fifth) {
    $y = new YahtzeeBoard();
    $y->scoreSixes($first, $second, $third, $fourth, $fifth);
    return $y;
  }
}
