<?php
require('ioHelpers.php');
require('autoload.php');
use crias\yahtzee\YahtzeeGame;

outPrintLn("Welcome to a sample Yahtzee game.");
outPrintLn("");
outPrintLn("This is a command line game.");
outPrintLn("It will present choices and ask you to enter the number of your choice.");
outPrintLn("Please make sure the appropriate player makes the selection.");
outPrintLn("");

outPrintLn("Select how many players will play. (Between 1 and 6)");
$game = new YahtzeeGame(readChoice(1, 6));

outPrintLn(bold("\nWelcome to the game. There are " . $game->numberOfPlayers() . " players."));
nextTurn($game);

/** Functions **/

function nextTurn($game) {
  $held = [1 => false, 2 => false, 3 => false, 4 => false, 5 => false];
  
  outPrintLn("");
  outPrintln(bold("Ok player " . $game->currentPlayer() . ", it's your turn."));

  outPrintln("");
  outPrint("Press enter for your first roll...");
  readLine();
  
  do {
    outPrintLn("");
    outPrintLn("Rolling.");
    $rollOrScore = roll($game, $held);
  } while($rollOrScore == 'roll');
  
  //score($game);

  return;
}

function roll(YahtzeeGame $game, array &$held) {
  $toHold = array_keys($held, true);
  $dice = $game->roll($toHold);
  outPrintLn("Here's your roll: " . implode(" ", $dice));
  if($game->rollsRemaining() > 0) {
    return chooseHeldRollOrScore($held, $dice);
  } else {
    return 'score';
  }
}

function chooseHeldRollOrScore(array &$held, array $dice) {
  outPrintLn("");
  $choice = presentChoices("What would you like to do?", [
      toggleHeldText(1, $held[1], $dice[1]),
      toggleHeldText(2, $held[2], $dice[2]),
      toggleHeldText(3, $held[3], $dice[3]),
      toggleHeldText(4, $held[4], $dice[4]),
      toggleHeldText(5, $held[5], $dice[5]),
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
    return "score";    
  } else if($choice == 7) {
    return "roll";
  }
  return chooseHeldRollOrScore($held, $dice);
}

function toggleHeldText($position, $bool, $value) {
  if($bool)
    return "Holding $value - Roll it?";
  else
    return "Rolling $value - Hold it?";
}