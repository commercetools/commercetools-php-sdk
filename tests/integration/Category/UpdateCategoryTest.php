<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Category;


use Commercetools\Core\ApiTestCase;
use Commercetools\Core\Model\Category\Category;
use Commercetools\Core\Model\Category\CategoryDraft;
use Commercetools\Core\Model\Common\LocalizedString;
use Commercetools\Core\Request\Categories\CategoryQueryRequest;
use Commercetools\Core\Request\Categories\CategoryCreateRequest;
use Commercetools\Core\Request\Categories\CategoryDeleteRequest;
use Commercetools\Core\Request\Categories\CategoryUpdateRequest;
use Commercetools\Core\Request\Categories\Command\CategoryChangeNameAction;

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

        $this->assertInstanceOf('\Commercetools\Core\Model\Category\Category', $result);
        $this->assertSame('new name', $result->getName()->en);
        $this->assertNotSame($category->getVersion(), $result->getVersion());

        $deleteRequest = array_pop($this->cleanupRequests);
        $deleteRequest->setVersion($result->getVersion());
        $result = $this->getClient()->execute($deleteRequest)->toObject();

        $this->assertInstanceOf('\Commercetools\Core\Model\Category\Category', $result);
    }

    public function testUpdateLocalizedName()
    {
        $category = $this->createCategory($this->getDraft('update name', 'update-name'));

        $result = $this->getClient()->execute(
            CategoryUpdateRequest::ofIdAndVersion($category->getId(), $category->getVersion())
                ->addAction(
                    CategoryChangeNameAction::ofName(
                        LocalizedString::fromArray(['en' => 'new name', 'en-US' => 'new name'])
                    )
                )
        )->toObject();

        $this->assertInstanceOf('\Commercetools\Core\Model\Category\Category', $result);
        $this->assertSame('new name', $result->getName()->en);
        $this->assertSame('new name', $result->getName()->en_US);
        $this->assertNotSame($category->getVersion(), $result->getVersion());

        $deleteRequest = array_pop($this->cleanupRequests);
        $deleteRequest->setVersion($result->getVersion());
        $result = $this->getClient()->execute($deleteRequest)->toObject();

        $this->assertInstanceOf('\Commercetools\Core\Model\Category\Category', $result);
    }
}
