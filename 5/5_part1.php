<?php

require './5/functions.php';

$total = 0;

$data = file_get_contents('./5/5.data');

$data = extractSeedData($data);

echo 'SEED DATA EXTRACTED' . PHP_EOL;

$values = [];

foreach ($data['seeds'] as $seed) {
  $values[] = findLocationForSeed($data['maps'], $seed);
}

sort($values);

foreach ($values as $value) {
  echo $value . PHP_EOL;
}