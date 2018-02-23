<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\CustomerGroups;

use Commercetools\Core\Model\CustomerGroup\CustomerGroup;
use Commercetools\Core\Model\CustomerGroup\CustomerGroupDraft;
use Commercetools\Core\RequestTestCase;

class CustomerGroupCreateRequestTest extends RequestTestCase
{
    const CUSTOMER_GROUP_CREATE_REQUEST = CustomerGroupCreateRequest::class;

    protected function getDraft()
    {
        return CustomerGroupDraft::fromArray(json_decode(
            '{
                "groupName": "myCustomerGroup"
            }',
            true
        ));
    }
    public function testMapResult()
    {
        $result = $this->mapResult(CustomerGroupCreateRequest::ofDraft($this->getDraft()));
        $this->assertInstanceOf(CustomerGroup::class, $result);
    }

    public function testMapEmptyResult()
    {
        $result = $this->mapEmptyResult(CustomerGroupCreateRequest::ofDraft($this->getDraft()));
        $this->assertNull($result);
    }
}
