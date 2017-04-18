<?php
namespace mhndev\localization;

use mhndev\localization\interfaces\iLanguage;
use mhndev\localization\interfaces\iSource;

/**
 * Class aLanguage
 * @package mhndev\localization
 */
class Language implements iLanguage
{

    /**
     * @var iSource
     */
    protected $source;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $urlCode;

    /**
     * @var string
     */
    protected $countryCode;


    /**
     * @var string
     */
    protected $calender;


    /**
     * Language constructor.
     * @param string $urlCode
     * @param string $countryCode
     * @param string $name
     * @param null | string $calender
     * @param iSource $source
     */
    public function __construct($urlCode, $countryCode, $name, $calender = null, $source = null)
    {
        $this->urlCode = $urlCode;
        $this->countryCode = $countryCode;
        $this->name = $name;
        $this->source = $source;
        $this->calender = $calender;
    }

    /**
     * @param iSource $source
     * @return $this
     */
    function setSource(iSource $source)
    {
        $this->source = $source;

        return $this;
    }

    /**
     * @return boolean
     */
    function hasSource()
    {
        return !empty($this->source);
    }

    /**
     * for example fa | en | de | fr
     * @return string
     */
    function getUrlCode()
    {
        return $this->urlCode;
    }

    /**
     * for example persian | english | dutch
     * @return string
     */
    function getName()
    {
        return $this->name;
    }

    /**
     * @return iSource
     */
    function getSource()
    {
        return $this->source;
    }

    /**
     * for example IR | US | FR
     * @return string
     */
    function getCountryCode()
    {
        return $this->countryCode;
    }

    /**
     * for example persian | gregorian
     * @return null|string
     */
    function getCalender()
    {
        return $this->calender;
    }

    /**
     * @return string
     */
    function getLocale()
    {
        return $this->urlCode.'_'.strtoupper($this->countryCode);
    }

    /**
     * @return mixed
     */
    function getCalendar()
    {
        return $this->calender;
    }
}
