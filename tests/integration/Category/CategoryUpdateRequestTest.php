<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\IntegrationTests\Category;

use Commercetools\Core\Builder\Request\RequestBuilder;
use Commercetools\Core\IntegrationTests\ApiTestCase;
use Commercetools\Core\IntegrationTests\TestHelper;
use Commercetools\Core\Model\Category\Category;
use Commercetools\Core\Model\Category\CategoryDraft;
use Commercetools\Core\Model\Common\AssetDraft;
use Commercetools\Core\Model\Common\AssetDraftCollection;
use Commercetools\Core\Model\Common\AssetSource;
use Commercetools\Core\Model\Common\AssetSourceCollection;
use Commercetools\Core\Model\Common\LocalizedString;
use Commercetools\Core\Request\Categories\CategoryCreateRequest;
use Commercetools\Core\Request\Categories\CategoryDeleteRequest;
use Commercetools\Core\Request\Categories\CategoryUpdateRequest;
use Commercetools\Core\Request\Categories\Command\CategoryAddAssetAction;
use Commercetools\Core\Request\Categories\Command\CategoryChangeAssetNameAction;
use Commercetools\Core\Request\Categories\Command\CategoryChangeNameAction;
use Commercetools\Core\Request\Categories\Command\CategoryChangeOrderHintAction;
use Commercetools\Core\Request\Categories\Command\CategoryChangeParentAction;
use Commercetools\Core\Request\Categories\Command\CategoryChangeSlugAction;
use Commercetools\Core\Request\Categories\Command\CategoryRemoveAssetAction;
use Commercetools\Core\Request\Categories\Command\CategorySetAssetDescriptionAction;
use Commercetools\Core\Request\Categories\Command\CategorySetAssetKeyAction;
use Commercetools\Core\Request\Categories\Command\CategorySetAssetSourcesAction;
use Commercetools\Core\Request\Categories\Command\CategorySetAssetTagsAction;
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

        $this->cleanupRequests[] = $this->deleteRequest = CategoryDeleteRequest::ofIdAndVersion(
            $category->getId(),
            $category->getVersion()
        );

        return $category;
    }

    public function testUpdateNameByKey()
    {
        $client = $this->getApiClient();

        CategoryFixture::withUpdatableDraftCategory(
            $client,
            function (CategoryDraft $draft) {
                return $draft->setName(LocalizedString::ofLangAndText('en', 'update name')
                    ->add('en', 'update-name'));
            },
            function (Category $draft) use ($client) {
                $request = RequestBuilder::of()->categories()->updateByKey($draft)->addAction(
                    CategoryChangeNameAction::ofName(
                        LocalizedString::ofLangAndText('en', $this->getTestRun() . '-new name')
                    )
                );
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(Category::class, $result);
                $this->assertSame($this->getTestRun() . '-new name', $result->getName()->en);
                $this->assertNotSame($draft->getVersion(), $result->getVersion());

                return $result;
            }
        );
    }


    public function testUpdateName()
    {
        $client = $this->getApiClient();

        CategoryFixture::withUpdatableDraftCategory(
            $client,
            function (CategoryDraft $draft) {
                return $draft->setName(LocalizedString::ofLangAndText('en', 'update name')
                    ->add('en', 'update-name'));
            },
            function (Category $draft) use ($client) {
                $request = RequestBuilder::of()->categories()->update($draft)->addAction(
                    CategoryChangeNameAction::ofName(
                        LocalizedString::ofLangAndText('en', $this->getTestRun() . '-new name')
                    )
                );

                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(Category::class, $result);
                $this->assertSame($this->getTestRun() . '-new name', $result->getName()->en);
                $this->assertNotSame($draft->getVersion(), $result->getVersion());

                return $result;
            }
        );
    }

    public function testUpdateLocalizedName()
    {
        $client = $this->getApiClient();

        CategoryFixture::withUpdatableDraftCategory(
            $client,
            function (CategoryDraft $draft) {
                return $draft->setName(LocalizedString::ofLangAndText('en', 'update name')
                    ->add('en', 'update-name'));
            },
            function (Category $draft) use ($client) {
                $request = RequestBuilder::of()->categories()->update($draft)->addAction(
                    CategoryChangeNameAction::ofName(
                        LocalizedString::ofLangAndText('en', $this->getTestRun() . '-new name')
                            ->add('en-US', $this->getTestRun() . '-new name')
                    )
                );

                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(Category::class, $result);
                $this->assertSame($this->getTestRun() . '-new name', $result->getName()->en);
                $this->assertSame($this->getTestRun() . '-new name', $result->getName()->en_US);
                $this->assertNotSame($draft->getVersion(), $result->getVersion());

                return $result;
            }
        );
    }

    public function testChangeOrderHint()
    {
        $client = $this->getApiClient();

        CategoryFixture::withUpdatableDraftCategory(
            $client,
            function (CategoryDraft $draft) {
                return $draft->setName(LocalizedString::ofLangAndText('en', 'change order hint')
                    ->add('en', 'change-order-hint'));
            },
            function (Category $draft) use ($client) {
                $hint = '0.9' . trim(mt_rand(1, TestHelper::RAND_MAX));
                $request = RequestBuilder::of()->categories()->update($draft)
                    ->addAction(CategoryChangeOrderHintAction::ofOrderHint($hint));

                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(Category::class, $result);
                $this->assertSame($hint, $result->getOrderHint());
                $this->assertNotSame($draft->getVersion(), $result->getVersion());

                return $result;
            }
        );
    }

    public function testChangeParent()
    {
        $client = $this->getApiClient();

        CategoryFixture::withUpdatableDraftCategory(
            $client,
            function (CategoryDraft $category1Draft) {
                return $category1Draft->setName(LocalizedString::ofLangAndText('en', 'category1'));
            },
            function (Category $category1) use ($client) {
                CategoryFixture::withDraftCategory(
                    $client,
                    function (CategoryDraft $category2Draft) use ($category1) {
                        return $category2Draft->setName(LocalizedString::ofLangAndText('en', 'category2'));
                    },
                    function (Category $category2) use ($client, $category1) {
                        $request = RequestBuilder::of()->categories()->update($category2)
                            ->addAction(CategoryChangeParentAction::ofParentCategory($category1->getReference()));
                        $response = $this->execute($client, $request);
                        $result = $request->mapFromResponse($response);

                        $this->assertInstanceOf(Category::class, $result);
                        $this->assertSame($category1->getId(), $result->getParent()->getId());
                        $this->assertNotSame($category2->getVersion(), $result->getVersion());

                        return $result;
                    }
                );
            }
        );
    }

    public function testChangeSlug()
    {
        $client = $this->getApiClient();

        CategoryFixture::withUpdatableDraftCategory(
            $client,
            function (CategoryDraft $draft) {
                return $draft->setName(LocalizedString::ofLangAndText('en', 'change slug')
                    ->add('en', 'change-slug'));
            },
            function (Category $category) use ($client) {
                $slug = LocalizedString::ofLangAndText('en', $this->getTestRun() . '-new-slug');
                $request = RequestBuilder::of()->categories()->update($category)
                    ->addAction(CategoryChangeSlugAction::ofSlug($slug));
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(Category::class, $result);
                $this->assertSame($slug->en, $result->getSlug()->en);
                $this->assertNotSame($category->getVersion(), $result->getVersion());

                return $result;
            }
        );
    }

    public function testSetDescription()
    {
        $client = $this->getApiClient();

        CategoryFixture::withUpdatableDraftCategory(
            $client,
            function (CategoryDraft $draft) {
                return $draft->setName(LocalizedString::ofLangAndText('en', 'set description')
                    ->add('en', 'set-description'));
            },
            function (Category $category) use ($client) {
                $description = LocalizedString::ofLangAndText('en', $this->getTestRun() . '-new-description');
                $request = RequestBuilder::of()->categories()->update($category)
                    ->addAction(CategorySetDescriptionAction::ofDescription($description));
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(Category::class, $result);
                $this->assertSame($description->en, $result->getDescription()->en);
                $this->assertNotSame($category->getVersion(), $result->getVersion());

                return $result;
            }
        );
    }

    public function testSetExternalId()
    {
        $client = $this->getApiClient();

        CategoryFixture::withUpdatableDraftCategory(
            $client,
            function (CategoryDraft $draft) {
                return $draft->setName(LocalizedString::ofLangAndText('en', 'set externalId')
                    ->add('en', 'set-external-id'));
            },
            function (Category $category) use ($client) {
                $externalId = $this->getTestRun() . '-new-external-id';
                $request = RequestBuilder::of()->categories()->update($category)
                    ->addAction(CategorySetExternalIdAction::ofExternalId($externalId));
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(Category::class, $result);
                $this->assertSame($externalId, $result->getExternalId());
                $this->assertNotSame($category->getVersion(), $result->getVersion());

                return $result;
            }
        );
    }

    public function testSetMetaDescription()
    {
        $client = $this->getApiClient();

        CategoryFixture::withUpdatableDraftCategory(
            $client,
            function (CategoryDraft $draft) {
                return $draft->setName(LocalizedString::ofLangAndText('en', 'set description')
                    ->add('en', 'set-description'));
            },
            function (Category $category) use ($client) {
                $description = LocalizedString::ofLangAndText('en', $this->getTestRun() . '-new-description');
                $request = RequestBuilder::of()->categories()->update($category)
                    ->addAction(CategorySetMetaDescriptionAction::of()->setMetaDescription($description));
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(Category::class, $result);
                $this->assertSame($description->en, $result->getMetaDescription()->en);
                $this->assertNotSame($category->getVersion(), $result->getVersion());
            }
        );
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

        $this->assertInstanceOf(Category::class, $result);
        $this->assertSame($title->en, $result->getMetaTitle()->en);
        $this->assertNotSame($category->getVersion(), $result->getVersion());

        $deleteRequest = array_pop($this->cleanupRequests);
        $deleteRequest->setVersion($result->getVersion());
        $result = $this->getClient()->execute($deleteRequest)->toObject();

        $this->assertInstanceOf(Category::class, $result);
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

        $this->assertInstanceOf(Category::class, $result);
        $this->assertSame($keywords->en, $result->getMetaKeywords()->en);
        $this->assertNotSame($category->getVersion(), $result->getVersion());

        $deleteRequest = array_pop($this->cleanupRequests);
        $deleteRequest->setVersion($result->getVersion());
        $result = $this->getClient()->execute($deleteRequest)->toObject();

        $this->assertInstanceOf(Category::class, $result);
    }

    public function testAddAsset()
    {
        $draft = $this->getDraft('set keywords', 'add-assets');
        $category = $this->createCategory($draft);

        $assetDraft = AssetDraft::ofNameAndSources(
            LocalizedString::ofLangAndText('en', $this->getTestRun()),
            AssetSourceCollection::of()->add(
                AssetSource::of()->setUri($this->getTestRun() . '.jpg')->setKey('test')
            )
        );
        $request = CategoryUpdateRequest::ofIdAndVersion($category->getId(), $category->getVersion())
            ->addAction(CategoryAddAssetAction::ofAsset($assetDraft))
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf(Category::class, $result);
        $this->assertNotNull($result->getAssets()->current()->getId());
        $this->assertSame(
            $assetDraft->getSources()->current()->getUri(),
            $result->getAssets()->current()->getSources()->current()->getUri()
        );
    }

    public function testRemoveAsset()
    {
        $assetDraft = AssetDraft::ofNameAndSources(
            LocalizedString::ofLangAndText('en', $this->getTestRun()),
            AssetSourceCollection::of()->add(
                AssetSource::of()->setUri($this->getTestRun() . '.jpg')->setKey('test')
            )
        );
        $draft = $this->getDraft('set keywords', 'remove-assets');
        $draft->setAssets(AssetDraftCollection::of()->add($assetDraft));
        $category = $this->createCategory($draft);

        $request = CategoryUpdateRequest::ofIdAndVersion($category->getId(), $category->getVersion())
            ->addAction(CategoryRemoveAssetAction::ofAssetId($category->getAssets()->current()->getId()))
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf(Category::class, $result);
        $this->assertCount(0, $result->getAssets());
    }

    public function testChangeAssetName()
    {
        $assetDraft = AssetDraft::ofNameAndSources(
            LocalizedString::ofLangAndText('en', $this->getTestRun()),
            AssetSourceCollection::of()->add(
                AssetSource::of()->setUri($this->getTestRun() . '.jpg')->setKey('test')
            )
        );
        $draft = $this->getDraft('set keywords', 'change-assetname');
        $draft->setAssets(AssetDraftCollection::of()->add($assetDraft));
        $category = $this->createCategory($draft);

        $newName = $this->getTestRun() . '-new';
        $request = CategoryUpdateRequest::ofIdAndVersion($category->getId(), $category->getVersion())
            ->addAction(
                CategoryChangeAssetNameAction::ofAssetIdAndName(
                    $category->getAssets()->current()->getId(),
                    LocalizedString::ofLangAndText('en', $newName)
                )
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf(Category::class, $result);
        $this->assertSame(
            $newName,
            $result->getAssets()->current()->getName()->en
        );
    }

    public function testSetAssetDescription()
    {
        $assetDraft = AssetDraft::ofNameAndSources(
            LocalizedString::ofLangAndText('en', $this->getTestRun()),
            AssetSourceCollection::of()->add(
                AssetSource::of()->setUri($this->getTestRun() . '.jpg')->setKey('test')
            )
        );
        $draft = $this->getDraft('set keywords', 'set-asset-description');
        $draft->setAssets(AssetDraftCollection::of()->add($assetDraft));
        $category = $this->createCategory($draft);

        $newDescription = $this->getTestRun() . '-new';
        $request = CategoryUpdateRequest::ofIdAndVersion($category->getId(), $category->getVersion())
            ->addAction(
                CategorySetAssetDescriptionAction::ofAssetId($category->getAssets()->current()->getId())
                    ->setDescription(LocalizedString::ofLangAndText('en', $newDescription))
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf(Category::class, $result);
        $this->assertSame(
            $newDescription,
            $result->getAssets()->current()->getDescription()->en
        );
    }

    public function testSetAssetTags()
    {
        $assetDraft = AssetDraft::ofNameAndSources(
            LocalizedString::ofLangAndText('en', $this->getTestRun()),
            AssetSourceCollection::of()->add(
                AssetSource::of()->setUri($this->getTestRun() . '.jpg')->setKey('test')
            )
        );
        $draft = $this->getDraft('set keywords', 'set-asset-tags');
        $draft->setAssets(AssetDraftCollection::of()->add($assetDraft));
        $category = $this->createCategory($draft);

        $newTag = $this->getTestRun() . '-new';
        $request = CategoryUpdateRequest::ofIdAndVersion($category->getId(), $category->getVersion())
            ->addAction(
                CategorySetAssetTagsAction::ofAssetId($category->getAssets()->current()->getId())
                    ->setTags([$newTag])
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf(Category::class, $result);
        $this->assertContains(
            $newTag,
            $result->getAssets()->current()->getTags()
        );
    }

    public function testSetAssetSources()
    {
        $assetDraft = AssetDraft::ofNameAndSources(
            LocalizedString::ofLangAndText('en', $this->getTestRun()),
            AssetSourceCollection::of()->add(
                AssetSource::of()->setUri($this->getTestRun() . '.jpg')->setKey('test')
            )
        );
        $draft = $this->getDraft('set keywords', 'set-asset-tags');
        $draft->setAssets(AssetDraftCollection::of()->add($assetDraft));
        $category = $this->createCategory($draft);

        $newSource = AssetSource::of()->setUri($this->getTestRun() . '-new.jpq')->setKey('test');
        $request = CategoryUpdateRequest::ofIdAndVersion($category->getId(), $category->getVersion())
            ->addAction(
                CategorySetAssetSourcesAction::ofAssetId($category->getAssets()->current()->getId())
                    ->setSources(AssetSourceCollection::of()->add($newSource))
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf(Category::class, $result);
        $this->assertContains(
            $newSource->getUri(),
            $result->getAssets()->current()->getSources()->current()->getUri()
        );
    }

    public function testSetAssetKey()
    {
        $assetKey = uniqid();
        $assetDraft = AssetDraft::ofNameAndSources(
            LocalizedString::ofLangAndText('en', $this->getTestRun()),
            AssetSourceCollection::of()->add(
                AssetSource::of()->setUri($this->getTestRun() . '.jpg')->setKey('test')
            )
        );
        $draft = $this->getDraft('set keywords', 'change-assetname');
        $draft->setAssets(AssetDraftCollection::of()->add($assetDraft));
        $category = $this->createCategory($draft);

        $newName = $this->getTestRun() . '-new';
        $request = CategoryUpdateRequest::ofIdAndVersion($category->getId(), $category->getVersion())
            ->addAction(
                CategorySetAssetKeyAction::ofAssetIdAndAssetKey(
                    $category->getAssets()->current()->getId(),
                    $assetKey
                )
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf(Category::class, $result);
        $this->assertSame(
            $assetKey,
            $result->getAssets()->current()->getKey()
        );
    }

    public function testAddAssetWithKey()
    {
        $draft = $this->getDraft('set keywords', 'add-assets');
        $category = $this->createCategory($draft);

        $assetKey = uniqid();
        $assetDraft = AssetDraft::ofKeySourcesAndName(
            $assetKey,
            AssetSourceCollection::of()->add(
                AssetSource::of()->setUri($this->getTestRun() . '.jpg')->setKey('test')
            ),
            LocalizedString::ofLangAndText('en', $this->getTestRun())
        );
        $request = CategoryUpdateRequest::ofIdAndVersion($category->getId(), $category->getVersion())
            ->addAction(CategoryAddAssetAction::ofAsset($assetDraft))
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf(Category::class, $result);
        $this->assertNotNull($result->getAssets()->current()->getId());
        $this->assertSame($assetKey, $result->getAssets()->current()->getKey());
        $this->assertSame(
            $assetDraft->getSources()->current()->getUri(),
            $result->getAssets()->current()->getSources()->current()->getUri()
        );
    }

    public function testRemoveAssetByKey()
    {
        $assetKey = uniqid();
        $assetDraft = AssetDraft::ofKeySourcesAndName(
            $assetKey,
            AssetSourceCollection::of()->add(
                AssetSource::of()->setUri($this->getTestRun() . '.jpg')->setKey('test')
            ),
            LocalizedString::ofLangAndText('en', $this->getTestRun())
        );
        $draft = $this->getDraft('set keywords', 'remove-assets');
        $draft->setAssets(AssetDraftCollection::of()->add($assetDraft));
        $category = $this->createCategory($draft);

        $request = CategoryUpdateRequest::ofIdAndVersion($category->getId(), $category->getVersion())
            ->addAction(CategoryRemoveAssetAction::ofAssetKey($assetKey))
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf(Category::class, $result);
        $this->assertCount(0, $result->getAssets());
    }

    public function testChangeAssetNameByKey()
    {
        $assetKey = uniqid();
        $assetDraft = AssetDraft::ofKeySourcesAndName(
            $assetKey,
            AssetSourceCollection::of()->add(
                AssetSource::of()->setUri($this->getTestRun() . '.jpg')->setKey('test')
            ),
            LocalizedString::ofLangAndText('en', $this->getTestRun())
        );
        $draft = $this->getDraft('set keywords', 'change-assetname');
        $draft->setAssets(AssetDraftCollection::of()->add($assetDraft));
        $category = $this->createCategory($draft);

        $newName = $this->getTestRun() . '-new';
        $request = CategoryUpdateRequest::ofIdAndVersion($category->getId(), $category->getVersion())
            ->addAction(
                CategoryChangeAssetNameAction::ofAssetKeyAndName(
                    $assetKey,
                    LocalizedString::ofLangAndText('en', $newName)
                )
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf(Category::class, $result);
        $this->assertSame(
            $newName,
            $result->getAssets()->current()->getName()->en
        );
    }

    public function testSetAssetDescriptionByKey()
    {
        $assetKey = uniqid();
        $assetDraft = AssetDraft::ofKeySourcesAndName(
            $assetKey,
            AssetSourceCollection::of()->add(
                AssetSource::of()->setUri($this->getTestRun() . '.jpg')->setKey('test')
            ),
            LocalizedString::ofLangAndText('en', $this->getTestRun())
        );
        $draft = $this->getDraft('set keywords', 'set-asset-description');
        $draft->setAssets(AssetDraftCollection::of()->add($assetDraft));
        $category = $this->createCategory($draft);

        $newDescription = $this->getTestRun() . '-new';
        $request = CategoryUpdateRequest::ofIdAndVersion($category->getId(), $category->getVersion())
            ->addAction(
                CategorySetAssetDescriptionAction::ofAssetKey($assetKey)
                    ->setDescription(LocalizedString::ofLangAndText('en', $newDescription))
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf(Category::class, $result);
        $this->assertSame(
            $newDescription,
            $result->getAssets()->current()->getDescription()->en
        );
    }

    public function testSetAssetTagsByKey()
    {
        $assetKey = uniqid();
        $assetDraft = AssetDraft::ofKeySourcesAndName(
            $assetKey,
            AssetSourceCollection::of()->add(
                AssetSource::of()->setUri($this->getTestRun() . '.jpg')->setKey('test')
            ),
            LocalizedString::ofLangAndText('en', $this->getTestRun())
        );
        $draft = $this->getDraft('set keywords', 'set-asset-tags');
        $draft->setAssets(AssetDraftCollection::of()->add($assetDraft));
        $category = $this->createCategory($draft);

        $newTag = $this->getTestRun() . '-new';
        $request = CategoryUpdateRequest::ofIdAndVersion($category->getId(), $category->getVersion())
            ->addAction(
                CategorySetAssetTagsAction::ofAssetKey($assetKey)
                    ->setTags([$newTag])
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf(Category::class, $result);
        $this->assertContains(
            $newTag,
            $result->getAssets()->current()->getTags()
        );
    }

    public function testSetAssetSourcesByKey()
    {
        $assetKey = uniqid();
        $assetDraft = AssetDraft::ofKeySourcesAndName(
            $assetKey,
            AssetSourceCollection::of()->add(
                AssetSource::of()->setUri($this->getTestRun() . '.jpg')->setKey('test')
            ),
            LocalizedString::ofLangAndText('en', $this->getTestRun())
        );
        $draft = $this->getDraft('set keywords', 'set-asset-tags');
        $draft->setAssets(AssetDraftCollection::of()->add($assetDraft));
        $category = $this->createCategory($draft);

        $newSource = AssetSource::of()->setUri($this->getTestRun() . '-new.jpq')->setKey('test');
        $request = CategoryUpdateRequest::ofIdAndVersion($category->getId(), $category->getVersion())
            ->addAction(
                CategorySetAssetSourcesAction::ofAssetKey($assetKey)
                    ->setSources(AssetSourceCollection::of()->add($newSource))
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf(Category::class, $result);
        $this->assertContains(
            $newSource->getUri(),
            $result->getAssets()->current()->getSources()->current()->getUri()
        );
    }
}
