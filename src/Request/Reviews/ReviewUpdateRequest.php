<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Reviews;


use Sphere\Core\Model\Common\Context;
use Sphere\Core\Request\AbstractUpdateRequest;

/**
 * Class ReviewUpdateRequest
 * @package Sphere\Core\Request\Reviews
 * @link http://dev.sphere.io/http-api-projects-reviews.html#update-review
 */
class ReviewUpdateRequest extends AbstractUpdateRequest
{
    protected $resultClass = '\Sphere\Core\Model\Common\JsonObject';

    /**
     * @param string $id
     * @param string $version
     * @param array $actions
     * @param Context $context
     */
    public function __construct($id, $version, array $actions = [], Context $context = null)
    {
        parent::__construct(ReviewsEndpoint::endpoint(), $id, $version, $actions, $context);
    }
}
