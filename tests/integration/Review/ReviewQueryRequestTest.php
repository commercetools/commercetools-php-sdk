<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */


namespace Commercetools\Core\Review;

use Commercetools\Core\ApiTestCase;
use Commercetools\Core\Model\Review\Review;
use Commercetools\Core\Model\Review\ReviewDraft;
use Commercetools\Core\Request\Reviews\ReviewByIdGetRequest;
use Commercetools\Core\Request\Reviews\ReviewCreateRequest;
use Commercetools\Core\Request\Reviews\ReviewDeleteRequest;
use Commercetools\Core\Request\Reviews\ReviewQueryRequest;

class ReviewQueryRequestTest extends ApiTestCase
{
    /**
     * @return ReviewDraft
     */
    protected function getDraft()
    {
        $draft = ReviewDraft::ofTitle(
            'test-' . $this->getTestRun() . '-title'
        );

        return $draft;
    }

    protected function createReview(ReviewDraft $draft)
    {
        $request = ReviewCreateRequest::ofDraft($draft);
        $response = $request->executeWithClient($this->getClient());
        $review = $request->mapResponse($response);

        $this->cleanupRequests[] = ReviewDeleteRequest::ofIdAndVersion(
            $review->getId(),
            $review->getVersion()
        );

        return $review;
    }

    public function testQuery()
    {
        $draft = $this->getDraft();
        $review = $this->createReview($draft);

        $request = ReviewQueryRequest::of()->where('title="' . $draft->getTitle() . '"');
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);

        $this->assertCount(1, $result);
        $this->assertInstanceOf(Review::class, $result->getAt(0));
        $this->assertSame($review->getId(), $result->getAt(0)->getId());
    }

    public function testGetById()
    {
        $draft = $this->getDraft();
        $review = $this->createReview($draft);

        $request = ReviewByIdGetRequest::ofId($review->getId());
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);

        $this->assertInstanceOf(Review::class, $review);
        $this->assertSame($review->getId(), $result->getId());

    }
}
