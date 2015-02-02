<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 02.02.15, 11:26
 */

namespace Sphere\Core\Request\Products;

use Sphere\Core\Request\AbstractProjectionRequest;
use Sphere\Core\Request\Endpoints\ProductProjectionsEndpoint;

/**
 * Class ProductsSearchRequest
 * @package Sphere\Core\Request\Products
 * @method static ProductsSearchRequest of()
 */
class ProductsSearchRequest extends AbstractProjectionRequest
{
    /**
     *
     */
    public function __construct()
    {
        parent::__construct(ProductProjectionsEndpoint::endpoint());
    }

    /**
     * @return string
     */
    protected function getProjectionAction()
    {
        return 'search';
    }
}
