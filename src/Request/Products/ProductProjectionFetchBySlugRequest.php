<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Products;


use Sphere\Core\Model\Common\Context;

/**
 * Class ProductProjectionFetchBySlugRequest
 * @package Sphere\Core\Request\Products
 */
class ProductProjectionFetchBySlugRequest extends ProductProjectionQueryRequest
{
    /**
     * @param string $slug
     * @param Context $context
     */
    public function __construct($slug, Context $context)
    {
        parent::__construct();
        $parts = array_map(
            function ($value) {
                return sprintf('slug(%s="%s")', $value, '%1$s');
            },
            $context->getLanguages()
        );
        if (!is_null($slug) && !empty($parts)) {
            $this->where(sprintf(implode(' or ', $parts), $slug));
        }
    }
}
