<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\ShippingMethods;


use Sphere\Core\Model\Common\Context;
use Sphere\Core\Request\AbstractFetchByIdRequest;

/**
 * Class ShippingMethodFetchByIdRequest
 * @package Sphere\Core\Request\ShippingMethods
 * @link http://dev.sphere.io/http-api-projects-shippingMethods.html#shipping-method-by-id
 */
class ShippingMethodFetchByIdRequest extends AbstractFetchByIdRequest
{
    protected $resultClass = '\Sphere\Core\Model\Common\JsonObject';

    /**
     * @param string $id
     * @param Context $context
     */
    public function __construct($id, Context $context = null)
    {
        parent::__construct(ShippingMethodsEndpoint::endpoint(), $id, $context);
    }
}
