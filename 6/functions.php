<?php

/**
 * Given some race data, extract the race numbers.
 *
 * @param string $string
 *   The race data.
 *
 * @return array
 *   The race data, an associated array of time and
 * distance.
 */
function extractRaceData($string): array {
  $raceData = [];

  $string = trim(str_replace(['Time:', 'Distance:'], ['', ''], $string));
  $parts = explode("\n", $string);

  $parts[0] = array_values(array_filter(explode(' ', $parts[0])));
  $parts[1] = array_values(array_filter(explode(' ', $parts[1])));

  foreach ($parts[0] as $id => $part) {
    $raceData[] = [
      (int) $parts[0][$id],
      (int) $parts[1][$id],
    ];
  }

  return $raceData;
}

/**
 * Calculate the number of winning races.
 *
 * @param int $time
 *   The race time.
 * @param int $distance
 *   The distance.
 *
 * @return int
 *   The number of winning races.
 */
function calculateWinningRaces($time, $distance):int {
  $wins = 0;

  // Start from 1 as we know 0 will be a loss.
  for ($i = 1; $i < $time; $i++) {
    $travelledDistance = ($time - $i) * $i;
    if ($travelledDistance > $distance) {
      $wins++;
    }
  }

  return $wins;

}