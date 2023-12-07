<?php

require './6/functions.php';

$total = 0;

$race = [
47986698,
400121310111540,
];

$wins = calculateWinningRaces($race[0], $race[1]);

echo "Total: " . $wins . PHP_EOL;
