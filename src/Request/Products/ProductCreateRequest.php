<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 04.02.15, 16:34
 */

namespace Sphere\Core\Request\Products;


use Sphere\Core\Model\Common\Context;
use Sphere\Core\Model\Product\ProductDraft;
use Sphere\Core\Request\AbstractCreateRequest;

/**
 * Class ProductCreateRequest
 * @package Sphere\Core\Request\Products
 * @method static ProductCreateRequest of(ProductDraft $product)
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
}
