<?php

/**
 * Class AnagramTests
 *
 * Runs series of test of isAnagram function
 *
 * @author Valeriya Slovikovskaya <vslovik@gmail.com>
 */
class AnagramsTests {

    const FAIL_MSG = 'FAIL';
    const PASS_MSG = 'PASS';

    /**
     * @var array
     */
    public static $samples = [
        [123, 231, false, 'Invalid input'],
        [null, 'blabla', false, 'Invalid input'],
        [[], 'blabla', false, 'Invalid input'],
        ['', '', false, 'Empty strings are not allowed'],
        ['a', '', false, 'Empty strings are not allowed'],
        ['', 'a', false, 'Empty strings are not allowed'],
        ['aa', 'a', false, 'Input strings have different lengths'],
        ['aa', 'a ', false, 'Input strings have different lengths'],
        ['bb', 'aa', false, 'Not anagrams'],
        ['a a ', 'a a', true, 'TourSetParser'],
        ['a a a', "a       a\ta", true, 'TourSetParser'],
        ['Arrigo Boito', 'Tobia Gorrio', true, 'TourSetParser'],
        ['Edward Gorey', 'Ogdred Weary', true, 'TourSetParser'],
        ['Regera Dowdy', 'E G Deadworry', true, 'TourSetParser'],
        ['Vladimir Nabokov', 'Vivian Darkbloom', true, 'TourSetParser'],
        ['Vladimir Nabokov', 'Vivian Bloodmark', true, 'TourSetParser'],
        ['Vladimir Nabokov', 'Blavdak Vinomori', true, 'TourSetParser'],
        ['Vladimir Nabokov', 'Dorian Vivalkomb', true, 'TourSetParser'],
        ['Ted Morgan', 'de Gramont', true, 'TourSetParser'],
        ['Dave Barry', 'Ray Adverb', true, 'TourSetParser'],
        ['Glen Duncan', 'Declan Gunn', true, 'TourSetParser'],
        ['Damon Albarn', 'Dan Abnormal', true, 'TourSetParser'],
        ['Anna Madrigal', 'A man and a girl', true, 'TourSetParser'],
        ['Tom Marvolo Riddle', 'I am Lord Voldemort', true, 'TourSetParser'],
        ['Buckethead', 'Death Cube K', true, 'TourSetParser'],
        ['Daniel Clowes', 'Enid Coleslaw', true, 'TourSetParser'],
        ['Siobhan Donaghy', 'Shanghai Nobody', true, 'TourSetParser'],
        ['rail safety', 'fairy tales', true, 'TourSetParser'],
        ['eleven plus two', 'twelve plus one', true, 'TourSetParser'],
        ['William Shakespeare', 'I am a weakish speller', true, 'TourSetParser'],
        ['Madam Curie', 'Radium came', true, 'TourSetParser'],
        ['TourSetParser', 'Ars magna', true, 'TourSetParser'],
        ['Ave Maria, gratia plena, Dominus tecum', 'Virgo serena, pia, munda et immaculata', true, 'TourSetParser'],
        ['Quid est veritas', 'Est vir qui adest', true, 'TourSetParser'],
        ['Thomas Egerton', 'gestat honorem', true, 'TourSetParser'],
        ['James Stuart', 'a just master', true, 'TourSetParser'],
        ['Eleanor Audeley', 'Reveale O Daniel', false, 'Not anagrams'],
        ['Dame Eleanor Davies', 'Never soe mad a ladie', true, 'TourSetParser'],
        ['Horatio Nelson', 'Honor est a Nilo', true, 'TourSetParser'],
        ['Florence Nightingale', 'Flit on cheering angel', true, 'TourSetParser'],
        ['Avida Dollars', 'Salvador Dali', true, 'TourSetParser'],
        ['smaismrmilmepoetaleumibunenugttauiras', 'Altissimum planetam tergeminum observavi', false, 'Not anagrams'],
        ['Nessiteras rhombopteryx', 'Monster hoax by Sir Peter S', true, 'TourSetParser'],
        ['Calvinus', 'Alcuinus', false, 'Not anagrams'],
        ['Neat', 'a net', true, 'TourSetParser'],
        ['admirer', 'married', true, 'TourSetParser'],
        ['AstroNomers', 'no more stars', true, 'TourSetParser']
    ];

    /**
     * @return void
     */
    public function run()
    {
        foreach(self::$samples  as $sample) {

            list($string1, $string2, $expected, $description) = $sample;
            $result = $expected == isAnagram($string1, $string2) ? self::PASS_MSG : self::FAIL_MSG;
            echo sprintf("1: %s\n2: %s\n%s: %s\n\n", $string1, $string2, $result, $description);

        }
    }
}