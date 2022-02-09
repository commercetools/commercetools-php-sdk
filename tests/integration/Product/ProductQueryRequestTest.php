<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\IntegrationTests\Product;

use Commercetools\Core\Builder\Request\RequestBuilder;
use Commercetools\Core\IntegrationTests\ApiTestCase;
use Commercetools\Core\IntegrationTests\ProductSelection\ProductSelectionFixture;
use Commercetools\Core\IntegrationTests\Store\StoreFixture;
use Commercetools\Core\Model\Common\LocalizedString;
use Commercetools\Core\Model\Common\Money;
use Commercetools\Core\Model\Common\PriceDraft;
use Commercetools\Core\Model\Common\PriceDraftCollection;
use Commercetools\Core\Model\Product\Product;
use Commercetools\Core\Model\Product\ProductDraft;
use Commercetools\Core\Model\Product\ProductProjection;
use Commercetools\Core\Model\Product\ProductReference;
use Commercetools\Core\Model\Product\ProductVariantDraft;
use Commercetools\Core\Model\Product\ProductVariantDraftCollection;
use Commercetools\Core\Model\ProductSelection\AssignedProductSelection;
use Commercetools\Core\Model\ProductSelection\ProductSelection;
use Commercetools\Core\Model\ProductSelection\ProductSelectionReference;
use Commercetools\Core\Model\Store\Store;
use Commercetools\Core\Model\Store\StoreDraft;
use Commercetools\Core\Request\Products\ProductByIdProductSelectionsGetRequest;
use Commercetools\Core\Request\ProductSelections\Command\ProductSelectionAddProductAction;
use Commercetools\Core\Request\ProductSelections\Command\ProductSelectionRemoveProductAction;
use Commercetools\Core\Response\PagedQueryResponse;

class ProductQueryRequestTest extends ApiTestCase
{
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
        $client = $this->getApiClient();

