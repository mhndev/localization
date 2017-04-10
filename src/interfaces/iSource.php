<?php
namespace mhndev\localization\interfaces;

/**
 * Interface iSource
 * @package mhndev\localization\interfaces
 */
interface iSource
{

    /**
     * @param $key
     * @param array $params
     * @return mixed
     */
    function get($key, array $params = []);
}
