<?php

namespace Commercetools\Core\IntegrationTests\Zone;

use Commercetools\Core\Client\ApiClient;
use Commercetools\Core\Helper\Uuid;
use Commercetools\Core\IntegrationTests\ResourceFixture;
use Commercetools\Core\Model\Zone\Location;
use Commercetools\Core\Model\Zone\LocationCollection;
use Commercetools\Core\Model\Zone\Zone;
use Commercetools\Core\Model\Zone\ZoneDraft;
use Commercetools\Core\Request\Zones\ZoneCreateRequest;
use Commercetools\Core\Request\Zones\ZoneDeleteRequest;

class ZoneFixture extends ResourceFixture
{
    const CREATE_REQUEST_TYPE = ZoneCreateRequest::class;
    const DELETE_REQUEST_TYPE = ZoneDeleteRequest::class;
    const RAND_MAX = 10000;

    final public static function uniqueZoneString()
    {
        return 'test-' . Uuid::uuidv4();
    }

    final public static function defaultZoneDraftFunction()
    {
        $uniqueZoneString = self::uniqueZoneString();
        $region = "r" . (string)mt_rand(1, static::RAND_MAX);

        $draft = ZoneDraft::ofNameAndLocations(
            'test-' . $uniqueZoneString . '-name',
            LocationCollection::of()->add(
                Location::of()->setCountry('DE')->setState($region)
            )
        )->setKey($uniqueZoneString);

        return $draft;
    }

    final public static function defaultZoneDraftBuilderFunction(ZoneDraft $draft)
    {
        return $draft;
    }

    final public static function defaultZoneCreateFunction(ApiClient $client, ZoneDraft $draft)
    {
        return parent::defaultCreateFunction($client, self::CREATE_REQUEST_TYPE, $draft);
    }

    final public static function defaultZoneDeleteFunction(ApiClient $client, Zone $resource)
    {
        return parent::defaultDeleteFunction($client, self::DELETE_REQUEST_TYPE, $resource);
    }

    final public static function withUpdateableDraftZone(
        ApiClient $client,
        callable $draftBuilderFunction,
        callable $assertFunction,
        callable $createFunction = null,
        callable $deleteFunction = null,
        callable $draftFunction = null
    ) {
        if ($draftFunction == null) {
            $draftFunction = [__CLASS__, 'defaultZoneDraftFunction'];
        }
        if ($createFunction == null) {
            $createFunction = [__CLASS__, 'defaultZoneCreateFunction'];
        }
        if ($deleteFunction == null) {
            $deleteFunction = [__CLASS__, 'defaultZoneDeleteFunction'];
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

    final public static function withDraftZone(
        ApiClient $client,
        callable $draftBuilderFunction,
        callable $assertFunction,
        callable $createFunction = null,
        callable $deleteFunction = null,
        callable $draftFunction = null
    ) {
        if ($draftFunction == null) {
            $draftFunction = [__CLASS__, 'defaultZoneDraftFunction'];
        }
        if ($createFunction == null) {
            $createFunction = [__CLASS__, 'defaultZoneCreateFunction'];
        }
        if ($deleteFunction == null) {
            $deleteFunction = [__CLASS__, 'defaultZoneDeleteFunction'];
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

    final public static function withZone(
        ApiClient $client,
        callable $assertFunction,
        callable $createFunction = null,
        callable $deleteFunction = null,
        callable $draftFunction = null
    ) {
        self::withDraftZone(
            $client,
            [__CLASS__, 'defaultZoneDraftBuilderFunction'],
            $assertFunction,
            $createFunction,
            $deleteFunction,
            $draftFunction
        );
    }

    final public static function withUpdateableZone(
        ApiClient $client,
        callable $assertFunction,
        callable $createFunction = null,
        callable $deleteFunction = null,
        callable $draftFunction = null
    ) {
        self::withUpdateableDraftZone(
            $client,
            [__CLASS__, 'defaultZoneDraftBuilderFunction'],
            $assertFunction,
            $createFunction,
            $deleteFunction,
            $draftFunction
        );
    }
}
