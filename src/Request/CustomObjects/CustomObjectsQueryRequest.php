<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\CustomObjects;


use Sphere\Core\Model\Common\Context;
use Sphere\Core\Request\AbstractQueryRequest;

/**
 * Class CustomObjectsQueryRequest
 * @package Sphere\Core\Request\CustomObjects
 * @link http://dev.sphere.io/http-api-projects-custom-objects.html#custom-objects-by-query
 */
class CustomObjectsQueryRequest extends AbstractQueryRequest
{
    protected $resultClass = '\Sphere\Core\Model\CustomObject\CustomObjectCollection';

    /**
     * @param Context $context
     */
    public function __construct(Context $context = null)
    {
        parent::__construct(CustomObjectsEndpoint::endpoint(), $context);
    }

    /**
     * @param Context $context
     * @return static
     */
    public static function of(Context $context = null)
    {
        return new static($context);
    }
}
