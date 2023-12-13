<?php

require './10/functions.php';

$data = file_get_contents('./10/10.data');

$data = extractPipeData($data);

$length = findInternalVolume($data);

echo 'Total: ' . $length . PHP_EOL;


// 164 too low