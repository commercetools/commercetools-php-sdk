<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\IntegrationTests\ProductType;

use Commercetools\Core\Builder\Request\RequestBuilder;
use Commercetools\Core\Fixtures\FixtureException;
use Commercetools\Core\IntegrationTests\ApiTestCase;
use Commercetools\Core\IntegrationTests\CustomObject\CustomObjectFixture;
use Commercetools\Core\IntegrationTests\Product\ProductFixture;
use Commercetools\Core\Model\Common\Attribute;
use Commercetools\Core\Model\Common\AttributeCollection;
use Commercetools\Core\Model\Common\Enum;
use Commercetools\Core\Model\Common\EnumCollection;
use Commercetools\Core\Model\Common\LocalizedEnum;
use Commercetools\Core\Model\Common\LocalizedEnumCollection;
use Commercetools\Core\Model\Common\LocalizedString;
use Commercetools\Core\Model\CustomObject\CustomObject;
use Commercetools\Core\Model\CustomObject\CustomObjectDraft;
use Commercetools\Core\Model\CustomObject\CustomObjectReference;
use Commercetools\Core\Model\Product\Product;
use Commercetools\Core\Model\Product\ProductDraft;
use Commercetools\Core\Model\Product\ProductVariantDraft;
use Commercetools\Core\Model\ProductType\AttributeDefinition;
use Commercetools\Core\Model\ProductType\AttributeDefinitionCollection;
use Commercetools\Core\Model\ProductType\EnumType;
use Commercetools\Core\Model\ProductType\LocalizedEnumType;
use Commercetools\Core\Model\ProductType\ProductType;
use Commercetools\Core\Model\ProductType\ProductTypeDraft;
use Commercetools\Core\Model\ProductType\ReferenceType;
use Commercetools\Core\Model\ProductType\StringType;
use Commercetools\Core\Request\CustomObjects\CustomObjectCreateRequest;
use Commercetools\Core\Request\CustomObjects\CustomObjectDeleteRequest;
use Commercetools\Core\Request\Products\ProductCreateRequest;
use Commercetools\Core\Request\Products\ProductDeleteRequest;
use Commercetools\Core\Request\Products\ProductProjectionByIdGetRequest;
use Commercetools\Core\Request\ProductTypes\Command\ProductTypeAddAttributeDefinitionAction;
use Commercetools\Core\Request\ProductTypes\Command\ProductTypeAddLocalizedEnumValueAction;
use Commercetools\Core\Request\ProductTypes\Command\ProductTypeAddPlainEnumValueAction;
use Commercetools\Core\Request\ProductTypes\Command\ProductTypeChangeAttributeConstraintAction;
use Commercetools\Core\Request\ProductTypes\Command\ProductTypeChangeAttributeNameAction;
use Commercetools\Core\Request\ProductTypes\Command\ProductTypeChangeAttributeOrderByNameAction;
use Commercetools\Core\Request\ProductTypes\Command\ProductTypeChangeDescriptionAction;
use Commercetools\Core\Request\ProductTypes\Command\ProductTypeChangeEnumKeyAction;
use Commercetools\Core\Request\ProductTypes\Command\ProductTypeChangeInputHintAction;
use Commercetools\Core\Request\ProductTypes\Command\ProductTypeChangeIsSearchableAction;
use Commercetools\Core\Request\ProductTypes\Command\ProductTypeChangeLabelAction;
use Commercetools\Core\Request\ProductTypes\Command\ProductTypeChangeLocalizedEnumLabelAction;
use Commercetools\Core\Request\ProductTypes\Command\ProductTypeChangeNameAction;
use Commercetools\Core\Request\ProductTypes\Command\ProductTypeChangePlainEnumLabelAction;
use Commercetools\Core\Request\ProductTypes\Command\ProductTypeRemoveEnumValuesAction;
use Commercetools\Core\Request\ProductTypes\Command\ProductTypeSetInputTipAction;
use Commercetools\Core\Request\ProductTypes\Command\ProductTypeSetKeyAction;
use Commercetools\Core\Request\ProductTypes\ProductTypeCreateRequest;
use Commercetools\Core\Request\ProductTypes\ProductTypeDeleteRequest;
use Commercetools\Core\Request\ProductTypes\ProductTypeUpdateRequest;

