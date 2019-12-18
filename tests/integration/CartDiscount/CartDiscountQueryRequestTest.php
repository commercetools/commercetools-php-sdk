<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */


namespace Commercetools\Core\IntegrationTests\CartDiscount;

use Commercetools\Core\Builder\Request\RequestBuilder;
use Commercetools\Core\IntegrationTests\ApiTestCase;
use Commercetools\Core\Model\CartDiscount\CartDiscount;

class CartDiscountQueryRequestTest extends ApiTestCase
{
    public function testGetById()
    {
        $client = $this->getApiClient();

        CartDiscountFixture::withCartDiscount(
            $client,
            function (CartDiscount $cartDiscount) use ($client) {
                $request = RequestBuilder::of()->cartDiscounts()->getById($cartDiscount->getId());

                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(CartDiscount::class, $result);
                $this->assertSame($cartDiscount->getId(), $result->getId());
            }
        );
    }

    public function testGetByKey()
    {
        $client = $this->getApiClient();

        CartDiscountFixture::withCartDiscount(
            $client,
            function (CartDiscount $cartDiscount) use ($client) {
                $request = RequestBuilder::of()->cartDiscounts()->getByKey($cartDiscount->getKey());

                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(CartDiscount::class, $result);
                $this->assertSame($cartDiscount->getId(), $result->getId());
            }
        );
    }

    public function testQuery()
    {
        $client = $this->getApiClient();

        CartDiscountFixture::withCartDiscount(
            $client,
            function (CartDiscount $cartDiscount) use ($client) {
                $request = RequestBuilder::of()->cartDiscounts()->query()
                    ->where('name(en=:name)', ['name' => $cartDiscount->getName()->en]);
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertCount(1, $result);
                $this->assertInstanceOf(CartDiscount::class, $result->current());
                $this->assertSame($cartDiscount->getId(), $result->current()->getId());
            }
        );
    }

    public function testQueryByNotName()
    {
        $client = $this->getApiClient();

        CartDiscountFixture::withCartDiscount(
            $client,
            function (CartDiscount $cartDiscount) use ($client) {
                $request = RequestBuilder::of()->cartDiscounts()->query()
                    ->where('not(name(en=:name))', ['name' => $cartDiscount->getName()->en]);
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertCount(0, $result);
            }
        );
    }
}
