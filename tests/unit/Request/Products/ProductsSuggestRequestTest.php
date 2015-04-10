<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Products;


use Sphere\Core\Client\HttpMethod;
use Sphere\Core\Model\Common\LocalizedString;
use Sphere\Core\Model\Product\LocalizedSearchKeywords;
use Sphere\Core\RequestTestCase;

class ProductsSuggestRequestTest extends RequestTestCase
{
    const PRODUCT_SUGGEST_REQUEST = '\Sphere\Core\Request\Products\ProductsSuggestRequest';

    protected function getKeywords()
    {
        return new LocalizedString(['en' => 'search']);
    }

    public function testMapResult()
    {
        $result = $this->mapQueryResult(static::PRODUCT_SUGGEST_REQUEST, [$this->getKeywords()]);
        $this->assertInstanceOf('\Sphere\Core\Model\Product\SuggestionCollection', $result);
    }

    public function testMapEmptyResult()
    {
        $result = $this->mapEmptyResult(static::PRODUCT_SUGGEST_REQUEST, [$this->getKeywords()]);
        $this->assertInstanceOf('\Sphere\Core\Model\Product\SuggestionCollection', $result);
    }

    public function testAddKeyword()
    {
        /**
         * @var ProductsSuggestRequest $request
         */
        $request = $this->getRequest(static::PRODUCT_SUGGEST_REQUEST);
        $request->addKeyword('en', 'search');
        $httpRequest = $request->httpRequest();

        $this->assertSame('product-projections/suggest?searchKeywords.en=search', $httpRequest->getPath());
    }

    public function testAddKeywords()
    {
        /**
         * @var ProductsSuggestRequest $request
         */
        $request = $this->getRequest(static::PRODUCT_SUGGEST_REQUEST);
        $request->addKeywords($this->getKeywords());
        $httpRequest = $request->httpRequest();

        $this->assertSame('product-projections/suggest?searchKeywords.en=search', $httpRequest->getPath());
    }

    public function testSetKeywords()
    {
        /**
         * @var ProductsSuggestRequest $request
         */
        $request = $this->getRequest(static::PRODUCT_SUGGEST_REQUEST);
        $request->setSearchKeywords($this->getKeywords());
        $httpRequest = $request->httpRequest();

        $this->assertSame('product-projections/suggest?searchKeywords.en=search', $httpRequest->getPath());
    }

    public function testHttpRequestMethod()
    {
        $request = $this->getRequest(static::PRODUCT_SUGGEST_REQUEST, [$this->getKeywords()]);
        $httpRequest = $request->httpRequest();

        $this->assertSame(HttpMethod::GET, $httpRequest->getHttpMethod());
    }

    public function testHttpRequestPath()
    {
        /**
         * @var ProductsSuggestRequest
         */
        $request = $this->getRequest(static::PRODUCT_SUGGEST_REQUEST, [$this->getKeywords()]);
        $httpRequest = $request->httpRequest();

        $this->assertSame('product-projections/suggest?searchKeywords.en=search', $httpRequest->getPath());
    }

    public function testHttpRequestObject()
    {
        $request = $this->getRequest(static::PRODUCT_SUGGEST_REQUEST, [$this->getKeywords()]);
        $httpRequest = $request->httpRequest();

        $this->assertNull($httpRequest->getBody());
    }

    public function testBuildResponse()
    {
        $guzzleResponse = $this->getMock('\GuzzleHttp\Message\Response', [], [], '', false);
        $request = $this->getRequest(static::PRODUCT_SUGGEST_REQUEST, [$this->getKeywords()]);
        $response = $request->buildResponse($guzzleResponse);

        $this->assertInstanceOf('\Sphere\Core\Response\SingleResourceResponse', $response);
    }
}
