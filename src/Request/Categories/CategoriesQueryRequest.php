<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 23.01.15, 16:52
 */

namespace Sphere\Core\Request\Categories;

use Sphere\Core\Model\OfTrait;
use Sphere\Core\Request\AbstractQueryRequest;

/**
 * Class CategoriesQueryRequest
 * @package Sphere\Core\Request\Categories
 * @method static CategoriesQueryRequest of($where = null, $sort = null, $limit = null, $offset = null)
 */
class CategoriesQueryRequest extends AbstractQueryRequest
{
    use OfTrait;
    /**
     * @param $where
     * @param $sort
     * @param $limit
     * @param $offset
     */
    public function __construct($where = null, $sort = null, $limit = null, $offset = null)
    {
        parent::__construct(CategoriesEndpoint::endpoint(), $where, $sort, $limit, $offset);
    }
}
