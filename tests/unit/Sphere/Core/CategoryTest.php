<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 27.01.15, 15:17
 */

namespace Sphere\Core;

use Sphere\Core\Http\FileRequest;
use Sphere\Core\Model\Draft\CategoryDraft;
use Sphere\Core\Model\Type\CategoryReference;
use Sphere\Core\Model\Type\LocalizedString;
use Sphere\Core\Model\Type\Reference;

class CategoryTest extends \PHPUnit_Framework_TestCase
{
    public function testCategory()
    {
        $category = CategoryDraft::of(
            LocalizedString::of(['de' => 'test'])->add('en', 'test'),
            LocalizedString::of(['de' => 'test'])
        )
      //      ->setDescription(LocalizedString::of(['de' => 'Lorem Ipsum']))
      //      ->setParent(CategoryReference::of('test'))
      //      ->setExternalId('whatever')
      //      ->setOrderHint('1')
        ;

        var_dump($category->toArray());
        var_dump(json_encode($category));
    }
}
