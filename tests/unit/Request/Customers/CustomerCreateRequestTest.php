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
        return new CustomerDraft(
            'email',
            'firstname',
            'lastname',
            'password'
        );
    }
    public function testMapResult()
    {
        $result = $this->mapResult(static::CUSTOMER_CREATE_REQUEST, [$this->getCustomer()]);
        $this->assertInstanceOf('\Sphere\Core\Model\Customer\Customer', $result);
    }

    public function testMapEmptyResult()
    {
        $result = $this->mapEmptyResult(static::CUSTOMER_CREATE_REQUEST, [$this->getCustomer()]);
        $this->assertNull($result);
    }
}
