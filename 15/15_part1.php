<?php

require './15/functions.php';

$data = file_get_contents('./15/15.data');

$strings = extractHashData($data);

$total = 0;
foreach ($strings as $string) {
  $total += runHashAlogorithm($string);
}

echo 'Total: ' . $total . PHP_EOL;