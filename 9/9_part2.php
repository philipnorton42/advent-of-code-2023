<?php

require './9/functions.php';

$data = file_get_contents('./9/9.data');

$data = extractSensorData($data);

$total = 0;

foreach ($data as $datum) {
  $total += calculatePreviousNumber($datum);
}

echo 'Total: ' . $total . PHP_EOL;
