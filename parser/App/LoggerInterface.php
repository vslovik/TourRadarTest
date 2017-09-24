<?php
/**
 * Interface Logger Interface
 *
 * @author Valeriya Slovikovskaya <vslovik@gmail.com>
 */
Interface LoggerInterface
{
    /**
     * @param string $str
     *
     * @return string
     */
    public function log($str);
}