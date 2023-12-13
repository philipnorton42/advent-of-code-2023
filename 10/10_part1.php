<?php

require './10/functions.php';

$data = file_get_contents('./10/10.data');

$data = extractPipeData($data);

$length = getHalfLoopLength($data);

echo 'Total: ' . $length . PHP_EOL;
