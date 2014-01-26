<?php

namespace crias\yahtzee;
use Exception;
use crias\testing\ExceptionTesting;
use PHPUnit_Framework_TestCase;

class YahtzeeGameTest extends PHPUnit_Framework_TestCase {
  use ExceptionTesting;

  public function testConstruct_gameInitializes() {
    $y = new YahtzeeGame(1);
    $this->assertEquals(1, $y->numberOfPlayers());
    $this->assertEquals(1, $y->currentPlayer());
    $this->assertEquals(3, $y->rollsRemaining());
  }
  
  public function testRoll_rollingMultipleTimesResultsInDifferentValues() {
    $limit = 100;
    $rolls = [];
    for($i = 0; $i < $limit; $i++) {
      $y = new YahtzeeGame(1);
      $rolledDice = $y->roll([]);
      $rolls[$rolledDice[1]] = true;
      $this->assertValidRoll($rolledDice[1]);
      
      if(sizeof($rolls) >= 3) return;
    }
    $this->fail("Rolled $limit times without finding at least 3 unique dice. Probably not random.");
  }
  
  public function testRoll_maintiansACountdownOfLegalRolls() {
    $y = new YahtzeeGame(1);
    
    $this->assertEquals(3, $y->rollsRemaining());
    $y->roll([]);
    $this->assertEquals(2, $y->rollsRemaining());
    $y->roll([]);
    $this->assertEquals(1, $y->rollsRemaining());
    $y->roll([]);
    $this->assertEquals(0, $y->rollsRemaining());
  }

  public function testRoll_whenRolledFourTimes_throwsException() {
    $y = new YahtzeeGame(1);
    
    $y->roll([]);
    $y->roll([]);
    $y->roll([]);
    $this->assertEquals(0, $y->rollsRemaining());
    $this->assertException(new Exception("No rolls remaining, cannot roll. Please score your dice."), function() use ($y) {
      $y->roll([]);
    });
  }
  
  public function testRoll_rollOne_withNoDiceKept_returnsFiveRolledDice() {
    $y = new YahtzeeGame(1);
    $rolledDice = $y->roll([]);
    
    $this->assertValidRoll($rolledDice[1]);
    $this->assertValidRoll($rolledDice[2]);
    $this->assertValidRoll($rolledDice[3]);
    $this->assertValidRoll($rolledDice[4]);
    $this->assertValidRoll($rolledDice[5]);
  }
  
  public function testRoll_rollOne_withDiceKept_throwsException() {
    $y = new YahtzeeGame(1);
    
    $this->assertException(new Exception("Cannot keep dice on your first roll."), function() use ($y) {
      $y->roll([4]);
    });
  }
  
  public function testRoll_rollTwo_withNoDiceKept_returnsFiveNewRolledDice() {
    $this->assertTrue(true); // Test needs at least one assertion :(
    $limit = 100;
    $foundDifferent = [];
    for($i = 0; $i < $limit; $i++) {
      $y = new YahtzeeGame(1);
      $rollOne = $y->roll([]);
      $rollTwo = $y->roll([]);

      if($rollOne[1] != $rollTwo[1]) $foundDifferent[1] = true;      
      if($rollOne[2] != $rollTwo[2]) $foundDifferent[2] = true;      
      if($rollOne[3] != $rollTwo[3]) $foundDifferent[3] = true;      
      if($rollOne[4] != $rollTwo[4]) $foundDifferent[4] = true;      
      if($rollOne[5] != $rollTwo[5]) $foundDifferent[5] = true;      

      if(sizeof($foundDifferent) == 5) return;
    }
    $this->fail("Rolled $limit and at least one of the dice never changed - check your random function.");
  }
  
