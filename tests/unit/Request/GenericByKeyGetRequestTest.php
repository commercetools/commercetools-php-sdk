<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request;

use Commercetools\Core\Model\ProductType\ProductType;
use Commercetools\Core\Model\Review\Review;
use Commercetools\Core\Model\Type\Type;
use Commercetools\Core\Request\ProductTypes\ProductTypeByKeyGetRequest;
use Commercetools\Core\Request\Reviews\ReviewByKeyGetRequest;
use Commercetools\Core\Request\Types\TypeByKeyGetRequest;
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
            ProductTypeByKeyGetRequest::class => [
                ProductTypeByKeyGetRequest::class,
                ProductType::class,
            ],
            ReviewByKeyGetRequest::class => [
                ReviewByKeyGetRequest::class,
                Review::class,
            ],
            TypeByKeyGetRequest::class => [
                TypeByKeyGetRequest::class,
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
