<?php

namespace Commercetools\Core\IntegrationTests\Category;

use Commercetools\Core\Client\ApiClient;
use Commercetools\Core\Helper\Uuid;
use Commercetools\Core\IntegrationTests\ResourceFixture;
use Commercetools\Core\Model\Category\Category;
use Commercetools\Core\Model\Category\CategoryDraft;
use Commercetools\Core\Model\Common\LocalizedString;
use Commercetools\Core\Request\Categories\CategoryCreateRequest;
use Commercetools\Core\Request\Categories\CategoryDeleteRequest;

class CategoryFixture extends ResourceFixture
{
    const CREATE_REQUEST_TYPE = CategoryCreateRequest::class;
    const DELETE_REQUEST_TYPE = CategoryDeleteRequest::class;
    const RAND_MAX = 10000;

    final public static function uniqueCategoryString()
    {
        return 'test-' . Uuid::uuidv4();
    }

    final public static function defaultCategoryDraftFunction()
    {
        $draft = CategoryDraft::of();

        $uniqueCategoryString = self::uniqueCategoryString();
        $draft->setName(LocalizedString::ofLangAndText('en', $uniqueCategoryString))
            ->setSlug(LocalizedString::ofLangAndText('en', $uniqueCategoryString))
            ->setKey($uniqueCategoryString);

        return $draft;
    }

    final public static function defaultCategoryDraftBuilderFunction(CategoryDraft $draft)
    {
        return $draft;
    }

    final public static function defaultCategoryCreateFunction(ApiClient $client, CategoryDraft $draft)
    {
        return parent::defaultCreateFunction($client, self::CREATE_REQUEST_TYPE, $draft);
    }

    final public static function defaultCategoryDeleteFunction(ApiClient $client, Category $resource)
    {
        return parent::defaultDeleteFunction($client, self::DELETE_REQUEST_TYPE, $resource);
    }

    final public static function withUpdateableDraftCategory(
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

        parent::withUpdateableDraftResource(
            $client,
            $draftBuilderFunction,
            $assertFunction,
            $createFunction,
            $deleteFunction,
            $draftFunction
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

    final public static function withCategory(
        ApiClient $client,
        callable $assertFunction,
        callable $createFunction = null,
        callable $deleteFunction = null,
        callable $draftFunction = null
    ) {
        self::withDraftCategory(
            $client,
            [__CLASS__, 'defaultCategoryDraftBuilderFunction'],
            $assertFunction,
            $createFunction,
            $deleteFunction,
            $draftFunction
        );
    }

    final public static function withUpdateableCategory(
        ApiClient $client,
        callable $assertFunction,
        callable $createFunction = null,
        callable $deleteFunction = null,
        callable $draftFunction = null
    ) {
        self::withUpdateableDraftCategory(
            $client,
            [__CLASS__, 'defaultCategoryDraftBuilderFunction'],
            $assertFunction,
            $createFunction,
            $deleteFunction,
            $draftFunction
        );
    }
}