class ProductTypeUpdateRequestTest extends ApiTestCase
{
    /**
     * @var ProductTypeDeleteRequest
     */
    private $productTypeDeleteRequest;

    /**
     * @return ProductTypeDraft
     */
    protected function getDraft($name)
    {
        $draft = ProductTypeDraft::ofNameAndDescription(
            'test-' . $this->getTestRun() . '-' . $name,
            'test-' . $this->getTestRun() . '-description'
        );
        $draft->setKey('key-' . $this->getTestRun());

        return $draft;
    }

    protected function createProductType(ProductTypeDraft $draft)
    {
        $request = ProductTypeCreateRequest::ofDraft($draft);
        $response = $request->executeWithClient($this->getClient());
        $productType = $request->mapResponse($response);
        $this->cleanupRequests[] = $this->productTypeDeleteRequest = ProductTypeDeleteRequest::ofIdAndVersion(
            $productType->getId(),
            $productType->getVersion()
        );

        return $productType;
    }

    private function getAttributeDefinition($name, $type)
    {
        $definition = AttributeDefinition::of()
            ->setName($name)
            ->setLabel(LocalizedString::ofLangAndText('en', $name))
            ->setIsRequired(false)
            ->setType($type);

        return $definition;
    }

    public function testUpdateByKey()
    {
        $client = $this->getApiClient();

        ProductTypeFixture::withUpdateableProductType(
            $client,
            function (ProductType $productType) use ($client) {
                $name = 'test-' . ProductTypeFixture::uniqueProductTypeString() . '-new name';

                $request = RequestBuilder::of()->productTypes()->updateByKey($productType)
                    ->addAction(ProductTypeChangeNameAction::ofName($name));
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(ProductType::class, $result);
                $this->assertSame($name, $result->getName());

                return $result;
            }
        );
    }

    public function testSetKey()
    {
        $client = $this->getApiClient();

        ProductTypeFixture::withUpdateableProductType(
            $client,
            function (ProductType $productType) use ($client) {
                $key = 'new-' . ProductTypeFixture::uniqueProductTypeString();

                $request = RequestBuilder::of()->productTypes()->update($productType)
                    ->addAction(ProductTypeSetKeyAction::ofKey($key));
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(ProductType::class, $result);
                $this->assertSame($key, $result->getKey());
                $this->assertNotSame($productType->getVersion(), $result->getVersion());

                return $result;
            }
        );
    }

    public function testSetKeyLength()
    {
        $client = $this->getApiClient();

        ProductTypeFixture::withUpdateableDraftProductType(
            $client,
            function (ProductTypeDraft $draft) {
                return $draft->setKey(str_pad($draft->getKey(), 256, '0'));
            },
            function (ProductType $productType) use ($client) {
                $key = str_pad('new-' . ProductTypeFixture::uniqueProductTypeString(), 256, '0');

                $request = RequestBuilder::of()->productTypes()->update($productType)
                    ->addAction(ProductTypeSetKeyAction::ofKey($key));
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(ProductType::class, $result);
                $this->assertSame($key, $result->getKey());
                $this->assertNotSame($productType->getVersion(), $result->getVersion());

                return $result;
            }
        );
    }

    public function testChangeName()
    {
        $client = $this->getApiClient();

        ProductTypeFixture::withUpdateableDraftProductType(
            $client,
            function (ProductTypeDraft $draft) {
                return $draft->setKey(str_pad($draft->getKey(), 256, '0'));
            },
            function (ProductType $productType) use ($client) {
                $name = 'test-' . ProductTypeFixture::uniqueProductTypeString() . '-new name';

                $request = RequestBuilder::of()->productTypes()->update($productType)
                    ->addAction(ProductTypeChangeNameAction::ofName($name));
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(ProductType::class, $result);
                $this->assertSame($name, $result->getName());
                $this->assertNotSame($productType->getVersion(), $result->getVersion());

                return $result;
            }
        );
    }

