<?php
namespace mhndev\localization;

use mhndev\localization\interfaces\iLanguage;
use mhndev\localization\interfaces\iLanguageRepository;

/**
 * Class aLanguage
 * @package mhndev\localization
 */
class Language implements iLanguage
{

    /**
     * @var iLanguageRepository
     */
    protected $repository;

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
     * Language constructor
     *
     * @param string $urlCode
     * @param string $countryCode
     * @param string $name
     * @param null | string $calender
     * @param iLanguageRepository|null $repository
     */
    public function __construct(
        $urlCode,
        $countryCode,
        $name,
        $calender = null,
        iLanguageRepository $repository = null
    )
    {
        $this->urlCode      = $urlCode;
        $this->countryCode  = $countryCode;
        $this->name         = $name;
        $this->repository   = $repository;
        $this->calender     = $calender;
    }

    /**
     * @param iLanguageRepository $repository
     * @return $this
     */
    function setRepository(iLanguageRepository $repository)
    {
        $this->repository = $repository;

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
     * @return iLanguageRepository
     */
    function getRepository()
    {
        return $this->repository;
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
