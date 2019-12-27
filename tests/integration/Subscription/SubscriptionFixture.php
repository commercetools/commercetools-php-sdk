<?php

namespace Commercetools\Core\IntegrationTests\Subscription;

use Commercetools\Core\Client\ApiClient;
use Commercetools\Core\Helper\Uuid;
use Commercetools\Core\IntegrationTests\ResourceFixture;
use Commercetools\Core\Model\Subscription\Destination;
use Commercetools\Core\Model\Subscription\MessageSubscription;
use Commercetools\Core\Model\Subscription\MessageSubscriptionCollection;
use Commercetools\Core\Model\Subscription\Subscription;
use Commercetools\Core\Model\Subscription\SubscriptionDraft;
use Commercetools\Core\Request\Subscriptions\SubscriptionCreateRequest;
use Commercetools\Core\Request\Subscriptions\SubscriptionDeleteRequest;

class SubscriptionFixture extends ResourceFixture
{
    const CREATE_REQUEST_TYPE = SubscriptionCreateRequest::class;
    const DELETE_REQUEST_TYPE = SubscriptionDeleteRequest::class;

    final public static function uniqueSubscriptionString()
    {
        return 'test-' . Uuid::uuidv4();
    }

    final public static function defaultSubscriptionDraftFunction()
    {
        $uniqueSubscriptionString = self::uniqueSubscriptionString();
        $uri = getenv('IRONMQ_URI');
        $destination = Destination::ofUri($uri);
        $messages = MessageSubscriptionCollection::of()
            ->add(MessageSubscription::of()->setResourceTypeId('product'));
        $key = 'test-' . $uniqueSubscriptionString;
        $draft = SubscriptionDraft::ofKeyDestinationAndMessages($key, $destination, $messages);

        return $draft;
    }

    final public static function defaultSubscriptionDraftBuilderFunction(SubscriptionDraft $draft)
    {
        return $draft;
    }

    final public static function defaultSubscriptionCreateFunction(ApiClient $client, SubscriptionDraft $draft)
    {
        return parent::defaultCreateFunction($client, self::CREATE_REQUEST_TYPE, $draft);
    }

    final public static function defaultSubscriptionDeleteFunction(ApiClient $client, Subscription $resource)
    {
        return parent::defaultDeleteFunction($client, self::DELETE_REQUEST_TYPE, $resource);
    }

    final public static function withUpdateableDraftSubscription(
        ApiClient $client,
        callable $draftBuilderFunction,
        callable $assertFunction,
        callable $createFunction = null,
        callable $deleteFunction = null,
        callable $draftFunction = null
    ) {
        if ($draftFunction == null) {
            $draftFunction = [__CLASS__, 'defaultSubscriptionDraftFunction'];
        }
        if ($createFunction == null) {
            $createFunction = [__CLASS__, 'defaultSubscriptionCreateFunction'];
        }
        if ($deleteFunction == null) {
            $deleteFunction = [__CLASS__, 'defaultSubscriptionDeleteFunction'];
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

    final public static function withDraftSubscription(
        ApiClient $client,
        callable $draftBuilderFunction,
        callable $assertFunction,
        callable $createFunction = null,
        callable $deleteFunction = null,
        callable $draftFunction = null
    ) {
        if ($draftFunction == null) {
            $draftFunction = [__CLASS__, 'defaultSubscriptionDraftFunction'];
        }
        if ($createFunction == null) {
            $createFunction = [__CLASS__, 'defaultSubscriptionCreateFunction'];
        }
        if ($deleteFunction == null) {
            $deleteFunction = [__CLASS__, 'defaultSubscriptionDeleteFunction'];
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

    final public static function withSubscription(
        ApiClient $client,
        callable $assertFunction,
        callable $createFunction = null,
        callable $deleteFunction = null,
        callable $draftFunction = null
    ) {
        self::withDraftSubscription(
            $client,
            [__CLASS__, 'defaultSubscriptionDraftBuilderFunction'],
            $assertFunction,
            $createFunction,
            $deleteFunction,
            $draftFunction
        );
    }
    
    final public static function withUpdateableSubscription(
        ApiClient $client,
        callable $assertFunction,
        callable $createFunction = null,
        callable $deleteFunction = null,
        callable $draftFunction = null
    ) {
        self::withUpdateableDraftSubscription(
            $client,
            [__CLASS__, 'defaultSubscriptionDraftBuilderFunction'],
            $assertFunction,
            $createFunction,
            $deleteFunction,
            $draftFunction
        );
    }
}
