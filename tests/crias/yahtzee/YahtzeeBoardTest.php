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
    $this->assertEquals(0, $this->newScoreSheet('scoreOnes', dice(2), dice(3), dice(4), dice(5), dice(6))->totalScore());
    $this->assertEquals(1, $this->newScoreSheet('scoreOnes', dice(1), dice(3), dice(4), dice(5), dice(6))->totalScore());
    $this->assertEquals(2, $this->newScoreSheet('scoreOnes', dice(1), dice(1), dice(4), dice(5), dice(6))->totalScore());
    $this->assertEquals(3, $this->newScoreSheet('scoreOnes', dice(1), dice(1), dice(1), dice(5), dice(6))->totalScore());
    $this->assertEquals(4, $this->newScoreSheet('scoreOnes', dice(1), dice(1), dice(1), dice(1), dice(6))->totalScore());
    $this->assertEquals(5, $this->newScoreSheet('scoreOnes', dice(1), dice(1), dice(1), dice(1), dice(1))->totalScore());
  }
  
  public function testOnes_positionOfTheDiceDoesntMatter() {
    $this->assertEquals(1, $this->newScoreSheet('scoreOnes', dice(1), dice(2), dice(2), dice(2), dice(2))->totalScore());
    $this->assertEquals(1, $this->newScoreSheet('scoreOnes', dice(2), dice(1), dice(2), dice(2), dice(2))->totalScore());
    $this->assertEquals(1, $this->newScoreSheet('scoreOnes', dice(2), dice(2), dice(1), dice(2), dice(2))->totalScore());
    $this->assertEquals(1, $this->newScoreSheet('scoreOnes', dice(2), dice(2), dice(2), dice(1), dice(2))->totalScore());
    $this->assertEquals(1, $this->newScoreSheet('scoreOnes', dice(2), dice(2), dice(2), dice(2), dice(1))->totalScore());
  }

  public function testOnes_cannotModifyOnesAfterTheyAreScored() {
    $y = $this->newScoreSheet('scoreOnes', dice(1), dice(2), dice(1), dice(3), dice(1));
    $this->assertEquals(3, $y->totalScore());

    $y->scoreOnes(dice(1), dice(1), dice(1), dice(1), dice(1)); // Should this throw?
    $this->assertEquals(3, $y->totalScore());

    $y->scoreOnes(dice(2), dice(3), dice(4), dice(5), dice(6)); // Should this throw?
    $this->assertEquals(3, $y->totalScore());
  }

  /* Twos */

  public function testTwos_totalScoreShouldReturnScoreEqualToTotalNumberOfTwos_whenScoringTwos() {
    $this->assertEquals(0, $this->newScoreSheet('scoreTwos', dice(1), dice(3), dice(4), dice(5), dice(6))->totalScore());
    $this->assertEquals(2, $this->newScoreSheet('scoreTwos', dice(2), dice(3), dice(4), dice(5), dice(6))->totalScore());
    $this->assertEquals(4, $this->newScoreSheet('scoreTwos', dice(2), dice(2), dice(4), dice(5), dice(6))->totalScore());
    $this->assertEquals(6, $this->newScoreSheet('scoreTwos', dice(2), dice(2), dice(2), dice(5), dice(6))->totalScore());
    $this->assertEquals(8, $this->newScoreSheet('scoreTwos', dice(2), dice(2), dice(2), dice(2), dice(6))->totalScore());
    $this->assertEquals(10, $this->newScoreSheet('scoreTwos', dice(2), dice(2), dice(2), dice(2), dice(2))->totalScore());
  }
  
  public function testTwos_positionOfTheDiceDoesntMatter() {
    $this->assertEquals(2, $this->newScoreSheet('scoreTwos', dice(2), dice(1), dice(1), dice(1), dice(1))->totalScore());
    $this->assertEquals(2, $this->newScoreSheet('scoreTwos', dice(1), dice(2), dice(1), dice(1), dice(1))->totalScore());
    $this->assertEquals(2, $this->newScoreSheet('scoreTwos', dice(1), dice(1), dice(2), dice(1), dice(1))->totalScore());
    $this->assertEquals(2, $this->newScoreSheet('scoreTwos', dice(1), dice(1), dice(1), dice(2), dice(1))->totalScore());
    $this->assertEquals(2, $this->newScoreSheet('scoreTwos', dice(1), dice(1), dice(1), dice(1), dice(2))->totalScore());
  }

  public function testTwos_cannotModifyTwosAfterTheyAreScored() {
    $y = $this->newScoreSheet('scoreTwos', dice(2), dice(1), dice(2), dice(3), dice(2));
    $this->assertEquals(6, $y->totalScore());

    $y->scoreTwos(dice(2), dice(2), dice(2), dice(2), dice(2)); // Should this throw?
    $this->assertEquals(6, $y->totalScore());

    $y->scoreTwos(dice(1), dice(3), dice(4), dice(5), dice(6)); // Should this throw?
    $this->assertEquals(6, $y->totalScore());
  }

  /* Threes */

  public function testThrees_totalScoreShouldReturnScoreEqualToTotalNumberOfThrees_whenScoringThrees() {
    $this->assertEquals(0, $this->newScoreSheet('scoreThrees', dice(1), dice(2), dice(4), dice(5), dice(6))->totalScore());
    $this->assertEquals(3, $this->newScoreSheet('scoreThrees', dice(3), dice(2), dice(4), dice(5), dice(6))->totalScore());
    $this->assertEquals(6, $this->newScoreSheet('scoreThrees', dice(3), dice(3), dice(4), dice(5), dice(6))->totalScore());
    $this->assertEquals(9, $this->newScoreSheet('scoreThrees', dice(3), dice(3), dice(3), dice(5), dice(6))->totalScore());
    $this->assertEquals(12, $this->newScoreSheet('scoreThrees', dice(3), dice(3), dice(3), dice(3), dice(6))->totalScore());
    $this->assertEquals(15, $this->newScoreSheet('scoreThrees', dice(3), dice(3), dice(3), dice(3), dice(3))->totalScore());
  }
  
  public function testThrees_positionOfTheDiceDoesntMatter() {
    $this->assertEquals(3, $this->newScoreSheet('scoreThrees', dice(3), dice(1), dice(1), dice(1), dice(1))->totalScore());
    $this->assertEquals(3, $this->newScoreSheet('scoreThrees', dice(1), dice(3), dice(1), dice(1), dice(1))->totalScore());
    $this->assertEquals(3, $this->newScoreSheet('scoreThrees', dice(1), dice(1), dice(3), dice(1), dice(1))->totalScore());
    $this->assertEquals(3, $this->newScoreSheet('scoreThrees', dice(1), dice(1), dice(1), dice(3), dice(1))->totalScore());
    $this->assertEquals(3, $this->newScoreSheet('scoreThrees', dice(1), dice(1), dice(1), dice(1), dice(3))->totalScore());
  }

  public function testThrees_cannotModifyThreesAfterTheyAreScored() {
    $y = $this->newScoreSheet('scoreThrees', dice(3), dice(1), dice(3), dice(2), dice(3));
    $this->assertEquals(9, $y->totalScore());

    $y->scoreThrees(dice(3), dice(3), dice(3), dice(3), dice(3)); // Should this throw?
    $this->assertEquals(9, $y->totalScore());

    $y->scoreThrees(dice(1), dice(2), dice(4), dice(5), dice(6)); // Should this throw?
    $this->assertEquals(9, $y->totalScore());
  }
  
  /* Fours */

  public function testFours_totalScoreShouldReturnScoreEqualToTotalNumberOfFours_whenScoringFours() {
    $this->assertEquals(0, $this->newScoreSheet('scoreFours', dice(1), dice(2), dice(3), dice(5), dice(6))->totalScore());
    $this->assertEquals(4, $this->newScoreSheet('scoreFours', dice(4), dice(2), dice(3), dice(5), dice(6))->totalScore());
    $this->assertEquals(8, $this->newScoreSheet('scoreFours', dice(4), dice(4), dice(3), dice(5), dice(6))->totalScore());
    $this->assertEquals(12, $this->newScoreSheet('scoreFours', dice(4), dice(4), dice(4), dice(5), dice(6))->totalScore());
    $this->assertEquals(16, $this->newScoreSheet('scoreFours', dice(4), dice(4), dice(4), dice(4), dice(6))->totalScore());
    $this->assertEquals(20, $this->newScoreSheet('scoreFours', dice(4), dice(4), dice(4), dice(4), dice(4))->totalScore());
  }
  
  public function testFours_positionOfTheDiceDoesntMatter() {
    $this->assertEquals(4, $this->newScoreSheet('scoreFours', dice(4), dice(1), dice(1), dice(1), dice(1))->totalScore());
    $this->assertEquals(4, $this->newScoreSheet('scoreFours', dice(1), dice(4), dice(1), dice(1), dice(1))->totalScore());
    $this->assertEquals(4, $this->newScoreSheet('scoreFours', dice(1), dice(1), dice(4), dice(1), dice(1))->totalScore());
    $this->assertEquals(4, $this->newScoreSheet('scoreFours', dice(1), dice(1), dice(1), dice(4), dice(1))->totalScore());
    $this->assertEquals(4, $this->newScoreSheet('scoreFours', dice(1), dice(1), dice(1), dice(1), dice(4))->totalScore());
  }

  public function testFours_cannotModifyFoursAfterTheyAreScored() {
    $y = $this->newScoreSheet('scoreFours', dice(4), dice(1), dice(4), dice(2), dice(4));
    $this->assertEquals(12, $y->totalScore());

    $y->scoreFours(dice(4), dice(4), dice(4), dice(4), dice(4)); // Should this throw?
    $this->assertEquals(12, $y->totalScore());

    $y->scoreFours(dice(1), dice(2), dice(3), dice(5), dice(6)); // Should this throw?
    $this->assertEquals(12, $y->totalScore());
  }  

  /* Fives */

  public function testFives_totalScoreShouldReturnScoreEqualToTotalNumberOfFives_whenScoringFives() {
    $this->assertEquals(0, $this->newScoreSheet('scoreFives', dice(1), dice(2), dice(3), dice(4), dice(6))->totalScore());
    $this->assertEquals(5, $this->newScoreSheet('scoreFives', dice(5), dice(2), dice(3), dice(4), dice(6))->totalScore());
    $this->assertEquals(10, $this->newScoreSheet('scoreFives', dice(5), dice(5), dice(3), dice(4), dice(6))->totalScore());
    $this->assertEquals(15, $this->newScoreSheet('scoreFives', dice(5), dice(5), dice(5), dice(4), dice(6))->totalScore());
    $this->assertEquals(20, $this->newScoreSheet('scoreFives', dice(5), dice(5), dice(5), dice(5), dice(6))->totalScore());
    $this->assertEquals(25, $this->newScoreSheet('scoreFives', dice(5), dice(5), dice(5), dice(5), dice(5))->totalScore());
  }
  
  public function testFives_positionOfTheDiceDoesntMatter() {
    $this->assertEquals(5, $this->newScoreSheet('scoreFives', dice(5), dice(1), dice(1), dice(1), dice(1))->totalScore());
    $this->assertEquals(5, $this->newScoreSheet('scoreFives', dice(1), dice(5), dice(1), dice(1), dice(1))->totalScore());
    $this->assertEquals(5, $this->newScoreSheet('scoreFives', dice(1), dice(1), dice(5), dice(1), dice(1))->totalScore());
    $this->assertEquals(5, $this->newScoreSheet('scoreFives', dice(1), dice(1), dice(1), dice(5), dice(1))->totalScore());
    $this->assertEquals(5, $this->newScoreSheet('scoreFives', dice(1), dice(1), dice(1), dice(1), dice(5))->totalScore());
  }

  public function testFives_cannotModifyFivesAfterTheyAreScored() {
    $y = $this->newScoreSheet('scoreFives', dice(5), dice(1), dice(5), dice(2), dice(5));
    $this->assertEquals(15, $y->totalScore());

    $y->scoreFives(dice(5), dice(5), dice(5), dice(5), dice(5)); // Should this throw?
    $this->assertEquals(15, $y->totalScore());

    $y->scoreFives(dice(1), dice(2), dice(3), dice(4), dice(6)); // Should this throw?
    $this->assertEquals(15, $y->totalScore());
  }  

  /* Sixes */

  public function testSixes_totalScoreShouldReturnScoreEqualToTotalNumberOfSixes_whenScoringSixes() {
    $this->assertEquals(0, $this->newScoreSheet('scoreSixes', dice(1), dice(2), dice(3), dice(4), dice(5))->totalScore());
    $this->assertEquals(6, $this->newScoreSheet('scoreSixes', dice(6), dice(2), dice(3), dice(4), dice(5))->totalScore());
    $this->assertEquals(12, $this->newScoreSheet('scoreSixes', dice(6), dice(6), dice(3), dice(4), dice(5))->totalScore());
    $this->assertEquals(18, $this->newScoreSheet('scoreSixes', dice(6), dice(6), dice(6), dice(4), dice(5))->totalScore());
    $this->assertEquals(24, $this->newScoreSheet('scoreSixes', dice(6), dice(6), dice(6), dice(6), dice(5))->totalScore());
    $this->assertEquals(30, $this->newScoreSheet('scoreSixes', dice(6), dice(6), dice(6), dice(6), dice(6))->totalScore());
  }
  
  public function testSixes_positionOfTheDiceDoesntMatter() {
    $this->assertEquals(6, $this->newScoreSheet('scoreSixes', dice(6), dice(1), dice(1), dice(1), dice(1))->totalScore());
    $this->assertEquals(6, $this->newScoreSheet('scoreSixes', dice(1), dice(6), dice(1), dice(1), dice(1))->totalScore());
    $this->assertEquals(6, $this->newScoreSheet('scoreSixes', dice(1), dice(1), dice(6), dice(1), dice(1))->totalScore());
    $this->assertEquals(6, $this->newScoreSheet('scoreSixes', dice(1), dice(1), dice(1), dice(6), dice(1))->totalScore());
    $this->assertEquals(6, $this->newScoreSheet('scoreSixes', dice(1), dice(1), dice(1), dice(1), dice(6))->totalScore());
  }

  public function testSixes_cannotModifySixesAfterTheyAreScored() {
    $y = $this->newScoreSheet('scoreSixes', dice(6), dice(1), dice(6), dice(2), dice(6));
    $this->assertEquals(18, $y->totalScore());

    $y->scoreSixes(dice(6), dice(6), dice(6), dice(6), dice(6)); // Should this throw?
    $this->assertEquals(18, $y->totalScore());

    $y->scoreSixes(dice(1), dice(2), dice(3), dice(4), dice(5)); // Should this throw?
    $this->assertEquals(18, $y->totalScore());
  }  
  
  /* Upper Board */
  
  public function testUpperBoard_shouldReturnSumOfAllUpperBoardValues_withNoBonus_whenTotalLessThan63() {
    $y = new YahtzeeBoard();
    
    $y->scoreOnes(dice(1), dice(1), dice(6), dice(6), dice(6));
    $y->scoreTwos(dice(2), dice(2), dice(2), dice(6), dice(6));
    $y->scoreThrees(dice(3), dice(3), dice(3), dice(6), dice(6));
    $y->scoreFours(dice(4), dice(4), dice(4), dice(6), dice(6));
    $y->scoreFives(dice(5), dice(5), dice(5), dice(6), dice(6));
    $y->scoreSixes(dice(6), dice(6), dice(6), dice(1), dice(1));
    
    $this->assertEquals(62, $y->totalScore());
    $this->assertEquals(62, $y->upperScore());
    $this->assertEquals(0, $y->bonus());
  }
  
  public function testUpperBoard_shouldIncludeBonus_whenTotalEqualTo63() {
    $y = new YahtzeeBoard();
    
    $y->scoreOnes(dice(1), dice(1), dice(1), dice(6), dice(6));
    $y->scoreTwos(dice(2), dice(2), dice(2), dice(6), dice(6));
    $y->scoreThrees(dice(3), dice(3), dice(3), dice(6), dice(6));
    $y->scoreFours(dice(4), dice(4), dice(4), dice(6), dice(6));
    $y->scoreFives(dice(5), dice(5), dice(5), dice(6), dice(6));
    $y->scoreSixes(dice(6), dice(6), dice(6), dice(1), dice(1));
    
    $this->assertEquals(98, $y->totalScore());
    $this->assertEquals(63, $y->upperScore());
    $this->assertEquals(35, $y->bonus());
  }

  public function testUpperBoard_shouldIncludeBonus_whenTotalGreaterThan63() {
    $y = new YahtzeeBoard();
    
    $y->scoreOnes(dice(1), dice(1), dice(1), dice(1), dice(6));
    $y->scoreTwos(dice(2), dice(2), dice(2), dice(6), dice(6));
    $y->scoreThrees(dice(3), dice(3), dice(3), dice(6), dice(6));
    $y->scoreFours(dice(4), dice(4), dice(4), dice(6), dice(6));
    $y->scoreFives(dice(5), dice(5), dice(5), dice(6), dice(6));
    $y->scoreSixes(dice(6), dice(6), dice(6), dice(1), dice(1));
    
    $this->assertEquals(99, $y->totalScore());
    $this->assertEquals(64, $y->upperScore());
    $this->assertEquals(35, $y->bonus());
  }

  /* Three of a Kind */

  public function testThreeOfAKind_shouldBeZero_whenLessThanThreeOfAnyValue() {
    $this->assertEquals(0, $this->newScoreSheet('scoreThreeOfAKind', dice(1), dice(2), dice(3), dice(4), dice(5))->totalScore());
    $this->assertEquals(0, $this->newScoreSheet('scoreThreeOfAKind', dice(1), dice(1), dice(2), dice(6), dice(6))->totalScore());
    $this->assertEquals(0, $this->newScoreSheet('scoreThreeOfAKind', dice(2), dice(2), dice(1), dice(6), dice(6))->totalScore());
    $this->assertEquals(0, $this->newScoreSheet('scoreThreeOfAKind', dice(3), dice(3), dice(1), dice(6), dice(6))->totalScore());
    $this->assertEquals(0, $this->newScoreSheet('scoreThreeOfAKind', dice(4), dice(4), dice(1), dice(6), dice(6))->totalScore());
    $this->assertEquals(0, $this->newScoreSheet('scoreThreeOfAKind', dice(5), dice(5), dice(1), dice(6), dice(6))->totalScore());
    $this->assertEquals(0, $this->newScoreSheet('scoreThreeOfAKind', dice(6), dice(6), dice(2), dice(1), dice(1))->totalScore());
  }

  public function testThreeOfAKind_shouldTotalDice_whenThreeOfAnyValue() {
    $this->assertEquals(15, $this->newScoreSheet('scoreThreeOfAKind', dice(1), dice(1), dice(1), dice(6), dice(6))->totalScore());
    $this->assertEquals(18, $this->newScoreSheet('scoreThreeOfAKind', dice(2), dice(2), dice(2), dice(6), dice(6))->totalScore());
    $this->assertEquals(21, $this->newScoreSheet('scoreThreeOfAKind', dice(3), dice(3), dice(3), dice(6), dice(6))->totalScore());
    $this->assertEquals(24, $this->newScoreSheet('scoreThreeOfAKind', dice(4), dice(4), dice(4), dice(6), dice(6))->totalScore());
    $this->assertEquals(27, $this->newScoreSheet('scoreThreeOfAKind', dice(5), dice(5), dice(5), dice(6), dice(6))->totalScore());
    $this->assertEquals(20, $this->newScoreSheet('scoreThreeOfAKind', dice(6), dice(6), dice(6), dice(1), dice(1))->totalScore());
  }

  public function testThreeOfAKind_shouldTotalDice_whenFourOfAnyValue() {
    $this->assertEquals(10, $this->newScoreSheet('scoreThreeOfAKind', dice(1), dice(1), dice(1), dice(1), dice(6))->totalScore());
    $this->assertEquals(14, $this->newScoreSheet('scoreThreeOfAKind', dice(2), dice(2), dice(2), dice(2), dice(6))->totalScore());
    $this->assertEquals(18, $this->newScoreSheet('scoreThreeOfAKind', dice(3), dice(3), dice(3), dice(3), dice(6))->totalScore());
    $this->assertEquals(22, $this->newScoreSheet('scoreThreeOfAKind', dice(4), dice(4), dice(4), dice(4), dice(6))->totalScore());
    $this->assertEquals(26, $this->newScoreSheet('scoreThreeOfAKind', dice(5), dice(5), dice(5), dice(5), dice(6))->totalScore());
    $this->assertEquals(25, $this->newScoreSheet('scoreThreeOfAKind', dice(6), dice(6), dice(6), dice(6), dice(1))->totalScore());
  }

  public function testThreeOfAKind_shouldTotalDice_whenFiveOfAnyValue() {
    $this->assertEquals(5, $this->newScoreSheet('scoreThreeOfAKind', dice(1), dice(1), dice(1), dice(1), dice(1))->totalScore());
    $this->assertEquals(10, $this->newScoreSheet('scoreThreeOfAKind', dice(2), dice(2), dice(2), dice(2), dice(2))->totalScore());
    $this->assertEquals(15, $this->newScoreSheet('scoreThreeOfAKind', dice(3), dice(3), dice(3), dice(3), dice(3))->totalScore());
    $this->assertEquals(20, $this->newScoreSheet('scoreThreeOfAKind', dice(4), dice(4), dice(4), dice(4), dice(4))->totalScore());
    $this->assertEquals(25, $this->newScoreSheet('scoreThreeOfAKind', dice(5), dice(5), dice(5), dice(5), dice(5))->totalScore());
    $this->assertEquals(30, $this->newScoreSheet('scoreThreeOfAKind', dice(6), dice(6), dice(6), dice(6), dice(6))->totalScore());
  }

  public function testThreeOfAKind_orderOrGroupingDoesntMatter() {
    $this->assertEquals(7, $this->newScoreSheet('scoreThreeOfAKind', dice(1), dice(1), dice(1), dice(2), dice(2))->totalScore());
    $this->assertEquals(7, $this->newScoreSheet('scoreThreeOfAKind', dice(1), dice(1), dice(2), dice(1), dice(2))->totalScore());
    $this->assertEquals(7, $this->newScoreSheet('scoreThreeOfAKind', dice(1), dice(1), dice(2), dice(2), dice(1))->totalScore());
    $this->assertEquals(7, $this->newScoreSheet('scoreThreeOfAKind', dice(1), dice(2), dice(1), dice(1), dice(2))->totalScore());
    $this->assertEquals(7, $this->newScoreSheet('scoreThreeOfAKind', dice(1), dice(2), dice(1), dice(2), dice(1))->totalScore());
    $this->assertEquals(7, $this->newScoreSheet('scoreThreeOfAKind', dice(1), dice(2), dice(2), dice(1), dice(1))->totalScore());
    $this->assertEquals(7, $this->newScoreSheet('scoreThreeOfAKind', dice(2), dice(1), dice(1), dice(1), dice(2))->totalScore());
    $this->assertEquals(7, $this->newScoreSheet('scoreThreeOfAKind', dice(2), dice(1), dice(1), dice(1), dice(2))->totalScore());
    $this->assertEquals(7, $this->newScoreSheet('scoreThreeOfAKind', dice(2), dice(1), dice(1), dice(2), dice(1))->totalScore());
    $this->assertEquals(7, $this->newScoreSheet('scoreThreeOfAKind', dice(2), dice(1), dice(2), dice(1), dice(1))->totalScore());
    $this->assertEquals(7, $this->newScoreSheet('scoreThreeOfAKind', dice(2), dice(2), dice(1), dice(1), dice(1))->totalScore());
  }

  public function testThreeOfAKind_cannotModifyValueAfterSet() {
    $y = $this->newScoreSheet('scoreThreeOfAKind', dice(6), dice(1), dice(6), dice(2), dice(6));
    $this->assertEquals(21, $y->totalScore());

    $y->scoreThreeOfAKind(dice(6), dice(6), dice(6), dice(6), dice(6)); // Should this throw?
    $this->assertEquals(21, $y->totalScore());

    $y->scoreThreeOfAKind(dice(1), dice(2), dice(3), dice(4), dice(5)); // Should this throw?
    $this->assertEquals(21, $y->totalScore());
  }  

  /* Four of a Kind */
  
  public function testFourOfAKind_shouldBeZero_whenLessThanThreeOfAnyValue() {
    $this->assertEquals(0, $this->newScoreSheet('scoreFourOfAKind', dice(1), dice(2), dice(3), dice(4), dice(5))->totalScore());
    $this->assertEquals(0, $this->newScoreSheet('scoreFourOfAKind', dice(1), dice(1), dice(2), dice(6), dice(6))->totalScore());
    $this->assertEquals(0, $this->newScoreSheet('scoreFourOfAKind', dice(2), dice(2), dice(1), dice(6), dice(6))->totalScore());
    $this->assertEquals(0, $this->newScoreSheet('scoreFourOfAKind', dice(3), dice(3), dice(1), dice(6), dice(6))->totalScore());
    $this->assertEquals(0, $this->newScoreSheet('scoreFourOfAKind', dice(4), dice(4), dice(1), dice(6), dice(6))->totalScore());
    $this->assertEquals(0, $this->newScoreSheet('scoreFourOfAKind', dice(5), dice(5), dice(1), dice(6), dice(6))->totalScore());
    $this->assertEquals(0, $this->newScoreSheet('scoreFourOfAKind', dice(6), dice(6), dice(2), dice(1), dice(1))->totalScore());
  }

  public function testFourOfAKind_shouldBeZero_whenThreeOfAnyValue() {
    $this->assertEquals(0, $this->newScoreSheet('scoreFourOfAKind', dice(1), dice(1), dice(1), dice(6), dice(6))->totalScore());
    $this->assertEquals(0, $this->newScoreSheet('scoreFourOfAKind', dice(2), dice(2), dice(2), dice(6), dice(6))->totalScore());
    $this->assertEquals(0, $this->newScoreSheet('scoreFourOfAKind', dice(3), dice(3), dice(3), dice(6), dice(6))->totalScore());
    $this->assertEquals(0, $this->newScoreSheet('scoreFourOfAKind', dice(4), dice(4), dice(4), dice(6), dice(6))->totalScore());
    $this->assertEquals(0, $this->newScoreSheet('scoreFourOfAKind', dice(5), dice(5), dice(5), dice(6), dice(6))->totalScore());
    $this->assertEquals(0, $this->newScoreSheet('scoreFourOfAKind', dice(6), dice(6), dice(6), dice(1), dice(1))->totalScore());
  }

  public function testFourOfAKind_shouldTotalDice_whenFourOfAnyValue() {
    $this->assertEquals(10, $this->newScoreSheet('scoreFourOfAKind', dice(1), dice(1), dice(1), dice(1), dice(6))->totalScore());
    $this->assertEquals(14, $this->newScoreSheet('scoreFourOfAKind', dice(2), dice(2), dice(2), dice(2), dice(6))->totalScore());
    $this->assertEquals(18, $this->newScoreSheet('scoreFourOfAKind', dice(3), dice(3), dice(3), dice(3), dice(6))->totalScore());
    $this->assertEquals(22, $this->newScoreSheet('scoreFourOfAKind', dice(4), dice(4), dice(4), dice(4), dice(6))->totalScore());
    $this->assertEquals(26, $this->newScoreSheet('scoreFourOfAKind', dice(5), dice(5), dice(5), dice(5), dice(6))->totalScore());
    $this->assertEquals(25, $this->newScoreSheet('scoreFourOfAKind', dice(6), dice(6), dice(6), dice(6), dice(1))->totalScore());
  }

  public function testFourOfAKind_shouldTotalDice_whenFiveOfAnyValue() {
    $this->assertEquals(5, $this->newScoreSheet('scoreFourOfAKind', dice(1), dice(1), dice(1), dice(1), dice(1))->totalScore());
    $this->assertEquals(10, $this->newScoreSheet('scoreFourOfAKind', dice(2), dice(2), dice(2), dice(2), dice(2))->totalScore());
    $this->assertEquals(15, $this->newScoreSheet('scoreFourOfAKind', dice(3), dice(3), dice(3), dice(3), dice(3))->totalScore());
    $this->assertEquals(20, $this->newScoreSheet('scoreFourOfAKind', dice(4), dice(4), dice(4), dice(4), dice(4))->totalScore());
    $this->assertEquals(25, $this->newScoreSheet('scoreFourOfAKind', dice(5), dice(5), dice(5), dice(5), dice(5))->totalScore());
    $this->assertEquals(30, $this->newScoreSheet('scoreFourOfAKind', dice(6), dice(6), dice(6), dice(6), dice(6))->totalScore());
  }

  public function testFourOfAKind_orderOrGroupingDoesntMatter() {
    $this->assertEquals(6, $this->newScoreSheet('scoreFourOfAKind', dice(1), dice(1), dice(1), dice(1), dice(2))->totalScore());
    $this->assertEquals(6, $this->newScoreSheet('scoreFourOfAKind', dice(1), dice(1), dice(1), dice(2), dice(1))->totalScore());
    $this->assertEquals(6, $this->newScoreSheet('scoreFourOfAKind', dice(1), dice(1), dice(2), dice(1), dice(1))->totalScore());
    $this->assertEquals(6, $this->newScoreSheet('scoreFourOfAKind', dice(1), dice(2), dice(1), dice(1), dice(1))->totalScore());
    $this->assertEquals(6, $this->newScoreSheet('scoreFourOfAKind', dice(2), dice(1), dice(1), dice(1), dice(1))->totalScore());
  }

  public function testFourOfAKind_cannotModifyValueAfterSet() {
    $y = $this->newScoreSheet('scoreFourOfAKind', dice(6), dice(1), dice(6), dice(6), dice(6));
    $this->assertEquals(25, $y->totalScore());

    $y->scoreFourOfAKind(dice(6), dice(6), dice(6), dice(6), dice(6)); // Should this throw?
    $this->assertEquals(25, $y->totalScore());

    $y->scoreFourOfAKind(dice(1), dice(2), dice(3), dice(4), dice(5)); // Should this throw?
    $this->assertEquals(25, $y->totalScore());
  }  

  /* Full House */
  
  public function testFullHouse_shouldReturn25_whenThereAreNotExactlyThreeOfOneValueAndTwoOfAnother() {
    $this->assertEquals(0, $this->newScoreSheet('scoreFullHouse', dice(1), dice(2), dice(3), dice(4), dice(5))->totalScore());
    $this->assertEquals(0, $this->newScoreSheet('scoreFullHouse', dice(1), dice(2), dice(3), dice(5), dice(5))->totalScore());
    $this->assertEquals(0, $this->newScoreSheet('scoreFullHouse', dice(1), dice(2), dice(5), dice(5), dice(5))->totalScore());
    $this->assertEquals(0, $this->newScoreSheet('scoreFullHouse', dice(1), dice(5), dice(5), dice(5), dice(5))->totalScore());
    $this->assertEquals(0, $this->newScoreSheet('scoreFullHouse', dice(1), dice(1), dice(3), dice(4), dice(5))->totalScore());
    $this->assertEquals(0, $this->newScoreSheet('scoreFullHouse', dice(1), dice(1), dice(3), dice(5), dice(5))->totalScore());
    $this->assertEquals(0, $this->newScoreSheet('scoreFullHouse', dice(1), dice(1), dice(1), dice(4), dice(5))->totalScore());
    $this->assertEquals(0, $this->newScoreSheet('scoreFullHouse', dice(1), dice(1), dice(1), dice(1), dice(5))->totalScore());
  }
  
  public function testFullHouse_shouldReturn25_whenThereAreThreeOfOneValueAndTwoOfAnother() {
    $this->assertEquals(25, $this->newScoreSheet('scoreFullHouse', dice(1), dice(1), dice(1), dice(2), dice(2))->totalScore());
    $this->assertEquals(25, $this->newScoreSheet('scoreFullHouse', dice(1), dice(1), dice(1), dice(3), dice(3))->totalScore());
    $this->assertEquals(25, $this->newScoreSheet('scoreFullHouse', dice(1), dice(1), dice(1), dice(4), dice(4))->totalScore());
    $this->assertEquals(25, $this->newScoreSheet('scoreFullHouse', dice(1), dice(1), dice(1), dice(5), dice(5))->totalScore());
    $this->assertEquals(25, $this->newScoreSheet('scoreFullHouse', dice(1), dice(1), dice(1), dice(6), dice(6))->totalScore());
    
    $this->assertEquals(25, $this->newScoreSheet('scoreFullHouse', dice(2), dice(2), dice(2), dice(1), dice(1))->totalScore());
    $this->assertEquals(25, $this->newScoreSheet('scoreFullHouse', dice(2), dice(2), dice(2), dice(3), dice(3))->totalScore());
    $this->assertEquals(25, $this->newScoreSheet('scoreFullHouse', dice(2), dice(2), dice(2), dice(4), dice(4))->totalScore());
    $this->assertEquals(25, $this->newScoreSheet('scoreFullHouse', dice(2), dice(2), dice(2), dice(5), dice(5))->totalScore());
    $this->assertEquals(25, $this->newScoreSheet('scoreFullHouse', dice(2), dice(2), dice(2), dice(6), dice(6))->totalScore());

    $this->assertEquals(25, $this->newScoreSheet('scoreFullHouse', dice(3), dice(3), dice(3), dice(2), dice(2))->totalScore());
    $this->assertEquals(25, $this->newScoreSheet('scoreFullHouse', dice(3), dice(3), dice(3), dice(1), dice(1))->totalScore());
    $this->assertEquals(25, $this->newScoreSheet('scoreFullHouse', dice(3), dice(3), dice(3), dice(4), dice(4))->totalScore());
    $this->assertEquals(25, $this->newScoreSheet('scoreFullHouse', dice(3), dice(3), dice(3), dice(5), dice(5))->totalScore());
    $this->assertEquals(25, $this->newScoreSheet('scoreFullHouse', dice(3), dice(3), dice(3), dice(6), dice(6))->totalScore());

    $this->assertEquals(25, $this->newScoreSheet('scoreFullHouse', dice(4), dice(4), dice(4), dice(2), dice(2))->totalScore());
    $this->assertEquals(25, $this->newScoreSheet('scoreFullHouse', dice(4), dice(4), dice(4), dice(3), dice(3))->totalScore());
    $this->assertEquals(25, $this->newScoreSheet('scoreFullHouse', dice(4), dice(4), dice(4), dice(1), dice(1))->totalScore());
    $this->assertEquals(25, $this->newScoreSheet('scoreFullHouse', dice(4), dice(4), dice(4), dice(5), dice(5))->totalScore());
    $this->assertEquals(25, $this->newScoreSheet('scoreFullHouse', dice(4), dice(4), dice(4), dice(6), dice(6))->totalScore());
    
    $this->assertEquals(25, $this->newScoreSheet('scoreFullHouse', dice(5), dice(5), dice(5), dice(2), dice(2))->totalScore());
    $this->assertEquals(25, $this->newScoreSheet('scoreFullHouse', dice(5), dice(5), dice(5), dice(3), dice(3))->totalScore());
    $this->assertEquals(25, $this->newScoreSheet('scoreFullHouse', dice(5), dice(5), dice(5), dice(4), dice(4))->totalScore());
    $this->assertEquals(25, $this->newScoreSheet('scoreFullHouse', dice(5), dice(5), dice(5), dice(1), dice(1))->totalScore());
    $this->assertEquals(25, $this->newScoreSheet('scoreFullHouse', dice(5), dice(5), dice(5), dice(6), dice(6))->totalScore());
    
    $this->assertEquals(25, $this->newScoreSheet('scoreFullHouse', dice(6), dice(6), dice(6), dice(2), dice(2))->totalScore());
    $this->assertEquals(25, $this->newScoreSheet('scoreFullHouse', dice(6), dice(6), dice(6), dice(3), dice(3))->totalScore());
    $this->assertEquals(25, $this->newScoreSheet('scoreFullHouse', dice(6), dice(6), dice(6), dice(4), dice(4))->totalScore());
    $this->assertEquals(25, $this->newScoreSheet('scoreFullHouse', dice(6), dice(6), dice(6), dice(5), dice(5))->totalScore());
    $this->assertEquals(25, $this->newScoreSheet('scoreFullHouse', dice(6), dice(6), dice(6), dice(1), dice(1))->totalScore());
  }

  public function testFullHouse_groupingDoesntMatter() {
    $this->assertEquals(25, $this->newScoreSheet('scoreFullHouse', dice(6), dice(6), dice(6), dice(2), dice(2))->totalScore());
    $this->assertEquals(25, $this->newScoreSheet('scoreFullHouse', dice(6), dice(6), dice(2), dice(6), dice(2))->totalScore());
    $this->assertEquals(25, $this->newScoreSheet('scoreFullHouse', dice(6), dice(6), dice(2), dice(2), dice(6))->totalScore());
    $this->assertEquals(25, $this->newScoreSheet('scoreFullHouse', dice(6), dice(2), dice(6), dice(6), dice(2))->totalScore());
    $this->assertEquals(25, $this->newScoreSheet('scoreFullHouse', dice(6), dice(2), dice(6), dice(2), dice(6))->totalScore());
    $this->assertEquals(25, $this->newScoreSheet('scoreFullHouse', dice(6), dice(2), dice(2), dice(6), dice(6))->totalScore());
    $this->assertEquals(25, $this->newScoreSheet('scoreFullHouse', dice(2), dice(6), dice(6), dice(6), dice(2))->totalScore());
    $this->assertEquals(25, $this->newScoreSheet('scoreFullHouse', dice(2), dice(6), dice(6), dice(2), dice(6))->totalScore());
    $this->assertEquals(25, $this->newScoreSheet('scoreFullHouse', dice(2), dice(6), dice(2), dice(6), dice(6))->totalScore());
    $this->assertEquals(25, $this->newScoreSheet('scoreFullHouse', dice(2), dice(2), dice(6), dice(6), dice(6))->totalScore());
  }

  public function testFullHouse_cannotModifyValueAfterSet() {
    $y1 = $this->newScoreSheet('scoreFullHouse', dice(6), dice(1), dice(6), dice(1), dice(6));
    $this->assertEquals(25, $y1->totalScore());

    $y1->scoreFullHouse(dice(1), dice(2), dice(3), dice(4), dice(5)); // Should this throw?
    $this->assertEquals(25, $y1->totalScore());

    $y2 = $this->newScoreSheet('scoreFullHouse', dice(1), dice(2), dice(3), dice(4), dice(5));
    $this->assertEquals(0, $y2->totalScore());

    $y2->scoreFullHouse(dice(6), dice(1), dice(6), dice(1), dice(6)); // Should this throw?
    $this->assertEquals(0, $y2->totalScore());
  }  
  
  /* Small Straight */

  public function testSmallStraight_shouldReturn0_whenThereAreNotFourNumbersInSequence() {
    $this->assertEquals(0, $this->newScoreSheet('scoreSmallStraight', dice(1), dice(2), dice(3), dice(1), dice(1))->totalScore());
    $this->assertEquals(0, $this->newScoreSheet('scoreSmallStraight', dice(1), dice(2), dice(4), dice(5), dice(6))->totalScore());
    $this->assertEquals(0, $this->newScoreSheet('scoreSmallStraight', dice(1), dice(2), dice(3), dice(5), dice(6))->totalScore());
    $this->assertEquals(0, $this->newScoreSheet('scoreSmallStraight', dice(1), dice(1), dice(1), dice(1), dice(1))->totalScore());
  }
  
  public function testSmallStraight_shouldReturn30_whenThereAreFourNumbersInSequence() {
    $this->assertEquals(30, $this->newScoreSheet('scoreSmallStraight', dice(1), dice(2), dice(3), dice(4), dice(1))->totalScore());
    $this->assertEquals(30, $this->newScoreSheet('scoreSmallStraight', dice(1), dice(2), dice(3), dice(4), dice(2))->totalScore());
    $this->assertEquals(30, $this->newScoreSheet('scoreSmallStraight', dice(1), dice(2), dice(3), dice(4), dice(3))->totalScore());
    $this->assertEquals(30, $this->newScoreSheet('scoreSmallStraight', dice(1), dice(2), dice(3), dice(4), dice(4))->totalScore());
    $this->assertEquals(30, $this->newScoreSheet('scoreSmallStraight', dice(1), dice(2), dice(3), dice(4), dice(5))->totalScore());
    $this->assertEquals(30, $this->newScoreSheet('scoreSmallStraight', dice(1), dice(2), dice(3), dice(4), dice(6))->totalScore());
    
    $this->assertEquals(30, $this->newScoreSheet('scoreSmallStraight', dice(2), dice(3), dice(4), dice(5), dice(1))->totalScore());
    $this->assertEquals(30, $this->newScoreSheet('scoreSmallStraight', dice(2), dice(3), dice(4), dice(5), dice(2))->totalScore());
    $this->assertEquals(30, $this->newScoreSheet('scoreSmallStraight', dice(2), dice(3), dice(4), dice(5), dice(3))->totalScore());
    $this->assertEquals(30, $this->newScoreSheet('scoreSmallStraight', dice(2), dice(3), dice(4), dice(5), dice(4))->totalScore());
    $this->assertEquals(30, $this->newScoreSheet('scoreSmallStraight', dice(2), dice(3), dice(4), dice(5), dice(5))->totalScore());
    $this->assertEquals(30, $this->newScoreSheet('scoreSmallStraight', dice(2), dice(3), dice(4), dice(5), dice(6))->totalScore());

    $this->assertEquals(30, $this->newScoreSheet('scoreSmallStraight', dice(3), dice(4), dice(5), dice(6), dice(1))->totalScore());
    $this->assertEquals(30, $this->newScoreSheet('scoreSmallStraight', dice(3), dice(4), dice(5), dice(6), dice(2))->totalScore());
    $this->assertEquals(30, $this->newScoreSheet('scoreSmallStraight', dice(3), dice(4), dice(5), dice(6), dice(3))->totalScore());
    $this->assertEquals(30, $this->newScoreSheet('scoreSmallStraight', dice(3), dice(4), dice(5), dice(6), dice(4))->totalScore());
    $this->assertEquals(30, $this->newScoreSheet('scoreSmallStraight', dice(3), dice(4), dice(5), dice(6), dice(5))->totalScore());
    $this->assertEquals(30, $this->newScoreSheet('scoreSmallStraight', dice(3), dice(4), dice(5), dice(6), dice(6))->totalScore());
  }

  public function testSmallStraight_orderDoesntMatter() {
    $this->assertEquals(30, $this->newScoreSheet('scoreSmallStraight', dice(1), dice(2), dice(3), dice(4), dice(6))->totalScore());
    $this->assertEquals(30, $this->newScoreSheet('scoreSmallStraight', dice(1), dice(2), dice(4), dice(3), dice(6))->totalScore());
    $this->assertEquals(30, $this->newScoreSheet('scoreSmallStraight', dice(1), dice(4), dice(3), dice(2), dice(6))->totalScore());
    $this->assertEquals(30, $this->newScoreSheet('scoreSmallStraight', dice(1), dice(4), dice(2), dice(3), dice(6))->totalScore());
    $this->assertEquals(30, $this->newScoreSheet('scoreSmallStraight', dice(4), dice(3), dice(2), dice(1), dice(6))->totalScore());
    
    $this->assertEquals(30, $this->newScoreSheet('scoreSmallStraight', dice(6), dice(1), dice(2), dice(3), dice(4))->totalScore());
    $this->assertEquals(30, $this->newScoreSheet('scoreSmallStraight', dice(6), dice(1), dice(2), dice(4), dice(3))->totalScore());
    $this->assertEquals(30, $this->newScoreSheet('scoreSmallStraight', dice(6), dice(1), dice(4), dice(3), dice(2))->totalScore());
    $this->assertEquals(30, $this->newScoreSheet('scoreSmallStraight', dice(6), dice(1), dice(4), dice(2), dice(3))->totalScore());
    $this->assertEquals(30, $this->newScoreSheet('scoreSmallStraight', dice(6), dice(4), dice(3), dice(2), dice(1))->totalScore());

    $this->assertEquals(30, $this->newScoreSheet('scoreSmallStraight', dice(1), dice(2), dice(3), dice(4), dice(6))->totalScore());
    $this->assertEquals(30, $this->newScoreSheet('scoreSmallStraight', dice(1), dice(2), dice(3), dice(6), dice(4))->totalScore());
    $this->assertEquals(30, $this->newScoreSheet('scoreSmallStraight', dice(1), dice(2), dice(6), dice(3), dice(4))->totalScore());
    $this->assertEquals(30, $this->newScoreSheet('scoreSmallStraight', dice(1), dice(6), dice(2), dice(3), dice(4))->totalScore());
    $this->assertEquals(30, $this->newScoreSheet('scoreSmallStraight', dice(6), dice(1), dice(2), dice(3), dice(4))->totalScore());
  }
  
  public function testSmallStraight_cannotModifyValueAfterSet() {
    $y1 = $this->newScoreSheet('scoreSmallStraight', dice(6), dice(1), dice(2), dice(3), dice(4));
    $this->assertEquals(30, $y1->totalScore());

    $y1->scoreSmallStraight(dice(1), dice(1), dice(1), dice(1), dice(1)); // Should this throw?
    $this->assertEquals(30, $y1->totalScore());

    $y2 = $this->newScoreSheet('scoreSmallStraight', dice(1), dice(1), dice(1), dice(1), dice(1));
    $this->assertEquals(0, $y2->totalScore());

    $y2->scoreSmallStraight(dice(6), dice(1), dice(2), dice(3), dice(4)); // Should this throw?
    $this->assertEquals(0, $y2->totalScore());
  }  

  /* Large Straight */

  public function testLargeStraight_shouldReturn0_whenThereAreNotFiveNumbersInSequence() {
    $this->assertEquals(0, $this->newScoreSheet('scoreLargeStraight', dice(1), dice(2), dice(3), dice(1), dice(1))->totalScore());
    $this->assertEquals(0, $this->newScoreSheet('scoreLargeStraight', dice(1), dice(2), dice(4), dice(5), dice(6))->totalScore());
    $this->assertEquals(0, $this->newScoreSheet('scoreLargeStraight', dice(1), dice(2), dice(3), dice(5), dice(6))->totalScore());
    $this->assertEquals(0, $this->newScoreSheet('scoreLargeStraight', dice(1), dice(1), dice(1), dice(1), dice(1))->totalScore());
    $this->assertEquals(0, $this->newScoreSheet('scoreLargeStraight', dice(1), dice(2), dice(3), dice(4), dice(1))->totalScore());
  }
  
  public function testLargeStraight_shouldReturn40_whenThereAreFiveNumbersInSequence() {
    $this->assertEquals(40, $this->newScoreSheet('scoreLargeStraight', dice(1), dice(2), dice(3), dice(4), dice(5))->totalScore());
    $this->assertEquals(40, $this->newScoreSheet('scoreLargeStraight', dice(2), dice(3), dice(4), dice(5), dice(6))->totalScore());
  }

  public function testLargeStraight_orderDoesntMatter() {
    $this->assertEquals(40, $this->newScoreSheet('scoreLargeStraight', dice(1), dice(2), dice(3), dice(4), dice(5))->totalScore());
    $this->assertEquals(40, $this->newScoreSheet('scoreLargeStraight', dice(1), dice(2), dice(3), dice(5), dice(4))->totalScore());
    $this->assertEquals(40, $this->newScoreSheet('scoreLargeStraight', dice(1), dice(2), dice(5), dice(4), dice(3))->totalScore());
    $this->assertEquals(40, $this->newScoreSheet('scoreLargeStraight', dice(1), dice(5), dice(3), dice(4), dice(2))->totalScore());
    $this->assertEquals(40, $this->newScoreSheet('scoreLargeStraight', dice(5), dice(2), dice(3), dice(4), dice(1))->totalScore());

    $this->assertEquals(40, $this->newScoreSheet('scoreLargeStraight', dice(5), dice(4), dice(3), dice(2), dice(1))->totalScore());
    $this->assertEquals(40, $this->newScoreSheet('scoreLargeStraight', dice(4), dice(5), dice(3), dice(2), dice(1))->totalScore());
    $this->assertEquals(40, $this->newScoreSheet('scoreLargeStraight', dice(3), dice(4), dice(5), dice(2), dice(1))->totalScore());
    $this->assertEquals(40, $this->newScoreSheet('scoreLargeStraight', dice(2), dice(4), dice(3), dice(5), dice(1))->totalScore());
    $this->assertEquals(40, $this->newScoreSheet('scoreLargeStraight', dice(1), dice(4), dice(3), dice(2), dice(5))->totalScore());
  }
  
  public function testLargeStraight_cannotModifyValueAfterSet() {
    $y1 = $this->newScoreSheet('scoreLargeStraight', dice(5), dice(1), dice(2), dice(3), dice(4));
    $this->assertEquals(40, $y1->totalScore());

    $y1->scoreLargeStraight(dice(1), dice(1), dice(1), dice(1), dice(1)); // Should this throw?
    $this->assertEquals(40, $y1->totalScore());

    $y2 = $this->newScoreSheet('scoreLargeStraight', dice(1), dice(1), dice(1), dice(1), dice(1));
    $this->assertEquals(0, $y2->totalScore());

    $y2->scoreLargeStraight(dice(5), dice(1), dice(2), dice(3), dice(4)); // Should this throw?
    $this->assertEquals(0, $y2->totalScore());
  }  

  /* YAHTZEE! */

  public function testYahtzee_shouldReturn0_thereAreFewerThanFiveOfAKind() {
    $this->assertEquals(0, $this->newScoreSheet('scoreYahtzee', dice(1), dice(2), dice(3), dice(1), dice(1))->totalScore());
    $this->assertEquals(0, $this->newScoreSheet('scoreYahtzee', dice(1), dice(1), dice(1), dice(1), dice(6))->totalScore());
    $this->assertEquals(0, $this->newScoreSheet('scoreYahtzee', dice(1), dice(2), dice(3), dice(5), dice(6))->totalScore());
    $this->assertEquals(0, $this->newScoreSheet('scoreYahtzee', dice(1), dice(2), dice(3), dice(4), dice(1))->totalScore());
  }
  
  public function testYahtzee_shouldReturn50_whenThereAreFiveNumbersInSequence() {
    $this->assertEquals(50, $this->newScoreSheet('scoreYahtzee', dice(1), dice(1), dice(1), dice(1), dice(1))->totalScore());
    $this->assertEquals(50, $this->newScoreSheet('scoreYahtzee', dice(2), dice(2), dice(2), dice(2), dice(2))->totalScore());
    $this->assertEquals(50, $this->newScoreSheet('scoreYahtzee', dice(3), dice(3), dice(3), dice(3), dice(3))->totalScore());
    $this->assertEquals(50, $this->newScoreSheet('scoreYahtzee', dice(4), dice(4), dice(4), dice(4), dice(4))->totalScore());
    $this->assertEquals(50, $this->newScoreSheet('scoreYahtzee', dice(5), dice(5), dice(5), dice(5), dice(5))->totalScore());
    $this->assertEquals(50, $this->newScoreSheet('scoreYahtzee', dice(6), dice(6), dice(6), dice(6), dice(6))->totalScore());
  }

  public function testYahtzee_cannotModifyValueAfterSet() {
    $y1 = $this->newScoreSheet('scoreYahtzee', dice(1), dice(1), dice(1), dice(1), dice(1));
    $this->assertEquals(50, $y1->totalScore());

    $y1->scoreYahtzee(dice(1), dice(2), dice(3), dice(4), dice(5)); // Should this throw?
    $this->assertEquals(50, $y1->totalScore());

    $y2 = $this->newScoreSheet('scoreYahtzee', dice(1), dice(2), dice(3), dice(4), dice(5));
    $this->assertEquals(0, $y2->totalScore());

    $y2->scoreYahtzee(dice(1), dice(1), dice(1), dice(1), dice(1)); // Should this throw?
    $this->assertEquals(0, $y2->totalScore());
  }  

  /* Chance */

  public function testChance_shouldReturnSumOfValues() {
    $this->assertEquals(8, $this->newScoreSheet('scoreChance', dice(1), dice(2), dice(3), dice(1), dice(1))->totalScore());
    $this->assertEquals(10, $this->newScoreSheet('scoreChance', dice(1), dice(1), dice(1), dice(1), dice(6))->totalScore());
    $this->assertEquals(17, $this->newScoreSheet('scoreChance', dice(1), dice(2), dice(3), dice(5), dice(6))->totalScore());
    $this->assertEquals(15, $this->newScoreSheet('scoreChance', dice(1), dice(2), dice(3), dice(4), dice(5))->totalScore());
  }

  public function testChance_cannotModifyValueAfterSet() {
    $y1 = $this->newScoreSheet('scoreChance', dice(1), dice(1), dice(1), dice(1), dice(1));
    $this->assertEquals(5, $y1->totalScore());

    $y1->scoreChance(dice(1), dice(2), dice(3), dice(4), dice(5)); // Should this throw?
    $this->assertEquals(5, $y1->totalScore());
  }  

  /* Helpers */
  
  private function newScoreSheet($scoreMethod, Dice $first, Dice $second, Dice $third, Dice $fourth, Dice $fifth) {
    $y = new YahtzeeBoard();
    $y->$scoreMethod($first, $second, $third, $fourth, $fifth);
    return $y;
  }
}
