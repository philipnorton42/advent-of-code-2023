<?php

/**
 * Extract the maximum number of colours from a game string.
 *
 * The maximum colour is the largest number of colours for each turn in the
 * game.
 *
 * @param string $string
 *   The string to extract the data from.
 * @return array|int[]
 *   An associative array, indicating the game number and the number of
 * colours required for the game.
 */
function extractGameMax(string $string): array {
  $parts = explode(':', trim($string));
  $gameNumber = (int) str_replace('Game ', '', $parts[0]);

  $goes = explode(';', $parts[1]);

  $colours = [];

  foreach ($goes as $go) {
    $goParts = explode(', ', $go);
    foreach ($goParts as $goPart) {
      $colour = explode(' ', trim($goPart));
      $colour[0] = (int) $colour[0];
      if (isset($colours[$colour[1]])) {
        if ($colours[$colour[1]] > $colour[0]) {
          continue;
        }
      }
      $colours[$colour[1]] = $colour[0];
    }
  }

  return [
    'game_id' => $gameNumber,
  ] + $colours;
}

/**
 * Returns if the game is valid or not, depending on the number of colours.
 *
 * @param array $game
 *   The data extracted from the extractGameMax() function.
 *
 * @return bool
 *   True if the game is valid.
 */
function isValidGame(array $game): bool {
  $redTotal = 12;
  $greenTotal = 13;
  $blueTotal = 14;
  if (isset($game['red']) && $game['red'] > $redTotal) {
    return false;
  }
  if (isset($game['green']) && $game['green'] > $greenTotal) {
    return false;
  }
  if (isset($game['blue']) && $game['blue'] > $blueTotal) {
    return false;
  }
  return true;
}

/**
 * Calculate the power of the game as a product of the colour maximums.
 *
 * @param array $game
 *   The game data.
 *
 * @return int
 *   The product of the colour values.
 */
function calculateGamePower(array $game):int {
  return ($game['red'] * $game['green'] * $game['blue']);
}