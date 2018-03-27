<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Builder;

use Commercetools\Core\Model\CustomerGroup\CustomerGroup;
use Commercetools\Core\Model\CustomerGroup\CustomerGroupDraft;
use Commercetools\Core\Request\Categories\CategoryByKeyGetRequest;
use Commercetools\Core\Request\CustomerGroups\CustomerGroupByIdGetRequest;
use Commercetools\Core\Request\CustomerGroups\CustomerGroupByKeyGetRequest;
use Commercetools\Core\Request\CustomerGroups\CustomerGroupCreateRequest;
use Commercetools\Core\Request\CustomerGroups\CustomerGroupDeleteRequest;
use Commercetools\Core\Request\CustomerGroups\CustomerGroupQueryRequest;
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
     * @param $id
     * @return CustomerGroupByIdGetRequest
     */
    public function getById($id)
    {
        return CustomerGroupByIdGetRequest::ofId($id);
    }

    /**
     * @param $key
     * @return CustomerGroupByKeyGetRequest
     */
    public function getByKey($key)
    {
        return CustomerGroupByKeyGetRequest::ofKey($key);
    }
}
