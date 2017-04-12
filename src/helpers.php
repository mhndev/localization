<?php

/**
 * @param $string
 * @param array $parameters
 * @return string
 */
function _t($string, array $parameters = [])
{
    $pattern = '/{{(.*?)}}/';

    $callbackFunction = function ($matches) use ($parameters) {

        $str = $matches[1];
        return $parameters[$str];
    };

    $result = preg_replace_callback($pattern, $callbackFunction, $string);

    return $result;
}



/**
* Returns a locale from a country code that is provided.
*
* @param $country_code  ISO 3166-2-alpha 2 country code
* @param $language_code ISO 639-1-alpha 2 language code
* @returns  a locale, formatted like en_US, or null if not found
/**/
function country_code_to_locale($country_code, $language_code = '')
{
    // Locale list taken from:
    // http://stackoverflow.com/questions/3191664/
    // list-of-all-locales-and-their-short-codes

    $locales = include getcwd().DIRECTORY_SEPARATOR.'src'.DIRECTORY_SEPARATOR.'data'.DIRECTORY_SEPARATOR.'languages.php';

    foreach ($locales as $locale)
    {
        $locale_region = locale_get_region($locale);
        $locale_language = locale_get_primary_language($locale);
        $locale_array = array('language' => $locale_language,
            'region' => $locale_region);

        if (strtoupper($country_code) == $locale_region && $language_code == '') {
            return locale_compose($locale_array);
        }
        elseif (strtoupper($country_code) == $locale_region && strtolower($language_code) == $locale_language) {
            return locale_compose($locale_array);
        }
    }

    return null;
}


/**
 * @param $language_code
 * @return null|string
 */
function language_code_to_locale($language_code)
{
    $locales = include getcwd().DIRECTORY_SEPARATOR.'src'.DIRECTORY_SEPARATOR.'data'.DIRECTORY_SEPARATOR.'languages.php';


    foreach ($locales as $locale)
    {
        $locale_region = locale_get_region($locale);
        $locale_language = locale_get_primary_language($locale);


        $locale_array = array(
            'language' => $locale_language,
            'region' => $locale_region
        );

        if (strtoupper($language_code) == strtoupper($locale_language)) {
            return locale_compose($locale_array);
        }

    }


    return null;
}


/**
 * @param $locale
 * @return string
 */
function locale_to_calender($locale)
{
    switch ($locale){
        case 'fa_IR':
            return 'persian';
        break;


        case 'en_US':
            return 'gregorian';
        break;
    }
}