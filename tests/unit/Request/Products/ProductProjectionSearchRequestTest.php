<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Products;

use Commercetools\Core\Client\HttpMethod;
use Commercetools\Core\Model\Product\ProductProjectionCollection;
use Commercetools\Core\Model\Product\Search\Facet;
use Commercetools\Core\Model\Product\Search\Filter;
use Commercetools\Core\Model\Product\Search\FilterSubtreeCollection;
use Commercetools\Core\RequestTestCase;
use Commercetools\Core\Response\PagedQueryResponse;
use GuzzleHttp\Psr7\Response;

class ProductProjectionSearchRequestTest extends RequestTestCase
{
    const PRODUCT_PROJECTION_SEARCH_REQUEST = ProductProjectionSearchRequest::class;

    public function testFuzzy()
    {
        /**
         * @var ProductProjectionSearchRequest $request
         */
        $request = $this->getRequest(static::PRODUCT_PROJECTION_SEARCH_REQUEST);
        $request->fuzzy(true);
        $httpRequest = $request->httpRequest();

        $this->assertSame('product-projections/search', (string)$httpRequest->getUri());
        $this->assertStringContainsString('fuzzy=true', (string)$httpRequest->getBody());
    }

    public function testMarkMatchingVariant()
    {
        /**
         * @var ProductProjectionSearchRequest $request
         */
        $request = $this->getRequest(static::PRODUCT_PROJECTION_SEARCH_REQUEST);
        $request->markMatchingVariants(true);
        $httpRequest = $request->httpRequest();

        $this->assertSame('product-projections/search', (string)$httpRequest->getUri());
        $this->assertSame('markMatchingVariants=true', (string)$httpRequest->getBody());
    }

    public function testDontMarkMatchingVariant()
    {
        /**
         * @var ProductProjectionSearchRequest $request
         */
        $request = $this->getRequest(static::PRODUCT_PROJECTION_SEARCH_REQUEST);
        $request->markMatchingVariants(false);
        $httpRequest = $request->httpRequest();

        $this->assertSame('product-projections/search', (string)$httpRequest->getUri());
        $this->assertSame('markMatchingVariants=false', (string)$httpRequest->getBody());
    }

    public function testMarkMatchingVariantDefault()
    {
        /**
         * @var ProductProjectionSearchRequest $request
         */
        $request = $this->getRequest(static::PRODUCT_PROJECTION_SEARCH_REQUEST);
        $httpRequest = $request->httpRequest();

        $this->assertSame('product-projections/search', (string)$httpRequest->getUri());
        $this->assertSame('markMatchingVariants=false', (string)$httpRequest->getBody());
    }

    public function fuzzyProvider()
    {
        return [
            [true, 'fuzzy=true'],
            [false, 'fuzzy=false'],
            [-1, 'fuzzy=false'],
            [ 0, 'fuzzy=false'],
            [ 1, 'fuzzy=true&fuzzyLevel=1'],
            [ 2, 'fuzzy=true&fuzzyLevel=2'],
            [ 3, 'fuzzy=true&fuzzyLevel=2'],
            ['1', 'fuzzy=true&fuzzyLevel=1'],
        ];
    }
    /**
     * @dataProvider  fuzzyProvider
     */
    public function testFuzzyLevel($level, $expected)
    {
        /**
         * @var ProductProjectionSearchRequest $request
         */
        $request = $this->getRequest(static::PRODUCT_PROJECTION_SEARCH_REQUEST);
        $request->fuzzy($level);
        $httpRequest = $request->httpRequest();

        $this->assertSame('product-projections/search', (string)$httpRequest->getUri());
        $this->assertStringContainsString($expected, (string)$httpRequest->getBody());
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
        $this->assertInstanceOf(ProductProjectionCollection::class, $result);
    }

    public function testMapEmptyResult()
    {
        $result = $this->mapEmptyResult(ProductProjectionSearchRequest::of());
        $this->assertInstanceOf(ProductProjectionCollection::class, $result);
    }

    public function testAddFilterString()
    {
        /**
         * @var ProductProjectionSearchRequest $request
         */
        $request = ProductProjectionSearchRequest::of();
        $request->addFilter(Filter::ofName('key')->setValue('value'));
        $httpRequest = $request->httpRequest();

        $this->assertSame('product-projections/search', (string)$httpRequest->getUri());
        $this->assertStringContainsString('filter=key%3A%22value%22', (string)$httpRequest->getBody());
    }

    public function testAddMultiFilterString()
    {
        /**
         * @var ProductProjectionSearchRequest $request
         */
        $request = ProductProjectionSearchRequest::of();
        $request->addFilter(Filter::ofName('key')->setValue('value'));
        $request->addFilter(Filter::ofName('foo')->setValue('bar'));
        $httpRequest = $request->httpRequest();

        $this->assertSame('product-projections/search', (string)$httpRequest->getUri());
        $this->assertStringContainsString('filter=foo%3A%22bar%22&filter=key%3A%22value%22', (string)$httpRequest->getBody());
    }

    public function testAddFilterInt()
    {
        /**
         * @var ProductProjectionSearchRequest $request
         */
        $request = ProductProjectionSearchRequest::of();
        $request->addFilter(Filter::ofName('key')->setValue(10));
        $httpRequest = $request->httpRequest();

        $this->assertSame('product-projections/search', (string)$httpRequest->getUri());
        $this->assertStringContainsString('filter=key%3A10', (string)$httpRequest->getBody());
    }

