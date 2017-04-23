<?php
namespace mhndev\localization\interfaces;

/**
 * Interface iLanguageRepository
 * @package mhndev\localization\interfaces
 */
interface iLanguageRepository
{

    /**
     * @param $key
     * @param iLanguage $to
     * @param array $params
     * @return mixed
     */
    function get($key, iLanguage $to, array $params = []);
}
