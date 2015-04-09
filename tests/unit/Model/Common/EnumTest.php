<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\Common;


class EnumTest extends \PHPUnit_Framework_TestCase
{
    public function testToString()
    {
        $this->assertSame('Test', (string)Enum::fromArray(['key' => 'test', 'label' => 'Test']));
    }
}
