<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 29.01.15, 12:22
 */

namespace Sphere\Core\Model\Common;


use Sphere\Core\Error\InvalidArgumentException;

class LocalizedStringTest extends \PHPUnit_Framework_TestCase
{
    protected static $intlLoaded = true;

    protected function tearDown()
    {
        parent::tearDown();
        static::$intlLoaded = true;
    }

    public static function getIntlLoaded()
    {
        return static::$intlLoaded;
    }

    protected function getString()
    {
        $localizedString = LocalizedString::of(['en'=>'test']);
        $localizedString->setContext($this->getContext('en'));

        return $localizedString;
    }

    protected function getContext($language)
    {
        $context = new Context();
        $context->setLanguages([$language]);

        return $context;
    }

    /**
     * @expectedException \Sphere\Core\Error\InvalidArgumentException
     */
    public function testGetUnknownLocale()
    {
        $this->getString()->get($this->getContext('de'));
    }

    public function testGetLocale()
    {
        $this->assertSame('test', $this->getString()->get());
    }

    public function testAddLocaleName()
    {
        $string = $this->getString();
        $string->add('de', 'Name');
        $this->assertSame('Name', $string->get($this->getContext('de')));
    }

    public function testSerializable()
    {
        $this->assertInstanceOf('\JsonSerializable', $this->getString());
        $this->assertSame(['en' => 'test'], $this->getString()->jsonSerialize());
    }

    public function testMerge()
    {
        $string1 = new LocalizedString(['en' => 'test']);
        $string2 = new LocalizedString(['de' => 'test']);

        $string1->merge($string2);
        $this->assertSame(['en' => 'test', 'de' => 'test'], $string1->toArray());
    }
}
