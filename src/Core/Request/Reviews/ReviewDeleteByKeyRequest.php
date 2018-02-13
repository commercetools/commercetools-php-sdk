<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Reviews;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractDeleteByKeyRequest;
use Commercetools\Core\Model\Type\Type;
use Commercetools\Core\Response\ApiResponseInterface;
use Commercetools\Core\Model\Review\Review;
use Commercetools\Core\Model\MapperInterface;

/**
 * @package Commercetools\Core\Request\Reviews
 * @link https://docs.commercetools.com/http-api-projects-reviews.html#delete-review-by-key
 * @method Review mapResponse(ApiResponseInterface $response)
 * @method Review mapFromResponse(ApiResponseInterface $response, MapperInterface $mapper = null)
 */
class ReviewDeleteByKeyRequest extends AbstractDeleteByKeyRequest
{
    protected $resultClass = Review::class;

    /**
     * @param string $id
     * @param int $version
     * @param Context $context
     */
    public function __construct($id, $version, Context $context = null)
    {
        parent::__construct(ReviewsEndpoint::endpoint(), $id, $version, $context);
    }

    /**
     * @param string $key
     * @param int $version
     * @param Context $context
     * @return static
     */
    public static function ofKeyAndVersion($key, $version, Context $context = null)
    {
        return new static($key, $version, $context);
    }
}
