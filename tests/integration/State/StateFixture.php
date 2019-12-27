<?php

namespace Commercetools\Core\IntegrationTests\State;

use Commercetools\Core\Client\ApiClient;
use Commercetools\Core\Helper\Uuid;
use Commercetools\Core\IntegrationTests\ResourceFixture;
use Commercetools\Core\IntegrationTests\TestHelper;
use Commercetools\Core\Model\State\AbsoluteStateValue;
use Commercetools\Core\Model\State\State;
use Commercetools\Core\Model\State\StateDraft;
use Commercetools\Core\Model\State\StateTarget;
use Commercetools\Core\Model\Common\LocalizedString;
use Commercetools\Core\Model\Common\Money;
use Commercetools\Core\Model\Common\MoneyCollection;
use Commercetools\Core\Request\States\StateCreateRequest;
use Commercetools\Core\Request\States\StateDeleteRequest;

class StateFixture extends ResourceFixture
{
    const CREATE_REQUEST_TYPE = StateCreateRequest::class;
    const DELETE_REQUEST_TYPE = StateDeleteRequest::class;

    final public static function uniqueStateString()
    {
        return 'test-' . Uuid::uuidv4();
    }

    final public static function defaultStateDraftFunction()
    {
        $uniqueStateString = self::uniqueStateString();
        $draft = StateDraft::ofKey('test-' . $uniqueStateString . '-key');

        return $draft;
    }

    final public static function defaultStateDraftBuilderFunction(StateDraft $draft)
    {
        return $draft;
    }

    final public static function defaultStateCreateFunction(ApiClient $client, StateDraft $draft)
    {
        return parent::defaultCreateFunction($client, self::CREATE_REQUEST_TYPE, $draft);
    }

    final public static function defaultStateDeleteFunction(ApiClient $client, State $resource)
    {
        return parent::defaultDeleteFunction($client, self::DELETE_REQUEST_TYPE, $resource);
    }

    final public static function withUpdateableDraftState(
        ApiClient $client,
        callable $draftBuilderFunction,
        callable $assertFunction,
        callable $createFunction = null,
        callable $deleteFunction = null,
        callable $draftFunction = null
    ) {
        if ($draftFunction == null) {
            $draftFunction = [__CLASS__, 'defaultStateDraftFunction'];
        }
        if ($createFunction == null) {
            $createFunction = [__CLASS__, 'defaultStateCreateFunction'];
        }
        if ($deleteFunction == null) {
            $deleteFunction = [__CLASS__, 'defaultStateDeleteFunction'];
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

    final public static function withDraftState(
        ApiClient $client,
        callable $draftBuilderFunction,
        callable $assertFunction,
        callable $createFunction = null,
        callable $deleteFunction = null,
        callable $draftFunction = null
    ) {
        if ($draftFunction == null) {
            $draftFunction = [__CLASS__, 'defaultStateDraftFunction'];
        }
        if ($createFunction == null) {
            $createFunction = [__CLASS__, 'defaultStateCreateFunction'];
        }
        if ($deleteFunction == null) {
            $deleteFunction = [__CLASS__, 'defaultStateDeleteFunction'];
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

    final public static function withState(
        ApiClient $client,
        callable $assertFunction,
        callable $createFunction = null,
        callable $deleteFunction = null,
        callable $draftFunction = null
    ) {
        self::withDraftState(
            $client,
            [__CLASS__, 'defaultStateDraftBuilderFunction'],
            $assertFunction,
            $createFunction,
            $deleteFunction,
            $draftFunction
        );
    }

    final public static function withUpdateableState(
        ApiClient $client,
        callable $assertFunction,
        callable $createFunction = null,
        callable $deleteFunction = null,
        callable $draftFunction = null
    ) {
        self::withUpdateableDraftState(
            $client,
            [__CLASS__, 'defaultStateDraftBuilderFunction'],
            $assertFunction,
            $createFunction,
            $deleteFunction,
            $draftFunction
        );
    }
}
