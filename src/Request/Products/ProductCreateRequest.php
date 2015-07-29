<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 04.02.15, 16:34
 */

namespace Sphere\Core\Request\Products;

use Sphere\Core\Model\Common\Context;
use Sphere\Core\Model\Product\ProductDraft;
use Sphere\Core\Request\AbstractCreateRequest;
use Sphere\Core\Model\Product\Product;
use Sphere\Core\Response\ApiResponseInterface;

/**
 * @package Sphere\Core\Request\Products
 * @apidoc http://dev.sphere.io/http-api-projects-products.html#create-product
 * @method Product mapResponse(ApiResponseInterface $response)
 */
class ProductCreateRequest extends AbstractCreateRequest
{
    protected $resultClass = '\Sphere\Core\Model\Product\Product';
    /**
     * @param ProductDraft $product
     * @param Context $context
     */
    public function __construct(ProductDraft $product, Context $context = null)
    {
        parent::__construct(ProductsEndpoint::endpoint(), $product, $context);
    }

    /**
     * @param ProductDraft $product
     * @param Context $context
     * @return static
     */
    public static function ofDraft(ProductDraft $product, Context $context = null)
    {
        return new static($product, $context);
    }
}
