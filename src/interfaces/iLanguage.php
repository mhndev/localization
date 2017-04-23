<?php
namespace mhndev\localization\interfaces;

/**
 * Interface iLanguage
 * @package mhndev\localization\interfaces
 */
interface iLanguage
{

    /**
     * for example fa | en | de | fr
     * @return string
     */
    function getUrlCode();

    /**
     * e.g. IR | US | FR
     * @return string
     */
    function getCountryCode();

    /**
     * e.g. persian | english | dutch
     * @return string
     */
    function getName();


    /**
     * @return iLanguageRepository
     */
    function getRepository();


    /**
     * @param iLanguageRepository $source
     * @return $this
     */
    function setRepository(iLanguageRepository $source);


    /**
     * e.g. fa_IR | en_US
     * @return string
     */
    function getLocale();


    /**
     * e.g. persian | gregorian
     * @return string
     */
    function getCalendar();
}
