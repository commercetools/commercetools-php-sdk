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
use Commercetools\Core\Request\Categories\Command\CategoryChangeOrderHintAction;
use Commercetools\Core\Request\Categories\Command\CategoryChangeParentAction;
use Commercetools\Core\Request\Categories\Command\CategoryChangeSlugAction;
use Commercetools\Core\Request\Categories\Command\CategorySetDescriptionAction;
use Commercetools\Core\Request\Categories\Command\CategorySetExternalIdAction;
use Commercetools\Core\Request\Categories\Command\CategorySetMetaDescriptionAction;
use Commercetools\Core\Request\Categories\Command\CategorySetMetaKeywordsAction;
use Commercetools\Core\Request\Categories\Command\CategorySetMetaTitleAction;

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
        $request = CategoryCreateRequest::ofDraft($draft);
        $response = $request->executeWithClient($this->getClient());
        $category = $request->mapResponse($response);

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

    public function testChangeOrderHint()
    {
        $draft = $this->getDraft('change order hint', 'change-order-hint');
        $category = $this->createCategory($draft);

        $hint = '0.9' . trim(mt_rand(1, 1000));
        $request = CategoryUpdateRequest::ofIdAndVersion($category->getId(), $category->getVersion())
            ->addAction(CategoryChangeOrderHintAction::ofOrderHint($hint))
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);

        $this->assertInstanceOf('\Commercetools\Core\Model\Category\Category', $result);
        $this->assertSame($hint, $result->getOrderHint());
        $this->assertNotSame($category->getVersion(), $result->getVersion());

        $deleteRequest = array_pop($this->cleanupRequests);
        $deleteRequest->setVersion($result->getVersion());
        $result = $this->getClient()->execute($deleteRequest)->toObject();

        $this->assertInstanceOf('\Commercetools\Core\Model\Category\Category', $result);
    }

    public function testChangeParent()
    {
        $draft1 = $this->getDraft('category1', 'category1');
        $category1 = $this->createCategory($draft1);
        $draft2 = $this->getDraft('category2', 'category2');
        $category2 = $this->createCategory($draft2);

        $request = CategoryUpdateRequest::ofIdAndVersion($category2->getId(), $category2->getVersion())
            ->addAction(CategoryChangeParentAction::ofParentCategory($category1->getReference()))
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);

        $this->assertInstanceOf('\Commercetools\Core\Model\Category\Category', $result);
        $this->assertSame($category1->getId(), $result->getParent()->getId());
        $this->assertNotSame($category2->getVersion(), $result->getVersion());

        $deleteRequest = array_pop($this->cleanupRequests);
        $deleteRequest->setVersion($result->getVersion());
        $result = $this->getClient()->execute($deleteRequest)->toObject();

        $this->assertInstanceOf('\Commercetools\Core\Model\Category\Category', $result);
    }

    public function testChangeSlug()
    {
        $draft = $this->getDraft('change slug', 'change-slug');
        $category = $this->createCategory($draft);

        $slug = LocalizedString::ofLangAndText('en', $this->getTestRun() . '-new-slug');
        $request = CategoryUpdateRequest::ofIdAndVersion($category->getId(), $category->getVersion())
            ->addAction(CategoryChangeSlugAction::ofSlug($slug))
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);

        $this->assertInstanceOf('\Commercetools\Core\Model\Category\Category', $result);
        $this->assertSame($slug->en, $result->getSlug()->en);
        $this->assertNotSame($category->getVersion(), $result->getVersion());

        $deleteRequest = array_pop($this->cleanupRequests);
        $deleteRequest->setVersion($result->getVersion());
        $result = $this->getClient()->execute($deleteRequest)->toObject();

        $this->assertInstanceOf('\Commercetools\Core\Model\Category\Category', $result);
    }

    public function testSetDescription()
    {
        $draft = $this->getDraft('set description', 'set-description');
        $category = $this->createCategory($draft);

        $description = LocalizedString::ofLangAndText('en', $this->getTestRun() . '-new-description');
        $request = CategoryUpdateRequest::ofIdAndVersion($category->getId(), $category->getVersion())
            ->addAction(CategorySetDescriptionAction::ofDescription($description))
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);

        $this->assertInstanceOf('\Commercetools\Core\Model\Category\Category', $result);
        $this->assertSame($description->en, $result->getDescription()->en);
        $this->assertNotSame($category->getVersion(), $result->getVersion());

        $deleteRequest = array_pop($this->cleanupRequests);
        $deleteRequest->setVersion($result->getVersion());
        $result = $this->getClient()->execute($deleteRequest)->toObject();

        $this->assertInstanceOf('\Commercetools\Core\Model\Category\Category', $result);
    }

    public function testSetExternalId()
    {
        $draft = $this->getDraft('set externalId', 'set-external-id');
        $category = $this->createCategory($draft);

        $externalId = $this->getTestRun() . '-new-external-id';
        $request = CategoryUpdateRequest::ofIdAndVersion($category->getId(), $category->getVersion())
            ->addAction(CategorySetExternalIdAction::ofExternalId($externalId))
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);

        $this->assertInstanceOf('\Commercetools\Core\Model\Category\Category', $result);
        $this->assertSame($externalId, $result->getExternalId());
        $this->assertNotSame($category->getVersion(), $result->getVersion());

        $deleteRequest = array_pop($this->cleanupRequests);
        $deleteRequest->setVersion($result->getVersion());
        $result = $this->getClient()->execute($deleteRequest)->toObject();

        $this->assertInstanceOf('\Commercetools\Core\Model\Category\Category', $result);
    }

    public function testSetMetaDescription()
    {
        $draft = $this->getDraft('set description', 'set-description');
        $category = $this->createCategory($draft);

        $description = LocalizedString::ofLangAndText('en', $this->getTestRun() . '-new-description');
        $request = CategoryUpdateRequest::ofIdAndVersion($category->getId(), $category->getVersion())
            ->addAction(CategorySetMetaDescriptionAction::of()->setMetaDescription($description))
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);

        $this->assertInstanceOf('\Commercetools\Core\Model\Category\Category', $result);
        $this->assertSame($description->en, $result->getMetaDescription()->en);
        $this->assertNotSame($category->getVersion(), $result->getVersion());

        $deleteRequest = array_pop($this->cleanupRequests);
        $deleteRequest->setVersion($result->getVersion());
        $result = $this->getClient()->execute($deleteRequest)->toObject();

        $this->assertInstanceOf('\Commercetools\Core\Model\Category\Category', $result);
    }

    public function testSetMetaTitle()
    {
        $draft = $this->getDraft('set title', 'set-title');
        $category = $this->createCategory($draft);

        $title = LocalizedString::ofLangAndText('en', $this->getTestRun() . '-new-title');
        $request = CategoryUpdateRequest::ofIdAndVersion($category->getId(), $category->getVersion())
            ->addAction(CategorySetMetaTitleAction::of()->setMetaTitle($title))
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);

        $this->assertInstanceOf('\Commercetools\Core\Model\Category\Category', $result);
        $this->assertSame($title->en, $result->getMetaTitle()->en);
        $this->assertNotSame($category->getVersion(), $result->getVersion());

        $deleteRequest = array_pop($this->cleanupRequests);
        $deleteRequest->setVersion($result->getVersion());
        $result = $this->getClient()->execute($deleteRequest)->toObject();

        $this->assertInstanceOf('\Commercetools\Core\Model\Category\Category', $result);
    }

    public function testSetMetaKeywords()
    {
        $draft = $this->getDraft('set keywords', 'set-keywords');
        $category = $this->createCategory($draft);

        $keywords = LocalizedString::ofLangAndText('en', $this->getTestRun() . '-new-keywords');
        $request = CategoryUpdateRequest::ofIdAndVersion($category->getId(), $category->getVersion())
            ->addAction(CategorySetMetaKeywordsAction::of()->setMetaKeywords($keywords))
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);

        $this->assertInstanceOf('\Commercetools\Core\Model\Category\Category', $result);
        $this->assertSame($keywords->en, $result->getMetaKeywords()->en);
        $this->assertNotSame($category->getVersion(), $result->getVersion());

        $deleteRequest = array_pop($this->cleanupRequests);
        $deleteRequest->setVersion($result->getVersion());
        $result = $this->getClient()->execute($deleteRequest)->toObject();

        $this->assertInstanceOf('\Commercetools\Core\Model\Category\Category', $result);
    }
}
