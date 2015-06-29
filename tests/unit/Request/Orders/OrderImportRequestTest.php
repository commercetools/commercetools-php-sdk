<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Orders;


use Sphere\Core\Client\HttpMethod;
use Sphere\Core\Model\Common\Money;
use Sphere\Core\Model\Order\ImportOrder;
use Sphere\Core\RequestTestCase;

/**
 * Class OrderCreateFromCartRequestTest
 * @package Sphere\Core\Request\Orders
 */
class OrderImportRequestTest extends RequestTestCase
{
    const ORDER_IMPORT_REQUEST = '\Sphere\Core\Request\Orders\OrderImportRequest';

    public function testMapResult()
    {
        $result = $this->mapResult(OrderImportRequest::ofImportOrder(ImportOrder::of()));
        $this->assertInstanceOf('\Sphere\Core\Model\Order\Order', $result);
    }

    public function testMapEmptyResult()
    {
        $result = $this->mapEmptyResult(OrderImportRequest::ofImportOrder(ImportOrder::of()));
        $this->assertNull($result);
    }

    public function testBuildResponse()
    {
        $guzzleResponse = $this->getMock('\GuzzleHttp\Psr7\Response', [], [], '', false);
        $request = OrderImportRequest::ofImportOrder(ImportOrder::of());
        $response = $request->buildResponse($guzzleResponse);

        $this->assertInstanceOf('\Sphere\Core\Response\SingleResourceResponse', $response);
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

        $this->assertSame('/orders/import', (string)$httpRequest->getUri());
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
