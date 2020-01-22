<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */


namespace Commercetools\Core\IntegrationTests\Product;

use Commercetools\Core\Builder\Request\RequestBuilder;
use Commercetools\Core\Fixtures\FixtureException;
use Commercetools\Core\IntegrationTests\ApiTestCase;
use Commercetools\Core\Error\DuplicateFieldError;
use Commercetools\Core\IntegrationTests\Category\CategoryFixture;
use Commercetools\Core\Model\Cart\LineItemDraft;
use Commercetools\Core\Model\Cart\LineItemDraftCollection;
use Commercetools\Core\Model\Category\Category;
use Commercetools\Core\Model\Common\Asset;
use Commercetools\Core\Model\Common\AssetDraft;
use Commercetools\Core\Model\Common\AssetSource;
use Commercetools\Core\Model\Common\AssetSourceCollection;
use Commercetools\Core\Model\Common\DiscountedPrice;
use Commercetools\Core\Model\Common\Image;
use Commercetools\Core\Model\Common\ImageDimension;
use Commercetools\Core\Model\Common\LocalizedString;
use Commercetools\Core\Model\Common\Money;
use Commercetools\Core\Model\Common\PriceDraft;
use Commercetools\Core\Model\Common\PriceDraftCollection;
use Commercetools\Core\Model\Product\LocalizedSearchKeywords;
use Commercetools\Core\Model\Product\Product;
use Commercetools\Core\Model\Product\ProductDraft;
use Commercetools\Core\Model\Product\ProductVariantDraft;
use Commercetools\Core\Model\Product\SearchKeyword;
use Commercetools\Core\Model\Product\SearchKeywords;
use Commercetools\Core\Model\ProductDiscount\ProductDiscountValue;
use Commercetools\Core\Model\ProductType\ProductType;
use Commercetools\Core\Model\State\State;
use Commercetools\Core\Model\TaxCategory\TaxCategory;
use Commercetools\Core\Request\Products\Command\ProductAddAssetAction;
use Commercetools\Core\Request\Products\Command\ProductAddExternalImageAction;
use Commercetools\Core\Request\Products\Command\ProductAddPriceAction;
use Commercetools\Core\Request\Products\Command\ProductAddToCategoryAction;
use Commercetools\Core\Request\Products\Command\ProductAddVariantAction;
use Commercetools\Core\Request\Products\Command\ProductChangeAssetNameAction;
use Commercetools\Core\Request\Products\Command\ProductChangeMasterVariantAction;
use Commercetools\Core\Request\Products\Command\ProductChangeNameAction;
use Commercetools\Core\Request\Products\Command\ProductChangePriceAction;
use Commercetools\Core\Request\Products\Command\ProductChangeSlugAction;
use Commercetools\Core\Request\Products\Command\ProductPublishAction;
use Commercetools\Core\Request\Products\Command\ProductRemoveFromCategoryAction;
use Commercetools\Core\Request\Products\Command\ProductRemovePriceAction;
use Commercetools\Core\Request\Products\Command\ProductRemoveVariantAction;
use Commercetools\Core\Request\Products\Command\ProductRevertStagedChangesAction;
use Commercetools\Core\Request\Products\Command\ProductRevertStagedVariantChangesAction;
use Commercetools\Core\Request\Products\Command\ProductSetAssetDescriptionAction;
use Commercetools\Core\Request\Products\Command\ProductSetAssetKeyAction;
use Commercetools\Core\Request\Products\Command\ProductSetAssetSourcesAction;
use Commercetools\Core\Request\Products\Command\ProductSetAssetTagsAction;
use Commercetools\Core\Request\Products\Command\ProductSetAttributeAction;
use Commercetools\Core\Request\Products\Command\ProductSetAttributeInAllVariantsAction;
use Commercetools\Core\Request\Products\Command\ProductSetCategoryOrderHintAction;
use Commercetools\Core\Request\Products\Command\ProductSetDescriptionAction;
use Commercetools\Core\Request\Products\Command\ProductSetDiscountedPriceAction;
use Commercetools\Core\Request\Products\Command\ProductSetKeyAction;
use Commercetools\Core\Request\Products\Command\ProductSetMetaDescriptionAction;
use Commercetools\Core\Request\Products\Command\ProductSetMetaKeywordsAction;
use Commercetools\Core\Request\Products\Command\ProductSetMetaTitleAction;
use Commercetools\Core\Request\Products\Command\ProductSetPriceCustomFieldAction;
use Commercetools\Core\Request\Products\Command\ProductSetPriceCustomTypeAction;
use Commercetools\Core\Request\Products\Command\ProductSetPricesAction;
use Commercetools\Core\Request\Products\Command\ProductSetProductVariantKeyAction;
use Commercetools\Core\Request\Products\Command\ProductSetSearchKeywordsAction;
use Commercetools\Core\Request\Products\Command\ProductSetSkuNotStageableAction;
use Commercetools\Core\Request\Products\Command\ProductSetSkuAction;
use Commercetools\Core\Request\Products\Command\ProductSetTaxCategoryAction;
use Commercetools\Core\Request\Products\Command\ProductTransitionStateAction;
use Commercetools\Core\Request\Products\Command\ProductUnpublishAction;
use Commercetools\Core\Request\Products\ProductCreateRequest;
use Commercetools\Core\Request\Products\ProductDeleteRequest;
use Commercetools\Core\Request\Products\ProductUpdateByKeyRequest;
use Commercetools\Core\Request\Products\ProductUpdateRequest;
use Commercetools\Core\Response\ErrorResponse;
use Commercetools\Core\IntegrationTests\TestHelper;

class ProductUpdateRequestTest extends ApiTestCase
{
    private $productId;

//    public function tearDown(): void
//    {
//        $request = ProductUpdateRequest::ofIdAndVersion($this->productId, $this->deleteRequest->getVersion())
//            ->addAction(ProductUnpublishAction::of())
//        ;
//        $response = $request->executeWithClient($this->getClient());
//        if (!$response->isError()) {
//            $result = $request->mapResponse($response);
//            $this->deleteRequest->setVersion($result->getVersion());
//        }
//
//        parent::tearDown();
//    }

    /**
     * @param Product $result
     * @return \Commercetools\Core\Model\Common\PriceCollection
     */
    protected function getCurrentPrices(Product $result)
    {
        return $result->getMasterData()->getCurrent()->getMasterVariant()->getPrices();
    }


    public function testCreatePublish()
    {
        $client = $this->getApiClient();

        ProductFixture::withUpdateableDraftProduct(
            $client,
            function (ProductDraft $draft) {
                return $draft->setPublish(true);
            },
            function (Product $product) use ($client) {
                $this->assertTrue($product->getMasterData()->getPublished());

                $request = RequestBuilder::of()->products()->update($product)->addAction(ProductUnpublishAction::of());
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                return $result;
            }
        );
    }

    public function testChangeName()
    {
        $client = $this->getApiClient();

        ProductFixture::withUpdateableProduct(
            $client,
            function (Product $product) use ($client) {
                $name = 'new name-' . ProductFixture::uniqueProductString();

                $request = RequestBuilder::of()->products()->update($product)
                    ->addAction(
                        ProductChangeNameAction::ofName(
                            LocalizedString::ofLangAndText('en', $name)
                        )
                    );
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(Product::class, $result);
                $this->assertNotSame($name, $result->getMasterData()->getCurrent()->getName()->en);
                $this->assertSame($name, $result->getMasterData()->getStaged()->getName()->en);
                $this->assertNotSame($product->getVersion(), $result->getVersion());

                return $result;
            }
        );
    }

