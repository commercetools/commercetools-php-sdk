<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Comment;


use Sphere\Core\Model\Comment\CommentDraft;
use Sphere\Core\Request\Comments\CommentCreateRequest;
use Sphere\Core\RequestTestCase;

class CommentCreateRequestTest extends RequestTestCase
{
    const COMMENT_CREATE_REQUEST = '\Sphere\Core\Request\Comments\CommentCreateRequest';

    protected function getDraft()
    {
        return CommentDraft::fromArray(json_decode(
            '{
                "productId": "my-product-id-1",
                "customerId": "my-customer-id-1",
                "authorName": "Customer 1",
                "title": "My Comment",
                "text": "Lorem Ipsum"
            }',
            true
        ));
    }
    public function testMapResult()
    {
        $result = $this->mapResult(CommentCreateRequest::ofDraft($this->getDraft()));
        $this->assertInstanceOf('\Sphere\Core\Model\Comment\Comment', $result);
    }

    public function testMapEmptyResult()
    {
        $result = $this->mapEmptyResult(CommentCreateRequest::ofDraft($this->getDraft()));
        $this->assertNull($result);
    }
}
