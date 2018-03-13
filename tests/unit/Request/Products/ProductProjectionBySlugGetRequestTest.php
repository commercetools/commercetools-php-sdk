<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Products;

use Commercetools\Core\Client\HttpMethod;
use Commercetools\Core\Error\InvalidArgumentException;
use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Product\ProductProjection;
use Commercetools\Core\RequestTestCase;
use Commercetools\Core\Response\ResourceResponse;

class ProductProjectionBySlugGetRequestTest extends RequestTestCase
{
    const PRODUCT_PROJECTION_BY_SLUG_GET_REQUEST =
        ProductProjectionBySlugGetRequest::class;

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
        $this->assertInstanceOf(ProductProjection::class, $result);
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

    public function testHttpRequestPathContextLanguages()
    {
        $context = $this->getContext();
        $context->setLanguages(['en', 'de']);
        $request = ProductProjectionBySlugGetRequest::ofSlugAndContext('slug', $context);
        $httpRequest = $request->httpRequest();

        $this->assertSame(
            'product-projections?limit=1&where=slug%28en%3D%22slug%22%29+or+slug%28de%3D%22slug%22%29',
            (string)$httpRequest->getUri()
        );
    }

    public function testHttpRequestPathSingleLanguage()
    {
        $request = ProductProjectionBySlugGetRequest::ofSlugAndLanguage('slug', 'en');
        $httpRequest = $request->httpRequest();

        $this->assertSame(
            'product-projections?limit=1&where=slug%28en%3D%22slug%22%29',
            (string)$httpRequest->getUri()
        );
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testHttpRequestPathSingleLanguageTypeContext()
    {
        $request = ProductProjectionBySlugGetRequest::ofSlugAndLanguage('slug', $this->getContext());
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testHttpRequestPathSingleLanguageTypeArray()
    {
        $request = ProductProjectionBySlugGetRequest::ofSlugAndLanguage('slug', ['de']);
    }

    public function testHttpRequestPathSingleLanguages()
    {
        $request = ProductProjectionBySlugGetRequest::ofSlugAndLanguages('slug', ['en']);
        $httpRequest = $request->httpRequest();

        $this->assertSame(
            'product-projections?limit=1&where=slug%28en%3D%22slug%22%29',
            (string)$httpRequest->getUri()
        );
    }

    public function testHttpRequestPathMultipleLanguages()
    {
        $request = ProductProjectionBySlugGetRequest::ofSlugAndLanguages('slug', ['en', 'de']);
        $httpRequest = $request->httpRequest();

        $this->assertSame(
            'product-projections?limit=1&where=slug%28en%3D%22slug%22%29+or+slug%28de%3D%22slug%22%29',
            (string)$httpRequest->getUri()
        );
    }

    public function testHttpRequestObject()
    {
        $request = ProductProjectionBySlugGetRequest::ofSlugAndContext('slug', $this->getContext());
        $httpRequest = $request->httpRequest();

        $this->assertEmpty((string)$httpRequest->getBody());
    }

    public function testBuildResponse()
    {
        $mockBuilder = $this->getMockBuilder('\GuzzleHttp\Psr7\Response');
        $mockBuilder->disableOriginalConstructor();
        $guzzleResponse = $mockBuilder->getMock();

        $request = ProductProjectionBySlugGetRequest::ofSlugAndContext('slug', $this->getContext());
        $response = $request->buildResponse($guzzleResponse);

        $this->assertInstanceOf(ResourceResponse::class, $response);
    }
}