    public function testExternalImage()
    {
        $client = $this->getApiClient();

        ProductFixture::withUpdateableProduct(
            $client,
            function (Product $product) use ($client) {
                $variant = $product->getMasterData()->getCurrent()->getMasterVariant();

                $request = RequestBuilder::of()->products()->update($product)
                    ->addAction(
                        ProductAddExternalImageAction::ofVariantIdAndImage(
                            $variant->getId(),
                            Image::of()
                                ->setLabel('testLabel')
                                ->setUrl('testUri#test1')
                                ->setDimensions(ImageDimension::of()->setW(60)->setH(60))
                        )
                    )
                    ->addAction(
                        ProductAddExternalImageAction::ofVariantIdAndImage(
                            $variant->getId(),
                            Image::of()
                                ->setLabel('testLabel')
                                ->setUrl('testUri#test2')
                                ->setDimensions(ImageDimension::of()->setW(60)->setH(60))
                        )
                    );
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(Product::class, $result);
                $this->assertCount(0, $result->getMasterData()->getCurrent()->getMasterVariant()->getImages());
                $this->assertCount(2, $result->getMasterData()->getStaged()->getMasterVariant()->getImages());
                $this->assertSame(
                    'testUri#test1',
                    $result->getMasterData()->getStaged()->getMasterVariant()->getImages()->getAt(0)->getUrl()
                );
                $this->assertSame(
                    'testUri#test2',
                    $result->getMasterData()->getStaged()->getMasterVariant()->getImages()->getAt(1)->getUrl()
                );
                $this->assertNotSame($product->getVersion(), $result->getVersion());

                return $result;
            }
        );
    }

    public function testSetDescription()
    {
        $client = $this->getApiClient();

        ProductFixture::withUpdateableProduct(
            $client,
            function (Product $product) use ($client) {
                $description = 'new description-' . ProductFixture::uniqueProductString();

                $request = RequestBuilder::of()->products()->update($product)
                    ->addAction(
                        ProductSetDescriptionAction::ofDescription(
                            LocalizedString::ofLangAndText('en', $description)
                        )
                    );
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(Product::class, $result);
                $this->assertSame($description, $result->getMasterData()->getStaged()->getDescription()->en);
                $this->assertNotSame($product->getVersion(), $result->getVersion());

                return $result;
            }
        );
    }

    public function testChangeSlug()
    {
        $client = $this->getApiClient();

        ProductFixture::withUpdateableProduct(
            $client,
            function (Product $product) use ($client) {
                $slug = 'new-slug-' . ProductFixture::uniqueProductString();

                $request = RequestBuilder::of()->products()->update($product)
                    ->addAction(
                        ProductChangeSlugAction::ofSlug(
                            LocalizedString::ofLangAndText('en', $slug)
                        )
                    );
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(Product::class, $result);
                $this->assertNotSame($slug, $result->getMasterData()->getCurrent()->getSlug()->en);
                $this->assertSame($slug, $result->getMasterData()->getStaged()->getSlug()->en);
                $this->assertNotSame($product->getVersion(), $result->getVersion());

                return $result;
            }
        );
    }

    public function testVariants()
    {
        $client = $this->getApiClient();

        ProductFixture::withUpdateableProduct(
            $client,
            function (Product $product) use ($client) {
                $sku = 'sku-' . ProductFixture::uniqueProductString();

                $request = RequestBuilder::of()->products()->update($product)
                    ->addAction(
                        ProductAddVariantAction::of()->setSku($sku)->setKey($sku)
                    );
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(Product::class, $result);
                $this->assertEmpty($result->getMasterData()->getCurrent()->getVariants());
                $this->assertSame($sku, $result->getMasterData()->getStaged()->getVariants()->current()->getSku());
                $this->assertSame($sku, $result->getMasterData()->getStaged()->getVariants()->current()->getKey());
                $this->assertNotSame($product->getVersion(), $result->getVersion());

                $product = $result;

                $request = RequestBuilder::of()->products()->update($product)
                    ->addAction(
                        ProductRemoveVariantAction::ofVariantId(
                            $result->getMasterData()->getStaged()->getVariants()->current()->getId()
                        )
                    );
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(Product::class, $result);
                $this->assertEmpty($result->getMasterData()->getCurrent()->getVariants());
                $this->assertEmpty($result->getMasterData()->getStaged()->getVariants());
                $this->assertNotSame($product->getVersion(), $result->getVersion());

                return $result;
            }
        );
    }

    public function testChangeMasterVariant()
    {
        $client = $this->getApiClient();

        ProductFixture::withUpdateableDraftProduct(
            $client,
            function (ProductDraft $draft) {
                return $draft->setMasterVariant(
                    ProductVariantDraft::ofSku('master-sku-' . ProductFixture::uniqueProductString())
                );
            },
            function (Product $product) use ($client) {
                $sku = 'sku-' . ProductFixture::uniqueProductString();

                $request = RequestBuilder::of()->products()->update($product)
                    ->addAction(
                        ProductAddVariantAction::of()->setSku($sku)
                    );
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(Product::class, $result);
                $this->assertEmpty($result->getMasterData()->getCurrent()->getVariants());
                $this->assertSame($sku, $result->getMasterData()->getStaged()->getVariants()->current()->getSku());
                $this->assertNotSame($product->getVersion(), $result->getVersion());

                $product = $result;
                $masterVariantSku =  $result->getMasterData()->getStaged()->getMasterVariant()->getSku();
                $variantSku =  $result->getMasterData()->getStaged()->getVariants()->current()->getSku();

                $request = RequestBuilder::of()->products()->update($product)
                    ->addAction(
                        ProductChangeMasterVariantAction::ofVariantId(
                            $result->getMasterData()->getStaged()->getVariants()->current()->getId()
                        )
                    );
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(Product::class, $result);
                $this->assertEmpty($result->getMasterData()->getCurrent()->getVariants());
                $this->assertSame(
                    $masterVariantSku,
                    $result->getMasterData()->getStaged()->getVariants()->current()->getSku()
                );
                $this->assertSame($variantSku, $result->getMasterData()->getStaged()->getMasterVariant()->getSku());
                $this->assertNotSame($product->getVersion(), $result->getVersion());

                $product = $result;

                $request = RequestBuilder::of()->products()->update($product)
                    ->addAction(
                        ProductChangeMasterVariantAction::ofSku(
                            $result->getMasterData()->getStaged()->getVariants()->current()->getSku()
                        )
                    );
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(Product::class, $result);
                $this->assertEmpty($result->getMasterData()->getCurrent()->getVariants());
                $this->assertSame(
                    $variantSku,
                    $result->getMasterData()->getStaged()->getVariants()->current()->getSku()
                );
                $this->assertSame(
                    $masterVariantSku,
                    $result->getMasterData()->getStaged()->getMasterVariant()->getSku()
                );
                $this->assertNotSame($product->getVersion(), $result->getVersion());

                return $result;
            }
        );
    }

    public function testVariantsWithSku()
    {
        $client = $this->getApiClient();

        ProductFixture::withUpdateableProduct(
            $client,
            function (Product $product) use ($client) {
                $sku = 'sku-' . ProductFixture::uniqueProductString();

                $request = RequestBuilder::of()->products()->update($product)
                    ->addAction(
                        ProductAddVariantAction::of()->setSku($sku)
                    );
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(Product::class, $result);
                $this->assertEmpty($result->getMasterData()->getCurrent()->getVariants());
                $this->assertSame($sku, $result->getMasterData()->getStaged()->getVariants()->current()->getSku());
                $this->assertNotSame($product->getVersion(), $result->getVersion());

                $product = $result;

                $request = RequestBuilder::of()->products()->update($product)
                    ->addAction(
                        ProductRemoveVariantAction::ofSku(
                            $result->getMasterData()->getStaged()->getVariants()->current()->getSku()
                        )
                    );
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(Product::class, $result);
                $this->assertEmpty($result->getMasterData()->getCurrent()->getVariants());
                $this->assertEmpty($result->getMasterData()->getStaged()->getVariants());
                $this->assertNotSame($product->getVersion(), $result->getVersion());

                return $result;
            }
        );
    }

