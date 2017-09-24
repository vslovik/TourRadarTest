### Anagrams Detection
An anagram is a type of word play, the result of rearranging the letters of a word or phrase to produce a new word or phrase, using all the original letters and symbols exactly once (except whitespace). For example, "admirer" can be rearranged into "married", "AstroNomers" to "no more stars" (you can see that we ignore capital letters in this task).
In the following task you should implement a function isAnagram($string1, $string2) that returns TRUE if two input strings form anagrams of each other, otherwise FALSE. Also return FALSE in case of invalid inputs. It's allowed to use as many additional functions and structures as needed.

You can put your code directly to the form, or give us GitHub link or any other downloadable URL.

#### Requirements: PHP 7

#### To check for anagrams, run

    $ php ./isAnagrams.php <string1> <string2>  
    
Example:
    
    $ php ./anagrams/isAnagrams.php "Vladimir Nabokov" "Vivian Bloodmark"

#### To run tests

    $ php ./anagrams/test.php


### XML Parser
In the following task you are given an XML text representing set of tours, and you have to convert it into the text in required format.
Write a function xmlToCSV($text) that parses an input text in XML format (presented below) and converts it to the text in delimited format (also presented below). Input XML text contains the elements representing set of tours. Output text represents compressed and simpler form of XML. The code will be tested by an XML with the same format but with more tours and fields.

It's allowed to use as many additional functions and structures as needed. You can put your code directly to the form, but we recommend you to give us GitHub link or any other downloadable URL.

==========================================================
Input format:

    <?xml version="1.0"?>
    <TOURS>
        <TOUR>
            <Title><![CDATA[Anzac &amp; Egypt Combo Tour]]></Title>
            <Code>AE-19</Code>
            <Duration>18</Duration>
            <Start>Istanbul</Start>
            <End>Cairo</End>
            <Inclusions>
                <![CDATA[<div style="margin: 1px 0px; padding: 1px 0px; border: 0px; outline: 0px; font-size: 14px; vertical-align: baseline; text-align: justify; line-height: 19px; color: rgb(6, 119, 179);">The tour price&nbsp; cover the following services: <b style="margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background-color: transparent;">Accommodation</b>; 5, 4&nbsp;and&nbsp;3 star hotels&nbsp;&nbsp;</div>]]>
            </Inclusions>
            <DEP DepartureCode="AN-17" Starts="04/19/2015" GBP="1458" EUR="1724" USD="2350" DISCOUNT="15%" />
            <DEP DepartureCode="AN-18" Starts="04/22/2015" GBP="1558" EUR="1784" USD="2550" DISCOUNT="20%" />
            <DEP DepartureCode="AN-19" Starts="04/25/2015" GBP="1558" EUR="1784" USD="2550" />
        </TOUR>
    </TOURS>

==========================================================
Output format:

    Title|Code|Duration|Inclusions|MinPrice
    Anzac & Egypt Combo Tour|AE-19|18|The tour price cover the following services: Accommodation; 5, 4 and 3 star hotels|1427.20

==========================================================
Output comments:

    "Title" is a string, with html entities (like '&amp;') converted back to symbols
    "Code" is a string
    "Duration" is an integer
    "Inclusions" is a string (just simple text: without html tags, double or triple spaces; with html entities converted back to symbols)
    "MinPrice" is a float with 2 digits after the decimal point; it's the minimal EUR value among all tour departures, taking into account the discount, if presented (for example, if the price is 1724 and the discount is "15%", then the departure price evaluates to 1465.40).

#### To run tests

    $ php ./parser/test.php