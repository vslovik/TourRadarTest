<?php
/**
 * @param string $text
 *
 * @return string
 */
function xmlToCsv(string $text): string
{
    return (new TourSetParser(new Cleaner(), new Logger()))->xmlToCSV($text);
}


