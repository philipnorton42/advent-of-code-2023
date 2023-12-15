<?php

namespace Philipnorton42\AdventOfCode2023\Test;

require './15/functions.php';

use PHPUnit\Framework\TestCase;

class FifteenTest extends TestCase
{

  /**
   * @dataProvider extractHashDataDataProvider
   */
  public function testExtractHashData($string, $expectedResult)
  {
    $result = extractHashData($string);
    $this->assertEquals($expectedResult, $result);
  }

  public static function extractHashDataDataProvider()
  {
    $output = [];

    $output[] = [
      "rn=1,cm-,qp=3,cm=2,qp-,pc=4,ot=9,ab=5,pc-,pc=6,ot=7",
      ['rn=1', 'cm-', 'qp=3', 'cm=2', 'qp-', 'pc=4', 'ot=9', 'ab=5', 'pc-', 'pc=6', 'ot=7']
    ];

    return $output;
  }

  /**
   * @dataProvider runHashAlgorithmDataProvider
   */
  public function testRunHashAlgorithm($string, $expectedResult)
  {
    $result = runHashAlogorithm($string);
    $this->assertEquals($expectedResult, $result);
  }

  public static function runHashAlgorithmDataProvider()
  {
    $output = [];

    $output[] = [
      "HASH",
      52
    ];

    $output[] = [
      "rn=1",
      30
    ];

    $output[] = [
      "cm-",
      253
    ];

    return $output;
  }

  /**
   * @dataProvider organiseIntoBoxesDataProvider
   */
  public function testOrganiseIntoBoxes($string, $expectedResult)
  {
    $result = organiseIntoBoxes($string);
    $this->assertEquals($expectedResult, $result);
  }

  public static function organiseIntoBoxesDataProvider()
  {
    $output = [];

    $output[] = [
      ['rn=1', 'cm-', 'qp=3', 'cm=2', 'qp-', 'pc=4', 'ot=9', 'ab=5', 'pc-', 'pc=6', 'ot=7'],
      [
        0 => [
          [
            'label' => 'rn',
            'focal_length' => 1
          ],
          [
            'label' => 'cm',
            'focal_length' => 2
          ],
        ],
        1 => [],
        3 => [
          [
            'label' => 'ot',
            'focal_length' => 7,
          ],
          [
            'label' => 'ab',
            'focal_length' => 5,
          ],
          [
            'label' => 'pc',
            'focal_length' => 6,
          ],
        ],
      ],
    ];

    return $output;
  }


  /**
   * @dataProvider calculateTotalFocusingPowerDataProvider
   */
  public function testCalculateTotalFocusingPower($string, $expectedResult)
  {
    $result = calculateTotalFocusingPower($string);
    $this->assertEquals($expectedResult, $result);
  }

  public static function calculateTotalFocusingPowerDataProvider()
  {
    $output = [];

    $output[] = [
      [
        0 => [
          [
            'label' => 'rn',
            'focal_length' => 1
          ],
          [
            'label' => 'cm',
            'focal_length' => 2
          ],
        ],
        1 => [],
        3 => [
          [
            'label' => 'ot',
            'focal_length' => 7,
          ],
          [
            'label' => 'ab',
            'focal_length' => 5,
          ],
          [
            'label' => 'pc',
            'focal_length' => 6,
          ],
        ],
      ],
      145,
    ];

    return $output;
  }
}