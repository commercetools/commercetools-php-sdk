<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */


namespace Commercetools\Core\IntegrationTests\Product;

use Commercetools\Core\Builder\Request\RequestBuilder;
use Commercetools\Core\IntegrationTests\ApiTestCase;
use Commercetools\Core\Model\Common\LocalizedString;
use Commercetools\Core\Model\Common\Money;
use Commercetools\Core\Model\Common\PriceDraft;
use Commercetools\Core\Model\Common\PriceDraftCollection;
use Commercetools\Core\Model\Product\Product;
use Commercetools\Core\Model\Product\ProductDraft;
use Commercetools\Core\Model\Product\ProductProjection;
use Commercetools\Core\Model\Product\ProductVariantDraft;
use Commercetools\Core\Model\Product\ProductVariantDraftCollection;
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

    protected function getProductVariantDraft()
    {
        return ProductVariantDraft::ofSkuAndPrices(
            'sku' . uniqid(),
            PriceDraftCollection::of()->add(
                PriceDraft::ofMoney(Money::ofCurrencyAndAmount('EUR', 100))
            )
        );
    }
    public function testQuery()
    {
        $client = $this->getApiClient();

        ProductFixture::withProduct(
            $client,
            function (Product $product) use ($client) {
                $request = RequestBuilder::of()->products()->query()
                    ->where(
                        'masterData(current(name(en=:name)))',
                        ['name' => $product->getMasterData()->getCurrent()->getName()->en]
                    );
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertCount(1, $result);
                $this->assertInstanceOf(Product::class, $result->current());
                $this->assertSame($product->getId(), $result->current()->getId());
            }
        );
    }

    public function testGetById()
    {
        $client = $this->getApiClient();

        ProductFixture::withProduct(
            $client,
            function (Product $product) use ($client) {
                $request = RequestBuilder::of()->products()->getById($product->getId());
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(Product::class, $result);
                $this->assertSame($product->getId(), $result->getId());
            }
        );
    }

    public function testGetByKey()
    {
        $client = $this->getApiClient();

        ProductFixture::withDraftProduct(
            $client,
            function (ProductDraft $draft) {
                return $draft->setKey(ProductFixture::uniqueProductString());
            },
            function (Product $product) use ($client) {
                $request = RequestBuilder::of()->products()->getByKey($product->getKey());
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(Product::class, $result);
                $this->assertSame($product->getId(), $result->getId());
                $this->assertSame($product->getKey(), $result->getKey());
            }
        );
    }

    public function testGetProjectionByKey()
    {
        $client = $this->getApiClient();

        ProductFixture::withDraftProduct(
            $client,
            function (ProductDraft $draft) {
                return $draft->setKey(ProductFixture::uniqueProductString());
            },
            function (Product $product) use ($client) {
                $request = RequestBuilder::of()->productProjections()->getByKey($product->getKey())->staged(true);
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(ProductProjection::class, $result);
                $this->assertSame($product->getKey(), $result->getKey());
                $this->assertSame($product->getId(), $result->getId());
            }
        );
    }

    public function testPriceSelectProductQuery()
    {
        $client = $this->getApiClient();

        ProductFixture::withDraftProduct(
            $client,
            function (ProductDraft $draft) {
                return $draft->setMasterVariant($this->getProductVariantDraft());
            },
            function (Product $product) use ($client) {
                $request = RequestBuilder::of()->products()->query()
                    ->where(
                        'masterData(current(name(en=:name)))',
                        ['name' => $product->getMasterData()->getCurrent()->getName()->en]
                    )->currency('EUR');
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertCount(1, $result);
                $this->assertInstanceOf(Product::class, $result->getAt(0));
                $this->assertEmpty(
                    $result->current()->getMasterData()->getStaged()->getMasterVariant()->getPrice()->getCountry()
                );
                $this->assertEmpty(
                    $result->current()->getMasterData()->getStaged()->getMasterVariant()->getPrice()->getChannel()
                );
                $this->assertEmpty(
                    $result->current()->getMasterData()->getStaged()->getMasterVariant()->getPrice()->getCustomerGroup()
                );
                $this->assertSame(
                    'EUR',
                    $result->current()->getMasterData()->getStaged()
                        ->getMasterVariant()->getPrice()->getValue()->getCurrencyCode()
                );
                $this->assertSame(
                    100,
                    $result->current()->getMasterData()->getStaged()
                        ->getMasterVariant()->getPrice()->getValue()->getCentAmount()
                );
            }
        );
    }

    public function testPriceSelectProductById()
    {
        $client = $this->getApiClient();

        ProductFixture::withDraftProduct(
            $client,
            function (ProductDraft $draft) {
                return $draft->setMasterVariant($this->getProductVariantDraft());
            },
            function (Product $product) use ($client) {
                $request = RequestBuilder::of()->products()->getById($product->getId())->currency('EUR');
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(Product::class, $result);
                $this->assertEmpty($result->getMasterData()->getStaged()->getMasterVariant()->getPrice()->getCountry());
                $this->assertEmpty($result->getMasterData()->getStaged()->getMasterVariant()->getPrice()->getChannel());
                $this->assertEmpty(
                    $result->getMasterData()->getStaged()->getMasterVariant()->getPrice()->getCustomerGroup()
                );
                $this->assertSame(
                    'EUR',
                    $result->getMasterData()->getStaged()->getMasterVariant()->getPrice()->getValue()->getCurrencyCode()
                );
                $this->assertSame(
                    100,
                    $result->getMasterData()->getStaged()->getMasterVariant()->getPrice()->getValue()->getCentAmount()
                );
            }
        );
    }

    public function testPriceSelectProductProjectionQuery()
    {
        $draft = $this->getDraft();
        $draft->setMasterVariant(
            ProductVariantDraft::ofSkuAndPrices(
                'sku' . uniqid(),
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
        $this->assertInstanceOf(ProductProjection::class, $result->getAt(0));
        $this->assertEmpty($result->current()->getMasterVariant()->getPrice()->getCountry());
        $this->assertEmpty($result->current()->getMasterVariant()->getPrice()->getChannel());
        $this->assertEmpty($result->current()->getMasterVariant()->getPrice()->getCustomerGroup());
        $this->assertSame('EUR', $result->current()->getMasterVariant()->getPrice()->getValue()->getCurrencyCode());
        $this->assertSame(100, $result->current()->getMasterVariant()->getPrice()->getValue()->getCentAmount());
    }

    public function testSkuParametrized()
    {
        $draft = $this->getDraft();
        $sku1 = 'sku1' . uniqid();
        $sku2 = 'sku2' . uniqid();
        $draft->setMasterVariant(ProductVariantDraft::ofSku($sku1));
        $draft->setVariants(ProductVariantDraftCollection::of()->add(ProductVariantDraft::ofSku($sku2)));
        $this->createProduct($draft);

        $request = ProductProjectionQueryRequest::of()
            ->where(
                'masterVariant(sku in (:skus1, :skus2)) or variants(sku in (:skus1, :skus2))',
                [
                    'skus1' => 'whatever',
                    'skus2' => $sku2
                ]
            )
            ->staged(true)
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->assertCount(1, $result);
        $this->assertInstanceOf(ProductProjection::class, $result->getAt(0));
        $this->assertSame($sku1, $result->current()->getMasterVariant()->getSku());
        $this->assertSame($sku2, $result->current()->getVariants()->current()->getSku());
    }

    public function testPriceSelectProductProjectionById()
    {
        $draft = $this->getDraft();
        $draft->setMasterVariant(
            ProductVariantDraft::ofSkuAndPrices(
                'sku' . uniqid(),
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

        $this->assertInstanceOf(ProductProjection::class, $result);
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
            ProductVariantDraft::ofSkuAndPrices(
                'sku' . uniqid(),
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

        $this->assertInstanceOf(ProductProjection::class, $result);
        $this->assertEmpty($result->getMasterVariant()->getPrice()->getCountry());
        $this->assertEmpty($result->getMasterVariant()->getPrice()->getChannel());
        $this->assertEmpty($result->getMasterVariant()->getPrice()->getCustomerGroup());
        $this->assertSame('EUR', $result->getMasterVariant()->getPrice()->getValue()->getCurrencyCode());
        $this->assertSame(100, $result->getMasterVariant()->getPrice()->getValue()->getCentAmount());
    }
}
