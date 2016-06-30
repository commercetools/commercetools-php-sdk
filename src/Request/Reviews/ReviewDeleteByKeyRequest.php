<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Reviews;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractDeleteByKeyRequest;
use Commercetools\Core\Model\Type\Type;
use Commercetools\Core\Response\ApiResponseInterface;
use Commercetools\Core\Model\Review\Review;

/**
 * @package Commercetools\Core\Request\Reviews
 * @link https://dev.commercetools.com/http-api-projects-reviews.html#delete-review-by-key
 * @method Review mapResponse(ApiResponseInterface $response)
 */
class ReviewDeleteByKeyRequest extends AbstractDeleteByKeyRequest
{
    protected $resultClass = '\Commercetools\Core\Model\Review\Review';

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
