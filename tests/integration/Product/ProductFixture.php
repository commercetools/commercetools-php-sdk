<?php

namespace Commercetools\Core\IntegrationTests\Product;

use Commercetools\Core\Client\ApiClient;
use Commercetools\Core\Helper\Uuid;
use Commercetools\Core\IntegrationTests\ProductType\ProductTypeFixture;
use Commercetools\Core\IntegrationTests\ResourceFixture;
use Commercetools\Core\Model\Common\LocalizedString;
use Commercetools\Core\Model\Product\Product;
use Commercetools\Core\Model\Product\ProductDraft;
use Commercetools\Core\Model\ProductType\AttributeDefinition;
use Commercetools\Core\Model\ProductType\AttributeDefinitionCollection;
use Commercetools\Core\Model\ProductType\ProductType;
use Commercetools\Core\Model\ProductType\ProductTypeDraft;
use Commercetools\Core\Model\ProductType\ProductTypeReference;
use Commercetools\Core\Model\ProductType\StringType;
use Commercetools\Core\Request\Products\ProductCreateRequest;
use Commercetools\Core\Request\Products\ProductDeleteRequest;

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

    final public static function defaultProductDraftFunction($productTypeReference)
    {
        $uniqueProductString = self::uniqueProductString();
        $draft = ProductDraft::ofTypeNameAndSlug(
            $productTypeReference,
            LocalizedString::ofLangAndText('en', 'test-' . $uniqueProductString . '-name'),
            LocalizedString::ofLangAndText('en', 'test-' . $uniqueProductString . '-name')
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
                $productTypeReference = ProductTypeReference::ofId($productType->getId());
                if ($draftFunction == null) {
                    $draftFunction = function () use ($productTypeReference) {
                        return call_user_func([__CLASS__, 'defaultProductDraftFunction'], $productTypeReference);
                    };
                } else {
                    $draftFunction = function () use ($productTypeReference, $draftFunction) {
                        return call_user_func($draftFunction, $productTypeReference);
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
                    $draftFunction
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
                $productTypeReference = ProductTypeReference::ofId($productType->getId());
                if ($draftFunction == null) {
                    $draftFunction = function () use ($productTypeReference) {
                        return call_user_func([__CLASS__, 'defaultProductDraftFunction'], $productTypeReference);
                    };
                } else {
                    $draftFunction = function () use ($productTypeReference, $draftFunction) {
                        return call_user_func($draftFunction, $productTypeReference);
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
                    $draftFunction
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
