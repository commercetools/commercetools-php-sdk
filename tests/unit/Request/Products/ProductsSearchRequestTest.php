<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Products;


use Sphere\Core\Client\HttpMethod;
use Sphere\Core\Model\Product\Facet;
use Sphere\Core\Model\Product\Filter;
use Sphere\Core\RequestTestCase;

class ProductsSearchRequestTest extends RequestTestCase
{
    const PRODUCT_SEARCH_REQUEST = '\Sphere\Core\Request\Products\ProductsSearchRequest';

    public function testMapResult()
    {
        $data = [
            'results' => [
                ['id' => 'value'],
                ['id' => 'value'],
                ['id' => 'value'],
            ]
        ];
        $result = $this->mapQueryResult(static::PRODUCT_SEARCH_REQUEST, [], $data);
        $this->assertInstanceOf('\Sphere\Core\Model\Product\ProductProjectionCollection', $result);
    }

    public function testMapEmptyResult()
    {
        $result = $this->mapEmptyResult(static::PRODUCT_SEARCH_REQUEST);
        $this->assertInstanceOf('\Sphere\Core\Model\Product\ProductProjectionCollection', $result);
    }

    public function testAddFilterString()
    {
        /**
         * @var ProductsSearchRequest $request
         */
        $request = $this->getRequest(static::PRODUCT_SEARCH_REQUEST);
        $request->addFilter(Filter::of('string')->setName('key')->setValue('value'));
        $httpRequest = $request->httpRequest();

        $this->assertSame('product-projections/search?filter=key%3A%22value%22', $httpRequest->getPath());
    }

    public function testAddFilterInt()
    {
        /**
         * @var ProductsSearchRequest $request
         */
        $request = $this->getRequest(static::PRODUCT_SEARCH_REQUEST);
        $request->addFilter(Filter::of('int')->setName('key')->setValue(10));
        $httpRequest = $request->httpRequest();

        $this->assertSame('product-projections/search?filter=key%3A10', $httpRequest->getPath());
    }

    public function testAddFilterArray()
    {
        /**
         * @var ProductsSearchRequest $request
         */
        $request = $this->getRequest(static::PRODUCT_SEARCH_REQUEST);
        $request->addFilter(Filter::of('array')->setName('key')->setValue([10,20,30]));
        $httpRequest = $request->httpRequest();

        $this->assertSame('product-projections/search?filter=key%3A10%2C20%2C30', $httpRequest->getPath());
    }

    public function testAddFilterQuery()
    {
        /**
         * @var ProductsSearchRequest $request
         */
        $request = $this->getRequest(static::PRODUCT_SEARCH_REQUEST);
        $request->addFilterQuery(Filter::of('string')->setName('key')->setValue('value'));
        $httpRequest = $request->httpRequest();

        $this->assertSame('product-projections/search?filter.query=key%3A%22value%22', $httpRequest->getPath());
    }

    public function testAddFilterFacets()
    {
        /**
         * @var ProductsSearchRequest $request
         */
        $request = $this->getRequest(static::PRODUCT_SEARCH_REQUEST);
        $request->addFilterFacets(Filter::of('string')->setName('key')->setValue('value'));
        $httpRequest = $request->httpRequest();

        $this->assertSame('product-projections/search?filter.facets=key%3A%22value%22', $httpRequest->getPath());
    }

    public function testAddFacet()
    {
        /**
         * @var ProductsSearchRequest $request
         */
        $request = $this->getRequest(static::PRODUCT_SEARCH_REQUEST);
        $request->addFacet(Facet::of('string')->setName('key')->setValue('value'));
        $httpRequest = $request->httpRequest();

        $this->assertSame('product-projections/search?facet=key%3A%22value%22', $httpRequest->getPath());
    }

    public function testHttpRequestMethod()
    {
        $request = $this->getRequest(static::PRODUCT_SEARCH_REQUEST);
        $httpRequest = $request->httpRequest();

        $this->assertSame(HttpMethod::GET, $httpRequest->getHttpMethod());
    }

    public function testHttpRequestPath()
    {
        $request = $this->getRequest(static::PRODUCT_SEARCH_REQUEST);
        $httpRequest = $request->httpRequest();

        $this->assertSame('product-projections/search', $httpRequest->getPath());
    }

    public function testHttpRequestObject()
    {
        $request = $this->getRequest(static::PRODUCT_SEARCH_REQUEST);
        $httpRequest = $request->httpRequest();

        $this->assertNull($httpRequest->getBody());
    }

    public function testBuildResponse()
    {
        $guzzleResponse = $this->getMock('\GuzzleHttp\Message\Response', [], [], '', false);
        $request = $this->getRequest(static::PRODUCT_SEARCH_REQUEST);
        $response = $request->buildResponse($guzzleResponse);

        $this->assertInstanceOf('\Sphere\Core\Response\PagedQueryResponse', $response);
    }
}
