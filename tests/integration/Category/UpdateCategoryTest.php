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
use Sphere\Core\Request\Categories\CategoryDeleteRequest;
use Sphere\Core\Request\Categories\CategoryUpdateRequest;
use Sphere\Core\Request\Categories\Command\CategoryChangeNameAction;

class UpdateCategoryTest extends ApiTestCase
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

    public function testUpdateName()
    {
        $category = $this->createCategory($this->getDraft('update name', 'update-name'));

        $result = $this->getClient()->execute(
            CategoryUpdateRequest::ofIdAndVersion($category->getId(), $category->getVersion())
                ->addAction(CategoryChangeNameAction::ofName(LocalizedString::fromArray(['en' => 'new name'])))
        )->toObject();

        $this->assertInstanceOf('\Sphere\Core\Model\Category\Category', $result);
        $this->assertSame('new name', $result->getName()->en);
        $this->assertNotSame($category->getVersion(), $result->getVersion());

        $deleteRequest = array_pop($this->cleanupRequests);
        $deleteRequest->setVersion($result->getVersion());
        $result = $this->getClient()->execute($deleteRequest)->toObject();

        $this->assertInstanceOf('\Sphere\Core\Model\Category\Category', $result);
    }
}
