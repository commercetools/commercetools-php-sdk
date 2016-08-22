<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */


namespace Commercetools\Core\Product;

use Commercetools\Core\ApiTestCase;
use Commercetools\Core\Error\DuplicateFieldError;
use Commercetools\Core\Model\Common\AssetDraft;
use Commercetools\Core\Model\Common\AssetSource;
use Commercetools\Core\Model\Common\AssetSourceCollection;
use Commercetools\Core\Model\Common\Image;
use Commercetools\Core\Model\Common\ImageDimension;
use Commercetools\Core\Model\Common\LocalizedString;
use Commercetools\Core\Model\Common\Money;
use Commercetools\Core\Model\Common\PriceDraft;
use Commercetools\Core\Model\Common\PriceDraftCollection;
use Commercetools\Core\Model\Product\LocalizedSearchKeywords;
use Commercetools\Core\Model\Product\ProductDraft;
use Commercetools\Core\Model\Product\ProductVariantDraft;
use Commercetools\Core\Model\Product\SearchKeyword;
use Commercetools\Core\Model\Product\SearchKeywords;
use Commercetools\Core\Model\State\State;
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
use Commercetools\Core\Request\Products\Command\ProductSetAssetDescriptionAction;
use Commercetools\Core\Request\Products\Command\ProductSetAssetSourcesAction;
use Commercetools\Core\Request\Products\Command\ProductSetAssetTagsAction;
use Commercetools\Core\Request\Products\Command\ProductSetAttributeAction;
use Commercetools\Core\Request\Products\Command\ProductSetAttributeInAllVariantsAction;
use Commercetools\Core\Request\Products\Command\ProductSetCategoryOrderHintAction;
use Commercetools\Core\Request\Products\Command\ProductSetDescriptionAction;
use Commercetools\Core\Request\Products\Command\ProductSetMetaDescriptionAction;
use Commercetools\Core\Request\Products\Command\ProductSetMetaKeywordsAction;
use Commercetools\Core\Request\Products\Command\ProductSetMetaTitleAction;
use Commercetools\Core\Request\Products\Command\ProductSetPriceCustomFieldAction;
use Commercetools\Core\Request\Products\Command\ProductSetPriceCustomTypeAction;
use Commercetools\Core\Request\Products\Command\ProductSetPricesAction;
use Commercetools\Core\Request\Products\Command\ProductSetSearchKeywordsAction;
use Commercetools\Core\Request\Products\Command\ProductSetSkuNotStageableAction;
use Commercetools\Core\Request\Products\Command\ProductSetSkuAction;
use Commercetools\Core\Request\Products\Command\ProductSetTaxCategoryAction;
use Commercetools\Core\Request\Products\Command\ProductTransitionStateAction;
use Commercetools\Core\Request\Products\Command\ProductUnpublishAction;
use Commercetools\Core\Request\Products\ProductCreateRequest;
use Commercetools\Core\Request\Products\ProductDeleteRequest;
use Commercetools\Core\Request\Products\ProductUpdateRequest;

