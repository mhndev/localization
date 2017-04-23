[![Build Status](https://travis-ci.org/mhndev/localization.svg?branch=master)](https://travis-ci.org/mhndev/localization)
[![Latest Stable Version](https://poser.pugx.org/mhndev/localization/v/stable)](https://packagist.org/packages/mhndev/localization)
[![Latest Unstable Version](https://poser.pugx.org/mhndev/localization/v/unstable)](https://packagist.org/packages/mhndev/localization)
[![License](https://poser.pugx.org/mhndev/localization/license)](https://packagist.org/packages/mhndev/localization)
[![composer.lock available](https://poser.pugx.org/mhndev/localization/composerlock)](https://packagist.org/packages/mhndev/localization)
# Localization i18n



#### sample code

```php

use mhndev\localization\LanguageFactory;
use mhndev\localization\LanguageLoader;
use mhndev\localization\repositories\PhpArray;
use mhndev\localization\Translator;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


include_once 'vendor/autoload.php';

$repository = new PhpArray(getcwd().DIRECTORY_SEPARATOR.'en.php');
$lang_en = LanguageFactory::fromCountryCode('us')->setRepository($repository);

$repository = new PhpArray(getcwd().DIRECTORY_SEPARATOR.'fa.php');
$lang_fa = LanguageFactory::fromUrlCode('fa')->setRepository($repository);

$translator = new Translator();

$translator->addLanguage($lang_en);
$translator->addLanguage($lang_fa);

$params = [
    'name' => 'مجید',
    'job' => 'برنامه نویس',
    'company' => 'دیجی پیک'
];


$result = $translator->translate(
    'greet',
    LanguageFactory::fromUrlCode('fa'),
    $params
);

var_dump($result);



/*
 * output would be :
 *
 * today is پنجشنبه ۲۴ فروردین ۱۳۹۶  - ۱۰:۵۶ and yesterday was :چهارشنبه ۲۳ فروردین ۱۳۹۶  - ۱۰:۵۶
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
 * today is پنجشنبه ۲۴ فروردین ۱۳۹۶ - ۱۰:۵۶ and yesterday was :چهارشنبه ۲۳ فروردین ۱۳۹۶ - ۱۰:۵۶
 */


$translation = $translator->localizeText($string, LanguageFactory::fromUrlCode('fa'));

echo '<br>';

echo $translation;


$lngLoader = new LanguageLoader();

$language = LanguageFactory::fromUrlCode('en');

$languageDetector = new \mhndev\localization\LanguageDetector();
$languageDetector->registerStrategy(new \mhndev\localization\strategies\StrategyUriChunk());
$languageDetector->registerStrategy(new \mhndev\localization\strategies\StrategyQueryParameter());
$languageDetector->registerStrategy(new \mhndev\localization\strategies\StrategyAcceptLngHeader());

$request = \GuzzleHttp\Psr7\ServerRequest::fromGlobals()->withUri(new \GuzzleHttp\Psr7\Uri(
    'http://example.com/fa/some/random/address?key=value'
));

$result = $languageDetector->detect($request);

var_dump($result);
die();


```