    public function testAddFilterArray()
    {
        /**
         * @var ProductProjectionSearchRequest $request
         */
        $request = ProductProjectionSearchRequest::of();
        $request->addFilter(Filter::ofName('key')->setValue([10, 20, 30]));
        $httpRequest = $request->httpRequest();

        $this->assertSame('product-projections/search', (string)$httpRequest->getUri());
        $this->assertStringContainsString('filter=key%3A10%2C20%2C30', (string)$httpRequest->getBody());
    }

    public function testAddFilterQuery()
    {
        /**
         * @var ProductProjectionSearchRequest $request
         */
        $request = ProductProjectionSearchRequest::of();
        $request->addFilterQuery(Filter::ofName('key')->setValue('value'));
        $httpRequest = $request->httpRequest();

        $this->assertSame('product-projections/search', (string)$httpRequest->getUri());
        $this->assertStringContainsString('filter.query=key%3A%22value%22', (string)$httpRequest->getBody());
    }

    public function testAddFilterQueryFacet()
    {
        /**
         * @var ProductProjectionSearchRequest $request
         */
        $request = ProductProjectionSearchRequest::of();
        $request->addFilterQuery(Filter::ofName('key')->setValue('value'));
        $request->addFacet(Facet::ofName('key')->setValue('value'));
        $httpRequest = $request->httpRequest();

        $this->assertSame('product-projections/search', (string)$httpRequest->getUri());
        $this->assertStringContainsString('facet=key%3A%22value%22&filter.query=key%3A%22value%22', (string)$httpRequest->getBody());
    }

    public function testAddMultiFilterQuery()
    {
        /**
         * @var ProductProjectionSearchRequest $request
         */
        $request = ProductProjectionSearchRequest::of();
        $request->addFilterQuery(Filter::ofName('key')->setValue('value'));
        $request->addFilterQuery(Filter::ofName('foo')->setValue('bar'));
        $httpRequest = $request->httpRequest();

        $this->assertSame('product-projections/search', (string)$httpRequest->getUri());
        $this->assertStringContainsString(
            'filter.query=foo%3A%22bar%22&filter.query=key%3A%22value%22',
            (string)$httpRequest->getBody()
        );
    }

    public function testSubtreeFilterQuery()
    {
        /**
         * @var ProductProjectionSearchRequest $request
         */
        $request = ProductProjectionSearchRequest::of();
        $request->addFilterQuery(Filter::ofName('key')->setValue(FilterSubtreeCollection::ofIds(["abc-123", "cde-456"])));
        $httpRequest = $request->httpRequest();

        $this->assertSame('product-projections/search', (string)$httpRequest->getUri());
        $this->assertStringContainsString(
            'filter.query=key:subtree("abc-123"),subtree("cde-456")',
            urldecode((string)$httpRequest->getBody())
        );
    }

    public function testSubtreeFilterQueryString()
    {
        /**
         * @var ProductProjectionSearchRequest $request
         */
        $request = ProductProjectionSearchRequest::of();
        $request->addParam("filter.query", 'key:subtree("abc-123"),subtree("cde-456")');
        $httpRequest = $request->httpRequest();

        $this->assertSame('product-projections/search', (string)$httpRequest->getUri());
        $this->assertStringContainsString(
            'filter.query=key:subtree("abc-123"),subtree("cde-456")',
            urldecode((string)$httpRequest->getBody())
        );
    }

    public function testAddFilterFacets()
    {
        /**
         * @var ProductProjectionSearchRequest $request
         */
        $request = ProductProjectionSearchRequest::of();
        $request->addFilterFacets(Filter::ofName('key')->setValue('value'));
        $httpRequest = $request->httpRequest();

        $this->assertSame('product-projections/search', (string)$httpRequest->getUri());
        $this->assertStringContainsString('filter.facets=key%3A%22value%22', (string)$httpRequest->getBody());
    }

    public function testAddMultiFilterFacets()
    {
        /**
         * @var ProductProjectionSearchRequest $request
         */
        $request = ProductProjectionSearchRequest::of();
        $request->addFilterFacets(Filter::ofName('key')->setValue('value'));
        $request->addFilterFacets(Filter::ofName('foo')->setValue('bar'));
        $httpRequest = $request->httpRequest();

        $this->assertSame('product-projections/search', (string)$httpRequest->getUri());
        $this->assertStringContainsString(
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
        $request->addFacet(Facet::ofName('key')->setValue('value'));
        $httpRequest = $request->httpRequest();

        $this->assertSame('product-projections/search', (string)$httpRequest->getUri());
        $this->assertStringContainsString('facet=key%3A%22value%22', (string)$httpRequest->getBody());
    }

    public function testAddMultiFacet()
    {
        /**
         * @var ProductProjectionSearchRequest $request
         */
        $request = ProductProjectionSearchRequest::of();
        $request->addFacet(Facet::ofName('key')->setValue('value'));
        $request->addFacet(Facet::ofName('foo')->setValue('bar'));
        $httpRequest = $request->httpRequest();

        $this->assertSame('product-projections/search', (string)$httpRequest->getUri());
        $this->assertStringContainsString('facet=foo%3A%22bar%22&facet=key%3A%22value%22', (string)$httpRequest->getBody());
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

        $this->assertSame('markMatchingVariants=false', (string)$httpRequest->getBody());
    }

    public function testBuildResponse()
    {
        /**
         * @var Response $guzzleResponse
         */
        $mockBuilder = $this->getMockBuilder('\GuzzleHttp\Psr7\Response');
        $mockBuilder->disableOriginalConstructor();
        $guzzleResponse = $mockBuilder->getMock();

        $request = ProductProjectionSearchRequest::of();
        $response = $request->buildResponse($guzzleResponse);

        $this->assertInstanceOf(PagedQueryResponse::class, $response);
    }
}
