<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */


namespace Commercetools\Core\IntegrationTests\ProductType;

use Commercetools\Core\Builder\Request\RequestBuilder;
use Commercetools\Core\IntegrationTests\ApiTestCase;
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
use Commercetools\Core\Request\ProductTypes\Command\ProductTypeChangeDescriptionAction;
use Commercetools\Core\Request\ProductTypes\Command\ProductTypeChangeLabelAction;
use Commercetools\Core\Request\ProductTypes\Command\ProductTypeChangeLocalizedEnumLabelAction;
use Commercetools\Core\Request\ProductTypes\Command\ProductTypeChangeNameAction;
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

    protected function getAttributeDefinition($name, $type)
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
                $name = 'test-' . $this->getTestRun() . '-new name';

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
                $key = 'new-' . $this->getTestRun();

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
                $key = str_pad('new-' . $this->getTestRun(), 256, '0');

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

        ProductTypeFixture::withUpdateabledraftProductType(
            $client,
            function (ProductTypeDraft $draft) {
                return $draft->setKey(str_pad($draft->getKey(), 256, '0'));
            },
            function (ProductType $productType) use ($client) {
                $name = 'test-' . $this->getTestRun() . '-new name';

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
                $description = 'test-' . $this->getTestRun() . '-new description';

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
                $name = 'testField';
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
                $name = 'testEnumField';
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

//todo customObject and product to be migrated and then migrate this method
    public function testReferenceAttributeDefinition()
    {
        $draft = $this->getDraft('reference-attribute-definition');
        $productType = $this->createProductType($draft);
        $name = 'testCustomObject';
        $type = ReferenceType::of()->setReferenceTypeId(CustomObjectReference::TYPE_CUSTOM_OBJECT);
        $definition = $this->getAttributeDefinition($name, $type);

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
                            ->setName($name)
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
            $variant->getAttributes()->getByName($name)->getValue()->getId()
        );
        $this->assertInstanceOf(
            CustomObject::class,
            $variant->getAttributes()->getByName($name)->getValue()->getObj()
        );
        $this->assertSame(
            $customObjectDraft->getValue(),
            $variant->getAttributes()->getByName($name)->getValue()->getObj()->getValue()
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
        $client = $this->getApiClient();

        ProductTypeFixture::withUpdateableProductType(
            $client,
            function (ProductType $productType) use ($client) {
                $name = 'testLocalizedEnumField';
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

        ProductTypeFixture::withUpdateableDraftProductType(
            $client,
            function (ProductTypeDraft $draft) {
                $name = 'testLocalizedEnumField';
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
            function (ProductType $productType) use ($client) {
                $request = RequestBuilder::of()->productTypes()->update($productType)
                    ->addAction(ProductTypeChangeLocalizedEnumLabelAction::ofAttributeNameAndEnumValue(
                        'testLocalizedEnumField',
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
}
