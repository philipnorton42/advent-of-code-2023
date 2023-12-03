<?php

/**
 * Find the calibration number from a given string.
 *
 * The calibration number is the first and last detected digit in the string.
 *
 * @param string $string
 *   The string to extract the calibration number from.
 *
 * @return int
 *   The calibration number.
 */
function findCalibrationNumber(string $string): int {
  $characters = str_split($string, 1);

  $firstDigit = 0;
  $lastDigit = 0;

  for ($i = 0; $i < count($characters); $i++) {
    if ($firstDigit === 0 && is_numeric($characters[$i])) {
      $firstDigit = $characters[$i];
    }
    if ($lastDigit === 0 && is_numeric($characters[count($characters) - $i - 1])) {
      $lastDigit = $characters[count($characters) - $i - 1];
    }
  }

  return (int) ($firstDigit . $lastDigit);
}

/**
 * Convert any spelled out numbers in a string to a number.
 *
 * Some calibration numbers are hidden in spelled out numbers. This function
 * will convert them into digits before we then extract them using the
 * findCalibrationNumner() function.
 *
 * @param string $string
 *   The string to convert.
 *
 * @return string
 *   The converted string.
 */
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
