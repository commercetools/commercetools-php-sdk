<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Builder\Request;

use Commercetools\Core\Model\CustomerGroup\CustomerGroup;
use Commercetools\Core\Model\CustomerGroup\CustomerGroupDraft;
use Commercetools\Core\Request\CustomerGroups\CustomerGroupByIdGetRequest;
use Commercetools\Core\Request\CustomerGroups\CustomerGroupByKeyGetRequest;
use Commercetools\Core\Request\CustomerGroups\CustomerGroupCreateRequest;
use Commercetools\Core\Request\CustomerGroups\CustomerGroupDeleteByKeyRequest;
use Commercetools\Core\Request\CustomerGroups\CustomerGroupDeleteRequest;
use Commercetools\Core\Request\CustomerGroups\CustomerGroupQueryRequest;
use Commercetools\Core\Request\CustomerGroups\CustomerGroupUpdateByKeyRequest;
use Commercetools\Core\Request\CustomerGroups\CustomerGroupUpdateRequest;

class CustomerGroupRequestBuilder
{
    /**
     * @return CustomerGroupQueryRequest
     */
    public function query()
    {
        return CustomerGroupQueryRequest::of();
    }

    /**
     * @param CustomerGroup $customerGroup
     * @return CustomerGroupUpdateRequest
     */
    public function update(CustomerGroup $customerGroup)
    {
        return CustomerGroupUpdateRequest::ofIdAndVersion($customerGroup->getId(), $customerGroup->getVersion());
    }

    /**
     * @param CustomerGroup $customerGroup
     * @return CustomerGroupUpdateByKeyRequest
     */
    public function updateByKey(CustomerGroup $customerGroup)
    {
        return CustomerGroupUpdateByKeyRequest::ofKeyAndVersion($customerGroup->getKey(), $customerGroup->getVersion());
    }

    /**
     * @param CustomerGroupDraft $customerGroupDraft
     * @return CustomerGroupCreateRequest
     */
    public function create(CustomerGroupDraft $customerGroupDraft)
    {
        return CustomerGroupCreateRequest::ofDraft($customerGroupDraft);
    }

    /**
     * @param CustomerGroup $customerGroup
     * @return CustomerGroupDeleteRequest
     */
    public function delete(CustomerGroup $customerGroup)
    {
        return CustomerGroupDeleteRequest::ofIdAndVersion($customerGroup->getId(), $customerGroup->getVersion());
    }

    /**
     * @param CustomerGroup $customerGroup
     * @return CustomerGroupDeleteByKeyRequest
     */
    public function deleteByKey(CustomerGroup $customerGroup)
    {
        return CustomerGroupDeleteByKeyRequest::ofKeyAndVersion($customerGroup->getKey(), $customerGroup->getVersion());
    }

    /**
     * @param string $id
     * @return CustomerGroupByIdGetRequest
     */
    public function getById($id)
    {
        return CustomerGroupByIdGetRequest::ofId($id);
    }

    /**
     * @param string $key
     * @return CustomerGroupByKeyGetRequest
     */
    public function getByKey($key)
    {
        return CustomerGroupByKeyGetRequest::ofKey($key);
    }
}
