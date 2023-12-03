<?php

require './3/functions.php';

$total = 0;

$data = file_get_contents('./3/3.data');

$data = extractData($data);
$numbers = extractGearRatioNumbers($data);
$total = array_sum($numbers);

echo 'Total: ' . $total . PHP_EOL;
