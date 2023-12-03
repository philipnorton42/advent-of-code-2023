<?php

namespace Philipnorton42\AdventOfCode2023\Test;

require './3/functions.php';

use PHPUnit\Framework\TestCase;

class ThreeTest extends TestCase {

  /**
   * @dataProvider extractDataDataProvider
   */
  public function testExtractData($string, $expectedResult) {
    $result = extractData($string);
    $this->assertEquals($expectedResult, $result);
  }

  public static function extractDataDataProvider() {
    $data = [];

    $input1 = <<<EOD
67..1
..*..
.35..
EOD;

    $data[] = [
      $input1,
      [
        ['6', '7', '.', '.', '1'],
        ['.', '.', '*', '.', '.'],
        ['.', '3', '5', '.', '.'],
      ]
    ];

    $input2 = <<<EOD
467..114..
...*......
..35..633.
......#...
617*......
.....+.58.
..592.....
......755.
...$.*....
.664.598..
EOD;

    $data[] = [
      $input2,
      [
        ['4', '6', '7', '.', '.', '1', '1', '4', '.', '.'],
        ['.', '.', '.', '*', '.', '.', '.', '.', '.', '.'],
        ['.', '.', '3', '5', '.', '.', '6', '3', '3', '.'],
        ['.', '.', '.', '.', '.', '.', '#', '.', '.', '.'],
        ['6', '1', '7', '*', '.', '.', '.', '.', '.', '.'],
        ['.', '.', '.', '.', '.', '+', '.', '5', '8', '.'],
        ['.', '.', '5', '9', '2', '.', '.', '.', '.', '.'],
        ['.', '.', '.', '.', '.', '.', '7', '5', '5', '.'],
        ['.', '.', '.', '$', '.', '*', '.', '.', '.', '.'],
        ['.', '6', '6', '4', '.', '5', '9', '8', '.', '.'],
      ]
    ];

    return $data;
  }

  /**
   * @dataProvider extractAdjacentNumbersDataProvider
   */
  public function testExtractAdjacentNumbers($data, $expectedResult, $expectedSum) {
    $result = extractAdjacentNumbers($data);
    $this->assertEquals($expectedResult, $result);
    $this->assertEquals($expectedSum, array_sum($result));
  }

  public static function extractAdjacentNumbersDataProvider() {
    $data = [];

    $data[] = [
      [
        ['6', '7', '.', '.', '1'],
        ['.', '.', '*', '.', '.'],
        ['.', '3', '5', '.', '.'],
      ],
      [67, 35],
      102,
    ];

    $data[] = [
      [
        ['4', '6', '7', '.', '.', '1', '1', '4', '.', '.'],
        ['.', '.', '.', '*', '.', '.', '.', '.', '.', '.'],
        ['.', '.', '3', '5', '.', '.', '6', '3', '3', '.'],
        ['.', '.', '.', '.', '.', '.', '#', '.', '.', '.'],
        ['6', '1', '7', '*', '.', '.', '.', '.', '.', '.'],
        ['.', '.', '.', '.', '.', '+', '.', '5', '8', '.'],
        ['.', '.', '5', '9', '2', '.', '.', '.', '.', '.'],
        ['.', '.', '.', '.', '.', '.', '7', '5', '5', '.'],
        ['.', '.', '.', '$', '.', '*', '.', '.', '.', '.'],
        ['.', '6', '6', '4', '.', '5', '9', '8', '.', '.'],
      ],
      [467, 35, 633, 617, 592, 664, 755, 598],
      4361,
    ];

    $data[] = [
      [
        ['.', '.', '.', '.', '.', '.',],
        ['.', '*', '7', '4', '4', '.',],
        ['.', '.', '.', '.', '.', '.',],
      ],
      [744],
      744,
    ];

    return $data;
  }

  /**
   * @dataProvider extractGearRatioNumbersDataProvider
   */
  public function testExtractGearRatioNumbers($data, $expectedResult) {
    $result = extractGearRatioNumbers($data);
    $this->assertEquals($expectedResult, $result);
    //$this->assertEquals($expectedSum, array_sum($result));
  }

  public static function extractGearRatioNumbersDataProvider()
  {
    $data = [];

    // A single contact means that this isn't a gear ratio, so the resulting
    // array will be empty.
    $data[] = [
      [
        ['.', '.', '.', '.', '.', '.',],
        ['.', '*', '7', '4', '4', '.',],
        ['.', '.', '.', '.', '.', '.',],
      ],
      [],
    ];

    $data[] = [
      [
        ['6', '7', '.', '.', '1'],
        ['.', '.', '*', '.', '.'],
        ['.', '3', '5', '.', '.'],
      ],
      [2345],
    ];

    $data[] = [
      [
        ['6', '7', '.', '.', '1'],
        ['.', '.', '*', '.', '.'],
        ['.', '3', '5', '.', '.'],
      ],
      [2345],
    ];

    $data[] = [
      [
        ['4', '6', '7', '.', '.', '1', '1', '4', '.', '.'],
        ['.', '.', '.', '*', '.', '.', '.', '.', '.', '.'],
        ['.', '.', '3', '5', '.', '.', '6', '3', '3', '.'],
        ['.', '.', '.', '.', '.', '.', '#', '.', '.', '.'],
        ['6', '1', '7', '*', '.', '.', '.', '.', '.', '.'],
        ['.', '.', '.', '.', '.', '+', '.', '5', '8', '.'],
        ['.', '.', '5', '9', '2', '.', '.', '.', '.', '.'],
        ['.', '.', '.', '.', '.', '.', '7', '5', '5', '.'],
        ['.', '.', '.', '$', '.', '*', '.', '.', '.', '.'],
        ['.', '6', '6', '4', '.', '5', '9', '8', '.', '.'],
      ],
      [16345, 451490],
    ];

    return $data;
  }

}