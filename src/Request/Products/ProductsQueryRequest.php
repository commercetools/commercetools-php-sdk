<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 04.02.15, 16:29
 */

namespace Sphere\Core\Request\Products;


use Sphere\Core\Request\AbstractQueryRequest;
use Sphere\Core\Request\Endpoints\ProductsEndpoint;

/**
 * Class ProductsQueryRequest
 * @package Sphere\Core\Request\Products
 * @method static ProductsQueryRequest of()
 */
class ProductsQueryRequest extends AbstractQueryRequest
{
    /**
     *
     */
    public function __construct()
    {
        parent::__construct(ProductsEndpoint::endpoint());
    }
}