  public function testRoll_withDiceKept_whenDiceKeptIsNotBetween1And5_throwsException() {
    $this->assertException(new Exception("Dice to keep was not a legal value. Must be between 1 and 5."), function() {
      $y = new YahtzeeGame(1);
      $y->roll([]);
      $y->roll([-1]);
    });

    $this->assertException(new Exception("Dice to keep was not a legal value. Must be between 1 and 5."), function() {
      $y = new YahtzeeGame(1);
      $y->roll([]);
      $y->roll([0]);
    });

    $this->assertException(new Exception("Dice to keep was not a legal value. Must be between 1 and 5."), function() {
      $y = new YahtzeeGame(1);
      $y->roll([]);
      $y->roll([6]);
    });

    $this->assertException(new Exception("Dice to keep was not a legal value. Must be between 1 and 5."), function() {
      $y = new YahtzeeGame(1);
      $y->roll([]);
      $y->roll([7]);
    });
  }

  public function testRoll_rollThree_withNoDiceKept_returnsFiveNewRolledDice() {
    $this->assertTrue(true); // Test needs at least one assertion :(
    $limit = 100;
    $foundDifferent = [];
    for($i = 0; $i < $limit; $i++) {
      $y = new YahtzeeGame(1);
      $y->roll([]);
      $rollTwo = $y->roll([]);
      $rollThree = $y->roll([]);

      if($rollThree[1] != $rollTwo[1]) $foundDifferent[1] = true;      
      if($rollThree[2] != $rollTwo[2]) $foundDifferent[2] = true;      
      if($rollThree[3] != $rollTwo[3]) $foundDifferent[3] = true;      
      if($rollThree[4] != $rollTwo[4]) $foundDifferent[4] = true;      
      if($rollThree[5] != $rollTwo[5]) $foundDifferent[5] = true;      

      if(sizeof($foundDifferent) == 5) return;
    }
    $this->fail("Rolled $limit and at least one of the dice never changed - check your random function.");
  }

  public function testRoll_rollThree_withDiceKept_returnsSameDieInThatPositionButTheOtherDiceAllChange() {
    $this->assertTrue(true); // Test needs at least one assertion :(
    $limit = 100;
    $minimumRolls = 15;
    $foundDifferent = [];
    for($i = 0; $i < $limit; $i++) {
      $y = new YahtzeeGame(1);
      $y->roll([]);
      $rollTwo = $y->roll([]);
      $rollThree = $y->roll([3,4]);

      if($rollThree[1] != $rollTwo[1]) $foundDifferent[1] = true;      
      if($rollThree[2] != $rollTwo[2]) $foundDifferent[2] = true;      
      if($rollThree[3] != $rollTwo[3]) $foundDifferent[3] = true;      
      if($rollThree[4] != $rollTwo[4]) $foundDifferent[4] = true;      
      if($rollThree[5] != $rollTwo[5]) $foundDifferent[5] = true;

      if($foundDifferent == [1 => true, 2 => true, 5 => true] && $minimumRolls >= 15) 
        return;
    }
    $this->assertEquals(false, $foundDifferent[3]);
    $this->assertEquals(false, $foundDifferent[4]);
  }
  
  public function testCurrentPlayerScoringOptions_shouldReturnAllOptions_whenNothingHasBeenScored() {
    $y = new YahtzeeGame(1);
    $this->assertContains('ones', $y->currentPlayerScoringOptions());
    $this->assertContains('twos', $y->currentPlayerScoringOptions());
    $this->assertContains('threes', $y->currentPlayerScoringOptions());
    $this->assertContains('fours', $y->currentPlayerScoringOptions());
    $this->assertContains('fives', $y->currentPlayerScoringOptions());
    $this->assertContains('sixes', $y->currentPlayerScoringOptions());
    $this->assertContains('threeOfAKind', $y->currentPlayerScoringOptions());
    $this->assertContains('fourOfAKind', $y->currentPlayerScoringOptions());
    $this->assertContains('fullHouse', $y->currentPlayerScoringOptions());
    $this->assertContains('smallStraight', $y->currentPlayerScoringOptions());
    $this->assertContains('largeStraight', $y->currentPlayerScoringOptions());
    $this->assertContains('yahtzee', $y->currentPlayerScoringOptions());
    $this->assertContains('chance', $y->currentPlayerScoringOptions());
  }

