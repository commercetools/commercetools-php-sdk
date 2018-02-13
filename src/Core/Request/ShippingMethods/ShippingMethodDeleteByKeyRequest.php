<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\ShippingMethods;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\ShippingMethod\ShippingMethod;
use Commercetools\Core\Request\AbstractDeleteByKeyRequest;
use Commercetools\Core\Response\ApiResponseInterface;
use Commercetools\Core\Model\MapperInterface;

/**
 * @package Commercetools\Core\Request\ShippingMethods
 * @link http://docs.commercetools.com/http-api-projects-shippingMethods.html#delete-shippingmethod-by-key
 * @method ShippingMethod mapResponse(ApiResponseInterface $response)
 * @method ShippingMethod mapFromResponse(ApiResponseInterface $response, MapperInterface $mapper = null)
 */
class ShippingMethodDeleteByKeyRequest extends AbstractDeleteByKeyRequest
{
    protected $resultClass = ShippingMethod::class;

    /**
     * @param string $id
     * @param int $version
     * @param Context $context
     */
    public function __construct($id, $version, Context $context = null)
    {
        parent::__construct(ShippingMethodsEndpoint::endpoint(), $id, $version, $context);
    }

    /**
     * @param string $key
     * @param int $version
     * @param Context $context
     * @return static
     */
    public static function ofKeyAndVersion($key, $version, Context $context = null)
    {
        return new static($key, $version, $context);
    }
}
