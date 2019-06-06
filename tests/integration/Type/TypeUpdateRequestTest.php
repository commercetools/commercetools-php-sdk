<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\IntegrationTests\Type;

use Commercetools\Core\IntegrationTests\ApiTestCase;
use Commercetools\Core\Model\Common\Enum;
use Commercetools\Core\Model\Common\EnumCollection;
use Commercetools\Core\Model\Common\LocalizedEnum;
use Commercetools\Core\Model\Common\LocalizedEnumCollection;
use Commercetools\Core\Model\Common\LocalizedString;
use Commercetools\Core\Model\Type\EnumType;
use Commercetools\Core\Model\Type\FieldDefinition;
use Commercetools\Core\Model\Type\FieldDefinitionCollection;
use Commercetools\Core\Model\Type\LocalizedEnumType;
use Commercetools\Core\Model\Type\StringType;
use Commercetools\Core\Model\Type\Type;
use Commercetools\Core\Model\Type\TypeDraft;
use Commercetools\Core\Request\Types\Command\TypeAddEnumValueAction;
use Commercetools\Core\Request\Types\Command\TypeAddFieldDefinitionAction;
use Commercetools\Core\Request\Types\Command\TypeAddLocalizedEnumValueAction;
use Commercetools\Core\Request\Types\Command\TypeChangeEnumValueLabelAction;
use Commercetools\Core\Request\Types\Command\TypeChangeInputHintAction;
use Commercetools\Core\Request\Types\Command\TypeChangeKeyAction;
use Commercetools\Core\Request\Types\Command\TypeChangeLabelAction;
use Commercetools\Core\Request\Types\Command\TypeChangeLocalizedEnumValueLabelAction;
use Commercetools\Core\Request\Types\Command\TypeChangeNameAction;
use Commercetools\Core\Request\Types\Command\TypeRemoveFieldDefinitionAction;
use Commercetools\Core\Request\Types\Command\TypeSetDescriptionAction;
use Commercetools\Core\Request\Types\TypeCreateRequest;
use Commercetools\Core\Request\Types\TypeDeleteRequest;
use Commercetools\Core\Request\Types\TypeUpdateByKeyRequest;
use Commercetools\Core\Request\Types\TypeUpdateRequest;

