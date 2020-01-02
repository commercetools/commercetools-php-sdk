<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */


namespace Commercetools\Core\IntegrationTests\ProductType;

use Commercetools\Core\Builder\Request\RequestBuilder;
use Commercetools\Core\IntegrationTests\ApiTestCase;
use Commercetools\Core\Model\ProductType\ProductType;

class ProductTypeQueryRequestTest extends ApiTestCase
{
    public function testQuery()
    {
        $client = $this->getApiClient();

        ProductTypeFixture::withProductType(
            $client,
            function (ProductType $productType) use ($client) {
                $request = RequestBuilder::of()->productTypes()->query()
                    ->where('name=:name', ['name' => $productType->getName()]);
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertCount(1, $result);
                $this->assertInstanceOf(ProductType::class, $result->current());
                $this->assertSame($productType->getId(), $result->current()->getId());
            }
        );
    }

    public function testGetById()
    {
        $client = $this->getApiClient();

        ProductTypeFixture::withProductType(
            $client,
            function (ProductType $productType) use ($client) {
                $request = RequestBuilder::of()->productTypes()->getById($productType->getId());
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(ProductType::class, $productType);
                $this->assertSame($productType->getId(), $result->getId());
            }
        );
    }

    public function testGetByKey()
    {
        $client = $this->getApiClient();

        ProductTypeFixture::withProductType(
            $client,
            function (ProductType $productType) use ($client) {
                $request = RequestBuilder::of()->productTypes()->getByKey($productType->getKey());
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(ProductType::class, $productType);
                $this->assertSame($productType->getId(), $result->getId());
                $this->assertSame($productType->getKey(), $result->getKey());
            }
        );
    }
}
