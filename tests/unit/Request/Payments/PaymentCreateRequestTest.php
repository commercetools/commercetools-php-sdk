<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Payments;

use Commercetools\Core\Model\Payment\Payment;
use Commercetools\Core\Model\Payment\PaymentDraft;
use Commercetools\Core\RequestTestCase;

class PaymentCreateRequestTest extends RequestTestCase
{
    const PAYMENT_CREATE_REQUEST = PaymentCreateRequest::class;

    protected function getDraft()
    {
        return PaymentDraft::fromArray(json_decode(
            '{
                "customer": {
                    "typeId": "customer",
                    "id": "customer-1"
                },
                "externalId": "123456",
                "interfaceId": "PSP-Interface-Identifier",
                "amountPlanned": {
                    "currencyCode": "EUR",
                    "centAmount": 1000
                },
                "amountAuthorized": {
                    "currencyCode": "EUR",
                    "centAmount": 1000
                },
                "authorizedUntil": "2015-01-15T12:00",
                "amountPaid": {
                    "currencyCode": "EUR",
                    "centAmount": 1000
                },
                "amountRefunded": {
                    "currencyCode": "EUR",
                    "centAmount": 1000
                },
                "paymentMethodInfo": {
                    "paymentInterface": "Interface name",
                    "method": "CreditCard",
                    "name": {
                        "en": "Credit Card"
                    }
                },
                "custom": {
                    "typeKey": "paymentType",
                    "fields": {
                        "key": "value"
                    }
                },
                "paymentStatus": {
                    "interfaceCode": "authorized",
                    "interfaceText": "Payment is authorized",
                    "state": {
                        "typeId": "state",
                        "id": "state-1"
                    },
                    "transaction": [
                        {
                            "timestamp": "2015-01-15T12:00",
                            "type": "AUTHORIZATION",
                            "amount": {
                                "currencyCode": "EUR",
                                "centAmount": 1000
                            },
                            "interactionId": "123456"
                        }
                    ]
                },
                "interfaceInteraction": [
                    {
                        "typeId": "type-id-1234",
                        "fields": {
                            "key": "value"
                        }
                    }
                ]
            }',
            true
        ));
    }
    public function testMapResult()
    {
        $result = $this->mapResult(PaymentCreateRequest::ofDraft($this->getDraft()));
        $this->assertInstanceOf(Payment::class, $result);
    }

    public function testMapEmptyResult()
    {
        $result = $this->mapEmptyResult(PaymentCreateRequest::ofDraft($this->getDraft()));
        $this->assertNull($result);
    }
}
