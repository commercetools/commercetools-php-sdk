<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Products;


use Commercetools\Core\Client\HttpMethod;
use Commercetools\Core\Model\Common\LocalizedString;
use Commercetools\Core\Model\Product\LocalizedSearchKeywords;
use Commercetools\Core\RequestTestCase;

class ProductsSuggestRequestTest extends RequestTestCase
{
    const PRODUCT_SUGGEST_REQUEST = '\Commercetools\Core\Request\Products\ProductsSuggestRequest';

    protected function getKeywords()
    {
        return new LocalizedString(['en' => 'search']);
    }

    public function testMapResult()
    {
        $result = $this->mapQueryResult(ProductsSuggestRequest::ofKeywords($this->getKeywords()));
        $this->assertInstanceOf('\Commercetools\Core\Model\Product\SuggestionCollection', $result);
    }

    public function testMapEmptyResult()
    {
        $result = $this->mapEmptyResult(ProductsSuggestRequest::ofKeywords($this->getKeywords()));
        $this->assertInstanceOf('\Commercetools\Core\Model\Product\SuggestionCollection', $result);
    }

    public function testAddKeyword()
    {
        $request = ProductsSuggestRequest::of();
        $request->addKeyword('en', 'search');
        $httpRequest = $request->httpRequest();

        $this->assertSame('product-projections/suggest?searchKeywords.en=search', (string)$httpRequest->getUri());
    }

    public function testAddKeywords()
    {
        $request = ProductsSuggestRequest::of();
        $request->addKeywords($this->getKeywords());
        $httpRequest = $request->httpRequest();

        $this->assertSame('product-projections/suggest?searchKeywords.en=search', (string)$httpRequest->getUri());
    }

    public function testSetKeywords()
    {
        $request = ProductsSuggestRequest::of();
        $request->setSearchKeywords($this->getKeywords());
        $httpRequest = $request->httpRequest();

        $this->assertSame('product-projections/suggest?searchKeywords.en=search', (string)$httpRequest->getUri());
    }

    public function testHttpRequestMethod()
    {
        $request = ProductsSuggestRequest::ofKeywords($this->getKeywords());
        $httpRequest = $request->httpRequest();

        $this->assertSame(HttpMethod::GET, $httpRequest->getMethod());
    }

    public function testHttpRequestPath()
    {
        $request = ProductsSuggestRequest::ofKeywords($this->getKeywords());
        $httpRequest = $request->httpRequest();

        $this->assertSame('product-projections/suggest?searchKeywords.en=search', (string)$httpRequest->getUri());
    }

    public function testHttpRequestObject()
    {
        $request = ProductsSuggestRequest::ofKeywords($this->getKeywords());
        $httpRequest = $request->httpRequest();

        $this->assertEmpty((string)$httpRequest->getBody());
    }

    public function testBuildResponse()
    {
        $guzzleResponse = $this->getMock('\GuzzleHttp\Psr7\Response', [], [], '', false);
        $request = ProductsSuggestRequest::ofKeywords($this->getKeywords());
        $response = $request->buildResponse($guzzleResponse);

        $this->assertInstanceOf('\Commercetools\Core\Response\ResourceResponse', $response);
    }
}
