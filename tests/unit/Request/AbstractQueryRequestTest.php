<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 10.02.15, 10:29
 */

namespace Sphere\Core\Request;


use GuzzleHttp\Message\Response;
use Sphere\Core\AccessorTrait;
use Sphere\Core\Client\HttpMethod;

/**
 * Class AbstractCreateRequestTest
 * @package Sphere\Core\Request
 * @method AbstractQueryRequest getRequest($class, array $args = [])
 */
class AbstractQueryRequestTest extends \PHPUnit_Framework_TestCase
{
    use AccessorTrait;

    const ABSTRACT_QUERY_REQUEST = '\Sphere\Core\Request\AbstractQueryRequest';

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

        $this->assertSame(HttpMethod::GET, $httpRequest->getHttpMethod());
    }

    public function testHttpRequestPath()
    {
        $request = $this->getQueryRequest();
        $httpRequest = $request->httpRequest();

        $this->assertSame('test', $httpRequest->getPath());
    }

    public function testHttpRequestObject()
    {
        $request = $this->getQueryRequest();
        $httpRequest = $request->httpRequest();

        $this->assertNull($httpRequest->getBody());
    }

    public function testWhere()
    {
        $request = $this->getQueryRequest();
        $request->where('test');
        $httpRequest = $request->httpRequest();

        $this->assertSame('test?where=test', $httpRequest->getPath());
    }

    public function testSort()
    {
        $request = $this->getQueryRequest();
        $request->sort('test');
        $httpRequest = $request->httpRequest();

        $this->assertSame('test?sort=test', $httpRequest->getPath());
    }

    public function testLimit()
    {
        $request = $this->getQueryRequest();
        $request->limit(1);
        $httpRequest = $request->httpRequest();

        $this->assertSame('test?limit=1', $httpRequest->getPath());
    }

    public function testOffset()
    {
        $request = $this->getQueryRequest();
        $request->offset(1);
        $httpRequest = $request->httpRequest();

        $this->assertSame('test?offset=1', $httpRequest->getPath());
    }

    public function testBuildResponse()
    {
        $guzzleResponse = $this->getMock('\GuzzleHttp\Message\Response', [], [], '', false);
        $request = $this->getRequest(static::ABSTRACT_QUERY_REQUEST);
        $response = $request->buildResponse($guzzleResponse);

        $this->assertInstanceOf('\Sphere\Core\Response\PagedQueryResponse', $response);
    }
}
