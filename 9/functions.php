<?php

/**
 * Extract the sensor data.
 *
 * @param string $data
 *   The sensor data.
 *
 * @return array
 *   The extracted sensor data.
 */
function extractSensorData(string $data):array {
  $extractedData = [];

  $lines = explode(PHP_EOL, $data);

  foreach ($lines as $line) {
    preg_match_all('/-?\d+/i', $line, $matches);
    $numbers = [];
    foreach ($matches[0] as $number) {
      $numbers[] = (int) $number;
    }
    $extractedData[] = $numbers;
  }

  return $extractedData;
}

/**
 * Given a single array of data, create a difference pyramid.
 *
 * @param array $data
 *   The array of data.
 *
 * @return array[]
 *   The pyramid.
 */
function createPyramid(array $data): array {
  $levels = [
    $data
  ];

  $currentLevel = $data;

  // Calculate differences pyramid.
  while (count(array_filter($currentLevel)) !== 0) {
    $newLevel = [];
    for ($i = 0; $i < count($currentLevel) - 1; $i++) {
      $newLevel[] = $currentLevel[$i + 1] - $currentLevel[$i];
    }
    $currentLevel = $newLevel;
    $levels[] = $currentLevel;
  }

  return $levels;
}

/**
 * Calculate the next number in the sequence.
 *
 * @param array $data
 *   The sequence data.
 *
 * @return int
 *   The next number.
 */
function calculateNextNumber(array $data): int {
  $levels = createPyramid($data);

  for ($i = count($levels) - 2; $i >= 0; $i--) {
    $levels[$i][] = $levels[$i][count($levels[$i]) - 1] + $levels[$i + 1][count($levels[$i + 1]) - 1];
  }

  return $levels[0][count($levels[0]) - 1];
}

/**
 * Calculate the previous number in the sequence.
 *
 * @param array $data
 *   The sequence data.
 *
 * @return int
 *   The previous number.
 */
function calculatePreviousNumber(array $data): int {
  $levels = createPyramid($data);

  for ($i = count($levels) - 2; $i >= 0; $i--) {
    array_unshift($levels[$i], $levels[$i][0] - $levels[$i + 1][0]);
  }

  return $levels[0][0];
}