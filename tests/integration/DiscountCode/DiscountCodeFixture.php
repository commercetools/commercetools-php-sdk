<?php

namespace Commercetools\Core\IntegrationTests\DiscountCode;

use Commercetools\Core\Client\ApiClient;
use Commercetools\Core\Helper\Uuid;
use Commercetools\Core\IntegrationTests\CartDiscount\CartDiscountFixture;
use Commercetools\Core\IntegrationTests\ResourceFixture;
use Commercetools\Core\Model\CartDiscount\CartDiscount;
use Commercetools\Core\Model\CartDiscount\CartDiscountDraft;
use Commercetools\Core\Model\CartDiscount\CartDiscountReference;
use Commercetools\Core\Model\CartDiscount\CartDiscountReferenceCollection;
use Commercetools\Core\Model\DiscountCode\DiscountCode;
use Commercetools\Core\Model\DiscountCode\DiscountCodeDraft;
use Commercetools\Core\Request\DiscountCodes\DiscountCodeCreateRequest;
use Commercetools\Core\Request\DiscountCodes\DiscountCodeDeleteRequest;

class DiscountCodeFixture extends ResourceFixture
{
    const CREATE_REQUEST_TYPE = DiscountCodeCreateRequest::class;
    const DELETE_REQUEST_TYPE = DiscountCodeDeleteRequest::class;

    final public static function uniqueDiscountCodeString()
    {
        return 'test-' . Uuid::uuidv4();
    }

    final public static function defaultDiscountCodeDraftFunction(
        CartDiscountReferenceCollection $cartDiscountReferenceCollection
    ) {
        $uniqueDiscountCodeString = self::uniqueDiscountCodeString();
        $draft = DiscountCodeDraft::ofCodeDiscountsAndActive(
            'test-' . $uniqueDiscountCodeString . '-code',
            $cartDiscountReferenceCollection,
            false
        );

        return $draft;
    }

    final public static function defaultActiveDiscountCodeDraftFunction(
        CartDiscountReferenceCollection $cartDiscountReferenceCollection
    ) {
        $uniqueDiscountCodeString = self::uniqueDiscountCodeString();
        $draft = DiscountCodeDraft::ofCodeDiscountsAndActive(
            'test-' . $uniqueDiscountCodeString . '-code',
            $cartDiscountReferenceCollection,
            true
        );

        return $draft;
    }

    final public static function discountCodeDraftWithoutCartDiscountFunction()
    {
        $uniqueDiscountCodeString = self::uniqueDiscountCodeString();
        $draft = DiscountCodeDraft::of()->setCode('test-' . $uniqueDiscountCodeString . '-code')
            ->setIsActive(true);

        return $draft;
    }

    final public static function defaultDiscountCodeDraftBuilderFunction(DiscountCodeDraft $draft)
    {
        return $draft;
    }

    final public static function defaultDiscountCodeCreateFunction(ApiClient $client, DiscountCodeDraft $draft)
    {
        return parent::defaultCreateFunction($client, self::CREATE_REQUEST_TYPE, $draft);
    }

    final public static function defaultDiscountCodeDeleteFunction(ApiClient $client, DiscountCode $resource)
    {
        return parent::defaultDeleteFunction($client, self::DELETE_REQUEST_TYPE, $resource);
    }

    final public static function withUpdateableDraftDiscountCode(
        ApiClient $client,
        callable $draftBuilderFunction,
        callable $assertFunction,
        callable $createFunction = null,
        callable $deleteFunction = null,
        callable $draftFunction = null
    ) {
        CartDiscountFixture::withDraftCartDiscount(
            $client,
            function (CartDiscountDraft $cartDiscountDraft) {
                return $cartDiscountDraft->setRequiresDiscountCode(true);
            },
            function (CartDiscount $cartDiscount) use (
                $client,
                $draftBuilderFunction,
                $assertFunction,
                $createFunction,
                $deleteFunction,
                $draftFunction
            ) {
                $cartDiscountReferences = CartDiscountReferenceCollection::of()
                    ->add(CartDiscountReference::ofId($cartDiscount->getId()));
                if ($draftFunction == null) {
                    $draftFunction = function () use ($cartDiscountReferences) {
                        return call_user_func([__CLASS__, 'defaultDiscountCodeDraftFunction'], $cartDiscountReferences);
                    };
                } else {
                    $draftFunction = function () use ($cartDiscountReferences, $draftFunction) {
                        return call_user_func($draftFunction, $cartDiscountReferences);
                    };
                }
                if ($createFunction == null) {
                    $createFunction = [__CLASS__, 'defaultDiscountCodeCreateFunction'];
                }
                if ($deleteFunction == null) {
                    $deleteFunction = [__CLASS__, 'defaultDiscountCodeDeleteFunction'];
                }

                parent::withUpdateableDraftResource(
                    $client,
                    $draftBuilderFunction,
                    $assertFunction,
                    $createFunction,
                    $deleteFunction,
                    $draftFunction,
                    [$cartDiscount]
                );
            }
        );
    }

