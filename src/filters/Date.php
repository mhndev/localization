<?php
namespace mhndev\localization\filters;

use mhndev\localization\interfaces\iFilter;
use mhndev\localization\libs\IntlDateTime;

/**
 * Class Date
 * @package mhndev\localization\filters
 */
class Date implements iFilter
{

    /**
     * @var string
     */
    protected $name;


    /**
     * Date constructor.
     * @param string $name
     */
    public function __construct($name = 'date')
    {
        $this->name = $name;
    }

    /**
     * @param string $string
     * @param string $locale
     * @param string $format
     *
     * @param null $timezone
     * @return string
     */
    public function translate(
        $string,
        $locale = 'en_US',
        $format = 'E dd LLL yyyy  - H:m',
        $timezone = null
    )
    {
        if(is_null($timezone)){
            $timezone = date_default_timezone_get();
        }

        $date = new IntlDateTime($string, $timezone, locale_to_calender($locale), $locale);

        return $date->format($format);
    }

    /**
     * @return string
     */
    function getName()
    {
        return $this->name;
    }
}
