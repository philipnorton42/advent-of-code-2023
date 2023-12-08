<?php

/**
 * Extract the game data.
 *
 * @param string $data
 *   The game data.
 *
 * @return array
 *   The extracted game data.
 */
function extractGameData($data)
{
  $games = [];

  $lines = explode("\n", $data);
  foreach ($lines as $line) {
    preg_match_all('/([A-Z0-9]+)\s(\d+)/', $line, $matches);
    $games[] = [
      $matches[1][0],
      (int) $matches[2][0],
    ];
  }

  return $games;
}

/**
 * Score the game.
 *
 * @param string $game
 *   The game to score.
 *
 * @return int
 *   The score of the game, between 1 and 7.
 */
function scoreGame($game) {
  // May need to order the cards.
  $gameParts = str_split($game);
  sort($gameParts);
  $game = implode($gameParts);

  // Five of a kind = 1
  if (preg_match('/([A-Z0-9])\1{4}/i', $game, $matches) === 1) {
    return 1;
  }

  // Four of a kind = 2
  if (preg_match('/([A-Z0-9])\1{3}/i', $game, $matches) === 1) {
    return 2;
  }

  if (preg_match('/([A-Z0-9])\1{2}/i', $game, $matches) === 1) {
    $game = preg_replace('/([A-Z0-9])\1{2}/i', '', $game);
    if (preg_match('/([A-Z0-9])\1{1}/i', $game, $matches) === 1) {
      // Full house = 3
      return 3;
    }
    // Three of a kind = 4
    return 4;
  }

  if (preg_match('/([A-Z0-9])\1{1}/i', $game, $matches) === 1) {
    $game = preg_replace('/([A-Z0-9])\1{1}/i', '', $game, 1);
    if (preg_match('/([A-Z0-9])\1{1}/i', $game, $matches) === 1) {
      // Two pair = 5
      return 5;
    }
    // One pair = 6
    return 6;
  }

  // High card = 7
  return 7;
}

/**
 * Sort the games based on the criteria.
 *
 * @param array $games
 *   The list of games to sort.
 * @param string $scoreType
 *   The type of scoring to perform.
 *
 * @return array
 *   The sorted list of games.
 */
function sortGames($games, $scoreType = 'standard') {

  usort($games, function($a, $b) use ($scoreType) {
    switch ($scoreType) {
      case 'joker':
        $aScore = scoreGameWithJokers($a[0]);
        $bScore = scoreGameWithJokers($b[0]);
        break;
      case 'standard':
        // Deliberate cascade.
      default:
        $aScore = scoreGame($a[0]);
        $bScore = scoreGame($b[0]);
    }

    $a[] = $aScore;
    $b[] = $bScore;

    if ($aScore === $bScore) {

      // Grab the first non-same letter from the string.
      for ($i = 0; $i < 5; $i++) {
        $aFirst = substr($a[0], $i, 1);
        $bFirst = substr($b[0], $i, 1);
        if ($aFirst !== $bFirst) {
          break;
        }
      }

      $mapLetterWithoutJokerScoring = function($letter) {
        switch ($letter) {
          case 'A':
            return 14;
          case 'K':
            return 13;
          case 'Q':
            return 12;
          case 'J':
            return 11;
          case 'T':
            return 10;
          default:
            return $letter;
        }
      };

      $mapLetterWithJokerScoring = function($letter) {
        switch ($letter) {
          case 'A':
            return 13;
          case 'K':
            return 12;
          case 'Q':
            return 11;
          case 'J':
            return 0;
          case 'T':
            return 10;
          default:
            return $letter;
        }
      };

      switch ($scoreType) {
        case 'joker':
          $mapLetter = $mapLetterWithJokerScoring;
          break;
        case 'standard':
          // Deliberate cascade.
        default:
          $mapLetter = $mapLetterWithoutJokerScoring;
      }

      $aFirst = (int) $mapLetter($aFirst);
      $bFirst = (int) $mapLetter($bFirst);

      return $aFirst <=> $bFirst;
    }

    return $bScore <=> $aScore;
  });

  return $games;
}

function calculateTotal($games) {
  $total = 0;

  foreach ($games as $id => $game) {
    $total += ($game[1] * ($id + 1));
  }

  return $total;
}

/**
 * Score the game with Jokers as wildcards.
 *
 * @param string $game
 *   The game to score.
 *
 * @return int
 *   The score.
 */
function scoreGameWithJokers($game) {

  if (str_contains($game, 'J') === false) {
    // Don't modify the score if the Joker card doesn't exist.
    return scoreGame($game);
  }

  $replacements = [
    'K', 'Q', 'J', 'T', '9', '8', '7', '6', '5', '4', '3', '2', '1', 'A',
  ];

  $bestScore = 7;

  foreach ($replacements as $replacement) {
    if (str_contains($game, $replacement) === false) {
      continue;
    }

    $newgame = str_replace('J', $replacement, $game);
    $score = scoreGame($newgame);
    if ($score < $bestScore) {
      $bestScore = $score;
    }
  }

  return $bestScore;
}