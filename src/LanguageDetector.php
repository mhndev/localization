<?php
namespace mhndev\localization;

use mhndev\localization\interfaces\iLanguage;
use mhndev\localization\interfaces\iStrategy;
use Psr\Http\Message\RequestInterface;

/**
 * Class LanguageDetector
 * @package mhndev\localization
 */
class LanguageDetector
{


    /**
     * @var
     */
    protected $strategies;


    /**
     * @param iStrategy $strategy
     * @return $this
     */
    public function registerStrategy(iStrategy $strategy)
    {
        $this->strategies[] = $strategy;

        return $this;
    }


    /**
     * @param iStrategy $strategy
     * @return $this
     * @throws StrategyNotFoundException
     */
    public function removeStrategy(iStrategy $strategy)
    {
        $res = delByValue($strategy, $this->strategies);

        if($res == false){
            throw new StrategyNotFoundException(
                sprintf(
                    'strategy %s not found in registered strategies in language detector',
                    $strategy->getName()
                )
            );
        }

        return $this;
    }


    /**
     * @param RequestInterface $request
     * @param iLanguage | null $defaultLanguage
     * @return iLanguage
     */
    public function detect(RequestInterface $request, iLanguage $defaultLanguage = null)
    {
        /** @var iStrategy $strategy */
        foreach ($this->strategies as $strategy){
            $language = $strategy->detect($request);

            if(! is_null($language)){
                return $language;
            }

        }

        return $defaultLanguage ?? LanguageFactory::fromUrlCode('en');
    }

}
