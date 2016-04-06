<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Reviews;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Type\Type;
use Commercetools\Core\Request\AbstractByKeyGetRequest;
use Commercetools\Core\Response\ApiResponseInterface;
use Commercetools\Core\Model\Review\Review;

/**
 * @package Commercetools\Core\Request\Reviews
 * @method Review mapResponse(ApiResponseInterface $response)
 */
class ReviewByKeyGetRequest extends AbstractByKeyGetRequest
{
    protected $resultClass = '\Commercetools\Core\Model\Review\Review';

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