    public function testPrices()
    {
        $client = $this->getApiClient();

        ProductFixture::withUpdateableDraftProduct(
            $client,
            function (ProductDraft $draft) {
                $draft->getMasterVariant()->setPrices(PriceDraftCollection::of());

                return $draft;
            },
            function (Product $product) use ($client) {
                $price = PriceDraft::ofMoney(Money::ofCurrencyAndAmount('USD', 300));

                $request = RequestBuilder::of()->products()->update($product)
                    ->addAction(
                        ProductAddPriceAction::ofVariantIdAndPrice(
                            $product->getMasterData()->getCurrent()->getMasterVariant()->getId(),
                            $price
                        )
                    )->currency('USD');
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $variant = $result->getMasterData()->getStaged()->getMasterVariant();

                $this->assertInstanceOf(Product::class, $result);
                $this->assertEmpty($result->getMasterData()->getCurrent()->getMasterVariant()->getPrices());
                $this->assertSame(
                    $price->getValue()->getCentAmount(),
                    $variant->getPrices()->current()->getValue()->getCentAmount()
                );

                $this->assertEmpty($variant->getPrice()->getCountry());
                $this->assertEmpty($variant->getPrice()->getChannel());
                $this->assertEmpty($variant->getPrice()->getCustomerGroup());
                $this->assertSame('USD', $variant->getPrice()->getValue()->getCurrencyCode());
                $this->assertSame(300, $variant->getPrice()->getValue()->getCentAmount());
                $this->assertNotSame($product->getVersion(), $result->getVersion());

                $product = $result;
                $price = PriceDraft::ofMoney(Money::ofCurrencyAndAmount('USD', 400));

                $request = RequestBuilder::of()->products()->update($product)
                    ->addAction(
                        ProductChangePriceAction::ofPriceIdAndPrice(
                            $variant->getPrices()->current()->getId(),
                            $price
                        )
                    );
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $variant = $result->getMasterData()->getStaged()->getMasterVariant();
                $this->assertInstanceOf(Product::class, $result);
                $this->assertEmpty($result->getMasterData()->getCurrent()->getMasterVariant()->getPrices());
                $this->assertSame(
                    $price->getValue()->getCentAmount(),
                    $variant->getPrices()->current()->getValue()->getCentAmount()
                );
                $this->assertNotSame($product->getVersion(), $result->getVersion());

                $product = $result;

                $request = RequestBuilder::of()->products()->update($product)
                    ->addAction(
                        ProductRemovePriceAction::ofPriceId(
                            $variant->getPrices()->current()->getId()
                        )
                    );
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(Product::class, $result);
                $this->assertEmpty($result->getMasterData()->getCurrent()->getMasterVariant()->getPrices());
                $this->assertEmpty($result->getMasterData()->getStaged()->getMasterVariant()->getPrices());
                $this->assertNotSame($product->getVersion(), $result->getVersion());

                return $result;
            }
        );
    }

    public function testPricesWithSku()
    {
        $client = $this->getApiClient();

        ProductFixture::withUpdateableDraftProduct(
            $client,
            function (ProductDraft $draft) {
                return $draft->setMasterVariant(ProductVariantDraft::ofSku(ProductFixture::uniqueProductString()));
            },
            function (Product $product) use ($client) {
                $price = PriceDraft::ofMoney(Money::ofCurrencyAndAmount('EUR', 100));

                $request = RequestBuilder::of()->products()->update($product)
                    ->addAction(
                        ProductAddPriceAction::ofSkuAndPrice(
                            $product->getMasterData()->getCurrent()->getMasterVariant()->getSku(),
                            $price
                        )
                    );
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $variant = $result->getMasterData()->getStaged()->getMasterVariant();
                $this->assertInstanceOf(Product::class, $result);
                $this->assertEmpty($result->getMasterData()->getCurrent()->getMasterVariant()->getPrices());
                $this->assertSame(
                    $price->getValue()->getCentAmount(),
                    $variant->getPrices()->current()->getValue()->getCentAmount()
                );
                $this->assertNotSame($product->getVersion(), $result->getVersion());

                $product = $result;
                $price = PriceDraft::ofMoney(Money::ofCurrencyAndAmount('EUR', 200));

                $request = RequestBuilder::of()->products()->update($product)
                    ->addAction(
                        ProductChangePriceAction::ofPriceIdAndPrice(
                            $variant->getPrices()->current()->getId(),
                            $price
                        )
                    );
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $variant = $result->getMasterData()->getStaged()->getMasterVariant();
                $this->assertInstanceOf(Product::class, $result);
                $this->assertEmpty($result->getMasterData()->getCurrent()->getMasterVariant()->getPrices());
                $this->assertSame(
                    $price->getValue()->getCentAmount(),
                    $variant->getPrices()->current()->getValue()->getCentAmount()
                );
                $this->assertNotSame($product->getVersion(), $result->getVersion());

                $product = $result;
                $price = PriceDraft::ofMoney(Money::ofCurrencyAndAmount('EUR', 300));
                $prices = PriceDraftCollection::of()->add($price);

                $request = RequestBuilder::of()->products()->update($product)
                    ->addAction(
                        ProductSetPricesAction::ofSkuAndPrices(
                            $variant->getSku(),
                            $prices
                        )
                    );
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $variant = $result->getMasterData()->getStaged()->getMasterVariant();
                $this->assertInstanceOf(Product::class, $result);
                $this->assertEmpty($result->getMasterData()->getCurrent()->getMasterVariant()->getPrices());
                $this->assertSame(
                    $price->getValue()->getCentAmount(),
                    $variant->getPrices()->current()->getValue()->getCentAmount()
                );
                $this->assertNotSame($product->getVersion(), $result->getVersion());

                $product = $result;

                $request = RequestBuilder::of()->products()->update($product)
                    ->addAction(
                        ProductRemovePriceAction::ofPriceId(
                            $variant->getPrices()->current()->getId()
                        )
                    );
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(Product::class, $result);
                $this->assertEmpty($result->getMasterData()->getCurrent()->getMasterVariant()->getPrices());
                $this->assertEmpty($result->getMasterData()->getStaged()->getMasterVariant()->getPrices());
                $this->assertNotSame($product->getVersion(), $result->getVersion());

                return $result;
            }
        );
    }

    public function testAttribute()
    {
        $client = $this->getApiClient();

        ProductFixture::withUpdateableDraftProduct(
            $client,
            function (ProductDraft $draft) {
                $draft->getMasterVariant()->setPrices(PriceDraftCollection::of());

                return $draft;
            },
            function (Product $product, ProductType $productType) use ($client) {
                $attributeValue = 'new value-' . ProductFixture::uniqueProductString();
                $name = 'testField';

                $request = RequestBuilder::of()->products()->update($product)
                    ->addAction(
                        ProductSetAttributeAction::ofVariantIdAndName(
                            $product->getMasterData()->getCurrent()->getMasterVariant()->getId(),
                            $name
                        )->setValue($attributeValue)
                    );
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $variant = $result->getMasterData()->getStaged()->getMasterVariant();
                $variant->getAttributes()->setAttributeDefinitions($productType->getAttributes());
                $this->assertInstanceOf(Product::class, $result);
                $this->assertEmpty($result->getMasterData()->getCurrent()->getMasterVariant()->getPrices());
                $this->assertSame(
                    $attributeValue,
                    $variant->getAttributes()->getByName($name)->getValue()
                );
                $this->assertNotSame($product->getVersion(), $result->getVersion());

                $product = $result;
                $attributeValue = 'new all value-' . ProductFixture::uniqueProductString();

                $request = RequestBuilder::of()->products()->update($product)
                    ->addAction(
                        ProductSetAttributeInAllVariantsAction::ofName(
                            $name
                        )->setValue($attributeValue)
                    );
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $variant = $result->getMasterData()->getStaged()->getMasterVariant();
                $variant->getAttributes()->setAttributeDefinitions($productType->getAttributes());
                $this->assertInstanceOf(Product::class, $result);
                $this->assertEmpty($result->getMasterData()->getCurrent()->getMasterVariant()->getPrices());
                $this->assertSame(
                    $attributeValue,
                    $variant->getAttributes()->getByName($name)->getValue()
                );
                $this->assertNotSame($product->getVersion(), $result->getVersion());

                return $result;
            }
        );
    }

