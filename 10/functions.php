<?php

/**
 * Extract the data from the pipes string.
 *
 * @param string $data
 *   The pipe data.
 *
 * @return array
 *   The pipe array.
 */
function extractPipeData(string $data): array {
  $pipeData = [];
  $lines = explode(PHP_EOL, $data);

  foreach ($lines as $line) {
    $pipeData[] = str_split($line);
  }

  return $pipeData;
}

/**
 * Get the loop length.
 *
 * @param array $pipeData
 *   The pipe data.
 *
 * @return int
 *   The loop length.
 */
function getHalfLoopLength(array $pipeData):int {
  // Find starting point.
  foreach ($pipeData as $x => $line) {
    foreach ($line as $y => $item) {
      if ($item === 'S') {
        $route = [];
        $length = traversePipe($pipeData, $x, $y, $route);
        return $length;
      }
    }
  }
}

/**
 * Find the internal volume of the pipe.
 *
 * @param array $pipeData
 *   The pipe data.
 *
 * @return int
 *   The internal volume.
 */
function findInternalVolume(array $pipeData):int {
  // Find starting point.
  foreach ($pipeData as $x => $line) {
    foreach ($line as $y => $item) {
      if ($item === 'S') {
        $route = [];
        traversePipe($pipeData, $x, $y, $route);
      }
    }
  }

  // Add start to end.
  $route[] = $route[0];

  $newPipeData = [];

  for ($i = 0; $i < count($pipeData); $i++) {
    $newPipeData[$i] = [];
    for ($j = 0; $j < count($pipeData[0]); $j++) {
      foreach ($route as $node) {
        if ($node['x'] == $i && $node['y'] == $j) {
          $newPipeData[$i][$j] = 'X';
          continue(2);
        }
      }
      $newPipeData[$i][$j] = '.';
    }
  }

  $inside = 0;

  foreach ($pipeData as $x => $line) {
    foreach ($line as $y => $item) {
        if (isInside(['x' => $x, 'y' => $y], $newPipeData, $route) === true) {
          $inside++;
          echo 'I';
        }
        else {
          echo '.';
        }
    }
    echo PHP_EOL;
  }

  echo PHP_EOL;

  return $inside;
}

/**
 * Is the current coordinates inside the pipe.
 *
 * @param array $coordinates
 *   The coordinates.
 * @param array $pipeData
 *   The pipe data.
 * @param array $route
 *   The pipe route itself.
 *
 * @return bool
 *   True if it's inside.
 */
function isInside($coordinates, $pipeData, $route) {

  foreach ($route as $item) {
    if ($item['x'] == $coordinates['x'] && $item['y'] == $coordinates['y']) {
      // Point is on our route, so is not inside.
      return false;
    }
  }

  // What we do here is to move from the pixel location to
  // the outside. If we pass through an odd number of walls
  // then the pixel is on the inside. Otherwise it should
  // be on the outside.
  // Erm... work in progress...

  $inside = false;

  $start = false;

  for ($i = 0; $i < count($pipeData); $i++) {
    if ($i == 0 && $pipeData[$coordinates['x']][$i] !== 'X') {
      $start = true;
      continue;
    }
    if ($pipeData[$coordinates['x']][$i] === 'X') {
      if ($start === true) {
        $inside = false;
        $start = false;
      }
      else {
        $inside = !$inside;
      }
    }
  }

  return $inside;
}

/**
 * Is the corrdinates inside the route?
 *
 * @param array $coordinates
 *   The coordinates.
 * @param array $loop
 *   The loop.
 *
 * @return bool
 *   True if the coordinates are inside.
 */
function isInside2($coordinates, $loop) {


  // This way of doing things has too many edge cases to be of much use here.
  // Keeping in the codebase for reference.


  foreach ($loop as $item) {
    if ($item['x'] == $coordinates['x'] && $item['y'] == $coordinates['y']) {
      // Point is on our route, so is not inside.
      return false;
    }
  }

  $intersections = 0;
  for ($i = 1; $i < count($loop); $i++) {
    $vertex1 = $loop[$i - 1];
    $vertex2 = $loop[$i];

    if ($coordinates['y'] > min($vertex1['y'], $vertex2['y'])
      and $coordinates['x'] <= max($vertex1['y'], $vertex2['y'])
      and $coordinates['x'] <= max($vertex1['x'], $vertex2['x'])
      and $vertex1['y'] != $vertex2['y']) {
      $xinters = ($coordinates['y'] - $vertex1['y']) * ($vertex2['x'] - $vertex1['x']) / ($vertex2['y'] - $vertex1['y']) + $vertex1['x'];
      if ($xinters == $coordinates['x']) {
        // Check if point is on the polygon boundary (other than horizontal)
        return false;
      }
      if ($vertex1['x'] == $vertex2['x'] || $coordinates['x'] <= $xinters) {
        $intersections++;
      }
    }
  }

  if ($intersections % 2 != 0) {
    return true;
  }

  return false;
}

/**
 * Traverse the graph to the endpoint.
 *
 * @param $pipeData
 *   The pipe data.
 * @param $x
 *   The current X.
 * @param $y
 *   The current y.
 * @param $route
 *   The route taken.
 * @param $length
 *   The length of the route.
 *
 * @return float|int|mixed
 *   The length.
 */
