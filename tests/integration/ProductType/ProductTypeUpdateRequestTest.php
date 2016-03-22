<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */


namespace Commercetools\Core\ProductType;

use Commercetools\Core\ApiTestCase;
use Commercetools\Core\Model\Common\Enum;
use Commercetools\Core\Model\Common\EnumCollection;
use Commercetools\Core\Model\Common\LocalizedEnum;
use Commercetools\Core\Model\Common\LocalizedEnumCollection;
use Commercetools\Core\Model\Common\LocalizedString;
use Commercetools\Core\Model\ProductType\AttributeDefinition;
use Commercetools\Core\Model\ProductType\EnumType;
use Commercetools\Core\Model\ProductType\LocalizedEnumType;
use Commercetools\Core\Model\ProductType\ProductTypeDraft;
use Commercetools\Core\Model\ProductType\StringType;
use Commercetools\Core\Request\ProductTypes\Command\ProductTypeAddAttributeDefinitionAction;
use Commercetools\Core\Request\ProductTypes\Command\ProductTypeAddLocalizedEnumValueAction;
use Commercetools\Core\Request\ProductTypes\Command\ProductTypeAddPlainEnumValueAction;
use Commercetools\Core\Request\ProductTypes\Command\ProductTypeChangeDescriptionAction;
use Commercetools\Core\Request\ProductTypes\Command\ProductTypeChangeIsSearchableAction;
use Commercetools\Core\Request\ProductTypes\Command\ProductTypeChangeLabelAction;
use Commercetools\Core\Request\ProductTypes\Command\ProductTypeChangeNameAction;
use Commercetools\Core\Request\ProductTypes\Command\ProductTypeRemoveAttributeDefinitionAction;
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

        $this->assertInstanceOf('\Commercetools\Core\Model\ProductType\ProductType', $result);
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

        $this->assertInstanceOf('\Commercetools\Core\Model\ProductType\ProductType', $result);
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

        $this->assertInstanceOf('\Commercetools\Core\Model\ProductType\ProductType', $result);
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

        $this->assertInstanceOf('\Commercetools\Core\Model\ProductType\ProductType', $result);
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

        $this->assertInstanceOf('\Commercetools\Core\Model\ProductType\ProductType', $result);
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

        $this->assertInstanceOf('\Commercetools\Core\Model\ProductType\ProductType', $result);
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

        $this->assertInstanceOf('\Commercetools\Core\Model\ProductType\ProductType', $result);
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

        $this->assertInstanceOf('\Commercetools\Core\Model\ProductType\ProductType', $result);
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

        $this->assertInstanceOf('\Commercetools\Core\Model\ProductType\ProductType', $result);
        /**
         * @var EnumType $type
         */
        $type = $result->getAttributes()->current()->getType();
        $this->assertSame($enum->getKey(), $type->getValues()->current()->getKey());
        $this->assertNotSame($productType->getVersion(), $result->getVersion());
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

        $this->assertInstanceOf('\Commercetools\Core\Model\ProductType\ProductType', $result);
        /**
         * @var LocalizedEnumType $type
         */
        $type = $result->getAttributes()->current()->getType();
        $this->assertSame($enum->getLabel()->en, $type->getValues()->current()->getLabel()->en);
        $this->assertNotSame($productType->getVersion(), $result->getVersion());
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

        $this->assertInstanceOf('\Commercetools\Core\Model\ProductType\ProductType', $result);
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

        $this->assertInstanceOf('\Commercetools\Core\Model\ProductType\ProductType', $result);
        $this->assertSame($searchable, $result->getAttributes()->current()->getIsSearchable());
        $this->assertNotSame($productType->getVersion(), $result->getVersion());
    }
}
