<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request;

use Commercetools\Core\RequestTestCase;

class GenericDeleteByKeyRequestTest extends RequestTestCase
{
    /**
     * @param $className
     * @param array $args
     * @return AbstractApiRequest
     */
    protected function getRequest($className, array $args = [])
    {
        $request = call_user_func_array($className . '::ofKeyAndVersion', $args);

        return $request;
    }

    public function mapResultProvider()
    {
        return [
            [
                '\Commercetools\Core\Request\ProductTypes\ProductTypeDeleteByKeyRequest',
                '\Commercetools\Core\Model\ProductType\ProductType',
            ],
            [
                '\Commercetools\Core\Request\Reviews\ReviewDeleteByKeyRequest',
                '\Commercetools\Core\Model\Review\Review',
            ],
            [
                '\Commercetools\Core\Request\Types\TypeDeleteByKeyRequest',
                '\Commercetools\Core\Model\Type\Type',
            ],
        ];
    }

    /**
     * @dataProvider mapResultProvider
     * @param $requestClass
     * @param $resultClass
     */
    public function testMapResult($requestClass, $resultClass)
    {
        $result = $this->mapResult($requestClass, ['key', 1]);
        $this->assertInstanceOf($resultClass, $result);
    }

    /**
     * @dataProvider mapResultProvider
     * @param $requestClass
     * @param $resultClass
     */
    public function testMapEmptyResult($requestClass, $resultClass)
    {
        $result = $this->mapEmptyResult($requestClass, ['key', 1]);
        $this->assertNull($result);
    }
}
