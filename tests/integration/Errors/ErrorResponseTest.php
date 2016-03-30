<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */


namespace Commercetools\Core\Errors;

use Commercetools\Core\ApiTestCase;
use Commercetools\Core\Error\ConcurrentModificationError;
use Commercetools\Core\Error\DuplicateAttributeValueError;
use Commercetools\Core\Error\DuplicateAttributeValuesError;
use Commercetools\Core\Error\DuplicateFieldError;
use Commercetools\Core\Error\DuplicatePriceScopeError;
use Commercetools\Core\Error\DuplicateVariantValuesError;
use Commercetools\Core\Error\InvalidCredentialsError;
use Commercetools\Core\Error\InvalidCurrentPasswordError;
use Commercetools\Core\Error\InvalidFieldError;
use Commercetools\Core\Error\InvalidOperationError;
use Commercetools\Core\Error\InvalidSubjectError;
use Commercetools\Core\Error\RequiredFieldError;
use Commercetools\Core\Error\ResourceNotFoundError;
use Commercetools\Core\Model\Common\Attribute;
use Commercetools\Core\Model\Common\AttributeCollection;
use Commercetools\Core\Model\Common\Enum;
use Commercetools\Core\Model\Common\EnumCollection;
use Commercetools\Core\Model\Common\LocalizedString;
use Commercetools\Core\Model\Common\Money;
use Commercetools\Core\Model\Common\Price;
use Commercetools\Core\Model\Common\PriceCollection;
use Commercetools\Core\Model\Common\PriceDraft;
use Commercetools\Core\Model\Common\PriceDraftCollection;
use Commercetools\Core\Model\ProductType\AttributeDefinition;
use Commercetools\Core\Model\ProductType\EnumType;
use Commercetools\Core\Model\ProductType\StringType;
use Commercetools\Core\Request\Categories\CategoryByIdGetRequest;
use Commercetools\Core\Request\Categories\CategoryUpdateRequest;
use Commercetools\Core\Request\Categories\Command\CategoryChangeNameAction;
use Commercetools\Core\Request\Customers\CustomerLoginRequest;
use Commercetools\Core\Request\Customers\CustomerPasswordChangeRequest;
use Commercetools\Core\Request\Customers\CustomerUpdateRequest;
use Commercetools\Core\Request\Products\Command\ProductAddPriceAction;
use Commercetools\Core\Request\Products\Command\ProductAddVariantAction;
use Commercetools\Core\Request\Products\ProductByIdGetRequest;
use Commercetools\Core\Request\Products\ProductUpdateRequest;
use Commercetools\Core\Request\ProductTypes\Command\ProductTypeAddAttributeDefinitionAction;
use Commercetools\Core\Request\ProductTypes\ProductTypeUpdateRequest;

class ErrorResponseTest extends ApiTestCase
{
    public function testConcurrentModification()
    {
        $category = $this->getCategory();

        $request = CategoryUpdateRequest::ofIdAndVersion($category->getId(), $category->getVersion())->addAction(
            CategoryChangeNameAction::ofName(
                LocalizedString::ofLangAndText('en', $this->getTestRun() . '-concurrent')
            )
        );
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->category = $result;
        $this->assertFalse($response->isError());

        $request = CategoryUpdateRequest::ofIdAndVersion($category->getId(), $category->getVersion())->addAction(
            CategoryChangeNameAction::ofName(
                LocalizedString::ofLangAndText('en', $this->getTestRun() . '-concurrent 2')
            )
        );
        $response = $request->executeWithClient($this->getClient());

        $this->assertTrue($response->isError());
        $this->assertInstanceOf('\Commercetools\Core\Response\ErrorResponse', $response);
        $error = $response->getErrors()->current();
        $this->assertInstanceOf(
            '\Commercetools\Core\Error\ConcurrentModificationError',
            $error
        );
        $this->assertSame(409, $response->getStatusCode());
        $this->assertSame($result->getVersion(), $error->getCurrentVersion());
        $this->assertSame(ConcurrentModificationError::CODE, $error->getCode());
    }

