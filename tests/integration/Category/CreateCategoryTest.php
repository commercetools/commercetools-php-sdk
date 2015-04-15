<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Category;

use Sphere\Core\ApiTestCase;
use Sphere\Core\Model\Category\Category;
use Sphere\Core\Model\Category\CategoryDraft;
use Sphere\Core\Model\Common\LocalizedString;
use Sphere\Core\Request\Categories\CategoriesQueryRequest;
use Sphere\Core\Request\Categories\CategoryCreateRequest;
use Sphere\Core\Request\Categories\CategoryDeleteByIdRequest;

class CreateCategoryTest extends ApiTestCase
{
    protected function cleanup()
    {
        $items = $this->getClient()->execute(CategoriesQueryRequest::of())->toObject();

        foreach ($items as $item) {
            $this->getClient()->execute(CategoryDeleteByIdRequest::of($item->getId(), $item->getVersion()));
        }
    }

    public function testCreate()
    {
        $draft = CategoryDraft::of(
            LocalizedString::of(['en' => 'myCategory']),
            LocalizedString::of(['en' => 'my-category'])
        );

        $request = CategoryCreateRequest::of($draft);

        /**
         * @var Category $category
         */
        $category = $this->getClient()->execute($request)->toObject();
        $this->assertSame('myCategory', $category->getName()->en);
        $this->assertSame('my-category', $category->getSlug()->en);
        $this->assertNotEmpty($category->getId());
        $this->assertSame(1, $category->getVersion());
    }
}
