<?php
namespace mhndev\localization\filters;

use mhndev\localization\interfaces\iFilter;

/**
 * Class FilterFactory
 * @package mhndev\localization\filters
 */
class FilterFactory
{

    /**
     * @param string $filterName
     * @return iFilter
     */
    static function newInstance($filterName)
    {
        $className = '\mhndev\localization\filters\\'.ucfirst($filterName);

        return new $className();
    }
}
