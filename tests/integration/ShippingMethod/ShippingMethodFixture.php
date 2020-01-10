<?php

namespace Commercetools\Core\IntegrationTests\ShippingMethod;

use Commercetools\Core\Client\ApiClient;
use Commercetools\Core\Helper\Uuid;
use Commercetools\Core\IntegrationTests\ResourceFixture;
use Commercetools\Core\IntegrationTests\TaxCategory\TaxCategoryFixture;
use Commercetools\Core\IntegrationTests\Zone\ZoneFixture;
use Commercetools\Core\Model\Common\LocalizedString;
use Commercetools\Core\Model\Common\Money;
use Commercetools\Core\Model\ShippingMethod\ShippingMethod;
use Commercetools\Core\Model\ShippingMethod\ShippingMethodDraft;
use Commercetools\Core\Model\ShippingMethod\ShippingRate;
use Commercetools\Core\Model\ShippingMethod\ShippingRateCollection;
use Commercetools\Core\Model\ShippingMethod\ZoneRate;
use Commercetools\Core\Model\ShippingMethod\ZoneRateCollection;
use Commercetools\Core\Model\TaxCategory\TaxCategory;
use Commercetools\Core\Model\TaxCategory\TaxCategoryDraft;
use Commercetools\Core\Model\TaxCategory\TaxCategoryReference;
use Commercetools\Core\Model\Zone\Zone;
use Commercetools\Core\Model\Zone\ZoneReference;
use Commercetools\Core\Request\ShippingMethods\ShippingMethodCreateRequest;
use Commercetools\Core\Request\ShippingMethods\ShippingMethodDeleteRequest;

class ShippingMethodFixture extends ResourceFixture
{
    const CREATE_REQUEST_TYPE = ShippingMethodCreateRequest::class;
    const DELETE_REQUEST_TYPE = ShippingMethodDeleteRequest::class;
    const RAND_MAX = 10000;

    final public static function uniqueShippingMethodString()
    {
        return 'test-' . Uuid::uuidv4();
    }

    final public static function defaultShippingMethodDraftFunction($taxCategoryReference, $zoneReference)
    {
        $uniqueShippingMethodString = self::uniqueShippingMethodString();
        $draft = ShippingMethodDraft::ofNameTaxCategoryZoneRateAndDefault(
            'test-' . $uniqueShippingMethodString . '-name',
            $taxCategoryReference,
            ZoneRateCollection::of()->add(
                ZoneRate::of()->setZone($zoneReference)
                    ->setShippingRates(
                        ShippingRateCollection::of()->add(
                            ShippingRate::of()->setPrice(Money::ofCurrencyAndAmount('EUR', 100))
                        )
                    )
            ),
            false
        );

        return $draft;
    }

    final public static function defaultShippingMethodDraftBuilderFunction(ShippingMethodDraft $draft)
    {
        return $draft;
    }

    final public static function defaultShippingMethodCreateFunction(ApiClient $client, ShippingMethodDraft $draft)
    {
        return parent::defaultCreateFunction($client, self::CREATE_REQUEST_TYPE, $draft);
    }

    final public static function defaultShippingMethodDeleteFunction(ApiClient $client, ShippingMethod $resource)
    {
        return parent::defaultDeleteFunction($client, self::DELETE_REQUEST_TYPE, $resource);
    }

