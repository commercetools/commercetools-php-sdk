<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Customers;

use Commercetools\Core\Model\Customer\CustomerDraft;
use Commercetools\Core\Model\Customer\CustomerSigninResult;
use Commercetools\Core\RequestTestCase;

class CustomerCreateRequestTest extends RequestTestCase
{
    const CUSTOMER_CREATE_REQUEST = CustomerCreateRequest::class;

    public function getCustomer()
    {
        return CustomerDraft::ofEmailNameAndPassword(
            'email',
            'firstname',
            'lastname',
            'password'
        );
    }
    public function testMapResult()
    {
        $result = $this->mapResult(CustomerCreateRequest::ofDraft($this->getCustomer()));
        $this->assertInstanceOf(CustomerSigninResult::class, $result);
    }

    public function testMapEmptyResult()
    {
        $result = $this->mapEmptyResult(CustomerCreateRequest::ofDraft($this->getCustomer()));
        $this->assertNull($result);
    }
}
