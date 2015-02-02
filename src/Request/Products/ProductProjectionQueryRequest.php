<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 02.02.15, 17:28
 */

namespace Sphere\Core\Request\Products;


use Sphere\Core\Request\AbstractQueryRequest;
use Sphere\Core\Request\Endpoints\ProductProjectionsEndpoint;
use Sphere\Core\Request\StagedTrait;

/**
 * Class ProductProjectionQueryRequest
 * @package Sphere\Core\Request\Products
 */
class ProductProjectionQueryRequest extends AbstractQueryRequest
{
    use StagedTrait;

    /**
     *
     */
    public function __construct()
    {
        parent::__construct(ProductProjectionsEndpoint::endpoint());
    }
}
