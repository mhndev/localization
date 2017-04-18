<?php
namespace mhndev\localization\filters;

use mhndev\localization\interfaces\iFilter;
use mhndev\localization\LanguageFactory;
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
     * @param array $options
     * @return string
     */
    public function translate($string, array $options = [])
    {
        if(empty($options['language'])) {
            $options['language'] = LanguageFactory::fromUrlCode('en');
        }

        if(empty($options['format'])) {
            $options['format'] = 'E dd LLL yyyy  - H:m';
        }

        if(empty($options['timezone'] )) {
            $options['timezone'] = date_default_timezone_get();
        }

        $date = new IntlDateTime(
            $string,
            $options['timezone'],
            $options['language']->getCalendar(),
            $options['language']->getLocale()
        );

        return $date->format($options['format']);
    }

    /**
     * @return string
     */
    function getName()
    {
        return $this->name;
    }
}
