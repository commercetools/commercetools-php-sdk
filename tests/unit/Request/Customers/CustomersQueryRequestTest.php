<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Customers;


use Sphere\Core\RequestTestCase;

class CustomersQueryRequestTest extends RequestTestCase
{
    const CUSTOMERS_QUERY_REQUEST = '\Sphere\Core\Request\Customers\CustomersQueryRequest';

    public function testMapResult()
    {
        $result = $this->mapQueryResult(static::CUSTOMERS_QUERY_REQUEST);
        $this->assertInstanceOf('\Sphere\Core\Model\Customer\CustomerCollection', $result);
        $this->assertCount(3, $result);
    }

    public function testMapEmptyResult()
    {
        $result = $this->mapEmptyResult(static::CUSTOMERS_QUERY_REQUEST);
        $this->assertInstanceOf('\Sphere\Core\Model\Customer\CustomerCollection', $result);
    }
}
