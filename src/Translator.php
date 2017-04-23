<?php
namespace mhndev\localization;

use mhndev\localization\filters\FilterFactory;
use mhndev\localization\interfaces\iLanguage;
use mhndev\localization\interfaces\iSource;
use mhndev\localization\interfaces\iTranslator;

/**
 * Class Translator
 * @package mhndev\localization
 */
class Translator implements iTranslator
{

    /**
     * @var iSource
     */
    protected $source;

    /**
     * @var array of iLanguage
     */
    protected $languages;


    /**
     * TranslatorPhpArray constructor.
     * @param array $languages
     */
    public function __construct($languages = [])
    {
        $this->languages = $languages;
    }

    /**
     * @param $string
     * @param null | iLanguage $to
     * @param array $params
     * @return string
     */
    function translate($string, $to = null, array $params = [])
    {
        if(is_null($to)){
            $to = $this->getFallbackLanguage();
        }

        return $this->getLanguage($to)->getSource()->get($string, $params);
    }


    /**
     * @param string $text
     * @param null | iLanguage $to
     * @param array $params
     * @return string
     */
    function localizeText($text, iLanguage $to = null, array $params)
    {
        if(is_null($to)){
            $to = $this->getFallbackLanguage();
        }
        $pattern = '/{{(.*?)}}/';

        $callback = function ($matches) use ($to, $params) {
            $str = $matches[1];
            if(! strpos($str, '|') ) {
                $result = $this->translate($str, $to, $params);
            } else{
                $result = $this->applyFilter($str, $to);
            }
            return $result;
        };

        return preg_replace_callback($pattern, $callback, $text);
    }


    /**
     * @param $str
     * @param iLanguage $to
     * @return string
     */
    public function applyFilter($str, iLanguage $to)
    {
        $items = explode('|', $str);
        $str = $items[0];
        $filterName = trim($items[1]);

        $options = [ 'language' => $to ];
        $filter = FilterFactory::newInstance($filterName);

        $result = $filter->translate($str, $options);

        return $result;
    }




    /**
     * @param string $name
     * @return boolean
     */
    public function languageExist($name)
    {
        /** @var iLanguage $language */
        foreach ($this->languages as $language){
            if($language->getName() == $name || $language->getUrlCode() == $name){
                return true;
            }
        }

        return false;
    }


    /**
     * @param string $lang
     * @return iLanguage
     */
    public function getLanguage($lang)
    {
        /** @var iLanguage $language */
        foreach ($this->languages as $language){
            if($language->getName() == $lang || $language->getUrlCode() == $lang){
                return $language;
            }
        }

        return null;
    }


    /**
     * @return iLanguage
     */
    function getFallbackLanguage()
    {
        return LanguageFactory::fromUrlCode('en');
    }


    /**
     * @param iLanguage $language
     * @return $this
     */
    function addLanguage(iLanguage $language)
    {
        $this->languages[] = $language;

        return $this;
    }

}
