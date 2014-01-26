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

// fscanf(STDIN, "%d\n", $number);
outPrintLn(bold("\nWelcome to the game. There are " . $game->numberOfPlayers() . ""));
nextTurn($game);

function nextTurn($game) {
  outPrintLn("");
  outPrintln(bold("Ok player " . $game->currentPlayer() . ", it's your turn."));

  // Roll 1
  outPrintln("");
  outPrint("Press enter for your first roll...");
  readLine();
  //$dice = $game->roll([]);
  
  return;
}