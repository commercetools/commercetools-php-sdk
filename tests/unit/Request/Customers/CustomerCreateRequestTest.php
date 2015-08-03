<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Customers;


use Commercetools\Core\Model\Customer\CustomerDraft;
use Commercetools\Core\RequestTestCase;

class CustomerCreateRequestTest extends RequestTestCase
{
    const CUSTOMER_CREATE_REQUEST = '\Commercetools\Core\Request\Customers\CustomerCreateRequest';

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
        $this->assertInstanceOf('\Commercetools\Core\Model\Customer\CustomerSigninResult', $result);
    }

    public function testMapEmptyResult()
    {
        $result = $this->mapEmptyResult(CustomerCreateRequest::ofDraft($this->getCustomer()));
        $this->assertNull($result);
    }
}
