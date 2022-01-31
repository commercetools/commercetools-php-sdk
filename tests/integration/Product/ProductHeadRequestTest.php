<?php

namespace Commercetools\Core\IntegrationTests\Product;

use Commercetools\Core\Builder\Request\RequestBuilder;
use Commercetools\Core\IntegrationTests\ApiTestCase;
use Commercetools\Core\Model\Common\Money;
use Commercetools\Core\Model\Common\PriceDraft;
use Commercetools\Core\Model\Common\PriceDraftCollection;
use Commercetools\Core\Model\Product\Product;
use Commercetools\Core\Model\Product\ProductVariantDraft;

class ProductHeadRequestTest extends ApiTestCase
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
    public function testProductsExist()
    {
        $client = $this->getApiClient();

        ProductFixture::withProduct(
            $client,
            function (Product $product) use ($client) {
                $request = RequestBuilder::of()->products()->head();
                $response = $this->execute($client, $request);

                $this->assertSame(200, $response->getStatusCode());
            }
        );
    }

    public function testProductByIdExists()
    {
        $client = $this->getApiClient();

        ProductFixture::withProduct(
            $client,
            function (Product $product) use ($client) {
                $request = RequestBuilder::of()->products()->getByIdHead($product->getId());
                $response = $this->execute($client, $request);

                $this->assertSame(200, $response->getStatusCode());
            }
        );
    }

    public function testProductByKeyExists()
    {
        $client = $this->getApiClient();

        ProductFixture::withProduct(
            $client,
            function (Product $product) use ($client) {
                $request = RequestBuilder::of()->products()->getByIdHead($product->getKey());
                $response = $this->execute($client, $request);

                $this->assertSame(200, $response->getStatusCode());
            }
        );
    }

    public function testProductByQueryPredicateExists()
    {
        $client = $this->getApiClient();

        ProductFixture::withProduct(
            $client,
            function (Product $product) use ($client) {
                $request = RequestBuilder::of()->products()->head()
                    ->where('id=:id', ['id' => $product->getId()]);
                $response = $this->execute($client, $request);

                $this->assertSame(200, $response->getStatusCode());
            }
        );
    }
}
