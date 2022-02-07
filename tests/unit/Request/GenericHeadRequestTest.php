<?php

namespace Commercetools\Core\Request;

use Commercetools\Core\Builder\Request\RequestBuilder;
use Commercetools\Core\Model\Product\Product;
use Commercetools\Core\Request\Products\ProductHeadRequest;
use Commercetools\Core\RequestTestCase;

class GenericHeadRequestTest extends RequestTestCase
{
    /**
     * @param $className
     * @param array $args
     * @return AbstractApiRequest
     */
    protected function getRequest($className, array $args = [])
    {
        $request = call_user_func_array($className . '::of', $args);

        return $request;
    }

    public function mapResultProvider()
    {
        return [
            ProductHeadRequest::class => [
                ProductHeadRequest::class,
                Product::class,
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
        $result = $this->mapResult($requestClass);
        $this->assertInstanceOf($resultClass, $result);
    }

    /**
     * @dataProvider mapResultProvider
     * @param $requestClass
     */
    public function testMapEmptyResult($requestClass)
    {
        $result = $this->mapEmptyResult($requestClass);
        $this->assertNull($result);
    }

    /**
     * @dataProvider mapResultProvider
     * @param $requestClass
     */
    public function testBuilder($requestClass)
    {
        $class = new \ReflectionClass($requestClass);
        $domain = lcfirst(basename(dirname($class->getFileName())));

        $builder = RequestBuilder::of();

        $domainBuilder = $builder->$domain();
        $request = $domainBuilder->head('');
        $this->assertInstanceOf($requestClass, $request);
    }
}
