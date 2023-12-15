<?php

/**
 * Extract the hash data from the input string.
 *
 * @param string $string
 *   The input string.
 *
 * @return string[]
 *   The hash data.
 */
function extractHashData($string)
{
  return explode(',', trim($string));
}

/**
 * Run the hash algorithm on the string.
 *
 * @param string $string
 *   The input string.
 *
 * @return int
 *   The result of the hash algorithm.
 */
function runHashAlogorithm($string)
{
  $characters = str_split($string, 1);

  $total = 0;

  foreach ($characters as $char) {
    $total += ord($char);
    $total = ($total * 17) % 256;
  }

  return $total;
}

/**
 * Organise the strings into boxes.
 *
 * @param string[] $strings
 *   An array containing the strings.
 *
 * @return array
 *   The organised boxes.
 */
function organiseIntoBoxes($strings)
{
  $boxes = [];

  foreach ($strings as $string) {
    if (str_contains($string, '-') === true) {
      $label = substr($string, 0, strpos($string, '-'));
      $hashValue = runHashAlogorithm($label);
      if (isset($boxes[$hashValue])) {
        foreach ($boxes[$hashValue] as $id => $lens) {
          if (isset($lens['label']) && $lens['label'] === $label) {
            unset($boxes[$hashValue][$id]);
            $boxes[$hashValue] = array_values($boxes[$hashValue]);
            continue(2);
          }
        }
      }
    }
    if (str_contains($string, '=') === true) {
      $label = substr($string, 0, strpos($string, '='));
      $hashValue = runHashAlogorithm($label);

      $focalLength = (int)substr($string, strpos($string, '=') + 1);

      if (isset($boxes[$hashValue])) {
        foreach ($boxes[$hashValue] as $id => $lens) {
          if (isset($lens['label']) && $lens['label'] === $label) {
            $boxes[$hashValue][$id]['focal_length'] = $focalLength;
            continue(2);
          }

        }
      }
      $lens = [
        'label' => $label,
        'focal_length' => $focalLength,
      ];
      $boxes[$hashValue][] = $lens;
    }
  }

  return $boxes;
}


/**
 * Calculate the total focusing power of the boxed lenses.
 *
 * @param array $boxes
 *   The boxes containing the lenses.
 *
 * @return float|int
 *   The result.
 */
function calculateTotalFocusingPower($boxes)
{
  $total = 0;
  foreach ($boxes as $id => $box) {
    foreach ($box as $slot => $lens) {
      $total += ($id + 1) * ($slot + 1) * $lens['focal_length'];
    }
  }
  return $total;
}
