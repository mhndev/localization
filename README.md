[![Build Status](https://travis-ci.org/mhndev/localization.svg?branch=master)](https://travis-ci.org/mhndev/localization)
[![Latest Stable Version](https://poser.pugx.org/mhndev/localization/v/stable)](https://packagist.org/packages/mhndev/localization)[![Total Downloads](https://poser.pugx.org/mhndev/php-std/downloads)](https://packagist.org/packages/mhndev/php-std)
[![Latest Unstable Version](https://poser.pugx.org/mhndev/localization/v/unstable)](https://packagist.org/packages/mhndev/localization)[![License](https://poser.pugx.org/mhndev/php-std/license)](https://packagist.org/packages/mhndev/php-std)
[![composer.lock](https://poser.pugx.org/mhndev/localization/composerlock)](https://packagist.org/packages/mhndev/localization)
[![License](https://poser.pugx.org/mhndev/localization/license)](https://packagist.org/packages/mhndev/localization)
# Localization i18n



#### sample code

```php

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


echo '<div style="direction: rtl; text-align: right">'.$result.'</div>';


date_default_timezone_set('Asia/Tehran');
$now = time();

$yesterday = $now - 3600 * 24;


$string = 'today is {{'.$now.'|date }} and yesterday was :{{'.$yesterday.'| date}}';

$translation = $translator->localizeText($string, 'fa');

echo '<br>';

echo $translation;

```
