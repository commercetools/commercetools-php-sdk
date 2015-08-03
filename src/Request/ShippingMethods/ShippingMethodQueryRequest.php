<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\ShippingMethods;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractQueryRequest;
use Commercetools\Core\Model\ShippingMethod\ShippingMethodCollection;
use Commercetools\Core\Response\ApiResponseInterface;

/**
 * @package Commercetools\Core\Request\ShippingMethods
 * @apidoc http://dev.sphere.io/http-api-projects-shippingMethods.html#shipping-methods-by-query
 * @method ShippingMethodCollection mapResponse(ApiResponseInterface $response)
 */
class ShippingMethodQueryRequest extends AbstractQueryRequest
{
    protected $resultClass = '\Commercetools\Core\Model\ShippingMethod\ShippingMethodCollection';

    /**
     * @param Context $context
     */
    public function __construct(Context $context = null)
    {
        parent::__construct(ShippingMethodsEndpoint::endpoint(), $context);
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
