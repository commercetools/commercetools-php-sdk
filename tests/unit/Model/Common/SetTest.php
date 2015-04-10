<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\Common;


class SetTest extends \PHPUnit_Framework_TestCase
{
    public function testFromArray()
    {
        $set = Set::fromArray(['type' => 'int', 'value' => [1,2,3,4]]);
        $this->assertInstanceOf(
            '\Sphere\Core\Model\Common\Set',
            $set
        );
    }

    public function testToString()
    {
        $set = Set::fromArray(['type' => 'int', 'value' => [1,2,3,4]]);
        $this->assertSame('1, 2, 3, 4', (string)$set);
    }
}
