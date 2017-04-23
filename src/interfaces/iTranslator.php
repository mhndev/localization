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
     * @param null | iLanguage $to
     * @param array $params
     * @return string
     */
    function translate($string, iLanguage $to = null, array $params = []);


    /**
     * @param $language
     * @return boolean
     */
    function languageExist($language);


    /**
     * @return iLanguage
     */
    function getFallbackLanguage();


    /**
     * @param string $text
     * @param null | iLanguage $to
     * @param array $params
     * @return string
     */
    function localizeText($text, iLanguage $to = null, array $params = []);
}
