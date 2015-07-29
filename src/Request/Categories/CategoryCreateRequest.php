<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 26.01.15, 15:57
 */

namespace Sphere\Core\Request\Categories;

use Sphere\Core\Model\Category\CategoryDraft;
use Sphere\Core\Model\Common\Context;
use Sphere\Core\Request\AbstractCreateRequest;
use Sphere\Core\Model\Category\Category;
use Sphere\Core\Response\ApiResponseInterface;

/**
 * @package Sphere\Core\Request\Categories
 * @apidoc http://dev.sphere.io/http-api-projects-categories.html#create-category
 * @method Category mapResponse(ApiResponseInterface $response)
 */
class CategoryCreateRequest extends AbstractCreateRequest
{
    protected $resultClass = '\Sphere\Core\Model\Category\Category';

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
