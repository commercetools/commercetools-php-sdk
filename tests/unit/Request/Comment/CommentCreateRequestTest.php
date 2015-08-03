<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Comment;


use Commercetools\Core\Model\Comment\CommentDraft;
use Commercetools\Core\Request\Comments\CommentCreateRequest;
use Commercetools\Core\RequestTestCase;

class CommentCreateRequestTest extends RequestTestCase
{
    const COMMENT_CREATE_REQUEST = '\Commercetools\Core\Request\Comments\CommentCreateRequest';

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
        $this->assertInstanceOf('\Commercetools\Core\Model\Comment\Comment', $result);
    }

    public function testMapEmptyResult()
    {
        $result = $this->mapEmptyResult(CommentCreateRequest::ofDraft($this->getDraft()));
        $this->assertNull($result);
    }
}
