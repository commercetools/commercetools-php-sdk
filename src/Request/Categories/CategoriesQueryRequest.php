<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 23.01.15, 16:52
 */

namespace Sphere\Core\Request\Categories;

use Sphere\Core\Model\Common\Context;
use Sphere\Core\Request\AbstractQueryRequest;

/**
 * Class CategoriesQueryRequest
 * @package Sphere\Core\Request\Categories
 * @link http://dev.sphere.io/http-api-projects-categories.html#categories-by-query
 * @method static CategoriesQueryRequest of()
 */
class CategoriesQueryRequest extends AbstractQueryRequest
{
    protected $resultClass = '\Sphere\Core\Model\Category\CategoryCollection';

    /**
     * @param Context $context
     */
    public function __construct(Context $context = null)
    {
        parent::__construct(CategoriesEndpoint::endpoint(), $context);
    }
}
