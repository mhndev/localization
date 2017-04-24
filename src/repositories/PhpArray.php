<?php
namespace mhndev\localization\repositories;

use mhndev\localization\exceptions\PathNotFoundException;
use mhndev\localization\exceptions\TranslationNotFoundException;
use mhndev\localization\interfaces\iLanguage;
use mhndev\localization\interfaces\iLanguageRepository;

/**
 * Class SourcePhpArray
 * @package mhndev\localization
 */
class PhpArray implements iLanguageRepository
{

    /**
     * @var array
     */
    protected $values = [];

    /**
     * @var string
     */
    protected $path;

    /**
     * SourcePhpArray constructor.
     * @param string $path
     */
    public function __construct($path)
    {
        if(!is_readable($path)){
            throw new PathNotFoundException(sprintf(
               'specified path %s is not readable, may it does\'nt exist and maybe user who php
                process is executing under his/her user has not sufficient (read) permission  on specified path',
                $path
            ));
        }

        $this->path = $path;

        $this->values = include $path;
    }

    /**
     * @param $key
     * @param iLanguage $to
     * @param array $params
     * @param bool $throwException
     * @return string
     */
    function get($key, iLanguage $to, array $params = [], $throwException = false)
    {
        if(!array_key_exists($key, $this->values)){

            if($throwException){
                throw new TranslationNotFoundException(sprintf(
                    'translation for %s not found in path : %s',
                    $key,
                    $this->path
                ));

            }else{
                return $key;
            }

        }

        return $this->values[$key];
    }

}
