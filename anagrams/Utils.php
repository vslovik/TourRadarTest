<?php
/**
 * @param string $string1
 * @param string $string2
 *
 * @return bool
 */
function isAnagram($string1, $string2)
{
    return (new Anagrams())->isAnagramSoft($string1, $string2);
}