    public function testAttributeWithSKu()
    {
        $client = $this->getApiClient();

        ProductFixture::withUpdateableDraftProduct(
            $client,
            function (ProductDraft $draft) {
                return $draft->setMasterVariant(ProductVariantDraft::ofSku(ProductFixture::uniqueProductString()));
            },
            function (Product $product, ProductType $productType) use ($client) {
                $attributeValue = 'new value-' . ProductFixture::uniqueProductString();
                $name = 'testField';

                $request = RequestBuilder::of()->products()->update($product)
                    ->addAction(
                        ProductSetAttributeAction::ofSkuAndName(
                            $product->getMasterData()->getCurrent()->getMasterVariant()->getSku(),
                            $name
                        )->setValue($attributeValue)
                    );
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $variant = $result->getMasterData()->getStaged()->getMasterVariant();
                $variant->getAttributes()->setAttributeDefinitions($this->getProductType()->getAttributes());
                $this->assertInstanceOf(Product::class, $result);
                $this->assertEmpty($result->getMasterData()->getCurrent()->getMasterVariant()->getPrices());
                $this->assertSame(
                    $attributeValue,
                    $variant->getAttributes()->getByName($name)->getValue()
                );
                $this->assertNotSame($product->getVersion(), $result->getVersion());

                $product = $result;
                $attributeValue = 'new all value-' . ProductFixture::uniqueProductString();

                $request = RequestBuilder::of()->products()->update($product)
                    ->addAction(
                        ProductSetAttributeInAllVariantsAction::ofName(
                            $name
                        )->setValue($attributeValue)
                    );
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $variant = $result->getMasterData()->getStaged()->getMasterVariant();
                $variant->getAttributes()->setAttributeDefinitions($this->getProductType()->getAttributes());
                $this->assertInstanceOf(Product::class, $result);
                $this->assertEmpty($result->getMasterData()->getCurrent()->getMasterVariant()->getPrices());
                $this->assertSame(
                    $attributeValue,
                    $variant->getAttributes()->getByName($name)->getValue()
                );
                $this->assertNotSame($product->getVersion(), $result->getVersion());

                return $result;
            }
        );
    }

    public function testCategory()
    {
        $client = $this->getApiClient();

        CategoryFixture::withCategory(
            $client,
            function (Category $category) use ($client) {
                ProductFixture::withUpdateableProduct(
                    $client,
                    function (Product $product) use ($client, $category) {
                        $request = RequestBuilder::of()->products()->update($product)
                            ->addAction(ProductAddToCategoryAction::ofCategory($category->getReference()));
                        $response = $this->execute($client, $request);
                        $result = $request->mapFromResponse($response);

                        $this->assertInstanceOf(Product::class, $result);
                        $this->assertEmpty($product->getMasterData()->getCurrent()->getCategories());
                        $this->assertSame(
                            $category->getId(),
                            $result->getMasterData()->getStaged()->getCategories()->current()->getId()
                        );
                        $this->assertNotSame($product->getVersion(), $result->getVersion());
                        $product = $result;

                        $orderHint = '0.9' . trim((string)mt_rand(1, TestHelper::RAND_MAX), '0');

                        $request = RequestBuilder::of()->products()->update($product)
                            ->addAction(
                                ProductSetCategoryOrderHintAction::ofCategoryId(
                                    $category->getId()
                                )->setOrderHint($orderHint)
                            );
                        $response = $this->execute($client, $request);
                        $result = $request->mapFromResponse($response);

                        $this->assertInstanceOf(Product::class, $result);
                        $this->assertEmpty($product->getMasterData()->getCurrent()->getCategoryOrderHints());
                        $this->assertSame(
                            $orderHint,
                            $result->getMasterData()->getStaged()->getCategoryOrderHints()[$category->getId()]
                        );
                        $this->assertNotSame($product->getVersion(), $result->getVersion());
                        $product = $result;

                        $request = RequestBuilder::of()->products()->update($product)
                            ->addAction(
                                ProductRemoveFromCategoryAction::ofCategory($category->getReference())
                            );
                        $response = $this->execute($client, $request);
                        $result = $request->mapFromResponse($response);

                        $this->assertInstanceOf(Product::class, $result);
                        $this->assertEmpty($result->getMasterData()->getCurrent()->getCategories());
                        $this->assertEmpty($result->getMasterData()->getStaged()->getCategories());
                        $this->assertNotSame($product->getVersion(), $result->getVersion());

                        return $result;
                    }
                );
            }
        );
    }
//todo to migrate
    public function testTaxCategory()
    {
        $draft = $this->getDraft('tax-category');
        $product = $this->createProduct($draft);

        $taxCategory = $this->getTaxCategory();
        $request = ProductUpdateRequest::ofIdAndVersion($product->getId(), $product->getVersion())
            ->addAction(ProductSetTaxCategoryAction::of()->setTaxCategory($taxCategory->getReference()))
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf(Product::class, $result);
        $this->assertSame(
            $taxCategory->getId(),
            $result->getTaxCategory()->getId()
        );
        $this->assertNotSame($product->getVersion(), $result->getVersion());
    }

    public function testSkuStaged()
    {
        $client = $this->getApiClient();

        ProductFixture::withUpdateableProduct(
            $client,
            function (Product $product) use ($client) {
                $sku = 'sku-' . ProductFixture::uniqueProductString();

                $request = RequestBuilder::of()->products()->update($product)
                    ->addAction(
                        ProductSetSkuAction::ofVariantId(
                            $product->getMasterData()->getCurrent()->getMasterVariant()->getId()
                        )->setSku($sku)
                    );
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(Product::class, $result);
                $this->assertSame(
                    $sku,
                    $result->getMasterData()->getStaged()->getMasterVariant()->getSku()
                );
                $this->assertNotSame($product->getVersion(), $result->getVersion());

                $product = $result;

                $request = RequestBuilder::of()->products()->update($product)
                    ->addAction(ProductPublishAction::of());
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(Product::class, $result);
                $this->assertSame(
                    $sku,
                    $result->getMasterData()->getStaged()->getMasterVariant()->getSku()
                );
                $this->assertSame(
                    $sku,
                    $result->getMasterData()->getCurrent()->getMasterVariant()->getSku()
                );
                $this->assertNotSame($product->getVersion(), $result->getVersion());

                $product = $result;

                $request = RequestBuilder::of()->products()->update($product)
                    ->addAction(ProductUnpublishAction::of());
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                return $result;
            }
        );
    }

    public function testSkuAlreadyExistsStaged()
    {
        $client = $this->getApiClient();
        $this->expectException(FixtureException::class);
        $this->expectExceptionCode(400);

        ProductFixture::withProduct(
            $client,
            function (Product $product2) use ($client) {
                ProductFixture::withUpdateableProduct(
                    $client,
                    function (Product $product1) use ($client, $product2) {
                        $sku = 'sku-' . ProductFixture::uniqueProductString();

                        $request = RequestBuilder::of()->products()->update($product2)
                            ->addAction(
                                ProductSetSkuAction::ofVariantId(
                                    $product2->getMasterData()->getCurrent()->getMasterVariant()->getId()
                                )->setSku($sku)
                            );
                        $response = $this->execute($client, $request);
                        $request->mapFromResponse($response);

                        $request = RequestBuilder::of()->products()->update($product1)
                            ->addAction(
                                ProductSetSkuAction::ofVariantId(
                                    $product1->getMasterData()->getCurrent()->getMasterVariant()->getId()
                                )->setSku($sku)
                            );
                        $this->execute($client, $request);

                        $request = RequestBuilder::of()->products()->update($product1)
                            ->addAction(
                                ProductSetSkuAction::ofVariantId(
                                    $product1->getMasterData()->getCurrent()->getMasterVariant()->getId()
                                )->setSku($sku)
                            );
                        $response = $this->execute($client, $request);

                        $result = $request->mapFromResponse($response);

                        return $result;
                    }
                );
            }
        );
    }

    public function testSearchKeyword()
    {
        $client = $this->getApiClient();

        ProductFixture::withUpdateableProduct(
            $client,
            function (Product $product) use ($client) {
                $keyword = 'keyword-' . ProductFixture::uniqueProductString();

                $request = RequestBuilder::of()->products()->update($product)
                    ->addAction(
                        ProductSetSearchKeywordsAction::ofKeywords(
                            LocalizedSearchKeywords::of()->setAt(
                                'en',
                                SearchKeywords::of()->add(SearchKeyword::of()->setText($keyword))
                            )
                        )
                    );
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(Product::class, $result);
                $this->assertEmpty($result->getMasterData()->getCurrent()->getSearchKeywords());
                $this->assertSame(
                    $keyword,
                    $result->getMasterData()->getStaged()->getSearchKeywords()->en->current()->getText()
                );
                $this->assertNotSame($product->getVersion(), $result->getVersion());

                return $result;
            }
        );
    }

