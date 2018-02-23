<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Reviews;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Type\Type;
use Commercetools\Core\Request\AbstractByKeyGetRequest;
use Commercetools\Core\Response\ApiResponseInterface;
use Commercetools\Core\Model\Review\Review;
use Commercetools\Core\Model\MapperInterface;

/**
 * @package Commercetools\Core\Request\Reviews
 * @link https://docs.commercetools.com/http-api-projects-reviews.html#get-review-by-key
 * @method Review mapResponse(ApiResponseInterface $response)
 * @method Review mapFromResponse(ApiResponseInterface $response, MapperInterface $mapper = null)
 */
class ReviewByKeyGetRequest extends AbstractByKeyGetRequest
{
    protected $resultClass = Review::class;

    /**
     * @param string $key
     * @param Context $context
     */
    public function __construct($key, Context $context = null)
    {
        parent::__construct(ReviewsEndpoint::endpoint(), $key, $context);
    }

    /**
     * @param string $key
     * @param Context $context
     * @return static
     */
    public static function ofKey($key, Context $context = null)
    {
        return new static($key, $context);
    }
}
