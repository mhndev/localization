<?php
namespace mhndev\localization;

use mhndev\localization\interfaces\iSource;

/**
 * Class SourcePhpArray
 * @package mhndev\localization
 */
class SourcePhpArray implements iSource
{

    /**
     * @var array
     */
    protected $values = [];

    /**
     * SourcePhpArray constructor.
     * @param string $path
     */
    public function __construct($path)
    {
        $this->values = include $path;
    }

    /**
     * @param $key
     * @param array $params
     * @return string
     */
    function get($key, array $params = [])
    {
        $rawValue = $this->values[$key];

        if(!empty($params)){
            $result = _t($rawValue, $params);

        }else{
            $result = $rawValue;
        }

        return $result;
    }
}
