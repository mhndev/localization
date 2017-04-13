[![Build Status](https://travis-ci.org/mhndev/localization.svg?branch=master)](https://travis-ci.org/mhndev/localization)
[![Latest Stable Version](https://poser.pugx.org/mhndev/localization/v/stable)](https://packagist.org/packages/mhndev/localization)
[![Latest Unstable Version](https://poser.pugx.org/mhndev/localization/v/unstable)](https://packagist.org/packages/mhndev/localization)
[![License](https://poser.pugx.org/mhndev/localization/license)](https://packagist.org/packages/mhndev/localization)
[![composer.lock available](https://poser.pugx.org/mhndev/localization/composerlock)](https://packagist.org/packages/mhndev/localization)
# Localization i18n



#### sample code

```php
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once 'vendor/autoload.php';

$source = new \mhndev\localization\SourcePhpArray(getcwd().DIRECTORY_SEPARATOR.'en.php');
$lang_en = (new \mhndev\localization\LanguageEnglish())->setSource($source);

$source = new \mhndev\localization\SourcePhpArray(getcwd().DIRECTORY_SEPARATOR.'fa.php');
$lang_fa = (new \mhndev\localization\LanguagePersian())->setSource($source);

$translator = new \mhndev\localization\Translator();

$translator->addLanguage($lang_en);
$translator->addLanguage($lang_fa);



$result = $translator->translate('greet', 'fa',
[
    'name' => 'مجید',
    'job' => 'برنامه نویس',
    'company' => 'دیجی پیک
    ']
);

/*
 * output would be :
 *
 *
 * سلام من مجید هستم . من یک برنامه نویس هستم و در شرکت دیجی پیک کار میکنم
 */


echo '<div style="direction: rtl; text-align: right">'.$result.'</div>';


date_default_timezone_set('Asia/Tehran');
$now = time();

$yesterday = $now - 3600 * 24;


$string = 'today is {{'.$now.'|date }} and yesterday was :{{'.$yesterday.'| date}}';

/*
 * output would be :
 *  
 *  today is پنجشنبه ۲۴ فروردین ۱۳۹۶ - ۱۰:۵۶ and yesterday was :چهارشنبه ۲۳ فروردین ۱۳۹۶ - ۱۰:۵۶
 *
 */


$translation = $translator->localizeText($string, 'fa');

echo '<br>';

echo $translation;


//http response object which implement stream
//localize http response stream

//$string = (string)$response->getBody();
//$newBody = new Body(fopen('php://memory', 'r+'));
//$newBody->write(self::localizeText($string));
//
//$newResponse = $response->withBody($newBody);


```
