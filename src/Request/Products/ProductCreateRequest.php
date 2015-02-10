<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 04.02.15, 16:34
 */

namespace Sphere\Core\Request\Products;


use Sphere\Core\Model\Product\ProductDraft;
use Sphere\Core\Request\AbstractCreateRequest;

class ProductCreateRequest extends AbstractCreateRequest
{
    /**
     * @param \Sphere\Core\Model\Product\ProductDraft $product
     */
    public function __construct(ProductDraft $product)
    {
        parent::__construct(ProductsEndpoint::endpoint(), $product);
    }
}
