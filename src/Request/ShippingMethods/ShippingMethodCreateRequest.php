<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\ShippingMethods;


use Sphere\Core\Model\Common\Context;
use Sphere\Core\Model\ShippingMethod\ShippingMethodDraft;
use Sphere\Core\Request\AbstractCreateRequest;

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
}