  public function testCurrentPlayerScoringOptions_shouldNotReturnOnes_whenTheyHaveBeenScored() {
    $y = new YahtzeeGame(1);
    $y->roll([]);
    
    $before = $y->currentPlayerScoringOptions();
    $y->scoreCurrentDice('ones');
    $after = $y->currentPlayerScoringOptions();
    $this->assertEquals(13, sizeof($before));
    $this->assertEquals(12, sizeof($after));
    $this->assertEquals(['ones'], array_values(array_diff($before, $after)));
  }

  public function testCurrentPlayerScoringOptions_shouldNotReturnTwos_whenTheyHaveBeenScored() {
    $y = new YahtzeeGame(1);
    $y->roll([]);
    
    $before = $y->currentPlayerScoringOptions();
    $y->scoreCurrentDice('twos');
    $after = $y->currentPlayerScoringOptions();
    $this->assertEquals(13, sizeof($before));
    $this->assertEquals(12, sizeof($after));
    $this->assertEquals(['twos'], array_values(array_diff($before, $after)));
  }

  public function testCurrentPlayerScoringOptions_shouldNotReturnThrees_whenTheyHaveBeenScored() {
    $y = new YahtzeeGame(1);
    $y->roll([]);
    
    $before = $y->currentPlayerScoringOptions();
    $y->scoreCurrentDice('threes');
    $after = $y->currentPlayerScoringOptions();
    $this->assertEquals(13, sizeof($before));
    $this->assertEquals(12, sizeof($after));
    $this->assertEquals(['threes'], array_values(array_diff($before, $after)));
  }

  public function testCurrentPlayerScoringOptions_shouldNotReturnFours_whenTheyHaveBeenScored() {
    $y = new YahtzeeGame(1);
    $y->roll([]);
    
    $before = $y->currentPlayerScoringOptions();
    $y->scoreCurrentDice('fours');
    $after = $y->currentPlayerScoringOptions();
    $this->assertEquals(13, sizeof($before));
    $this->assertEquals(12, sizeof($after));
    $this->assertEquals(['fours'], array_values(array_diff($before, $after)));
  }
  
  public function testCurrentPlayerScoringOptions_shouldNotReturnFives_whenTheyHaveBeenScored() {
    $y = new YahtzeeGame(1);
    $y->roll([]);
    
    $before = $y->currentPlayerScoringOptions();
    $y->scoreCurrentDice('fives');
    $after = $y->currentPlayerScoringOptions();
    $this->assertEquals(13, sizeof($before));
    $this->assertEquals(12, sizeof($after));
    $this->assertEquals(['fives'], array_values(array_diff($before, $after)));
  }

  public function testCurrentPlayerScoringOptions_shouldNotReturnSixes_whenTheyHaveBeenScored() {
    $y = new YahtzeeGame(1);
    $y->roll([]);
    
    $before = $y->currentPlayerScoringOptions();
    $y->scoreCurrentDice('sixes');
    $after = $y->currentPlayerScoringOptions();
    $this->assertEquals(13, sizeof($before));
    $this->assertEquals(12, sizeof($after));
    $this->assertEquals(['sixes'], array_values(array_diff($before, $after)));
  }

  public function testCurrentPlayerScoringOptions_shouldNotReturnThreeOfAKind_whenTheyHaveBeenScored() {
    $y = new YahtzeeGame(1);
    $y->roll([]);
    
    $before = $y->currentPlayerScoringOptions();
    $y->scoreCurrentDice('threeOfAKind');
    $after = $y->currentPlayerScoringOptions();
    $this->assertEquals(13, sizeof($before));
    $this->assertEquals(12, sizeof($after));
    $this->assertEquals(['threeOfAKind'], array_values(array_diff($before, $after)));
  }

  public function testCurrentPlayerScoringOptions_shouldNotReturnFourOfAKind_whenTheyHaveBeenScored() {
    $y = new YahtzeeGame(1);
    $y->roll([]);
    
    $before = $y->currentPlayerScoringOptions();
    $y->scoreCurrentDice('fourOfAKind');
    $after = $y->currentPlayerScoringOptions();
    $this->assertEquals(13, sizeof($before));
    $this->assertEquals(12, sizeof($after));
    $this->assertEquals(['fourOfAKind'], array_values(array_diff($before, $after)));
  }