    public function testMetaTitle()
    {
        $client = $this->getApiClient();

        ProductFixture::withUpdateableProduct(
            $client,
            function (Product $product) use ($client) {
                $metaTitle = 'meta-title-' . ProductFixture::uniqueProductString();

                $request = RequestBuilder::of()->products()->update($product)
                    ->addAction(
                        ProductSetMetaTitleAction::of()->setMetaTitle(
                            LocalizedString::ofLangAndText('en', $metaTitle)
                        )
                    );
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(Product::class, $result);
                $this->assertNull($result->getMasterData()->getCurrent()->getMetaTitle());
                $this->assertSame(
                    $metaTitle,
                    $result->getMasterData()->getStaged()->getMetaTitle()->en
                );
                $this->assertNotSame($product->getVersion(), $result->getVersion());

                return $result;
            }
        );
    }

    public function testMetaTitlePublish()
    {
        $client = $this->getApiClient();

        ProductFixture::withUpdateableProduct(
            $client,
            function (Product $product) use ($client) {
                $metaTitle = 'meta-title-' . ProductFixture::uniqueProductString();

                $request = RequestBuilder::of()->products()->update($product)
                    ->addAction(
                        ProductSetMetaTitleAction::of()->setMetaTitle(
                            LocalizedString::ofLangAndText('en', $metaTitle)
                        )->setStaged(false)
                    );
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(Product::class, $result);
                $this->assertSame(
                    $metaTitle,
                    $result->getMasterData()->getCurrent()->getMetaTitle()->en
                );
                $this->assertNotSame($product->getVersion(), $result->getVersion());

                return $result;
            }
        );
    }

    public function testMetaDescription()
    {
        $client = $this->getApiClient();

        ProductFixture::withUpdateableProduct(
            $client,
            function (Product $product) use ($client) {
                $metaDescription = 'meta-description-' . ProductFixture::uniqueProductString();

                $request = RequestBuilder::of()->products()->update($product)
                    ->addAction(
                        ProductSetMetaDescriptionAction::of()->setMetaDescription(
                            LocalizedString::ofLangAndText('en', $metaDescription)
                        )
                    );
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(Product::class, $result);
                $this->assertNull($result->getMasterData()->getCurrent()->getMetaDescription());
                $this->assertSame(
                    $metaDescription,
                    $result->getMasterData()->getStaged()->getMetaDescription()->en
                );
                $this->assertNotSame($product->getVersion(), $result->getVersion());

                return $result;
            }
        );
    }

    public function testMetaDescriptionPublish()
    {
        $client = $this->getApiClient();

        ProductFixture::withUpdateableProduct(
            $client,
            function (Product $product) use ($client) {
                $metaDescription = 'meta-description-' . ProductFixture::uniqueProductString();

                $request = RequestBuilder::of()->products()->update($product)
                    ->addAction(
                        ProductSetMetaDescriptionAction::of()->setMetaDescription(
                            LocalizedString::ofLangAndText('en', $metaDescription)
                        )->setStaged(false)
                    );
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(Product::class, $result);
                $this->assertSame(
                    $metaDescription,
                    $result->getMasterData()->getCurrent()->getMetaDescription()->en
                );
                $this->assertNotSame($product->getVersion(), $result->getVersion());

                return $result;
            }
        );
    }

    public function testMetaKeywords()
    {
        $client = $this->getApiClient();

        ProductFixture::withUpdateableProduct(
            $client,
            function (Product $product) use ($client) {
                $metaKeywords = 'meta-keywords-' . ProductFixture::uniqueProductString();

                $request = RequestBuilder::of()->products()->update($product)
                    ->addAction(
                        ProductSetMetaKeywordsAction::of()->setMetaKeywords(
                            LocalizedString::ofLangAndText('en', $metaKeywords)
                        )
                    );
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(Product::class, $result);
                $this->assertNull($result->getMasterData()->getCurrent()->getMetaDescription());
                $this->assertSame(
                    $metaKeywords,
                    $result->getMasterData()->getStaged()->getMetaKeywords()->en
                );
                $this->assertNotSame($product->getVersion(), $result->getVersion());

                return $result;
            }
        );
    }

    public function testMetaKeywordsPublish()
    {
        $client = $this->getApiClient();

        ProductFixture::withUpdateableProduct(
            $client,
            function (Product $product) use ($client) {
                $metaKeywords = 'meta-keywords-' . ProductFixture::uniqueProductString();

                $request = RequestBuilder::of()->products()->update($product)
                    ->addAction(
                        ProductSetMetaKeywordsAction::of()->setMetaKeywords(
                            LocalizedString::ofLangAndText('en', $metaKeywords)
                        )->setStaged(false)
                    );
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(Product::class, $result);
                $this->assertSame(
                    $metaKeywords,
                    $result->getMasterData()->getCurrent()->getMetaKeywords()->en
                );
                $this->assertNotSame($product->getVersion(), $result->getVersion());

                return $result;
            }
        );
    }

    public function testRevertStagedChanges()
    {
        $client = $this->getApiClient();

        ProductFixture::withUpdateableProduct(
            $client,
            function (Product $product) use ($client) {
                $request = RequestBuilder::of()->products()->update($product)
                    ->addAction(ProductPublishAction::of());
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $product = $result;
                $metaKeywords = 'meta-keywords-' . ProductFixture::uniqueProductString();

                $request = RequestBuilder::of()->products()->update($product)
                    ->addAction(
                        ProductSetMetaKeywordsAction::of()->setMetaKeywords(
                            LocalizedString::ofLangAndText('en', $metaKeywords)
                        )
                    );
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(Product::class, $result);
                $this->assertNull($result->getMasterData()->getCurrent()->getMetaDescription());
                $this->assertSame(
                    $metaKeywords,
                    $result->getMasterData()->getStaged()->getMetaKeywords()->en
                );
                $this->assertNotSame($product->getVersion(), $result->getVersion());

                $product = $result;

                $request = RequestBuilder::of()->products()->update($product)
                    ->addAction(ProductRevertStagedChangesAction::of());
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(Product::class, $result);
                $this->assertNull($result->getMasterData()->getCurrent()->getMetaDescription());
                $this->assertNull($result->getMasterData()->getStaged()->getMetaDescription());
                $this->assertNotSame($product->getVersion(), $result->getVersion());

                $product = $result;

                $request = RequestBuilder::of()->products()->update($product)
                    ->addAction(ProductUnpublishAction::of());
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                return $result;
            }
        );
    }

    public function testRevertStagedVariantChanges()
    {
        $client = $this->getApiClient();
        $sku = 'sku' . uniqid();

        ProductFixture::withUpdateableDraftProduct(
            $client,
            function (ProductDraft $draft) use ($sku) {

                $draft->setMasterVariant(ProductVariantDraft::ofSku($sku));

                return $draft;
            },
            function (Product $product) use ($client, $sku) {
                $request = RequestBuilder::of()->products()->update($product)
                    ->addAction(ProductPublishAction::of());
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $product = $result;
                $metaKeywords = 'meta-keywords-' . ProductFixture::uniqueProductString();
                $request = RequestBuilder::of()->products()->update($product)
                    ->addAction(
                        ProductSetMetaKeywordsAction::of()->setMetaKeywords(
                            LocalizedString::ofLangAndText('en', $metaKeywords)
                        )
                    )
                    ->addAction(
                        ProductAddPriceAction::ofSkuAndPrice(
                            $sku,
                            PriceDraft::ofMoney(Money::ofCurrencyAndAmount('EUR', 100))
                        )
                    );
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(Product::class, $result);
                $this->assertNull($result->getMasterData()->getCurrent()->getMetaDescription());
                $this->assertSame(
                    $metaKeywords,
                    $result->getMasterData()->getStaged()->getMetaKeywords()->en
                );
                $this->assertCount(0, $result->getMasterData()->getCurrent()->getMasterVariant()->getPrices());
                $this->assertCount(1, $result->getMasterData()->getStaged()->getMasterVariant()->getPrices());
                $this->assertNotSame($product->getVersion(), $result->getVersion());

                $product = $result;

                $request = RequestBuilder::of()->products()->update($product)
                    ->addAction(ProductRevertStagedVariantChangesAction::ofVariantId(1));
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(Product::class, $result);
                $this->assertNull($result->getMasterData()->getCurrent()->getMetaDescription());
                $this->assertSame(
                    $metaKeywords,
                    $result->getMasterData()->getStaged()->getMetaKeywords()->en
                );
                $this->assertCount(0, $result->getMasterData()->getCurrent()->getMasterVariant()->getPrices());
                $this->assertCount(0, $result->getMasterData()->getStaged()->getMasterVariant()->getPrices());
                $this->assertNotSame($product->getVersion(), $result->getVersion());

                $product = $result;

                $request = RequestBuilder::of()->products()->update($product)
                    ->addAction(ProductUnpublishAction::of());
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                return $result;
            }
        );
    }

