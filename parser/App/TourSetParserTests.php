<?php

/**
 * Class TourSetParser Tests
 *
 * Runs series of test of TourSetParser function
 *
 * @author Valeriya Slovikovskaya <vslovik@gmail.com>
 */
class TourSetParserTests
{
    /**
     * @return void
     */
    public function run()
    {
        $path = __DIR__ . DIRECTORY_SEPARATOR . '../data' . DIRECTORY_SEPARATOR . 'tours.xml';

        $xml = file_get_contents($path);

        $csv = xmlToCSV($xml);

        echo $csv . "\n";

        $expected = "Title|Code|Duration|Inclusions|MinPrice\n"
                    . "Anzac & Egypt Combo Tour|AE-19|18|The tour price cover the following services: Accommodation; 5, 4 and 3 star hotels|1427.20";

        echo $csv == $expected ? "PASS\n" : "FAIL\n";
    }
}