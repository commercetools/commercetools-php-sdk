<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Products;

use Commercetools\Core\Client\HttpMethod;
use Commercetools\Core\Model\Product\Facet;
use Commercetools\Core\Model\Product\Filter;
use Commercetools\Core\RequestTestCase;

class ProductProjectionSearchRequestTest extends RequestTestCase
{
    const PRODUCT_PROJECTION_SEARCH_REQUEST = '\Commercetools\Core\Request\Products\ProductProjectionSearchRequest';

    public function testFuzzy()
    {
        $request = $this->getRequest(static::PRODUCT_PROJECTION_SEARCH_REQUEST);
        $request->fuzzy(true);
        $httpRequest = $request->httpRequest();

        $this->assertSame('product-projections/search?fuzzy=true', (string)$httpRequest->getUri());
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
        $result = $this->mapQueryResult(ProductProjectionSearchRequest::of(), [], $data);
        $this->assertInstanceOf('\Commercetools\Core\Model\Product\ProductProjectionCollection', $result);
    }

    public function testMapEmptyResult()
    {
        $result = $this->mapEmptyResult(ProductProjectionSearchRequest::of());
        $this->assertInstanceOf('\Commercetools\Core\Model\Product\ProductProjectionCollection', $result);
    }

    public function testAddFilterString()
    {
        /**
         * @var ProductProjectionSearchRequest $request
         */
        $request = ProductProjectionSearchRequest::of();
        $request->addFilter(Filter::ofType('string')->setName('key')->setValue('value'));
        $httpRequest = $request->httpRequest();

        $this->assertSame('product-projections/search', (string)$httpRequest->getUri());
        $this->assertSame('filter=key%3A%22value%22', (string)$httpRequest->getBody());
    }

    public function testAddMultiFilterString()
    {
        /**
         * @var ProductProjectionSearchRequest $request
         */
        $request = ProductProjectionSearchRequest::of();
        $request->addFilter(Filter::ofType('string')->setName('key')->setValue('value'));
        $request->addFilter(Filter::ofType('string')->setName('foo')->setValue('bar'));
        $httpRequest = $request->httpRequest();

        $this->assertSame('product-projections/search', (string)$httpRequest->getUri());
        $this->assertSame('filter=foo%3A%22bar%22&filter=key%3A%22value%22', (string)$httpRequest->getBody());
    }

    public function testAddFilterInt()
    {
        /**
         * @var ProductProjectionSearchRequest $request
         */
        $request = ProductProjectionSearchRequest::of();
        $request->addFilter(Filter::ofType('int')->setName('key')->setValue(10));
        $httpRequest = $request->httpRequest();

        $this->assertSame('product-projections/search', (string)$httpRequest->getUri());
        $this->assertSame('filter=key%3A10', (string)$httpRequest->getBody());
    }

    public function testAddFilterArray()
    {
        /**
         * @var ProductProjectionSearchRequest $request
         */
        $request = ProductProjectionSearchRequest::of();
        $request->addFilter(Filter::ofType('array')->setName('key')->setValue([10, 20, 30]));
        $httpRequest = $request->httpRequest();

        $this->assertSame('product-projections/search', (string)$httpRequest->getUri());
        $this->assertSame('filter=key%3A10%2C20%2C30', (string)$httpRequest->getBody());
    }

    public function testAddFilterQuery()
    {
        /**
         * @var ProductProjectionSearchRequest $request
         */
        $request = ProductProjectionSearchRequest::of();
        $request->addFilterQuery(Filter::ofType('string')->setName('key')->setValue('value'));
        $httpRequest = $request->httpRequest();

        $this->assertSame('product-projections/search', (string)$httpRequest->getUri());
        $this->assertSame('filter.query=key%3A%22value%22', (string)$httpRequest->getBody());
    }

    public function testAddFilterQueryFacet()
    {
        /**
         * @var ProductProjectionSearchRequest $request
         */
        $request = ProductProjectionSearchRequest::of();
        $request->addFilterQuery(Filter::ofType('string')->setName('key')->setValue('value'));
        $request->addFacet(Facet::of('string')->setName('key')->setValue('value'));
        $httpRequest = $request->httpRequest();

        $this->assertSame('product-projections/search', (string)$httpRequest->getUri());
        $this->assertSame('facet=key%3A%22value%22&filter.query=key%3A%22value%22', (string)$httpRequest->getBody());
    }

