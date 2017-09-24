<?php
/**
 * Interface ParserInterface
 *
 * @author Valeriya Slovikovskaya <vslovik@gmail.com>
 */
Interface TourSetParserInterface
{
    /**
     * @param string $text
     *
     * @return string
     */
    public function xmlToCSV(string $text): string;
}