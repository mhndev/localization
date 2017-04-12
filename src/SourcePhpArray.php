<?php
namespace mhndev\localization;

use mhndev\localization\exceptions\PathNotFoundException;
use mhndev\localization\exceptions\TranslationNotFoundException;
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
     * @var string
     */
    protected $path;

    /**
     * SourcePhpArray constructor.
     * @param string $path
     */
    public function __construct($path)
    {
        if(!is_readable($path)){
            throw new PathNotFoundException(sprintf(
               'specified path %s is not readable, may it does\'nt exist and maybe user who php
                process is executing under his/her user has not sufficient (read) permission  on specified path',
                $path
            ));
        }

        $this->path = $path;

        $this->values = include $path;
    }

    /**
     * @param $key
     * @param array $params
     * @return string
     */
    function get($key, array $params = [])
    {
        if(!array_key_exists($key, $this->values)){
            throw new TranslationNotFoundException(sprintf(
                'translation for %s not found in path : %s', $key, $this->path
            ));
        }

        $rawValue = $this->values[$key];

        if(!empty($params)){
            $result = _t($rawValue, $params);

        }else{
            $result = $rawValue;
        }

        return $result;
    }
}
