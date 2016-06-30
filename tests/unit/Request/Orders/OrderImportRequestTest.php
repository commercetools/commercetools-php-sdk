<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Orders;

use Commercetools\Core\Client\HttpMethod;
use Commercetools\Core\Model\Common\Money;
use Commercetools\Core\Model\Order\ImportOrder;
use Commercetools\Core\RequestTestCase;

/**
 * Class OrderCreateFromCartRequestTest
 * @package Commercetools\Core\Request\Orders
 */
class OrderImportRequestTest extends RequestTestCase
{
    const ORDER_IMPORT_REQUEST = '\Commercetools\Core\Request\Orders\OrderImportRequest';

    public function testMapResult()
    {
        $result = $this->mapResult(OrderImportRequest::ofImportOrder(ImportOrder::of()));
        $this->assertInstanceOf('\Commercetools\Core\Model\Order\Order', $result);
    }

    public function testMapEmptyResult()
    {
        $result = $this->mapEmptyResult(OrderImportRequest::ofImportOrder(ImportOrder::of()));
        $this->assertNull($result);
    }

    public function testBuildResponse()
    {
        $mockBuilder = $this->getMockBuilder('\GuzzleHttp\Psr7\Response');
        $mockBuilder->disableOriginalConstructor();
        $guzzleResponse = $mockBuilder->getMock();

        $request = OrderImportRequest::ofImportOrder(ImportOrder::of());
        $response = $request->buildResponse($guzzleResponse);

        $this->assertInstanceOf('\Commercetools\Core\Response\ResourceResponse', $response);
    }

    public function testHttpRequestMethod()
    {
        $request = OrderImportRequest::ofImportOrder(ImportOrder::of());
        $httpRequest = $request->httpRequest();

        $this->assertSame(HttpMethod::POST, $httpRequest->getMethod());
    }

    public function testHttpRequestPath()
    {
        $request = OrderImportRequest::ofImportOrder(ImportOrder::of());
        $httpRequest = $request->httpRequest();

        $this->assertSame('orders/import', (string)$httpRequest->getUri());
    }

    public function testHttpRequestObject()
    {
        /**
         * @var OrderImportRequest $request
         */
        $importOrder = ImportOrder::of()->setOrderNumber('12345678')
            ->setCustomerId('12345')
            ->setTotalPrice(Money::ofCurrencyAndAmount('EUR', 100))
        ;
        $request = OrderImportRequest::ofImportOrder($importOrder);
        $httpRequest = $request->httpRequest();

        $expectedResult = [
            'orderNumber' => '12345678',
            'customerId' => '12345',
            'totalPrice' => [
                'currencyCode' => 'EUR',
                'centAmount' => 100
            ]
        ];
        $this->assertJsonStringEqualsJsonString(json_encode($expectedResult), (string)$httpRequest->getBody());
    }
}
