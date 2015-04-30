<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\ShippingMethods;


use Sphere\Core\Model\Common\Context;
use Sphere\Core\Request\AbstractQueryRequest;

/**
 * Class ShippingMethodsQueryRequest
 * @package Sphere\Core\Request\ShippingMethods
 * @link http://dev.sphere.io/http-api-projects-shippingMethods.html#shipping-methods-by-query
 */
class ShippingMethodsQueryRequest extends AbstractQueryRequest
{
    protected $resultClass = '\Sphere\Core\Model\Common\Collection';

    /**
     * @param Context $context
     */
    public function __construct(Context $context = null)
    {
        parent::__construct(ShippingMethodsEndpoint::endpoint(), $context);
    }
}
