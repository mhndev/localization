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
     * @param null $to
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
     * @param null $to
     * @return string
     */
    function localizeText($text, $to = null)
    {
        $pattern = '/{{(.*?)}}/';

        $callback = function ($matches) use ($to) {

            $str = $matches[1];

            if(! strpos($str, '|')){
                $result = $this->translate($str, $to);
            }

            else{
                $items = explode('|', $str);
                $str = $items[0];
                $filterName = trim($items[1]);

                $result = FilterFactory::newInstance($filterName)
                    ->translate($str, language_code_to_locale($to));
            }

            return $result;
        };

        return preg_replace_callback($pattern, $callback, $text);
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
     * @param $lang
     * @return iLanguage|null
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
        return new LanguageEnglish();
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
