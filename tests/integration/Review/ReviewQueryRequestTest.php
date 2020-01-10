<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\IntegrationTests\Review;

use Commercetools\Core\Builder\Request\RequestBuilder;
use Commercetools\Core\IntegrationTests\ApiTestCase;
use Commercetools\Core\Model\Review\Review;

class ReviewQueryRequestTest extends ApiTestCase
{
    public function testQuery()
    {
        $client = $this->getApiClient();

        ReviewFixture::withReview(
            $client,
            function (Review $review) use ($client) {
                $request = RequestBuilder::of()->reviews()->query()
                    ->where('title=:title', ['title' => $review->getTitle()]);
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertCount(1, $result);
                $this->assertInstanceOf(Review::class, $result->current());
                $this->assertSame($review->getId(), $result->current()->getId());
            }
        );
    }

    public function testGetById()
    {
        $client = $this->getApiClient();

        ReviewFixture::withReview(
            $client,
            function (Review $review) use ($client) {
                $request = RequestBuilder::of()->reviews()->getById($review->getId());
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(Review::class, $result);
                $this->assertSame($review->getId(), $result->getId());
            }
        );
    }
}
