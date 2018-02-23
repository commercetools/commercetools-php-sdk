<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\ShippingMethods;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractByIdGetRequest;
use Commercetools\Core\Model\ShippingMethod\ShippingMethod;
use Commercetools\Core\Response\ApiResponseInterface;
use Commercetools\Core\Model\MapperInterface;

/**
 * @package Commercetools\Core\Request\ShippingMethods
 * @link https://docs.commercetools.com/http-api-projects-shippingMethods.html#get-shippingmethod-by-id
 * @method ShippingMethod mapResponse(ApiResponseInterface $response)
 * @method ShippingMethod mapFromResponse(ApiResponseInterface $response, MapperInterface $mapper = null)
 */
class ShippingMethodByIdGetRequest extends AbstractByIdGetRequest
{
    protected $resultClass = ShippingMethod::class;

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