    final public static function withUpdateableDraftShippingMethod(
        ApiClient $client,
        callable $draftBuilderFunction,
        callable $assertFunction,
        callable $createFunction = null,
        callable $deleteFunction = null,
        callable $draftFunction = null
    ) {
        TaxCategoryFixture::withTaxCategory(
            $client,
            function (TaxCategory $taxCategory) use (
                $client,
                $draftBuilderFunction,
                $assertFunction,
                $createFunction,
                $deleteFunction,
                $draftFunction
            ) {
                ZoneFixture::withZone(
                    $client,
                    function (Zone $zone) use (
                        $client,
                        $taxCategory,
                        $draftBuilderFunction,
                        $assertFunction,
                        $createFunction,
                        $deleteFunction,
                        $draftFunction
                    ) {
                        $taxCategoryReference = TaxCategoryReference::ofId($taxCategory->getId());
                        $zoneReference = ZoneReference::ofId($zone->getId());
                        if ($draftFunction == null) {
                            $draftFunction = function () use ($taxCategoryReference, $zoneReference) {
                                return call_user_func(
                                    [__CLASS__, 'defaultShippingMethodDraftFunction'],
                                    $taxCategoryReference,
                                    $zoneReference
                                );
                            };
                        } else {
                            $draftFunction = function () use ($taxCategoryReference, $zoneReference, $draftFunction) {
                                return call_user_func($draftFunction, $taxCategoryReference, $zoneReference);
                            };
                        }
                        if ($createFunction == null) {
                            $createFunction = [__CLASS__, 'defaultShippingMethodCreateFunction'];
                        }
                        if ($deleteFunction == null) {
                            $deleteFunction = [__CLASS__, 'defaultShippingMethodDeleteFunction'];
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
                );
            }
        );
    }

    final public static function withDraftShippingMethod(
        ApiClient $client,
        callable $draftBuilderFunction,
        callable $assertFunction,
        callable $createFunction = null,
        callable $deleteFunction = null,
        callable $draftFunction = null
    ) {
        TaxCategoryFixture::withTaxCategory(
            $client,
            function (TaxCategory $taxCategory) use (
                $client,
                $draftBuilderFunction,
                $assertFunction,
                $createFunction,
                $deleteFunction,
                $draftFunction
            ) {
                ZoneFixture::withZone(
                    $client,
                    function (Zone $zone) use (
                        $client,
                        $taxCategory,
                        $draftBuilderFunction,
                        $assertFunction,
                        $createFunction,
                        $deleteFunction,
                        $draftFunction
                    ) {
                        $taxCategoryReference = TaxCategoryReference::ofId($taxCategory->getId());
                        $zoneReference = ZoneReference::ofId($zone->getId());
                        if ($draftFunction == null) {
                            $draftFunction = function () use ($taxCategoryReference, $zoneReference) {
                                return call_user_func(
                                    [__CLASS__, 'defaultShippingMethodDraftFunction'],
                                    $taxCategoryReference,
                                    $zoneReference
                                );
                            };
                        } else {
                            $draftFunction = function () use ($taxCategoryReference, $zoneReference, $draftFunction) {
                                return call_user_func($draftFunction, $taxCategoryReference, $zoneReference);
                            };
                        }
                        if ($createFunction == null) {
                            $createFunction = [__CLASS__, 'defaultShippingMethodCreateFunction'];
                        }
                        if ($deleteFunction == null) {
                            $deleteFunction = [__CLASS__, 'defaultShippingMethodDeleteFunction'];
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
                );
            }
        );
    }

    final public static function withShippingMethod(
        ApiClient $client,
        callable $assertFunction,
        callable $createFunction = null,
        callable $deleteFunction = null,
        callable $draftFunction = null
    ) {
        self::withDraftShippingMethod(
            $client,
            [__CLASS__, 'defaultShippingMethodDraftBuilderFunction'],
            $assertFunction,
            $createFunction,
            $deleteFunction,
            $draftFunction
        );
    }

    final public static function withUpdateableShippingMethod(
        ApiClient $client,
        callable $assertFunction,
        callable $createFunction = null,
        callable $deleteFunction = null,
        callable $draftFunction = null
    ) {
        self::withUpdateableDraftShippingMethod(
            $client,
            [__CLASS__, 'defaultShippingMethodDraftBuilderFunction'],
            $assertFunction,
            $createFunction,
            $deleteFunction,
            $draftFunction
        );
    }
}