    public function testAddMultiFilterQuery()
    {
        /**
         * @var ProductProjectionSearchRequest $request
         */
        $request = ProductProjectionSearchRequest::of();
        $request->addFilterQuery(Filter::ofType('string')->setName('key')->setValue('value'));
        $request->addFilterQuery(Filter::ofType('string')->setName('foo')->setValue('bar'));
        $httpRequest = $request->httpRequest();

        $this->assertSame('product-projections/search', (string)$httpRequest->getUri());
        $this->assertSame(
            'filter.query=foo%3A%22bar%22&filter.query=key%3A%22value%22',
            (string)$httpRequest->getBody()
        );
    }

    public function testAddFilterFacets()
    {
        /**
         * @var ProductProjectionSearchRequest $request
         */
        $request = ProductProjectionSearchRequest::of();
        $request->addFilterFacets(Filter::ofType('string')->setName('key')->setValue('value'));
        $httpRequest = $request->httpRequest();

        $this->assertSame('product-projections/search', (string)$httpRequest->getUri());
        $this->assertSame('filter.facets=key%3A%22value%22', (string)$httpRequest->getBody());
    }

    public function testAddMultiFilterFacets()
    {
        /**
         * @var ProductProjectionSearchRequest $request
         */
        $request = ProductProjectionSearchRequest::of();
        $request->addFilterFacets(Filter::ofType('string')->setName('key')->setValue('value'));
        $request->addFilterFacets(Filter::ofType('string')->setName('foo')->setValue('bar'));
        $httpRequest = $request->httpRequest();

        $this->assertSame('product-projections/search', (string)$httpRequest->getUri());
        $this->assertSame(
            'filter.facets=foo%3A%22bar%22&filter.facets=key%3A%22value%22',
            (string)$httpRequest->getBody()
        );
    }

    public function testAddFacet()
    {
        /**
         * @var ProductProjectionSearchRequest $request
         */
        $request = ProductProjectionSearchRequest::of();
        $request->addFacet(Facet::ofType('string')->setName('key')->setValue('value'));
        $httpRequest = $request->httpRequest();

        $this->assertSame('product-projections/search', (string)$httpRequest->getUri());
        $this->assertSame('facet=key%3A%22value%22', (string)$httpRequest->getBody());
    }

    public function testAddMultiFacet()
    {
        /**
         * @var ProductProjectionSearchRequest $request
         */
        $request = ProductProjectionSearchRequest::of();
        $request->addFacet(Facet::ofType('string')->setName('key')->setValue('value'));
        $request->addFacet(Facet::ofType('string')->setName('foo')->setValue('bar'));
        $httpRequest = $request->httpRequest();

        $this->assertSame('product-projections/search', (string)$httpRequest->getUri());
        $this->assertSame('facet=foo%3A%22bar%22&facet=key%3A%22value%22', (string)$httpRequest->getBody());
    }

    public function testHttpRequestMethod()
    {
        $request = ProductProjectionSearchRequest::of();
        $httpRequest = $request->httpRequest();

        $this->assertSame(HttpMethod::POST, $httpRequest->getMethod());
    }

    public function testHttpRequestPath()
    {
        $request = ProductProjectionSearchRequest::of();
        $httpRequest = $request->httpRequest();

        $this->assertSame('product-projections/search', (string)$httpRequest->getUri());
    }

    public function testHttpRequestObject()
    {
        $request = ProductProjectionSearchRequest::of();
        $httpRequest = $request->httpRequest();

        $this->assertEmpty((string)$httpRequest->getBody());
    }

    public function testBuildResponse()
    {
        $guzzleResponse = $this->getMock('\GuzzleHttp\Psr7\Response', [], [], '', false);
        $request = ProductProjectionSearchRequest::of();
        $response = $request->buildResponse($guzzleResponse);

        $this->assertInstanceOf('\Commercetools\Core\Response\PagedQueryResponse', $response);
    }
}
