<?php

///**
// * @param $string
// * @param iLanguage | null $to
// * @param array $parameters
// * @return string
// */
//function _t($string, iLanguage $to = null, array $parameters = [])
//{
//    (new \mhndev\localization\Translator())->translate($string, $to, $parameters);
//}


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
