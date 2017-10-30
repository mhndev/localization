<?php
namespace mhndev\localization;

use mhndev\localization\interfaces\iLanguage;

/**
 * Class LanguageFactory
 * @package mhndev\localization
 */
class LanguageFactory
{


    /**
     * @return array
     */
    private static function languages()
    {
        return LanguageLoader::languages();
    }


    /**
     * @param $key
     * @param $value
     * @return Language|null
     */
    private static function from($key, $value)
    {
        foreach (self::languages() as $language) {
            if($language[$key] == $value){
                return new Language(
                    $language['code'],
                    $language['country'],
                    $language['name'],
                    $language['calendar']
                );
            }
        }


        return null;
    }

    /**
     * @param string $name
     * @return iLanguage | null
     */
    public static function fromName($name)
    {
        return self::from('name', $name);
    }


    /**
     * @param string $urlCode
     * @return iLanguage
     */
    public static function fromUrlCode($urlCode)
    {

        return self::from('code', $urlCode);
    }


    /**
     * @param $countryCode
     * @return iLanguage
     */
    public static function fromCountryCode($countryCode)
    {
        return self::from('country', $countryCode);

    }


    /**
     * @param string $calender
     * @return iLanguage
     */
    public static function fromCalender($calender)
    {
        return self::from('calendar', $calender);
    }


    /**
     * @param $locale
     * @return iLanguage
     */
    public static function fromLocale($locale)
    {
        $language_code = substr($locale, 0, 2);
        return self::fromUrlCode($language_code);
    }

}
