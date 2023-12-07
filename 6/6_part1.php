<?php

require './6/functions.php';

$total = 0;

$data = file_get_contents('./6/6.data');

$data = extractRaceData($data);

$wins = [];

foreach ($data as $race) {
  $wins[] = calculateWinningRaces($race[0], $race[1]);
}

echo "Total: " . array_product($wins) . PHP_EOL;
