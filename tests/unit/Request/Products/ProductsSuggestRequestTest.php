<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Products;

use Commercetools\Core\Client\HttpMethod;
use Commercetools\Core\Model\Common\LocalizedString;
use Commercetools\Core\Model\Product\LocalizedSearchKeywords;
use Commercetools\Core\Model\Product\SuggestionResult;
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
        $data = ["searchKeywords.en" => [["text" => "Swiss Army Knife"]]];
        /**
         * @var SuggestionResult $result
         */
        $result = $this->mapQueryResult(
            ProductsSuggestRequest::ofKeywords($this->getKeywords()),
            [],
            ["searchKeywords.en" => [["text" => "Swiss Army Knife"]]]
        );
        $this->assertInstanceOf('\Commercetools\Core\Model\Product\SuggestionResult', $result);
        $this->assertInstanceOf('\Commercetools\Core\Model\Product\LocalizedSuggestionCollection', $result->getSearchKeywords());
        $this->assertSame(["text" => "Swiss Army Knife"], $result->getSearchKeywords()->en->current()->toArray());
        $this->assertSame($data, $result->toArray());
    }

    public function testMapEmptyResult()
    {
        $result = $this->mapEmptyResult(ProductsSuggestRequest::ofKeywords($this->getKeywords()));
        $this->assertInstanceOf('\Commercetools\Core\Model\Product\SuggestionResult', $result);
        $this->assertEmpty($result->toArray());
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
        $mockBuilder = $this->getMockBuilder('\GuzzleHttp\Psr7\Response');
        $mockBuilder->disableOriginalConstructor();
        $guzzleResponse = $mockBuilder->getMock();

        $request = ProductsSuggestRequest::ofKeywords($this->getKeywords());
        $response = $request->buildResponse($guzzleResponse);

        $this->assertInstanceOf('\Commercetools\Core\Response\ResourceResponse', $response);
    }
}
