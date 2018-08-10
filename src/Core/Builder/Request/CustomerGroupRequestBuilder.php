<?php

namespace Commercetools\Core\Builder\Request;

use Commercetools\Core\Request\CustomerGroups\CustomerGroupByIdGetRequest;
use Commercetools\Core\Request\CustomerGroups\CustomerGroupByKeyGetRequest;
use Commercetools\Core\Request\CustomerGroups\CustomerGroupCreateRequest;
use Commercetools\Core\Model\CustomerGroup\CustomerGroupDraft;
use Commercetools\Core\Request\CustomerGroups\CustomerGroupDeleteByKeyRequest;
use Commercetools\Core\Model\CustomerGroup\CustomerGroup;
use Commercetools\Core\Request\CustomerGroups\CustomerGroupDeleteRequest;
use Commercetools\Core\Request\CustomerGroups\CustomerGroupQueryRequest;
use Commercetools\Core\Request\CustomerGroups\CustomerGroupUpdateByKeyRequest;
use Commercetools\Core\Request\CustomerGroups\CustomerGroupUpdateRequest;

class CustomerGroupRequestBuilder
{

    /**
     * @link https://docs.commercetools.com/http-api-projects-customerGroups.html#get-customergroup-by-id
     * @param string $id
     * @return CustomerGroupByIdGetRequest
     */
    public function getById($id)
    {
        $request = CustomerGroupByIdGetRequest::ofId($id);
        return $request;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-customerGroups.html#get-customergroup-by-key
     * @param string $key
     * @return CustomerGroupByKeyGetRequest
     */
    public function getByKey($key)
    {
        $request = CustomerGroupByKeyGetRequest::ofKey($key);
        return $request;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-customerGroups.html#create-a-customergroup
     * @param CustomerGroupDraft $customerGroup
     * @return CustomerGroupCreateRequest
     */
    public function create(CustomerGroupDraft $customerGroup)
    {
        $request = CustomerGroupCreateRequest::ofDraft($customerGroup);
        return $request;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-customerGroups.html#delete-customergroup
     * @param CustomerGroup $customerGroup
     * @return CustomerGroupDeleteByKeyRequest
     */
    public function deleteByKey(CustomerGroup $customerGroup)
    {
        $request = CustomerGroupDeleteByKeyRequest::ofKeyAndVersion($customerGroup->getKey(), $customerGroup->getVersion());
        return $request;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-customerGroups.html#delete-customergroup
     * @param CustomerGroup $customerGroup
     * @return CustomerGroupDeleteRequest
     */
    public function delete(CustomerGroup $customerGroup)
    {
        $request = CustomerGroupDeleteRequest::ofIdAndVersion($customerGroup->getId(), $customerGroup->getVersion());
        return $request;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-customerGroups.html#query-customergroups
     * @param 
     * @return CustomerGroupQueryRequest
     */
    public function query()
    {
        $request = CustomerGroupQueryRequest::of();
        return $request;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-customerGroups.html#update-customergroup
     * @param CustomerGroup $customerGroup
     * @return CustomerGroupUpdateByKeyRequest
     */
    public function updateByKey(CustomerGroup $customerGroup)
    {
        $request = CustomerGroupUpdateByKeyRequest::ofKeyAndVersion($customerGroup->getKey(), $customerGroup->getVersion());
        return $request;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-customerGroups.html#update-customergroup
     * @param CustomerGroup $customerGroup
     * @return CustomerGroupUpdateRequest
     */
    public function update(CustomerGroup $customerGroup)
    {
        $request = CustomerGroupUpdateRequest::ofIdAndVersion($customerGroup->getId(), $customerGroup->getVersion());
        return $request;
    }

    /**
     * @return CustomerGroupRequestBuilder
     */
    public function of()
    {
        return new self();
    }
}
