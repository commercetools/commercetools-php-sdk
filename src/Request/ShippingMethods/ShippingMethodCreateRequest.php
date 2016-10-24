<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\ShippingMethods;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\ShippingMethod\ShippingMethodDraft;
use Commercetools\Core\Request\AbstractCreateRequest;
use Commercetools\Core\Model\ShippingMethod\ShippingMethod;
use Commercetools\Core\Response\ApiResponseInterface;
use Commercetools\Core\Model\MapperInterface;

/**
 * @package Commercetools\Core\Request\ShippingMethods
 * @link https://dev.commercetools.com/http-api-projects-shippingMethods.html#create-shippingmethod
 * @method ShippingMethod mapResponse(ApiResponseInterface $response)
 * @method ShippingMethod mapFromResponse(ApiResponseInterface $response, MapperInterface $mapper = null)
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
