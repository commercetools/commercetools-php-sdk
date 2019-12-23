<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\IntegrationTests\Type;

use Commercetools\Core\Builder\Request\RequestBuilder;
use Commercetools\Core\IntegrationTests\ApiTestCase;
use Commercetools\Core\Model\Common\Enum;
use Commercetools\Core\Model\Common\EnumCollection;
use Commercetools\Core\Model\Common\LocalizedEnum;
use Commercetools\Core\Model\Common\LocalizedEnumCollection;
use Commercetools\Core\Model\Common\LocalizedString;
use Commercetools\Core\Model\Type\EnumType;
use Commercetools\Core\Model\Type\FieldDefinition;
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

class TypeUpdateRequestTest extends ApiTestCase
{
    private function setFieldDefinition($name, $type)
    {
        return FieldDefinition::of()
            ->setName($name)
            ->setLabel(LocalizedString::ofLangAndText('en', $name))
            ->setRequired(false)
            ->setType($type);
    }

    public function testChangeByKey()
    {
        $client = $this->getApiClient();

        TypeFixture::withUpdateableType(
            $client,
            function (Type $type) use ($client) {
                $name = 'new-name';
                $request = RequestBuilder::of()->types()->updateByKey($type)
                    ->addAction(TypeChangeNameAction::ofName(LocalizedString::ofLangAndText('en', $name)));
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(Type::class, $result);
                $this->assertSame($name, $result->getName()->en);

                return $result;
            }
        );
    }

    public function testChangeKey()
    {
        $client = $this->getApiClient();

        TypeFixture::withUpdateableType(
            $client,
            function (Type $type) use ($client) {
                $key = 'new-key';
                $request = RequestBuilder::of()->types()->update($type)
                    ->addAction(TypeChangeKeyAction::ofKey($key));
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(Type::class, $result);
                $this->assertSame($key, $result->getKey());

                return $result;
            }
        );
    }

    public function testChangeKeyLength()
    {
        $client = $this->getApiClient();

        TypeFixture::withUpdateableDraftType(
            $client,
            function (TypeDraft $draft) {
                return $draft->setKey(str_pad($draft->getKey(), 256, '0'));
            },
            function (Type $type) use ($client) {
                $key = str_pad('new-' . $this->getTestRun(), 256, '0');
                $request = RequestBuilder::of()->types()->update($type)
                    ->addAction(TypeChangeKeyAction::ofKey($key));
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(Type::class, $result);
                $this->assertSame($key, $result->getKey());

                return $result;
            }
        );
    }

    public function testChangeName()
    {
        $client = $this->getApiClient();

        TypeFixture::withUpdateableType(
            $client,
            function (Type $type) use ($client) {
                $name = 'new-name';
                $request = RequestBuilder::of()->types()->update($type)
                    ->addAction(TypeChangeNameAction::ofName(LocalizedString::ofLangAndText('en', $name)));
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(Type::class, $result);
                $this->assertSame($name, $result->getName()->en);

                return $result;
            }
        );
    }

    public function testSetDescription()
    {
        $client = $this->getApiClient();

        TypeFixture::withUpdateableType(
            $client,
            function (Type $type) use ($client) {
                $description = 'new-description';
                $request = RequestBuilder::of()->types()->update($type)
                    ->addAction(
                        TypeSetDescriptionAction::of()
                            ->setDescription(LocalizedString::ofLangAndText('en', $description))
                    );
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(Type::class, $result);
                $this->assertSame($description, $result->getDescription()->en);

                return $result;
            }
        );
    }

    public function testFieldDefinition()
    {
        $client = $this->getApiClient();

        TypeFixture::withUpdateableType(
            $client,
            function (Type $type) use ($client) {
                $name = 'newField';
                $fieldDefinition = $this->setFieldDefinition($name, StringType::of());
                $request = RequestBuilder::of()->types()->update($type)
                    ->addAction(
                        TypeAddFieldDefinitionAction::ofFieldDefinition($fieldDefinition)
                    );
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(Type::class, $result);
                $this->assertCount(2, $result->getFieldDefinitions());
                $this->assertInstanceOf(
                    FieldDefinition::class,
                    $result->getFieldDefinitions()->getByName('newField')
                );

                $label = 'new-label';
                $request = RequestBuilder::of()->types()->update($result)
                    ->addAction(
                        TypeChangeLabelAction::ofNameAndLabel('newField', LocalizedString::ofLangAndText('en', $label))
                    );
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(Type::class, $result);
                $this->assertSame($label, $result->getFieldDefinitions()->getByName('newField')->getLabel()->en);

                $request = RequestBuilder::of()->types()->update($result)
                    ->addAction(TypeRemoveFieldDefinitionAction::ofFieldName('newField'));
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(Type::class, $result);
                $this->assertCount(1, $result->getFieldDefinitions());
                $this->assertNull($result->getFieldDefinitions()->getByName('newField'));

                return $result;
            }
        );
    }

