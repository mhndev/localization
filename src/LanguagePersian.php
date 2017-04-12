<?php
namespace mhndev\localization;

use mhndev\localization\interfaces\iLanguage;

/**
 * Class LanguagePersian
 * @package mhndev\localization
 */
class LanguagePersian extends aLanguage implements iLanguage
{

    const name = 'persian';
    const code = 'fa';


    /**
     * LanguageEnglish constructor.
     * @param $name
     * @param $code
     * @param $source
     */
    public function __construct($name = 'persian', $code = 'fa', $source = null)
    {
        $this->name   = $name;
        $this->code   = $code;
        $this->source = $source;
    }


}
