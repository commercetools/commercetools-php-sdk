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
        $client = $this->getApiClient();

        CategoryFixture::withDraftCategory(
            $client,
            function (CategoryDraft $draft) {
                return $draft->setName(LocalizedString::ofLangAndText('en', 'myCategory'));
            },
            function (Category $category) use ($client) {
                $request = RequestBuilder::of()->categories()->query()->where('name(en="myCategory")');
                $response = $client->execute($request);
                $result = $request->mapFromResponse($response);

                $this->assertCount(1, $result);
                $this->assertInstanceOf(Category::class, $result->current());
                $this->assertSame($category->getId(), $result->current()->getId());
            }
        );
    }

    public function testQueryByNotName()
    {
        $client = $this->getApiClient();

        CategoryFixture::withDraftCategory(
            $client,
            function (CategoryDraft $draft) {
                return $draft->setName(LocalizedString::ofLangAndText('en', 'myCategory'));
            },
            function (Category $category) use ($client) {
                $request = RequestBuilder::of()->categories()->query()->where('not(name(en="myCategory"))');
                $response = $client->execute($request);
                $result = $request->mapFromResponse($response);

                $this->assertCount(0, $result);
            }
        );
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
        $client = $this->getApiClient();

        CategoryFixture::withDraftCategory(
            $client,
            function (CategoryDraft $level1draft) {
                return $level1draft->setName(LocalizedString::ofLangAndText('en', 'level1'));
            },
            function (Category $level1) use ($client) {
                CategoryFixture::withDraftCategory(
                    $client,
                    function (CategoryDraft $level2Draft) use ($level1) {
                        return $level2Draft->setParent(CategoryReference::ofId($level1->getId()))
                            ->setName(LocalizedString::ofLangAndText('en', 'level2'));
                    },
                    function (Category $level2) use ($client, $level1) {
                        CategoryFixture::withDraftCategory(
                            $client,
                            function (CategoryDraft $level3Draft) use ($level2) {
                                return $level3Draft->setParent(CategoryReference::ofId($level2->getId()))
                                    ->setName(LocalizedString::ofLangAndText('en', 'level3'));
                            },
                            function (Category $level3) use ($client, $level2, $level1) {
                                CategoryFixture::withDraftCategory(
                                    $client,
                                    function (CategoryDraft $level4Draft) use ($level3) {
                                        return $level4Draft->setParent(CategoryReference::ofId($level3->getId()))
                                            ->setName(LocalizedString::ofLangAndText('en', 'level4'));
                                    },
                                    function (Category $level4) use ($client, $level3, $level2, $level1) {
                                        $request = RequestBuilder::of()
                                            ->categories()
                                            ->getById($level4->getId())->expand('ancestors[*].ancestors[*]');
                                        $response = $client->execute($request);
                                        $result = $request->mapFromResponse($response);

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
                                        $this->assertSame($level1->getId(), $level3ExpandedAncestor->getAncestors()->current()->getObj()->getId());
                                    }
                                );
                            }
                        );
                    }
                );
            }
        );
    }

    public function testParentExpansion()
    {
        $client = $this->getApiClient();

        CategoryFixture::withDraftCategory(
            $client,
            function (CategoryDraft $level1Draft) {
                return $level1Draft->setName(LocalizedString::ofLangAndText('en', 'level1'));
            },
            function (Category $level1) use ($client) {
                CategoryFixture::withDraftCategory(
                    $client,
                    function (CategoryDraft $level2Draft) use ($level1) {
                        return $level2Draft->setParent(CategoryReference::ofId($level1->getId()))
                            ->setName(LocalizedString::ofLangAndText('en', 'level2'));
                    },
                    function (Category $level2) use ($client, $level1) {
                        $request = RequestBuilder::of()->categories()
                            ->getById($level2->getId())->expand('parent');
                        $response = $client->execute($request);
                        $result = $request->mapFromResponse($response);

                        $this->assertSame($level1->getId(), $result->getParent()->getObj()->getId());
                    }
                );
            }
        );
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
