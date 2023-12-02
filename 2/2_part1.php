<?php

require './2/functions.php';

$total = 0;

$values = file('./2/2.data');

foreach ($values as $value) {
  $game = extractGameMax($value);
  if (isValidGame($game) === true) {
    $total = $total + $game['game_id'];
  }
}

echo 'Total: ' . $total . PHP_EOL;
