<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Reviews;

use Sphere\Core\Model\Common\Context;
use Sphere\Core\Request\AbstractByIdGetRequest;
use Sphere\Core\Model\Review\Review;
use Sphere\Core\Response\ApiResponseInterface;

/**
 * @package Sphere\Core\Request\Reviews
 * @apidoc http://dev.sphere.io/http-api-projects-reviews.html#review-by-id
 * @method Review mapResponse(ApiResponseInterface $response)
 */
class ReviewByIdGetRequest extends AbstractByIdGetRequest
{
    protected $resultClass = '\Sphere\Core\Model\Review\Review';

    /**
     * @param string $id
     * @param Context $context
     */
    public function __construct($id, Context $context = null)
    {
        parent::__construct(ReviewsEndpoint::endpoint(), $id, $context);
    }

    /**
     * @param string $id
     * @param Context $context
     * @return static
     */
    public static function ofId($id, Context $context = null)
    {
        return new static($id, $context);
    }
}
