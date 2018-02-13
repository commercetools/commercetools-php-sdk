<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Review;

use Commercetools\Core\Model\Review\Review;
use Commercetools\Core\Model\Review\ReviewDraft;
use Commercetools\Core\Request\Reviews\ReviewCreateRequest;
use Commercetools\Core\RequestTestCase;

class ReviewCreateRequestTest extends RequestTestCase
{
    const REVIEW_CREATE_REQUEST = ReviewCreateRequest::class;

    protected function getDraft()
    {
        return ReviewDraft::fromArray(json_decode(
            '{
                "productId": "my-product-id-1",
                "customerId": "my-customer-id-1",
                "authorName": "Customer 1",
                "title": "My Review",
                "text": "Lorem Ipsum",
                "score": 0.8
            }',
            true
        ));
    }
    public function testMapResult()
    {
        $result = $this->mapResult(ReviewCreateRequest::ofDraft($this->getDraft()));
        $this->assertInstanceOf(Review::class, $result);
    }

    public function testMapEmptyResult()
    {
        $result = $this->mapEmptyResult(ReviewCreateRequest::ofDraft($this->getDraft()));
        $this->assertNull($result);
    }
}
