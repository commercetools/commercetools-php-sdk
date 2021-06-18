<?php

namespace Commercetools\Core\IntegrationTests\OrderEdit;

use Commercetools\Core\Builder\Request\RequestBuilder;
use Commercetools\Core\Client\ApiClient;
use Commercetools\Core\Helper\Uuid;
use Commercetools\Core\IntegrationTests\Order\OrderFixture;
use Commercetools\Core\IntegrationTests\ResourceFixture;
use Commercetools\Core\Model\Order\Order;
use Commercetools\Core\Model\Order\OrderReference;
use Commercetools\Core\Model\OrderEdit\OrderEdit;
use Commercetools\Core\Model\OrderEdit\OrderEditDraft;
use Commercetools\Core\Request\OrderEdits\OrderEditCreateRequest;
use Commercetools\Core\Request\OrderEdits\OrderEditDeleteRequest;

class OrderEditFixture extends ResourceFixture
{
    const CREATE_REQUEST_TYPE = OrderEditCreateRequest::class;
    const DELETE_REQUEST_TYPE = OrderEditDeleteRequest::class;

    final public static function uniqueOrderEditString()
    {
        return 'test-' . Uuid::uuidv4();
    }

    final public static function defaultOrderEditDraftFunction(OrderReference $orderReference)
    {
        $draft = OrderEditDraft::ofResource($orderReference);
        $draft->setKey(self::uniqueOrderEditString());

        return $draft;
    }

    final public static function defaultOrderEditDraftBuilderFunction(OrderEditDraft $draft)
    {
        return $draft;
    }

    final public static function defaultOrderEditCreateFunction(ApiClient $client, OrderEditDraft $draft)
    {
        return parent::defaultCreateFunction($client, self::CREATE_REQUEST_TYPE, $draft);
    }

    final public static function defaultOrderEditDeleteFunction(ApiClient $client, OrderEdit $resource)
    {
        return parent::defaultDeleteFunction($client, self::DELETE_REQUEST_TYPE, $resource);
    }

    final public static function withUpdateableDraftOrderEdit(
        ApiClient $client,
        callable $draftBuilderFunction,
        callable $assertFunction,
        callable $createFunction = null,
        callable $deleteFunction = null,
        callable $draftFunction = null
    ) {
        OrderFixture::withUpdateableOrder(
            $client,
            function (Order $order) use ($client, $draftBuilderFunction, $assertFunction, $createFunction, $deleteFunction, $draftFunction) {
                $orderReference = OrderReference::ofId($order->getId());

                if ($draftFunction == null) {
                    $draftFunction = function () use ($orderReference) {
                        return call_user_func([__CLASS__, 'defaultOrderEditDraftFunction'], $orderReference);
                    };
                } else {
                    $draftFunction = function () use ($orderReference, $draftFunction) {
                        return call_user_func($draftFunction, $orderReference);
                    };
                }
                if ($createFunction == null) {
                    $createFunction = [__CLASS__, 'defaultOrderEditCreateFunction'];
                }
                if ($deleteFunction == null) {
                    $deleteFunction = [__CLASS__, 'defaultOrderEditDeleteFunction'];
                }

                parent::withUpdateableDraftResource(
                    $client,
                    $draftBuilderFunction,
                    $assertFunction,
                    $createFunction,
                    $deleteFunction,
                    $draftFunction,
                    [$order]
                );

                $request = RequestBuilder::of()->orders()->getById($order->getId());
                $response = $client->execute($request);
                return $request->mapFromResponse($response);
            }
        );
    }

    final public static function withDraftOrderEdit(
        ApiClient $client,
        callable $draftBuilderFunction,
        callable $assertFunction,
        callable $createFunction = null,
        callable $deleteFunction = null,
        callable $draftFunction = null
    ) {
        OrderFixture::withOrder(
            $client,
            function (Order $order) use ($client, $draftBuilderFunction, $assertFunction, $createFunction, $deleteFunction, $draftFunction) {
                $orderReference = OrderReference::ofId($order->getId());

                if ($draftFunction == null) {
                    $draftFunction = function () use ($orderReference) {
                        return call_user_func([__CLASS__, 'defaultOrderEditDraftFunction'], $orderReference);
                    };
                } else {
                    $draftFunction = function () use ($orderReference, $draftFunction) {
                        return call_user_func($draftFunction, $orderReference);
                    };
                }
                if ($createFunction == null) {
                    $createFunction = [__CLASS__, 'defaultOrderEditCreateFunction'];
                }
                if ($deleteFunction == null) {
                    $deleteFunction = [__CLASS__, 'defaultOrderEditDeleteFunction'];
                }

                parent::withDraftResource(
                    $client,
                    $draftBuilderFunction,
                    $assertFunction,
                    $createFunction,
                    $deleteFunction,
                    $draftFunction,
                    [$order]
                );
            }
        );
    }

    final public static function withOrderEdit(
        ApiClient $client,
        callable $assertFunction,
        callable $createFunction = null,
        callable $deleteFunction = null,
        callable $draftFunction = null
    ) {
        self::withDraftOrderEdit(
            $client,
            [__CLASS__, 'defaultOrderEditDraftBuilderFunction'],
            $assertFunction,
            $createFunction,
            $deleteFunction,
            $draftFunction
        );
    }

    final public static function withUpdateableOrderEdit(
        ApiClient $client,
        callable $assertFunction,
        callable $createFunction = null,
        callable $deleteFunction = null,
        callable $draftFunction = null
    ) {
        self::withUpdateableDraftOrderEdit(
            $client,
            [__CLASS__, 'defaultOrderEditDraftBuilderFunction'],
            $assertFunction,
            $createFunction,
            $deleteFunction,
            $draftFunction
        );
    }
}
