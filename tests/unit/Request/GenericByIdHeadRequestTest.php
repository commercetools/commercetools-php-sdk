<?php

namespace Commercetools\Core\Request;

use Commercetools\Core\Builder\Request\RequestBuilder;
use Commercetools\Core\Model\Product\Product;
use Commercetools\Core\Request\Products\ProductByIdHeadRequest;
use Commercetools\Core\RequestTestCase;

class GenericByIdHeadRequestTest extends RequestTestCase
{
    /**
     * @param $className
     * @param array $args
     * @return AbstractApiRequest
     */
    protected function getRequest($className, array $args = [])
    {
        $request = call_user_func_array($className . '::ofId', $args);

        return $request;
    }

    public function mapResultProvider()
    {
        return [
            ProductByIdHeadRequest::class => [
                ProductByIdHeadRequest::class,
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
        $result = $this->mapResult($requestClass, ['id']);
        $this->assertInstanceOf($resultClass, $result);
    }

    /**
     * @dataProvider mapResultProvider
     * @param $requestClass
     * @param $resultClass
     */
    public function testMapEmptyResult($requestClass, $resultClass)
    {
        $result = $this->mapEmptyResult($requestClass, ['id']);
        $this->assertNull($result);
    }

    /**
     * @dataProvider mapResultProvider
     * @param $requestClass
     * @param $resultClass
     */
    public function testBuilder($requestClass, $resultClass)
    {
        $class = new \ReflectionClass($requestClass);
        $domain = lcfirst(basename(dirname($class->getFileName())));

        $builder = RequestBuilder::of();

        $domainBuilder = $builder->$domain();
        $request = $domainBuilder->getByIdHead('');
        $this->assertInstanceOf($requestClass, $request);
    }
}
