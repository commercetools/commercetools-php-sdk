<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\ShippingMethods;

use Sphere\Core\Model\Common\Context;
use Sphere\Core\Request\AbstractFetchByIdRequest;
use Sphere\Core\Model\ShippingMethod\ShippingMethod;
use Sphere\Core\Response\ApiResponseInterface;

/**
 * @package Sphere\Core\Request\ShippingMethods
 * @link http://dev.sphere.io/http-api-projects-shippingMethods.html#shipping-method-by-id
 * @method ShippingMethod mapResponse(ApiResponseInterface $response)
 */
class ShippingMethodFetchByIdRequest extends AbstractFetchByIdRequest
{
    protected $resultClass = '\Sphere\Core\Model\ShippingMethod\ShippingMethod';

    /**
     * @param string $id
     * @param Context $context
     */
    public function __construct($id, Context $context = null)
    {
        parent::__construct(ShippingMethodsEndpoint::endpoint(), $id, $context);
    }

    /**
     * @param string $id
     * @param Context $context
     * @return static
     */
    public static function ofId($id, Context $context = null)
    {
        return new static($id, $context);
    }
}
