<?php

namespace Commercetools\Core\IntegrationTests\Type;

use Commercetools\Core\Client\ApiClient;
use Commercetools\Core\Helper\Uuid;
use Commercetools\Core\IntegrationTests\ResourceFixture;
use Commercetools\Core\Model\Common\LocalizedString;
use Commercetools\Core\Model\Type\FieldDefinition;
use Commercetools\Core\Model\Type\FieldDefinitionCollection;
use Commercetools\Core\Model\Type\StringType;
use Commercetools\Core\Model\Type\Type;
use Commercetools\Core\Model\Type\TypeDraft;
use Commercetools\Core\Request\Types\TypeCreateRequest;
use Commercetools\Core\Request\Types\TypeDeleteRequest;

class TypeFixture extends ResourceFixture
{
    const CREATE_REQUEST_TYPE = TypeCreateRequest::class;
    const DELETE_REQUEST_TYPE = TypeDeleteRequest::class;

    final public static function uniqueTypeString()
    {
        return 'test-' . Uuid::uuidv4();
    }

    final public static function defaultTypeDraftFunction()
    {
        $uniqueTypeString = self::uniqueTypeString();
        $draft = TypeDraft::ofKeyNameDescriptionAndResourceTypes(
            'key-' . $uniqueTypeString,
            LocalizedString::ofLangAndText('en', 'test-' . $uniqueTypeString . '-name'),
            LocalizedString::ofLangAndText('en', 'test-' . $uniqueTypeString . '-description'),
            ['category']
        );
        $draft->setFieldDefinitions(
            FieldDefinitionCollection::of()
                ->add(
                    FieldDefinition::of()
                        ->setName('testField')
                        ->setLabel(LocalizedString::ofLangAndText('en', 'testField'))
                        ->setRequired(false)
                        ->setInputHint('SingleLine')
                        ->setType(StringType::of())
                )
        );

        return $draft;
    }

    final public static function defaultTypeDraftBuilderFunction(TypeDraft $draft)
    {
        return $draft;
    }

    final public static function defaultTypeCreateFunction(ApiClient $client, TypeDraft $draft)
    {
        return parent::defaultCreateFunction($client, self::CREATE_REQUEST_TYPE, $draft);
    }

    final public static function defaultTypeDeleteFunction(ApiClient $client, Type $resource)
    {
        return parent::defaultDeleteFunction($client, self::DELETE_REQUEST_TYPE, $resource);
    }

    final public static function withUpdateableDraftType(
        ApiClient $client,
        callable $draftBuilderFunction,
        callable $assertFunction,
        callable $createFunction = null,
        callable $deleteFunction = null,
        callable $draftFunction = null
    ) {
        if ($draftFunction == null) {
            $draftFunction = [__CLASS__, 'defaultTypeDraftFunction'];
        }
        if ($createFunction == null) {
            $createFunction = [__CLASS__, 'defaultTypeCreateFunction'];
        }
        if ($deleteFunction == null) {
            $deleteFunction = [__CLASS__, 'defaultTypeDeleteFunction'];
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

    final public static function withDraftType(
        ApiClient $client,
        callable $draftBuilderFunction,
        callable $assertFunction,
        callable $createFunction = null,
        callable $deleteFunction = null,
        callable $draftFunction = null
    ) {
        if ($draftFunction == null) {
            $draftFunction = [__CLASS__, 'defaultTypeDraftFunction'];
        }
        if ($createFunction == null) {
            $createFunction = [__CLASS__, 'defaultTypeCreateFunction'];
        }
        if ($deleteFunction == null) {
            $deleteFunction = [__CLASS__, 'defaultTypeDeleteFunction'];
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

    final public static function withType(
        ApiClient $client,
        callable $assertFunction,
        callable $createFunction = null,
        callable $deleteFunction = null,
        callable $draftFunction = null
    ) {
        self::withDraftType(
            $client,
            [__CLASS__, 'defaultTypeDraftBuilderFunction'],
            $assertFunction,
            $createFunction,
            $deleteFunction,
            $draftFunction
        );
    }

    final public static function withUpdateableType(
        ApiClient $client,
        callable $assertFunction,
        callable $createFunction = null,
        callable $deleteFunction = null,
        callable $draftFunction = null
    ) {
        self::withUpdateableDraftType(
            $client,
            [__CLASS__, 'defaultTypeDraftBuilderFunction'],
            $assertFunction,
            $createFunction,
            $deleteFunction,
            $draftFunction
        );
    }
}
