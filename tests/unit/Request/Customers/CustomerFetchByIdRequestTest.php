<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Customers;


use Sphere\Core\RequestTestCase;

class CustomerFetchByIdRequestTest extends RequestTestCase
{
    const CUSTOMER_FETCH_BY_ID_REQUEST = '\Sphere\Core\Request\Customers\CustomerFetchByIdRequest';

    public function testMapResult()
    {
        $result = $this->mapResult(static::CUSTOMER_FETCH_BY_ID_REQUEST, ['id']);
        $this->assertInstanceOf('\Sphere\Core\Model\Customer\Customer', $result);
    }

    public function testMapEmptyResult()
    {
        $result = $this->mapEmptyResult(static::CUSTOMER_FETCH_BY_ID_REQUEST, ['id']);
        $this->assertNull($result);
    }
}
