<?php

function extractData(string $data): array {
  $data = explode("\n", $data);
  $lines = [];
  foreach ($data as $line) {
    $lines[] = str_split($line, 1);
  }

  return $lines;
}

function extractAdjacentNumbers(array $data): array {
  $coordinatesArray = [
    [-1, -1],[-1, 0],[-1, 1],
    [0, -1],         [0, 1],
    [1, -1], [1, 0], [1, 1]
  ];

  $numbers = [];

  for ($x = 0; $x < count($data); $x++) {
    for ($y = 0; $y < count($data[$x]); $y++) {

      if ($data[$x][$y] !== '.' && is_numeric($data[$x][$y]) === false) {

        foreach ($coordinatesArray as $coordinate) {
          if (isset($data[$x + $coordinate[0]][$y + $coordinate[1]])
            && is_numeric($data[$x + $coordinate[0]][$y + $coordinate[1]])) {

            // This is a number, find the start.
            $numberStart = false;
            for ($i = $y + $coordinate[1]; ; $i--) {
              if (!isset($data[$x + $coordinate[0]][$i]) || is_numeric($data[$x + $coordinate[0]][$i]) === false) {
                $numberStart = $i + 1;
                break;
              }
            }

            // And the end.
            $numberEnd = false;
            for ($i = $y + $coordinate[1]; ; $i++) {
              if (!isset($data[$x + $coordinate[0]][$i]) || is_numeric($data[$x + $coordinate[0]][$i]) === false) {
                $numberEnd = $i - 1;
                break;
              }
            }

            $number = '';
            if ($numberStart !== false && $numberEnd !== false) {
              for ($i = $numberStart; $i <= $numberEnd; $i++) {
                $number .= $data[$x + $coordinate[0]][$i];
                $data[$x + $coordinate[0]][$i] = '.';
             }
            }

            $numbers[] = (int) $number;
          }
        }
      }

    }
  }

  return $numbers;
}

function extractGearRatioNumbers(array $data): array {
  $coordinatesArray = [
    [-1, -1],[-1, 0],[-1, 1],
    [0, -1],         [0, 1],
    [1, -1], [1, 0], [1, 1]
  ];

  $numbers = [];

  for ($x = 0; $x < count($data); $x++) {
    for ($y = 0; $y < count($data[$x]); $y++) {

      if ($data[$x][$y] === '*') {

        $numberParts = [];

        foreach ($coordinatesArray as $coordinate) {
          if (isset($data[$x + $coordinate[0]][$y + $coordinate[1]])
            && is_numeric($data[$x + $coordinate[0]][$y + $coordinate[1]])) {

            // This is a number, find the start.
            $numberStart = false;
            for ($i = $y + $coordinate[1]; ; $i--) {
              if (!isset($data[$x + $coordinate[0]][$i]) || is_numeric($data[$x + $coordinate[0]][$i]) === false) {
                $numberStart = $i + 1;
                break;
              }
            }

            // And the end.
            $numberEnd = false;
            for ($i = $y + $coordinate[1]; ; $i++) {
              if (!isset($data[$x + $coordinate[0]][$i]) || is_numeric($data[$x + $coordinate[0]][$i]) === false) {
                $numberEnd = $i - 1;
                break;
              }
            }

            $number = '';
            if ($numberStart !== false && $numberEnd !== false) {
              for ($i = $numberStart; $i <= $numberEnd; $i++) {
                $number .= $data[$x + $coordinate[0]][$i];
                $data[$x + $coordinate[0]][$i] = '.';
              }
            }

            $numberParts[] = (int) $number;
          }
        }
        if (count($numberParts) > 1) {
          // More than one gear number found, so multiply them together.
          $numbers[] = array_product($numberParts);
        }
      }

    }
  }

  return $numbers;
}