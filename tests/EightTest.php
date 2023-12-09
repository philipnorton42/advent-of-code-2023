<?php

namespace Philipnorton42\AdventOfCode2023\Test;

require './8/functions.php';

use PHPUnit\Framework\TestCase;

class EightTest extends TestCase
{

  /**
   * @dataProvider extractNetworkDataDataProvider
   */
  public function testExtractNetworkData($string, $expectedResult)
  {
    $result = extractNetworkData($string);
    $this->assertEquals($expectedResult, $result);
  }

  public static function extractNetworkDataDataProvider()
  {
    $data = [];

    $inputString1 = <<<EOD
RL

AAA = (BBB, CCC)
BBB = (DDD, EEE)
CCC = (ZZZ, GGG)
DDD = (DDD, DDD)
EEE = (EEE, EEE)
GGG = (GGG, GGG)
ZZZ = (ZZZ, ZZZ)
EOD;

    $data[] = [
      $inputString1,
      [
        'directions' => ['R', 'L'],
        'nodes' => [
          'AAA' => ['BBB', 'CCC'],
          'BBB' => ['DDD', 'EEE'],
          'CCC' => ['ZZZ', 'GGG'],
          'DDD' => ['DDD', 'DDD'],
          'EEE' => ['EEE', 'EEE'],
          'GGG' => ['GGG', 'GGG'],
          'ZZZ' => ['ZZZ', 'ZZZ'],
        ],
      ]
    ];

    $inputString2 = <<<EOD
LLR

AAA = (BBB, BBB)
BBB = (AAA, ZZZ)
ZZZ = (ZZZ, ZZZ)
EOD;

    $data[] = [
      $inputString2,
      [
        'directions' => ['L', 'L', 'R'],
        'nodes' => [
          'AAA' => ['BBB', 'BBB'],
          'BBB' => ['AAA', 'ZZZ'],
          'ZZZ' => ['ZZZ', 'ZZZ'],
        ],
      ]
    ];

    return $data;
  }

  /**
   * @dataProvider traverseGraphDataProvider
   */
  public function testTraverseGraph($data, $expectedSteps)
  {
    $result = traverseGraph($data);
    $this->assertEquals($expectedSteps, $result);
  }

  public static function traverseGraphDataProvider()
  {
    $data = [];

    $data[] = [
      [
        'directions' => ['R', 'L'],
        'nodes' => [
          'AAA' => ['BBB', 'CCC'],
          'BBB' => ['DDD', 'EEE'],
          'CCC' => ['ZZZ', 'GGG'],
          'DDD' => ['DDD', 'DDD'],
          'EEE' => ['EEE', 'EEE'],
          'GGG' => ['GGG', 'GGG'],
          'ZZZ' => ['ZZZ', 'ZZZ'],
        ],
      ],
      2,
    ];

    $data[] = [
      [
        'directions' => ['L', 'L', 'R'],
        'nodes' => [
          'AAA' => ['BBB', 'BBB'],
          'BBB' => ['AAA', 'ZZZ'],
          'ZZZ' => ['ZZZ', 'ZZZ'],
        ],
      ],
      6,
    ];

    return $data;
  }


  /**
   * @dataProvider simultaneouslyTraverseGraphDataProvider
   */
  public function testSimultaneouslyTraverseGraph($data, $expectedSteps)
  {
    $result = simultaneouslyTraverseGraph($data);
    $this->assertEquals($expectedSteps, $result);
  }

  public static function simultaneouslyTraverseGraphDataProvider()
  {
    $data = [];

    $data[] = [
      [
        'directions' => ['L', 'R'],
        'nodes' => [
          '11A' => ['11B', 'XXX'],
          '11B' => ['XXX', '11Z'],
          '11Z' => ['11B', 'XXX'],
          '22A' => ['22B', 'XXX'],
          '22B' => ['22C', '22C'],
          '22C' => ['22Z', '22Z'],
          '22Z' => ['22B', '22B'],
          'XXX' => ['XXX', 'XXX'],
        ],
      ],
      6,
    ];

    return $data;
  }
}
