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
     * for example IR | US | FR
     * @return string
     */
    function getCountryCode();

    /**
     * for example persian | english | dutch
     * @return string
     */
    function getName();


    /**
     * @return iSource
     */
    function getSource();


    /**
     * @param iSource $source
     * @return $this
     */
    function setSource(iSource $source);


    /**
     * @return string
     */
    function getLocale();


    /**
     * @return mixed
     */
    function getCalendar();
}
