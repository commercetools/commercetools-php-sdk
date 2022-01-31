<?php

namespace Commercetools\Core\IntegrationTests\Product;

use Commercetools\Core\Builder\Request\RequestBuilder;
use Commercetools\Core\IntegrationTests\ApiTestCase;
use Commercetools\Core\Model\Product\Product;
use Commercetools\Core\Model\Product\ProductDraft;

class ProductHeadRequestTest extends ApiTestCase
{
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

    public function testProductByIdDoesNotExists()
    {
        $this->expectExceptionCode(404);
        $client = $this->getApiClient();

        $request = RequestBuilder::of()->products()->getByIdHead("test-id");
        $this->execute($client, $request);
    }

    public function testProductByKeyExists()
    {
        $client = $this->getApiClient();

        ProductFixture::withDraftProduct(
            $client,
            function (ProductDraft $draft) {
                return $draft->setKey(ProductFixture::uniqueProductString());
            },
            function (Product $product) use ($client) {
                $request = RequestBuilder::of()->products()->getByKeyHead($product->getKey());
                $response = $this->execute($client, $request);

                $this->assertSame(200, $response->getStatusCode());
            }
        );
    }

    public function testProductByKeyDoesNotExists()
    {
        $this->expectExceptionCode(404);
        $client = $this->getApiClient();

        $request = RequestBuilder::of()->products()->getByKeyHead("test-key");
        $this->execute($client, $request);
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

    public function testProductByQueryPredicateDoesNotExists()
    {
        $this->expectExceptionCode(404);
        $client = $this->getApiClient();

        $request = RequestBuilder::of()->products()->head()
            ->where('id=:id', ['id' => "88f6556a-239f-46c9-9fec-b9535f60272b"]);
        $this->execute($client, $request);
    }
}