function traversePipe(&$pipeData, $x, $y, &$route = [], $length = 0) {

  $value = $pipeData[$x][$y];

  $route[] = ['x' => $x, 'y' => $y];

  $pipeData[$x][$y] = '#';

  $inRoute = function($x, $y, $route) {
    foreach ($route as $item) {
      if ($item['x'] == $x && $item['y'] == $y) {
        return true;
      }
      return false;
    }
  };

  switch ($value) {
    case 'S':
      $pipeData[$x][$y] = 'E';
      if (isset($pipeData[$x][$y - 1]) && $inRoute($x, $y - 1, $route) === false && in_array($pipeData[$x][$y - 1], ['-', 'L', 'F', 'E'])) {
        // -S FS LS
        return traversePipe($pipeData, $x, $y - 1, $route, $length + 1);
      }
      if (isset($pipeData[$x][$y + 1]) && $inRoute($x, $y + 1, $route) === false && in_array($pipeData[$x][$y + 1], ['-', 'J', '7', 'E'])) {
        // S- SJ S7
        return traversePipe($pipeData, $x, $y + 1, $route, $length + 1);
      }
      if (isset($pipeData[$x - 1][$y]) && $inRoute($x - 1, $y, $route) === false && in_array($pipeData[$x - 1][$y], ['|', 'F', '7', 'E'])) {
        /**
         * | F 7
         * S S S
         */
        return traversePipe($pipeData, $x - 1, $y, $route, $length + 1);
      }
      if (isset($pipeData[$x + 1][$y]) && $inRoute($x + 1, $y, $route) === false && in_array($pipeData[$x + 1][$y], ['|', 'L', 'J', 'E'])) {
        /**
         * S S S
         * | L J
         */
        return traversePipe($pipeData, $x + 1, $y, $route, $length + 1);
      }
      break;
    case '-':
      if (isset($pipeData[$x][$y - 1]) && $inRoute($x, $y - 1, $route) === false && in_array($pipeData[$x][$y - 1], ['-', 'L', 'F', 'E'])) {
        // -- F- L-
        return traversePipe($pipeData, $x, $y - 1, $route, $length + 1);
      }
      if (isset($pipeData[$x][$y + 1]) && $inRoute($x, $y + 1, $route) === false && in_array($pipeData[$x][$y + 1], ['-', 'J', '7', 'E'])) {
        // -- -J -7
        return traversePipe($pipeData, $x, $y + 1, $route, $length + 1);
      }
      break;
    case '|':
      if (isset($pipeData[$x - 1][$y]) && $inRoute($x - 1, $y, $route) === false && in_array($pipeData[$x - 1][$y], ['|', 'F', '7', 'E'])) {
        /**
         * | F 7
         * | | |
         */
        return traversePipe($pipeData, $x - 1, $y, $route, $length + 1);
      }
      if (isset($pipeData[$x + 1][$y]) && $inRoute($x + 1, $y, $route) === false && in_array($pipeData[$x + 1][$y], ['|', 'L', 'J', 'E'])) {
        /**
         * | | |
         * | L J
         */
        return traversePipe($pipeData, $x + 1, $y, $route, $length + 1);
      }
      break;
    case 'L':
      if (isset($pipeData[$x - 1][$y]) && $inRoute($x - 1, $y, $route) === false && in_array($pipeData[$x - 1][$y], ['|', 'F', '7', 'E'])) {
        /**
         * | F 7
         * L L L
         */
        return traversePipe($pipeData, $x - 1, $y, $route, $length + 1);
      }
      if (isset($pipeData[$x][$y + 1]) && $inRoute($x, $y + 1, $route) === false && in_array($pipeData[$x][$y + 1], ['-', 'J', '7', 'E'])) {
        // L- LJ L7
        return traversePipe($pipeData, $x, $y + 1, $route, $length + 1);
      }
      break;
    case 'J':
      if (isset($pipeData[$x - 1][$y]) && $inRoute($x - 1, $y, $route) === false && in_array($pipeData[$x - 1][$y], ['|', 'F', '7', 'E'])) {
        /**
         * | F 7
         * J J J
         */
        return traversePipe($pipeData, $x - 1, $y, $route, $length + 1);
      }
      if (isset($pipeData[$x][$y - 1]) && $inRoute($x, $y - 1, $route) === false && in_array($pipeData[$x][$y - 1], ['-', 'L', 'F', 'E'])) {
        // -J FJ LJ
        return traversePipe($pipeData, $x, $y - 1, $route, $length + 1);
      }
      break;
    case '7':
      if (isset($pipeData[$x][$y - 1]) && $inRoute($x, $y - 1, $route) === false && in_array($pipeData[$x][$y - 1], ['-', 'L', 'F', 'E'])) {
        // -7 F7 L7
        return traversePipe($pipeData, $x, $y - 1, $route, $length + 1);
      }
      if (isset($pipeData[$x + 1][$y]) && $inRoute($x + 1, $y, $route) === false && in_array($pipeData[$x + 1][$y], ['|', 'L', 'J', 'E'])) {
        /**
         * 7 7 7
         * | L J
         */
        return traversePipe($pipeData, $x + 1, $y, $route, $length + 1);
      }
      break;
    case 'F':
      if (isset($pipeData[$x][$y + 1]) && $inRoute($x, $y + 1, $route) === false && in_array($pipeData[$x][$y + 1], ['-', 'J', '7', 'E'])) {
        // F- FJ F7
        return traversePipe($pipeData, $x, $y + 1, $route, $length + 1);
      }
      if (isset($pipeData[$x + 1][$y]) && $inRoute($x + 1, $y, $route) === false && in_array($pipeData[$x + 1][$y], ['|', 'L', 'J', 'E'])) {
        /**
         * F F F
         * | L J
         */
        return traversePipe($pipeData, $x + 1, $y, $route, $length + 1);
      }
      break;
    default:
      return $length;
  }
  return round($length / 2);
}