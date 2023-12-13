<?php

require './11/functions.php';

$space = file_get_contents('./11/11.data');

$space = extractGalaxyData($space);

$space = expandSpace($space, 1000000);

$numberGalaxies = numberGalaxies($space);

$pairs = findPairs($numberGalaxies);

$length = 0;

foreach ($pairs as $pair) {
  $length += distance($numberGalaxies[$pair[0]], $numberGalaxies[$pair[1]]);
}

echo 'Total: ' . $length . PHP_EOL;

// 1
//Total: 9734203
// 10
//Total: 14854357
// 50
// Total: 37610597
// 100
//Total: 66055897
// 1000
//Total: 578071297