        ProductFixture::withDraftProduct(
            $client,
            function (ProductDraft $draft) {
                return $draft->setMasterVariant($this->getProductVariantDraft());
            },
            function (Product $product) use ($client) {
                $request = RequestBuilder::of()->productProjections()->query()
                    ->where('name(en=:name)', ['name' => $product->getMasterData()->getCurrent()->getName()->en])
                    ->currency('EUR')
                    ->staged(true);

                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertCount(1, $result);
                $this->assertInstanceOf(ProductProjection::class, $result->current());
                $this->assertEmpty($result->current()->getMasterVariant()->getPrice()->getCountry());
                $this->assertEmpty($result->current()->getMasterVariant()->getPrice()->getChannel());
                $this->assertEmpty($result->current()->getMasterVariant()->getPrice()->getCustomerGroup());
                $this->assertSame(
                    'EUR',
                    $result->current()->getMasterVariant()->getPrice()->getValue()->getCurrencyCode()
                );
                $this->assertSame(100, $result->current()->getMasterVariant()->getPrice()->getValue()->getCentAmount());
            }
        );
    }

    public function testSkuParametrized()
    {
        $client = $this->getApiClient();
        $sku1 = 'sku1' . uniqid();
        $sku2 = 'sku2' . uniqid();

        ProductFixture::withDraftProduct(
            $client,
            function (ProductDraft $draft) use ($sku1, $sku2) {
                return $draft->setMasterVariant(ProductVariantDraft::ofSku($sku1))
                    ->setVariants(ProductVariantDraftCollection::of()->add(ProductVariantDraft::ofSku($sku2)));
            },
            function (Product $product) use ($client, $sku1, $sku2) {
                $request = RequestBuilder::of()->productProjections()->query()
                    ->where(
                        'masterVariant(sku in (:skus1, :skus2)) or variants(sku in (:skus1, :skus2))',
                        [
                            'skus1' => 'whatever',
                            'skus2' => $sku2
                        ]
                    )
                    ->staged(true);

                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertCount(1, $result);
                $this->assertInstanceOf(ProductProjection::class, $result->current());
                $this->assertSame($sku1, $result->current()->getMasterVariant()->getSku());
                $this->assertSame($sku2, $result->current()->getVariants()->current()->getSku());
            }
        );
    }

    public function testPriceSelectProductProjectionById()
    {
        $client = $this->getApiClient();
        
        ProductFixture::withDraftProduct(
            $client,
            function (ProductDraft $draft) {
                return $draft->setMasterVariant($this->getProductVariantDraft());
            },
            function (Product $product) use ($client) {
                $request = RequestBuilder::of()->productProjections()->getById($product->getId())
                    ->currency('EUR')
                    ->staged(true);

                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(ProductProjection::class, $result);
                $this->assertEmpty($result->getMasterVariant()->getPrice()->getCountry());
                $this->assertEmpty($result->getMasterVariant()->getPrice()->getChannel());
                $this->assertEmpty($result->getMasterVariant()->getPrice()->getCustomerGroup());
                $this->assertSame('EUR', $result->getMasterVariant()->getPrice()->getValue()->getCurrencyCode());
                $this->assertSame(100, $result->getMasterVariant()->getPrice()->getValue()->getCentAmount());
            }
        );
    }

    public function testPriceSelectProductProjectionBySlug()
    {
        $client = $this->getApiClient();

        ProductFixture::withDraftProduct(
            $client,
            function (ProductDraft $draft) {
                return $draft->setMasterVariant($this->getProductVariantDraft());
            },
            function (Product $product) use ($client) {
                $request = RequestBuilder::of()->productProjections()
                    ->getBySlug($product->getMasterData()->getCurrent()->getSlug(), ['en'], true)
                    ->currency('EUR')
                    ->country('DE');

                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(ProductProjection::class, $result);
                $this->assertEmpty($result->getMasterVariant()->getPrice()->getCountry());
                $this->assertEmpty($result->getMasterVariant()->getPrice()->getChannel());
                $this->assertEmpty($result->getMasterVariant()->getPrice()->getCustomerGroup());
                $this->assertSame('EUR', $result->getMasterVariant()->getPrice()->getValue()->getCurrencyCode());
                $this->assertSame(100, $result->getMasterVariant()->getPrice()->getValue()->getCentAmount());
            }
        );
    }

    public function testLocaleProjectionGetById()
    {
        $client = $this->getApiClient();

        ProductFixture::withProduct(
            $client,
            function (Product $product) use ($client) {
                $locale = key($product->getMasterData()->getCurrent()->getName()->toArray());

                $request = RequestBuilder::of()->productProjections()
                    ->getById($product->getId())
                    ->localeProjection($locale)
                    ->staged(true);

                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $localeResult = key($result->getName()->toArray());

                $this->assertInstanceOf(ProductProjection::class, $result);
                $this->assertSame($locale, $localeResult);
                $this->assertSame($product->getId(), $result->getId());
            }
        );
    }

    public function testFallbackLocaleProjectionGetById()
    {
        $client = $this->getApiClient();

        ProductFixture::withProduct(
            $client,
            function (Product $product) use ($client) {
                $locale = key($product->getMasterData()->getCurrent()->getName()->toArray());

                $request = RequestBuilder::of()->productProjections()
                    ->getById($product->getId())
                    ->localeProjection('de')
                    ->staged(true);

                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $localeResult = key($result->getName()->toArray());

                $this->assertInstanceOf(ProductProjection::class, $result);
                $this->assertNotEquals('de', $localeResult);
                $this->assertSame($product->getId(), $result->getId());
            }
        );
    }

    public function testStoreProjectionGetById()
    {
        $client = $this->getApiClient();

        StoreFixture::withDraftStore(
            $client,
            function (StoreDraft $storeDraft) {
                return $storeDraft->setLanguages(['en']);
            },
            function (Store $store) use ($client) {
                ProductFixture::withDraftProduct(
                    $client,
                    function (ProductDraft $draft) {
                        return $draft
                            ->setName(LocalizedString::ofLangAndText(
                                'de',
                                'test-' . ProductFixture::uniqueProductString() . '-Name'
                            )->add('en', 'test-' . ProductFixture::uniqueProductString() . '-name'));
                    },
                    function (Product $product) use ($client, $store) {
                        $request = RequestBuilder::of()->productProjections()
                            ->getById($product->getId())
                            ->storeProjection($store->getKey())
                            ->staged(true);
                        $response = $this->execute($client, $request);
                        $result = $request->mapFromResponse($response);

                        $keyNameResult = key($result->getName()->toArray());

                        $this->assertInstanceOf(ProductProjection::class, $result);
                        $this->assertSame('en', $keyNameResult);
                        $this->assertSame($product->getId(), $result->getId());
                    }
                );
            }
        );
    }

    public function testFallbackStoreProjectionGetById()
    {
        $client = $this->getApiClient();

        StoreFixture::withDraftStore(
            $client,
            function (StoreDraft $storeDraft) {
                return $storeDraft->setLanguages(['en']);
            },
            function (Store $store) use ($client) {
                ProductFixture::withDraftProduct(
                    $client,
                    function (ProductDraft $draft) {
                        return $draft
                            ->setName(LocalizedString::ofLangAndText(
                                'de',
                                'test-' . ProductFixture::uniqueProductString() . '-Name'
                            )->add('it', 'test-' . ProductFixture::uniqueProductString() . '-nome'));
                    },
                    function (Product $product) use ($client, $store) {
                        $request = RequestBuilder::of()->productProjections()
                            ->getById($product->getId())
                            ->storeProjection($store->getKey())
                            ->staged(true);
                        $response = $this->execute($client, $request);
                        $result = $request->mapFromResponse($response);

                        $keyNameResult = key($result->getName()->toArray());

                        $this->assertInstanceOf(ProductProjection::class, $result);
                        $this->assertNotEquals(current($store->getLanguages()), $keyNameResult);
                        $this->assertSame($product->getId(), $result->getId());
                    }
                );
            }
        );
    }

    public function testQueryProductFromProductSelection()
    {
        $client = $this->getApiClient();

        ProductFixture::withProduct(
            $client,
            function (Product $product) use ($client) {
                ProductSelectionFixture::withUpdateableProductSelection(
                    $client,
                    function (ProductSelection $productSelection) use ($client, $product) {
                        $productReference = ProductReference::ofId($product->getId());

                        $request = RequestBuilder::of()->productSelections()->update($productSelection)
                            ->addAction(
                                ProductSelectionAddProductAction::ofProduct($productReference)
                            );
                        $response = $this->execute($client, $request);
                        $productSelectionResult = $request->mapFromResponse($response);

                        $this->assertInstanceOf(ProductSelection::class, $productSelectionResult);

                        $request = ProductByIdProductSelectionsGetRequest::ofId($product->getId());
                        $response = $this->execute($client, $request);
                        $productQueryResult = $request->mapFromResponse($response);

                        $assignedProductSelection = AssignedProductSelection::of()->setProductSelection(ProductSelectionReference::ofId($productSelection->getId()));

                        $this->assertInstanceOf(AssignedProductSelection::class, $productQueryResult);
                        $this->assertSame($productSelection->getId(), current($productQueryResult)[0]['productSelection']['id']);
                        $this->assertSame($assignedProductSelection->getProductSelection()->getId(), current($productQueryResult)[0]['productSelection']['id']);

                        $request = RequestBuilder::of()->productSelections()->update($productSelectionResult)
                            ->addAction(
                                ProductSelectionRemoveProductAction::ofProduct($productReference)
                            );
                        $response = $this->execute($client, $request);
                        $result = $request->mapFromResponse($response);

                        $this->assertInstanceOf(ProductSelection::class, $result);

                        return $result;
                    }
                );
            }
        );
    }
}