class ProductUpdateRequestTest extends ApiTestCase
{
    public function testCreatePublish()
    {
        $draft = $this->getDraft('create-publish');
        $draft->setPublish(true);
        $product = $this->createProduct($draft);

        $this->assertTrue($product->getMasterData()->getPublished());

        $request = ProductUpdateRequest::ofIdAndVersion($product->getId(), $product->getVersion())
            ->addAction(ProductUnpublishAction::of())
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());
    }

    public function testChangeName()
    {
        $draft = $this->getDraft('change-name');
        $product = $this->createProduct($draft);

        $name = $this->getTestRun() . '-new name';
        $request = ProductUpdateRequest::ofIdAndVersion($product->getId(), $product->getVersion())
            ->addAction(
                ProductChangeNameAction::ofName(
                    LocalizedString::ofLangAndText('en', $name)
                )
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf('\Commercetools\Core\Model\Product\Product', $result);
        $this->assertNotSame($name, $result->getMasterData()->getCurrent()->getName()->en);
        $this->assertSame($name, $result->getMasterData()->getStaged()->getName()->en);
        $this->assertNotSame($product->getVersion(), $result->getVersion());
    }

    public function testExternalImage()
    {
        $draft = $this->getDraft('external-image');
        $product = $this->createProduct($draft);

        $variant = $product->getMasterData()->getCurrent()->getMasterVariant();
        $request = ProductUpdateRequest::ofIdAndVersion($product->getId(), $product->getVersion())
            ->addAction(
                ProductAddExternalImageAction::ofVariantIdAndImage(
                    $variant->getId(),
                    Image::of()
                        ->setLabel('testLabel')
                        ->setUrl('testUri')
                        ->setDimensions(ImageDimension::of()->setW(60)->setH(60))
                )
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf('\Commercetools\Core\Model\Product\Product', $result);
        $this->assertCount(0, $result->getMasterData()->getCurrent()->getMasterVariant()->getImages());
        $this->assertCount(1, $result->getMasterData()->getStaged()->getMasterVariant()->getImages());
        $this->assertSame(
            'testUri',
            $result->getMasterData()->getStaged()->getMasterVariant()->getImages()->current()->getUrl()
        );
        $this->assertNotSame($product->getVersion(), $result->getVersion());
    }

    public function testSetDescription()
    {
        $draft = $this->getDraft('set-description');
        $product = $this->createProduct($draft);

        $description = $this->getTestRun() . '-new description';
        $request = ProductUpdateRequest::ofIdAndVersion($product->getId(), $product->getVersion())
            ->addAction(
                ProductSetDescriptionAction::ofDescription(
                    LocalizedString::ofLangAndText('en', $description)
                )
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf('\Commercetools\Core\Model\Product\Product', $result);
        $this->assertSame($description, $result->getMasterData()->getStaged()->getDescription()->en);
        $this->assertNotSame($product->getVersion(), $result->getVersion());
    }

    public function testChangeSlug()
    {
        $draft = $this->getDraft('change-slug');
        $product = $this->createProduct($draft);

        $slug = $this->getTestRun() . '-new-slug';
        $request = ProductUpdateRequest::ofIdAndVersion($product->getId(), $product->getVersion())
            ->addAction(
                ProductChangeSlugAction::ofSlug(
                    LocalizedString::ofLangAndText('en', $slug)
                )
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf('\Commercetools\Core\Model\Product\Product', $result);
        $this->assertNotSame($slug, $result->getMasterData()->getCurrent()->getSlug()->en);
        $this->assertSame($slug, $result->getMasterData()->getStaged()->getSlug()->en);
        $this->assertNotSame($product->getVersion(), $result->getVersion());
    }

    public function testVariants()
    {
        $draft = $this->getDraft('add-variant');
        $product = $this->createProduct($draft);

        $sku = $this->getTestRun() . '-sku';
        $request = ProductUpdateRequest::ofIdAndVersion($product->getId(), $product->getVersion())
            ->addAction(
                ProductAddVariantAction::of()->setSku($sku)
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf('\Commercetools\Core\Model\Product\Product', $result);
        $this->assertEmpty($result->getMasterData()->getCurrent()->getVariants());
        $this->assertSame($sku, $result->getMasterData()->getStaged()->getVariants()->current()->getSku());
        $this->assertNotSame($product->getVersion(), $result->getVersion());
        $product = $result;

        $request = ProductUpdateRequest::ofIdAndVersion($product->getId(), $product->getVersion())
            ->addAction(
                ProductRemoveVariantAction::ofVariantId(
                    $result->getMasterData()->getStaged()->getVariants()->current()->getId()
                )
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf('\Commercetools\Core\Model\Product\Product', $result);
        $this->assertEmpty($result->getMasterData()->getCurrent()->getVariants());
        $this->assertEmpty($result->getMasterData()->getStaged()->getVariants());
        $this->assertNotSame($product->getVersion(), $result->getVersion());
    }

    public function testChangeMasterVariant()
    {
        $draft = $this->getDraft('change-master-variant');
        $draft->setMasterVariant(ProductVariantDraft::of()->setSku($this->getTestRun() . '-master-sku'));
        $product = $this->createProduct($draft);

        $sku = $this->getTestRun() . '-sku';
        $request = ProductUpdateRequest::ofIdAndVersion($product->getId(), $product->getVersion())
            ->addAction(
                ProductAddVariantAction::of()->setSku($sku)
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf('\Commercetools\Core\Model\Product\Product', $result);
        $this->assertEmpty($result->getMasterData()->getCurrent()->getVariants());
        $this->assertSame($sku, $result->getMasterData()->getStaged()->getVariants()->current()->getSku());
        $this->assertNotSame($product->getVersion(), $result->getVersion());
        $product = $result;

        $masterVariantSku =  $result->getMasterData()->getStaged()->getMasterVariant()->getSku();
        $variantSku =  $result->getMasterData()->getStaged()->getVariants()->current()->getSku();

        $request = ProductUpdateRequest::ofIdAndVersion($product->getId(), $product->getVersion())
            ->addAction(
                ProductChangeMasterVariantAction::ofVariantId(
                    $result->getMasterData()->getStaged()->getVariants()->current()->getId()
                )
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf('\Commercetools\Core\Model\Product\Product', $result);
        $this->assertEmpty($result->getMasterData()->getCurrent()->getVariants());
        $this->assertSame($masterVariantSku, $result->getMasterData()->getStaged()->getVariants()->current()->getSku());
        $this->assertSame($variantSku, $result->getMasterData()->getStaged()->getMasterVariant()->getSku());
        $this->assertNotSame($product->getVersion(), $result->getVersion());
        $product = $result;

        $request = ProductUpdateRequest::ofIdAndVersion($product->getId(), $product->getVersion())
            ->addAction(
                ProductChangeMasterVariantAction::ofSku(
                    $result->getMasterData()->getStaged()->getVariants()->current()->getSku()
                )
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf('\Commercetools\Core\Model\Product\Product', $result);
        $this->assertEmpty($result->getMasterData()->getCurrent()->getVariants());
        $this->assertSame($variantSku, $result->getMasterData()->getStaged()->getVariants()->current()->getSku());
        $this->assertSame($masterVariantSku, $result->getMasterData()->getStaged()->getMasterVariant()->getSku());
        $this->assertNotSame($product->getVersion(), $result->getVersion());
    }

    public function testVariantsWithSku()
    {
        $draft = $this->getDraft('add-variant');
        $product = $this->createProduct($draft);

        $sku = $this->getTestRun() . '-sku';
        $request = ProductUpdateRequest::ofIdAndVersion($product->getId(), $product->getVersion())
            ->addAction(
                ProductAddVariantAction::of()->setSku($sku)
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf('\Commercetools\Core\Model\Product\Product', $result);
        $this->assertEmpty($result->getMasterData()->getCurrent()->getVariants());
        $this->assertSame($sku, $result->getMasterData()->getStaged()->getVariants()->current()->getSku());
        $this->assertNotSame($product->getVersion(), $result->getVersion());
        $product = $result;

        $request = ProductUpdateRequest::ofIdAndVersion($product->getId(), $product->getVersion())
            ->addAction(
                ProductRemoveVariantAction::ofSku(
                    $result->getMasterData()->getStaged()->getVariants()->current()->getSku()
                )
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf('\Commercetools\Core\Model\Product\Product', $result);
        $this->assertEmpty($result->getMasterData()->getCurrent()->getVariants());
        $this->assertEmpty($result->getMasterData()->getStaged()->getVariants());
        $this->assertNotSame($product->getVersion(), $result->getVersion());
    }

    public function testPrices()
    {
        $draft = $this->getDraft('add-price');
        $product = $this->createProduct($draft);

        $price = PriceDraft::ofMoney(Money::ofCurrencyAndAmount('EUR', 100));
        $request = ProductUpdateRequest::ofIdAndVersion($product->getId(), $product->getVersion())
            ->addAction(
                ProductAddPriceAction::ofVariantIdAndPrice(
                    $product->getMasterData()->getCurrent()->getMasterVariant()->getId(),
                    $price
                )
            )
        ;
        $request->currency('EUR');
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $variant = $result->getMasterData()->getStaged()->getMasterVariant();
        $this->assertInstanceOf('\Commercetools\Core\Model\Product\Product', $result);
        $this->assertEmpty($result->getMasterData()->getCurrent()->getMasterVariant()->getPrices());
        $this->assertSame(
            $price->getValue()->getCentAmount(),
            $variant->getPrices()->current()->getValue()->getCentAmount()
        );

        $this->assertEmpty($variant->getPrice()->getCountry());
        $this->assertEmpty($variant->getPrice()->getChannel());
        $this->assertEmpty($variant->getPrice()->getCustomerGroup());
        $this->assertSame('EUR', $variant->getPrice()->getValue()->getCurrencyCode());
        $this->assertSame(100, $variant->getPrice()->getValue()->getCentAmount());

        $this->assertNotSame($product->getVersion(), $result->getVersion());
        $product = $result;

        $price = PriceDraft::ofMoney(Money::ofCurrencyAndAmount('EUR', 200));
        $request = ProductUpdateRequest::ofIdAndVersion($product->getId(), $product->getVersion())
            ->addAction(
                ProductChangePriceAction::ofPriceIdAndPrice(
                    $variant->getPrices()->current()->getId(),
                    $price
                )
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $variant = $result->getMasterData()->getStaged()->getMasterVariant();
        $this->assertInstanceOf('\Commercetools\Core\Model\Product\Product', $result);
        $this->assertEmpty($result->getMasterData()->getCurrent()->getMasterVariant()->getPrices());
        $this->assertSame(
            $price->getValue()->getCentAmount(),
            $variant->getPrices()->current()->getValue()->getCentAmount()
        );
        $this->assertNotSame($product->getVersion(), $result->getVersion());
        $product = $result;

        $price = PriceDraft::ofMoney(Money::ofCurrencyAndAmount('EUR', 300));
        $prices = PriceDraftCollection::of()->add($price);
        $request = ProductUpdateRequest::ofIdAndVersion($product->getId(), $product->getVersion())
            ->addAction(
                ProductSetPricesAction::ofVariantIdAndPrices(
                    $variant->getId(),
                    $prices
                )
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $variant = $result->getMasterData()->getStaged()->getMasterVariant();
        $this->assertInstanceOf('\Commercetools\Core\Model\Product\Product', $result);
        $this->assertEmpty($result->getMasterData()->getCurrent()->getMasterVariant()->getPrices());
        $this->assertSame(
            $price->getValue()->getCentAmount(),
            $variant->getPrices()->current()->getValue()->getCentAmount()
        );
        $this->assertNotSame($product->getVersion(), $result->getVersion());
        $product = $result;

        $request = ProductUpdateRequest::ofIdAndVersion($product->getId(), $product->getVersion())
            ->addAction(
                ProductRemovePriceAction::ofPriceId(
                    $variant->getPrices()->current()->getId()
                )
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf('\Commercetools\Core\Model\Product\Product', $result);
        $this->assertEmpty($result->getMasterData()->getCurrent()->getMasterVariant()->getPrices());
        $this->assertEmpty($result->getMasterData()->getStaged()->getMasterVariant()->getPrices());
        $this->assertNotSame($product->getVersion(), $result->getVersion());
    }

    public function testPricesWithSku()
    {
        $draft = $this->getDraft('add-price');
        $draft->setMasterVariant(ProductVariantDraft::of()->setSku($this->getTestRun()));
        $product = $this->createProduct($draft);

        $price = PriceDraft::ofMoney(Money::ofCurrencyAndAmount('EUR', 100));
        $request = ProductUpdateRequest::ofIdAndVersion($product->getId(), $product->getVersion())
            ->addAction(
                ProductAddPriceAction::ofSkuAndPrice(
                    $product->getMasterData()->getCurrent()->getMasterVariant()->getSku(),
                    $price
                )
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $variant = $result->getMasterData()->getStaged()->getMasterVariant();
        $this->assertInstanceOf('\Commercetools\Core\Model\Product\Product', $result);
        $this->assertEmpty($result->getMasterData()->getCurrent()->getMasterVariant()->getPrices());
        $this->assertSame(
            $price->getValue()->getCentAmount(),
            $variant->getPrices()->current()->getValue()->getCentAmount()
        );
        $this->assertNotSame($product->getVersion(), $result->getVersion());
        $product = $result;

        $price = PriceDraft::ofMoney(Money::ofCurrencyAndAmount('EUR', 200));
        $request = ProductUpdateRequest::ofIdAndVersion($product->getId(), $product->getVersion())
            ->addAction(
                ProductChangePriceAction::ofPriceIdAndPrice(
                    $variant->getPrices()->current()->getId(),
                    $price
                )
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $variant = $result->getMasterData()->getStaged()->getMasterVariant();
        $this->assertInstanceOf('\Commercetools\Core\Model\Product\Product', $result);
        $this->assertEmpty($result->getMasterData()->getCurrent()->getMasterVariant()->getPrices());
        $this->assertSame(
            $price->getValue()->getCentAmount(),
            $variant->getPrices()->current()->getValue()->getCentAmount()
        );
        $this->assertNotSame($product->getVersion(), $result->getVersion());
        $product = $result;

        $price = PriceDraft::ofMoney(Money::ofCurrencyAndAmount('EUR', 300));
        $prices = PriceDraftCollection::of()->add($price);
        $request = ProductUpdateRequest::ofIdAndVersion($product->getId(), $product->getVersion())
            ->addAction(
                ProductSetPricesAction::ofSkuAndPrices(
                    $variant->getSku(),
                    $prices
                )
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $variant = $result->getMasterData()->getStaged()->getMasterVariant();
        $this->assertInstanceOf('\Commercetools\Core\Model\Product\Product', $result);
        $this->assertEmpty($result->getMasterData()->getCurrent()->getMasterVariant()->getPrices());
        $this->assertSame(
            $price->getValue()->getCentAmount(),
            $variant->getPrices()->current()->getValue()->getCentAmount()
        );
        $this->assertNotSame($product->getVersion(), $result->getVersion());
        $product = $result;

        $request = ProductUpdateRequest::ofIdAndVersion($product->getId(), $product->getVersion())
            ->addAction(
                ProductRemovePriceAction::ofPriceId(
                    $variant->getPrices()->current()->getId()
                )
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf('\Commercetools\Core\Model\Product\Product', $result);
        $this->assertEmpty($result->getMasterData()->getCurrent()->getMasterVariant()->getPrices());
        $this->assertEmpty($result->getMasterData()->getStaged()->getMasterVariant()->getPrices());
        $this->assertNotSame($product->getVersion(), $result->getVersion());
    }

    public function testAttribute()
    {
        $draft = $this->getDraft('attribute');
        $product = $this->createProduct($draft);

        $attributeValue = $this->getTestRun() . '-new value';
        $request = ProductUpdateRequest::ofIdAndVersion($product->getId(), $product->getVersion())
            ->addAction(
                ProductSetAttributeAction::ofVariantIdAndName(
                    $product->getMasterData()->getCurrent()->getMasterVariant()->getId(),
                    'testField'
                )->setValue($attributeValue)
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $variant = $result->getMasterData()->getStaged()->getMasterVariant();
        $variant->getAttributes()->setAttributeDefinitions($this->getProductType()->getAttributes());
        $this->assertInstanceOf('\Commercetools\Core\Model\Product\Product', $result);
        $this->assertEmpty($result->getMasterData()->getCurrent()->getMasterVariant()->getPrices());
        $this->assertSame(
            $attributeValue,
            $variant->getAttributes()->getByName('testField')->getValue()
        );
        $this->assertNotSame($product->getVersion(), $result->getVersion());
        $product = $result;

        $attributeValue = $this->getTestRun() . '-new all value';
        $request = ProductUpdateRequest::ofIdAndVersion($product->getId(), $product->getVersion())
            ->addAction(
                ProductSetAttributeInAllVariantsAction::ofName(
                    'testField'
                )->setValue($attributeValue)
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $variant = $result->getMasterData()->getStaged()->getMasterVariant();
        $variant->getAttributes()->setAttributeDefinitions($this->getProductType()->getAttributes());

        $this->assertInstanceOf('\Commercetools\Core\Model\Product\Product', $result);
        $this->assertEmpty($result->getMasterData()->getCurrent()->getMasterVariant()->getPrices());
        $this->assertSame(
            $attributeValue,
            $variant->getAttributes()->getByName('testField')->getValue()
        );
        $this->assertNotSame($product->getVersion(), $result->getVersion());
    }

    public function testAttributeWithSKu()
    {
        $draft = $this->getDraft('attribute');
        $draft->setMasterVariant(ProductVariantDraft::of()->setSku($this->getTestRun()));
        $product = $this->createProduct($draft);

        $attributeValue = $this->getTestRun() . '-new value';
        $request = ProductUpdateRequest::ofIdAndVersion($product->getId(), $product->getVersion())
            ->addAction(
                ProductSetAttributeAction::ofSkuAndName(
                    $product->getMasterData()->getCurrent()->getMasterVariant()->getSku(),
                    'testField'
                )->setValue($attributeValue)
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $variant = $result->getMasterData()->getStaged()->getMasterVariant();
        $variant->getAttributes()->setAttributeDefinitions($this->getProductType()->getAttributes());
        $this->assertInstanceOf('\Commercetools\Core\Model\Product\Product', $result);
        $this->assertEmpty($result->getMasterData()->getCurrent()->getMasterVariant()->getPrices());
        $this->assertSame(
            $attributeValue,
            $variant->getAttributes()->getByName('testField')->getValue()
        );
        $this->assertNotSame($product->getVersion(), $result->getVersion());
        $product = $result;

        $attributeValue = $this->getTestRun() . '-new all value';
        $request = ProductUpdateRequest::ofIdAndVersion($product->getId(), $product->getVersion())
            ->addAction(
                ProductSetAttributeInAllVariantsAction::ofName(
                    'testField'
                )->setValue($attributeValue)
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $variant = $result->getMasterData()->getStaged()->getMasterVariant();
        $variant->getAttributes()->setAttributeDefinitions($this->getProductType()->getAttributes());

        $this->assertInstanceOf('\Commercetools\Core\Model\Product\Product', $result);
        $this->assertEmpty($result->getMasterData()->getCurrent()->getMasterVariant()->getPrices());
        $this->assertSame(
            $attributeValue,
            $variant->getAttributes()->getByName('testField')->getValue()
        );
        $this->assertNotSame($product->getVersion(), $result->getVersion());
    }

    public function testCategory()
    {
        $draft = $this->getDraft('category');
        $product = $this->createProduct($draft);

        $category = $this->getCategory();
        $request = ProductUpdateRequest::ofIdAndVersion($product->getId(), $product->getVersion())
            ->addAction(ProductAddToCategoryAction::ofCategory($category->getReference()))
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf('\Commercetools\Core\Model\Product\Product', $result);
        $this->assertEmpty($product->getMasterData()->getCurrent()->getCategories());
        $this->assertSame(
            $category->getId(),
            $result->getMasterData()->getStaged()->getCategories()->current()->getId()
        );
        $this->assertNotSame($product->getVersion(), $result->getVersion());
        $product = $result;

        $orderHint = '0.9' . trim((string)mt_rand(1, 1000), '0');
        $request = ProductUpdateRequest::ofIdAndVersion($product->getId(), $product->getVersion())
            ->addAction(ProductSetCategoryOrderHintAction::ofCategoryId($category->getId())->setOrderHint($orderHint))
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf('\Commercetools\Core\Model\Product\Product', $result);
        $this->assertEmpty($product->getMasterData()->getCurrent()->getCategoryOrderHints());
        $this->assertSame(
            $orderHint,
            $result->getMasterData()->getStaged()->getCategoryOrderHints()[$category->getId()]
        );
        $this->assertNotSame($product->getVersion(), $result->getVersion());
        $product = $result;

        $category = $this->getCategory();
        $request = ProductUpdateRequest::ofIdAndVersion($product->getId(), $product->getVersion())
            ->addAction(ProductRemoveFromCategoryAction::ofCategory($category->getReference()))
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf('\Commercetools\Core\Model\Product\Product', $result);
        $this->assertEmpty($result->getMasterData()->getCurrent()->getCategories());
        $this->assertEmpty($result->getMasterData()->getStaged()->getCategories());
        $this->assertNotSame($product->getVersion(), $result->getVersion());
    }

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

        $this->assertInstanceOf('\Commercetools\Core\Model\Product\Product', $result);
        $this->assertSame(
            $taxCategory->getId(),
            $result->getTaxCategory()->getId()
        );
        $this->assertNotSame($product->getVersion(), $result->getVersion());
    }

    public function testSku()
    {

        $draft = $this->getDraft('sku');
        $product = $this->createProduct($draft);
        $sku = $this->getTestRun() . 'sku';
        $request = ProductUpdateRequest::ofIdAndVersion($product->getId(), $product->getVersion())
            ->addAction(
                ProductSetSkuNotStageableAction::ofVariantId(
                    $product->getMasterData()->getCurrent()->getMasterVariant()->getId()
                )->setSku($sku)
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf('\Commercetools\Core\Model\Product\Product', $result);
        $this->assertSame(
            $sku,
            $result->getMasterData()->getStaged()->getMasterVariant()->getSku()
        );
        $this->assertSame(
            $sku,
            $result->getMasterData()->getCurrent()->getMasterVariant()->getSku()
        );
        $this->assertNotSame($product->getVersion(), $result->getVersion());
    }

    public function testSkuStaged()
    {
        $draft = $this->getDraft('sku-staged');
        $product = $this->createProduct($draft);
        $sku = $this->getTestRun() . 'sku';
        $request = ProductUpdateRequest::ofIdAndVersion($product->getId(), $product->getVersion())
            ->addAction(
                ProductSetSkuAction::ofVariantId(
                    $product->getMasterData()->getCurrent()->getMasterVariant()->getId()
                )->setSku($sku)
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf('\Commercetools\Core\Model\Product\Product', $result);
        $this->assertSame(
            $sku,
            $result->getMasterData()->getStaged()->getMasterVariant()->getSku()
        );
        $this->assertNull(
            $result->getMasterData()->getCurrent()->getMasterVariant()->getSku()
        );
        $this->assertNotSame($product->getVersion(), $result->getVersion());
        $product = $result;

        $request = ProductUpdateRequest::ofIdAndVersion($product->getId(), $product->getVersion())
            ->addAction(
                ProductPublishAction::of()
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf('\Commercetools\Core\Model\Product\Product', $result);
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

        $request = ProductUpdateRequest::ofIdAndVersion($product->getId(), $product->getVersion())
            ->addAction(ProductUnpublishAction::of())
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());
    }

    public function testSkuAlreadyExistsStaged()
    {
        $draft = $this->getDraft('sku-already-exists');
        $product = $this->createProduct($draft);

        $product2 = $this->getProduct();

        $sku = $this->getTestRun() . 'sku';
        $request = ProductUpdateRequest::ofIdAndVersion($product2->getId(), $product2->getVersion())
            ->addAction(
                ProductSetSkuAction::ofVariantId(
                    $product2->getMasterData()->getCurrent()->getMasterVariant()->getId()
                )->setSku($sku)
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $product2 = $request->mapResponse($response);
        $this->product = $product2;

        $request = ProductUpdateRequest::ofIdAndVersion($product->getId(), $product->getVersion())
            ->addAction(
                ProductSetSkuAction::ofVariantId(
                    $product->getMasterData()->getCurrent()->getMasterVariant()->getId()
                )->setSku($sku)
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $this->assertTrue($response->isError());
        $this->assertInstanceOf('\Commercetools\Core\Response\ErrorResponse', $response);
        $this->assertSame(400, $response->getStatusCode());
        $this->assertSame(DuplicateFieldError::CODE, $response->getErrors()->current()->getCode());
        $this->assertSame($sku, $response->getErrors()->current()->getDuplicateValue());
        $this->assertSame('sku', $response->getErrors()->current()->getField());

        $request = ProductUpdateRequest::ofIdAndVersion($product2->getId(), $product2->getVersion())
            ->addAction(
                ProductPublishAction::of()
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $product2 = $request->mapResponse($response);
        $this->product = $product2;

        $request = ProductUpdateRequest::ofIdAndVersion($product->getId(), $product->getVersion())
            ->addAction(
                ProductSetSkuAction::ofVariantId(
                    $product->getMasterData()->getCurrent()->getMasterVariant()->getId()
                )->setSku($sku)
            )
        ;
        $response = $request->executeWithClient($this->getClient());

        $this->assertTrue($response->isError());
        $this->assertInstanceOf('\Commercetools\Core\Response\ErrorResponse', $response);
        $this->assertSame(400, $response->getStatusCode());
        $this->assertSame(DuplicateFieldError::CODE, $response->getErrors()->current()->getCode());
        $this->assertSame($sku, $response->getErrors()->current()->getDuplicateValue());
        $this->assertSame('sku', $response->getErrors()->current()->getField());
    }

    public function testSearchKeyword()
    {
        $draft = $this->getDraft('keyword');
        $product = $this->createProduct($draft);

        $keyword = $this->getTestRun() . '-keyword';
        $request = ProductUpdateRequest::ofIdAndVersion($product->getId(), $product->getVersion())
            ->addAction(
                ProductSetSearchKeywordsAction::ofKeywords(
                    LocalizedSearchKeywords::of()->setAt(
                        'en',
                        SearchKeywords::of()->add(SearchKeyword::of()->setText($keyword))
                    )
                )
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf('\Commercetools\Core\Model\Product\Product', $result);
        $this->assertEmpty($result->getMasterData()->getCurrent()->getSearchKeywords());
        $this->assertSame(
            $keyword,
            $result->getMasterData()->getStaged()->getSearchKeywords()->en->current()->getText()
        );
        $this->assertNotSame($product->getVersion(), $result->getVersion());
    }

    public function testMetaTitle()
    {
        $draft = $this->getDraft('meta-title');
        $product = $this->createProduct($draft);

        $metaTitle = $this->getTestRun() . '-meta-title';
        $request = ProductUpdateRequest::ofIdAndVersion($product->getId(), $product->getVersion())
            ->addAction(
                ProductSetMetaTitleAction::of()->setMetaTitle(
                    LocalizedString::ofLangAndText('en', $metaTitle)
                )
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf('\Commercetools\Core\Model\Product\Product', $result);
        $this->assertNull($result->getMasterData()->getCurrent()->getMetaTitle());
        $this->assertSame(
            $metaTitle,
            $result->getMasterData()->getStaged()->getMetaTitle()->en
        );
        $this->assertNotSame($product->getVersion(), $result->getVersion());
    }

    public function testMetaDescription()
    {
        $draft = $this->getDraft('meta-description');
        $product = $this->createProduct($draft);

        $metaDescription = $this->getTestRun() . '-meta-description';
        $request = ProductUpdateRequest::ofIdAndVersion($product->getId(), $product->getVersion())
            ->addAction(
                ProductSetMetaDescriptionAction::of()->setMetaDescription(
                    LocalizedString::ofLangAndText('en', $metaDescription)
                )
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf('\Commercetools\Core\Model\Product\Product', $result);
        $this->assertNull($result->getMasterData()->getCurrent()->getMetaDescription());
        $this->assertSame(
            $metaDescription,
            $result->getMasterData()->getStaged()->getMetaDescription()->en
        );
        $this->assertNotSame($product->getVersion(), $result->getVersion());
    }

    public function testMetaKeywords()
    {
        $draft = $this->getDraft('meta-keywords');
        $product = $this->createProduct($draft);

        $metaKeywords = $this->getTestRun() . '-meta-keywords';
        $request = ProductUpdateRequest::ofIdAndVersion($product->getId(), $product->getVersion())
            ->addAction(
                ProductSetMetaKeywordsAction::of()->setMetaKeywords(
                    LocalizedString::ofLangAndText('en', $metaKeywords)
                )
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf('\Commercetools\Core\Model\Product\Product', $result);
        $this->assertNull($result->getMasterData()->getCurrent()->getMetaDescription());
        $this->assertSame(
            $metaKeywords,
            $result->getMasterData()->getStaged()->getMetaKeywords()->en
        );
        $this->assertNotSame($product->getVersion(), $result->getVersion());
    }

    public function testRevertStagedChanges()
    {
        $draft = $this->getDraft('revert');
        $product = $this->createProduct($draft);

        $request = ProductUpdateRequest::ofIdAndVersion($product->getId(), $product->getVersion())
            ->addAction(ProductPublishAction::of())
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());
        $product = $result;

        $metaKeywords = $this->getTestRun() . '-meta-keywords';
        $request = ProductUpdateRequest::ofIdAndVersion($product->getId(), $product->getVersion())
            ->addAction(
                ProductSetMetaKeywordsAction::of()->setMetaKeywords(
                    LocalizedString::ofLangAndText('en', $metaKeywords)
                )
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf('\Commercetools\Core\Model\Product\Product', $result);
        $this->assertNull($result->getMasterData()->getCurrent()->getMetaDescription());
        $this->assertSame(
            $metaKeywords,
            $result->getMasterData()->getStaged()->getMetaKeywords()->en
        );
        $this->assertNotSame($product->getVersion(), $result->getVersion());
        $product = $result;

        $request = ProductUpdateRequest::ofIdAndVersion($product->getId(), $product->getVersion())
            ->addAction(ProductRevertStagedChangesAction::of())
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf('\Commercetools\Core\Model\Product\Product', $result);
        $this->assertNull($result->getMasterData()->getCurrent()->getMetaDescription());
        $this->assertNull($result->getMasterData()->getStaged()->getMetaDescription());
        $this->assertNotSame($product->getVersion(), $result->getVersion());
        $product = $result;

        $request = ProductUpdateRequest::ofIdAndVersion($product->getId(), $product->getVersion())
            ->addAction(ProductUnpublishAction::of())
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());
    }

    public function testPublish()
    {
        $draft = $this->getDraft('publish');
        $product = $this->createProduct($draft);

        $metaKeywords = $this->getTestRun() . '-meta-keywords';
        $request = ProductUpdateRequest::ofIdAndVersion($product->getId(), $product->getVersion())
            ->addAction(
                ProductSetMetaKeywordsAction::of()->setMetaKeywords(
                    LocalizedString::ofLangAndText('en', $metaKeywords)
                )
            )
            ->addAction(ProductPublishAction::of())

        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf('\Commercetools\Core\Model\Product\Product', $result);
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

        $request = ProductUpdateRequest::ofIdAndVersion($product->getId(), $product->getVersion())
            ->addAction(ProductUnpublishAction::of())
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf('\Commercetools\Core\Model\Product\Product', $result);
        $this->assertFalse($result->getMasterData()->getPublished());
        $this->assertNotSame($product->getVersion(), $result->getVersion());
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

        $this->assertInstanceOf('\Commercetools\Core\Model\Product\Product', $result);
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

        $this->assertInstanceOf('\Commercetools\Core\Model\Product\Product', $result);
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

        $this->assertInstanceOf('\Commercetools\Core\Model\Product\Product', $result);
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


        $this->assertInstanceOf('\Commercetools\Core\Model\Product\Product', $result);
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
            '\Commercetools\Core\Model\ProductType\ProductType',
            $product->getProductType()->getObj()
        );

        $request = ProductUpdateRequest::ofIdAndVersion($product->getId(), $product->getVersion());
        $request->expand('productType.id');
        $response = $request->executeWithClient($this->getClient());
        $product = $request->mapResponse($response);
        $this->deleteRequest->setVersion($product->getVersion());

        $this->assertInstanceOf(
            '\Commercetools\Core\Model\ProductType\ProductType',
            $product->getProductType()->getObj()
        );

        $request = ProductDeleteRequest::ofIdAndVersion($product->getId(), $product->getVersion());
        $request->expand('productType.id');
        $response = $request->executeWithClient($this->getClient());
        $product = $request->mapResponse($response);

        $this->assertInstanceOf(
            '\Commercetools\Core\Model\ProductType\ProductType',
            $product->getProductType()->getObj()
        );
        array_pop($this->cleanupRequests);
    }

    public function testPriceSelectCreateUpdateDelete()
    {
        $draft = $this->getDraft('update-reference-expansion');
        $draft->setMasterVariant(
            ProductVariantDraft::of()->setSku('sku' . uniqid())
                ->setPrices(
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
            ProductVariantDraft::of()->setSku('sku' . uniqid())
        );
        $product = $this->createProduct($draft);

        $variant = $product->getMasterData()->getCurrent()->getMasterVariant();
        $assetDraft = AssetDraft::of()->setSources(AssetSourceCollection::of()->add(
            AssetSource::of()->setUri('test' . $this->getTestRun())
        ))->setName(LocalizedString::ofLangAndText('en', 'test'));
        $request = ProductUpdateRequest::ofIdAndVersion($product->getId(), $product->getVersion())
            ->addAction(ProductAddAssetAction::ofSkuAndAsset($variant->getSku(), $assetDraft))
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf('\Commercetools\Core\Model\Product\Product', $result);
        $this->assertNotSame($product->getVersion(), $result->getVersion());
        $asset = $result->getMasterData()->getStaged()->getMasterVariant()->getAssets()->current();
        $this->assertInstanceOf('\Commercetools\Core\Model\Common\Asset', $asset);
        $this->assertSame('test' . $this->getTestRun(), $asset->getSources()->current()->getUri());

        $product = $result;

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
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf('\Commercetools\Core\Model\Product\Product', $result);
        $this->assertNotSame($product->getVersion(), $result->getVersion());

        $asset = $result->getMasterData()->getStaged()->getMasterVariant()->getAssets()->current();
        $this->assertInstanceOf('\Commercetools\Core\Model\Common\Asset', $asset);
        $this->assertSame('new-test', $asset->getName()->en);
        $this->assertSame('new-description', $asset->getDescription()->en);
        $this->assertSame(['123', 'abc'], $asset->getTags());
        $this->assertSame('new-test' . $this->getTestRun(), $asset->getSources()->current()->getUri());
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

        return $product;
    }
}

