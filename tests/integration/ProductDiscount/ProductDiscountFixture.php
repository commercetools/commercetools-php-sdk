<?php

namespace Commercetools\Core\IntegrationTests\ProductDiscount;

use Commercetools\Core\Client\ApiClient;
use Commercetools\Core\Helper\Uuid;
use Commercetools\Core\IntegrationTests\ResourceFixture;
use Commercetools\Core\Model\Common\LocalizedString;
use Commercetools\Core\Model\Common\Money;
use Commercetools\Core\Model\Common\MoneyCollection;
use Commercetools\Core\Model\ProductDiscount\ProductDiscount;
use Commercetools\Core\Model\ProductDiscount\ProductDiscountDraft;
use Commercetools\Core\Model\ProductDiscount\ProductDiscountValue;
use Commercetools\Core\Request\ProductDiscounts\ProductDiscountCreateRequest;
use Commercetools\Core\Request\ProductDiscounts\ProductDiscountDeleteRequest;

class ProductDiscountFixture extends ResourceFixture
{
    const CREATE_REQUEST_TYPE = ProductDiscountCreateRequest::class;
    const DELETE_REQUEST_TYPE = ProductDiscountDeleteRequest::class;
    const RAND_MAX = 10000;

    final public static function uniqueProductDiscountString()
    {
        return 'test-' . Uuid::uuidv4();
    }

    final public static function defaultProductDiscountDraftFunction()
    {
        $uniqueProductDiscountString = self::uniqueProductDiscountString();
        $draft = ProductDiscountDraft::ofNameDiscountPredicateOrderAndActive(
            LocalizedString::ofLangAndText('en', 'test-' . $uniqueProductDiscountString . '-name'),
            ProductDiscountValue::of()->setType('absolute')->setMoney(
                MoneyCollection::of()
                    ->add(Money::ofCurrencyAndAmount('EUR', 100))
            ),
            '1=1',
            '0.9' . trim((string)mt_rand(1, self::RAND_MAX), '0'),
            false
        );

        return $draft;
    }

    final public static function defaultProductDiscountDraftBuilderFunction(ProductDiscountDraft $draft)
    {
        return $draft;
    }

    final public static function defaultProductDiscountCreateFunction(ApiClient $client, ProductDiscountDraft $draft)
    {
        return parent::defaultCreateFunction($client, self::CREATE_REQUEST_TYPE, $draft);
    }

    final public static function defaultProductDiscountDeleteFunction(ApiClient $client, ProductDiscount $resource)
    {
        return parent::defaultDeleteFunction($client, self::DELETE_REQUEST_TYPE, $resource);
    }

    final public static function withUpdateableDraftProductDiscount(
        ApiClient $client,
        callable $draftBuilderFunction,
        callable $assertFunction,
        callable $createFunction = null,
        callable $deleteFunction = null,
        callable $draftFunction = null
    ) {
        if ($draftFunction == null) {
            $draftFunction = [__CLASS__, 'defaultProductDiscountDraftFunction'];
        }
        if ($createFunction == null) {
            $createFunction = [__CLASS__, 'defaultProductDiscountCreateFunction'];
        }
        if ($deleteFunction == null) {
            $deleteFunction = [__CLASS__, 'defaultProductDiscountDeleteFunction'];
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

    final public static function withDraftProductDiscount(
        ApiClient $client,
        callable $draftBuilderFunction,
        callable $assertFunction,
        callable $createFunction = null,
        callable $deleteFunction = null,
        callable $draftFunction = null
    ) {
        if ($draftFunction == null) {
            $draftFunction = [__CLASS__, 'defaultProductDiscountDraftFunction'];
        }
        if ($createFunction == null) {
            $createFunction = [__CLASS__, 'defaultProductDiscountCreateFunction'];
        }
        if ($deleteFunction == null) {
            $deleteFunction = [__CLASS__, 'defaultProductDiscountDeleteFunction'];
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

    final public static function withProductDiscount(
        ApiClient $client,
        callable $assertFunction,
        callable $createFunction = null,
        callable $deleteFunction = null,
        callable $draftFunction = null
    ) {
        self::withDraftProductDiscount(
            $client,
            [__CLASS__, 'defaultProductDiscountDraftBuilderFunction'],
            $assertFunction,
            $createFunction,
            $deleteFunction,
            $draftFunction
        );
    }

    final public static function withUpdateableProductDiscount(
        ApiClient $client,
        callable $assertFunction,
        callable $createFunction = null,
        callable $deleteFunction = null,
        callable $draftFunction = null
    ) {
        self::withUpdateableDraftProductDiscount(
            $client,
            [__CLASS__, 'defaultProductDiscountDraftBuilderFunction'],
            $assertFunction,
            $createFunction,
            $deleteFunction,
            $draftFunction
        );
    }
}
