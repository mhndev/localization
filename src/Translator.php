<?php
namespace mhndev\localization;

use mhndev\localization\exceptions\LanguageNotFoundException;
use mhndev\localization\exceptions\ParameterNotFoundException;
use mhndev\localization\exceptions\RepositoryNotFoundException;
use mhndev\localization\filters\FilterFactory;
use mhndev\localization\interfaces\iLanguage;
use mhndev\localization\interfaces\iTranslator;

/**
 * Class Translator
 * @package mhndev\localization
 */
class Translator implements iTranslator
{

    /**
     * @var array
     */
    protected $languages = [];


    /**
     * @var iLanguage
     */
    protected $fallbackLanguage = null;


    /**
     * @param $string
     * @param null | iLanguage $to
     * @param array $params
     * @return string
     * @throws LanguageNotFoundException
     * @throws RepositoryNotFoundException
     */
    function translate($string, iLanguage $to = null, array $params = [])
    {
        if(is_null($to)){
            $to = $this->getFallbackLanguage();
        }

        $language = $this->getLanguage($to->getName());

        if(empty($language)){
            throw new LanguageNotFoundException(sprintf(
                'language %s not found in registered languages',
                $to->getName()
            ));
        }

        $repository = $language->getRepository();

        if(empty($repository)){
            throw new RepositoryNotFoundException(sprintf(
               'repository not found for %s language',
                $language->getName()
            ));
        }

        $stringToBeTranslated = $repository->get($string, $to, $params, $throwException = false);

        return $this->translateString($stringToBeTranslated, $params, $throwException);
    }

    /**
     * @param $string
     * @param array $parameters
     * @param bool $throwExceptionOnParamNotFound
     * @return string
     */
    public function translateString(
        $string,
        array $parameters = [],
        $throwExceptionOnParamNotFound = false
    )
    {
        $pattern = '/{{(.*?)}}/';

        $callbackFunction = function ($matches) use ($parameters, $throwExceptionOnParamNotFound) {

            $str = $matches[1];

            if(empty($parameters[$str])){

                if($throwExceptionOnParamNotFound){
                    throw new ParameterNotFoundException(
                        sprintf(
                            'parameter %s not found in %s,',
                            $str,
                            json_encode($parameters)
                        )
                    );
                }else{
                    return $str;
                }

            }else{
                return $parameters[$str];
            }
        };

        $result = preg_replace_callback($pattern, $callbackFunction, $string);

        return $result;
    }

    /**
     * @param string $text
     * @param null | iLanguage $to
     * @param array $params
     * @return string
     */
    function localizeText($text, iLanguage $to = null, array $params = [])
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
        if(empty($this->fallbackLanguage) ){
            $this->fallbackLanguage = LanguageFactory::fromUrlCode('en');
        }

        return $this->fallbackLanguage;
    }


    /**
     * @param iLanguage $language
     * @return $this
     */
    function setFallbackLanguage(iLanguage $language)
    {
        $this->fallbackLanguage = $language;

        return $this;
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
