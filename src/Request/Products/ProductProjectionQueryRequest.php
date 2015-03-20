<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 02.02.15, 17:28
 */

namespace Sphere\Core\Request\Products;


use Sphere\Core\Model\Common\Context;
use Sphere\Core\Model\Product\ProductProjectionCollection;
use Sphere\Core\Request\AbstractQueryRequest;
use Sphere\Core\Request\StagedTrait;

/**
 * Class ProductProjectionQueryRequest
 * @package Sphere\Core\Request\Products
 */
class ProductProjectionQueryRequest extends AbstractQueryRequest
{
    use StagedTrait;

    protected $resultClass = '\Sphere\Core\Model\Product\ProductProjectionCollection';

    /**
     * @param Context $context
     */
    public function __construct(Context $context = null)
    {
        parent::__construct(ProductSearchEndpoint::endpoint(), $context);
    }
}
