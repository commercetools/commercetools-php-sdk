<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\ShippingMethods;

use Sphere\Core\Model\Common\Context;
use Sphere\Core\Model\ShippingMethod\ShippingMethodDraft;
use Sphere\Core\Request\AbstractCreateRequest;
use Sphere\Core\Model\ShippingMethod\ShippingMethod;
use Sphere\Core\Response\ApiResponseInterface;

/**
 * @package Sphere\Core\Request\ShippingMethods
 * 
 * @method ShippingMethod mapResponse(ApiResponseInterface $response)
 */
class ShippingMethodCreateRequest extends AbstractCreateRequest
{
    protected $resultClass = '\Sphere\Core\Model\ShippingMethod\ShippingMethod';

    /**
     * @param ShippingMethodDraft $shippingMethod
     * @param Context $context
     */
    public function __construct(ShippingMethodDraft $shippingMethod, Context $context = null)
    {
        parent::__construct(ShippingMethodsEndpoint::endpoint(), $shippingMethod, $context);
    }

    /**
     * @param ShippingMethodDraft $shippingMethod
     * @param Context $context
     * @return static
     */
    public static function ofDraft(ShippingMethodDraft $shippingMethod, Context $context = null)
    {
        return new static($shippingMethod, $context);
    }
}
