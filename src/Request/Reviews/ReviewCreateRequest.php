<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Reviews;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Review\ReviewDraft;
use Commercetools\Core\Request\AbstractCreateRequest;
use Commercetools\Core\Model\Review\Review;
use Commercetools\Core\Response\ApiResponseInterface;

/**
 * @package Commercetools\Core\Request\Reviews
 *
 * @method Review mapResponse(ApiResponseInterface $response)
 */
class ReviewCreateRequest extends AbstractCreateRequest
{
    protected $resultClass = '\Commercetools\Core\Model\Review\Review';

    /**
     * @param ReviewDraft $review
     * @param Context $context
     */
    public function __construct(ReviewDraft $review, Context $context = null)
    {
        parent::__construct(ReviewsEndpoint::endpoint(), $review, $context);
    }

    /**
     * @param ReviewDraft $review
     * @param Context $context
     * @return static
     */
    public static function ofDraft(ReviewDraft $review, Context $context = null)
    {
        return new static($review, $context);
    }
}
