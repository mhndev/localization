<?php
namespace mhndev\localization\strategies;

use mhndev\localization\interfaces\iLanguage;
use mhndev\localization\interfaces\iStrategy;
use mhndev\localization\LanguageFactory;
use Psr\Http\Message\RequestInterface;

/**
 * Class StrategyQueryParameter
 * @package mhndev\localization\strategies
 */
class StrategyQueryParameter implements iStrategy
{

    /**
     * @param RequestInterface $request
     * @return iLanguage | null
     */
    function detect(RequestInterface $request)
    {
        $queryString = $request->getUri()->getQuery();

        parse_str($queryString, $queryParams);

        if (!empty($lng = $queryParams['lang'])){
            return LanguageFactory::fromUrlCode($lng);
        }

        return null;

    }

    /**
     * @return string
     */
    function getName()
    {
        return 'query-parameter';
    }

}
