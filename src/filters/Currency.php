<?php
namespace mhndev\localization\filters;

use mhndev\localization\interfaces\iFilter;

/**
 * Class Currency
 * @package mhndev\localization\filters
 */
class Currency implements iFilter
{
    /**
     * @var string
     */
    protected $name;


    /**
     * Date constructor.
     * @param string $name
     */
    public function __construct($name = 'currency')
    {
        $this->name = $name;
    }

    /**
     * @param $string
     * @param string $locale
     * @param string $format
     * @return string
     */
    public function translate($string, $locale = 'en_US', $format = '%i')
    {
        setlocale(LC_MONETARY, $locale);

        return money_format($format, $string);
    }

    /**
     * @return string
     */
    function getName()
    {
        return $this->name;
    }
}
