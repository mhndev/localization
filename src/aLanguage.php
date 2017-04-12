<?php
namespace mhndev\localization;

use mhndev\localization\interfaces\iSource;

/**
 * Class aLanguage
 * @package mhndev\localization
 */
class aLanguage
{

    /**
     * @var iSource
     */
    protected $source;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $code;


    /**
     * @param iSource $source
     * @return $this
     */
    function setSource(iSource $source)
    {
        $this->source = $source;

        return $this;
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
