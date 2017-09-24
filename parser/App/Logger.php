<?php
declare(strict_types = 1);

/**
 * Class Logger
 *
 * @author Valeriya Slovikovskaya <vslovik@gmail.com>
 */
class Logger implements LoggerInterface
{
    /**
     * @param string $str
     *
     * @return void
     */
    public function log($str)
    {
        echo $str . "\n";
    }
}