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
     * @param iSource $source
     * @return $this
     */
    function setSource(iSource $source)
    {
        $this->source = $source;

        return $this;
    }
}
