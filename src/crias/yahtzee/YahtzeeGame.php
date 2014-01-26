<?php
namespace crias\yahtzee;
use Exception;

class YahtzeeGame {
 
  private $_scoreSheets;
  private $_numberOfPlayers;
  private $_currentPlayer;
  private $_currentScoreSheet;
  private $_rollsRemaining;
  
  private $_currentDice;
 
  public function __construct($numberOfPlayers) {
    $this->_scoreSheets = [];
    for($i = 1; $i <= $numberOfPlayers; $i++) {
      $this->_scoreSheets[$i] = new YahtzeeScoreSheet();
    }
    $this->_numberOfPlayers = $numberOfPlayers;
    $this->_currentPlayer = 1;
    $this->_currentScoreSheet = $this->_scoreSheets[1];
    $this->_rollsRemaining = 3;
    $this->_currentDice = [];
  }

  public function numberOfPlayers() {
    return $this->_numberOfPlayers;
  }

  public function currentPlayer() {
    return $this->_currentPlayer;
  }

  public function rollsRemaining() {
    return $this->_rollsRemaining;
  }

  public function playerScores() {
    $scores = [];
    for($i = 1; $i <= $this->_numberOfPlayers; $i++) {
      $scores[$i] = $this->_scoreSheets[$i]->totalScore();
    }
    return $scores;
  }
  
  public function roll(array $diceToKeep) {
    $this->ensureNoDiceKeptOnFirstRoll($diceToKeep);
    $this->ensureKeptDiceAreLegal($diceToKeep);
    $this->ensureRollsRemaining();
    
    $dice = [];
    for($i = 1; $i <= 5; $i++) {
      if(!in_array($i, $diceToKeep)) {
        $dice[$i] = rand(1, 6);
        $this->_currentDice[$i] = $dice[$i];
      } else {
        $dice[$i] = $this->_currentDice[$i];
      }
    }
    $this->_rollsRemaining = $this->_rollsRemaining - 1;
    return $dice;
  }
  
  private function ensureNoDiceKeptOnFirstRoll(array $diceToKeep) {
    if($this->_rollsRemaining == 3 && sizeof($diceToKeep) > 0)
      throw new Exception("Cannot keep dice on your first roll.");
  }

  private function ensureKeptDiceAreLegal(array $diceToKeep) {
    if(sizeof($diceToKeep) > 0 && (min($diceToKeep) < 1 || max($diceToKeep) > 5))
      throw new Exception("Dice to keep was not a legal value. Must be between 1 and 5.");
  }

  private function ensureRollsRemaining() {
    if($this->_rollsRemaining == 0)
      throw new Exception("No rolls remaining, cannot roll. Please score your dice.");
  }


}