<?php
namespace mhndev\localization\interfaces;

/**
 * Interface iFilter
 * @package mhndev\localization\interfaces
 */
interface iFilter
{

    /**
     * @return string
     */
    function getName();

    /**
     * @param $string
     * @return string
     */
    function translate($string);
}
