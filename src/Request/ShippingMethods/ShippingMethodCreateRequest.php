<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\ShippingMethods;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\ShippingMethod\ShippingMethodDraft;
use Commercetools\Core\Request\AbstractCreateRequest;
use Commercetools\Core\Model\ShippingMethod\ShippingMethod;
use Commercetools\Core\Response\ApiResponseInterface;

/**
 * @package Commercetools\Core\Request\ShippingMethods
 *
 * @method ShippingMethod mapResponse(ApiResponseInterface $response)
 */
class ShippingMethodCreateRequest extends AbstractCreateRequest
{
    protected $resultClass = '\Commercetools\Core\Model\ShippingMethod\ShippingMethod';

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