    public function testChangeDescription()
    {
        $client = $this->getApiClient();

        ProductTypeFixture::withUpdateableProductType(
            $client,
            function (ProductType $productType) use ($client) {
                $description = 'test-' . ProductTypeFixture::uniqueProductTypeString() . '-new description';

                $request = RequestBuilder::of()->productTypes()->update($productType)
                    ->addAction(ProductTypeChangeDescriptionAction::ofDescription($description));
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(ProductType::class, $result);
                $this->assertSame($description, $result->getDescription());
                $this->assertNotSame($productType->getVersion(), $result->getVersion());

                return $result;
            }
        );
    }

    public function testAttributeDefinition()
    {
        $client = $this->getApiClient();

        ProductTypeFixture::withUpdateableProductType(
            $client,
            function (ProductType $productType) use ($client) {
                $name = 'testField-' . ProductTypeFixture::uniqueProductTypeString();
                $type = StringType::of();
                $definition = $this->getAttributeDefinition($name, $type);

                $request = RequestBuilder::of()->productTypes()->update($productType)
                    ->addAction(ProductTypeAddAttributeDefinitionAction::ofAttribute($definition));
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(ProductType::class, $result);
                $this->assertSame($definition->getName(), $result->getAttributes()->current()->getName());
                $this->assertNotSame($productType->getVersion(), $result->getVersion());

                $productType = $result;
                $label = 'new label';

                $request = RequestBuilder::of()->productTypes()->update($productType)
                    ->addAction(
                        ProductTypeChangeLabelAction::ofAttributeNameAndLabel(
                            $name,
                            LocalizedString::ofLangAndText('en', $label)
                        )
                    );
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(ProductType::class, $result);
                $this->assertSame($label, $result->getAttributes()->current()->getLabel()->en);
                $this->assertNotSame($productType->getVersion(), $result->getVersion());

                $productType = $result;
                $inputTip = 'new tip';

                $request = RequestBuilder::of()->productTypes()->update($productType)
                    ->addAction(
                        ProductTypeSetInputTipAction::ofAttributeName(
                            $name
                        )->setInputTip(LocalizedString::ofLangAndText('en', $inputTip))
                    );
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(ProductType::class, $result);
                $this->assertNotSame($productType->getVersion(), $result->getVersion());

                return $result;
            }
        );
    }

    public function testEnumAttributeDefinition()
    {
        $client = $this->getApiClient();

        ProductTypeFixture::withUpdateableProductType(
            $client,
            function (ProductType $productType) use ($client) {
                $name = 'testEnumField-' . ProductTypeFixture::uniqueProductTypeString();
                $type = EnumType::of()->setValues(EnumCollection::of());
                $definition = $this->getAttributeDefinition($name, $type);

                $request = RequestBuilder::of()->productTypes()->update($productType)
                    ->addAction(ProductTypeAddAttributeDefinitionAction::ofAttribute($definition));
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $productType = $result;
                $enum = Enum::of()->setKey('test')->setLabel('test');

                $request = RequestBuilder::of()->productTypes()->update($productType)
                    ->addAction(
                        ProductTypeAddPlainEnumValueAction::ofAttributeNameAndValue($name, $enum)
                    );
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(ProductType::class, $result);
                /**
                 * @var EnumType $type
                 */
                $type = $result->getAttributes()->current()->getType();
                $this->assertSame($enum->getKey(), $type->getValues()->current()->getKey());
                $this->assertNotSame($productType->getVersion(), $result->getVersion());

                return $result;
            }
        );
    }

