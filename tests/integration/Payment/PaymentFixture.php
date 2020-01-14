<?php

namespace Commercetools\Core\IntegrationTests\Payment;

use Commercetools\Core\Client\ApiClient;
use Commercetools\Core\Helper\Uuid;
use Commercetools\Core\IntegrationTests\ResourceFixture;
use Commercetools\Core\Model\Common\Money;
use Commercetools\Core\Model\Payment\Payment;
use Commercetools\Core\Model\Payment\PaymentDraft;
use Commercetools\Core\Model\Payment\PaymentMethodInfo;
use Commercetools\Core\Request\Payments\PaymentCreateRequest;
use Commercetools\Core\Request\Payments\PaymentDeleteRequest;

class PaymentFixture extends ResourceFixture
{
    const CREATE_REQUEST_TYPE = PaymentCreateRequest::class;
    const DELETE_REQUEST_TYPE = PaymentDeleteRequest::class;

    final public static function uniquePaymentString()
    {
        return 'test-' . Uuid::uuidv4();
    }

    final public static function defaultPaymentDraftFunction()
    {
        $uniquePaymentString = self::uniquePaymentString();
        $externalId = 'test-' . $uniquePaymentString . '-payment';
        $draft = PaymentDraft::ofKeyExternalIdAmountPlannedAndPaymentMethodInfo(
            $externalId,
            $externalId,
            Money::ofCurrencyAndAmount('EUR', 100),
            PaymentMethodInfo::of()
                ->setPaymentInterface('Test')
                ->setMethod('CreditCard')
        );

        return $draft;
    }

    final public static function defaultPaymentDraftBuilderFunction(PaymentDraft $draft)
    {
        return $draft;
    }

    final public static function defaultPaymentCreateFunction(ApiClient $client, PaymentDraft $draft)
    {
        return parent::defaultCreateFunction($client, self::CREATE_REQUEST_TYPE, $draft);
    }

    final public static function defaultPaymentDeleteFunction(ApiClient $client, Payment $resource)
    {
        return parent::defaultDeleteFunction($client, self::DELETE_REQUEST_TYPE, $resource);
    }

    final public static function withUpdateableDraftPayment(
        ApiClient $client,
        callable $draftBuilderFunction,
        callable $assertFunction,
        callable $createFunction = null,
        callable $deleteFunction = null,
        callable $draftFunction = null
    ) {
        if ($draftFunction == null) {
            $draftFunction = [__CLASS__, 'defaultPaymentDraftFunction'];
        }
        if ($createFunction == null) {
            $createFunction = [__CLASS__, 'defaultPaymentCreateFunction'];
        }
        if ($deleteFunction == null) {
            $deleteFunction = [__CLASS__, 'defaultPaymentDeleteFunction'];
        }

        parent::withUpdateableDraftResource(
            $client,
            $draftBuilderFunction,
            $assertFunction,
            $createFunction,
            $deleteFunction,
            $draftFunction
        );
    }

    final public static function withDraftPayment(
        ApiClient $client,
        callable $draftBuilderFunction,
        callable $assertFunction,
        callable $createFunction = null,
        callable $deleteFunction = null,
        callable $draftFunction = null
    ) {
        if ($draftFunction == null) {
            $draftFunction = [__CLASS__, 'defaultPaymentDraftFunction'];
        }
        if ($createFunction == null) {
            $createFunction = [__CLASS__, 'defaultPaymentCreateFunction'];
        }
        if ($deleteFunction == null) {
            $deleteFunction = [__CLASS__, 'defaultPaymentDeleteFunction'];
        }

        parent::withDraftResource(
            $client,
            $draftBuilderFunction,
            $assertFunction,
            $createFunction,
            $deleteFunction,
            $draftFunction
        );
    }

    final public static function withPayment(
        ApiClient $client,
        callable $assertFunction,
        callable $createFunction = null,
        callable $deleteFunction = null,
        callable $draftFunction = null
    ) {
        self::withDraftPayment(
            $client,
            [__CLASS__, 'defaultPaymentDraftBuilderFunction'],
            $assertFunction,
            $createFunction,
            $deleteFunction,
            $draftFunction
        );
    }

    final public static function withUpdateablePayment(
        ApiClient $client,
        callable $assertFunction,
        callable $createFunction = null,
        callable $deleteFunction = null,
        callable $draftFunction = null
    ) {
        self::withUpdateableDraftPayment(
            $client,
            [__CLASS__, 'defaultPaymentDraftBuilderFunction'],
            $assertFunction,
            $createFunction,
            $deleteFunction,
            $draftFunction
        );
    }
}
