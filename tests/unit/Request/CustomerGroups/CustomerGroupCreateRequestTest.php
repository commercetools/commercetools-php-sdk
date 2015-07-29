<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\CustomerGroups;


use Sphere\Core\Model\CustomerGroup\CustomerGroupDraft;
use Sphere\Core\RequestTestCase;

class CustomerGroupCreateRequestTest extends RequestTestCase
{
    const CUSTOMER_GROUP_CREATE_REQUEST = '\Sphere\Core\Request\CustomerGroups\CustomerGroupCreateRequest';

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
        $this->assertInstanceOf('\Sphere\Core\Model\CustomerGroup\CustomerGroup', $result);
    }

    public function testMapEmptyResult()
    {
        $result = $this->mapEmptyResult(CustomerGroupCreateRequest::ofDraft($this->getDraft()));
        $this->assertNull($result);
    }
}
