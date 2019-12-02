<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\IntegrationTests\Category;

use Commercetools\Core\Builder\Request\RequestBuilder;
use Commercetools\Core\IntegrationTests\ApiTestCase;
use Commercetools\Core\Model\Category\Category;
use Commercetools\Core\Model\Category\CategoryDraft;
use Commercetools\Core\Model\Category\CategoryReference;
use Commercetools\Core\Model\Common\LocalizedString;
use Commercetools\Core\Request\Categories\CategoryByKeyGetRequest;
use Commercetools\Core\Request\Categories\CategoryQueryRequest;
use Commercetools\Core\Request\Categories\CategoryCreateRequest;
use Commercetools\Core\Request\Categories\CategoryDeleteRequest;
use Commercetools\Core\Request\Categories\CategoryByIdGetRequest;

class CategoryQueryRequestTest extends ApiTestCase
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
        $request = CategoryCreateRequest::ofDraft($draft);
        $response = $request->executeWithClient($this->getClient());
        $category = $request->mapResponse($response);

        $this->cleanupRequests[] = CategoryDeleteRequest::ofIdAndVersion(
            $category->getId(),
            $category->getVersion()
        );

        return $category;
    }

    public function testGetById()
    {
        $client = $this->getApiClient();
        CategoryFixture::withCategory(
            $client,
            function (Category $category) use ($client) {
                $request = RequestBuilder::of()->categories()->getById($category->getId());
                $response = $client->execute($request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(Category::class, $result);
                $this->assertSame($category->getId(), $result->getId());
            }
        );
    }

    public function testGetByKey()
    {
        $client = $this->getApiClient();
        CategoryFixture::withCategory(
            $client,
            function (Category $category) use ($client) {
                $request = RequestBuilder::of()->categories()->getByKey($category->getKey());
                $response = $client->execute($request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(Category::class, $result);
                $this->assertSame($category->getId(), $result->getId());
                $this->assertSame($category->getKey(), $result->getKey());
            }
        );
    }

    public function testQuery()
    {
        $category = $this->createCategory($this->getDraft('myCategory', 'my-category'));

        $result = $this->getClient()->execute(CategoryQueryRequest::of()->where('name(en="myCategory")'))->toObject();

        $this->assertCount(1, $result);
        $this->assertInstanceOf(Category::class, $result->getAt(0));
        $this->assertSame($category->getId(), $result->getAt(0)->getId());
    }

    public function testQueryByNotName()
    {
        $this->createCategory($this->getDraft('myCategory', 'my-category'));

        $result = $this->getClient()->execute(
            CategoryQueryRequest::of()->where('not(name(en="myCategory"))')
        )->toObject();

        $this->assertCount(0, $result);
    }

    public function testQueryByExternalId()
    {
        $client = $this->getApiClient();
        CategoryFixture::withDraftCategory(
            $client,
            function (CategoryDraft $draft) {
                return $draft->setExternalId('myExternalId');
            },
            function (Category $category) use ($client) {
                $request = RequestBuilder::of()->categories()->query()->where('externalId="myExternalId"');
                $response = $client->execute($request);
                $result = $request->mapFromResponse($response);

                $this->assertCount(1, $result);
                $this->assertInstanceOf(Category::class, $result->current());
                $this->assertSame($category->getId(), $result->current()->getId());
            }
        );
    }

    public function testQueryHierarchy()
    {
        $client = $this->getApiClient();
        CategoryFixture::withDraftCategory(
            $client,
            function (CategoryDraft $parentDraft) {
                return $parentDraft->setName(LocalizedString::ofLangAndText('en', 'parentCategory'));
            },
            function (Category $parent) use ($client) {
                CategoryFixture::withDraftCategory(
                    $client,
                    function (CategoryDraft $childDraft) use ($parent) {
                        return $childDraft->setParent(CategoryReference::ofId($parent->getId()))
                            ->setName(LocalizedString::ofLangAndText('en', 'childCategory'));
                    },
                    function (Category $child) use ($client, $parent) {
                        $this->assertSame('childCategory', $child->getName()->en);
                        $this->assertSame('parentCategory', $parent->getName()->en);

                        $request = RequestBuilder::of()->categories()->query()->where('parent(id="'.$parent->getId().'")');
                        $response = $client->execute($request);
                        $result = $request->mapFromResponse($response);

                        $this->assertSame($child->getId(), $result->current()->getId());

                        $request = RequestBuilder::of()->categories()->query()->where('parent is defined');
                        $response = $client->execute($request);
                        $result = $request->mapFromResponse($response);
                        $this->assertSame($child->getId(), $result->getAt(0)->getId());

                        $request = RequestBuilder::of()->categories()->query()->where('parent is not defined');
                        $response = $client->execute($request);
                        $result = $request->mapFromResponse($response);
                        $this->assertSame($parent->getId(), $result->getAt(0)->getId());
                    }
                );
            }
        );
    }

    public function testAncestorExpansion()
    {
        $level1 = $this->createCategory($this->getDraft('level1', 'level1'));
        $level2 = $this->createCategory(
            $this->getDraft('level2', 'level2')
                ->setParent(CategoryReference::ofId($level1->getId()))
        );
        $level3 = $this->createCategory(
            $this->getDraft('level3', 'level3')
                ->setParent(CategoryReference::ofId($level2->getId()))
        );
        $level4 = $this->createCategory(
            $this->getDraft('level4', 'level4')
                ->setParent(CategoryReference::ofId($level3->getId()))
        );

        /**
         * @var Category $result
         */
        $result = $this->getClient()->execute(
            CategoryByIdGetRequest::ofId($level4->getId())->expand('ancestors[*].ancestors[*]')
        )->toObject();

        $this->assertCount(3, $result->getAncestors());

        $ancestorIds = $this->map(
            function ($value) {
                return $value->getObj()->getId();
            },
            $result->getAncestors()
        );
        $expectedAncestors = [$level1->getId(), $level2->getId(), $level3->getId()];
        $this->assertSame($expectedAncestors, $ancestorIds);

        $level3ExpandedAncestor = $result->getAncestors()->getAt(2)->getObj();
        $this->assertSame($level3->getId(), $level3ExpandedAncestor->getId());

        $this->assertSame($level1->getId(), $level3ExpandedAncestor->getAncestors()->getAt(0)->getObj()->getId());
    }

    public function testParentExpansion()
    {
        $level1 = $this->createCategory($this->getDraft('level1', 'level1'));
        $level2 = $this->createCategory(
            $this->getDraft('level2', 'level2')
                ->setParent(CategoryReference::ofId($level1->getId()))
        );

        /**
         * @var Category $result
         */
        $result = $this->getClient()->execute(
            CategoryByIdGetRequest::ofId($level2->getId())->expand('parent')
        )->toObject();
        $this->assertSame($level1->getId(), $result->getParent()->getObj()->getId());
    }

    protected function predicateTestCase($predicate)
    {
        $this->createCategory($this->getDraft('1', 'test-1'));
        $draft = $this->getDraft('2', 'test-2');
        $draft->getName()->add('cn', 'x');
        $this->createCategory($draft);
        $this->createCategory($this->getDraft('10', 'test-10'));

        return $this->getClient()->execute(
            CategoryQueryRequest::of()->where($predicate)->sort('createdAt DESC')
        )->toObject();
    }

    public function testGreaterThanComparison()
    {
        $predicate = 'name(en > "1")';
        $result = $this->predicateTestCase($predicate);

        $names = array_flip($this->map(
            function ($value) {
                return $value->getName()->en;
            },
            $result
        ));

        $this->assertArrayHasKey('2', $names);
        $this->assertArrayHasKey('10', $names);
        $this->assertArrayNotHasKey('1', $names);
    }

    public function testLesserThanComparison()
    {
        $predicate = 'name(en < "2")';
        $result = $this->predicateTestCase($predicate);

        $names = array_flip($this->map(
            function ($value) {
                return $value->getName()->en;
            },
            $result
        ));

        $this->assertArrayHasKey('1', $names);
        $this->assertArrayHasKey('10', $names);
        $this->assertArrayNotHasKey('2', $names);
    }

    public function testLesserThanEqualsComparison()
    {
        $predicate = 'name(en <= "10")';
        $result = $this->predicateTestCase($predicate);

        $names = array_flip($this->map(
            function ($value) {
                return $value->getName()->en;
            },
            $result
        ));

        $this->assertArrayHasKey('1', $names);
        $this->assertArrayHasKey('10', $names);
        $this->assertArrayNotHasKey('2', $names);
    }

    public function testGreaterThanEqualsComparison()
    {
        $predicate = 'name(en >= "10")';
        $result = $this->predicateTestCase($predicate);

        $names = array_flip($this->map(
            function ($value) {
                return $value->getName()->en;
            },
            $result
        ));

        $this->assertArrayHasKey('2', $names);
        $this->assertArrayHasKey('10', $names);
        $this->assertArrayNotHasKey('1', $names);
    }

    public function testNotIn()
    {
        $predicate = 'name(en not in("10", "2"))';
        $result = $this->predicateTestCase($predicate);

        $names = array_flip($this->map(
            function ($value) {
                return $value->getName()->en;
            },
            $result
        ));

        $this->assertArrayNotHasKey('2', $names);
        $this->assertArrayNotHasKey('10', $names);
        $this->assertArrayHasKey('1', $names);
    }

    public function testIsDefined()
    {
        $predicate = 'name(cn is defined)';
        $result = $this->predicateTestCase($predicate);

        $names = array_flip($this->map(
            function ($value) {
                return $value->getName()->en;
            },
            $result
        ));

        $this->assertArrayNotHasKey('1', $names);
        $this->assertArrayNotHasKey('10', $names);
        $this->assertArrayHasKey('2', $names);
    }

    public function testIsNotDefined()
    {
        $predicate = 'name(cn is not defined)';
        $result = $this->predicateTestCase($predicate);

        $names = array_flip($this->map(
            function ($value) {
                return $value->getName()->en;
            },
            $result
        ));

        $this->assertArrayHasKey('1', $names);
        $this->assertArrayHasKey('10', $names);
        $this->assertArrayNotHasKey('2', $names);
    }

    public function testOverpaging()
    {
        $this->createCategory($this->getDraft('myCategory', 'my-category'));
        $result = $this->getClient()->execute(
            CategoryQueryRequest::of()->offset(10000)
        );
        $this->assertSame(10000, $result->getOffset());
        $this->assertSame(0, $result->getCount());
        $this->assertCount(0, $result->toObject());
    }

    public function testMinSlug()
    {
        $draft = $this->getDraft('min', '1');
        $request = CategoryCreateRequest::ofDraft($draft);
        $response = $request->executeWithClient($this->getClient());

        $category = $request->mapResponse($response);
        if ($category instanceof Category) {
            $this->cleanupRequests[] = CategoryDeleteRequest::ofIdAndVersion(
                $category->getId(),
                $category->getVersion()
            );
        }

        $this->assertTrue($response->isError());
    }

    public function testMaxSlug()
    {
        $draft = $this->getDraft('max', str_pad('1', 257, '0'));
        $request = CategoryCreateRequest::ofDraft($draft);
        $response = $request->executeWithClient($this->getClient());
        $category = $request->mapResponse($response);
        if ($category instanceof Category) {
            $this->cleanupRequests[] = CategoryDeleteRequest::ofIdAndVersion(
                $category->getId(),
                $category->getVersion()
            );
        }

        $this->assertTrue($response->isError());
    }
}
