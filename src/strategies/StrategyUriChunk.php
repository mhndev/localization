<?php
namespace mhndev\localization\strategies;

use mhndev\localization\interfaces\iLanguage;
use mhndev\localization\interfaces\iStrategy;
use mhndev\localization\LanguageFactory;
use Psr\Http\Message\RequestInterface;

/**
 * Class StrategyUriChunk
 * @package mhndev\localization\strategies
 */
class StrategyUriChunk implements iStrategy
{

    /**
     * @param RequestInterface $request
     * @return iLanguage | null
     */
    function detect(RequestInterface $request)
    {
        $virtualPath = $request->getUri()->getPath();

        $pathChunk = explode("/",$virtualPath);

        $language = LanguageFactory::fromUrlCode($pathChunk[1]);

        if( count($pathChunk) > 1 && $language != null ) {
            $lang = $pathChunk[1];

            return LanguageFactory::fromUrlCode($lang);
        }

        return null;
    }

    /**
     * @return string
     */
    function getName()
    {
        return 'uri-chunk';
    }
}
