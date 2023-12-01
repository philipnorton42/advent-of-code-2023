<?php

require 'functions.php';

$total = 0;

$values = file('1.data');

foreach ($values as $value) {
  $value = trim($value);
  $number = findCalibrationNumber($value);
  $total = $total + $number;
}

echo 'Total: ' . $total . PHP_EOL;
