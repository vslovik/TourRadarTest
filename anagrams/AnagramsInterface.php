<?php
/**
 * Interface AnagramInterface
 *
 * @author Valeriya Slovikovskaya <vslovik@gmail.com>
 */
Interface AnagramsInterface {

    /**
     * @param string[] ...$strings
     *
     * @return bool
     */
    public function isAnagramSoft(...$strings): bool;
}