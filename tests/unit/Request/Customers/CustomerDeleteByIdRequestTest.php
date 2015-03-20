<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Customers;


use Sphere\Core\RequestTestCase;

class CustomerDeleteByIdRequestTest extends RequestTestCase
{
    const CUSTOMER_DELETE_BY_ID_REQUEST = '\Sphere\Core\Request\Customers\CustomerDeleteByIdRequest';

    public function testMapResult()
    {
        $result = $this->mapResult(static::CUSTOMER_DELETE_BY_ID_REQUEST, ['id', 1]);
        $this->assertInstanceOf('\Sphere\Core\Model\Customer\Customer', $result);
    }

    public function testMapEmptyResult()
    {
        $result = $this->mapEmptyResult(static::CUSTOMER_DELETE_BY_ID_REQUEST, ['id', 1]);
        $this->assertNull($result);
    }
}
