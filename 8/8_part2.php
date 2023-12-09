<?php

require './8/functions.php';

$data = file_get_contents('./8/8.data');

$data = extractNetworkData($data);

$steps = simultaneouslyTraverseGraph($data);

echo 'Steps: ' . $steps . PHP_EOL;