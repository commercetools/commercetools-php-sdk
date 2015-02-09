<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 29.01.15, 12:22
 */

namespace Sphere\Core\Model\Common;


use Sphere\Core\Error\InvalidArgumentException;

function extension_loaded($value)
{
    if ($value === 'intl') {
        return LocalizedStringTest::getIntlLoaded();
    }
    return \extension_loaded($value);
}

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
        return LocalizedString::of(['en'=>'test']);
    }

    /**
     * @expectedException \Sphere\Core\Error\InvalidArgumentException
     */
    public function testGetUnknownLocale()
    {
        $this->getString()->get('de');
    }

    public function testGetLocale()
    {
        $this->assertSame('test', $this->getString()->get('en'));
    }

    public function testAddLocaleName()
    {
        $string = $this->getString();
        $string->add('de', 'Name');
        $this->assertSame('Name', $string->get('de'));
    }

    public function testSerializable()
    {
        $this->assertInstanceOf('\JsonSerializable', $this->getString());
        $this->assertSame(['en' => 'test'], $this->getString()->jsonSerialize());
    }

    public function testDefaultLanguage()
    {
        \Locale::setDefault('en_US');
        $localString = LocalizedString::of(['en' => 'test']);
        $this->assertSame('test', (string)$localString);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testIntlNotLoaded()
    {
        static::$intlLoaded = false;
        LocalizedString::setDefaultLanguage(null);

        $localString = LocalizedString::of(['en' => 'test']);
        $localString->__toString();
    }

    public function testMerge()
    {
        $string1 = new LocalizedString(['en' => 'test']);
        $string2 = new LocalizedString(['de' => 'test']);

        $string1->merge($string2);
        $this->assertSame(['en' => 'test', 'de' => 'test'], $string1->toArray());
    }
}
