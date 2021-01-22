<?php


namespace Commercetools\Core\IntegrationTests;

use Commercetools\Core\Builder\Request\RequestBuilder;
use Commercetools\Core\Client\ApiClient;
use Commercetools\Core\IntegrationTests\ProductType\ProductTypeFixture;
use Commercetools\Core\Model\ProductType\ProductType;

class MemoryTest extends ApiTestCase
{
    public function testMemory()
    {
        $client = $this->getApiClient();
        for ($i = 0; $i < 100; $i++) {
            ProductTypeFixture::withProductType($client, function (ProductType $productType1) use ($client) {
                ProductTypeFixture::withProductType($client, function (ProductType $productType2) use ($client, $productType1) {
                    $key1 = $this->getProductTypeKey($client, $productType1->getId());
                    $key2 = $this->getProductTypeKey($client, $productType2->getId());
                    printf("Key1: $key1, Key2: $key2, Memory: " . memory_get_peak_usage(true) . PHP_EOL);
                });
            });
        }
    }

    public function getProductTypeKey(ApiClient $client, $productTypeId)
    {
        $key = null;
        $request = RequestBuilder::of()->graphQL()->query()->query(
            'query ProductType { 
                productTypes(where: "id=\"' . $productTypeId . '\""){
                    results
                    {
                        key
                    }
                }
            }'
        );

        if ($productType = $request->mapFromResponse($client->execute($request))) {
            $productTypeArray = $productType->toArray();
            $key = isset($productTypeArray['data']['productTypes']['results'][0]['key']) ? $productTypeArray['data']['productTypes']['results'][0]['key'] : null;
        }

        return $key;
    }
}
