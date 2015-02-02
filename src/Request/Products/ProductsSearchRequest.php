<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 02.02.15, 11:26
 */

namespace Sphere\Core\Request\Products;

use Sphere\Core\Model\OfTrait;
use Sphere\Core\Request\AbstractProjectionRequest;
use Sphere\Core\Request\PageTrait;
use Sphere\Core\Request\SortTrait;

/**
 * Class ProductsSearchRequest
 * @package Sphere\Core\Request\Products
 * @method static ProductsSearchRequest of($sort = null, $limit = null, $offset = null, $staged = false)
 */
class ProductsSearchRequest extends AbstractProjectionRequest
{
    use OfTrait;

    /**
     * @param string  $sort
     * @param int $limit
     * @param int $offset
     * @param bool $staged
     */
    public function __construct($sort = null, $limit = null, $offset = null, $staged = false)
    {
        parent::__construct(ProductSearchEndpoint::endpoint(), $sort, $limit, $offset, $staged);
    }
}
