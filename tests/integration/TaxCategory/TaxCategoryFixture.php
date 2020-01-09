<?php

namespace Commercetools\Core\IntegrationTests\TaxCategory;

use Commercetools\Core\Client\ApiClient;
use Commercetools\Core\Helper\Uuid;
use Commercetools\Core\IntegrationTests\ResourceFixture;
use Commercetools\Core\Model\TaxCategory\TaxCategory;
use Commercetools\Core\Model\TaxCategory\TaxCategoryDraft;
use Commercetools\Core\Model\TaxCategory\TaxRate;
use Commercetools\Core\Model\TaxCategory\TaxRateCollection;
use Commercetools\Core\Request\TaxCategories\TaxCategoryCreateRequest;
use Commercetools\Core\Request\TaxCategories\TaxCategoryDeleteRequest;

class TaxCategoryFixture extends ResourceFixture
{
    const CREATE_REQUEST_TYPE = TaxCategoryCreateRequest::class;
    const DELETE_REQUEST_TYPE = TaxCategoryDeleteRequest::class;
    const RAND_MAX = 10000;

    final public static function uniqueTaxCategoryString()
    {
        return 'test-' . Uuid::uuidv4();
    }

    final public static function defaultTaxCategoryDraftFunction()
    {
        $uniqueTaxCategoryString = self::uniqueTaxCategoryString();
        $region = "r" . (string)mt_rand(1, static::RAND_MAX);

        $draft = TaxCategoryDraft::ofNameAndRates(
            'test-' . $uniqueTaxCategoryString . '-name',
            TaxRateCollection::of()->add(
                TaxRate::of()->setName('test-' . $uniqueTaxCategoryString . '-name')
                    ->setAmount(0.2)
                    ->setIncludedInPrice(true)
                    ->setCountry('DE')
                    ->setState($region)
            )
        );

        return $draft;
    }

    final public static function defaultTaxCategoryDraftBuilderFunction(TaxCategoryDraft $draft)
    {
        return $draft;
    }

    final public static function defaultTaxCategoryCreateFunction(ApiClient $client, TaxCategoryDraft $draft)
    {
        return parent::defaultCreateFunction($client, self::CREATE_REQUEST_TYPE, $draft);
    }

    final public static function defaultTaxCategoryDeleteFunction(ApiClient $client, TaxCategory $resource)
    {
        return parent::defaultDeleteFunction($client, self::DELETE_REQUEST_TYPE, $resource);
    }

    final public static function withUpdateableDraftTaxCategory(
        ApiClient $client,
        callable $draftBuilderFunction,
        callable $assertFunction,
        callable $createFunction = null,
        callable $deleteFunction = null,
        callable $draftFunction = null
    ) {
        if ($draftFunction == null) {
            $draftFunction = [__CLASS__, 'defaultTaxCategoryDraftFunction'];
        }
        if ($createFunction == null) {
            $createFunction = [__CLASS__, 'defaultTaxCategoryCreateFunction'];
        }
        if ($deleteFunction == null) {
            $deleteFunction = [__CLASS__, 'defaultTaxCategoryDeleteFunction'];
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

    final public static function withDraftTaxCategory(
        ApiClient $client,
        callable $draftBuilderFunction,
        callable $assertFunction,
        callable $createFunction = null,
        callable $deleteFunction = null,
        callable $draftFunction = null
    ) {
        if ($draftFunction == null) {
            $draftFunction = [__CLASS__, 'defaultTaxCategoryDraftFunction'];
        }
        if ($createFunction == null) {
            $createFunction = [__CLASS__, 'defaultTaxCategoryCreateFunction'];
        }
        if ($deleteFunction == null) {
            $deleteFunction = [__CLASS__, 'defaultTaxCategoryDeleteFunction'];
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

    final public static function withTaxCategory(
        ApiClient $client,
        callable $assertFunction,
        callable $createFunction = null,
        callable $deleteFunction = null,
        callable $draftFunction = null
    ) {
        self::withDraftTaxCategory(
            $client,
            [__CLASS__, 'defaultTaxCategoryDraftBuilderFunction'],
            $assertFunction,
            $createFunction,
            $deleteFunction,
            $draftFunction
        );
    }

    final public static function withUpdateableTaxCategory(
        ApiClient $client,
        callable $assertFunction,
        callable $createFunction = null,
        callable $deleteFunction = null,
        callable $draftFunction = null
    ) {
        self::withUpdateableDraftTaxCategory(
            $client,
            [__CLASS__, 'defaultTaxCategoryDraftBuilderFunction'],
            $assertFunction,
            $createFunction,
            $deleteFunction,
            $draftFunction
        );
    }
}