    public function testReferenceAttributeDefinition()
    {
        $client = $this->getApiClient();

        ProductTypeFixture::withUpdateableProductType(
            $client,
            function (ProductType $productType) use ($client) {
                $name = 'testCustomObject-' . ProductTypeFixture::uniqueProductTypeString();
                $type = ReferenceType::of()->setReferenceTypeId(CustomObjectReference::TYPE_CUSTOM_OBJECT);
                $definition = $this->getAttributeDefinition($name, $type);

                $request = RequestBuilder::of()->productTypes()->update($productType)
                    ->addAction(
                        ProductTypeAddAttributeDefinitionAction::ofAttribute($definition)
                    );
                $response = $this->execute($client, $request);
                $productTypeResult = $request->mapFromResponse($response);

                $this->assertInstanceOf(ProductType::class, $productTypeResult);
                $this->assertNotSame($productType->getVersion(), $productTypeResult->getVersion());

                CustomObjectFixture::withDraftCustomObject(
                    $client,
                    function (CustomObjectDraft $customObjectDraft) {
                        return $customObjectDraft->setContainer('test')->setKey('key')->setValue(uniqid());
                    },
                    function (CustomObject $customObject) use ($client, $productTypeResult, $name) {
                        ProductFixture::withDraftProduct(
                            $client,
                            function (ProductDraft $productDraft) use ($productTypeResult, $customObject, $name) {
                                return $productDraft->setProductType($productTypeResult->getReference())
                                    ->setName(LocalizedString::ofLangAndText('en', 'test'))
                                    ->setSlug(LocalizedString::ofLangAndText('en', uniqid()))
                                    ->setMasterVariant(
                                        ProductVariantDraft::of()->setAttributes(
                                            AttributeCollection::of()
                                                ->add(
                                                    Attribute::of()
                                                        ->setName($name)
                                                        ->setValue($customObject->getReference())
                                                )
                                        )
                                    );
                            },
                            function (Product $product) use ($client, $customObject, $productTypeResult, $name) {
                                $request = RequestBuilder::of()->productProjections()->getById($product->getId())
                                    ->expand('masterVariant.attributes[*].value')
                                    ->staged(true);
                                $response = $this->execute($client, $request);
                                $result = $request->mapFromResponse($response);

                                $variant = $result->getMasterVariant();
                                $this->assertSame(
                                    $customObject->getId(),
                                    $variant->getAttributes()->getByName($name)->getValue()->getId()
                                );
                                $this->assertInstanceOf(
                                    CustomObject::class,
                                    $variant->getAttributes()->getByName($name)->getValue()->getObj()
                                );
                                $this->assertSame(
                                    $customObject->getValue(),
                                    $variant->getAttributes()->getByName($name)->getValue()->getObj()->getValue()
                                );

                                return $result;
                            }
                        );
                    }
                );
            }
        );
    }

    public function testLocalizedEnumAttributeDefinition()
    {
        $client = $this->getApiClient();

        ProductTypeFixture::withUpdateableProductType(
            $client,
            function (ProductType $productType) use ($client) {
                $name = 'testLocalizedEnumField-' . ProductTypeFixture::uniqueProductTypeString();
                $type = LocalizedEnumType::of()->setValues(LocalizedEnumCollection::of());
                $definition = $this->getAttributeDefinition($name, $type);

                $request = RequestBuilder::of()->productTypes()->update($productType)
                    ->addAction(ProductTypeAddAttributeDefinitionAction::ofAttribute($definition));
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $productType = $result;
                $enum = LocalizedEnum::of()->setKey('test')->setLabel(LocalizedString::ofLangAndText('en', 'test'));

                $request = RequestBuilder::of()->productTypes()->update($productType)
                    ->addAction(ProductTypeAddLocalizedEnumValueAction::ofAttributeNameAndValue(
                        $name,
                        $enum
                    ));
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(ProductType::class, $result);
                /**
                 * @var LocalizedEnumType $type
                 */
                $type = $result->getAttributes()->current()->getType();
                $this->assertSame($enum->getLabel()->en, $type->getValues()->current()->getLabel()->en);
                $this->assertNotSame($productType->getVersion(), $result->getVersion());

                return $result;
            }
        );
    }

