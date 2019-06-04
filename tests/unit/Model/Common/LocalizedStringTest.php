<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 * @created: 29.01.15, 12:22
 */

namespace Commercetools\Core\Model\Common;

use Commercetools\Core\Error\InvalidArgumentException;

class LocalizedStringTest extends \PHPUnit\Framework\TestCase
{
    protected static $intlLoaded = true;

    protected function tearDown(): void
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
        $localizedString = LocalizedString::ofLangAndText('en', 'test');
        $localizedString->setContext($this->getContext('en'));

        return $localizedString;
    }

    protected function getContext($language)
    {
        $context = Context::of();
        $context->setLanguages([$language]);

        return $context;
    }

    /**
     * @expectedException \Commercetools\Core\Error\InvalidArgumentException
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
        $string1 = LocalizedString::fromArray(['en' => 'test']);
        $string2 = LocalizedString::fromArray(['de' => 'test']);

        $string1->merge($string2);
        $this->assertSame(['en' => 'test', 'de' => 'test'], $string1->toArray());
    }

    public function testLocalized()
    {
        $context = Context::of();
        $context->setLanguages(['de', 'en']);
        $string = LocalizedString::fromArray(['en' => 'test'], $context);

        $this->assertSame('test', $string->getLocalized());
    }

    public function testGraceful()
    {
        $context = $this->getContext('de');
        $context->setGraceful(true);
        $string = new LocalizedString(['en' => 'test'], $context);

        $this->assertSame('', $string->getLocalized());
    }

    public function testToString()
    {
        $string = LocalizedString::fromArray(['en' => 'test'], $this->getContext('en'));

        $this->assertSame('test', (string)$string);
    }

    public function testMagicGet()
    {
        $string = LocalizedString::fromArray(['en' => 'test']);

        $this->assertSame('test', $string->en);
    }

    public function localizedStringProvider()
    {
        return [
            [ ['en' => 'language'], 'en', 'language'],
            [ ['en' => 'language'], 'en_US', 'language' ],
            [ ['en' => 'language'], 'en-US', 'language'],
            [ ['en_US' => 'locale'], 'en', ''],
            [ ['en_US' => 'locale'], 'en_US', 'locale'],
            [ ['en_US' => 'locale'], 'en-US', 'locale'],
            [ ['en-US' => 'locale'], 'en', ''],
            [ ['en-US' => 'locale'], 'en_US', 'locale'],
            [ ['en-US' => 'locale'], 'en-US', 'locale'],
            [ ['en' => 'language', 'en_US' => 'locale'], 'en', 'language'],
            [ ['en' => 'language', 'en_US' => 'locale'], 'en_US', 'locale'],
            [ ['en' => 'language', 'en_US' => 'locale'], 'en-US', 'locale'],
            [ ['en' => 'language', 'en-US' => 'locale'], 'en', 'language'],
            [ ['en' => 'language', 'en-US' => 'locale'], 'en_US', 'locale'],
            [ ['en' => 'language', 'en-US' => 'locale'], 'en-US', 'locale'],
        ];
    }

    /**
     * @dataProvider localizedStringProvider
     */
    public function testGetByLocale($stringData, $locale, $result)
    {
        $localizedString = LocalizedString::fromArray($stringData);
        $context = Context::of()->setLanguages([$locale])->setGraceful(true);
        $this->assertSame($result, $localizedString->get($context));
    }

    /**
     * @dataProvider localizedStringProvider
     */
    public function testGetStringByLocale($stringData, $locale, $result)
    {
        $context = Context::of()->setLanguages([$locale])->setGraceful(true);
        $localizedString = LocalizedString::fromArray($stringData, $context);
        $this->assertSame($result, (string)$localizedString);
    }

    public function jsonStringProvider()
    {
        return [
            [ ['en' => 'language'], '{"en": "language"}' ],
            [ ['en_US' => 'locale'], '{"en-US": "locale"}' ],
            [ ['en-US' => 'locale'], '{"en-US": "locale"}'],
            [ ['en' => 'language', 'en_US' => 'locale'], '{"en": "language", "en-US": "locale"}' ],
            [ ['en' => 'language', 'en-US' => 'locale'], '{"en": "language", "en-US": "locale"}' ],
        ];
    }

    /**
     * @dataProvider jsonStringProvider
     */
    public function testJsonSerialize($stringData, $result)
    {
        $localizedString = LocalizedString::fromArray($stringData);
        $this->assertJsonStringEqualsJsonString($result, json_encode($localizedString));
    }
}
