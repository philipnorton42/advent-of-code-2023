<?php

namespace Philipnorton42\AdventOfCode2023\Test;

require './5/functions.php';

use PHPUnit\Framework\TestCase;

class FiveTest extends TestCase
{

  /**
   * @dataProvider extractSeedDataDataProvider
   */
  public function testExtractSeedData($string, $expectedResult)
  {
    $result = extractSeedData($string);
    $this->assertEquals($expectedResult, $result);
  }

  public static function extractSeedDataDataProvider()
  {
    $data = [];

    $seedData = <<<EOD
seeds: 79 14 55 13

seed-to-soil map:
50 98 2
52 50 2
EOD;


    $data[] = [
      $seedData,
      [
        'seeds' => [79, 14, 55, 13],
        'maps' => [
          'seed-to-soil' => [
            [
              'lower' => 98,
              'upper' => 99,
              'map_start' => 50,
            ],
            [
              'lower' => 50,
              'upper' => 51,
              'map_start' => 52,
            ],
          ],
        ],
      ],
    ];

    $seedData = <<<EOD
seeds: 79 14 55 13

seed-to-soil map:
50 98 2
52 50 48

soil-to-fertilizer map:
0 15 37
37 52 2
39 0 15

fertilizer-to-water map:
49 53 8
0 11 42
42 0 7
57 7 4

water-to-light map:
88 18 7
18 25 70

light-to-temperature map:
45 77 23
81 45 19
68 64 13

temperature-to-humidity map:
0 69 1
1 0 69

humidity-to-location map:
60 56 37
56 93 4
EOD;

    $data[] = [
      $seedData,
      [
        'seeds' => [79, 14, 55, 13],
        'maps' => [
          'seed-to-soil' => [
            [
              'lower' => 98,
              'upper' => 99,
              'map_start' => 50,
            ],
            [
              'lower' => 50,
              'upper' => 97,
              'map_start' => 52,
            ],
          ],
          'soil-to-fertilizer' => [
            [
              'lower' => 15,
              'upper' => 51,
              'map_start' => 0,
            ],
            [
              'lower' => 52,
              'upper' => 53,
              'map_start' => 37,
            ],
            [
              'lower' => 0,
              'upper' => 14,
              'map_start' => 39,
            ],
          ],
          'fertilizer-to-water' => [
            [
              'lower' => 53,
              'upper' => 60,
              'map_start' => 49,
            ],
            [
              'lower' => 11,
              'upper' => 52,
              'map_start' => 0,
            ],
            [
              'lower' => 0,
              'upper' => 6,
              'map_start' => 42,
            ],
            [
              'lower' => 7,
              'upper' => 10,
              'map_start' => 57,
            ],
          ],
          'water-to-light' => [
            [
              'lower' => 18,
              'upper' => 24,
              'map_start' => 88,
            ],
            [
              'lower' => 25,
              'upper' => 94,
              'map_start' => 18,
            ],
          ],
          'light-to-temperature' => [
            [
              'lower' => 77,
              'upper' => 99,
              'map_start' => 45,
            ],
            [
              'lower' => 45,
              'upper' => 63,
              'map_start' => 81,
            ],
            [
              'lower' => 64,
              'upper' => 76,
              'map_start' => 68,
            ],
          ],
          'temperature-to-humidity' => [
            [
              'lower' => 69,
              'upper' => 69,
              'map_start' => 0,
            ],
            [
              'lower' => 0,
              'upper' => 68,
              'map_start' => 1,
            ],
          ],
          'humidity-to-location' => [
            [
              'lower' => 56,
              'upper' => 92,
              'map_start' => 60,
            ],
            [
              'lower' => 93,
              'upper' => 96,
              'map_start' => 56,
            ],
          ],
        ],
      ],
    ];

    return $data;
  }


  /**
   * @dataProvider findLocationForSeedDataProvider
   */
  public function testFindLocationForSeed($map, $seed, $expectedResult)
  {
    $result = findLocationForSeed($map, $seed);
    $this->assertEquals($expectedResult, $result);
  }

  public static function findLocationForSeedDataProvider()
  {
    $maps = [

      'seed-to-soil' => [
        [
          'lower' => 98,
          'upper' => 99,
          'map_start' => 50,
        ],
        [
          'lower' => 50,
          'upper' => 97,
          'map_start' => 52,
        ],
      ],
      'soil-to-fertilizer' => [
        [
          'lower' => 15,
          'upper' => 51,
          'map_start' => 0,
        ],
        [
          'lower' => 52,
          'upper' => 53,
          'map_start' => 37,
        ],
        [
          'lower' => 0,
          'upper' => 14,
          'map_start' => 39,
        ],
      ],
      'fertilizer-to-water' => [
        [
          'lower' => 53,
          'upper' => 60,
          'map_start' => 49,
        ],
        [
          'lower' => 11,
          'upper' => 52,
          'map_start' => 0,
        ],
        [
          'lower' => 0,
          'upper' => 6,
          'map_start' => 42,
        ],
        [
          'lower' => 7,
          'upper' => 10,
          'map_start' => 57,
        ],
      ],
      'water-to-light' => [
        [
          'lower' => 18,
          'upper' => 24,
          'map_start' => 88,
        ],
        [
          'lower' => 25,
          'upper' => 93,
          'map_start' => 18,
        ],
      ],
      'light-to-temperature' => [
        [
          'lower' => 77,
          'upper' => 99,
          'map_start' => 45,
        ],
        [
          'lower' => 45,
          'upper' => 63,
          'map_start' => 81,
        ],
        [
          'lower' => 64,
          'upper' => 76,
          'map_start' => 68,
        ],
      ],
      'temperature-to-humidity' => [
        [
          'lower' => 69,
          'upper' => 69,
          'map_start' => 0,
        ],
        [
          'lower' => 0,
          'upper' => 68,
          'map_start' => 1,
        ],
      ],
      'humidity-to-location' => [
        [
          'lower' => 56,
          'upper' => 92,
          'map_start' => 60,
        ],
        [
          'lower' => 93,
          'upper' => 96,
          'map_start' => 56,
        ],
      ],
    ];

    $data = [];

    $data[] = [
      $maps,
      79,
      82,
    ];

    $data[] = [
      $maps,
      14,
      43,
    ];

    $data[] = [
      $maps,
      55,
      86,
    ];

    $data[] = [
      $maps,
      13,
      35,
    ];

    return $data;

  }

}
