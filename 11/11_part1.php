<?php

require './11/functions.php';

$space = file_get_contents('./11/11.data');

$space = extractGalaxyData($space);

$space = expandSpace($space);

$numberGalaxies = numberGalaxies($space);

$pairs = findPairs($numberGalaxies);

$length = 0;

foreach ($pairs as $pair) {
  $length += distance($numberGalaxies[$pair[0]], $numberGalaxies[$pair[1]]);
}

echo 'Total: ' . $length . PHP_EOL;
