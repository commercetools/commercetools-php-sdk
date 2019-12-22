<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */


namespace Commercetools\Core\IntegrationTests\DiscountCode;

use Commercetools\Core\Builder\Request\RequestBuilder;
use Commercetools\Core\IntegrationTests\ApiTestCase;
use Commercetools\Core\Model\DiscountCode\DiscountCode;

class DiscountCodeQueryRequestTest extends ApiTestCase
{
    public function testQuery()
    {
        $client = $this->getApiClient();

        DiscountCodeFixture::withDiscountCode(
            $client,
            function (DiscountCode $discountCode) use ($client) {
                $request = RequestBuilder::of()->discountCodes()->query()
                    ->where('code=:code', ['code' => $discountCode->getCode()]);
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertCount(1, $result);
                $this->assertInstanceOf(DiscountCode::class, $result->current());
                $this->assertSame($discountCode->getId(), $result->current()->getId());
            }
        );
    }

    public function testGetById()
    {
        $client = $this->getApiClient();

        DiscountCodeFixture::withDiscountCode(
            $client,
            function (DiscountCode $discountCode) use ($client) {
                $request = RequestBuilder::of()->discountCodes()->getById($discountCode->getId());
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(DiscountCode::class, $result);
                $this->assertSame($discountCode->getId(), $result->getId());
            }
        );
    }
}
