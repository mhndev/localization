<?php
namespace mhndev\localization\filters;

use mhndev\localization\exceptions\FilterNotFoundException;
use mhndev\localization\exceptions\InvalidArgumentException;
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
     * @throws FilterNotFoundException
     */
    static function newInstance($filterName)
    {
        $className = '\mhndev\localization\filters\\'.ucfirst($filterName);

        if(empty($filterName)){
            throw new InvalidArgumentException(sprintf('filter name cannot be empty'));
        }

        if(! class_exists($className)){
            throw new FilterNotFoundException(sprintf('filter %s not found.', $filterName));
        }

        return new $className();
    }
}
