<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 29.01.15, 12:22
 */

namespace Sphere\Core\Model;


use Sphere\Core\Model\Common\LocalizedString;

class LocalizedStringTest extends \PHPUnit_Framework_TestCase
{
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
}
