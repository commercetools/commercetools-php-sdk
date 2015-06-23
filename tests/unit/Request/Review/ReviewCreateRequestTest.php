<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Review;


use Sphere\Core\Model\Review\ReviewDraft;
use Sphere\Core\Request\Reviews\ReviewCreateRequest;
use Sphere\Core\RequestTestCase;

class ReviewCreateRequestTest extends RequestTestCase
{
    const REVIEW_CREATE_REQUEST = '\Sphere\Core\Request\Reviews\ReviewCreateRequest';

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
        $this->assertInstanceOf('\Sphere\Core\Model\Review\Review', $result);
    }

    public function testMapEmptyResult()
    {
        $result = $this->mapEmptyResult(ReviewCreateRequest::ofDraft($this->getDraft()));
        $this->assertNull($result);
    }
}
