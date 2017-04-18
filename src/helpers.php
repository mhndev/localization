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
 * @param $object
 * @param array $items
 * @return bool
 */
function delByValue($object, array $items)
{
    if(($key = array_search($object, $items, true)) !== FALSE) {
        unset($this->items[$key]);
        return true;
    }

    return false;
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


function locale_to_name($locale)
{

    return '';
}


function getLocales()
{
    return [];
}


function getLangs()
{
    return [];
}

function Countries()
{
    return [];
}


/**
 * @param \Psr\Http\Message\RequestInterface $request
 * @param string $default
 * @return \Psr\Http\Message\RequestInterface
 * @throws Exception
 */
function langFromRequest(\Psr\Http\Message\RequestInterface $request, $default)
{
    $lang = '';

    $virtualPath = $request->getUri()->getPath();

    $pathChunk = explode("/",$virtualPath);

    parse_str($request->getUri()->getQuery(), $params);


    //first user language detection solution : path
    if(count($pathChunk) > 1 && in_array($pathChunk[1], getLangs())) {
        $lang = $pathChunk[1];
    }

    //second user language detection solution : http header accept-language
    elseif ($request->hasHeader('Accept-Language')){
        $language = $request->getHeaderLine('Accept-Language');

        if (!extension_loaded('intl')) {
            throw new \Exception('intl extension is not installed');
        }

        $locale = Locale::acceptFromHttp($language);
        $lang = substr($locale, 0, 2);

    }

    //third user language detection solution : query parameter
    elseif (!empty($params['lang'])){
        $lang = $params['lang'];
    }

    //fourth user language detection solution : fallback (default) language
    else{
        $lang = $default;
    }

    return $lang;
}
