<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Category;

use Sphere\Core\ApiTestCase;
use Sphere\Core\Model\Category\Category;
use Sphere\Core\Model\Category\CategoryDraft;
use Sphere\Core\Model\Common\LocalizedString;
use Sphere\Core\Request\Categories\CategoryCreateRequest;
use Sphere\Core\Request\Categories\CategoryDeleteByIdRequest;

class CreateCategoryTest extends ApiTestCase
{
    /**
     * @param $name
     * @param $slug
     * @return CategoryDraft
     */
    protected function getDraft($name, $slug)
    {
        $draft = CategoryDraft::ofNameAndSlug(
            LocalizedString::fromArray(['en' => $name]),
            LocalizedString::fromArray(['en' => $slug])
        );

        return $draft;
    }

    protected function createCategory(CategoryDraft $draft)
    {
        /**
         * @var Category $category
         */
        $category = $this->getClient()
            ->execute(CategoryCreateRequest::ofDraft($draft))
            ->toObject();
        $this->cleanupRequests[] = CategoryDeleteByIdRequest::ofIdAndVersion(
            $category->getId(),
            $category->getVersion()
        );

        return $category;
    }


    public function testCreate()
    {
        $category = $this->createCategory($this->getDraft('myCategory', 'my-category'));
        $this->assertSame('myCategory', $category->getName()->en);
        $this->assertSame('my-category', $category->getSlug()->en);
        $this->assertNotEmpty($category->getId());
        $this->assertSame(1, $category->getVersion());
    }
}
