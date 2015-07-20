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
use Sphere\Core\Response\ApiResponseInterface;

/**
 * Class ProductProjectionQueryRequest
 * @package Sphere\Core\Request\Products
 * @link http://dev.sphere.io/http-api-projects-products.html#product-projections-by-query
 * @method ProductProjectionCollection mapResponse(ApiResponseInterface $response)
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
        parent::__construct(ProductProjectionEndpoint::endpoint(), $context);
    }

    /**
     * @param Context $context
     * @return static
     */
    public static function of(Context $context = null)
    {
        return new static($context);
    }
}
