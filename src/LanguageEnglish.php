<?php
namespace mhndev\localization;

use mhndev\localization\interfaces\iLanguage;

/**
 * Class LanguageEnglish
 * @package mhndev\localization
 */
class LanguageEnglish extends aLanguage implements iLanguage
{

    const name = 'english';
    const code = 'en';


    /**
     * LanguageEnglish constructor.
     * @param $name
     * @param $code
     * @param $source
     */
    public function __construct($name = 'english', $code = 'en', $source = null)
    {
        $this->name   = $name;
        $this->code   = $code;
        $this->source = $source;
    }


}
