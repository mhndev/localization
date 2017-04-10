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
     * for example persian | english | dutch
     * @return string
     */
    function getName();


    /**
     * @return iSource
     */
    function getSource();
}
