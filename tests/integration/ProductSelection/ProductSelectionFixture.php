<?php

namespace Commercetools\Core\IntegrationTests\ProductSelection;

use Commercetools\Core\Helper\Uuid;
use Commercetools\Core\IntegrationTests\ResourceFixture;
use Commercetools\Core\Client\ApiClient;
use Commercetools\Core\Model\Common\LocalizedString;
use Commercetools\Core\Model\ProductSelection\ProductSelection;
use Commercetools\Core\Model\ProductSelection\ProductSelectionDraft;
use Commercetools\Core\Request\ProductSelections\ProductSelectionCreateRequest;
use Commercetools\Core\Request\ProductSelections\ProductSelectionDeleteRequest;

class ProductSelectionFixture extends ResourceFixture
{
    const CREATE_REQUEST_TYPE = ProductSelectionCreateRequest::class;
    const DELETE_REQUEST_TYPE = ProductSelectionDeleteRequest::class;
    const RAND_MAX = 10000;

    final public static function uniqueProductSelectionString()
    {
        return 'test-' . Uuid::uuidv4();
    }

    final public static function defaultProductSelectionDraftFunction()
    {
        $uniqueProductSelectionString = self::uniqueProductSelectionString();
        $draft = ProductSelectionDraft::of()->setKey($uniqueProductSelectionString)->setName(
            LocalizedString::ofLangAndText('en', 'test-' . $uniqueProductSelectionString . '-name')
        );

        return $draft;
    }

    final public static function defaultProductSelectionDraftBuilderFunction(ProductSelectionDraft $draft)
    {
        return $draft;
    }

    final public static function defaultProductSelectionCreateFunction(ApiClient $client, ProductSelectionDraft $draft)
    {
        return parent::defaultCreateFunction($client, self::CREATE_REQUEST_TYPE, $draft);
    }

    final public static function defaultProductSelectionDeleteFunction(ApiClient $client, ProductSelection $resource)
    {
        return parent::defaultDeleteFunction($client, self::DELETE_REQUEST_TYPE, $resource);
    }

    final public static function withUpdateableDraftProductSelection(
        ApiClient $client,
        callable $draftBuilderFunction,
        callable $assertFunction,
        callable $createFunction = null,
        callable $deleteFunction = null,
        callable $draftFunction = null
    ) {
        if ($draftFunction == null) {
            $draftFunction = [__CLASS__, 'defaultProductSelectionDraftFunction'];
        }
        if ($createFunction == null) {
            $createFunction = [__CLASS__, 'defaultProductSelectionCreateFunction'];
        }
        if ($deleteFunction == null) {
            $deleteFunction = [__CLASS__, 'defaultProductSelectionDeleteFunction'];
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

    final public static function withDraftProductSelection(
        ApiClient $client,
        callable $draftBuilderFunction,
        callable $assertFunction,
        callable $createFunction = null,
        callable $deleteFunction = null,
        callable $draftFunction = null
    ) {
        if ($draftFunction == null) {
            $draftFunction = [__CLASS__, 'defaultProductSelectionDraftFunction'];
        }
        if ($createFunction == null) {
            $createFunction = [__CLASS__, 'defaultProductSelectionCreateFunction'];
        }
        if ($deleteFunction == null) {
            $deleteFunction = [__CLASS__, 'defaultProductSelectionDeleteFunction'];
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

    final public static function withProductSelection(
        ApiClient $client,
        callable $assertFunction,
        callable $createFunction = null,
        callable $deleteFunction = null,
        callable $draftFunction = null
    ) {
        self::withDraftProductSelection(
            $client,
            [__CLASS__, 'defaultProductSelectionDraftBuilderFunction'],
            $assertFunction,
            $createFunction,
            $deleteFunction,
            $draftFunction
        );
    }

    final public static function withUpdateableProductSelection(
        ApiClient $client,
        callable $assertFunction,
        callable $createFunction = null,
        callable $deleteFunction = null,
        callable $draftFunction = null
    ) {
        self::withUpdateableDraftProductSelection(
            $client,
            [__CLASS__, 'defaultProductSelectionDraftBuilderFunction'],
            $assertFunction,
            $createFunction,
            $deleteFunction,
            $draftFunction
        );
    }
}
