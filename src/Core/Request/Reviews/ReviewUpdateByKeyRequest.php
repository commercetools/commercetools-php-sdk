<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Reviews;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractUpdateByKeyRequest;
use Commercetools\Core\Request\AbstractUpdateRequest;
use Commercetools\Core\Model\Review\Review;
use Commercetools\Core\Response\ApiResponseInterface;
use Commercetools\Core\Model\MapperInterface;

/**
 * @package Commercetools\Core\Request\Reviews
 * @link https://dev.commercetools.com/http-api-projects-reviews.html#update-review-by-key
 * @method Review mapResponse(ApiResponseInterface $response)
 * @method Review mapFromResponse(ApiResponseInterface $response, MapperInterface $mapper = null)
 */
class ReviewUpdateByKeyRequest extends AbstractUpdateByKeyRequest
{
    protected $resultClass = Review::class;

    /**
     * @param string $key
     * @param string $version
     * @param array $actions
     * @param Context $context
     */
    public function __construct($key, $version, array $actions = [], Context $context = null)
    {
        parent::__construct(ReviewsEndpoint::endpoint(), $key, $version, $actions, $context);
    }

    /**
     * @param string $key
     * @param int $version
     * @param Context $context
     * @return static
     */
    public static function ofKeyAndVersion($key, $version, Context $context = null)
    {
        return new static($key, $version, [], $context);
    }
}
