<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Products;


use Sphere\Core\Client\HttpMethod;
use Sphere\Core\Error\InvalidArgumentException;
use Sphere\Core\Model\Common\Context;
use Sphere\Core\RequestTestCase;

class ProductProjectionBySlugGetRequestTest extends RequestTestCase
{
    const PRODUCT_PROJECTION_BY_SLUG_GET_REQUEST =
        '\Sphere\Core\Request\Products\ProductProjectionBySlugGetRequest';

    protected function getContext()
    {
        $context = new Context();
        $context->setLanguages(['en']);

        return $context;
    }

    protected function getArgs()
    {
        return ['slug', $this->getContext()];
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testNoLanguages()
    {
        ProductProjectionBySlugGetRequest::ofSlugAndContext('slug', new Context());
    }

    public function testMapResult()
    {
        $data = [
            'results' => [
                ['id' => 'value'],
                ['id' => 'value'],
                ['id' => 'value'],
            ]
        ];
        $result = $this->mapQueryResult(
            ProductProjectionBySlugGetRequest::ofSlugAndContext('slug', $this->getContext()),
            [],
            $data
        );
        $this->assertInstanceOf('\Sphere\Core\Model\Product\ProductProjection', $result);
    }

    public function testMapEmptyResult()
    {
        $result = $this->mapEmptyResult(
            ProductProjectionBySlugGetRequest::ofSlugAndContext('slug', $this->getContext())
        );
        $this->assertNull($result);
    }

    public function testHttpRequestMethod()
    {
        $request = ProductProjectionBySlugGetRequest::ofSlugAndContext('slug', $this->getContext());
        $httpRequest = $request->httpRequest();

        $this->assertSame(HttpMethod::GET, $httpRequest->getMethod());
    }

    public function testHttpRequestPath()
    {
        $request = ProductProjectionBySlugGetRequest::ofSlugAndContext('slug', $this->getContext());
        $httpRequest = $request->httpRequest();

        $this->assertSame(
            'product-projections?limit=1&where=slug%28en%3D%22slug%22%29',
            (string)$httpRequest->getUri()
        );
    }

    public function testHttpRequestPathWithId()
    {
        $request = ProductProjectionBySlugGetRequest::ofSlugAndContext(
            '12345678-1234-1234-1234-123456789012',
            $this->getContext()
        );
        $httpRequest = $request->httpRequest();

        $queryUri = 'product-projections?limit=1&where=slug%28en%3D%2212345678-1234-1234-1234-123456789012%22%29+or' .
            '+id%3D%2212345678-1234-1234-1234-123456789012%22';
        $this->assertSame($queryUri, (string)$httpRequest->getUri());
    }

    public function testHttpRequestObject()
    {
        $request = ProductProjectionBySlugGetRequest::ofSlugAndContext('slug', $this->getContext());
        $httpRequest = $request->httpRequest();

        $this->assertEmpty((string)$httpRequest->getBody());
    }

    public function testBuildResponse()
    {
        $guzzleResponse = $this->getMock('\GuzzleHttp\Psr7\Response', [], [], '', false);
        $request = ProductProjectionBySlugGetRequest::ofSlugAndContext('slug', $this->getContext());
        $response = $request->buildResponse($guzzleResponse);

        $this->assertInstanceOf('\Sphere\Core\Response\SingleResourceResponse', $response);
    }
}
