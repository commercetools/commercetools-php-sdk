<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\IntegrationTests\ProductDiscount;

use Commercetools\Core\Builder\Request\RequestBuilder;
use Commercetools\Core\IntegrationTests\ApiTestCase;
use Commercetools\Core\Model\ProductDiscount\ProductDiscount;
use Commercetools\Core\Model\ProductDiscount\ProductDiscountDraft;

class ProductDiscountQueryRequestTest extends ApiTestCase
{
    public function testQuery()
    {
        $client = $this->getApiClient();

        ProductDiscountFixture::withProductDiscount(
            $client,
            function (ProductDiscount $productDiscount) use ($client) {
                $request = RequestBuilder::of()->productDiscounts()->query()
                    ->where('name(en=:name)', ['name' => $productDiscount->getName()->en]);
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertCount(1, $result);
                $this->assertInstanceOf(ProductDiscount::class, $result->current());
                $this->assertSame($productDiscount->getId(), $result->current()->getId());
            }
        );
    }

    public function testGetById()
    {
        $client = $this->getApiClient();

        ProductDiscountFixture::withProductDiscount(
            $client,
            function (ProductDiscount $productDiscount) use ($client) {
                $request = RequestBuilder::of()->productDiscounts()->getById($productDiscount->getId());
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(ProductDiscount::class, $productDiscount);
                $this->assertSame($productDiscount->getId(), $result->getId());
            }
        );
    }

    public function testGetByKey()
    {
        $client = $this->getApiClient();

        ProductDiscountFixture::withDraftProductDiscount(
            $client,
            function (ProductDiscountDraft $draft) {
                return $draft->setKey('key-' . ProductDiscountFixture::uniqueProductDiscountString());
            },
            function (ProductDiscount $productDiscount) use ($client) {
                $request = RequestBuilder::of()->productDiscounts()->getByKey($productDiscount->getKey());
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(ProductDiscount::class, $productDiscount);
                $this->assertSame($productDiscount->getId(), $result->getId());
                $this->assertSame($productDiscount->getKey(), $result->getKey());
            }
        );
    }
}
