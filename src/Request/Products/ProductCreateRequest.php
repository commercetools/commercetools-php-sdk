<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 04.02.15, 16:34
 */

namespace Sphere\Core\Request\Products;


use Sphere\Core\Model\Common\Context;
use Sphere\Core\Model\Product\ProductDraft;
use Sphere\Core\Request\AbstractCreateRequest;

class ProductCreateRequest extends AbstractCreateRequest
{
    /**
     * @param ProductDraft $product
     * @param Context $context
     */
    public function __construct(ProductDraft $product, Context $context = null)
    {
        parent::__construct(ProductsEndpoint::endpoint(), $product, $context);
    }
}
