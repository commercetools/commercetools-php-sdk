<?php

namespace Commercetools\Core\IntegrationTests\Product;

use Commercetools\Core\Builder\Request\RequestBuilder;
use Commercetools\Core\Client\ApiClient;
use Commercetools\Core\Error\ConcurrentModificationError;
use Commercetools\Core\Error\ConcurrentModificationException;
use Commercetools\Core\Error\NotFoundException;
use Commercetools\Core\Helper\Uuid;
use Commercetools\Core\IntegrationTests\ProductType\ProductTypeFixture;
use Commercetools\Core\IntegrationTests\ResourceFixture;
use Commercetools\Core\IntegrationTests\TaxCategory\TaxCategoryFixture;
use Commercetools\Core\Model\Common\LocalizedString;
use Commercetools\Core\Model\Common\Money;
use Commercetools\Core\Model\Common\PriceDraft;
use Commercetools\Core\Model\Common\PriceDraftCollection;
use Commercetools\Core\Model\Product\Product;
use Commercetools\Core\Model\Product\ProductDraft;
use Commercetools\Core\Model\Product\ProductVariantDraft;
use Commercetools\Core\Model\ProductType\AttributeDefinition;
use Commercetools\Core\Model\ProductType\AttributeDefinitionCollection;
use Commercetools\Core\Model\ProductType\ProductType;
use Commercetools\Core\Model\ProductType\ProductTypeDraft;
use Commercetools\Core\Model\ProductType\ProductTypeReference;
use Commercetools\Core\Model\ProductType\StringType;
use Commercetools\Core\Model\TaxCategory\TaxCategory;
use Commercetools\Core\Model\TaxCategory\TaxCategoryReference;
use Commercetools\Core\Request\Products\Command\ProductUnpublishAction;
use Commercetools\Core\Request\Products\ProductCreateRequest;
use Commercetools\Core\Request\Products\ProductDeleteRequest;
use Commercetools\Core\Response\ErrorResponse;

class ProductFixture extends ResourceFixture
{
    const CREATE_REQUEST_TYPE = ProductCreateRequest::class;
    const DELETE_REQUEST_TYPE = ProductDeleteRequest::class;

    final public static function getAttributeDefinitionCollection()
    {
        $name = 'testField';

        return AttributeDefinitionCollection::of()
            ->add(
                AttributeDefinition::of()
                    ->setName($name)
                    ->setLabel(LocalizedString::ofLangAndText('en', $name))
                    ->setIsRequired(false)
                    ->setAttributeConstraint('None')
                    ->setInputHint('SingleLine')
                    ->setIsSearchable(false)
                    ->setType(StringType::of())
            );
    }

    final public static function uniqueProductString()
    {
        return 'test-' . Uuid::uuidv4();
    }

    final public static function defaultProductDraftFunction($productTypeReference, $taxCategoryReference)
    {
        $uniqueProductString = self::uniqueProductString();
        $sku = "SKU" . ProductFixture::uniqueProductString();

        $draft = ProductDraft::ofTypeNameSlugMasterVariantAndTaxCategory(
            $productTypeReference,
            LocalizedString::ofLangAndText('en', 'test-' . $uniqueProductString . '-name'),
            LocalizedString::ofLangAndText('en', 'test-' . $uniqueProductString . '-slug'),
            ProductVariantDraft::ofSkuAndPrices(
                $sku,
                PriceDraftCollection::of()->add(
                    PriceDraft::ofMoney(Money::ofCurrencyAndAmount('EUR', 100))
                )
            ),
            $taxCategoryReference
        );

        return $draft;
    }

    final public static function defaultProductDraftBuilderFunction(ProductDraft $draft)
    {
        return $draft;
    }

    final public static function defaultProductCreateFunction(ApiClient $client, ProductDraft $draft)
    {
        return parent::defaultCreateFunction($client, self::CREATE_REQUEST_TYPE, $draft);
    }

    final public static function defaultProductDeleteFunction(ApiClient $client, Product $resource)
    {
        $request = RequestBuilder::of()->products()->update($resource)->addAction(ProductUnpublishAction::of());

        try {
            $response = $client->execute($request);
            $resource = $request->mapFromResponse($response);
        } catch (NotFoundException $e) {
            return null;
        } catch (ConcurrentModificationException $e) {
            $errorResponse = new ErrorResponse($e, $request, $e->getResponse());

            /** @var ConcurrentModificationError $error */
            $error = $errorResponse->getErrors()->getByCode(ConcurrentModificationError::CODE);
            $currentVersion = $error->getCurrentVersion();

            $request = $request->setVersion($currentVersion);
            $response = $client->execute($request);
            $resource = $request->mapFromResponse($response);
        }

        return parent::defaultDeleteFunction($client, self::DELETE_REQUEST_TYPE, $resource);
    }

