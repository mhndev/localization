<?php
namespace mhndev\localization\Tests;

use mhndev\localization\LanguageEnglish;
use mhndev\localization\SourcePhpArray;
use mhndev\localization\Translator;
use org\bovigo\vfs\vfsStream;
use PHPUnit\Framework\TestCase;

/**
 * Class TranslateTest
 * @package mhndev\localization\tests
 */
class TranslateTest extends TestCase
{

    private $root;


    public function setUp()
    {
        parent::setUp();

        $this->root = vfsStream::setup('rootDirectory');
    }


    function testTranslate()
    {
        $translationArray = [
            'greet' => 'hello this is {{name}} and I am {{age}} years old.'
        ];

        $path = vfsStream::url("rootDirectory").DIRECTORY_SEPARATOR."en.php";

        file_put_contents($path , '<?php return  ' . var_export($translationArray, true) . ';');

        $source = new SourcePhpArray($path);
        $lang_en = (new LanguageEnglish())->setSource($source);

        $translator = new Translator();
        $translator->addLanguage($lang_en);

        $result = $translator->translate('greet', 'en', ['name' => 'majid', 'age' => 20] );



        $this->assertEquals('hello this is majid and I am 20 years old.', $result);
    }

}
