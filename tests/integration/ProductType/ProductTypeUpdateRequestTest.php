<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */


namespace Commercetools\Core\ProductType;

use Commercetools\Core\ApiTestCase;
use Commercetools\Core\Error\InvalidOperationError;
use Commercetools\Core\Model\Common\Attribute;
use Commercetools\Core\Model\Common\AttributeCollection;
use Commercetools\Core\Model\Common\Enum;
use Commercetools\Core\Model\Common\EnumCollection;
use Commercetools\Core\Model\Common\LocalizedEnum;
use Commercetools\Core\Model\Common\LocalizedEnumCollection;
use Commercetools\Core\Model\Common\LocalizedString;
use Commercetools\Core\Model\Common\Reference;
use Commercetools\Core\Model\CustomObject\CustomObject;
use Commercetools\Core\Model\CustomObject\CustomObjectDraft;
use Commercetools\Core\Model\CustomObject\CustomObjectReference;
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
use Commercetools\Core\Request\CustomObjects\CustomObjectDeleteByKeyRequest;
use Commercetools\Core\Request\CustomObjects\CustomObjectDeleteRequest;
use Commercetools\Core\Request\Products\Command\ProductPublishAction;
use Commercetools\Core\Request\Products\ProductCreateRequest;
use Commercetools\Core\Request\Products\ProductDeleteRequest;
use Commercetools\Core\Request\Products\ProductProjectionByIdGetRequest;
use Commercetools\Core\Request\Products\ProductUpdateRequest;
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
use Commercetools\Core\Request\ProductTypes\Command\ProductTypeRemoveAttributeDefinitionAction;
use Commercetools\Core\Request\ProductTypes\Command\ProductTypeRemoveEnumValuesAction;
use Commercetools\Core\Request\ProductTypes\Command\ProductTypeSetInputTipAction;
use Commercetools\Core\Request\ProductTypes\Command\ProductTypeSetKeyAction;
use Commercetools\Core\Request\ProductTypes\ProductTypeCreateRequest;
use Commercetools\Core\Request\ProductTypes\ProductTypeDeleteRequest;
use Commercetools\Core\Request\ProductTypes\ProductTypeUpdateByKeyRequest;
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

    public function testUpdateByKey()
    {
        $draft = $this->getDraft('update-by-key');
        $productType = $this->createProductType($draft);

        $name = 'test-' . $this->getTestRun() . '-new name';
        $request = ProductTypeUpdateByKeyRequest::ofKeyAndVersion($productType->getKey(), $productType->getVersion())
            ->addAction(
                ProductTypeChangeNameAction::ofName($name)
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->productTypeDeleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf(ProductType::class, $result);
        $this->assertSame($name, $result->getName());
    }

    public function testSetKey()
    {
        $draft = $this->getDraft('set-key');
        $productType = $this->createProductType($draft);

        $key = 'new-' . $this->getTestRun();
        $request = ProductTypeUpdateRequest::ofIdAndVersion($productType->getId(), $productType->getVersion())
            ->addAction(
                ProductTypeSetKeyAction::ofKey($key)
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->productTypeDeleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf(ProductType::class, $result);
        $this->assertSame($key, $result->getKey());
        $this->assertNotSame($productType->getVersion(), $result->getVersion());
    }

    public function testSetKeyLength()
    {
        $draft = $this->getDraft('set-key');
        $draft->setKey(str_pad($draft->getKey(), 256, '0'));
        $productType = $this->createProductType($draft);

        $key = str_pad('new-' . $this->getTestRun(), 256, '0');
        $request = ProductTypeUpdateRequest::ofIdAndVersion($productType->getId(), $productType->getVersion())
            ->addAction(
                ProductTypeSetKeyAction::ofKey($key)
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->productTypeDeleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf(ProductType::class, $result);
        $this->assertSame($key, $result->getKey());
        $this->assertNotSame($productType->getVersion(), $result->getVersion());
    }

    public function testChangeName()
    {
        $draft = $this->getDraft('change-name');
        $productType = $this->createProductType($draft);

        $name = 'test-' . $this->getTestRun() . '-new name';
        $request = ProductTypeUpdateRequest::ofIdAndVersion($productType->getId(), $productType->getVersion())
            ->addAction(
                ProductTypeChangeNameAction::ofName($name)
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->productTypeDeleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf(ProductType::class, $result);
        $this->assertSame($name, $result->getName());
        $this->assertNotSame($productType->getVersion(), $result->getVersion());
    }

    public function testChangeDescription()
    {
        $draft = $this->getDraft('change-description');
        $productType = $this->createProductType($draft);

        $description = 'test-' . $this->getTestRun() . '-new description';
        $request = ProductTypeUpdateRequest::ofIdAndVersion($productType->getId(), $productType->getVersion())
            ->addAction(
                ProductTypeChangeDescriptionAction::ofDescription($description)
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->productTypeDeleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf(ProductType::class, $result);
        $this->assertSame($description, $result->getDescription());
        $this->assertNotSame($productType->getVersion(), $result->getVersion());
    }

    public function testAttributeDefinition()
    {
        $draft = $this->getDraft('attribute-definition');
        $productType = $this->createProductType($draft);

        $definition = AttributeDefinition::of()
            ->setName('testField')
            ->setLabel(LocalizedString::ofLangAndText('en', 'testField'))
            ->setIsRequired(false)
            ->setType(StringType::of())
        ;
        $request = ProductTypeUpdateRequest::ofIdAndVersion($productType->getId(), $productType->getVersion())
            ->addAction(
                ProductTypeAddAttributeDefinitionAction::ofAttribute($definition)
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->productTypeDeleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf(ProductType::class, $result);
        $this->assertSame($definition->getName(), $result->getAttributes()->current()->getName());
        $this->assertNotSame($productType->getVersion(), $result->getVersion());
        $productType = $result;

        $label = 'new label';
        $request = ProductTypeUpdateRequest::ofIdAndVersion($productType->getId(), $productType->getVersion())
            ->addAction(
                ProductTypeChangeLabelAction::ofAttributeNameAndLabel(
                    'testField',
                    LocalizedString::ofLangAndText('en', $label)
                )
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->productTypeDeleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf(ProductType::class, $result);
        $this->assertSame($label, $result->getAttributes()->current()->getLabel()->en);
        $this->assertNotSame($productType->getVersion(), $result->getVersion());
        $productType = $result;

        $inputTip = 'new tip';
        $request = ProductTypeUpdateRequest::ofIdAndVersion($productType->getId(), $productType->getVersion())
            ->addAction(
                ProductTypeSetInputTipAction::ofAttributeName(
                    'testField'
                )->setInputTip(LocalizedString::ofLangAndText('en', $inputTip))
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->productTypeDeleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf(ProductType::class, $result);
        $this->assertSame($inputTip, $result->getAttributes()->current()->getInputTip()->en);
        $this->assertNotSame($productType->getVersion(), $result->getVersion());
        $productType = $result;

        $request = ProductTypeUpdateRequest::ofIdAndVersion($productType->getId(), $productType->getVersion())
            ->addAction(
                ProductTypeRemoveAttributeDefinitionAction::ofName(
                    'testField'
                )
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->productTypeDeleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf(ProductType::class, $result);
        $this->assertEmpty($result->getAttributes());
        $this->assertNotSame($productType->getVersion(), $result->getVersion());
    }

    public function testEnumAttributeDefinition()
    {
        $draft = $this->getDraft('enum-attribute-definition');
        $productType = $this->createProductType($draft);

        $definition = AttributeDefinition::of()
            ->setName('testEnumField')
            ->setLabel(LocalizedString::ofLangAndText('en', 'testEnumField'))
            ->setIsRequired(false)
            ->setType(EnumType::of()->setValues(EnumCollection::of()));
        $request = ProductTypeUpdateRequest::ofIdAndVersion($productType->getId(), $productType->getVersion())
            ->addAction(
                ProductTypeAddAttributeDefinitionAction::ofAttribute($definition)
            );
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->productTypeDeleteRequest->setVersion($result->getVersion());
        $productType = $result;

        $enum = Enum::of()->setKey('test')->setLabel('test');
        $request = ProductTypeUpdateRequest::ofIdAndVersion($productType->getId(), $productType->getVersion())
            ->addAction(
                ProductTypeAddPlainEnumValueAction::ofAttributeNameAndValue(
                    'testEnumField',
                    $enum
                )
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->productTypeDeleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf(ProductType::class, $result);
        /**
         * @var EnumType $type
         */
        $type = $result->getAttributes()->current()->getType();
        $this->assertSame($enum->getKey(), $type->getValues()->current()->getKey());
        $this->assertNotSame($productType->getVersion(), $result->getVersion());
    }

    public function testReferenceAttributeDefinition()
    {
        $draft = $this->getDraft('reference-attribute-definition');
        $productType = $this->createProductType($draft);

        $definition = AttributeDefinition::of()
            ->setName('testCustomObject')
            ->setLabel(LocalizedString::ofLangAndText('en', 'testCustomObject'))
            ->setIsRequired(false)
            ->setType(ReferenceType::of()->setReferenceTypeId(CustomObjectReference::TYPE_CUSTOM_OBJECT));
        $request = ProductTypeUpdateRequest::ofIdAndVersion($productType->getId(), $productType->getVersion())
            ->addAction(
                ProductTypeAddAttributeDefinitionAction::ofAttribute($definition)
            );
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->productTypeDeleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf(ProductType::class, $result);
        $this->assertNotSame($productType->getVersion(), $result->getVersion());

        $customObjectDraft = CustomObjectDraft::ofContainerKeyAndValue('test', 'key', uniqid());
        $request = CustomObjectCreateRequest::ofObject($customObjectDraft);
        $response = $request->executeWithClient($this->getClient());
        $customObject = $request->mapResponse($response);

        $productDraft = ProductDraft::ofTypeNameAndSlug(
            $result->getReference(),
            LocalizedString::ofLangAndText('en', 'test'),
            LocalizedString::ofLangAndText('en', uniqid())
        );
        $productDraft->setMasterVariant(
            ProductVariantDraft::of()->setAttributes(
                AttributeCollection::of()
                    ->add(
                        Attribute::of()
                            ->setName('testCustomObject')
                            ->setValue(
                                $customObject->getReference()
                            )
                    )
            )
        );

        $request = ProductCreateRequest::ofDraft($productDraft);
        $response = $request->executeWithClient($this->getClient());
        $product = $request->mapResponse($response);

        $request = ProductProjectionByIdGetRequest::ofId($product->getId())
            ->expand('masterVariant.attributes[*].value')
            ->staged(true)
        ;
        $response = $request->executeWithClient($this->getClient());
        $product = $request->mapResponse($response);

        $variant = $product->getMasterVariant();
        $this->assertSame(
            $customObject->getId(),
            $variant->getAttributes()->getByName('testCustomObject')->getValue()->getId()
        );
        $this->assertInstanceOf(
            CustomObject::class,
            $variant->getAttributes()->getByName('testCustomObject')->getValue()->getObj()
        );
        $this->assertSame(
            $customObjectDraft->getValue(),
            $variant->getAttributes()->getByName('testCustomObject')->getValue()->getObj()->getValue()
        );

        $request = ProductDeleteRequest::ofIdAndVersion($product->getId(), $product->getVersion());
        $response = $request->executeWithClient($this->getClient());

        $this->assertFalse($response->isError());

        $request = CustomObjectDeleteRequest::ofIdAndVersion($customObject->getId(), $customObject->getVersion());
        $response = $request->executeWithClient($this->getClient());

        $this->assertFalse($response->isError());
    }

    public function testLocalizedEnumAttributeDefinition()
    {
        $draft = $this->getDraft('enum-attribute-definition');
        $productType = $this->createProductType($draft);

        $definition = AttributeDefinition::of()
            ->setName('testLocalizedEnumField')
            ->setLabel(LocalizedString::ofLangAndText('en', 'testLocalizedEnumField'))
            ->setIsRequired(false)
            ->setType(LocalizedEnumType::of()->setValues(LocalizedEnumCollection::of()));
        $request = ProductTypeUpdateRequest::ofIdAndVersion($productType->getId(), $productType->getVersion())
            ->addAction(
                ProductTypeAddAttributeDefinitionAction::ofAttribute($definition)
            );
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->productTypeDeleteRequest->setVersion($result->getVersion());
        $productType = $result;

        $enum = LocalizedEnum::of()->setKey('test')->setLabel(LocalizedString::ofLangAndText('en', 'test'));
        $request = ProductTypeUpdateRequest::ofIdAndVersion($productType->getId(), $productType->getVersion())
            ->addAction(
                ProductTypeAddLocalizedEnumValueAction::ofAttributeNameAndValue(
                    'testLocalizedEnumField',
                    $enum
                )
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->productTypeDeleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf(ProductType::class, $result);
        /**
         * @var LocalizedEnumType $type
         */
        $type = $result->getAttributes()->current()->getType();
        $this->assertSame($enum->getLabel()->en, $type->getValues()->current()->getLabel()->en);
        $this->assertNotSame($productType->getVersion(), $result->getVersion());
    }

    public function testLocalizedEnumChangeLabel()
    {
        $definition = AttributeDefinition::of()
            ->setName('testLocalizedEnumField')
            ->setLabel(LocalizedString::ofLangAndText('en', 'testLocalizedEnumField'))
            ->setIsRequired(false)
            ->setType(LocalizedEnumType::of()
                ->setValues(
                    LocalizedEnumCollection::of()->add(
                        LocalizedEnum::of()->setKey('test')->setLabel(LocalizedString::ofLangAndText('en', 'test'))
                    )
                )
            );
        $draft = $this->getDraft('enum-change-label');
        $draft->setAttributes(AttributeDefinitionCollection::of()->add($definition));
        $productType = $this->createProductType($draft);

        $request = ProductTypeUpdateRequest::ofIdAndVersion($productType->getId(), $productType->getVersion())
            ->addAction(
                ProductTypeChangeLocalizedEnumLabelAction::ofAttributeNameAndEnumValue(
                    'testLocalizedEnumField',
                    LocalizedEnum::of()->setKey('test')->setLabel(LocalizedString::ofLangAndText('en', 'new-test'))
                )
            );
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->productTypeDeleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf(ProductType::class, $result);
        $this->assertNotSame($productType->getVersion(), $result->getVersion());

        $this->assertSame('new-test', $result->getAttributes()->current()->getType()->getValues()->current()->getLabel()->en);
    }

    public function testLocalizedEnumDontChangeLabel()
    {
        $definition = AttributeDefinition::of()
            ->setName('testLocalizedEnumField')
            ->setLabel(LocalizedString::ofLangAndText('en', 'testLocalizedEnumField'))
            ->setIsRequired(false)
            ->setType(LocalizedEnumType::of()
                ->setValues(
                    LocalizedEnumCollection::of()->add(
                        LocalizedEnum::of()->setKey('test')->setLabel(LocalizedString::ofLangAndText('en', 'test'))
                    )
                )
            );
        $draft = $this->getDraft('enum-change-label');
        $draft->setAttributes(AttributeDefinitionCollection::of()->add($definition));
        $productType = $this->createProductType($draft);

        $request = ProductTypeUpdateRequest::ofIdAndVersion($productType->getId(), $productType->getVersion())
            ->addAction(
                ProductTypeChangeLocalizedEnumLabelAction::ofAttributeNameAndEnumValue(
                    'testLocalizedEnumField',
                    LocalizedEnum::of()->setKey('test')->setLabel(LocalizedString::ofLangAndText('en', 'test'))
                )
            );
        $response = $request->executeWithClient($this->getClient());
        $this->assertTrue($response->isError());
        $this->assertInstanceOf(
            InvalidOperationError::class,
            $response->getErrors()->getByCode(InvalidOperationError::CODE)
        );
    }

    public function testPlainEnumChangeLabel()
    {
        $definition = AttributeDefinition::of()
            ->setName('testPlainEnumField')
            ->setLabel(LocalizedString::ofLangAndText('en', 'testPlainEnumField'))
            ->setIsRequired(false)
            ->setType(EnumType::of()
                ->setValues(
                    EnumCollection::of()->add(
                        Enum::of()->setKey('test')->setLabel('test')
                    )
                )
            );
        $draft = $this->getDraft('enum-change-label');
        $draft->setAttributes(AttributeDefinitionCollection::of()->add($definition));
        $productType = $this->createProductType($draft);

        $request = ProductTypeUpdateRequest::ofIdAndVersion($productType->getId(), $productType->getVersion())
            ->addAction(
                ProductTypeChangePlainEnumLabelAction::ofAttributeNameAndEnumValue(
                    'testPlainEnumField',
                    Enum::of()->setKey('test')->setLabel('new-test')
                )
            );
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->productTypeDeleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf(ProductType::class, $result);
        $this->assertNotSame($productType->getVersion(), $result->getVersion());

        $this->assertSame('new-test', $result->getAttributes()->current()->getType()->getValues()->current()->getLabel());
    }

    public function testPlainEnumDontChangeLabel()
    {
        $definition = AttributeDefinition::of()
            ->setName('testPlainEnumField')
            ->setLabel(LocalizedString::ofLangAndText('en', 'testPlainEnumField'))
            ->setIsRequired(false)
            ->setType(EnumType::of()
                ->setValues(
                    EnumCollection::of()->add(
                        Enum::of()->setKey('test')->setLabel('test')
                    )
                )
            );
        $draft = $this->getDraft('enum-change-label');
        $draft->setAttributes(AttributeDefinitionCollection::of()->add($definition));
        $productType = $this->createProductType($draft);

        $request = ProductTypeUpdateRequest::ofIdAndVersion($productType->getId(), $productType->getVersion())
            ->addAction(
                ProductTypeChangePlainEnumLabelAction::ofAttributeNameAndEnumValue(
                    'testPlainEnumField',
                    Enum::of()->setKey('test')->setLabel('test')
                )
            );
        $response = $request->executeWithClient($this->getClient());
        $this->assertTrue($response->isError());
        $this->assertInstanceOf(
            InvalidOperationError::class,
            $response->getErrors()->getByCode(InvalidOperationError::CODE)
        );
    }

    public function testChangeSearchable()
    {
        $draft = $this->getDraft('change-searchable');
        $productType = $this->createProductType($draft);

        $definition = AttributeDefinition::of()
            ->setName('testField')
            ->setLabel(LocalizedString::ofLangAndText('en', 'testField'))
            ->setIsRequired(false)
            ->setIsSearchable(false)
            ->setType(StringType::of())
        ;
        $request = ProductTypeUpdateRequest::ofIdAndVersion($productType->getId(), $productType->getVersion())
            ->addAction(
                ProductTypeAddAttributeDefinitionAction::ofAttribute($definition)
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->productTypeDeleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf(ProductType::class, $result);
        $this->assertSame($definition->getName(), $result->getAttributes()->current()->getName());
        $this->assertNotSame($productType->getVersion(), $result->getVersion());
        $productType = $result;

        $searchable = true;
        $request = ProductTypeUpdateRequest::ofIdAndVersion($productType->getId(), $productType->getVersion())
            ->addAction(
                ProductTypeChangeIsSearchableAction::ofAttributeNameAndIsSearchable(
                    'testField',
                    $searchable
                )
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->productTypeDeleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf(ProductType::class, $result);
        $this->assertSame($searchable, $result->getAttributes()->current()->getIsSearchable());
        $this->assertNotSame($productType->getVersion(), $result->getVersion());
    }

    public function testChangeInputHint()
    {
        $draft = $this->getDraft('change-inputHint');
        $productType = $this->createProductType($draft);

        $definition = AttributeDefinition::of()
            ->setName('testField')
            ->setLabel(LocalizedString::ofLangAndText('en', 'testField'))
            ->setIsRequired(false)
            ->setIsSearchable(false)
            ->setInputHint('SingleLine')
            ->setType(StringType::of())
        ;
        $request = ProductTypeUpdateRequest::ofIdAndVersion($productType->getId(), $productType->getVersion())
            ->addAction(
                ProductTypeAddAttributeDefinitionAction::ofAttribute($definition)
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->productTypeDeleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf(ProductType::class, $result);
        $this->assertSame($definition->getName(), $result->getAttributes()->current()->getName());
        $this->assertNotSame($productType->getVersion(), $result->getVersion());
        $productType = $result;

        $inputHint = 'MultiLine';
        $request = ProductTypeUpdateRequest::ofIdAndVersion($productType->getId(), $productType->getVersion())
            ->addAction(
                ProductTypeChangeInputHintAction::ofAttributeNameAndInputHint(
                    'testField',
                    $inputHint
                )
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->productTypeDeleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf(ProductType::class, $result);
        $this->assertSame($inputHint, $result->getAttributes()->current()->getInputHint());
        $this->assertNotSame($productType->getVersion(), $result->getVersion());
    }

    public function testChangeConstraint()
    {
        $draft = $this->getDraft('change-constraint');
        $productType = $this->createProductType($draft);

        $definition = AttributeDefinition::of()
            ->setName('testConstraintField')
            ->setLabel(LocalizedString::ofLangAndText('en', 'testConstraintField'))
            ->setIsRequired(false)
            ->setIsSearchable(false)
            ->setAttributeConstraint('SameForAll')
            ->setType(StringType::of())
        ;
        $request = ProductTypeUpdateRequest::ofIdAndVersion($productType->getId(), $productType->getVersion())
            ->addAction(
                ProductTypeAddAttributeDefinitionAction::ofAttribute($definition)
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->productTypeDeleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf(ProductType::class, $result);
        $this->assertSame($definition->getName(), $result->getAttributes()->current()->getName());
        $this->assertSame('SameForAll', $result->getAttributes()->current()->getAttributeConstraint());
        $this->assertNotSame($productType->getVersion(), $result->getVersion());
        $productType = $result;

        $constraint = 'None';
        $request = ProductTypeUpdateRequest::ofIdAndVersion($productType->getId(), $productType->getVersion())
            ->addAction(
                ProductTypeChangeAttributeConstraintAction::ofAttributeNameAndAttributeConstraint(
                    'testConstraintField',
                    $constraint
                )
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->productTypeDeleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf(ProductType::class, $result);
        $this->assertSame($constraint, $result->getAttributes()->current()->getAttributeConstraint());
        $this->assertNotSame($productType->getVersion(), $result->getVersion());
    }

    public function testRemoveEnumValues()
    {
        $draft = $this->getDraft('remove-enum-values');
        $definition = AttributeDefinition::of()
            ->setName('testEnumField')
            ->setLabel(LocalizedString::ofLangAndText('en', 'testEnumField'))
            ->setIsRequired(false)
            ->setType(EnumType::of()->setValues(
                EnumCollection::of()
                    ->add(Enum::of()->setKey('foo')->setLabel('foo'))
                    ->add(Enum::of()->setKey('bar')->setLabel('bar'))
                )
            );
        $draft->setAttributes(AttributeDefinitionCollection::of()->add($definition));
        $productType = $this->createProductType($draft);

        $this->assertInstanceOf(ProductType::class, $productType);
        /**
         * @var EnumType $attributeType
         */
        $attributeType = $productType->getAttributes()->current()->getType();
        $this->assertCount(2, $attributeType->getValues());


        $request = ProductTypeUpdateRequest::ofIdAndVersion($productType->getId(), $productType->getVersion())
            ->addAction(
                ProductTypeRemoveEnumValuesAction::ofAttributeNameAndKeys('testEnumField', ['foo'])
            );
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->productTypeDeleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf(ProductType::class, $result);
        /**
         * @var EnumType $type
         */
        $type = $result->getAttributes()->current()->getType();
        $this->assertCount(1, $type->getValues());
        $this->assertSame('bar', $type->getValues()->current()->getKey());
    }

    public function testChangeAttributeName()
    {
        $draft = $this->getDraft('change-attribute-name');

        $name = 'testNameField' . $this->getTestRun();
        $definition = AttributeDefinition::of()
            ->setName($name)
            ->setLabel(LocalizedString::ofLangAndText('en', $name))
            ->setIsRequired(false)
            ->setIsSearchable(false)
            ->setType(StringType::of())
        ;

        $draft->setAttributes(AttributeDefinitionCollection::of()->add($definition));
        $productType = $this->createProductType($draft);

        $this->assertInstanceOf(ProductType::class, $productType);
        $this->assertSame($name, $productType->getAttributes()->getByName($name)->getName());


        $newAttributeName = 'new' . ucfirst($name);
        $request = ProductTypeUpdateRequest::ofIdAndVersion($productType->getId(), $productType->getVersion())
            ->addAction(
                ProductTypeChangeAttributeNameAction::ofAttributeName(
                    $productType->getAttributes()->getByName($name)->getName(),
                    $newAttributeName
                )
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->productTypeDeleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf(ProductType::class, $result);
        $this->assertSame($newAttributeName, $result->getAttributes()->current()->getName());
        $this->assertSame($newAttributeName, $result->getAttributes()->getByName($newAttributeName)->getName());
        $this->assertNull($result->getAttributes()->getByName($name));
    }

    public function testChangeAttributeOrderByName()
    {
        $draft = $this->getDraft('change-attribute-order');

        $name = 'testNameField-1-' . $this->getTestRun();
        $definition = AttributeDefinition::of()
            ->setName($name)
            ->setLabel(LocalizedString::ofLangAndText('en', $name))
            ->setIsRequired(false)
            ->setIsSearchable(false)
            ->setType(StringType::of())
        ;

        $name2 = 'testNameField-2-' . $this->getTestRun();
        $definition2 = AttributeDefinition::of()
            ->setName($name2)
            ->setLabel(LocalizedString::ofLangAndText('en', $name2))
            ->setIsRequired(false)
            ->setIsSearchable(false)
            ->setType(StringType::of())
        ;

        $attributeCollection = AttributeDefinitionCollection::of()->add($definition)->add($definition2);

        $draft->setAttributes($attributeCollection);
        $productType = $this->createProductType($draft);

        $this->assertInstanceOf(ProductType::class, $productType);
        $this->assertSame($name, $productType->getAttributes()->getAt(0)->getName());
        $this->assertSame($name2, $productType->getAttributes()->getAt(1)->getName());

        $request = ProductTypeUpdateRequest::ofIdAndVersion($productType->getId(), $productType->getVersion())
            ->addAction(
                ProductTypeChangeAttributeOrderByNameAction::ofAttributeNames([$name2, $name])
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->productTypeDeleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf(ProductType::class, $result);
        $this->assertSame($name2, $result->getAttributes()->getAt(0)->getName());
        $this->assertSame($name, $result->getAttributes()->getAt(1)->getName());
    }

    public function testChangeEnumKey()
    {
        $draft = $this->getDraft('change-enum-key');

        $name = 'testNameField' . $this->getTestRun();
        $keyName = 'foo';
        $definition = AttributeDefinition::of()
            ->setName($name)
            ->setLabel(LocalizedString::ofLangAndText('en', $name))
            ->setIsRequired(false)
            ->setIsSearchable(false)
            ->setType(EnumType::of()->setValues(
                    EnumCollection::of()
                        ->add(Enum::of()->setKey('foo')->setLabel('foo'))
                )
            );

        $draft->setAttributes(AttributeDefinitionCollection::of()->add($definition));
        $productType = $this->createProductType($draft);

        $this->assertInstanceOf(ProductType::class, $productType);
        /**
         * @var EnumType $enumType
         */
        $enumType = $productType->getAttributes()->getByName($name)->getType();
        $this->assertSame($keyName, $enumType->getValues()->getByKey($keyName)->getKey());


        $newKeyName = 'new-foo';
        $request = ProductTypeUpdateRequest::ofIdAndVersion($productType->getId(), $productType->getVersion())
            ->addAction(
                ProductTypeChangeEnumKeyAction::ofAttributeNameAndEnumKey(
                    $productType->getAttributes()->getByName($name)->getName(),
                    $keyName,
                    $newKeyName
                )
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->productTypeDeleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf(ProductType::class, $result);
        /**
         * @var EnumType $enumType
         */
        $enumType = $result->getAttributes()->getByName($name)->getType();
        $this->assertSame($newKeyName, $enumType->getValues()->getByKey($newKeyName)->getKey());
        $this->assertNull($enumType->getValues()->getByKey($keyName));
    }
}
