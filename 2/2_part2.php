<?php

require './2/functions.php';

$total = 0;

$values = file('./2/2.data');

foreach ($values as $value) {
  $game = extractGameMax($value);
  $total = $total + calculateGamePower($game);
}

echo 'Total: ' . $total . PHP_EOL;
