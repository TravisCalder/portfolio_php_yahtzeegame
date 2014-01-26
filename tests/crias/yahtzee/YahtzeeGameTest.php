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
    $this->assertEquals([1 => 0], $y->playerScores());
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


  private function assertValidRoll($roll) {
    $this->assertGreaterThanOrEqual(1, $roll);
    $this->assertLessThanOrEqual(6, $roll);
  }

}