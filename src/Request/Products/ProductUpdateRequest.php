<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 05.02.15, 17:26
 */

namespace Sphere\Core\Request\Products;

use Sphere\Core\Model\Common\Context;
use Sphere\Core\Request\AbstractUpdateRequest;
use Sphere\Core\Model\Product\Product;
use Sphere\Core\Response\ApiResponseInterface;

/**
 * @package Sphere\Core\Request\Products
 * @apidoc http://dev.sphere.io/http-api-projects-products.html#update-product
 * @method Product mapResponse(ApiResponseInterface $response)
 */
class ProductUpdateRequest extends AbstractUpdateRequest
{
    protected $resultClass = '\Sphere\Core\Model\Product\Product';

    /**
     * @param string $id
     * @param int $version
     * @param array $actions
     * @param Context $context
     */
    public function __construct($id, $version, array $actions = [], Context $context = null)
    {
        parent::__construct(ProductsEndpoint::endpoint(), $id, $version, $actions, $context);
    }

    /**
     * @param string $id
     * @param int $version
     * @param Context $context
     * @return static
     */
    public static function ofIdAndVersion($id, $version, Context $context = null)
    {
        return new static($id, $version, [], $context);
    }
}
