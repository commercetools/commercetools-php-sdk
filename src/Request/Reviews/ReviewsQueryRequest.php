<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Reviews;


use Sphere\Core\Model\Common\Context;
use Sphere\Core\Request\AbstractQueryRequest;

/**
 * Class ReviewsQueryRequest
 * @package Sphere\Core\Request\Reviews
 */
class ReviewsQueryRequest extends AbstractQueryRequest
{
    protected $resultClass = '\Sphere\Core\Model\Common\Collection';

    /**
     * @param Context $context
     */
    public function __construct(Context $context = null)
    {
        parent::__construct(ReviewsEndpoint::endpoint(), $context);
    }
}
