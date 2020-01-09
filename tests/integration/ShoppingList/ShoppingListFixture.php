<?php

namespace Commercetools\Core\IntegrationTests\ShoppingList;

use Commercetools\Core\Client\ApiClient;
use Commercetools\Core\Helper\Uuid;
use Commercetools\Core\IntegrationTests\ResourceFixture;
use Commercetools\Core\Model\Common\LocalizedString;
use Commercetools\Core\Model\ShoppingList\Location;
use Commercetools\Core\Model\ShoppingList\LocationCollection;
use Commercetools\Core\Model\ShoppingList\ShoppingList;
use Commercetools\Core\Model\ShoppingList\ShoppingListDraft;
use Commercetools\Core\Request\ShoppingLists\ShoppingListCreateRequest;
use Commercetools\Core\Request\ShoppingLists\ShoppingListDeleteRequest;

class ShoppingListFixture extends ResourceFixture
{
    const CREATE_REQUEST_TYPE = ShoppingListCreateRequest::class;
    const DELETE_REQUEST_TYPE = ShoppingListDeleteRequest::class;
    const RAND_MAX = 10000;

    final public static function uniqueShoppingListString()
    {
        return 'test-' . Uuid::uuidv4();
    }

    final public static function defaultShoppingListDraftFunction()
    {
        $uniqueShoppingListString = self::uniqueShoppingListString();
        $draft = ShoppingListDraft::ofNameAndKey(
            LocalizedString::ofLangAndText('en', 'test-' . $uniqueShoppingListString . '-name'),
            'key-' . $uniqueShoppingListString
        );

        return $draft;
    }

    final public static function defaultShoppingListDraftBuilderFunction(ShoppingListDraft $draft)
    {
        return $draft;
    }

    final public static function defaultShoppingListCreateFunction(ApiClient $client, ShoppingListDraft $draft)
    {
        return parent::defaultCreateFunction($client, self::CREATE_REQUEST_TYPE, $draft);
    }

    final public static function defaultShoppingListDeleteFunction(ApiClient $client, ShoppingList $resource)
    {
        return parent::defaultDeleteFunction($client, self::DELETE_REQUEST_TYPE, $resource);
    }

    final public static function withUpdateableDraftShoppingList(
        ApiClient $client,
        callable $draftBuilderFunction,
        callable $assertFunction,
        callable $createFunction = null,
        callable $deleteFunction = null,
        callable $draftFunction = null
    ) {
        if ($draftFunction == null) {
            $draftFunction = [__CLASS__, 'defaultShoppingListDraftFunction'];
        }
        if ($createFunction == null) {
            $createFunction = [__CLASS__, 'defaultShoppingListCreateFunction'];
        }
        if ($deleteFunction == null) {
            $deleteFunction = [__CLASS__, 'defaultShoppingListDeleteFunction'];
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

    final public static function withDraftShoppingList(
        ApiClient $client,
        callable $draftBuilderFunction,
        callable $assertFunction,
        callable $createFunction = null,
        callable $deleteFunction = null,
        callable $draftFunction = null
    ) {
        if ($draftFunction == null) {
            $draftFunction = [__CLASS__, 'defaultShoppingListDraftFunction'];
        }
        if ($createFunction == null) {
            $createFunction = [__CLASS__, 'defaultShoppingListCreateFunction'];
        }
        if ($deleteFunction == null) {
            $deleteFunction = [__CLASS__, 'defaultShoppingListDeleteFunction'];
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

    final public static function withShoppingList(
        ApiClient $client,
        callable $assertFunction,
        callable $createFunction = null,
        callable $deleteFunction = null,
        callable $draftFunction = null
    ) {
        self::withDraftShoppingList(
            $client,
            [__CLASS__, 'defaultShoppingListDraftBuilderFunction'],
            $assertFunction,
            $createFunction,
            $deleteFunction,
            $draftFunction
        );
    }

    final public static function withUpdateableShoppingList(
        ApiClient $client,
        callable $assertFunction,
        callable $createFunction = null,
        callable $deleteFunction = null,
        callable $draftFunction = null
    ) {
        self::withUpdateableDraftShoppingList(
            $client,
            [__CLASS__, 'defaultShoppingListDraftBuilderFunction'],
            $assertFunction,
            $createFunction,
            $deleteFunction,
            $draftFunction
        );
    }
}
