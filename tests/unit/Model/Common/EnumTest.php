<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Common;

class EnumTest extends \PHPUnit\Framework\TestCase
{
    public function testToString()
    {
        $this->assertSame('Test', (string)Enum::fromArray(['key' => 'test', 'label' => 'Test']));
    }
}
