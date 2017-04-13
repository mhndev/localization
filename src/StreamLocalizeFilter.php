<?php
namespace mhndev\localization;

use mhndev\localization\interfaces\iTranslator;
use php_user_filter;

/**
 * Class StreamLocalizeFilter
 * @package mhndev\digipeyk\services\localization
 */
class StreamLocalizeFilter extends php_user_filter
{

    /**
     * @var iTranslator
     */
    protected $translator;


    /**
     * @param resource $in
     * @param resource $out
     * @param int $consumed
     * @param bool $closing
     * @return int
     */
    public function filter($in, $out, &$consumed, $closing)
    {
        while ($bucket = stream_bucket_make_writeable($in)) {
            $bucket->data = $this->localizeString($bucket->data);

            $consumed += $bucket->datalen;
            stream_bucket_append($out, $bucket);
        }

        return PSFS_PASS_ON;
    }


    /**
     * @param string $string
     * @return string
     */
    protected function localizeString($string)
    {
        $this->translator = empty($this->translator) ? new Translator() : $this->translator;

        return $this->translator->translate($string);
    }


}
