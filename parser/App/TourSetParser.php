<?php
declare(strict_types = 1);

/**
 * Class TourSetParser
 *
 * Parses tour set from xml to csv
 *
 * @author Valeriya Slovikovskaya <vslovik@gmail.com>
 */
class TourSetParser implements TourSetParserInterface
{
    /**
     * @var Cleaner
     */
    protected $cleaner;

    /**
     * @var Logger
     */
    protected $logger;

    /**
     * TourSetParser constructor.
     *
     * @param Cleaner $cleaner
     * @param Logger $logger
     */
    public function __construct(Cleaner $cleaner, Logger $logger)
    {
        $this->cleaner = $cleaner;
        $this->logger  = $logger;
    }

    /**
     * @return string
     */
    public function xmlToCSV(string $text): string
    {
        if(empty($text)) {
            $this->logger->log('ERROR: Empty input');
            return '';
        }

        $xml = new SimpleXMLElement($text);


        $result = $xml->xpath('//TOURS');

        if(!$result) {
            $this->logger->log('ERROR: Invalid XML');
            return '';
        }

        $tours =  $xml->xpath('//TOUR');

        $tours = array_filter($tours, function($element) {
            return $element instanceof SimpleXMLElement;
        });

        if(!$tours) {
            $this->logger->log('ERROR: No valid tour present');
            return '';
        }

        $caption = (new TourParser($this->cleaner, $this->logger))
            ->Title()
            ->Code()
            ->Duration()
            ->Inclusions()
            ->MinPrice()
            ->caption();

        $tours = array_map(function(SimpleXMLElement $element): string {

            return (new TourParser($this->cleaner, $this->logger))
                ->init($element)
                ->addTitle()
                ->addCode()
                ->addDuration()
                ->addInclusions()
                ->addMinPrice()
                ->digest();

        }, $tours);

        $tours = array_filter($tours, function($line) {
            return !empty($line);
        });

        if(!$tours) {
            $this->logger->log('ERROR: No valid tour present');
            return '';
        }

        return $caption ."\n". implode("\n", $tours);
    }
}