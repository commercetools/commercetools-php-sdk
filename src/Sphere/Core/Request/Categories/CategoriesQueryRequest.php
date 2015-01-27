<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 23.01.15, 16:52
 */

namespace Sphere\Core\Request\Categories;

use Sphere\Core\Request\AbstractQueryRequest;

class CategoriesQueryRequest extends AbstractQueryRequest
{
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