    public function testLocalizedEnumChangeLabel()
    {
        $client = $this->getApiClient();
        $name = 'testLocalizedEnumField-' . ProductTypeFixture::uniqueProductTypeString();

        ProductTypeFixture::withUpdateableDraftProductType(
            $client,
            function (ProductTypeDraft $draft) use ($name) {
                $type = LocalizedEnumType::of()
                    ->setValues(
                        LocalizedEnumCollection::of()->add(
                            LocalizedEnum::of()->setKey('test')
                                ->setLabel(LocalizedString::ofLangAndText('en', 'test'))
                        )
                    );
                $definition = $this->getAttributeDefinition($name, $type);

                return $draft->setAttributes(AttributeDefinitionCollection::of()->add($definition));
            },
            function (ProductType $productType) use ($client, $name) {
                $request = RequestBuilder::of()->productTypes()->update($productType)
                    ->addAction(ProductTypeChangeLocalizedEnumLabelAction::ofAttributeNameAndEnumValue(
                        $name,
                        LocalizedEnum::of()->setKey('test')->setLabel(LocalizedString::ofLangAndText('en', 'new-test'))
                    ));
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(ProductType::class, $result);
                $this->assertNotSame($productType->getVersion(), $result->getVersion());
                $this->assertSame(
                    'new-test',
                    $result->getAttributes()->current()->getType()->getValues()->current()->getLabel()->en
                );

                return $result;
            }
        );
    }

    public function testLocalizedEnumDontChangeLabel()
    {
        $client = $this->getApiClient();
        $name = 'testLocalizedEnumField-' . ProductTypeFixture::uniqueProductTypeString();
        $this->expectException(FixtureException::class);
        $this->expectExceptionCode(400);

        ProductTypeFixture::withUpdateableDraftProductType(
            $client,
            function (ProductTypeDraft $draft) use ($name) {
                $type = LocalizedEnumType::of()
                    ->setValues(
                        LocalizedEnumCollection::of()->add(
                            LocalizedEnum::of()->setKey('test')->setLabel(LocalizedString::ofLangAndText('en', 'test'))
                        )
                    );
                $definition = $this->getAttributeDefinition($name, $type)->setIsRequired(false);

                return $draft->setAttributes(AttributeDefinitionCollection::of()->add($definition));
            },
            function (ProductType $productType) use ($client, $name) {
                $request = RequestBuilder::of()->productTypes()->update($productType)
                    ->addAction(
                        ProductTypeChangeLocalizedEnumLabelAction::ofAttributeNameAndEnumValue(
                            'testLocalizedEnumField',
                            LocalizedEnum::of()->setKey('test')->setLabel(LocalizedString::ofLangAndText('en', 'test'))
                        )
                    );
                $response = $this->execute($client, $request);

                return $request->mapFromResponse($response);
            }
        );
    }

    public function testPlainEnumChangeLabel()
    {
        $client = $this->getApiClient();
        $name = 'testPlainEnumField-' . ProductTypeFixture::uniqueProductTypeString();

        ProductTypeFixture::withUpdateableDraftProductType(
            $client,
            function (ProductTypeDraft $draft) use ($name) {
                $type = EnumType::of()
                    ->setValues(
                        EnumCollection::of()->add(
                            Enum::of()->setKey('test')->setLabel('test')
                        )
                    );
                $definition = $this->getAttributeDefinition($name, $type);

                return $draft->setAttributes(AttributeDefinitionCollection::of()->add($definition));
            },
            function (ProductType $productType) use ($client, $name) {
                $request = RequestBuilder::of()->productTypes()->update($productType)
                    ->addAction(
                        ProductTypeChangePlainEnumLabelAction::ofAttributeNameAndEnumValue(
                            $name,
                            Enum::of()->setKey('test')->setLabel('new-test')
                        )
                    );
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(ProductType::class, $result);
                $this->assertNotSame($productType->getVersion(), $result->getVersion());
                $this->assertSame(
                    'new-test',
                    $result->getAttributes()->current()->getType()->getValues()->current()->getLabel()
                );

                return $result;
            }
        );
    }

