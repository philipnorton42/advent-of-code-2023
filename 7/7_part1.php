<?php

require './7/functions.php';

$total = 0;

$data = file_get_contents('./7/7.data');

$games = extractGameData($data);

$games = sortGames($games);

$total = calculateTotal($games);

foreach ($games as $id => $game) {
 echo $id . ' ' . $game[0] . ' ' . $game[1] . PHP_EOL;
}

echo 'Total: ' . $total . PHP_EOL;