  public function testCurrentPlayerScoringOptions_shouldNotReturnFullHouse_whenTheyHaveBeenScored() {
    $y = new YahtzeeGame(1);
    $y->roll([]);
    
    $before = $y->currentPlayerScoringOptions();
    $y->scoreCurrentDice('fullHouse');
    $after = $y->currentPlayerScoringOptions();
    $this->assertEquals(13, sizeof($before));
    $this->assertEquals(12, sizeof($after));
    $this->assertEquals(['fullHouse'], array_values(array_diff($before, $after)));
  }

  public function testCurrentPlayerScoringOptions_shouldNotReturnSmallStraight_whenTheyHaveBeenScored() {
    $y = new YahtzeeGame(1);
    $y->roll([]);
    
    $before = $y->currentPlayerScoringOptions();
    $y->scoreCurrentDice('smallStraight');
    $after = $y->currentPlayerScoringOptions();
    $this->assertEquals(13, sizeof($before));
    $this->assertEquals(12, sizeof($after));
    $this->assertEquals(['smallStraight'], array_values(array_diff($before, $after)));
  }

  public function testCurrentPlayerScoringOptions_shouldNotReturnLargeStraight_whenTheyHaveBeenScored() {
    $y = new YahtzeeGame(1);
    $y->roll([]);
    
    $before = $y->currentPlayerScoringOptions();
    $y->scoreCurrentDice('largeStraight');
    $after = $y->currentPlayerScoringOptions();
    $this->assertEquals(13, sizeof($before));
    $this->assertEquals(12, sizeof($after));
    $this->assertEquals(['largeStraight'], array_values(array_diff($before, $after)));
  }

  public function testCurrentPlayerScoringOptions_shouldNotReturnYahtzee_whenTheyHaveBeenScored() {
    $y = new YahtzeeGame(1);
    $y->roll([]);
    
    $before = $y->currentPlayerScoringOptions();
    $y->scoreCurrentDice('yahtzee');
    $after = $y->currentPlayerScoringOptions();
    $this->assertEquals(13, sizeof($before));
    $this->assertEquals(12, sizeof($after));
    $this->assertEquals(['yahtzee'], array_values(array_diff($before, $after)));
  }

  public function testCurrentPlayerScoringOptions_shouldNotReturnChance_whenTheyHaveBeenScored() {
    $y = new YahtzeeGame(1);
    $y->roll([]);
    
    $before = $y->currentPlayerScoringOptions();
    $y->scoreCurrentDice('chance');
    $after = $y->currentPlayerScoringOptions();
    $this->assertEquals(13, sizeof($before));
    $this->assertEquals(12, sizeof($after));
    $this->assertEquals(['chance'], array_values(array_diff($before, $after)));
  }

  public function testScoreCurrentDice_cannotScoreTwiceInOneTurn() {
    $y = new YahtzeeGame(1);
    $y->roll([]);
    
    $y->scoreCurrentDice('chance');
    $this->assertException(new Exception("Cannot score twice in one turn."), function() use ($y) {
      $y->scoreCurrentDice('ones');
    });
  }

  public function testScoreCurrentDice_aPlayerCannotScoreTheSameFieldTwice() {
    $y = new YahtzeeGame(1);

    $y->roll([]);
    $y->scoreCurrentDice('chance');
    $y->endTurn();
    
    $this->assertException(new Exception("Cannot score in the chance field - it is already scored."), function() use ($y) {
      $y->roll([]);
      $y->scoreCurrentDice('chance');
    });
  }

  public function testScoreCurrentDice_cannotRollAfterScoring() {
    $y = new YahtzeeGame(1);
    $y->roll([]);
    
    $y->scoreCurrentDice('chance');
    $this->assertException(new Exception("Cannot roll after scoring."), function() use ($y) {
      $y->roll([]);
    });
  }

