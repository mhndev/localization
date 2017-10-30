<?php
namespace mhndev\localization\strategies;

use Locale;
use mhndev\localization\interfaces\iLanguage;
use mhndev\localization\interfaces\iStrategy;
use mhndev\localization\LanguageFactory;
use Psr\Http\Message\RequestInterface;

/**
 * Class StrategyAcceptLngHeader
 * @package mhndev\localization\strategies
 */
class StrategyAcceptLngHeader implements iStrategy
{

    /**
     * @param RequestInterface $request
     * @return iLanguage|null
     * @throws \Exception
     */
    function detect(RequestInterface $request)
    {
        if ($request->hasHeader('Accept-Language')){

            $language = $request->getHeaderLine('Accept-Language');

            if (!extension_loaded('intl')) {
                throw new \Exception('intl extension is not installed');
            }

            $locale = Locale::acceptFromHttp($language);

            return LanguageFactory::fromLocale($locale);
        }

        return null;

    }


    /**
     * @return string
     */
    function getName()
    {
        return 'accept-language-header';
    }

}
