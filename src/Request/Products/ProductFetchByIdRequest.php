<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 04.02.15, 16:27
 */

namespace Sphere\Core\Request\Products;


use Sphere\Core\Request\AbstractFetchByIdRequest;
use Sphere\Core\Request\Endpoints\ProductsEndpoint;

/**
 * Class ProductFetchByIdRequest
 * @package Sphere\Core\Request\Products
 * @method static ProductFetchByIdRequest of(string $id)
 */
class ProductFetchByIdRequest extends AbstractFetchByIdRequest
{
    /**
     * @param int $id
     */
    public function __construct($id)
    {
        parent::__construct(ProductsEndpoint::endpoint(), $id);
    }
}
