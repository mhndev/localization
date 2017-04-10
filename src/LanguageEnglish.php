<?php
namespace mhndev\localization;

use mhndev\localization\interfaces\iLanguage;
use mhndev\localization\interfaces\iSource;

/**
 * Class LanguageEnglish
 * @package mhndev\localization
 */
class LanguageEnglish extends aLanguage implements iLanguage
{

    const name = 'english';
    const code = 'en';


    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $code;

    /**
     * @var iSource
     */
    protected $source;

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


    /**
     * for example fa | en | de | fr
     * @return string
     */
    function getUrlCode()
    {
        return $this->code;
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

}
