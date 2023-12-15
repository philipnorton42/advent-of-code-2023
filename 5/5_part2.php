<?php

require './5/functions.php';

$total = 0;

$data = file_get_contents('./5/5.data');

$data = extractSeedData($data);

echo 'SEED DATA EXTRACTED' . PHP_EOL;

$smallestValue = PHP_INT_MAX;

$seedRanges = array_chunk($data['seeds'], 2);

$mappedSeedRanges = [];

foreach ($data['maps'] as $map => $values) {
  foreach ($values as $value) {
    $mappedSeedRanges[$map][$value['lower']] = [
        'lower' => $value['lower'],
        'upper' => $value['upper'],
        'map_start' => $value['map_start'],
    ];
  }
}

$data['maps'] = $mappedSeedRanges;

// Here, we just loop through the ranges and only match the lowest
// value in first range.
// This is still quite slow, only taking about an hour to complete.
// But it's better than the estimated month that it would have taken
// before.

foreach ($seedRanges as $range) {
  $seedStart = (int) $range[0];
  $seedEnd = $seedStart + $range[1];
  echo number_format($seedStart) . ' to ' . number_format($seedEnd) . PHP_EOL;
  for ($j = $seedStart; $j <= $seedEnd; $j++) {
    $value = findLocationForSeedLowest($data['maps'], $j);
    if ($value !== 0 && $value < $smallestValue) {
      $smallestValue = $value;
    }
  }
}

echo 'Smallest Value: ' . $smallestValue . PHP_EOL;