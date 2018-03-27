<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Builder;

use Commercetools\Core\Model\ShippingMethod\ShippingMethod;
use Commercetools\Core\Model\ShippingMethod\ShippingMethodDraft;
use Commercetools\Core\Request\ShippingMethods\ShippingMethodByIdGetRequest;
use Commercetools\Core\Request\ShippingMethods\ShippingMethodByKeyGetRequest;
use Commercetools\Core\Request\ShippingMethods\ShippingMethodCreateRequest;
use Commercetools\Core\Request\ShippingMethods\ShippingMethodDeleteRequest;
use Commercetools\Core\Request\ShippingMethods\ShippingMethodQueryRequest;
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
     * @param $id
     * @return ShippingMethodByIdGetRequest
     */
    public function getById($id)
    {
        return ShippingMethodByIdGetRequest::ofId($id);
    }

    /**
     * @param $key
     * @return ShippingMethodByKeyGetRequest
     */
    public function getByKey($key)
    {
        return ShippingMethodByKeyGetRequest::ofKey($key);
    }
}
