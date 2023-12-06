<?php

require './5/functions.php';

$total = 0;

$data = file_get_contents('./5/5.data');

$data = extractSeedData($data);

echo 'SEED DATA EXTRACTED' . PHP_EOL;

$smallestValue = PHP_INT_MAX;

$seedRanges = array_chunk($data['seeds'], 2);

foreach ($seedRanges as $range) {
  $seedStart = (int) $range[0];
  $seedEnd = $seedStart + $range[1];
  echo number_format($seedStart) . ' to ' . number_format($seedEnd) . PHP_EOL;
  for ($j = $seedStart; $j <= $seedEnd; $j++) {
    $value = findLocationForSeed($data['maps'], $j);
    if ($value < $smallestValue) {
      $smallestValue = $value;
    }
  }
}


// This should only take 2-3 months to complete...
echo 'Smallest Value: ' . $smallestValue . PHP_EOL;