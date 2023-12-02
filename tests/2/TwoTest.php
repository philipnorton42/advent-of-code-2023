<?php

namespace Philipnorton42\AdventOfCode2023\Test;

require './2/functions.php';

use PHPUnit\Framework\TestCase;

class TwoTest extends TestCase {

  /**
   * @dataProvider extractGameMaxDataProvider
   */
  public function testTwoExtractMaxGameData($string, $expectedResult) {
    $result = extractGameMax($string);
    $this->assertEquals($expectedResult, $result);
  }

  public static function extractGameMaxDataProvider() {
    return [
        ['Game 1: 3 blue, 4 red; 1 red, 2 green, 6 blue; 2 green',
          ['game_id' => 1, 'blue' => 6, 'red' => 4, 'green' => 2,]
        ],
        ['Game 2: 1 blue, 2 green; 3 green, 4 blue, 1 red; 1 green, 1 blue',
          ['game_id' => 2, 'blue' => 4, 'red' => 1, 'green' => 3,],
        ],
        ['Game 3: 8 green, 6 blue, 20 red; 5 blue, 4 red, 13 green; 5 green, 1 red',
          ['game_id' => 3, 'blue' => 6, 'red' => 20, 'green' => 13,],
        ],
        ['Game 4: 1 green, 3 red, 6 blue; 3 green, 6 red; 3 green, 15 blue, 14 red',
          ['game_id' => 4, 'blue' => 15, 'red' => 14, 'green' => 3,],
        ],
        ['Game 5: 6 red, 1 blue, 3 green; 2 blue, 1 red, 2 green',
          ['game_id' => 5, 'blue' => 2, 'red' => 6, 'green' => 3,],
        ],
        ['Game 1: 12 blue, 15 red, 2 green; 17 red, 8 green, 5 blue; 8 red, 17 blue; 9 green, 1 blue, 4 red',
          ['game_id' => 1, 'blue' => 17, 'red' => 17, 'green' => 9,]
        ],
        ['Game 2: 6 red, 6 blue, 2 green; 1 blue, 1 red; 6 green, 1 red, 10 blue',
          ['game_id' => 2, 'blue' => 10, 'red' => 6, 'green' => 6,]
        ],
        ['Game 3: 1 green, 2 blue; 7 blue, 4 green; 2 green, 1 blue; 10 blue, 4 green; 4 blue; 1 green, 7 blue, 1 red',
          ['game_id' => 3, 'blue' => 10, 'red' => 1, 'green' => 4,]
        ],
    ];
  }

  /**
   * @dataProvider isValidGameDataProvider
   */
  public function testIsValidGame($game, $expectedResult) {
    $result = isValidGame($game);
    $this->assertEquals($expectedResult, $result);
  }

  public static function isValidGameDataProvider() {
    return [
      [['game_id' => 1, 'blue' => 3, 'red' => 7, 'green' => 5,], true],
      [['game_id' => 2, 'blue' => 6, 'red' => 1, 'green' => 6,], true],
      [['game_id' => 3, 'blue' => 5, 'red' => 20, 'green' => 13,], false],
      [['game_id' => 4, 'blue' => 15, 'red' => 14, 'green' => 15,], false],
      [['game_id' => 5, 'blue' => 2, 'red' => 6, 'green' => 3,], true],
      [['game_id' => 1, 'blue' => 0, 'red' => 0, 'green' => 0,], true],
      [['game_id' => 1, 'blue' => 14, 'red' => 12, 'green' => 13,], true],
      [['game_id' => 1, 'blue' => 15, 'red' => 12, 'green' => 13,], false],
      [['game_id' => 1, 'blue' => 14, 'red' => 13, 'green' => 13,], false],
      [['game_id' => 1, 'blue' => 14, 'red' => 12, 'green' => 14,], false],
      [['game_id' => 1, 'blue' => 15, 'red' => 13, 'green' => 14,], false],
      [['game_id' => 1, 'blue' => 11, 'red' => 25, 'green' => 26,], false],
      [['game_id' => 1, 'blue' => 21, 'red' => 23, 'green' => 7,], false],
    ];
  }

  /**
   * @dataProvider calculateGamePowerDataProvider
   */
  public function testTwoExtractMinGameData($game, $expectedResult) {
    $result = calculateGamePower($game);
    $this->assertEquals($expectedResult, $result);
  }

  public static function calculateGamePowerDataProvider() {
    return [
      [['game_id' => 1, 'blue' => 4, 'red' => 2, 'green' => 6,], 48],
      [['game_id' => 1, 'blue' => 4, 'red' => 1, 'green' => 3,], 12],
      [['game_id' => 1, 'blue' => 6, 'red' => 20, 'green' => 13,], 1560],
      [['game_id' => 1, 'blue' => 15, 'red' => 14, 'green' => 3,], 630],
      [['game_id' => 1, 'blue' => 2, 'red' => 6, 'green' => 3,], 36],
    ];
  }
}
