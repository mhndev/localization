<?php
namespace mhndev\localization\interfaces;

/**
 * Interface iTranslator
 * @package mhndev\localization\interfaces
 */
interface iTranslator
{

    /**
     * @param $string
     * @param null $to
     * @param array $params
     * @return string
     */
    function translate($string, $to = null, array $params = []);


    /**
     * @param $language
     * @return boolean
     */
    function languageExist($language);


    /**
     * @return iLanguage
     */
    function getFallbackLanguage();

}
