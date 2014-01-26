<?php
if(!function_exists('readChoice')) {
  function readChoice($startRange, $endRange) {
    while(!isset($number)) {
      outPrint("Enter a number : [$startRange - $endRange] > ");
      $input = readLine();
      sscanf($input, "%d", $number);
  
      if(!isset($number)) {
        outPrintLn("\nYour input '$input' is not a number.");
      } else if($startRange > $number || $number > $endRange) {
        outPrintLn("\nYour choice $number is outside the choice range $startRange - $endRange.");
        unset($number);
      }
    }
  
    return $number;
  }
  
  function presentChoices(array $choices) {
    // One-indexed for player ease
    for($i = 0; $i < sizeof($choices); $i++) {
      $choiceCount = $i + 1;
      outPrintLn("\t${choiceCount}. " . $choices[$i]);
    }
    return readChoice(1, sizeof($choices));
  }
  
  function outPrint($str) {
    fwrite(STDOUT, $str);
  }
  
  function outPrintLn($str) {
    fwrite(STDOUT, $str . "\n");
  }
  
  function bold($str) {
    return "\033[1m" . $str . "\033[0m";
  }
}