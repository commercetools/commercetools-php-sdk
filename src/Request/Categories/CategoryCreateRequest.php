<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 26.01.15, 15:57
 */

namespace Sphere\Core\Request\Categories;


use Sphere\Core\Model\Category\CategoryDraft;
use Sphere\Core\Request\AbstractCreateRequest;

/**
 * Class CategoryCreateRequest
 * @package Sphere\Core\Request\Categories
 * @method static CategoryCreateRequest of(CategoryDraft $category)
 */
class CategoryCreateRequest extends AbstractCreateRequest
{
    /**
     * @param CategoryDraft $category
     */
    public function __construct(CategoryDraft $category)
    {
        parent::__construct(CategoriesEndpoint::endpoint(), $category);
    }
}
