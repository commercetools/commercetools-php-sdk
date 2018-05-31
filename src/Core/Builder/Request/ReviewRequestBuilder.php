<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Builder\Request;

use Commercetools\Core\Model\Review\Review;
use Commercetools\Core\Model\Review\ReviewDraft;
use Commercetools\Core\Request\Reviews\ReviewByIdGetRequest;
use Commercetools\Core\Request\Reviews\ReviewByKeyGetRequest;
use Commercetools\Core\Request\Reviews\ReviewCreateRequest;
use Commercetools\Core\Request\Reviews\ReviewDeleteByKeyRequest;
use Commercetools\Core\Request\Reviews\ReviewDeleteRequest;
use Commercetools\Core\Request\Reviews\ReviewQueryRequest;
use Commercetools\Core\Request\Reviews\ReviewUpdateByKeyRequest;
use Commercetools\Core\Request\Reviews\ReviewUpdateRequest;

class ReviewRequestBuilder
{
    /**
     * @return ReviewQueryRequest
     */
    public function query()
    {
        return ReviewQueryRequest::of();
    }

    /**
     * @param Review $review
     * @return ReviewUpdateRequest
     */
    public function update(Review $review)
    {
        return ReviewUpdateRequest::ofIdAndVersion($review->getId(), $review->getVersion());
    }

    /**
     * @param Review $review
     * @return ReviewUpdateByKeyRequest
     */
    public function updateByKey(Review $review)
    {
        return ReviewUpdateByKeyRequest::ofKeyAndVersion($review->getKey(), $review->getVersion());
    }

    /**
     * @param ReviewDraft $reviewDraft
     * @return ReviewCreateRequest
     */
    public function create(ReviewDraft $reviewDraft)
    {
        return ReviewCreateRequest::ofDraft($reviewDraft);
    }

    /**
     * @param Review $review
     * @return ReviewDeleteRequest
     */
    public function delete(Review $review)
    {
        return ReviewDeleteRequest::ofIdAndVersion($review->getId(), $review->getVersion());
    }

    /**
     * @param Review $review
     * @return ReviewDeleteByKeyRequest
     */
    public function deleteByKey(Review $review)
    {
        return ReviewDeleteByKeyRequest::ofKeyAndVersion($review->getKey(), $review->getVersion());
    }

    /**
     * @param string $id
     * @return ReviewByIdGetRequest
     */
    public function getById($id)
    {
        return ReviewByIdGetRequest::ofId($id);
    }

    /**
     * @param string $key
     * @return ReviewByKeyGetRequest
     */
    public function getByKey($key)
    {
        return ReviewByKeyGetRequest::ofKey($key);
    }
}
