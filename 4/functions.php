<?php

/**
 * Extract the numbers from a game string.
 *
 * @param string $gameString
 *   The game string.
 *
 * @return array
 *   An associative array of game data.
 */
function extractNumbers(string $gameString): array {
  $data = [];

  $parts = explode(': ', $gameString);
  $data['card'] = (int) str_replace('Card ', '', $parts[0]);

  $numbers = explode(' | ', trim($parts[1]));

  $data['winning'] = array_values(array_filter(explode(' ', $numbers[0])));
  $data['numbers'] = array_values(array_filter(explode(' ', $numbers[1])));

  foreach ($data['winning'] as $id => $value) {
    $data['winning'][$id] = (int) $value;
  }

  foreach ($data['numbers'] as $id => $value) {
    $data['numbers'][$id] = (int) $value;
  }

  return $data;
}

function calulateScore(array $gameData): int {
  $score = 0;
  foreach ($gameData['numbers'] as $number) {
    if (in_array($number, $gameData['winning'])) {
      if ($score === 0) {
        $score++;
      } else {
        $score = $score * 2;
      }
    }
  }
  return $score;
}

function numberOfWinningCards(array $gameData): int {
  $wins = 0;
  foreach ($gameData['numbers'] as $number) {
    if (in_array($number, $gameData['winning'])) {
      $wins++;
    }
  }
  return $wins;
}

/**
 * Calculates the number of card instances generated from winning cards.
 *
 * @param array $gamesData
 *   The current game data.
 * @param $allGames
 *   The full game data.
 *
 * @return int
 *   The overall count.
 */
function calculateCardInstances(array $gamesData, $allGames): int {
  $total = 0;
  foreach ($gamesData as $game) {
    $score = numberOfWinningCards($game);
    if ($score > 0) {
      $newGames = array_slice($allGames, $game['card'], $score);
      $total += calculateCardInstances($newGames, $allGames);
    }
    $total++;
  }
  return $total;
}
