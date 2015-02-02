<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 23.01.15, 16:52
 */

namespace Sphere\Core\Request\Categories;

use Sphere\Core\Request\AbstractQueryRequest;
use Sphere\Core\Request\Endpoints\CategoriesEndpoint;

/**
 * Class CategoriesQueryRequest
 * @package Sphere\Core\Request\Categories
 * @method static CategoriesQueryRequest of()
 */
class CategoriesQueryRequest extends AbstractQueryRequest
{
    /**
     *
     */
    public function __construct()
    {
        parent::__construct(CategoriesEndpoint::endpoint());
    }
}
