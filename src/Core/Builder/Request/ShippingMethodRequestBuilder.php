<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Builder\Request;

use Commercetools\Core\Model\ShippingMethod\ShippingMethod;
use Commercetools\Core\Model\ShippingMethod\ShippingMethodDraft;
use Commercetools\Core\Model\Zone\Location;
use Commercetools\Core\Request\ShippingMethods\ShippingMethodByCartIdGetRequest;
use Commercetools\Core\Request\ShippingMethods\ShippingMethodByIdGetRequest;
use Commercetools\Core\Request\ShippingMethods\ShippingMethodByKeyGetRequest;
use Commercetools\Core\Request\ShippingMethods\ShippingMethodByLocationGetRequest;
use Commercetools\Core\Request\ShippingMethods\ShippingMethodCreateRequest;
use Commercetools\Core\Request\ShippingMethods\ShippingMethodDeleteByKeyRequest;
use Commercetools\Core\Request\ShippingMethods\ShippingMethodDeleteRequest;
use Commercetools\Core\Request\ShippingMethods\ShippingMethodQueryRequest;
use Commercetools\Core\Request\ShippingMethods\ShippingMethodUpdateByKeyRequest;
use Commercetools\Core\Request\ShippingMethods\ShippingMethodUpdateRequest;

class ShippingMethodRequestBuilder
{
    /**
     * @return ShippingMethodQueryRequest
     */
    public function query()
    {
        return ShippingMethodQueryRequest::of();
    }

    /**
     * @param ShippingMethod $shippingMethod
     * @return ShippingMethodUpdateRequest
     */
    public function update(ShippingMethod $shippingMethod)
    {
        return ShippingMethodUpdateRequest::ofIdAndVersion($shippingMethod->getId(), $shippingMethod->getVersion());
    }

    /**
     * @param ShippingMethod $shippingMethod
     * @return ShippingMethodUpdateByKeyRequest
     */
    public function updateByKey(ShippingMethod $shippingMethod)
    {
        return ShippingMethodUpdateByKeyRequest::ofKeyAndVersion(
            $shippingMethod->getKey(),
            $shippingMethod->getVersion()
        );
    }

    /**
     * @param ShippingMethodDraft $shippingMethodDraft
     * @return ShippingMethodCreateRequest
     */
    public function create(ShippingMethodDraft $shippingMethodDraft)
    {
        return ShippingMethodCreateRequest::ofDraft($shippingMethodDraft);
    }

    /**
     * @param ShippingMethod $shippingMethod
     * @return ShippingMethodDeleteRequest
     */
    public function delete(ShippingMethod $shippingMethod)
    {
        return ShippingMethodDeleteRequest::ofIdAndVersion($shippingMethod->getId(), $shippingMethod->getVersion());
    }

    /**
     * @param ShippingMethod $shippingMethod
     * @return ShippingMethodDeleteByKeyRequest
     */
    public function deleteByKey(ShippingMethod $shippingMethod)
    {
        return ShippingMethodDeleteByKeyRequest::ofKeyAndVersion(
            $shippingMethod->getKey(),
            $shippingMethod->getVersion()
        );
    }

    /**
     * @param string $id
     * @return ShippingMethodByIdGetRequest
     */
    public function getById($id)
    {
        return ShippingMethodByIdGetRequest::ofId($id);
    }

    /**
     * @param string $key
     * @return ShippingMethodByKeyGetRequest
     */
    public function getByKey($key)
    {
        return ShippingMethodByKeyGetRequest::ofKey($key);
    }

    /**
     * @param string $cartId
     * @return ShippingMethodByCartIdGetRequest
     */
    public function getByCartId($cartId)
    {
        return ShippingMethodByCartIdGetRequest::ofCartId($cartId);
    }

    /**
     * @param Location $location
     * @param string $currency
     * @return ShippingMethodByLocationGetRequest
     */
    public function getByLocation(Location $location, $currency = null)
    {
        $request = ShippingMethodByLocationGetRequest::ofCountry($location->getCountry());
        if (!is_null($location->getState())) {
            $request->withState($location->getState());
        }
        if (!is_null($currency)) {
            $request->withCurrency($currency);
        }
        return $request;
    }
}