    public function testPublish()
    {
        $client = $this->getApiClient();

        ProductFixture::withUpdateableProduct(
            $client,
            function (Product $product) use ($client) {
                $metaKeywords = 'meta-keywords-' . ProductFixture::uniqueProductString();

                $request = RequestBuilder::of()->products()->update($product)
                    ->addAction(
                        ProductSetMetaKeywordsAction::of()->setMetaKeywords(
                            LocalizedString::ofLangAndText('en', $metaKeywords)
                        )
                    )->addAction(ProductPublishAction::of());
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(Product::class, $result);
                $this->assertSame(
                    $metaKeywords,
                    $result->getMasterData()->getCurrent()->getMetaKeywords()->en
                );
                $this->assertSame(
                    $metaKeywords,
                    $result->getMasterData()->getStaged()->getMetaKeywords()->en
                );
                $this->assertNotSame($product->getVersion(), $result->getVersion());

                $product = $result;

                $request = RequestBuilder::of()->products()->update($product)
                    ->addAction(ProductUnpublishAction::of());
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(Product::class, $result);
                $this->assertFalse($result->getMasterData()->getPublished());
                $this->assertNotSame($product->getVersion(), $result->getVersion());

                return $result;
            }
        );
    }

    public function testPublishPrices()
    {
        $draft = $this->getDraft('publish-prices');
        $draft
            ->setMasterVariant(
                ProductVariantDraft::ofSkuAndPrices(
                    'sku-' . $this->getTestRun(),
                    PriceDraftCollection::of()
                            ->add(PriceDraft::ofMoney(Money::ofCurrencyAndAmount('EUR', 100)))
                )
            )->setPublish(true);
        $product = $this->createProduct($draft);
        $request = ProductUpdateRequest::ofIdAndVersion($product->getId(), $product->getVersion())
            ->addAction(ProductSetDescriptionAction::of()->setDescription(LocalizedString::ofLangAndText('en', $this->getTestRun())))
            ->addAction(
                ProductSetPricesAction::of()->setSku('sku-' . $this->getTestRun())
                    ->setPrices(PriceDraftCollection::of()
                        ->add(PriceDraft::ofMoney(Money::ofCurrencyAndAmount('EUR', 200))))
            )
            ->addAction(ProductPublishAction::of()->setScope(ProductPublishAction::PRICES))
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf(Product::class, $result);
        $this->assertTrue($result->getMasterData()->getHasStagedChanges());
        $this->assertSame(
            200,
            $result->getMasterData()->getCurrent()->getMasterVariant()->getPrices()->current()->getValue()->getCentAmount()
        );
        $this->assertNotSame($product->getVersion(), $result->getVersion());
        $product = $result;

        $request = ProductUpdateRequest::ofIdAndVersion($product->getId(), $product->getVersion())
            ->addAction(ProductPublishAction::of()->setScope(ProductPublishAction::ALL))
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf(Product::class, $result);
        $this->assertFalse($result->getMasterData()->getHasStagedChanges());
    }

