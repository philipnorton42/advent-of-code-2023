<?php

/**
 * Extract space data.
 *
 * @param string $data
 *   The space data.
 *
 * @return array
 *   The space data, as an array.
 */
function extractGalaxyData(string $data): array {
  $extractedData = [];
  $lines = explode(PHP_EOL, $data);

  foreach ($lines as $line) {
    $extractedData[] = str_split($line);
  }

  return $extractedData;
}

/**
 * Expand the space data.
 *
 * @param array $space
 *   The space data.
 * @param int $expansion
 *   The level of expansion.
 *
 * @return array
 *   The expanded space data.
 */
function expandSpace($space, $expansion = 1): array {
  $expandedSpace = [];

  // Duplicate blank rows.
  foreach ($space as $row) {
    $emptyRow = true;
    foreach ($row as $data) {
        if ($data == '#') {
          $emptyRow = false;
        }
    }
    if ($emptyRow) {
      $expandedSpace[] = $row;
      for ($add = 0; $add < $expansion; $add++) {
        $expandedSpace[] = $row;
      }
    }
    else {
      $expandedSpace[] = $row;
    }
  }

  // Flip the column.
  $space = $expandedSpace;
  $expandedSpace = [];

  foreach ($space as $id => $row) {
    $colum = array_column($space, $id);
    if (!empty($colum)) {
      $expandedSpace[] = $colum;
    }
  }

  // Duplicate blank rows.
  $space = $expandedSpace;
  $expandedSpace = [];

  foreach ($space as $row) {
    $emptyRow = true;
    foreach ($row as $data) {
      if ($data == '#') {
        $emptyRow = false;
      }
    }
    if ($emptyRow) {
      $expandedSpace[] = $row;
      for ($add = 0; $add < $expansion; $add++) {
        $expandedSpace[] = $row;
      }
    }
    else {
      $expandedSpace[] = $row;
    }
  }

  // Re-flip the columns.
  $space = $expandedSpace;
  $expandedSpace = [];

  foreach ($space as $id => $row) {
    $colum = array_column($space, $id);
    if (!empty($colum)) {
      $expandedSpace[] = $colum;
    }
  }

  return $expandedSpace;
}

/**
 * Extract the galaxies and their coordinates.
 *
 * @param array $space
 *   The space data.
 *
 * @return array
 *   An array of galaxies.
 */
function numberGalaxies($space) {
  $galaxies = [];
  $galaxyNumber = 0;

  for ($i = 0; $i < count($space); $i++) {
    for ($j = 0; $j < count($space[0]); $j++) {
      if ($space[$i][$j] === '#') {
        $galaxies[++$galaxyNumber] = [
          'x' => $i,
          'y' => $j,
        ];
      }
    }
  }

  return $galaxies;
}

/**
 * Find the pairs of galaxies available in the system.
 *
 * @param array $numbers
 *   The galaxy numbers array.
 *
 * @return array
 *   The list of pairs.
 */
function findPairs($numbers) {
  $pairs = [];

  $numbers = array_keys($numbers);

  for ($i = 1; $i < count($numbers); $i++) {
    for($j = $i + 1; $j < count($numbers) + 1; $j++) {
      $pairs[] = [$i, $j];
    }
  }

  return $pairs;
}

/**
 * Calculate the distance between two galaxies.
 *
 * @param array $coordinate1
 *   The first galaxy.
 * @param array $coordinate2
 *   The second galaxy.
 *
 * @return int
 *   The distance between them.
 */
function distance($coordinate1, $coordinate2) {
  $x1 = $coordinate1['x'];
  $x2 = $coordinate2['x'];
  $y1 = $coordinate1['y'];
  $y2 = $coordinate2['y'];
  return drawLine($x1, $y1, $x2, $y2);
}

/**
 * Draw a line between two points.
 *
 * This will draw an "L" shape line.
 *
 * @param int $x0
 *   The x part of the starting coordinate.
 * @param int $y0
 *   The y part of the starting coordinate.
 * @param int $x1
 *   The x part of the ending coordinate.
 * @param int $y1
 *   The y part of the ending coordinate.
 */
function drawLine($x0, $y0, $x1, $y1) {
  $length = 0;

  $dx = $x1 - $x0;
  if ($dx < 0) {
    // x1 is lower than x0.
    $sx = -1;
  } else {
    // x1 is higher than x0.
    $sx = 1;
  }

  $dy = $y1 - $y0;
  if ($dy < 0) {
    // y1 is lower than y0.
    $sy = -1;
  } else {
    // y1 is higher than y0.
    $sy = 1;
  }

  while ($x0 != $x1) {
    $length++;
    $x0 += $sx;
  }

  while ($y0 != $y1) {
    $length++;
    $y0 += $sy;
  }

  return $length;
}