<?php
namespace mhndev\localization\filters;

use mhndev\localization\interfaces\iFilter;

/**
 * Class Number
 * @package mhndev\localization\filters
 */
class Number implements iFilter
{

    /**
     * @var string
     */
    protected $name;


    const ENGLISH = 'english_notation';
    const FRENCH  = 'french_notation';
    const ENGLISH_NO_COMMA = 'english_notation_without_thousands_separator';

    /**
     * Date constructor.
     * @param string $name
     */
    public function __construct($name = 'number')
    {
        $this->name = $name;
    }


    /**
     * @param string $string
     * @param array $options
     * @return string
     */
    function translate($string, array $options = [])
    {
        if(empty($options['format'])){
            $options['format'] = self::ENGLISH;
        }

        $result = '';

        switch ($options['format']){
            case self::ENGLISH:
                $result = number_format($string);
                break;

            case self::FRENCH:
                $result = number_format($string, 2, ',', ' ');
                break;

            case self::ENGLISH_NO_COMMA:
                $result = number_format($string, 2, '.', '');
                break;
        }

        return $result;
    }


    /**
     * @return string
     */
    function getName()
    {
        return $this->name;
    }

}
