<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Reviews;

use Sphere\Core\Model\Common\Context;
use Sphere\Core\Model\Review\ReviewDraft;
use Sphere\Core\Request\AbstractCreateRequest;
use Sphere\Core\Model\Review\Review;
use Sphere\Core\Response\ApiResponseInterface;

/**
 * Class ReviewCreateRequest
 * @package Sphere\Core\Request\Reviews
 * 
 * @method Review mapResponse(ApiResponseInterface $response)
 */
class ReviewCreateRequest extends AbstractCreateRequest
{
    protected $resultClass = '\Sphere\Core\Model\Review\Review';

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
