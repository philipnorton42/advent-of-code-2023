<?php

function extractNetworkData(string $string):array {
  $data = [
    'directions' => [],
    'nodes' => [],
  ];

  $lines = explode(PHP_EOL, $string);

  $data['directions'] = str_split($lines[0]);

  // Start from line 2.
  for ($i = 2; $i < count($lines); $i++) {
    preg_match('/([A-Z]{3}) = \(([A-Z]{3}), ([A-Z]{3})\)/i', $lines[$i], $matches);
    $data['nodes'][$matches[1]] = [$matches[2], $matches[3]];
  }

  return $data;
}

/**
 * Traverse the graph from AAA to ZZZ.
 *
 * @param array $data
 *   The maze data.
 *
 * @return int
 *   The number of steps.
 */
function traverseGraph(array $data): int {
  $steps = 0;

  $end = 'ZZZ';

  $step = 'AAA';

  while ($step !== $end) {
    $routes = $data['nodes'][$step];

    $direction = current($data['directions']);

    if ($direction === false) {
      reset($data['directions']);
      $direction = current($data['directions']);
    }

    if ($direction === 'L') {
      $step = $routes[0];
    } else {
      $step = $routes[1];
    }

    next($data['directions']);

    $steps++;
  }

  return $steps;
}

/**
 * Simultaneously traverse the graph.
 *
 * Instead of brute forcing this the algorithm instead goes traverses each of
 * the separate streams and then figures out their intersection point by
 * calculating the lowest common multiplier of the number of different steps
 *
 * @param array $data
 *   The graph data.
 *
 * @return int
 *   The number of steps taken.
 */
function simultaneouslyTraverseGraph($data): int {
  $startingPoints = [];
  foreach ($data['nodes'] as $node => $directions) {
    if (substr($node, 2, 1) === 'A') {
      $startingPoints[] = $node;
    }
  }
  unset($node);
  unset($directions);

  $stepCounts = [];

  foreach ($startingPoints as $step) {

    $steps = 0;
    while (substr($step, 2, 1) !== 'Z') {
      $routes = $data['nodes'][$step];

      $direction = current($data['directions']);

      if ($direction === false) {
        reset($data['directions']);
        $direction = current($data['directions']);
      }

      if ($direction === 'L') {
        $step = $routes[0];
      } else {
        $step = $routes[1];
      }

      next($data['directions']);

      $steps++;
    }
    $stepCounts[] = $steps;
  }

  // Calculate the LCM of the number of steps taken.
  $greatestCommonDivisor = function($a, $b) use (&$greatestCommonDivisor) {
    if ($b == 0) {
      return $a;
    }
    return $greatestCommonDivisor($b, $a % $b);
  };

  $lcmSteps = $stepCounts[0];

  for ($i = 1; $i < count($stepCounts); $i++) {
    $lcmSteps = ($stepCounts[$i] * $lcmSteps) / ($greatestCommonDivisor($stepCounts[$i], $lcmSteps));
  }

  return $lcmSteps;
}
