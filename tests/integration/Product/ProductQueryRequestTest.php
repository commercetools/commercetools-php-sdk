<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */


namespace Commercetools\Core\Product;

use Commercetools\Core\ApiTestCase;
use Commercetools\Core\Model\Common\LocalizedString;
use Commercetools\Core\Model\Common\Money;
use Commercetools\Core\Model\Common\PriceDraft;
use Commercetools\Core\Model\Common\PriceDraftCollection;
use Commercetools\Core\Model\Product\ProductDraft;
use Commercetools\Core\Model\Product\ProductVariantDraft;
use Commercetools\Core\Request\Products\ProductByIdGetRequest;
use Commercetools\Core\Request\Products\ProductByKeyGetRequest;
use Commercetools\Core\Request\Products\ProductCreateRequest;
use Commercetools\Core\Request\Products\ProductDeleteRequest;
use Commercetools\Core\Request\Products\ProductProjectionByIdGetRequest;
use Commercetools\Core\Request\Products\ProductProjectionByKeyGetRequest;
use Commercetools\Core\Request\Products\ProductProjectionBySlugGetRequest;
use Commercetools\Core\Request\Products\ProductProjectionQueryRequest;
use Commercetools\Core\Request\Products\ProductQueryRequest;

class ProductQueryRequestTest extends ApiTestCase
{
    /**
     * @return ProductDraft
     */
    protected function getDraft()
    {
        $draft = ProductDraft::ofTypeNameAndSlug(
            $this->getProductType()->getReference(),
            LocalizedString::ofLangAndText('en', 'test-' . $this->getTestRun() . '-product'),
            LocalizedString::ofLangAndText('en', 'test-' . $this->getTestRun() . '-product')
        );

        return $draft;
    }

    protected function createProduct(ProductDraft $draft)
    {
        $request = ProductCreateRequest::ofDraft($draft);
        $response = $request->executeWithClient($this->getClient());
        $product = $request->mapResponse($response);

        $this->cleanupRequests[] = ProductDeleteRequest::ofIdAndVersion(
            $product->getId(),
            $product->getVersion()
        );

        return $product;
    }

    public function testQuery()
    {
        $draft = $this->getDraft();
        $product = $this->createProduct($draft);

        $request = ProductQueryRequest::of()->where('masterData(current(name(en="' . $draft->getName()->en . '")))');
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);

