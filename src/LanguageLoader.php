<?php
namespace mhndev\localization;

/**
 * Class LanguageLoader
 * @package mhndev\localization
 */
class LanguageLoader
{
    /**
     * @var null|string
     */
    protected static $path = '';

    /**
     * @var array
     */
    protected static $languages = [];


    /**
     * LanguageLoader constructor.
     * @param null $path
     */
    public function __construct($path = null)
    {
        self::$path = $path ?? dirname(__FILE__).DIRECTORY_SEPARATOR.'locales.php';

        self::$languages =  include self::$path;
    }

    /**
     * @return array
     */
    public static function languages()
    {
        if(empty(self::$path)){
            self::$path = dirname(__FILE__).DIRECTORY_SEPARATOR.'locales.php';
        }

        if(empty(self::$languages)){
            self::$languages =  include self::$path;
        }

        return self::$languages;
    }

}
