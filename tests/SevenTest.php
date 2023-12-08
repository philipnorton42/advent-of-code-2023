<?php

namespace Philipnorton42\AdventOfCode2023\Test;

require './7/functions.php';

use PHPUnit\Framework\TestCase;

class SevenTest extends TestCase
{

  /**
   * @dataProvider extractGameDataDataProvider
   */
  public function testExtractGameData($string, $expectedResult)
  {
    $result = extractGameData($string);
    $this->assertEquals($expectedResult, $result);
  }

  public static function extractGameDataDataProvider() {
    $data = [];

    $gameData1 = <<<EOD
32T3K 765
T55J5 684
KK677 28
KTJJT 220
QQQJA 483
EOD;

    $data[] = [
      $gameData1,
      [
        ['32T3K', 765],
        ['T55J5', 684],
        ['KK677', 28],
        ['KTJJT', 220],
        ['QQQJA', 483],
      ]
    ];

    return $data;
  }

  /**
   * @dataProvider scoreGameDataProvider
   */
  public function testScoreGame($game, $expectedResult)
  {
    $result = scoreGame($game);
    $this->assertEquals($expectedResult, $result);
  }

  public static function scoreGameDataProvider() {
    $data = [];

    $data[] = ['QQQQQ', 1];
    $data[] = ['QQQQA', 2];
    $data[] = ['QQQAA', 3];
    $data[] = ['QQQA1', 4];
    $data[] = ['QQAA1', 5];
    $data[] = ['QQ123', 6];
    $data[] = ['12345', 7];
    $data[] = ['32T3K', 6];
    $data[] = ['T55J5', 4];
    $data[] = ['KK677', 5];
    $data[] = ['KTJJT', 5];
    $data[] = ['QQQJA', 4];
    $data[] = ['3JKKQ', 6];
    $data[] = ['TTTT3', 2];
    $data[] = ['Q4QQQ', 2];
    $data[] = ['AAAA3', 2];

    return $data;
  }

  /**
   * @dataProvider sortGamesDataProvider
   */
  public function testSortGames($game, $expectedResult)
  {
    $result = sortGames($game);
    $this->assertEquals($expectedResult, $result);
  }

  public static function sortGamesDataProvider() {
    $data = [];

    $data[] = [
      [
        ['AAAA3', 765],
        ['Q4QQQ', 483],
        ['TTTT3', 765],
      ],
      [
        ['TTTT3', 765], // 2
        ['Q4QQQ', 483], // 2
        ['AAAA3', 765], // 2
      ],
    ];

    $data[] = [
      [
        ['QQQJA', 483],
        ['32T3K', 765],
        ['T55J5', 684],
        ['KK677', 28],
        ['KTJJT', 220],
      ],
      [
        ['32T3K', 765], // 6
        ['KTJJT', 220], // 6
        ['KK677', 28], // 5
        ['T55J5', 684], // 4
        ['QQQJA', 483], // 4
      ],
    ];

    $data[] = [
      [
        ['AA8AA', 1],
        ['AA3AA', 1],
        ['AA4AA', 1],
        ['AA2AA', 1],
        ['AA37A', 1],
        ['AA36A', 1],
      ],
      [
        ['AA36A', 1],
        ['AA37A', 1],
        ['AA2AA', 1],
        ['AA3AA', 1],
        ['AA4AA', 1],
        ['AA8AA', 1],
      ],
    ];

    return $data;
  }

  /**
   * @dataProvider calculateTotalDataProvider
   */
  public function testCalculateTotal($game, $expectedResult)
  {
    $result = calculateTotal($game);
    $this->assertEquals($expectedResult, $result);
  }

  public static function calculateTotalDataProvider() {
    $data = [];

    $data[] = [
      [
        ['32T3K', 765],
        ['KTJJT', 220],
        ['KK677', 28],
        ['T55J5', 684],
        ['QQQJA', 483],
      ],
      6440,
    ];

    // After Joker ordering.
    $data[] = [
      [
        ['32T3K', 765], // 6
        ['KK677', 28], // 6
        ['T55J5', 684], // 2
        ['QQQJA', 483], // 2
        ['KTJJT', 220], // 2
      ],
      5905,
    ];

    return $data;
  }

  /**
   * @dataProvider scoreGameWithJokersDataProvider
   */
  public function testScoreGameWithJokers($game, $expectedResult)
  {
    $result = scoreGameWithJokers($game);
    $this->assertEquals($expectedResult, $result);
  }

  public static function scoreGameWithJokersDataProvider() {
    $data = [];

    $data[] = ['JJJJJ', 1];
    $data[] = ['QQQQQ', 1];
    $data[] = ['QQQQA', 2];
    $data[] = ['QQQAA', 3];
    $data[] = ['QQQA1', 4];
    $data[] = ['QQAA1', 5];
    $data[] = ['QQ123', 6];
    $data[] = ['12345', 7];
    $data[] = ['32T3K', 6];
    $data[] = ['T55J5', 2];
    $data[] = ['KK677', 5];
    $data[] = ['KTJJT', 2];
    $data[] = ['QQQJA', 2];
    $data[] = ['3JKKQ', 4];
    $data[] = ['TTTT3', 2];
    $data[] = ['Q4QQQ', 2];
    $data[] = ['AAAA3', 2];

    return $data;
  }

  /**
   * @dataProvider sortGamesWithJokersDataProvider
   */
  public function testSortGamesWithJokers($game, $expectedResult)
  {
    $result = sortGames($game, 'joker');
    $this->assertEquals($expectedResult, $result);
  }

  public static function sortGamesWithJokersDataProvider() {
    $data = [];

    $data[] = [
      [
        ['AAAA3', 765],
        ['Q4QQQ', 483],
        ['TTTT3', 765],
      ],
      [
        ['TTTT3', 765], // 2
        ['Q4QQQ', 483], // 2
        ['AAAA3', 765], // 2
      ],
    ];

    $data[] = [
      [
        ['QQQJA', 483],
        ['32T3K', 765],
        ['T55J5', 684],
        ['KK677', 28],
        ['KTJJT', 220],
      ],
      [
        ['32T3K', 765], // 6
        ['KK677', 28], // 6
        ['T55J5', 684], // 2
        ['QQQJA', 483], // 2
        ['KTJJT', 220], // 2
      ],
    ];

    $data[] = [
      [
        ['JKKK2', 765],
        ['QQQQ2', 483],
        ['TTTT3', 765],
      ],
      [
        ['JKKK2', 765],
        ['TTTT3', 765],
        ['QQQQ2', 483],
      ],
    ];

    return $data;
  }

}
