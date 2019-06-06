<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\IntegrationTests\Category;

use Commercetools\Core\IntegrationTests\ApiTestCase;
use Commercetools\Core\Model\Category\CategoryDraft;
use Commercetools\Core\Model\Common\LocalizedString;
use Commercetools\Core\Request\Categories\CategoryCreateRequest;
use Commercetools\Core\Request\Categories\CategoryDeleteByKeyRequest;
use Commercetools\Core\Request\Categories\CategoryDeleteRequest;

class CategoryCreateRequestTest extends ApiTestCase
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


    public function testCreate()
    {
        $draft = $this->getDraft('myCategory', 'my-category');
        $category = $this->createCategory($draft);
        $this->assertSame($draft->getName()->en, $category->getName()->en);
        $this->assertSame($draft->getSlug()->en, $category->getSlug()->en);
        $this->assertNotEmpty($category->getId());
        $this->assertSame(1, $category->getVersion());
    }

    public function testDeleteByKey()
    {
        $draft = $this->getDraft('myCategory', 'my-category')->setKey($this->getTestRun());
        $category = $this->createCategory($draft);

        $request = CategoryDeleteByKeyRequest::ofKeyAndVersion(
            $category->getKey(),
            $category->getVersion()
        );
        $result = $this->getClient()->execute($request);
        $response = $request->mapFromResponse($result);

        $this->assertSame($category->getId(), $response->getId());
    }
}
