<?php

namespace Philipnorton42\AdventOfCode2023\Test;

require './9/functions.php';

use PHPUnit\Framework\TestCase;

class NineTest extends TestCase {

  /**
   * @dataProvider extractSensorDataDataProvider
   */
  public function testExtractSensorData($string, $expectedResult) {
    $result = extractSensorData($string);
    $this->assertEquals($expectedResult, $result);
  }

  public static function extractSensorDataDataProvider() {
    $output = [];

    $inputData1 = <<<EOD
0 3 6 9 12 15
1 3 6 10 15 21
10 13 16 21 30 45
EOD;

    $output[] = [
      $inputData1,
      [
        [0, 3, 6, 9, 12, 15,],
        [1, 3, 6, 10, 15, 21,],
        [10, 13, 16, 21, 30, 45,],
      ],
    ];

    $inputData2 = <<<EOD
24 32 35 33 26 14 -3 -25 -52 -84 -121 -163 -210 -262 -319 -381 -448 -520 -597 -679 -766
EOD;

    $output[] = [
      $inputData2,
      [
        [24, 32, 35, 33, 26, 14, -3, -25, -52, -84, -121, -163, -210, -262, -319, -381, -448, -520, -597, -679, -766,]
      ],
    ];

    return $output;
  }

  /**
   * @dataProvider calculateNextNumberDataProvider
   */
  public function testCalculateNextNumber($string, $expectedResult) {
    $result = calculateNextNumber($string);
    $this->assertEquals($expectedResult, $result);
  }

  public static function calculateNextNumberDataProvider() {
    $output = [];

    $output[] = [[0, 3, 6, 9, 12, 15,], 18];
    $output[] = [[1, 3, 6, 10, 15, 21,], 28];
    $output[] = [[10, 13, 16, 21, 30, 45,], 68];
    $output[] = [[24, 32, 35, 33, 26, 14, -3,], -25];
    $output[] = [[24, 32, 35, 33, 26, 14, -3, -25,], -52];
    $output[] = [[24, 32, 35, 33, 26, 14, -3, -25, -52,], -84];
    $output[] = [[24, 32, 35, 33, 26, 14, -3, -25, -52, -84,], -121];
    $output[] = [[24, 32, 35, 33, 26, 14, -3, -25, -52, -84, -121,], -163];
    $output[] = [[24, 32, 35, 33, 26, 14, -3, -25, -52, -84, -121, -163,], -210];
    $output[] = [[24, 32, 35, 33, 26, 14, -3, -25, -52, -84, -121, -163, -210,], -262];
    $output[] = [[24, 32, 35, 33, 26, 14, -3, -25, -52, -84, -121, -163, -210, -262,], -319];
    $output[] = [[24, 32, 35, 33, 26, 14, -3, -25, -52, -84, -121, -163, -210, -262, -319,], -381];
    $output[] = [[24, 32, 35, 33, 26, 14, -3, -25, -52, -84, -121, -163, -210, -262, -319, -381,], -448];
    $output[] = [[24, 32, 35, 33, 26, 14, -3, -25, -52, -84, -121, -163, -210, -262, -319, -381, -448,], -520];
    $output[] = [[24, 32, 35, 33, 26, 14, -3, -25, -52, -84, -121, -163, -210, -262, -319, -381, -448, -520,], -597,];
    $output[] = [[24, 32, 35, 33, 26, 14, -3, -25, -52, -84, -121, -163, -210, -262, -319, -381, -448, -520, -597,], -679];
    $output[] = [[24, 32, 35, 33, 26, 14, -3, -25, -52, -84, -121, -163, -210, -262, -319, -381, -448, -520, -597, -679,], -766];
    $output[] = [[24, 32, 35, 33, 26, 14, -3, -25, -52, -84, -121, -163, -210, -262, -319, -381, -448, -520, -597, -679, -766,], -858];

    return $output;
  }

  /**
   * @dataProvider calculatePreviousNumberDataProvider
   */
  public function testCalculatePreviousNumber($string, $expectedResult) {
    $result = calculatePreviousNumber($string);
    $this->assertEquals($expectedResult, $result);
  }

  public static function calculatePreviousNumberDataProvider() {
    $output = [];

    $output[] = [[0, 3, 6, 9, 12, 15,], -3];
    $output[] = [[1, 3, 6, 10, 15, 21,], 0];
    $output[] = [[10, 13, 16, 21, 30, 45,], 5];

    return $output;
  }

}
