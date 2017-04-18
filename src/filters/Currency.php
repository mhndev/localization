<?php
namespace mhndev\localization\filters;

use mhndev\localization\exceptions\InvalidArgumentException;
use mhndev\localization\interfaces\iFilter;
use mhndev\localization\interfaces\iLanguage;

/**
 * Class Currency
 * @package mhndev\localization\filters
 */
class Currency implements iFilter
{
    /**
     * @var string
     */
    protected $name;


    /**
     * Date constructor.
     * @param string $name
     */
    public function __construct($name = 'currency')
    {
        $this->name = $name;
    }

    /**
     * @param $string
     * @param array $options
     * @return string
     */
    public function translate($string, array $options = [])
    {
        /** @var iLanguage $lang */
        if(empty($lang = $options['language']) ){
            throw new InvalidArgumentException(sprintf(
                'language option is needed'
            ));
        }

        if(empty($options['format'])){
            $options['format'] = '%i';
        }

        setlocale(LC_MONETARY, $lang->getLocale() );

        return money_format($options['format'], $string);
    }

    /**
     * @return string
     */
    function getName()
    {
        return $this->name;
    }
}
