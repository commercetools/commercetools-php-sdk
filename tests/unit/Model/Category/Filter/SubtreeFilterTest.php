<?php
/**
 * @author @Haehnchen <daniel@ependiller.net>
 */

namespace Commercetools\Core\Model\Category\Filter;

/**
 * @package Commercetools\Core\Model\Category\Filter
 */
class SubtreeFilterTest extends \PHPUnit_Framework_TestCase
{
    public function testToStringForConstructor()
    {
        $this->assertEquals('categories.id:subtree("foo-id")', (string) (new SubtreeFilter(['foo-id'])));
        $this->assertEquals('categories.id:subtree("foo-id"),subtree("foo-id")', (string) (new SubtreeFilter(['foo-id', 'foo-id'])));
    }

    public function testToStringForCreateFromUuid()
    {
        $this->assertEquals('categories.id:subtree("foo-id")', (string) SubtreeFilter::createFromUuid('foo-id'));
    }
}
