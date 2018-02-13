<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request;

use Commercetools\Core\Model\ProductType\ProductType;
use Commercetools\Core\Model\Review\Review;
use Commercetools\Core\Model\Type\Type;
use Commercetools\Core\Request\ProductTypes\ProductTypeDeleteByKeyRequest;
use Commercetools\Core\Request\Reviews\ReviewDeleteByKeyRequest;
use Commercetools\Core\Request\Types\TypeDeleteByKeyRequest;
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
            ProductTypeDeleteByKeyRequest::class => [
                ProductTypeDeleteByKeyRequest::class,
                ProductType::class,
            ],
            ReviewDeleteByKeyRequest::class => [
                ReviewDeleteByKeyRequest::class,
                Review::class,
            ],
            TypeDeleteByKeyRequest::class => [
                TypeDeleteByKeyRequest::class,
                Type::class,
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
