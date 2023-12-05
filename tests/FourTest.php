<?php

namespace Philipnorton42\AdventOfCode2023\Test;

require './4/functions.php';

use PHPUnit\Framework\TestCase;

class FourTest extends TestCase
{

  /**
   * @dataProvider extractNumbersDataProvider
   */
  public function testExtractNumbers($string, $expectedResult)
  {
    $result = extractNumbers($string);
    $this->assertEquals($expectedResult, $result);
  }

  public static function extractNumbersDataProvider()
  {
    return [
      [
        'Card 1: 41 48 83 86 17 | 83 86  6 31 17  9 48 53',
        [
          'card' => 1,
          'winning' => [41, 48, 83, 86, 17],
          'numbers' => [83, 86, 6, 31, 17, 9, 48, 53],
        ],
      ],
      [
        'Card 2: 13 32 20 16 61 | 61 30 68 82 17 32 24 19',
        [
          'card' => 2,
          'winning' => [13, 32, 20, 16, 61],
          'numbers' => [61, 30, 68, 82, 17, 32, 24, 19],
        ],
      ],
      [
        'Card 3:  1 21 53 59 44 | 69 82 63 72 16 21 14  1',
        [
          'card' => 3,
          'winning' => [1, 21, 53, 59, 44],
          'numbers' => [69, 82, 63, 72, 16, 21, 14, 1],
        ],
      ],
      [
        'Card 4: 41 92 73 84 69 | 59 84 76 51 58  5 54 83',
        [
          'card' => 4,
          'winning' => [41, 92, 73, 84, 69],
          'numbers' => [59, 84, 76, 51, 58, 5, 54, 83],
        ],
      ],
      [
        'Card 5: 87 83 26 28 32 | 88 30 70 12 93 22 82 36',
        [
          'card' => 5,
          'winning' => [87, 83, 26, 28, 32],
          'numbers' => [88, 30, 70, 12, 93, 22, 82, 36],
        ],
      ],
      [
        'Card 6: 31 18 13 56 72 | 74 77 10 23 35 67 36 11',
        [
          'card' => 6,
          'winning' => [31, 18, 13, 56, 72],
          'numbers' => [74, 77, 10, 23, 35, 67, 36, 11],
        ],
      ],
    ];
  }

  /**
   * @dataProvider calculateScoreDataProvider
   */
  public function testCalculateScore($gameData, $expectedResult, $numberOfWinningCards)
  {
    $score = calulateScore($gameData);
    $winningCards = numberOfWinningCards($gameData);
    $this->assertEquals($expectedResult, $score);
    $this->assertEquals($numberOfWinningCards, $winningCards);
  }

  public static function calculateScoreDataProvider()
  {
    return [
      [
        [
          'card' => 1,
          'winning' => [41, 48, 83, 86, 17],
          'numbers' => [83, 86, 6, 31, 17, 9, 48, 53],
        ],
        8,
        4
      ],
      [
        [
          'card' => 2,
          'winning' => [13, 32, 20, 16, 61],
          'numbers' => [61, 30, 68, 82, 17, 32, 24, 19],
        ],
        2,
        2
      ],
      [
        [
          'card' => 3,
          'winning' => [1, 21, 53, 59, 44],
          'numbers' => [69, 82, 63, 72, 16, 21, 14, 1],
        ],
        2,
        2
      ],
      [
        [
          'card' => 4,
          'winning' => [41, 92, 73, 84, 69],
          'numbers' => [59, 84, 76, 51, 58, 5, 54, 83],
        ],
        1,
        1
      ],
      [
        [
          'card' => 5,
          'winning' => [87, 83, 26, 28, 32],
          'numbers' => [88, 30, 70, 12, 93, 22, 82, 36],
        ],
        0,
        0
      ],
      [
        [
          'card' => 6,
          'winning' => [31, 18, 13, 56, 72],
          'numbers' => [74, 77, 10, 23, 35, 67, 36, 11],
        ],
        0,
        0
      ],
    ];
  }

  /**
   * @dataProvider calculateCardInstancesDataProvider
   */
  public function testCalculateCardInstances($games, $expectedResult)
  {
    $result = calculateCardInstances($games, $games);
    $this->assertEquals($expectedResult, $result);
  }

  public static function calculateCardInstancesDataProvider()
  {
    return [
      [
        [
          1 => [
            'card' => 1,
            'winning' => [41, 48, 83, 86, 17],
            'numbers' => [83, 86, 6, 31, 17, 9, 48, 53],
          ],
          2 => [
            'card' => 2,
            'winning' => [13, 32, 20, 16, 61],
            'numbers' => [61, 30, 68, 82, 17, 32, 24, 19],
          ],
          3 => [
            'card' => 3,
            'winning' => [1, 21, 53, 59, 44],
            'numbers' => [69, 82, 63, 72, 16, 21, 14, 1],
          ],
          4 => [
            'card' => 4,
            'winning' => [41, 92, 73, 84, 69],
            'numbers' => [59, 84, 76, 51, 58, 5, 54, 83],
          ],
          5 => [
            'card' => 5,
            'winning' => [87, 83, 26, 28, 32],
            'numbers' => [88, 30, 70, 12, 93, 22, 82, 36],
          ],
          6 => [
            'card' => 6,
            'winning' => [31, 18, 13, 56, 72],
            'numbers' => [74, 77, 10, 23, 35, 67, 36, 11],
          ],
        ],
        30
      ],
    ];
  }

}
