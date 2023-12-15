<?php

require './15/functions.php';

$data = file_get_contents('./15/15.data');

$strings = extractHashData($data);

$boxes = organiseIntoBoxes($strings);

$total = calculateTotalFocusingPower($boxes);

echo 'Total: ' . $total . PHP_EOL;
