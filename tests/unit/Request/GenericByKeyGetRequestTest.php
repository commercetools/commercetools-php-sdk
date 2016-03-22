<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request;

use Commercetools\Core\RequestTestCase;

class GenericByKeyGetRequestTest extends RequestTestCase
{
    /**
     * @param $className
     * @param array $args
     * @return AbstractApiRequest
     */
    protected function getRequest($className, array $args = [])
    {
        $request = call_user_func_array($className . '::ofKey', $args);

        return $request;
    }

    public function mapResultProvider()
    {
        return [
            [
                '\Commercetools\Core\Request\ProductTypes\ProductTypeByKeyGetRequest',
                '\Commercetools\Core\Model\ProductType\ProductType',
            ],
            [
                '\Commercetools\Core\Request\Reviews\ReviewByKeyGetRequest',
                '\Commercetools\Core\Model\Review\Review',
            ],
            [
                '\Commercetools\Core\Request\Types\TypeByKeyGetRequest',
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
        $result = $this->mapResult($requestClass, ['key']);
        $this->assertInstanceOf($resultClass, $result);
    }

    /**
     * @dataProvider mapResultProvider
     * @param $requestClass
     * @param $resultClass
     */
    public function testMapEmptyResult($requestClass, $resultClass)
    {
        $result = $this->mapEmptyResult($requestClass, ['key']);
        $this->assertNull($result);
    }
}
