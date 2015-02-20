<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Products;

/**
 * Class ProductProjectionFetchBySkuRequest
 * @package Sphere\Core\Request\Products
 */
class ProductProjectionFetchBySkuRequest extends ProductProjectionQueryRequest
{
    /**
     * @param string $sku
     */
    public function __construct($sku)
    {
        parent::__construct();
        if (!is_null($sku)) {
            $this->where(sprintf('masterVariant(sku="%1$s") or variants(sku="%1$s")', $sku));
        }
    }
}
