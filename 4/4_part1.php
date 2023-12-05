<?php

require './4/functions.php';

$total = 0;

$values = file('./4/4.data');

foreach ($values as $value) {
  $value = trim($value);
  $gameData = extractNumbers($value);
  $score = calulateScore($gameData);
  $total = $total + $score;
}

echo 'Total: ' . $total . PHP_EOL;
