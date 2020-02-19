<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\IntegrationTests\Category;

use Commercetools\Core\Builder\Request\RequestBuilder;
use Commercetools\Core\Fixtures\FixtureException;
use Commercetools\Core\IntegrationTests\ApiTestCase;
use Commercetools\Core\Model\Category\Category;
use Commercetools\Core\Model\Category\CategoryDraft;
use Commercetools\Core\Model\Common\LocalizedString;

class CategoryCreateRequestTest extends ApiTestCase
{
    public function testCreate()
    {
        $client = $this->getApiClient();

        CategoryFixture::withDraftCategory(
            $client,
            function (CategoryDraft $draft) {
                $nameAndSlug = LocalizedString::ofLangAndText('en', 'myCategory');

                return $draft->setName($nameAndSlug)->setSlug($nameAndSlug);
            },
            function (Category $category) use ($client) {
                $request = RequestBuilder::of()->categories()->query()
                    ->where('name(en=:name)', ['name' => $category->getName()->en]);
                $response = $client->execute($request);
                $result = $request->mapFromResponse($response);

                $this->assertSame($category->getName()->en, $result->current()->getName()->en);
                $this->assertSame($category->getSlug()->en, $result->current()->getSlug()->en);
                $this->assertNotEmpty($result->current()->getId());
                $this->assertSame(1, $result->current()->getVersion());
            }
        );
    }

    public function testDeleteByKey()
    {
        $this->expectException(FixtureException::class);
        $this->expectExceptionCode(404);

        $client = $this->getApiClient();

        CategoryFixture::withDraftCategory(
            $client,
            function (CategoryDraft $draft) {
                return $draft->setName(LocalizedString::ofLangAndText('en', 'myCategory'))
                    ->setKey(CategoryFixture::uniqueCategoryString());
            },
            function (Category $category) use ($client) {
                $request = RequestBuilder::of()->categories()->deleteByKey($category);
                $response = $client->execute($request);
                $result = $request->mapFromResponse($response);

                $this->assertSame($category->getId(), $result->getId());
                $this->assertInstanceOf(Category::class, $result);

                $request = RequestBuilder::of()->categories()->getByKey($result->getKey());
                $response = $this->execute($client, $request);
                $request->mapFromResponse($response);
            }
        );
    }
}
