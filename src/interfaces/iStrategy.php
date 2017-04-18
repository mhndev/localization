<?php
namespace mhndev\localization\interfaces;

use Psr\Http\Message\RequestInterface;

/**
 * Interface iStrategy
 * @package mhndev\localization\interfaces
 */
interface iStrategy
{


    /**
     * @return string
     */
    function getName();

    /**
     * @param RequestInterface $request
     * @return iLanguage | null
     */
    function detect(RequestInterface $request);

}