    public function testPlainEnumDontChangeLabel()
    {
        $client = $this->getApiClient();
        $name = 'testPlainEnumField-' . ProductTypeFixture::uniqueProductTypeString();
        $this->expectException(FixtureException::class);
        $this->expectExceptionCode(400);

        ProductTypeFixture::withUpdateableDraftProductType(
            $client,
            function (ProductTypeDraft $draft) use ($name) {
                $type = EnumType::of()
                    ->setValues(
                        EnumCollection::of()->add(
                            Enum::of()->setKey('test')->setLabel('test')
                        )
                    );
                $definition = $this->getAttributeDefinition($name, $type)->setIsRequired(false);

                return $draft->setAttributes(AttributeDefinitionCollection::of()->add($definition));
            },
            function (ProductType $productType) use ($client, $name) {
                $request = RequestBuilder::of()->productTypes()->update($productType)
                    ->addAction(
                        ProductTypeChangePlainEnumLabelAction::ofAttributeNameAndEnumValue(
                            $name,
                            Enum::of()->setKey('test')->setLabel('test')
                        )
                    );
                $response = $this->execute($client, $request);

                return $request->mapFromResponse($response);
            }
        );
    }

    public function testChangeSearchable()
    {
        $client = $this->getApiClient();

        ProductTypeFixture::withUpdateableProductType(
            $client,
            function (ProductType $productType) use ($client) {
                $name = 'testField-' . ProductTypeFixture::uniqueProductTypeString();
                $type = StringType::of();
                $definition = $this->getAttributeDefinition($name, $type)->setIsSearchable(false);

                $request = RequestBuilder::of()->productTypes()->update($productType)
                    ->addAction(ProductTypeAddAttributeDefinitionAction::ofAttribute($definition));
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(ProductType::class, $result);
                $this->assertSame($definition->getName(), $result->getAttributes()->current()->getName());
                $this->assertNotSame($productType->getVersion(), $result->getVersion());

                $productType = $result;
                $searchable = true;

                $request = RequestBuilder::of()->productTypes()->update($productType)
                    ->addAction(
                        ProductTypeChangeIsSearchableAction::ofAttributeNameAndIsSearchable($name, $searchable)
                    );
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(ProductType::class, $result);
                $this->assertSame($searchable, $result->getAttributes()->current()->getIsSearchable());
                $this->assertNotSame($productType->getVersion(), $result->getVersion());

                return $result;
            }
        );
    }

    public function testChangeInputHint()
    {
        $client = $this->getApiClient();

        ProductTypeFixture::withUpdateableProductType(
            $client,
            function (ProductType $productType) use ($client) {
                $name = 'testField-' . ProductTypeFixture::uniqueProductTypeString();
                $type = StringType::of();
                $definition = $this->getAttributeDefinition($name, $type)
                    ->setIsSearchable(false)->setInputHint('SingleLine');

                $request = RequestBuilder::of()->productTypes()->update($productType)
                    ->addAction(ProductTypeAddAttributeDefinitionAction::ofAttribute($definition));
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(ProductType::class, $result);
                $this->assertSame($definition->getName(), $result->getAttributes()->current()->getName());
                $this->assertNotSame($productType->getVersion(), $result->getVersion());

                $productType = $result;
                $inputHint = 'MultiLine';

                $request = RequestBuilder::of()->productTypes()->update($productType)
                    ->addAction(
                        ProductTypeChangeInputHintAction::ofAttributeNameAndInputHint($name, $inputHint)
                    );
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(ProductType::class, $result);
                $this->assertSame($inputHint, $result->getAttributes()->current()->getInputHint());
                $this->assertNotSame($productType->getVersion(), $result->getVersion());

                return $result;
            }
        );
    }

