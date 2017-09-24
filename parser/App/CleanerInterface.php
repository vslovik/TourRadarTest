<?php
/**
 * Interface Cleaner Interface
 *
 * @author Valeriya Slovikovskaya <vslovik@gmail.com>
 */
Interface CleanerInterface
{
    /**
     * @param string $str
     *
     * @return string
     */
    public function clean($str): string;
}