<?php

namespace Philipnorton42\AdventOfCode2023\Test;

require './6/functions.php';

use PHPUnit\Framework\TestCase;

class SixTest extends TestCase
{

  /**
   * @dataProvider extractRaceDataDataProvider
   */
  public function testExtractRaceData($string, $expectedResult)
  {
    $result = extractRaceData($string);
    $this->assertEquals($expectedResult, $result);
  }

  public static function extractRaceDataDataProvider() {
    $data = [];

    $string1 =  <<<EOD
Time:      7  15   30
Distance:  9  40  200
EOD;

    $data[] = [
      $string1,
      [
        [
          7, 9,
        ],
        [
          15, 40,
        ],
        [
          30, 200,
        ],
      ]
    ];

    $string2 =  <<<EOD
Time:      7  15   30  123
Distance:  9  40  200  321
EOD;

    $data[] = [
      $string2,
      [
        [
          7, 9,
        ],
        [
          15, 40,
        ],
        [
          30, 200,
        ],
        [
          123, 321,
        ],
      ]
    ];

    return $data;
  }


  /**
   * @dataProvider calculateWinningRacesDataProvider
   */
  public function testCalculateWinningRaces($time, $distance, $expectedResult)
  {
    $result = calculateWinningRaces($time, $distance);
    $this->assertEquals($expectedResult, $result);
  }

  public static function calculateWinningRacesDataProvider() {
    $data = [];

    $data[] = [
      7,
      9,
      4
    ];

    $data[] = [
      15,
      40,
      8,
    ];

    $data[] = [
      30,
      200,
      9,
    ];

    return $data;
  }


}
