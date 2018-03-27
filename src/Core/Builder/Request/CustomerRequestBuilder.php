<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Builder\Request;

use Commercetools\Core\Model\Customer\Customer;
use Commercetools\Core\Model\Customer\CustomerDraft;
use Commercetools\Core\Request\Customers\CustomerByIdGetRequest;
use Commercetools\Core\Request\Customers\CustomerByKeyGetRequest;
use Commercetools\Core\Request\Customers\CustomerCreateRequest;
use Commercetools\Core\Request\Customers\CustomerDeleteRequest;
use Commercetools\Core\Request\Customers\CustomerQueryRequest;
use Commercetools\Core\Request\Customers\CustomerUpdateRequest;

class CustomerRequestBuilder
{
    /**
     * @return CustomerQueryRequest
     */
    public function query()
    {
        return CustomerQueryRequest::of();
    }

    /**
     * @param Customer $customer
     * @return CustomerUpdateRequest
     */
    public function update(Customer $customer)
    {
        return CustomerUpdateRequest::ofIdAndVersion($customer->getId(), $customer->getVersion());
    }

    /**
     * @param CustomerDraft $customerDraft
     * @return CustomerCreateRequest
     */
    public function create(CustomerDraft $customerDraft)
    {
        return CustomerCreateRequest::ofDraft($customerDraft);
    }

    /**
     * @param Customer $customer
     * @return CustomerDeleteRequest
     */
    public function delete(Customer $customer)
    {
        return CustomerDeleteRequest::ofIdAndVersion($customer->getId(), $customer->getVersion());
    }

    /**
     * @param $id
     * @return CustomerByIdGetRequest
     */
    public function getById($id)
    {
        return CustomerByIdGetRequest::ofId($id);
    }

    /**
     * @param $key
     * @return CustomerByKeyGetRequest
     */
    public function getByKey($key)
    {
        return CustomerByKeyGetRequest::ofKey($key);
    }
}