    public function testResourceNotFoundByGet()
    {
        $t = '00000000-0000-0000-0000-000000000000';
        $request = ProductByIdGetRequest::ofId($t);
        $response = $request->executeWithClient($this->getClient());
        $this->assertTrue($response->isError());
        $this->assertInstanceOf('\Commercetools\Core\Response\ErrorResponse', $response);
        $error = $response->getErrors()->current();
        $this->assertInstanceOf(
            '\Commercetools\Core\Error\InvalidSubjectError',
            $error
        );
        $this->assertSame(InvalidSubjectError::CODE, $error->getCode());
    }

    public function testResourceNotFoundByPost()
    {
        $t = '00000000-0000-0000-0000-000000000000';
        $request = ProductUpdateRequest::ofIdAndVersion($t, 1);
        $response = $request->executeWithClient($this->getClient());
        $this->assertTrue($response->isError());
        $this->assertInstanceOf('\Commercetools\Core\Response\ErrorResponse', $response);
        $error = $response->getErrors()->current();
        $this->assertInstanceOf(
            '\Commercetools\Core\Error\ResourceNotFoundError',
            $error
        );
        $this->assertSame(ResourceNotFoundError::CODE, $error->getCode());
    }

    public function testResourceNotFoundByGetInvalidUUID()
    {
        $t = '00000000';
        $request = ProductByIdGetRequest::ofId($t);
        $response = $request->executeWithClient($this->getClient());
        $this->assertTrue($response->isError());
        $this->assertInstanceOf('\Commercetools\Core\Response\ErrorResponse', $response);
        $this->assertSame(404, $response->getStatusCode());
        $this->assertEmpty((string)$response->getBody());
    }

    public function testResourceNotFoundByPostInvalidUUID()
    {
        $t = '00000000';
        $request = ProductUpdateRequest::ofIdAndVersion($t, 1);
        $response = $request->executeWithClient($this->getClient());
        $this->assertTrue($response->isError());
        $this->assertInstanceOf('\Commercetools\Core\Response\ErrorResponse', $response);
        $this->assertSame(404, $response->getStatusCode());
        $this->assertEmpty((string)$response->getBody());
    }

    public function testInvalidCredentials()
    {
        $customer = $this->getCustomer();

        $request = CustomerLoginRequest::ofEmailAndPassword($customer->getEmail(), 'invalidPassword');
        $response = $request->executeWithClient($this->getClient());
        $this->assertTrue($response->isError());
        $this->assertInstanceOf('\Commercetools\Core\Response\ErrorResponse', $response);
        $this->assertSame(400, $response->getStatusCode());
        $error = $response->getErrors()->current();
        $this->assertInstanceOf(
            '\Commercetools\Core\Error\InvalidCredentialsError',
            $error
        );
        $this->assertSame(InvalidCredentialsError::CODE, $error->getCode());
    }

    public function testInvalidCurrentPassword()
    {
        $customer = $this->getCustomer();

        $request = CustomerPasswordChangeRequest::ofIdVersionAndPasswords(
            $customer->getId(),
            $customer->getVersion(),
            'invalidPassword',
            'newPassword'
        );
        $response = $request->executeWithClient($this->getClient());
        $this->assertTrue($response->isError());
        $this->assertInstanceOf('\Commercetools\Core\Response\ErrorResponse', $response);
        $this->assertSame(400, $response->getStatusCode());
        $error = $response->getErrors()->current();
        $this->assertInstanceOf(
            '\Commercetools\Core\Error\InvalidCurrentPasswordError',
            $error
        );
        $this->assertSame(InvalidCurrentPasswordError::CODE, $error->getCode());
    }

