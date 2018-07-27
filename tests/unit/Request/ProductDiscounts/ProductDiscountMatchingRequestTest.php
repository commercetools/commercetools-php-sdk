<?php
/**
 */

namespace Commercetools\Core\Request\ProductDiscounts;

use Commercetools\Core\Client\HttpMethod;
use Commercetools\Core\Model\Common\Money;
use Commercetools\Core\Model\Common\Price;
use Commercetools\Core\RequestTestCase;

class ProductDiscountMatchingRequestTest extends RequestTestCase
{
    const PRODUCT_DISCOUNT_MATCHING_REQUEST = ProductDiscountCreateRequest::class;

    public function testHttpRequestMethod()
    {
        $request = ProductDiscountMatchingRequest::ofProductIdVariantIdAndPrice(
            '123',
            '1',
            Price::ofMoney(Money::ofCurrencyAndAmount('EUR', 100))
        );
        $httpRequest = $request->httpRequest();

        $this->assertSame(HttpMethod::POST, $httpRequest->getMethod());
    }

    public function testHttpRequestPath()
    {
        $request = ProductDiscountMatchingRequest::ofProductIdVariantIdAndPrice(
            '123',
            '1',
            Price::ofMoney(Money::ofCurrencyAndAmount('EUR', 100))
        );
        $httpRequest = $request->httpRequest();

        $this->assertSame('product-discounts/matching', (string)$httpRequest->getUri());
    }

    public function testHttpRequestObject()
    {
        $request = ProductDiscountMatchingRequest::ofProductIdVariantIdAndPrice(
            '123',
            '1',
            Price::ofMoney(Money::ofCurrencyAndAmount('EUR', 100))
        );
        $httpRequest = $request->httpRequest();

        $this->assertJsonStringEqualsJsonString(
            json_encode([
                'productId' => '123',
                'variantId' => '1',
                'price' => [
                    'value' => [
                        'currencyCode' => 'EUR',
                        'centAmount' => 100
                    ]
                ],
                'staged' => false
            ]),
            (string)$httpRequest->getBody()
        );
    }

    public function testHttpRequestObjectWithStaged()
    {
        $request = ProductDiscountMatchingRequest::ofProductIdVariantIdAndPrice(
            '123',
            '1',
            Price::ofMoney(Money::ofCurrencyAndAmount('EUR', 100))
        );
        $request->setStaged(true);
        $httpRequest = $request->httpRequest();

        $this->assertJsonStringEqualsJsonString(
            json_encode([
                'productId' => '123',
                'variantId' => '1',
                'price' => [
                    'value' => [
                        'currencyCode' => 'EUR',
                        'centAmount' => 100
                    ]
                ],
                'staged' => true
            ]),
            (string)$httpRequest->getBody()
        );
    }
}
