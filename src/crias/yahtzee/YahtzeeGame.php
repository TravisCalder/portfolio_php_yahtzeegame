<?php
namespace crias\yahtzee;
use Exception;
use crias\yahtzee\Dice;

class YahtzeeGame {
 
  private $_scoreSheets;
  private $_numberOfPlayers;
  private $_currentPlayer;
  private $_currentScoreSheet;
  private $_rollsRemaining;
  private $_scoredThisTurn;
  
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
    $this->_scoredThisTurn = false;
  }
  
  public function __toString() {
    $output = "";
    for($i = 1; $i <= $this->_numberOfPlayers; $i++) {
      $output = $output . $this->playerScoreSheet($i) . "\n";
    }
    return $output;
  }
  
  public function playerScoreSheet($playerNumber) {
    $output = "Player $playerNumber Scoresheet:\n";
    $output = $output . (string) $this->_scoreSheets[$playerNumber];
    return $output;
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

  public function currentDice() {
    return $this->_currentDice;
  }

  public function roll(array $diceToKeep) {
    $this->ensureNoDiceKeptOnFirstRoll($diceToKeep);
    $this->ensureKeptDiceAreLegal($diceToKeep);
    $this->ensureRollsRemaining();
    $this->ensureTurnNotAlreadyScored("Cannot roll after scoring.");
    
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
  
  public function scoreCurrentDice($field) {
    $this->ensureFieldIsNotAlreadyScored($field);
    $this->ensureTurnNotAlreadyScored("Cannot score twice in one turn.");
    
    $scoreMethod = 'score' . ucfirst($field);
    $values = $this->_currentDice;
    $this->_currentScoreSheet->$scoreMethod(
      new Dice($values[1]), 
      new Dice($values[2]), 
      new Dice($values[3]), 
      new Dice($values[4]), 
      new Dice($values[5]));
    
    $this->_scoredThisTurn = true;
  }
  
  public function currentPlayerScoringOptions() {
    $options = ['ones', 'twos', 'threes', 'fours', 'fives', 'sixes', 'threeOfAKind', 
      'fourOfAKind', 'fullHouse', 'smallStraight', 'largeStraight', 'yahtzee', 'chance'];
    
    $availableOptions = array_filter($options, function($field) {
      return !$this->_currentScoreSheet->isScored($field);
    });
    
    return array_values($availableOptions);
  }
  
  public function endTurn() {
    $this->ensureTurnIsScored();
    if($this->_currentPlayer == $this->_numberOfPlayers)
      $this->_currentPlayer = 1;
    else
      $this->_currentPlayer = $this->_currentPlayer + 1;
      
    $this->_currentScoreSheet = $this->_scoreSheets[$this->_currentPlayer];
    $this->_rollsRemaining = 3;
    $this->_currentDice = [];
    $this->_scoredThisTurn = false;
  }

  private function ensureTurnIsScored() {
    if(!$this->_scoredThisTurn)
      throw new Exception("This turn has not been scored yet. Please score before ending turn.");
  }

  private function ensureTurnNotAlreadyScored($message) {
    if($this->_scoredThisTurn)
      throw new Exception($message);
  }

  private function ensureFieldIsNotAlreadyScored($field) {
    if($this->_currentScoreSheet->isScored($field))
      throw new Exception("Cannot score in the $field field - it is already scored.");
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