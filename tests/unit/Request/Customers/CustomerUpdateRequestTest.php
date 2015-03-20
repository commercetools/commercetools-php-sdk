<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Customers;


use Sphere\Core\RequestTestCase;

class CustomerUpdateRequestTest extends RequestTestCase
{
    const CUSTOMER_UPDATE_REQUEST = '\Sphere\Core\Request\Customers\CustomerUpdateRequest';

    public function testMapResult()
    {
        $result = $this->mapResult(static::CUSTOMER_UPDATE_REQUEST, ['id', 1]);
        $this->assertInstanceOf('\Sphere\Core\Model\Customer\Customer', $result);
    }

    public function testMapEmptyResult()
    {
        $result = $this->mapEmptyResult(static::CUSTOMER_UPDATE_REQUEST, ['id', 1]);
        $this->assertNull($result);
    }
}