    final public static function withDraftDiscountCode(
        ApiClient $client,
        callable $draftBuilderFunction,
        callable $assertFunction,
        callable $createFunction = null,
        callable $deleteFunction = null,
        callable $draftFunction = null
    ) {
        CartDiscountFixture::withDraftCartDiscount(
            $client,
            function (CartDiscountDraft $cartDiscountDraft) {
                return $cartDiscountDraft->setRequiresDiscountCode(true);
            },
            function (CartDiscount $cartDiscount) use (
                $client,
                $draftBuilderFunction,
                $assertFunction,
                $createFunction,
                $deleteFunction,
                $draftFunction
            ) {
                $cartDiscountReferences = CartDiscountReferenceCollection::of()
                    ->add(CartDiscountReference::ofId($cartDiscount->getId()));
                if ($draftFunction == null) {
                    $draftFunction = function () use ($cartDiscountReferences) {
                        return call_user_func([__CLASS__, 'defaultDiscountCodeDraftFunction'], $cartDiscountReferences);
                    };
                } else {
                    $draftFunction = function () use ($cartDiscountReferences, $draftFunction) {
                        return call_user_func($draftFunction, $cartDiscountReferences);
                    };
                }
                if ($createFunction == null) {
                    $createFunction = [__CLASS__, 'defaultDiscountCodeCreateFunction'];
                }
                if ($deleteFunction == null) {
                    $deleteFunction = [__CLASS__, 'defaultDiscountCodeDeleteFunction'];
                }

                parent::withDraftResource(
                    $client,
                    $draftBuilderFunction,
                    $assertFunction,
                    $createFunction,
                    $deleteFunction,
                    $draftFunction,
                    [$cartDiscount]
                );
            }
        );
    }

    final public static function withActiveDraftDiscountCode(
        ApiClient $client,
        callable $draftBuilderFunction,
        callable $assertFunction,
        callable $createFunction = null,
        callable $deleteFunction = null,
        callable $draftFunction = null
    ) {
        CartDiscountFixture::withDraftCartDiscount(
            $client,
            function (CartDiscountDraft $cartDiscountDraft) {
                return $cartDiscountDraft->setRequiresDiscountCode(true);
            },
            function (CartDiscount $cartDiscount) use (
                $client,
                $draftBuilderFunction,
                $assertFunction,
                $createFunction,
                $deleteFunction,
                $draftFunction
            ) {
                $cartDiscountReferences = CartDiscountReferenceCollection::of()
                    ->add(CartDiscountReference::ofId($cartDiscount->getId()));
                if ($draftFunction == null) {
                    $draftFunction = function () use ($cartDiscountReferences) {
                        return call_user_func([__CLASS__, 'defaultActiveDiscountCodeDraftFunction'], $cartDiscountReferences);
                    };
                } else {
                    $draftFunction = function () use ($cartDiscountReferences, $draftFunction) {
                        return call_user_func($draftFunction, $cartDiscountReferences);
                    };
                }
                if ($createFunction == null) {
                    $createFunction = [__CLASS__, 'defaultDiscountCodeCreateFunction'];
                }
                if ($deleteFunction == null) {
                    $deleteFunction = [__CLASS__, 'defaultDiscountCodeDeleteFunction'];
                }

                parent::withDraftResource(
                    $client,
                    $draftBuilderFunction,
                    $assertFunction,
                    $createFunction,
                    $deleteFunction,
                    $draftFunction,
                    [$cartDiscount]
                );
            }
        );
    }

    final public static function withDraftCategory(
        ApiClient $client,
        callable $draftBuilderFunction,
        callable $assertFunction,
        callable $createFunction = null,
        callable $deleteFunction = null,
        callable $draftFunction = null
    ) {
        if ($draftFunction == null) {
            $draftFunction = [__CLASS__, 'defaultCategoryDraftFunction'];
        }
        if ($createFunction == null) {
            $createFunction = [__CLASS__, 'defaultCategoryCreateFunction'];
        }
        if ($deleteFunction == null) {
            $deleteFunction = [__CLASS__, 'defaultCategoryDeleteFunction'];
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

    final public static function withDraftDiscountCodeWithoutCartDiscount(
        ApiClient $client,
        callable $draftBuilderFunction,
        callable $assertFunction,
        callable $createFunction = null,
        callable $deleteFunction = null,
        callable $draftFunction = null
    ) {
        if ($draftFunction == null) {
            $draftFunction = [__CLASS__, 'discountCodeDraftWithoutCartDiscountFunction'];
        }
        if ($createFunction == null) {
            $createFunction = [__CLASS__, 'defaultDiscountCodeCreateFunction'];
        }
        if ($deleteFunction == null) {
            $deleteFunction = [__CLASS__, 'defaultDiscountCodeDeleteFunction'];
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

    final public static function withDiscountCode(
        ApiClient $client,
        callable $assertFunction,
        callable $createFunction = null,
        callable $deleteFunction = null,
        callable $draftFunction = null
    ) {
        self::withDraftDiscountCode(
            $client,
            [__CLASS__, 'defaultDiscountCodeDraftBuilderFunction'],
            $assertFunction,
            $createFunction,
            $deleteFunction,
            $draftFunction
        );
    }

    final public static function withActiveDiscountCode(
        ApiClient $client,
        callable $assertFunction,
        callable $createFunction = null,
        callable $deleteFunction = null,
        callable $draftFunction = null
    ) {
        self::withActiveDraftDiscountCode(
            $client,
            [__CLASS__, 'defaultDiscountCodeDraftBuilderFunction'],
            $assertFunction,
            $createFunction,
            $deleteFunction,
            $draftFunction
        );
    }

    final public static function withUpdateableDiscountCode(
        ApiClient $client,
        callable $assertFunction,
        callable $createFunction = null,
        callable $deleteFunction = null,
        callable $draftFunction = null
    ) {
        self::withUpdateableDraftDiscountCode(
            $client,
            [__CLASS__, 'defaultDiscountCodeDraftBuilderFunction'],
            $assertFunction,
            $createFunction,
            $deleteFunction,
            $draftFunction
        );
    }
}
