<?php
// phpcs:disable Generic.Files.LineLength
namespace Commercetools\Core\Builder\Request;

use Commercetools\Core\Request\Reviews\ReviewByIdGetRequest;
use Commercetools\Core\Request\Reviews\ReviewByKeyGetRequest;
use Commercetools\Core\Request\Reviews\ReviewCreateRequest;
use Commercetools\Core\Model\Review\ReviewDraft;
use Commercetools\Core\Request\Reviews\ReviewDeleteByKeyRequest;
use Commercetools\Core\Model\Review\Review;
use Commercetools\Core\Request\Reviews\ReviewDeleteRequest;
use Commercetools\Core\Request\Reviews\ReviewQueryRequest;
use Commercetools\Core\Request\Reviews\ReviewUpdateByKeyRequest;
use Commercetools\Core\Request\Reviews\ReviewUpdateRequest;

class ReviewRequestBuilder
{

    /**
     * @link https://docs.commercetools.com/http-api-projects-reviews.html#get-review-by-id
     * @param string $id
     * @return ReviewByIdGetRequest
     */
    public function getById($id)
    {
        $request = ReviewByIdGetRequest::ofId($id);
        return $request;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-reviews.html#get-review-by-key
     * @param string $key
     * @return ReviewByKeyGetRequest
     */
    public function getByKey($key)
    {
        $request = ReviewByKeyGetRequest::ofKey($key);
        return $request;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-reviews.html#create-a-review
     * @param ReviewDraft $review
     * @return ReviewCreateRequest
     */
    public function create(ReviewDraft $review)
    {
        $request = ReviewCreateRequest::ofDraft($review);
        return $request;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-reviews.html#delete-review-by-key
     * @param Review $review
     * @return ReviewDeleteByKeyRequest
     */
    public function deleteByKey(Review $review)
    {
        $request = ReviewDeleteByKeyRequest::ofKeyAndVersion($review->getKey(), $review->getVersion());
        return $request;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-reviews.html#delete-review-by-id
     * @param Review $review
     * @return ReviewDeleteRequest
     */
    public function delete(Review $review)
    {
        $request = ReviewDeleteRequest::ofIdAndVersion($review->getId(), $review->getVersion());
        return $request;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-reviews.html#query-reviews
     *
     * @return ReviewQueryRequest
     */
    public function query()
    {
        $request = ReviewQueryRequest::of();
        return $request;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-reviews.html#update-review-by-key
     * @param Review $review
     * @return ReviewUpdateByKeyRequest
     */
    public function updateByKey(Review $review)
    {
        $request = ReviewUpdateByKeyRequest::ofKeyAndVersion($review->getKey(), $review->getVersion());
        return $request;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-reviews.html#update-review-by-id
     * @param Review $review
     * @return ReviewUpdateRequest
     */
    public function update(Review $review)
    {
        $request = ReviewUpdateRequest::ofIdAndVersion($review->getId(), $review->getVersion());
        return $request;
    }

    /**
     * @return ReviewRequestBuilder
     */
    public function of()
    {
        return new self();
    }
}
