<?php

require './4/functions.php';

$values = file('./4/4.data');

$games = [];

foreach ($values as $id => $value) {
  $value = trim($value);
  $games[] = extractNumbers($value);
}

$total = calculateCardInstances($games, $games);

echo 'Total: ' . $total . PHP_EOL;