    public function testChangeConstraint()
    {
        $client = $this->getApiClient();

        ProductTypeFixture::withUpdateableProductType(
            $client,
            function (ProductType $productType) use ($client) {
                $name = 'testConstraintField-' . ProductTypeFixture::uniqueProductTypeString();
                $type = StringType::of();
                $definition = $this->getAttributeDefinition($name, $type)
                    ->setIsSearchable(false)->setAttributeConstraint('SameForAll');

                $request = RequestBuilder::of()->productTypes()->update($productType)
                    ->addAction(ProductTypeAddAttributeDefinitionAction::ofAttribute($definition));
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(ProductType::class, $result);
                $this->assertSame($definition->getName(), $result->getAttributes()->current()->getName());
                $this->assertSame('SameForAll', $result->getAttributes()->current()->getAttributeConstraint());
                $this->assertNotSame($productType->getVersion(), $result->getVersion());

                $productType = $result;
                $constraint = 'None';

                $request = RequestBuilder::of()->productTypes()->update($productType)
                    ->addAction(
                        ProductTypeChangeAttributeConstraintAction::ofAttributeNameAndAttributeConstraint(
                            $name,
                            $constraint
                        )
                    );
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(ProductType::class, $result);
                $this->assertSame($constraint, $result->getAttributes()->current()->getAttributeConstraint());
                $this->assertNotSame($productType->getVersion(), $result->getVersion());

                return $result;
            }
        );
    }

    public function testRemoveEnumValues()
    {
        $client = $this->getApiClient();
        $name = 'testEnumField' . ProductTypeFixture::uniqueProductTypeString();

        ProductTypeFixture::withUpdateableDraftProductType(
            $client,
            function (ProductTypeDraft $draft) use ($name) {
                $type = EnumType::of()->setValues(
                    EnumCollection::of()
                        ->add(Enum::of()->setKey('foo')->setLabel('foo'))
                        ->add(Enum::of()->setKey('bar')->setLabel('bar'))
                );
                $definition = $this->getAttributeDefinition($name, $type);

                return $draft->setAttributes(AttributeDefinitionCollection::of()->add($definition));
            },
            function (ProductType $productType) use ($client, $name) {
                $this->assertInstanceOf(ProductType::class, $productType);
                /**
                 * @var EnumType $attributeType
                 */
                $attributeType = $productType->getAttributes()->current()->getType();
                $this->assertCount(2, $attributeType->getValues());


                $request = RequestBuilder::of()->productTypes()->update($productType)
                    ->addAction(
                        ProductTypeRemoveEnumValuesAction::ofAttributeNameAndKeys($name, ['foo'])
                    );
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(ProductType::class, $result);
                /**
                 * @var EnumType $type
                 */
                $type = $result->getAttributes()->current()->getType();
                $this->assertCount(1, $type->getValues());
                $this->assertSame('bar', $type->getValues()->current()->getKey());

                return $result;
            }
        );
    }

    public function testChangeAttributeName()
    {
        $client = $this->getApiClient();
        $name = 'testNameField-' . ProductTypeFixture::uniqueProductTypeString();

        ProductTypeFixture::withUpdateableDraftProductType(
            $client,
            function (ProductTypeDraft $draft) use ($name) {
                $type = StringType::of();
                $definition = $this->getAttributeDefinition($name, $type)->setIsSearchable(false);

                return $draft->setAttributes(AttributeDefinitionCollection::of()->add($definition));
            },
            function (ProductType $productType) use ($client, $name) {
                $this->assertInstanceOf(ProductType::class, $productType);
                $this->assertSame($name, $productType->getAttributes()->getByName($name)->getName());

                $newAttributeName = 'new' . ucfirst($name);

                $request = RequestBuilder::of()->productTypes()->update($productType)
                    ->addAction(
                        ProductTypeChangeAttributeNameAction::ofAttributeName(
                            $productType->getAttributes()->getByName($name)->getName(),
                            $newAttributeName
                        )
                    );
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(ProductType::class, $result);
                $this->assertSame($newAttributeName, $result->getAttributes()->current()->getName());
                $this->assertSame($newAttributeName, $result->getAttributes()->getByName($newAttributeName)->getName());
                $this->assertNull($result->getAttributes()->getByName($name));

                return $result;
            }
        );
    }

