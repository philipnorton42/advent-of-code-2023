<?php

require './1/functions.php';

$total = 0;

$values = file('./1/1.data');

foreach ($values as $id => $value) {
  $value = trim($value);
  $value = convertNumber($value);
  $number = findCalibrationNumber($value);
  $total = $total + $number;
}

echo 'Total: ' . $total . PHP_EOL;