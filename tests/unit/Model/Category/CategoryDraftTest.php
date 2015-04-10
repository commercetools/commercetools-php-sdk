<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\Category;


class CategoryDraftTest extends \PHPUnit_Framework_TestCase
{
    public function testFromArray()
    {
        $this->assertInstanceOf(
            '\Sphere\Core\Model\Category\CategoryDraft',
            CategoryDraft::fromArray(
                [
                    'name' => ['en' => 'test'],
                    'slug' => ['en' => 'test']
                ]
            )
        );
    }
}
