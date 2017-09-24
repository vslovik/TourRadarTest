<?php
declare(strict_types = 1);

/**
 * Class Cleaner
 *
 * @author Valeriya Slovikovskaya <vslovik@gmail.com>
 */
class Cleaner implements CleanerInterface
{
    /**
     * @param string $str
     *
     * @return string
     */
    public function clean($str): string
    {
        $str = html_entity_decode(strip_tags($str));
        $str = preg_replace('~\x{00a0}+~siu',' ', $str);
        return trim(preg_replace('~\s+~',' ', $str));
    }
}