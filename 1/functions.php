<?php

function findCalibrationNumber(string $string): int {
  $characters = str_split($string, 1);

  $firstDigit = 0;
  $lastDigit = 0;

  for ($i = 0; $i < count($characters); $i++) {
    if (is_numeric($characters[$i])) {
      $firstDigit = $characters[$i];
      break;
    }
  }

  for ($i = count($characters) - 1; $i >= 0; $i--) {
    if (is_numeric($characters[$i])) {
      $lastDigit = $characters[$i];
      break;
    }
  }

  return (int) ($firstDigit . $lastDigit);
}

function convertNumber(string $string): string {
  $numberWords = [
    '/nineight/',
    '/fiveight/',
    '/threeight/',
    '/oneight/',
    '/eightwo/',
    '/eighthree/',
    '/zerone/',
    '/twone/',
    '/sevenine/',
    '/nine/',
    '/eight/',
    '/seven/',
    '/six/',
    '/five/',
    '/four/',
    '/three/',
    '/two/',
    '/one/',
    '/zero/',
  ];
  $digits = [
    98,
    58,
    38,
    18,
    82,
    83,
    01,
    21,
    79,
    9,
    8,
    7,
    6,
    5,
    4,
    3,
    2,
    1,
    0,
  ];
  return preg_replace($numberWords, $digits, $string);
}
