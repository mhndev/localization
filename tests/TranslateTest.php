<?php
namespace mhndev\localization\Tests;

use mhndev\localization\interfaces\iLanguage;
use mhndev\localization\LanguageFactory;
use mhndev\localization\repositories\PhpArray;
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

        file_put_contents(
            $path ,
            '<?php return  ' . var_export($translationArray, true) . ';'
        );

        $repository = new PhpArray($path);
        $lang_en = LanguageFactory::fromUrlCode('en')->setRepository($repository);

        $translator = new Translator();
        $translator->addLanguage($lang_en);

        $result = $translator->translate(
            'greet',
            LanguageFactory::fromUrlCode('en'),
            ['name' => 'majid', 'age' => 20]
        );

        $this->assertEquals('hello this is majid and I am 20 years old.', $result);
    }


    function testLanguageFactory()
    {
        $language1 = LanguageFactory::fromUrlCode('en');

        $language2 = LanguageFactory::fromCountryCode('us');

        $language3 = LanguageFactory::fromCalender('gregorian');

        $language4 = LanguageFactory::fromLocale('en_US');

        $language5 = LanguageFactory::fromName('english');

        $farsi = LanguageFactory::fromLocale('fa_IR');

        $this->assertInstanceOf(iLanguage::class, $language1);
        $this->assertInstanceOf(iLanguage::class, $language2);
        $this->assertInstanceOf(iLanguage::class, $language3);
        $this->assertInstanceOf(iLanguage::class, $language4);
        $this->assertInstanceOf(iLanguage::class, $language5);

        $this->assertEquals('english', $language1->getName());
        $this->assertEquals('en_US', $language1->getLocale());
        $this->assertEquals('en', $language1->getUrlCode());
        $this->assertEquals('gregorian', $language1->getCalendar());
        $this->assertEquals('us', $language1->getCountryCode());

        $this->assertEquals('farsi', $farsi->getName());
        $this->assertEquals('fa_IR', $farsi->getLocale());
        $this->assertEquals('fa', $farsi->getUrlCode());
        $this->assertEquals('persian', $farsi->getCalendar());
        $this->assertEquals('ir', $farsi->getCountryCode());
    }

}