        $this->assertCount(1, $result);
        $this->assertInstanceOf('\Commercetools\Core\Model\Product\Product', $result->getAt(0));
        $this->assertSame($product->getId(), $result->getAt(0)->getId());
    }

    public function testGetById()
    {
        $draft = $this->getDraft();
        $product = $this->createProduct($draft);

        $request = ProductByIdGetRequest::ofId($product->getId());
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);

        $this->assertInstanceOf('\Commercetools\Core\Model\Product\Product', $result);
        $this->assertSame($product->getId(), $result->getId());
    }

    public function testGetByKey()
    {
        $draft = $this->getDraft();
        $draft->setKey($this->getTestRun());
        $product = $this->createProduct($draft);

        $request = ProductByKeyGetRequest::ofKey($product->getKey());
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);

        $this->assertInstanceOf('\Commercetools\Core\Model\Product\Product', $result);
        $this->assertSame($product->getKey(), $result->getKey());
    }

    public function testGetProjectionByKey()
    {
        $draft = $this->getDraft();
        $draft->setKey($this->getTestRun());
        $product = $this->createProduct($draft);

        $request = ProductProjectionByKeyGetRequest::ofKey($product->getKey())->staged(true);
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);

        $this->assertInstanceOf('\Commercetools\Core\Model\Product\ProductProjection', $result);
        $this->assertSame($product->getKey(), $result->getKey());
        $this->assertSame($product->getId(), $result->getId());
    }

    public function testPriceSelectProductQuery()
    {
        $draft = $this->getDraft();
        $draft->setMasterVariant(
            ProductVariantDraft::of()->setSku('sku' . uniqid())
                ->setPrices(
                    PriceDraftCollection::of()->add(
                        PriceDraft::ofMoney(Money::ofCurrencyAndAmount('EUR', 100))
                    )
                )
        );
        $this->createProduct($draft);

        $request = ProductQueryRequest::of()
            ->where('masterData(current(name(en="' . $draft->getName()->en . '")))')
            ->currency('EUR')
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);

        $this->assertCount(1, $result);
        $this->assertInstanceOf('\Commercetools\Core\Model\Product\Product', $result->getAt(0));
        $this->assertEmpty($result->current()->getMasterData()->getStaged()->getMasterVariant()->getPrice()->getCountry());
        $this->assertEmpty($result->current()->getMasterData()->getStaged()->getMasterVariant()->getPrice()->getChannel());
        $this->assertEmpty($result->current()->getMasterData()->getStaged()->getMasterVariant()->getPrice()->getCustomerGroup());
        $this->assertSame('EUR', $result->current()->getMasterData()->getStaged()->getMasterVariant()->getPrice()->getValue()->getCurrencyCode());
        $this->assertSame(100, $result->current()->getMasterData()->getStaged()->getMasterVariant()->getPrice()->getValue()->getCentAmount());
    }

    public function testPriceSelectProductById()
    {
        $draft = $this->getDraft();
        $draft->setMasterVariant(
            ProductVariantDraft::of()->setSku('sku' . uniqid())
                ->setPrices(
                    PriceDraftCollection::of()->add(
                        PriceDraft::ofMoney(Money::ofCurrencyAndAmount('EUR', 100))
                    )
                )
        );
        $product = $this->createProduct($draft);

        $request = ProductByIdGetRequest::ofId($product->getId())
            ->currency('EUR')
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);

        $this->assertInstanceOf('\Commercetools\Core\Model\Product\Product', $result);
        $this->assertEmpty($result->getMasterData()->getStaged()->getMasterVariant()->getPrice()->getCountry());
        $this->assertEmpty($result->getMasterData()->getStaged()->getMasterVariant()->getPrice()->getChannel());
        $this->assertEmpty($result->getMasterData()->getStaged()->getMasterVariant()->getPrice()->getCustomerGroup());
        $this->assertSame('EUR', $result->getMasterData()->getStaged()->getMasterVariant()->getPrice()->getValue()->getCurrencyCode());
        $this->assertSame(100, $result->getMasterData()->getStaged()->getMasterVariant()->getPrice()->getValue()->getCentAmount());
    }

    public function testPriceSelectProductProjectionQuery()
    {
        $draft = $this->getDraft();
        $draft->setMasterVariant(
            ProductVariantDraft::of()->setSku('sku' . uniqid())
                ->setPrices(
                    PriceDraftCollection::of()->add(
                        PriceDraft::ofMoney(Money::ofCurrencyAndAmount('EUR', 100))
                    )
                )
        );
        $this->createProduct($draft);

        $request = ProductProjectionQueryRequest::of()
            ->where('name(en="' . $draft->getName()->en . '")')
            ->currency('EUR')
            ->staged(true)
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);

        $this->assertCount(1, $result);
        $this->assertInstanceOf('\Commercetools\Core\Model\Product\ProductProjection', $result->getAt(0));
        $this->assertEmpty($result->current()->getMasterVariant()->getPrice()->getCountry());
        $this->assertEmpty($result->current()->getMasterVariant()->getPrice()->getChannel());
        $this->assertEmpty($result->current()->getMasterVariant()->getPrice()->getCustomerGroup());
        $this->assertSame('EUR', $result->current()->getMasterVariant()->getPrice()->getValue()->getCurrencyCode());
        $this->assertSame(100, $result->current()->getMasterVariant()->getPrice()->getValue()->getCentAmount());
    }

    public function testPriceSelectProductProjectionById()
    {
        $draft = $this->getDraft();
        $draft->setMasterVariant(
            ProductVariantDraft::of()->setSku('sku' . uniqid())
                ->setPrices(
                    PriceDraftCollection::of()->add(
                        PriceDraft::ofMoney(Money::ofCurrencyAndAmount('EUR', 100))
                    )
                )
        );
        $product = $this->createProduct($draft);

        $request = ProductProjectionByIdGetRequest::ofId($product->getId())
            ->currency('EUR')
            ->staged(true)
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);

        $this->assertInstanceOf('\Commercetools\Core\Model\Product\ProductProjection', $result);
        $this->assertEmpty($result->getMasterVariant()->getPrice()->getCountry());
        $this->assertEmpty($result->getMasterVariant()->getPrice()->getChannel());
        $this->assertEmpty($result->getMasterVariant()->getPrice()->getCustomerGroup());
        $this->assertSame('EUR', $result->getMasterVariant()->getPrice()->getValue()->getCurrencyCode());
        $this->assertSame(100, $result->getMasterVariant()->getPrice()->getValue()->getCentAmount());
    }

    public function testPriceSelectProductProjectionBySlug()
    {
        $draft = $this->getDraft();
        $draft->setMasterVariant(
            ProductVariantDraft::of()->setSku('sku' . uniqid())
                ->setPrices(
                    PriceDraftCollection::of()->add(
                        PriceDraft::ofMoney(Money::ofCurrencyAndAmount('EUR', 100))
                    )
                )
        );
        $product = $this->createProduct($draft);

        $request = ProductProjectionBySlugGetRequest::ofSlugAndContext($draft->getSlug()->en, $this->getClient()->getConfig()->getContext())
            ->currency('EUR')
            ->country('DE')
            ->staged(true)
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);

        $this->assertInstanceOf('\Commercetools\Core\Model\Product\ProductProjection', $result);
        $this->assertEmpty($result->getMasterVariant()->getPrice()->getCountry());
        $this->assertEmpty($result->getMasterVariant()->getPrice()->getChannel());
        $this->assertEmpty($result->getMasterVariant()->getPrice()->getCustomerGroup());
        $this->assertSame('EUR', $result->getMasterVariant()->getPrice()->getValue()->getCurrencyCode());
        $this->assertSame(100, $result->getMasterVariant()->getPrice()->getValue()->getCentAmount());
    }
}

