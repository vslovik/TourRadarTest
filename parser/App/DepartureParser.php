<?php
declare(strict_types = 1);

/**
 * Class DepartureParser
 *
 * Parses single tour xml into csv
 *
 * @author Valeriya Slovikovskaya <vslovik@gmail.com>
 */
class DepartureParser implements DepartureParserInterface
{
    /**
     * @var Logger
     */
    protected $logger;

    /**
     * @var SimpleXMLElement
     */
    protected $xml;


    /**
     * @param Logger $logger
     */
    public function __construct(Logger $logger)
    {
        $this->logger  = $logger;
    }

    /**
     * @param SimpleXMLElement $xml
     *
     * @return $this
     */
    public function init(SimpleXMLElement $xml)
    {
        $this->xml = $xml;

        return $this;
    }

    /**
     * @return float|bool
     */
    public function price()
    {
        $price    = null;
        $discount = null;

        $attributes = (array) $this->xml->attributes();
        $attributes = current($attributes);

        if(!$attributes) {
            $this->logger->log(sprintf('Invalid departure node: no attributes present: %s', $this->xml->asXML()));
            return false;
        }

        if(!array_key_exists('EUR', $attributes)) {
            $this->logger->log(sprintf('Departure EUR attribute missing: %s', $this->xml->asXML()));
            return false;
        }

        if(!preg_match('~[0-9.]+~', $attributes['EUR'])) {
            $this->logger->log(sprintf('Departure price in EUR invalid: %s', $this->xml->asXML()));
            return false;
        }

        $price = (float) $attributes['EUR'];

        if(array_key_exists('DISCOUNT', $attributes)) {
            $discount = (float) rtrim((string) $attributes['DISCOUNT'], '%');
        }

        return $discount ? $price * (1. - $discount / 100.) : $price;
    }
}