class TypeUpdateRequestTest extends ApiTestCase
{
    /**
     * @return TypeDraft
     */
    protected function getDraft($name)
    {
        $draft = TypeDraft::ofKeyNameDescriptionAndResourceTypes(
            'key-' . $this->getTestRun(),
            LocalizedString::ofLangAndText('en', 'test-' . $this->getTestRun() . '-' . $name),
            LocalizedString::ofLangAndText('en', 'test-' . $this->getTestRun() . '-description'),
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

    protected function createType(TypeDraft $draft)
    {
        /**
         * @var Type $type
         */
        $request = TypeCreateRequest::ofDraft($draft);
        $response = $request->executeWithClient($this->getClient());

        $type = $request->mapResponse($response);
        $this->cleanupRequests[] = $this->deleteRequest = TypeDeleteRequest::ofIdAndVersion(
            $type->getId(),
            $type->getVersion()
        );

        return $type;
    }

    public function testChangeByKey()
    {
        $draft = $this->getDraft('change-by-key');
        $type = $this->createType($draft);

        $name = $this->getTestRun() . '-new name';
        $request = TypeUpdateByKeyRequest::ofKeyAndVersion($type->getKey(), $type->getVersion())
            ->addAction(TypeChangeNameAction::ofName(LocalizedString::ofLangAndText('en', $name)))
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf(Type::class, $result);
        $this->assertSame($name, $result->getName()->en);
    }

    public function testChangeKey()
    {
        $draft = $this->getDraft('change-key');
        $type = $this->createType($draft);

        $key = 'new-' . $this->getTestRun();
        $request = TypeUpdateRequest::ofIdAndVersion($type->getId(), $type->getVersion())
            ->addAction(TypeChangeKeyAction::ofKey($key))
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf(Type::class, $result);
        $this->assertSame($key, $result->getKey());
    }

    public function testChangeKeyLength()
    {
        $draft = $this->getDraft('change-key');
        $draft->setKey(str_pad($draft->getKey(), 256, '0'));
        $type = $this->createType($draft);

        $key = str_pad('new-' . $this->getTestRun(), 256, '0');
        $request = TypeUpdateRequest::ofIdAndVersion($type->getId(), $type->getVersion())
            ->addAction(TypeChangeKeyAction::ofKey($key))
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf(Type::class, $result);
        $this->assertSame($key, $result->getKey());
    }

    public function testChangeName()
    {
        $draft = $this->getDraft('change-name');
        $type = $this->createType($draft);

        $name = $this->getTestRun() . '-new name';
        $request = TypeUpdateRequest::ofIdAndVersion($type->getId(), $type->getVersion())
            ->addAction(TypeChangeNameAction::ofName(LocalizedString::ofLangAndText('en', $name)))
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf(Type::class, $result);
        $this->assertSame($name, $result->getName()->en);
    }

    public function testSetDescription()
    {
        $draft = $this->getDraft('set-description');
        $type = $this->createType($draft);

        $description = $this->getTestRun() . '-new description';
        $request = TypeUpdateRequest::ofIdAndVersion($type->getId(), $type->getVersion())
            ->addAction(
                TypeSetDescriptionAction::of()->setDescription(LocalizedString::ofLangAndText('en', $description))
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf(Type::class, $result);
        $this->assertSame($description, $result->getDescription()->en);
    }

    public function testFieldDefinition()
    {
        $draft = $this->getDraft('field-definition');
        $type = $this->createType($draft);

        $fieldDefinition = FieldDefinition::of()
            ->setName('newField')
            ->setLabel(LocalizedString::ofLangAndText('en', 'newField'))
            ->setRequired(false)
            ->setType(StringType::of())
        ;
        $request = TypeUpdateRequest::ofIdAndVersion($type->getId(), $type->getVersion())
            ->addAction(
                TypeAddFieldDefinitionAction::ofFieldDefinition($fieldDefinition)
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf(Type::class, $result);
        $this->assertCount(2, $result->getFieldDefinitions());
        $this->assertInstanceOf(
            FieldDefinition::class,
            $result->getFieldDefinitions()->getByName('newField')
        );
        $type = $result;

        $label = $this->getTestRun() . ' new label';
        $request = TypeUpdateRequest::ofIdAndVersion($type->getId(), $type->getVersion())
            ->addAction(
                TypeChangeLabelAction::ofNameAndLabel('newField', LocalizedString::ofLangAndText('en', $label))
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf(Type::class, $result);
        $this->assertSame($label, $result->getFieldDefinitions()->getByName('newField')->getLabel()->en);
        $type = $result;

        $request = TypeUpdateRequest::ofIdAndVersion($type->getId(), $type->getVersion())
            ->addAction(
                TypeRemoveFieldDefinitionAction::ofFieldName('newField')
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf(Type::class, $result);
        $this->assertCount(1, $result->getFieldDefinitions());
        $this->assertNull($result->getFieldDefinitions()->getByName('newField'));
    }

    public function testAddEnumValue()
    {
        $draft = $this->getDraft('add-enum');
        $type = $this->createType($draft);

        $fieldDefinition = FieldDefinition::of()
            ->setName('newEnumField')
            ->setLabel(LocalizedString::ofLangAndText('en', 'newEnumField'))
            ->setRequired(false)
            ->setType(
                EnumType::of()
                    ->setValues(EnumCollection::of())
            )
        ;
        $request = TypeUpdateRequest::ofIdAndVersion($type->getId(), $type->getVersion())
            ->addAction(
                TypeAddFieldDefinitionAction::ofFieldDefinition($fieldDefinition)
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());
        $type = $result;

        $enum = Enum::of()->setKey('test')->setLabel('test');
        $request = TypeUpdateRequest::ofIdAndVersion($type->getId(), $type->getVersion())
            ->addAction(
                TypeAddEnumValueAction::ofNameAndEnum('newEnumField', $enum)
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf(Type::class, $result);
        /**
         * @var EnumType $fieldType
         */
        $fieldType = $result->getFieldDefinitions()->getByName('newEnumField')->getType();
        $this->assertSame($enum->getKey(), $fieldType->getValues()->current()->getKey());
    }

    public function testAddLocalizedEnumValue()
    {
        $draft = $this->getDraft('add-localized-enum');
        $type = $this->createType($draft);

        $fieldDefinition = FieldDefinition::of()
            ->setName('newLEnumField')
            ->setLabel(LocalizedString::ofLangAndText('en', 'newLEnumField'))
            ->setRequired(false)
            ->setType(
                LocalizedEnumType::of()
                    ->setValues(LocalizedEnumCollection::of())
            )
        ;
        $request = TypeUpdateRequest::ofIdAndVersion($type->getId(), $type->getVersion())
            ->addAction(
                TypeAddFieldDefinitionAction::ofFieldDefinition($fieldDefinition)
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());
        $type = $result;

        $enum = LocalizedEnum::of()->setKey('test')->setLabel(LocalizedString::ofLangAndText('en', 'test'));
        $request = TypeUpdateRequest::ofIdAndVersion($type->getId(), $type->getVersion())
            ->addAction(
                TypeAddLocalizedEnumValueAction::ofNameAndEnum('newLEnumField', $enum)
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf(Type::class, $result);
        /**
         * @var LocalizedEnumType $fieldType
         */
        $fieldType = $result->getFieldDefinitions()->getByName('newLEnumField')->getType();
        $this->assertSame($enum->getKey(), $fieldType->getValues()->current()->getKey());
    }

    public function testChangeEnumValueLabel()
    {
        $draft = $this->getDraft('change-enum-value-label');
        $type = $this->createType($draft);

        $fieldDefinition = FieldDefinition::of()
            ->setName('newEnumField')
            ->setLabel(LocalizedString::ofLangAndText('en', 'newEnumField'))
            ->setRequired(false)
            ->setType(
                EnumType::of()
                    ->setValues(EnumCollection::of()->add(Enum::of()->setKey('test')->setLabel('test')))
            )
        ;
        $request = TypeUpdateRequest::ofIdAndVersion($type->getId(), $type->getVersion())
            ->addAction(
                TypeAddFieldDefinitionAction::ofFieldDefinition($fieldDefinition)
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());
        $type = $result;

        $enum = Enum::of()->setKey('test')->setLabel('new-label');
        $request = TypeUpdateRequest::ofIdAndVersion($type->getId(), $type->getVersion())
            ->addAction(
                TypeChangeEnumValueLabelAction::ofNameAndEnum('newEnumField', $enum)
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf(Type::class, $result);
        /**
         * @var EnumType $fieldType
         */
        $fieldType = $result->getFieldDefinitions()->getByName('newEnumField')->getType();
        $this->assertSame($enum->getLabel(), $fieldType->getValues()->current()->getLabel());
    }

    public function testChangeLocalizedEnumValueLabel()
    {
        $draft = $this->getDraft('change-localized-enum-value-label');
        $type = $this->createType($draft);

        $fieldDefinition = FieldDefinition::of()
            ->setName('newEnumField')
            ->setLabel(LocalizedString::ofLangAndText('en', 'newEnumField'))
            ->setRequired(false)
            ->setType(
                LocalizedEnumType::of()
                    ->setValues(
                        LocalizedEnumCollection::of()->add(
                            LocalizedEnum::of()->setKey('test')
                                ->setLabel(LocalizedString::ofLangAndText('en', 'test'))
                        )
                    )
            )
        ;
        $request = TypeUpdateRequest::ofIdAndVersion($type->getId(), $type->getVersion())
            ->addAction(
                TypeAddFieldDefinitionAction::ofFieldDefinition($fieldDefinition)
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());
        $type = $result;

        $enum = LocalizedEnum::of()->setKey('test')
            ->setLabel(LocalizedString::ofLangAndText('en', 'new-label'));
        $request = TypeUpdateRequest::ofIdAndVersion($type->getId(), $type->getVersion())
            ->addAction(
                TypeChangeLocalizedEnumValueLabelAction::ofNameAndEnum('newEnumField', $enum)
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf(Type::class, $result);
        /**
         * @var LocalizedEnumType $fieldType
         */
        $fieldType = $result->getFieldDefinitions()->getByName('newEnumField')->getType();
        $this->assertSame($enum->getLabel()->en, $fieldType->getValues()->current()->getLabel()->en);
    }

    public function testChangeInputHint()
    {
        $draft = $this->getDraft('change-input-hint');
        $type = $this->createType($draft);

        $inputHint = 'MultiLine';
        $request = TypeUpdateRequest::ofIdAndVersion($type->getId(), $type->getVersion())
            ->addAction(
                TypeChangeInputHintAction::ofNameAndInputHint('testField', $inputHint)
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf(Type::class, $result);
        $field = $result->getFieldDefinitions()->getByName('testField');
        $this->assertSame($inputHint, $field->getInputHint());
    }
}
