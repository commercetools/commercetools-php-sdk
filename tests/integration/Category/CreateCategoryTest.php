<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Category;

use Commercetools\Core\ApiTestCase;
use Commercetools\Core\Model\Category\Category;
use Commercetools\Core\Model\Category\CategoryDraft;
use Commercetools\Core\Model\Common\LocalizedString;
use Commercetools\Core\Request\Categories\CategoryCreateRequest;
use Commercetools\Core\Request\Categories\CategoryDeleteRequest;

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
        $this->cleanupRequests[] = CategoryDeleteRequest::ofIdAndVersion(
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
