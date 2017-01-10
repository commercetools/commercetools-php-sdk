<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 * @created: 10.02.15, 10:29
 */

namespace Commercetools\Core\Request;

use Commercetools\Core\Model\Common\Collection;
use Commercetools\Core\Response\PagedQueryResponse;
use GuzzleHttp\Message\Response;
use Commercetools\Core\AccessorTrait;
use Commercetools\Core\Client\HttpMethod;

/**
 * Class AbstractCreateRequestTest
 * @package Commercetools\Core\Request
 * @method AbstractQueryRequest getRequest($class, array $args = [])
 */
class AbstractQueryRequestTest extends \PHPUnit_Framework_TestCase
{
    use AccessorTrait;

    const ABSTRACT_QUERY_REQUEST = AbstractQueryRequest::class;

    /**
     * @return AbstractQueryRequest
     */
    protected function getQueryRequest()
    {
        $request = $this->getRequest(static::ABSTRACT_QUERY_REQUEST);

        return $request;
    }

    public function testHttpRequestMethod()
    {
        $request = $this->getQueryRequest();
        $httpRequest = $request->httpRequest();

        $this->assertSame(HttpMethod::GET, $httpRequest->getMethod());
    }

    public function testHttpRequestPath()
    {
        $request = $this->getQueryRequest();
        $httpRequest = $request->httpRequest();

        $this->assertSame('test', (string)$httpRequest->getUri());
    }

    public function testHttpRequestObject()
    {
        $request = $this->getQueryRequest();
        $httpRequest = $request->httpRequest();

        $this->assertEmpty((string)$httpRequest->getBody());
    }

    public function testWhere()
    {
        $request = $this->getQueryRequest();
        $request->where('test');
        $httpRequest = $request->httpRequest();

        $this->assertSame('test?where=test', (string)$httpRequest->getUri());
    }

    public function testExpand()
    {
        $request = $this->getQueryRequest();
        $request->expand('test');
        $httpRequest = $request->httpRequest();

        $this->assertSame('test?expand=test', (string)$httpRequest->getUri());
    }

    public function testSort()
    {
        $request = $this->getQueryRequest();
        $request->sort('test');
        $httpRequest = $request->httpRequest();

        $this->assertSame('test?sort=test', (string)$httpRequest->getUri());
    }

    public function testLimit()
    {
        $request = $this->getQueryRequest();
        $request->limit(1);
        $httpRequest = $request->httpRequest();

        $this->assertSame('test?limit=1', (string)$httpRequest->getUri());
    }

    public function testLimitMinimum()
    {
        $request = $this->getQueryRequest();
        $request->limit(-1);
        $httpRequest = $request->httpRequest();

        $this->assertSame('test?limit=0', (string)$httpRequest->getUri());
    }

    public function testLimitMaximum()
    {
        $max = PageRequestInterface::MAX_PAGE_SIZE + 1;
        $request = $this->getQueryRequest();
        $request->limit($max);
        $httpRequest = $request->httpRequest();

        $this->assertSame('test?limit=' . PageRequestInterface::MAX_PAGE_SIZE, (string)$httpRequest->getUri());
    }

    public function testWithTotalTrue()
    {
        $request = $this->getQueryRequest();
        $request->withTotal(true);
        $httpRequest = $request->httpRequest();

        $this->assertSame('test?withTotal=true', (string)$httpRequest->getUri());
    }

    public function testWithTotalFalse()
    {
        $request = $this->getQueryRequest();
        $request->withTotal(false);
        $httpRequest = $request->httpRequest();

        $this->assertSame('test?withTotal=false', (string)$httpRequest->getUri());
    }

    public function testOffset()
    {
        $request = $this->getQueryRequest();
        $request->offset(1);
        $httpRequest = $request->httpRequest();

        $this->assertSame('test?offset=1', (string)$httpRequest->getUri());
    }

    public function testBuildResponse()
    {
        $mockBuilder = $this->getMockBuilder('\GuzzleHttp\Psr7\Response');
        $mockBuilder->disableOriginalConstructor();
        $guzzleResponse = $mockBuilder->getMock();

        $request = $this->getRequest(static::ABSTRACT_QUERY_REQUEST);
        $response = $request->buildResponse($guzzleResponse);

        $this->assertInstanceOf(PagedQueryResponse::class, $response);
    }

    public function testMapResult()
    {
        $request = $this->getRequest(static::ABSTRACT_QUERY_REQUEST);
        $result = $request->mapResult(
            [
                'results' => [
                    ['key' => 'value'],
                    ['key' => 'value'],
                    ['key' => 'value'],
                ]
            ]
        );
        $this->assertInstanceOf(Collection::class, $result);
        $this->assertSame(3, count($result));
    }

    public function testMapEmptyResult()
    {
        $request = $this->getRequest(static::ABSTRACT_QUERY_REQUEST);
        $result = $request->mapResult([]);
        $this->assertInstanceOf(Collection::class, $result);
    }
}