    public function testChangeAttributeOrderByName()
    {
        $client = $this->getApiClient();
        $name = 'testNameField-1-' . ProductTypeFixture::uniqueProductTypeString();
        $name2 = 'testNameField-2-' . ProductTypeFixture::uniqueProductTypeString();

        ProductTypeFixture::withUpdateableDraftProductType(
            $client,
            function (ProductTypeDraft $draft) use ($name, $name2) {
                $type = StringType::of();
                $definition = $this->getAttributeDefinition($name, $type)->setIsSearchable(false);
                $definition2 = $this->getAttributeDefinition($name2, $type)->setIsSearchable(false);

                $attributeCollection = AttributeDefinitionCollection::of()->add($definition)->add($definition2);

                return $draft->setAttributes($attributeCollection);
            },
            function (ProductType $productType) use ($client, $name, $name2) {
                $this->assertInstanceOf(ProductType::class, $productType);
                $this->assertSame($name, $productType->getAttributes()->current()->getName());
                $this->assertSame($name2, $productType->getAttributes()->getAt(1)->getName());

                $request = RequestBuilder::of()->productTypes()->update($productType)
                    ->addAction(
                        ProductTypeChangeAttributeOrderByNameAction::ofAttributeNames([$name2, $name])
                    );
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(ProductType::class, $result);
                $this->assertSame($name2, $result->getAttributes()->current()->getName());
                $this->assertSame($name, $result->getAttributes()->getAt(1)->getName());

                return $result;
            }
        );
    }

    public function testChangeEnumKey()
    {
        $client = $this->getApiClient();
        $name = 'testNameField' . ProductTypeFixture::uniqueProductTypeString();
        $keyName = 'foo';

        ProductTypeFixture::withUpdateableDraftProductType(
            $client,
            function (ProductTypeDraft $draft) use ($name) {
                $keyName = 'foo';
                $type = EnumType::of()->setValues(
                    EnumCollection::of()
                        ->add(Enum::of()->setKey('foo')->setLabel('foo'))
                );
                $definition = $this->getAttributeDefinition($name, $type)->setIsSearchable(false);

                return $draft->setAttributes(AttributeDefinitionCollection::of()->add($definition));
            },
            function (ProductType $productType) use ($client, $name, $keyName) {
                $this->assertInstanceOf(ProductType::class, $productType);
                /**
                 * @var EnumType $enumType
                 */
                $enumType = $productType->getAttributes()->getByName($name)->getType();
                $this->assertSame($keyName, $enumType->getValues()->getByKey($keyName)->getKey());

                $newKeyName = 'new-foo';

                $request = RequestBuilder::of()->productTypes()->update($productType)
                    ->addAction(
                        ProductTypeChangeEnumKeyAction::ofAttributeNameAndEnumKey(
                            $productType->getAttributes()->getByName($name)->getName(),
                            $keyName,
                            $newKeyName
                        )
                    );
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(ProductType::class, $result);
                /**
                 * @var EnumType $enumType
                 */
                $enumType = $result->getAttributes()->getByName($name)->getType();
                $this->assertSame($newKeyName, $enumType->getValues()->getByKey($newKeyName)->getKey());
                $this->assertNull($enumType->getValues()->getByKey($keyName));

                return $result;
            }
        );
    }
}
