<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
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

    public function testQueryByName()
    {
        $draft = $this->getDraft();
        $review = $this->createReview($draft);

        $result = $this->getClient()->execute(
            ReviewQueryRequest::of()->where('title="' . $draft->getTitle() . '"')
        )->toObject();

        $this->assertCount(1, $result);
        $this->assertInstanceOf('\Commercetools\Core\Model\Review\Review', $result->getAt(0));
        $this->assertSame($review->getId(), $result->getAt(0)->getId());
    }

    public function testQueryById()
    {
        $draft = $this->getDraft();
        $review = $this->createReview($draft);

        $result = $this->getClient()->execute(ReviewByIdGetRequest::ofId($review->getId()))->toObject();

        $this->assertInstanceOf('\Commercetools\Core\Model\Review\Review', $review);
        $this->assertSame($review->getId(), $result->getId());

    }
}
