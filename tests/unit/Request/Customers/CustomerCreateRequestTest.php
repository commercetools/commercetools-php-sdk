<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Customers;


use Sphere\Core\Model\Customer\CustomerDraft;
use Sphere\Core\RequestTestCase;

class CustomerCreateRequestTest extends RequestTestCase
{
    const CUSTOMER_CREATE_REQUEST = '\Sphere\Core\Request\Customers\CustomerCreateRequest';

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
        $this->assertInstanceOf('\Sphere\Core\Model\Customer\CustomerSigninResult', $result);
    }

    public function testMapEmptyResult()
    {
        $result = $this->mapEmptyResult(CustomerCreateRequest::ofDraft($this->getCustomer()));
        $this->assertNull($result);
    }
}