    public function testDuplicatePriceScope()
    {
        $product = $this->getProduct();

        $request = ProductUpdateRequest::ofIdAndVersion($product->getId(), $product->getVersion())
            ->addAction(
                ProductAddPriceAction::ofVariantIdAndPrice(
                    1,
                    PriceDraft::ofMoney(Money::ofCurrencyAndAmount('EUR', 200))->setCountry('DE')
                )
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $this->assertTrue($response->isError());
        $this->assertInstanceOf('\Commercetools\Core\Response\ErrorResponse', $response);
        $this->assertSame(400, $response->getStatusCode());
        $error = $response->getErrors()->current();
        $this->assertInstanceOf(
            '\Commercetools\Core\Error\DuplicatePriceScopeError',
            $error
        );
        $this->assertSame(DuplicatePriceScopeError::CODE, $error->getCode());
        $this->assertCount(2, $error->getConflictingPrices());
    }

    public function testDuplicateField()
    {
        $product = $this->getProduct();

        $sku = $product->getMasterData()->getCurrent()->getMasterVariant()->getSku();
        $request = ProductUpdateRequest::ofIdAndVersion($product->getId(), $product->getVersion())
            ->addAction(
                ProductAddVariantAction::of()
                    ->setSku($sku)
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $this->assertTrue($response->isError());
        $this->assertInstanceOf('\Commercetools\Core\Response\ErrorResponse', $response);
        $this->assertSame(400, $response->getStatusCode());
        $error = $response->getErrors()->current();
        $this->assertInstanceOf(
            '\Commercetools\Core\Error\DuplicateFieldError',
            $error
        );
        $this->assertSame(DuplicateFieldError::CODE, $error->getCode());
        $this->assertSame('sku', $error->getField());
        $this->assertSame($sku, $error->getDuplicateValue());
    }

    public function testDuplicateVariantValues()
    {
        $product = $this->getProduct();

        $request = ProductUpdateRequest::ofIdAndVersion($product->getId(), $product->getVersion())
            ->addAction(
                ProductAddVariantAction::of()
                    ->setAttributes(
                        AttributeCollection::of()->add(
                            Attribute::of()->setName('testField')->setValue('123456')
                        )
                    )
            )
            ->addAction(
                ProductAddVariantAction::of()
                    ->setAttributes(
                        AttributeCollection::of()->add(
                            Attribute::of()->setName('testField')->setValue('123456')
                        )
                    )
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $this->assertTrue($response->isError());
        $this->assertInstanceOf('\Commercetools\Core\Response\ErrorResponse', $response);
        $this->assertSame(400, $response->getStatusCode());
        $error = $response->getErrors()->current();
        $this->assertInstanceOf(
            '\Commercetools\Core\Error\DuplicateVariantValuesError',
            $error
        );
        $this->assertSame(DuplicateVariantValuesError::CODE, $error->getCode());
        $this->assertNotEmpty($error->getVariantValues());
    }

    public function testDuplicateVariantValuesWithPrice()
    {
        $product = $this->getProduct();

        $request = ProductUpdateRequest::ofIdAndVersion($product->getId(), $product->getVersion())
            ->addAction(
                ProductAddVariantAction::of()
                    ->setPrices(
                        PriceDraftCollection::of()->add(PriceDraft::ofMoney(Money::ofCurrencyAndAmount('EUR', 100)))
                    )
                    ->setAttributes(
                        AttributeCollection::of()->add(
                            Attribute::of()->setName('testField')->setValue('123456')
                        )
                    )
            )
            ->addAction(
                ProductAddVariantAction::of()
                    ->setPrices(
                        PriceDraftCollection::of()->add(PriceDraft::ofMoney(Money::ofCurrencyAndAmount('EUR', 100)))
                    )
                    ->setAttributes(
                        AttributeCollection::of()->add(
                            Attribute::of()->setName('testField')->setValue('123456')
                        )
                    )
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $this->assertFalse($response->isError());
        $this->product = $request->mapResponse($response);
//        $this->assertInstanceOf('\Commercetools\Core\Response\ErrorResponse', $response);
//        $this->assertSame(400, $response->getStatusCode());
//        $error = $response->getErrors()->current();
//        $this->assertInstanceOf(
//            '\Commercetools\Core\Error\DuplicateVariantValuesError',
//            $error
//        );
//        $this->assertSame(DuplicateVariantValuesError::CODE, $error->getCode());
//        $this->assertNotEmpty($error->getVariantValues());
    }

    public function testDuplicateAttributeValue()
    {
        $productType = $this->getProductType();

        $request = ProductTypeUpdateRequest::ofIdAndVersion($productType->getId(), $productType->getVersion());
        $request->addAction(
            ProductTypeAddAttributeDefinitionAction::ofAttribute(
                AttributeDefinition::of()
                    ->setType(StringType::of())
                    ->setName('uniqueField')
                    ->setLabel(LocalizedString::ofLangAndText('en', 'uniqueField'))
                    ->setIsRequired(false)
                    ->setAttributeConstraint('Unique')
            )
        );
        $response = $request->executeWithClient($this->getClient());
        $this->productType = $request->mapResponse($response);

        $product = $this->getProduct();
        $request = ProductUpdateRequest::ofIdAndVersion($product->getId(), $product->getVersion())
            ->addAction(
                ProductAddVariantAction::of()
                    ->setSku($this->getTestRun() . '-1')
                    ->setAttributes(
                        AttributeCollection::of()->add(
                            Attribute::of()->setName('uniqueField')->setValue('123456')
                        )
                    )
            )
            ->addAction(
                ProductAddVariantAction::of()
                    ->setSku($this->getTestRun() . '-2')
                    ->setAttributes(
                        AttributeCollection::of()->add(
                            Attribute::of()->setName('uniqueField')->setValue('123456')
                        )
                    )
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $this->assertTrue($response->isError());
        $this->assertInstanceOf('\Commercetools\Core\Response\ErrorResponse', $response);
        $this->assertSame(400, $response->getStatusCode());
        $error = $response->getErrors()->current();
        $this->assertInstanceOf(
            '\Commercetools\Core\Error\DuplicateAttributeValueError',
            $error
        );
        $this->assertSame(DuplicateAttributeValueError::CODE, $error->getCode());
        $this->assertNotEmpty($error->getAttribute());
    }

    public function testDuplicateAttributeValues()
    {
        $productType = $this->getProductType();

        $request = ProductTypeUpdateRequest::ofIdAndVersion($productType->getId(), $productType->getVersion());
        $request->addAction(
            ProductTypeAddAttributeDefinitionAction::ofAttribute(
                AttributeDefinition::of()
                    ->setType(StringType::of())
                    ->setName('combineField1')
                    ->setLabel(LocalizedString::ofLangAndText('en', 'combineField1'))
                    ->setIsRequired(false)
                    ->setAttributeConstraint('CombinationUnique')
            )
        );
        $request->addAction(
            ProductTypeAddAttributeDefinitionAction::ofAttribute(
                AttributeDefinition::of()
                    ->setType(StringType::of())
                    ->setName('combineField2')
                    ->setLabel(LocalizedString::ofLangAndText('en', 'combineField2'))
                    ->setIsRequired(false)
                    ->setAttributeConstraint('CombinationUnique')
            )
        );
        $response = $request->executeWithClient($this->getClient());
        $this->productType = $request->mapResponse($response);

        $product = $this->getProduct();
        $request = ProductUpdateRequest::ofIdAndVersion($product->getId(), $product->getVersion())
            ->addAction(
                ProductAddVariantAction::of()
                    ->setSku($this->getTestRun() . '-1')
                    ->setAttributes(
                        AttributeCollection::of()->add(
                            Attribute::of()->setName('combineField1')->setValue('abcdef')
                        )->add(
                            Attribute::of()->setName('combineField2')->setValue('123456')
                        )
                    )
            )
            ->addAction(
                ProductAddVariantAction::of()
                    ->setSku($this->getTestRun() . '-2')
                    ->setAttributes(
                        AttributeCollection::of()->add(
                            Attribute::of()->setName('combineField1')->setValue('abcdef')
                        )->add(
                            Attribute::of()->setName('combineField2')->setValue('123456')
                        )
                    )
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $this->assertTrue($response->isError());
        $this->assertInstanceOf('\Commercetools\Core\Response\ErrorResponse', $response);
        $this->assertSame(400, $response->getStatusCode());
        $error = $response->getErrors()->current();
        $this->assertInstanceOf(
            '\Commercetools\Core\Error\DuplicateAttributeValuesError',
            $error
        );
        $this->assertSame(DuplicateAttributeValuesError::CODE, $error->getCode());
        $this->assertNotEmpty($error->getAttributes());
        $this->assertCount(2, $error->getAttributes());
    }

    public function testRequiredField()
    {
        $productType = $this->getProductType();
        $product = $this->getProduct();

        $request = ProductTypeUpdateRequest::ofIdAndVersion($productType->getId(), $productType->getVersion());
        $request->addAction(
            ProductTypeAddAttributeDefinitionAction::ofAttribute(
                AttributeDefinition::of()
                    ->setType(StringType::of())
                    ->setName('requiredField')
                    ->setLabel(LocalizedString::ofLangAndText('en', 'requiredField'))
                    ->setIsRequired(true)
            )
        );
        $response = $request->executeWithClient($this->getClient());
        $this->productType = $request->mapResponse($response);

        $request = ProductUpdateRequest::ofIdAndVersion($product->getId(), $product->getVersion())
            ->addAction(
                ProductAddVariantAction::of()
                    ->setSku($this->getTestRun() . '-1')
                    ->setAttributes(
                        AttributeCollection::of()->add(
                            Attribute::of()->setName('testField')->setValue('123456')
                        )
                    )
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $this->assertTrue($response->isError());
        $this->assertInstanceOf('\Commercetools\Core\Response\ErrorResponse', $response);
        $this->assertSame(400, $response->getStatusCode());
        $error = $response->getErrors()->current();
        $this->assertInstanceOf(
            '\Commercetools\Core\Error\RequiredFieldError',
            $error
        );
        $this->assertSame(RequiredFieldError::CODE, $error->getCode());
        $this->assertSame('requiredField', $error->getField());
    }

    public function testInvalidOperation()
    {
        $product = $this->getProduct();

        $request = ProductUpdateRequest::ofIdAndVersion($product->getId(), $product->getVersion())
            ->addAction(
                ProductAddVariantAction::of()
                    ->setSku($this->getTestRun() . '-1')
                    ->setAttributes(
                        AttributeCollection::of()->add(
                            Attribute::of()->setName('uniqueField')->setValue('123456')
                        )
                    )
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $this->assertTrue($response->isError());
        $this->assertInstanceOf('\Commercetools\Core\Response\ErrorResponse', $response);
        $this->assertSame(400, $response->getStatusCode());
        $error = $response->getErrors()->current();
        $this->assertInstanceOf(
            '\Commercetools\Core\Error\InvalidOperationError',
            $error
        );
        $this->assertSame(InvalidOperationError::CODE, $error->getCode());
    }

    public function testInvalidField()
    {
        $productType = $this->getProductType();
        $product = $this->getProduct();

        $request = ProductTypeUpdateRequest::ofIdAndVersion($productType->getId(), $productType->getVersion());
        $request->addAction(
            ProductTypeAddAttributeDefinitionAction::ofAttribute(
                AttributeDefinition::of()
                    ->setType(
                        EnumType::of()->setValues(
                            EnumCollection::of()->add(
                                Enum::of()->setKey('test')->setLabel('test')
                            )
                        )
                    )
                    ->setName('enumField')
                    ->setLabel(LocalizedString::ofLangAndText('en', 'enumField'))
                    ->setIsRequired(false)
            )
        );
        $response = $request->executeWithClient($this->getClient());
        $this->productType = $request->mapResponse($response);

        $request = ProductUpdateRequest::ofIdAndVersion($product->getId(), $product->getVersion())
            ->addAction(
                ProductAddVariantAction::of()
                    ->setSku($this->getTestRun() . '-1')
                    ->setAttributes(
                        AttributeCollection::of()->add(
                            Attribute::of()->setName('enumField')->setValue('unknown')
                        )
                    )
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $this->assertTrue($response->isError());
        $this->assertInstanceOf('\Commercetools\Core\Response\ErrorResponse', $response);
        $this->assertSame(400, $response->getStatusCode());
        $error = $response->getErrors()->current();
        $this->assertInstanceOf(
            '\Commercetools\Core\Error\InvalidFieldError',
            $error
        );
        $this->assertSame(InvalidFieldError::CODE, $error->getCode());
        $this->assertSame('enumField', $error->getField());
        $this->assertSame('unknown', $error->getInvalidValue());
        $this->assertSame(['test'], $error->getAllowedValues());
    }
}
