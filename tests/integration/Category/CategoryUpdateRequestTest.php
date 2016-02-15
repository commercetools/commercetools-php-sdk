<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
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

class CategoryUpdateRequestTest extends ApiTestCase
{
    /**
     * @param $name
     * @param $slug
     * @return CategoryDraft
     */
    protected function getDraft($name, $slug)
    {
        $draft = CategoryDraft::ofNameAndSlug(
            LocalizedString::ofLangAndText('en', 'test-' . $this->getTestRun() . '-' . $name),
            LocalizedString::ofLangAndText('en', 'test-' . $this->getTestRun() . '-' . $slug)
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
        $draft = $this->getDraft('update name', 'update-name');
        $category = $this->createCategory($draft);

        $result = $this->getClient()->execute(
            CategoryUpdateRequest::ofIdAndVersion($category->getId(), $category->getVersion())->addAction(
                CategoryChangeNameAction::ofName(
                    LocalizedString::ofLangAndText('en', $this->getTestRun() . '-new name')
                )
            )
        )->toObject();

        $this->assertInstanceOf('\Commercetools\Core\Model\Category\Category', $result);
        $this->assertSame($this->getTestRun() .'-new name', $result->getName()->en);
        $this->assertNotSame($category->getVersion(), $result->getVersion());

        $deleteRequest = array_pop($this->cleanupRequests);
        $deleteRequest->setVersion($result->getVersion());
        $result = $this->getClient()->execute($deleteRequest)->toObject();

        $this->assertInstanceOf('\Commercetools\Core\Model\Category\Category', $result);
    }

    public function testUpdateLocalizedName()
    {
        $draft = $this->getDraft('update name', 'update-name');
        $category = $this->createCategory($draft);

        $result = $this->getClient()->execute(
            CategoryUpdateRequest::ofIdAndVersion($category->getId(), $category->getVersion())
                ->addAction(
                    CategoryChangeNameAction::ofName(
                        LocalizedString::ofLangAndText('en', $this->getTestRun() . '-new name')
                            ->add('en-US', $this->getTestRun() . '-new name')
                    )
                )
        )->toObject();

        $this->assertInstanceOf('\Commercetools\Core\Model\Category\Category', $result);
        $this->assertSame($this->getTestRun() . '-new name', $result->getName()->en);
        $this->assertSame($this->getTestRun() . '-new name', $result->getName()->en_US);
        $this->assertNotSame($category->getVersion(), $result->getVersion());

        $deleteRequest = array_pop($this->cleanupRequests);
        $deleteRequest->setVersion($result->getVersion());
        $result = $this->getClient()->execute($deleteRequest)->toObject();

        $this->assertInstanceOf('\Commercetools\Core\Model\Category\Category', $result);
    }
}