    public function testAddEnumValue()
    {
        $client = $this->getApiClient();

        TypeFixture::withUpdateableType(
            $client,
            function (Type $type) use ($client) {
                $name = 'newEnumField';
                $enumType = EnumType::of()->setValues(EnumCollection::of());
                $fieldDefinition = $this->setFieldDefinition($name, $enumType);
                $request = RequestBuilder::of()->types()->update($type)
                    ->addAction(TypeAddFieldDefinitionAction::ofFieldDefinition($fieldDefinition));
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $enum = Enum::of()->setKey('test')->setLabel('test');
                $request = RequestBuilder::of()->types()->update($result)
                    ->addAction(TypeAddEnumValueAction::ofNameAndEnum('newEnumField', $enum));
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(Type::class, $result);
                /**
                 * @var EnumType $fieldType
                 */
                $fieldType = $result->getFieldDefinitions()->getByName('newEnumField')->getType();
                $this->assertSame($enum->getKey(), $fieldType->getValues()->current()->getKey());

                return $result;
            }
        );
    }

    public function testAddLocalizedEnumValue()
    {
        $client = $this->getApiClient();

        TypeFixture::withUpdateableType(
            $client,
            function (Type $type) use ($client) {
                $name = 'newLEnumField';
                $enumType = LocalizedEnumType::of()
                    ->setValues(LocalizedEnumCollection::of());
                $fieldDefinition = $this->setFieldDefinition($name, $enumType);
                $request = RequestBuilder::of()->types()->update($type)
                    ->addAction(TypeAddFieldDefinitionAction::ofFieldDefinition($fieldDefinition));
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $enum = LocalizedEnum::of()->setKey('test')->setLabel(LocalizedString::ofLangAndText('en', 'test'));
                $request = RequestBuilder::of()->types()->update($result)
                    ->addAction(TypeAddLocalizedEnumValueAction::ofNameAndEnum('newLEnumField', $enum));
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(Type::class, $result);
                /**
                 * @var LocalizedEnumType $fieldType
                 */
                $fieldType = $result->getFieldDefinitions()->getByName('newLEnumField')->getType();
                $this->assertSame($enum->getKey(), $fieldType->getValues()->current()->getKey());

                return $result;
            }
        );
    }

    public function testChangeEnumValueLabel()
    {
        $client = $this->getApiClient();

        TypeFixture::withUpdateableType(
            $client,
            function (Type $type) use ($client) {
                $name = 'newEnumField';
                $enumType = EnumType::of()
                    ->setValues(EnumCollection::of()->add(Enum::of()->setKey('test')->setLabel('test')));
                $fieldDefinition = $this->setFieldDefinition($name, $enumType);
                $request = RequestBuilder::of()->types()->update($type)
                    ->addAction(TypeAddFieldDefinitionAction::ofFieldDefinition($fieldDefinition));
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $enum = Enum::of()->setKey('test')->setLabel('new-label');
                $request = RequestBuilder::of()->types()->update($result)
                    ->addAction(TypeChangeEnumValueLabelAction::ofNameAndEnum('newEnumField', $enum));
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(Type::class, $result);
                /**
                 * @var EnumType $fieldType
                 */
                $fieldType = $result->getFieldDefinitions()->getByName('newEnumField')->getType();
                $this->assertSame($enum->getLabel(), $fieldType->getValues()->current()->getLabel());

                return $result;
            }
        );
    }

    public function testChangeLocalizedEnumValueLabel()
    {
        $client = $this->getApiClient();

        TypeFixture::withUpdateableType(
            $client,
            function (Type $type) use ($client) {
                $name = 'newEnumField';
                $enumType = LocalizedEnumType::of()
                    ->setValues(
                        LocalizedEnumCollection::of()->add(
                            LocalizedEnum::of()->setKey('test')
                                ->setLabel(LocalizedString::ofLangAndText('en', 'test'))
                        )
                    );
                $fieldDefinition = $this->setFieldDefinition($name, $enumType);
                $request = RequestBuilder::of()->types()->update($type)
                    ->addAction(TypeAddFieldDefinitionAction::ofFieldDefinition($fieldDefinition));
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $enum = LocalizedEnum::of()->setKey('test')
                    ->setLabel(LocalizedString::ofLangAndText('en', 'new-label'));
                $request = RequestBuilder::of()->types()->update($result)
                    ->addAction(
                        TypeChangeLocalizedEnumValueLabelAction::ofNameAndEnum('newEnumField', $enum)
                    );
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(Type::class, $result);
                /**
                 * @var LocalizedEnumType $fieldType
                 */
                $fieldType = $result->getFieldDefinitions()->getByName('newEnumField')->getType();
                $this->assertSame($enum->getLabel()->en, $fieldType->getValues()->current()->getLabel()->en);

                return $result;
            }
        );
    }

    public function testChangeInputHint()
    {
        $client = $this->getApiClient();

        TypeFixture::withUpdateableType(
            $client,
            function (Type $type) use ($client) {
                $inputHint = 'MultiLine';
                $request = RequestBuilder::of()->types()->update($type)
                    ->addAction(TypeChangeInputHintAction::ofNameAndInputHint('testField', $inputHint));
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(Type::class, $result);
                $field = $result->getFieldDefinitions()->getByName('testField');
                $this->assertSame($inputHint, $field->getInputHint());

                return $result;
            }
        );
    }
}
