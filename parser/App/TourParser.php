<?php
declare(strict_types = 1);

/**
 * Class TourParser
 *
 * Parses Tour xml into csv
 *
 * @method $this Title()
 * @method $this Code()
 * @method $this Duration()
 * @method $this Inclusions()
 * @method $this MinPrice()
 * @method $this addTitle()
 * @method $this addCode()
 * @method $this addDuration()
 * @method $this addInclusions()
 *
 * @author Valeriya Slovikovskaya <vslovik@gmail.com>
 */
class TourParser implements TourParserInterface
{
    /**
     * @var SimpleXMLElement
     */
    protected $xml;

    /**
     * @var array
     */
    protected $caption = [];

    /**
     * @var array
     */
    protected $digest = [];

    /**
     * @var bool
     */
    protected $error = false;

    /**
     * @var DepartureParser
     */
    protected $departureParser;

    /**
     * @var Cleaner
     */
    protected $cleaner;

    /**
     * @var Logger
     */
    protected $logger;

    /**
     * @var array
     */
    public static $toClean = [
        'Title',
        'Inclusions'
    ];

    /**
     * @param Cleaner $cleaner
     * @param Logger  $logger
     */
    public function __construct(Cleaner $cleaner, Logger $logger)
    {
        $this->cleaner         = $cleaner;
        $this->logger          = $logger;
    }

    /**
     * @param SimpleXMLElement $xml
     *
     * @return $this
     */
    public function init($xml)
    {
        $this->xml    = $xml;
        $this->digest = [];

        return $this;
    }

    /**
     * @param string $method
     *
     * @return $this
     */
    public function __call($method, $arguments)
    {
        if(0 == strncmp($method, 'add', 3)) {

            $this->digest[] = $this->getProperty(ltrim($method, 'add'));

        } else {

            $this->caption[] = $method;
        }

        return $this;
    }

    /**
     * @param string $name
     *
     * @return string
     */
    protected function getProperty($name)
    {
        if($this->error) {
            return '';
        }

        if(!property_exists($this->xml, $name)){
            $this->logger->log(sprintf('WARNING: Tour node %s missing: %s', $name, $this->xml->asXML()));
            $this->error = true;
            return '';
        }

        if(in_array($name, self::$toClean)) {
            $value = $this->cleaner->clean((string) $this->xml->$name);
        } else {
            $value = (string) $this->xml->$name;
        }

        if('Duration' === $name) {
            $value = (int) $value;
        }

        if(empty($value)) {
            $this->logger->log(sprintf('WARNING: Tour node %s missing or invalid: %s', $name, $this->xml->asXML()));
            $this->error = true;
            return '';
        }

        return $value;
    }

    /**
     * @return $this
     */
    public function addMinPrice()
    {
        if($this->error) {
            return $this;
        }

        if(!property_exists($this->xml, 'DEP')){
            $this->logger->log(sprintf('WARNING: Tour has no DEP nodes: %s', $this->xml->asXML()));
            $this->error = true;

            return $this;
        }

        $prices = [];
        $departureParser = new DepartureParser($this->logger);
        foreach($this->xml->DEP as $departure) {
            $price = $departureParser->init($departure)->price();
            if(false !== $price) {
                $prices[] = $price;
            }
        }

        if(!$prices) {
            $this->logger->log(sprintf('WARNING: Tour has no valid DEP nodes: %s', $this->xml->asXML()));
            $this->error = true;

            return $this;
        }

        $min = 1 == count($prices) ? $prices[0] : min(...$prices);

        $this->digest[] =  $prices ? number_format($min, 2, '.', '') : '';

        return $this;
    }

    /**
     * @return string
     */
    public function caption():string
    {
        return implode('|', $this->caption);
    }

    /**
     * @return string
     */
    public function digest():string
    {
        if($this->error) {
            return '';
        }

        return implode('|', $this->digest);
    }
}