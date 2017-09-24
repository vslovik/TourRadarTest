#!/usr/bin/php
<?php

require('autoloader.php');

array_shift($argv);

if(count($argv) < 2) {
    echo "isAnagrams command expects two parameters\n";
    echo "Usage: $ php ./isAnagrams.php <string1> <string2>\n";
}

$result = isAnagram(...$argv);

echo $result
    ? sprintf("\n\"%s\" are anagrams\n\n", implode('" and "', $argv))
    : sprintf("\n\"%s\" are not anagrams\n\n", implode('" and "', $argv));