  public function testEndTurn_whenTurnHasNotBeenScored_throwsException() {
    $y = new YahtzeeGame(1);
    $y->roll([]);
    
    $this->assertException(new Exception("This turn has not been scored yet. Please score before ending turn."), function() use ($y) {
      $y->endTurn();
    });
  }

  public function testEndTurn_movesToTheNextPlayer_whenMultiplePlayers() {
    $y = new YahtzeeGame(3);
    $this->assertEquals(1, $y->currentPlayer());
    $this->assertEquals([], $y->currentDice());

    $y->roll([]);
    $y->scoreCurrentDice('chance');
    $y->endTurn();
    $this->assertEquals(2, $y->currentPlayer());
    $this->assertEquals(3, $y->rollsRemaining());
    $this->assertEquals([], $y->currentDice());

    $y->roll([]);
    $y->scoreCurrentDice('chance');
    $y->endTurn();
    $this->assertEquals(3, $y->currentPlayer());
    $this->assertEquals(3, $y->rollsRemaining());
    $this->assertEquals([], $y->currentDice());

    $y->roll([]);
    $y->scoreCurrentDice('chance');
    $y->endTurn();
    $this->assertEquals(1, $y->currentPlayer());
    $this->assertEquals(3, $y->rollsRemaining());
    $this->assertEquals([], $y->currentDice());
  }
  
  public function testEndTurn_staysOnPlayerOne_andStartsTheNextTurn_whenOnlyOnePlayer() {
    $y = new YahtzeeGame(1);
    $this->assertEquals(1, $y->currentPlayer());
    $this->assertEquals([], $y->currentDice());

    $y->roll([]);
    $y->scoreCurrentDice('chance');
    $y->endTurn();
    $this->assertEquals(1, $y->currentPlayer());
    $this->assertEquals(3, $y->rollsRemaining());
    $this->assertEquals([], $y->currentDice());

    $y->roll([]);
    $y->scoreCurrentDice('fullHouse');
    $y->endTurn();
    $this->assertEquals(1, $y->currentPlayer());
    $this->assertEquals(3, $y->rollsRemaining());
    $this->assertEquals([], $y->currentDice());

    $y->roll([]);
    $y->scoreCurrentDice('yahtzee');
    $y->endTurn();
    $this->assertEquals(1, $y->currentPlayer());
    $this->assertEquals(3, $y->rollsRemaining());
    $this->assertEquals([], $y->currentDice());
  }

  /* __toString */
  
  public function testToString_shouldContainAtLeastAllPlayerScores() {
    $chanceScores = [];
    $y = new YahtzeeGame(6);

    for($i = 1; $i <= 6; $i++) {
      $chanceScores[$i] = array_sum($y->roll([]));
      $y->scoreCurrentDice('chance');
      $y->endTurn();
    }

    for($i = 1; $i <= 6; $i++) {
      $this->assertContains((string) $chanceScores[$i], (string) $y);
    }
  }

  public function testPlayerScoreSheet_shouldContainPlayerScore() {
    $chanceScores = [];
    $y = new YahtzeeGame(6);
    
    for($i = 1; $i <= 6; $i++) {
      $chanceScores[$i] = array_sum($y->roll([]));
      $y->scoreCurrentDice('chance');
      $y->endTurn();
    }

    for($i = 1; $i <= 6; $i++) {
      $this->assertContains((string) $chanceScores[$i], (string) $y->playerScoreSheet($i));
    }
  }

  public function testToString_shouldContainAtLeastAllPlayerScoreSheets() {
    $chanceScores = [];
    $y = new YahtzeeGame(6);
    
    for($i = 1; $i <= 6; $i++) {
      $chanceScores[$i] = array_sum($y->roll([]));
      $y->scoreCurrentDice('chance');
      $y->endTurn();
    }

    for($i = 1; $i <= 6; $i++) {
      $this->assertContains((string) $y->playerScoreSheet($i), (string) $y);
    }
  }

  private function assertValidRoll($roll) {
    $this->assertGreaterThanOrEqual(1, $roll);
    $this->assertLessThanOrEqual(6, $roll);
  }

}