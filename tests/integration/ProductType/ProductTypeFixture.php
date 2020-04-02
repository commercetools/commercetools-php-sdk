<?php

namespace Commercetools\Core\IntegrationTests\ProductType;

use Commercetools\Core\Client\ApiClient;
use Commercetools\Core\Helper\Uuid;
use Commercetools\Core\IntegrationTests\ResourceFixture;
use Commercetools\Core\Model\ProductType\ProductType;
use Commercetools\Core\Model\ProductType\ProductTypeDraft;
use Commercetools\Core\Request\ProductTypes\ProductTypeCreateRequest;
use Commercetools\Core\Request\ProductTypes\ProductTypeDeleteRequest;

class ProductTypeFixture extends ResourceFixture
{
    const CREATE_REQUEST_TYPE = ProductTypeCreateRequest::class;
    const DELETE_REQUEST_TYPE = ProductTypeDeleteRequest::class;

    final public static function uniqueProductTypeString()
    {
        return 'test-' . Uuid::uuidv4();
    }

    final public static function defaultProductTypeDraftFunction()
    {
        $uniqueProductTypeString = self::uniqueProductTypeString();
        $draft = ProductTypeDraft::ofNameAndDescription(
            'test-' . $uniqueProductTypeString . '-name',
            'test-' . $uniqueProductTypeString . '-description'
        );
        $draft->setKey('key-' . $uniqueProductTypeString);

        return $draft;
    }

    final public static function defaultProductTypeDraftBuilderFunction(ProductTypeDraft $draft)
    {
        return $draft;
    }

    final public static function defaultProductTypeCreateFunction(ApiClient $client, ProductTypeDraft $draft)
    {
        return parent::defaultCreateFunction($client, self::CREATE_REQUEST_TYPE, $draft);
    }

    final public static function defaultProductTypeDeleteFunction(ApiClient $client, ProductType $resource)
    {
        return parent::defaultDeleteFunction($client, self::DELETE_REQUEST_TYPE, $resource);
    }

    final public static function withUpdateableDraftProductType(
        ApiClient $client,
        callable $draftBuilderFunction,
        callable $assertFunction,
        callable $createFunction = null,
        callable $deleteFunction = null,
        callable $draftFunction = null
    ) {
        if ($draftFunction == null) {
            $draftFunction = [__CLASS__, 'defaultProductTypeDraftFunction'];
        }
        if ($createFunction == null) {
            $createFunction = [__CLASS__, 'defaultProductTypeCreateFunction'];
        }
        if ($deleteFunction == null) {
            $deleteFunction = [__CLASS__, 'defaultProductTypeDeleteFunction'];
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

    final public static function withDraftProductType(
        ApiClient $client,
        callable $draftBuilderFunction,
        callable $assertFunction,
        callable $createFunction = null,
        callable $deleteFunction = null,
        callable $draftFunction = null
    ) {
        if ($draftFunction == null) {
            $draftFunction = [__CLASS__, 'defaultProductTypeDraftFunction'];
        }
        if ($createFunction == null) {
            $createFunction = [__CLASS__, 'defaultProductTypeCreateFunction'];
        }
        if ($deleteFunction == null) {
            $deleteFunction = [__CLASS__, 'defaultProductTypeDeleteFunction'];
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

    final public static function withProductType(
        ApiClient $client,
        callable $assertFunction,
        callable $createFunction = null,
        callable $deleteFunction = null,
        callable $draftFunction = null
    ) {
        self::withDraftProductType(
            $client,
            [__CLASS__, 'defaultProductTypeDraftBuilderFunction'],
            $assertFunction,
            $createFunction,
            $deleteFunction,
            $draftFunction
        );
    }

    final public static function withUpdateableProductType(
        ApiClient $client,
        callable $assertFunction,
        callable $createFunction = null,
        callable $deleteFunction = null,
        callable $draftFunction = null
    ) {
        self::withUpdateableDraftProductType(
            $client,
            [__CLASS__, 'defaultProductTypeDraftBuilderFunction'],
            $assertFunction,
            $createFunction,
            $deleteFunction,
            $draftFunction
        );
    }
}
