<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 02.02.15, 17:28
 */

namespace Sphere\Core\Request\Products;


use Sphere\Core\Model\OfTrait;
use Sphere\Core\Request\AbstractQueryRequest;
use Sphere\Core\Request\StagedTrait;

class ProductProjectionQueryRequest extends AbstractQueryRequest
{
    use OfTrait;
    use StagedTrait;

    /**
     * @param string  $sort
     * @param int $limit
     * @param int $offset
     * @param bool $staged
     */
    public function __construct($where = null, $sort = null, $limit = null, $offset = null, $staged = false)
    {
        parent::__construct(ProductProjectionEndpoint::endpoint(), $where, $sort, $limit, $offset);
        $this->staged($staged);
    }
}
