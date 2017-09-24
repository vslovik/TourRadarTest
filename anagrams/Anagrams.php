<?php
declare(strict_types = 1);

/**
 * Class Anagrams
 *
 * Implements some anagram word game functionality
 *
 * @author Valeriya Slovikovskaya <vslovik@gmail.com>
 */
class Anagrams implements AnagramsInterface
{
    /**
     * @param string[] ...$strings
     *
     * @return bool
     */
    public function isAnagramSoft(...$strings): bool
    {
        try{
            return $this->isAnagram(...$strings);
        } catch(TypeError $e) {
            return false;
        }
    }

    /**
     * @param string[] ...$strings
     *
     * @return bool
     */
    protected function isAnagram(string ...$strings): bool
    {
        array_walk($strings, $this->getCleaner());

        return $this->validate(...$strings) && $this->check($this->getDigestMaker(), ...$strings);
    }

    /**
     * @param string[] ...$strings
     *
     * @return bool
     */
    protected function validate(string ...$strings): bool
    {
        $len = strlen(array_shift($strings));

        if(!$len) {
            return false;
        }

        foreach($strings as $str) {
            if(strlen($str) != $len) {
                return false;
            }
        }

        return true;
    }

    /**
     * @param Closure $digestMaker
     * @param string[] ...$strings
     *
     * @return bool
     */
    protected function check($digestMaker, string ...$strings): bool
    {
        $digest = $digestMaker(array_shift($strings));

        foreach($strings as $str) {
            if(($digestMaker($str) <=> $digest)!== 0) {
                return false;
            }
        }

        return true;
    }

    /**
     * @return Closure
     */
    protected function getDigestMaker(): Closure
    {
        return function(string $str): string {
            $letters = str_split(strtolower($str));
            sort($letters);
            return implode('', $letters);
        };
    }

    /**
     * @return Closure
     */
    protected function getCleaner(): Closure
    {
      return function(string &$str){
          $str = preg_replace('~\s~','', $str);
      };
    }
}