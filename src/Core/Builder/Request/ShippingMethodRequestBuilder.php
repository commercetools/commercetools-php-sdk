<?php
// phpcs:disable Generic.Files.LineLength
namespace Commercetools\Core\Builder\Request;

use Commercetools\Core\Request\ShippingMethods\ShippingMethodByCartIdGetRequest;
use Commercetools\Core\Request\ShippingMethods\ShippingMethodByIdGetRequest;
use Commercetools\Core\Request\ShippingMethods\ShippingMethodByKeyGetRequest;
use Commercetools\Core\Request\ShippingMethods\ShippingMethodByLocationGetRequest;
use Commercetools\Core\Model\Zone\Location;
use Commercetools\Core\Request\ShippingMethods\ShippingMethodByMatchingLocationGetRequest;
use Commercetools\Core\Request\ShippingMethods\ShippingMethodByMatchingOrderEditGetRequest;
use Commercetools\Core\Request\ShippingMethods\ShippingMethodCreateRequest;
use Commercetools\Core\Model\ShippingMethod\ShippingMethodDraft;
use Commercetools\Core\Request\ShippingMethods\ShippingMethodDeleteByKeyRequest;
use Commercetools\Core\Model\ShippingMethod\ShippingMethod;
use Commercetools\Core\Request\ShippingMethods\ShippingMethodDeleteRequest;
use Commercetools\Core\Request\ShippingMethods\ShippingMethodQueryRequest;
use Commercetools\Core\Request\ShippingMethods\ShippingMethodUpdateByKeyRequest;
use Commercetools\Core\Request\ShippingMethods\ShippingMethodUpdateRequest;

class ShippingMethodRequestBuilder
{

    /**
     * @link https://docs.commercetools.com/http-api-projects-shippingMethods.html#get-shippingmethods-for-a-cart
     * @param string $cartId
     * @return ShippingMethodByCartIdGetRequest
     */
    public function getByCartId($cartId)
    {
        $request = ShippingMethodByCartIdGetRequest::ofCartId($cartId);
        return $request;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-shippingMethods.html#get-shippingmethod-by-id
     * @param string $id
     * @return ShippingMethodByIdGetRequest
     */
    public function getById($id)
    {
        $request = ShippingMethodByIdGetRequest::ofId($id);
        return $request;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-shippingMethods.html#get-shippingmethod-by-key
     * @param string $key
     * @return ShippingMethodByKeyGetRequest
     */
    public function getByKey($key)
    {
        $request = ShippingMethodByKeyGetRequest::ofKey($key);
        return $request;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-shippingMethods.html#get-shippingmethods-for-a-location
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

    /**
     * @link https://docs.commercetools.com/http-api-projects-shippingMethods.html#get-shippingmethods-for-a-location
     * @param Location $location
     * @param string $currency
     * @return ShippingMethodByMatchingLocationGetRequest
     */
    public function getMatchingLocation(Location $location, $currency = null)
    {
        $request = ShippingMethodByMatchingLocationGetRequest::ofCountry($location->getCountry());
        if (!is_null($location->getState())) {
            $request->withState($location->getState());
        }
        if (!is_null($currency)) {
            $request->withCurrency($currency);
        }
        return $request;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-shippingMethods.html#get-shippingmethods-for-an-orderedit
     * @param string $orderEditId
     * @param Location $location
     * @return ShippingMethodByMatchingOrderEditGetRequest
     */
    public function getMatchingOrderEdit($orderEditId, Location $location)
    {
        $request = ShippingMethodByMatchingOrderEditGetRequest::ofOrderEditAndCountry($orderEditId, $location);
        return $request;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-shippingMethods.html#create-shippingmethod
     * @param ShippingMethodDraft $shippingMethod
     * @return ShippingMethodCreateRequest
     */
    public function create(ShippingMethodDraft $shippingMethod)
    {
        $request = ShippingMethodCreateRequest::ofDraft($shippingMethod);
        return $request;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-shippingMethods.html#delete-shippingmethod-by-key
     * @param ShippingMethod $shippingMethod
     * @return ShippingMethodDeleteByKeyRequest
     */
    public function deleteByKey(ShippingMethod $shippingMethod)
    {
        $request = ShippingMethodDeleteByKeyRequest::ofKeyAndVersion($shippingMethod->getKey(), $shippingMethod->getVersion());
        return $request;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-shippingMethods.html#delete-shippingmethod
     * @param ShippingMethod $shippingMethod
     * @return ShippingMethodDeleteRequest
     */
    public function delete(ShippingMethod $shippingMethod)
    {
        $request = ShippingMethodDeleteRequest::ofIdAndVersion($shippingMethod->getId(), $shippingMethod->getVersion());
        return $request;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-shippingMethods.html#query-shippingmethods
     *
     * @return ShippingMethodQueryRequest
     */
    public function query()
    {
        $request = ShippingMethodQueryRequest::of();
        return $request;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-shippingMethods.html#update-shippingmethod-by-key
     * @param ShippingMethod $shippingMethod
     * @return ShippingMethodUpdateByKeyRequest
     */
    public function updateByKey(ShippingMethod $shippingMethod)
    {
        $request = ShippingMethodUpdateByKeyRequest::ofKeyAndVersion($shippingMethod->getKey(), $shippingMethod->getVersion());
        return $request;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-shippingMethods.html#update-shippingmethod
     * @param ShippingMethod $shippingMethod
     * @return ShippingMethodUpdateRequest
     */
    public function update(ShippingMethod $shippingMethod)
    {
        $request = ShippingMethodUpdateRequest::ofIdAndVersion($shippingMethod->getId(), $shippingMethod->getVersion());
        return $request;
    }

    /**
     * @return ShippingMethodRequestBuilder
     */
    public function of()
    {
        return new self();
    }
}
