portfolio_php_yahtzeegame
=========================

This code was created as a part of my professional portfolio.

It comprises the core game code for a Yahtzee implementation, supporting multiple players and enforcing base game rules.

It comes with a basic command line interface that allows between 1 and 6 players to enjoy the game. It can also be plugged into frameworks (such as CakePHP or CodeIgniter) creating a clean seperation between the fully tested and portable business logic of the application, and the logic pertaining to presenting the game to a user over the web.

Continue on for information on:

1. Running Unit Tests
2. Running the CLI

Running Unit Tests
-------------------

The code has been tested with PHPUnit, and includes a `phpunit.xml` which correctly configures test runs.

1. If you do not already have it, install PHP Unit. See the phpunit documentation for more, or on Linux:
  * `sudo apt-get install phpunit`

2. In the base directory of the project, run PHPUnit:
  * `phpunit -c build/phpunit.xml`

Tests and test results will be printed to the screen.  
Code Coverage will be generated as HTML files.  
To view it, open `build/coverage/index.html`.

Running the CLI
----------------

This project includes a command-line interface that allows a fully-functional game to be played. It provides a good demonstration of the features and logic contained, as well as being just plain fun.

1. To begin a game, type `php src/yahtzee_cli.php` in the project base directory.
2. The game will provide appropriate prompts from here forward.
  1. First, select how many players (1-6) you want to play.
  2. Each turn, the player should press [Enter] to make their first roll.
  3. The player can select dice to holl or roll by following the prompts.
  4. The player may roll again (if they have rolls left) or choose to score early.
  5. When the player chooses to score, or runs out of rolls, the available fields will be presented.
  6. After the player selects a field to score play proceeds to the next player until the game is complete.
  7. At any time the current player can fiew their score sheet.