    public function testTransitionStates()
    {
        $draft = $this->getDraft('publish');
        $product = $this->createProduct($draft);

        /**
         * @var State $state1
         * @var State $state2
         */
        list($state1, $state2) = $this->createStates('ProductState');
        $request = ProductUpdateRequest::ofIdAndVersion($product->getId(), $product->getVersion())
            ->addAction(
                ProductTransitionStateAction::ofState($state1->getReference())
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf(Product::class, $result);
        $this->assertSame(
            $state1->getId(),
            $result->getState()->getId()
        );
        $this->assertNotSame($product->getVersion(), $result->getVersion());
        $product = $result;

        $request = ProductUpdateRequest::ofIdAndVersion($product->getId(), $product->getVersion())
            ->addAction(
                ProductTransitionStateAction::ofState($state2->getReference())
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf(Product::class, $result);
        $this->assertSame(
            $state2->getId(),
            $result->getState()->getId()
        );
        $this->assertNotSame($product->getVersion(), $result->getVersion());
    }

    public function testPriceCustomType()
    {
        $draft = $this->getDraft('price-custom-type');
        $product = $this->createProduct($draft);

        $request = ProductUpdateRequest::ofIdAndVersion($product->getId(), $product->getVersion())
            ->addAction(
                ProductAddPriceAction::ofVariantIdAndPrice(
                    $product->getMasterData()->getCurrent()->getMasterVariant()->getId(),
                    PriceDraft::ofMoney(Money::ofCurrencyAndAmount('EUR', 100))
                )
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $product = $request->mapResponse($response);
        $this->deleteRequest->setVersion($product->getVersion());


        $type = $this->getType('mytype', 'product-price');
        $price = $product->getMasterData()->getStaged()->getMasterVariant()->getPrices()->current();
        $request = ProductUpdateRequest::ofIdAndVersion($product->getId(), $product->getVersion())
            ->addAction(
                ProductSetPriceCustomTypeAction::ofType($type->getReference())
                    ->setPriceId($price->getId())
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf(Product::class, $result);
        $this->assertEmpty($result->getMasterData()->getCurrent()->getMasterVariant()->getPrices());
        $variant = $result->getMasterData()->getStaged()->getMasterVariant();
        $this->assertSame(
            $type->getId(),
            $variant->getPrices()->current()->getCustom()->getType()->getId()
        );
        $this->assertNotSame($product->getVersion(), $result->getVersion());
    }

    public function testPriceCustomField()
    {
        $draft = $this->getDraft('price-custom-type');
        $product = $this->createProduct($draft);

        $request = ProductUpdateRequest::ofIdAndVersion($product->getId(), $product->getVersion())
            ->addAction(
                ProductAddPriceAction::ofVariantIdAndPrice(
                    $product->getMasterData()->getCurrent()->getMasterVariant()->getId(),
                    PriceDraft::ofMoney(Money::ofCurrencyAndAmount('EUR', 100))
                )
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $product = $request->mapResponse($response);
        $this->deleteRequest->setVersion($product->getVersion());

        $type = $this->getType('mytype', 'product-price');
        $price = $product->getMasterData()->getStaged()->getMasterVariant()->getPrices()->current();
        $request = ProductUpdateRequest::ofIdAndVersion($product->getId(), $product->getVersion())
            ->addAction(
                ProductSetPriceCustomTypeAction::ofType($type->getReference())
                    ->setPriceId($price->getId())
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $product = $request->mapResponse($response);
        $this->deleteRequest->setVersion($product->getVersion());

        $price = $product->getMasterData()->getStaged()->getMasterVariant()->getPrices()->current();
        $fieldValue = $this->getTestRun() . '-value';
        $request = ProductUpdateRequest::ofIdAndVersion($product->getId(), $product->getVersion())
            ->addAction(
                ProductSetPriceCustomFieldAction::ofName('testField')
                    ->setPriceId($price->getId())
                    ->setValue($fieldValue)
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());


        $this->assertInstanceOf(Product::class, $result);
        $this->assertEmpty($result->getMasterData()->getCurrent()->getMasterVariant()->getPrices());
        $variant = $result->getMasterData()->getStaged()->getMasterVariant();
        $this->assertSame(
            $fieldValue,
            $variant->getPrices()->current()->getCustom()->getFields()->getTestField()
        );
        $this->assertNotSame($product->getVersion(), $result->getVersion());
    }

    public function testReferenceExpansion()
    {
        $draft = $this->getDraft('update-reference-expansion');

        $request = ProductCreateRequest::ofDraft($draft);
        $request->expand('productType.id');
        $response = $request->executeWithClient($this->getClient());
        $product = $request->mapResponse($response);

        $this->cleanupRequests[] = $this->deleteRequest = ProductDeleteRequest::ofIdAndVersion(
            $product->getId(),
            $product->getVersion()
        );

        $this->assertInstanceOf(
            ProductType::class,
            $product->getProductType()->getObj()
        );

        $request = ProductUpdateRequest::ofIdAndVersion($product->getId(), $product->getVersion());
        $request->expand('productType.id');
        $response = $request->executeWithClient($this->getClient());
        $product = $request->mapResponse($response);
        $this->deleteRequest->setVersion($product->getVersion());

        $this->assertInstanceOf(
            ProductType::class,
            $product->getProductType()->getObj()
        );

        $request = ProductDeleteRequest::ofIdAndVersion($product->getId(), $product->getVersion());
        $request->expand('productType.id');
        $response = $request->executeWithClient($this->getClient());
        $product = $request->mapResponse($response);

        $this->assertInstanceOf(
            ProductType::class,
            $product->getProductType()->getObj()
        );
        array_pop($this->cleanupRequests);
    }

    public function testPriceSelectCreateUpdateDelete()
    {
        $draft = $this->getDraft('update-reference-expansion');
        $draft->setMasterVariant(
            ProductVariantDraft::ofSkuAndPrices(
                'sku' . uniqid(),
                PriceDraftCollection::of()->add(
                    PriceDraft::ofMoney(Money::ofCurrencyAndAmount('EUR', 100))
                )
            )
        );

        $request = ProductCreateRequest::ofDraft($draft);
        $request->currency('EUR');
        $response = $request->executeWithClient($this->getClient());
        $product = $request->mapResponse($response);

        $this->cleanupRequests[] = $this->deleteRequest = ProductDeleteRequest::ofIdAndVersion(
            $product->getId(),
            $product->getVersion()
        );

        $variant = $product->getMasterData()->getStaged()->getMasterVariant();
        $this->assertEmpty($variant->getPrice()->getCountry());
        $this->assertEmpty($variant->getPrice()->getChannel());
        $this->assertEmpty($variant->getPrice()->getCustomerGroup());
        $this->assertSame('EUR', $variant->getPrice()->getValue()->getCurrencyCode());
        $this->assertSame(100, $variant->getPrice()->getValue()->getCentAmount());

        $request = ProductUpdateRequest::ofIdAndVersion($product->getId(), $product->getVersion());
        $request->currency('EUR');
        $response = $request->executeWithClient($this->getClient());
        $product = $request->mapResponse($response);
        $this->deleteRequest->setVersion($product->getVersion());

        $variant = $product->getMasterData()->getStaged()->getMasterVariant();
        $this->assertEmpty($variant->getPrice()->getCountry());
        $this->assertEmpty($variant->getPrice()->getChannel());
        $this->assertEmpty($variant->getPrice()->getCustomerGroup());
        $this->assertSame('EUR', $variant->getPrice()->getValue()->getCurrencyCode());
        $this->assertSame(100, $variant->getPrice()->getValue()->getCentAmount());

        $request = ProductDeleteRequest::ofIdAndVersion($product->getId(), $product->getVersion());
        $request->currency('EUR');
        $response = $request->executeWithClient($this->getClient());
        $product = $request->mapResponse($response);

        $variant = $product->getMasterData()->getStaged()->getMasterVariant();
        $this->assertEmpty($variant->getPrice()->getCountry());
        $this->assertEmpty($variant->getPrice()->getChannel());
        $this->assertEmpty($variant->getPrice()->getCustomerGroup());
        $this->assertSame('EUR', $variant->getPrice()->getValue()->getCurrencyCode());
        $this->assertSame(100, $variant->getPrice()->getValue()->getCentAmount());

        array_pop($this->cleanupRequests);
    }

    public function testAssetsWithSKU()
    {
        $draft = $this->getDraft('assets');
        $draft->setMasterVariant(
            ProductVariantDraft::ofSku('sku' . uniqid())
        );
        $product = $this->createProduct($draft);

        $variant = $product->getMasterData()->getCurrent()->getMasterVariant();
        $assetDraft = AssetDraft::ofNameAndSources(
            LocalizedString::ofLangAndText('en', 'test'),
            AssetSourceCollection::of()->add(
                AssetSource::of()->setUri('test' . $this->getTestRun())
            )
        );
        $request = ProductUpdateRequest::ofIdAndVersion($product->getId(), $product->getVersion())
            ->addAction(ProductAddAssetAction::ofSkuAndAsset($variant->getSku(), $assetDraft))
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf(Product::class, $result);
        $this->assertNotSame($product->getVersion(), $result->getVersion());
        $asset = $result->getMasterData()->getStaged()->getMasterVariant()->getAssets()->current();
        $this->assertInstanceOf(Asset::class, $asset);
        $this->assertSame('test' . $this->getTestRun(), $asset->getSources()->current()->getUri());

        $product = $result;
        $assetKey = uniqid();
        $request = ProductUpdateRequest::ofIdAndVersion($product->getId(), $product->getVersion())
            ->addAction(
                ProductChangeAssetNameAction::ofSkuAssetIdAndName(
                    $variant->getSku(),
                    $asset->getId(),
                    LocalizedString::ofLangAndText('en', 'new-test')
                )
            )
            ->addAction(
                ProductSetAssetDescriptionAction::ofSkuAndAssetId(
                    $variant->getSku(),
                    $asset->getId()
                )->setDescription(LocalizedString::ofLangAndText('en', 'new-description'))
            )
            ->addAction(
                ProductSetAssetTagsAction::ofSkuAndAssetId(
                    $variant->getSku(),
                    $asset->getId()
                )->setTags(['123', 'abc'])
            )
            ->addAction(
                ProductSetAssetSourcesAction::ofSkuAndAssetId(
                    $variant->getSku(),
                    $asset->getId()
                )->setSources(
                    AssetSourceCollection::of()
                        ->add(AssetSource::of()->setUri('new-test' . $this->getTestRun()))
                )
            )
            ->addAction(
                ProductSetAssetKeyAction::ofSkuAssetIdAndAssetKey(
                    $variant->getSku(),
                    $asset->getId(),
                    $assetKey
                )
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf(Product::class, $result);
        $this->assertNotSame($product->getVersion(), $result->getVersion());

        $asset = $result->getMasterData()->getStaged()->getMasterVariant()->getAssets()->current();
        $this->assertInstanceOf(Asset::class, $asset);
        $this->assertSame($assetKey, $asset->getKey());
        $this->assertSame('new-test', $asset->getName()->en);
        $this->assertSame('new-description', $asset->getDescription()->en);
        $this->assertSame(['123', 'abc'], $asset->getTags());
        $this->assertSame('new-test' . $this->getTestRun(), $asset->getSources()->current()->getUri());
    }

    public function testAssetsWithSKUAndAssetKey()
    {
        $assetKey = uniqid();
        $draft = $this->getDraft('assets');
        $draft->setMasterVariant(
            ProductVariantDraft::ofSku('sku' . uniqid())
        );
        $product = $this->createProduct($draft);

        $variant = $product->getMasterData()->getCurrent()->getMasterVariant();
        $assetDraft = AssetDraft::ofKeySourcesAndName(
            $assetKey,
            AssetSourceCollection::of()->add(
                AssetSource::of()->setUri('test' . $this->getTestRun())
            ),
            LocalizedString::ofLangAndText('en', 'test')
        );
        $request = ProductUpdateRequest::ofIdAndVersion($product->getId(), $product->getVersion())
            ->addAction(ProductAddAssetAction::ofSkuAndAsset($variant->getSku(), $assetDraft))
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf(Product::class, $result);
        $this->assertNotSame($product->getVersion(), $result->getVersion());
        $asset = $result->getMasterData()->getStaged()->getMasterVariant()->getAssets()->current();
        $this->assertInstanceOf(Asset::class, $asset);
        $this->assertSame('test' . $this->getTestRun(), $asset->getSources()->current()->getUri());

        $product = $result;

        $request = ProductUpdateRequest::ofIdAndVersion($product->getId(), $product->getVersion())
            ->addAction(
                ProductChangeAssetNameAction::ofSkuAssetKeyAndName(
                    $variant->getSku(),
                    $assetKey,
                    LocalizedString::ofLangAndText('en', 'new-test')
                )
            )
            ->addAction(
                ProductSetAssetDescriptionAction::ofSkuAndAssetKey(
                    $variant->getSku(),
                    $assetKey
                )->setDescription(LocalizedString::ofLangAndText('en', 'new-description'))
            )
            ->addAction(
                ProductSetAssetTagsAction::ofSkuAndAssetKey(
                    $variant->getSku(),
                    $assetKey
                )->setTags(['123', 'abc'])
            )
            ->addAction(
                ProductSetAssetSourcesAction::ofSkuAndAssetKey(
                    $variant->getSku(),
                    $assetKey
                )->setSources(
                    AssetSourceCollection::of()
                        ->add(AssetSource::of()->setUri('new-test' . $this->getTestRun()))
                )
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf(Product::class, $result);
        $this->assertNotSame($product->getVersion(), $result->getVersion());

        $asset = $result->getMasterData()->getStaged()->getMasterVariant()->getAssets()->current();
        $this->assertInstanceOf(Asset::class, $asset);
        $this->assertSame('new-test', $asset->getName()->en);
        $this->assertSame('new-description', $asset->getDescription()->en);
        $this->assertSame(['123', 'abc'], $asset->getTags());
        $this->assertSame('new-test' . $this->getTestRun(), $asset->getSources()->current()->getUri());
    }

    public function testSetKey()
    {
        $draft = $this->getDraft('set-key');
        $product = $this->createProduct($draft);

        $key = $this->getTestRun() . '-new key';
        $request = ProductUpdateRequest::ofIdAndVersion($product->getId(), $product->getVersion())
            ->addAction(
                ProductSetKeyAction::ofKey($key)
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf(Product::class, $result);
        $this->assertNotSame($key, $draft->getKey());
        $this->assertSame($key, $result->getKey());
        $this->assertNotSame($product->getVersion(), $result->getVersion());
    }

    public function testSetSameKey()
    {
        $key = $this->getTestRun() . '-new key';
        $draft = $this->getDraft('set-key');
        $draft->setKey($key);
        $product = $this->createProduct($draft);

        $request = ProductUpdateRequest::ofIdAndVersion($product->getId(), $product->getVersion())
            ->addAction(
                ProductSetKeyAction::ofKey($key)
            )
        ;
        $response = $request->executeWithClient($this->getClient());

        $this->assertTrue($response->isError());
        $this->assertInstanceOf(
            DuplicateFieldError::class,
            $response->getErrors()->getByCode(DuplicateFieldError::CODE)
        );
    }

    public function testUpdateByKey()
    {
        $draft = $this->getDraft('set-key');
        $draft->setKey($this->getTestRun());
        $product = $this->createProduct($draft);

        $key = $this->getTestRun() . '-new key';

        $request = ProductUpdateByKeyRequest::ofKeyAndVersion($product->getKey(), $product->getVersion())
            ->addAction(
                ProductSetKeyAction::ofKey($key)
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf(Product::class, $result);
        $this->assertNotSame($key, $draft->getKey());
        $this->assertSame($key, $result->getKey());
        $this->assertNotSame($product->getVersion(), $result->getVersion());
    }

    public function testVariantSetKey()
    {
        $draft = $this->getDraft('set-variant-key');
        $product = $this->createProduct($draft);

        $variantId = $product->getMasterData()->getStaged()->getMasterVariant()->getId();
        $key = $this->getTestRun() . '-new key';

        $request = ProductUpdateRequest::ofIdAndVersion($product->getId(), $product->getVersion())
            ->addAction(
                ProductSetProductVariantKeyAction::ofVariantIdAndKey($variantId, $key)
            );
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf(Product::class, $result);
        $this->assertEmpty($result->getMasterData()->getCurrent()->getMasterVariant()->getKey());
        $this->assertSame($key, $result->getMasterData()->getStaged()->getMasterVariant()->getKey());
        $this->assertNotSame($product->getVersion(), $result->getVersion());
    }

    public function testSetDiscountedPrice()
    {
        $discount = $this->getProductDiscount(ProductDiscountValue::of()->setType('external'));
        $draft = $this->getDraft('set-discounted-price');
        $draft->setTaxCategory($this->getTaxCategory()->getReference());
        $draft->setMasterVariant(
            ProductVariantDraft::ofPrices(
                PriceDraftCollection::of()->add(
                    PriceDraft::ofMoney(Money::ofCurrencyAndAmount('EUR', 1000))
                )
            )
        );
        $product = $this->createProduct($draft);
        $variant = $product->getMasterData()->getCurrent()->getMasterVariant();

        $discountPrice = DiscountedPrice::ofMoneyAndDiscount(
            Money::ofCurrencyAndAmount('EUR', 900),
            $discount->getReference()
        );
        $request = ProductUpdateRequest::ofIdAndVersion($product->getId(), $product->getVersion())
            ->addAction(
                ProductSetDiscountedPriceAction::ofPriceId(
                    $variant->getPrices()->current()->getId()
                )->setDiscounted($discountPrice)
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf(Product::class, $result);
        $this->assertNotSame($product->getVersion(), $result->getVersion());

        $resultVariant = $result->getMasterData()->getStaged()->getMasterVariant();
        $this->assertSame(900, $resultVariant->getPrices()->current()->getCurrentValue()->getCentAmount());
    }

    public function testSetDiscountedPriceWithCart()
    {
        $discount = $this->getProductDiscount(ProductDiscountValue::of()->setType('external'));
        $draft = $this->getDraft('set-discounted-price');
        $draft->setTaxCategory($this->getTaxCategory()->getReference());
        $draft->setMasterVariant(
            ProductVariantDraft::ofPrices(
                PriceDraftCollection::of()->add(
                    PriceDraft::ofMoney(Money::ofCurrencyAndAmount('EUR', 1000))
                )
            )
        );
        $product = $this->createProduct($draft);
        $variant = $product->getMasterData()->getCurrent()->getMasterVariant();

        $discountPrice = DiscountedPrice::ofMoneyAndDiscount(
            Money::ofCurrencyAndAmount('EUR', 900),
            $discount->getReference()
        );
        $request = ProductUpdateRequest::ofIdAndVersion($product->getId(), $product->getVersion())
            ->addAction(
                ProductSetDiscountedPriceAction::ofPriceId(
                    $variant->getPrices()->current()->getId()
                )->setDiscounted($discountPrice)
            )->addAction(
                ProductPublishAction::of()
            )
        ;
        sleep(1);

        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf(Product::class, $result);
        $this->assertNotSame($product->getVersion(), $result->getVersion());

        $resultVariant = $result->getMasterData()->getStaged()->getMasterVariant();
        $this->assertSame(900, $resultVariant->getPrices()->current()->getCurrentValue()->getCentAmount());

        $cartDraft = $this->getCartDraft()->setLineItems(
            LineItemDraftCollection::of()->add(
                LineItemDraft::ofProductIdVariantIdAndQuantity($result->getId(), $resultVariant->getId(), 1)
            )
        );
        $cart = $this->getCart($cartDraft);
        $this->assertSame(900, $cart->getTotalPrice()->getCentAmount());
    }

    /**
     * @return ProductDraft
     */
    protected function getDraft($name)
    {
        $draft = ProductDraft::ofTypeNameAndSlug(
            $this->getProductType()->getReference(),
            LocalizedString::ofLangAndText('en', 'test-' . $this->getTestRun() . '-' . $name),
            LocalizedString::ofLangAndText('en', 'test-' . $this->getTestRun() . '-' . $name)
        );

        return $draft;
    }

    protected function createProduct(ProductDraft $draft)
    {
        $request = ProductCreateRequest::ofDraft($draft);
        $response = $request->executeWithClient($this->getClient());
        $product = $request->mapResponse($response);

        $this->cleanupRequests[] = $this->deleteRequest = ProductDeleteRequest::ofIdAndVersion(
            $product->getId(),
            $product->getVersion()
        );
        $this->productId = $product->getId();

        return $product;
    }
}