    final public static function withUpdateableDraftProduct(
        ApiClient $client,
        callable $draftBuilderFunction,
        callable $assertFunction,
        callable $createFunction = null,
        callable $deleteFunction = null,
        callable $draftFunction = null
    ) {
        ProductTypeFixture::withDraftProductType(
            $client,
            function (ProductTypeDraft $productTypeDraft) {
                $productTypeDraft->setAttributes(self::getAttributeDefinitionCollection());

                return $productTypeDraft;
            },
            function (ProductType $productType) use (
                $client,
                $draftBuilderFunction,
                $assertFunction,
                $createFunction,
                $deleteFunction,
                $draftFunction
            ) {
                TaxCategoryFixture::withTaxCategory(
                    $client,
                    function (TaxCategory $taxCategory) use (
                        $client,
                        $productType,
                        $draftBuilderFunction,
                        $assertFunction,
                        $createFunction,
                        $deleteFunction,
                        $draftFunction
                    ) {
                        $taxCategoryReference = TaxCategoryReference::ofId($taxCategory->getId());
                        $productTypeReference = ProductTypeReference::ofId($productType->getId());
                        if ($draftFunction == null) {
                            $draftFunction = function () use ($productTypeReference, $taxCategoryReference) {
                                return call_user_func(
                                    [__CLASS__, 'defaultProductDraftFunction'],
                                    $productTypeReference,
                                    $taxCategoryReference
                                );
                            };
                        } else {
                            $draftFunction = function () use (
                                $productTypeReference,
                                $taxCategoryReference,
                                $draftFunction
                            ) {
                                return call_user_func($draftFunction, $taxCategoryReference, $productTypeReference);
                            };
                        }
                        if ($createFunction == null) {
                            $createFunction = [__CLASS__, 'defaultProductCreateFunction'];
                        }
                        if ($deleteFunction == null) {
                            $deleteFunction = [__CLASS__, 'defaultProductDeleteFunction'];
                        }

                        parent::withUpdateableDraftResource(
                            $client,
                            $draftBuilderFunction,
                            $assertFunction,
                            $createFunction,
                            $deleteFunction,
                            $draftFunction,
                            [$productType, $taxCategory]
                        );
                    }
                );
            }
        );
    }


    final public static function withDraftProduct(
        ApiClient $client,
        callable $draftBuilderFunction,
        callable $assertFunction,
        callable $createFunction = null,
        callable $deleteFunction = null,
        callable $draftFunction = null
    ) {
        ProductTypeFixture::withDraftProductType(
            $client,
            function (ProductTypeDraft $productTypeDraft) {
                $productTypeDraft->setAttributes(self::getAttributeDefinitionCollection());

                return $productTypeDraft;
            },
            function (ProductType $productType) use (
                $client,
                $draftBuilderFunction,
                $assertFunction,
                $createFunction,
                $deleteFunction,
                $draftFunction
            ) {
                TaxCategoryFixture::withTaxCategory(
                    $client,
                    function (TaxCategory $taxCategory) use (
                        $client,
                        $productType,
                        $draftBuilderFunction,
                        $assertFunction,
                        $createFunction,
                        $deleteFunction,
                        $draftFunction
                    ) {
                        $taxCategoryReference = TaxCategoryReference::ofId($taxCategory->getId());
                        $productTypeReference = ProductTypeReference::ofId($productType->getId());
                        if ($draftFunction == null) {
                            $draftFunction = function () use ($productTypeReference, $taxCategoryReference) {
                                return call_user_func(
                                    [__CLASS__, 'defaultProductDraftFunction'],
                                    $productTypeReference,
                                    $taxCategoryReference
                                );
                            };
                        } else {
                            $draftFunction = function () use (
                                $productTypeReference,
                                $taxCategoryReference,
                                $draftFunction
                            ) {
                                return call_user_func($draftFunction, $productTypeReference, $taxCategoryReference);
                            };
                        }
                        if ($createFunction == null) {
                            $createFunction = [__CLASS__, 'defaultProductCreateFunction'];
                        }
                        if ($deleteFunction == null) {
                            $deleteFunction = [__CLASS__, 'defaultProductDeleteFunction'];
                        }

                        parent::withDraftResource(
                            $client,
                            $draftBuilderFunction,
                            $assertFunction,
                            $createFunction,
                            $deleteFunction,
                            $draftFunction,
                            [$productType, $taxCategory]
                        );
                    }
                );
            }
        );
    }

    final public static function withProduct(
        ApiClient $client,
        callable $assertFunction,
        callable $createFunction = null,
        callable $deleteFunction = null,
        callable $draftFunction = null
    ) {
        self::withDraftProduct(
            $client,
            [__CLASS__, 'defaultProductDraftBuilderFunction'],
            $assertFunction,
            $createFunction,
            $deleteFunction,
            $draftFunction
        );
    }

    final public static function withUpdateableProduct(
        ApiClient $client,
        callable $assertFunction,
        callable $createFunction = null,
        callable $deleteFunction = null,
        callable $draftFunction = null
    ) {
        self::withUpdateableDraftProduct(
            $client,
            [__CLASS__, 'defaultProductDraftBuilderFunction'],
            $assertFunction,
            $createFunction,
            $deleteFunction,
            $draftFunction
        );
    }
}
