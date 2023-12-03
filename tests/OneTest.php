<?php

namespace Philipnorton42\AdventOfCode2023\Test;

require './1/functions.php';

use PHPUnit\Framework\TestCase;

class OneTest extends TestCase {

  /**
   * @dataProvider partOneDataProvider
   */
  public function testPartOne($string, $expectedResult) {
    $result = findCalibrationNumber($string);
    $this->assertEquals($expectedResult, $result);
  }

  public static function partOneDataProvider() {
    return [
        ['1abc2', 12],
        ['pqr3stu8vwx', 38],
        ['a1b2c3d4e5f', 15],
        ['treb7uchet', 77],
        ['1', 11],
        ['11', 11],
        ['111', 11],
        ['1111', 11],
        ['11111', 11],
        ['111111', 11],
        ['12345', 15],
    ];
  }

  /**
   * @dataProvider partTwoDataProvider
   */
  public function testPartTwo($string, $convertedString, $expectedResult) {
    $string = convertNumber($string);
    $this->assertEquals($convertedString, $string);
    $result = findCalibrationNumber($string);
    $this->assertEquals($expectedResult, $result);
  }

  public static function partTwoDataProvider() {
    return [
      ['two1nine', '219', 29],
      ['eightwothree', '823', 83],
      ['abcone2threexyz', 'abc123xyz', 13],
      ['xtwone3four', 'x2134', 24],
      ['4nineeightseven2', '49872', 42],
      ['zoneight234', 'z18234', 14],
      ['7pqrstsixteen', '7pqrst6teen', 76],
      ['nineight', '98', 98],
      ['fiveight', '58', 58],
      ['threeight', '38', 38],
      ['oneight', '18', 18],
      ['eightwo', '82', 82],
      ['eighthree', '83', 83],
      ['zerone', '1', 11],
      ['twone', '21', 21],
      ['sevenine', '79', 79],
    ];
  }

}