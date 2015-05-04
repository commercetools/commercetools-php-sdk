<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\ShippingMethods;


use Sphere\Core\Model\Common\Context;
use Sphere\Core\Request\AbstractUpdateRequest;

/**
 * Class ShippingMethodUpdateRequest
 * @package Sphere\Core\Request\ShippingMethods
 * @link http://dev.sphere.io/http-api-projects-shippingMethods.html#update-shipping-method
 */
class ShippingMethodUpdateRequest extends AbstractUpdateRequest
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
        parent::__construct(ShippingMethodsEndpoint::endpoint(), $id, $version, $actions, $context);
    }
}
