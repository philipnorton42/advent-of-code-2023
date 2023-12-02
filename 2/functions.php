<?php

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

function calculateGamePower($game):int {
  return ($game['red'] * $game['green'] * $game['blue']);
}