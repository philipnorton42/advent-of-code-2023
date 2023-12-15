<?php

/**
 * Extract the seed data.
 *
 * @param string $string
 *   The seed data.
 *
 * @return array|array[]
 *   The extracted seed data.
 */
function extractSeedData($string): array {
  $data = ['maps' => []];

  $currentMap = '';
  foreach(explode("\n", $string) as $line) {
    if (str_starts_with($line, 'seeds:')) {
      preg_match('/seeds: (.*)/', $line, $matches);
      $data['seeds'] = explode(' ', trim($matches[1]));
      continue;
    }

    if (preg_match('/(.*?) map:/', $line, $matches) === 1) {
      $currentMap = $matches[1];
      $data['maps'][$currentMap] = [];
      continue;
    }

    if ($line == '') {
      $currentMap = '';
      continue;
    }

    // If we get to this point then we must have a mapping sequence.
    preg_match('/(\d+) (\d+) (\d+)/', $line, $matches);

    $lower = (int) $matches[2];
    $upper = $lower + ((int) $matches[3]) - 1;

    $data['maps'][$currentMap][] = [
      'lower' => $lower,
      'upper' => $upper,
      'map_start' => (int) $matches[1],
    ];

  }

  return $data;
}

/**
 * Find location for seed.
 *
 * @param array $maps
 *   The maps.
 * @param int $seed
 *   The seed.
 *
 * @return int
 */
function findLocationForSeed(array $maps, int $seed): int {

  $sequence = [
    'seed',
    'soil',
    'fertilizer',
    'water',
    'light',
    'temperature',
    'humidity',
    'location',
  ];

  $value = $seed;

  for ($i = 0; $i < count($sequence) - 1; $i++) {
    foreach ($maps[$sequence[$i] . '-to-' . $sequence[$i + 1]] as $id => $map) {
      $upper = $maps[$sequence[$i] . '-to-' . $sequence[$i + 1]][$id]['upper'];
      $lower = $maps[$sequence[$i] . '-to-' . $sequence[$i + 1]][$id]['lower'];
      if ($lower <= $value && $upper >= $value) {
        $mapStart = $maps[$sequence[$i] . '-to-' . $sequence[$i + 1]][$id]['map_start'];
        $tmpVal = abs($lower - $value);
        $value = $mapStart + $tmpVal;
        // We have made our swap here, so don't allow any more swaps to happen for this map.
        break;
      }
    }
  }

  return $value;
}

function findLocationForSeedLowest(array $maps, int $seed): int {

  $sequence = [
    'seed',
    'soil',
    'fertilizer',
    'water',
    'light',
    'temperature',
    'humidity',
    'location',
  ];

  $value = $seed;

  if (!isset($maps[$sequence[0] . '-to-' . $sequence[1]][$seed]['lower'])) {
    return 0;
  }

  for ($i = 0; $i < count($sequence) - 1; $i++) {
    foreach ($maps[$sequence[$i] . '-to-' . $sequence[$i + 1]] as $id => $map) {
      $upper = $maps[$sequence[$i] . '-to-' . $sequence[$i + 1]][$id]['upper'];
      $lower = $maps[$sequence[$i] . '-to-' . $sequence[$i + 1]][$id]['lower'];
      if ($lower <= $value && $upper >= $value) {
        $mapStart = $maps[$sequence[$i] . '-to-' . $sequence[$i + 1]][$id]['map_start'];
        $tmpVal = abs($lower - $value);
        $value = $mapStart + $tmpVal;
        // We have made our swap here, so don't allow any more swaps to happen for this map.
        break;
      }
    }
  }

  return $value;
}
