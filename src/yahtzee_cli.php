<?php
require('ioHelpers.php');
require('autoload.php');
use crias\yahtzee\YahtzeeGame;

outPrintln("Welcome to a sample Yahtzee game.");
outPrintln("");
outPrintln("This is a command line game.");
outPrintln("It will present choices and ask you to enter the number of your choice.");
outPrintln("Please make sure the appropriate player makes the selection.");
outPrintln("");

outPrintln("Select how many players will play. (Between 1 and 6)");
$game = new YahtzeeGame(readChoice(1, 6));

outPrintln(bold("\nWelcome to the game. There are " . $game->numberOfPlayers() . " players."));


while(sizeof($game->currentPlayerScoringOptions()) > 0) {
  nextTurn($game);
}

outPrintln(bold("Game Over"));
outPrintln("Scores:");
outPrintln((string) $game);

/** Functions **/

function nextTurn($game) {
  $held = [1 => false, 2 => false, 3 => false, 4 => false, 5 => false];
  
  outPrintln("");
  outPrintln(bold("Ok player " . $game->currentPlayer() . ", it's your turn."));
  outPrintln($game->playerScoreSheet($game->currentPlayer()));

  outPrintln("");
  outPrint("Press enter for your first roll...");
  readLine();
  
  do {
    outPrintln("");
    outPrintln("Rolling.");
    $rollOrScore = roll($game, $held);
  } while($rollOrScore == 'roll');
  
  score($game);
  $game->endTurn();

  return;
}

function roll(YahtzeeGame $game, array &$held) {
  $toHold = array_keys($held, true);
  $dice = $game->roll($toHold);
  if($game->rollsRemaining() > 0) {
    return chooseHeldRollOrScore($game, $held, $dice);
  } else {
    return 'score';
  }
}

function score(YahtzeeGame $game) {
  $scoringOptions = $game->currentPlayerScoringOptions();
  outPrintln("");
  outPrintln("Here's your roll: " . implode(" ", $game->currentDice()));
  array_push($scoringOptions, "CheckScore");
  $choice = presentChoices("Select a field to score", $scoringOptions);
  
  if($choice == sizeof($scoringOptions)) {
    outPrintln("\n" . $game->playerScoreSheet($game->currentPlayer()));
    return score($game);    
  } else {
    $game->scoreCurrentDice($scoringOptions[$choice - 1]);
    return;
  }
}

function chooseHeldRollOrScore(YahtzeeGame $game, array &$held, array $dice) {
  outPrintln("");
  outPrintln("Here's your roll: " . implode(" ", $dice));
  $choice = presentChoices("What would you like to do?", [
      toggleHeldText(1, $held[1], $dice[1]),
      toggleHeldText(2, $held[2], $dice[2]),
      toggleHeldText(3, $held[3], $dice[3]),
      toggleHeldText(4, $held[4], $dice[4]),
      toggleHeldText(5, $held[5], $dice[5]),
      "Check Score",
      "Score",
      "Roll"
    ]);
    
  if($choice == 1) {
    $held[1] = !$held[1];
  } else if($choice == 2) {
    $held[2] = !$held[2];
  } else if($choice == 3) {
    $held[3] = !$held[3];
  } else if($choice == 4) {
    $held[4] = !$held[4];
  } else if($choice == 5) {
    $held[5] = !$held[5];
  } else if($choice == 6) {
    outPrintln("\n" . $game->playerScoreSheet($game->currentPlayer()));
  } else if($choice == 7) {
    return "score";    
  } else if($choice == 8) {
    return "roll";
  }
  return chooseHeldRollOrScore($game, $held, $dice);
}

function toggleHeldText($position, $bool, $value) {
  if($bool)
    return "Holding $value - Roll it?";
  else
    return "Rolling $value - Hold it?";
}