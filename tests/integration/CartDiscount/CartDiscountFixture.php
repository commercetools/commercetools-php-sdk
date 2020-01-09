<?php

namespace Commercetools\Core\IntegrationTests\CartDiscount;

use Commercetools\Core\Client\ApiClient;
use Commercetools\Core\Helper\Uuid;
use Commercetools\Core\IntegrationTests\ResourceFixture;
use Commercetools\Core\IntegrationTests\TestHelper;
use Commercetools\Core\Model\CartDiscount\AbsoluteCartDiscountValue;
use Commercetools\Core\Model\CartDiscount\CartDiscount;
use Commercetools\Core\Model\CartDiscount\CartDiscountDraft;
use Commercetools\Core\Model\CartDiscount\CartDiscountTarget;
use Commercetools\Core\Model\Common\LocalizedString;
use Commercetools\Core\Model\Common\Money;
use Commercetools\Core\Model\Common\MoneyCollection;
use Commercetools\Core\Request\CartDiscounts\CartDiscountCreateRequest;
use Commercetools\Core\Request\CartDiscounts\CartDiscountDeleteRequest;

class CartDiscountFixture extends ResourceFixture
{
    const CREATE_REQUEST_TYPE = CartDiscountCreateRequest::class;
    const DELETE_REQUEST_TYPE = CartDiscountDeleteRequest::class;
    const RAND_MAX = 10000;

    final public static function uniqueCartDiscountString()
    {
        return 'test-' . Uuid::uuidv4();
    }

    final public static function defaultCartDiscountDraftFunction()
    {
        $value = AbsoluteCartDiscountValue::of()->setMoney(
            MoneyCollection::of()->add(Money::ofCurrencyAndAmount('EUR', 100))
        );
        $uniqueCartDiscountString = self::uniqueCartDiscountString();
        $draft = CartDiscountDraft::of();
        $draft->setName(LocalizedString::ofLangAndText('en', 'test-' . $uniqueCartDiscountString . '-discount'))
            ->setValue($value)->setCartPredicate('1=1')
            ->setTarget(CartDiscountTarget::of()->setType('lineItems')->setPredicate('1=1'))
            ->setSortOrder('0.9' . trim((string)mt_rand(1, TestHelper::RAND_MAX), '0'))
            ->setIsActive(true)->setRequiresDiscountCode(false)
            ->setKey($uniqueCartDiscountString);

        return $draft;
    }

    final public static function defaultCartDiscountDraftBuilderFunction(CartDiscountDraft $draft)
    {
        return $draft;
    }

    final public static function defaultCartDiscountCreateFunction(ApiClient $client, CartDiscountDraft $draft)
    {
        return parent::defaultCreateFunction($client, self::CREATE_REQUEST_TYPE, $draft);
    }

    final public static function defaultCartDiscountDeleteFunction(ApiClient $client, CartDiscount $resource)
    {
        return parent::defaultDeleteFunction($client, self::DELETE_REQUEST_TYPE, $resource);
    }

    final public static function withUpdateableDraftCartDiscount(
        ApiClient $client,
        callable $draftBuilderFunction,
        callable $assertFunction,
        callable $createFunction = null,
        callable $deleteFunction = null,
        callable $draftFunction = null
    ) {
        if ($draftFunction == null) {
            $draftFunction = [__CLASS__, 'defaultCartDiscountDraftFunction'];
        }
        if ($createFunction == null) {
            $createFunction = [__CLASS__, 'defaultCartDiscountCreateFunction'];
        }
        if ($deleteFunction == null) {
            $deleteFunction = [__CLASS__, 'defaultCartDiscountDeleteFunction'];
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

    final public static function withDraftCartDiscount(
        ApiClient $client,
        callable $draftBuilderFunction,
        callable $assertFunction,
        callable $createFunction = null,
        callable $deleteFunction = null,
        callable $draftFunction = null
    ) {
        if ($draftFunction == null) {
            $draftFunction = [__CLASS__, 'defaultCartDiscountDraftFunction'];
        }
        if ($createFunction == null) {
            $createFunction = [__CLASS__, 'defaultCartDiscountCreateFunction'];
        }
        if ($deleteFunction == null) {
            $deleteFunction = [__CLASS__, 'defaultCartDiscountDeleteFunction'];
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

    final public static function withCartDiscount(
        ApiClient $client,
        callable $assertFunction,
        callable $createFunction = null,
        callable $deleteFunction = null,
        callable $draftFunction = null
    ) {
        self::withDraftCartDiscount(
            $client,
            [__CLASS__, 'defaultCartDiscountDraftBuilderFunction'],
            $assertFunction,
            $createFunction,
            $deleteFunction,
            $draftFunction
        );
    }

    final public static function withUpdateableCartDiscount(
        ApiClient $client,
        callable $assertFunction,
        callable $createFunction = null,
        callable $deleteFunction = null,
        callable $draftFunction = null
    ) {
        self::withUpdateableDraftCartDiscount(
            $client,
            [__CLASS__, 'defaultCartDiscountDraftBuilderFunction'],
            $assertFunction,
            $createFunction,
            $deleteFunction,
            $draftFunction
        );
    }
}
