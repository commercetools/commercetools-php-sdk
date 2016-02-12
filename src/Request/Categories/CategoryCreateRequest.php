<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 * @created: 26.01.15, 15:57
 */

namespace Commercetools\Core\Request\Categories;

use Commercetools\Core\Model\Category\CategoryDraft;
use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractCreateRequest;
use Commercetools\Core\Model\Category\Category;
use Commercetools\Core\Response\ApiResponseInterface;

/**
 * @package Commercetools\Core\Request\Categories
 * @link https://dev.commercetools.com/http-api-projects-categories.html#create-category
 * @method Category mapResponse(ApiResponseInterface $response)
 */
class CategoryCreateRequest extends AbstractCreateRequest
{
    protected $resultClass = '\Commercetools\Core\Model\Category\Category';

    /**
     * @param CategoryDraft $category
     * @param Context $context
     */
    public function __construct(CategoryDraft $category, Context $context = null)
    {
        parent::__construct(CategoriesEndpoint::endpoint(), $category, $context);
    }

    /**
     * @param CategoryDraft $category
     * @param Context $context
     * @return static
     */
    public static function ofDraft(CategoryDraft $category, Context $context = null)
    {
        return new static($category, $context);
    }
}
