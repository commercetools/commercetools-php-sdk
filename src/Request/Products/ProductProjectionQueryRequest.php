<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 02.02.15, 17:28
 */

namespace Commercetools\Core\Request\Products;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Product\ProductProjectionCollection;
use Commercetools\Core\Request\AbstractQueryRequest;
use Commercetools\Core\Request\StagedTrait;
use Commercetools\Core\Response\ApiResponseInterface;

/**
 * @package Commercetools\Core\Request\Products
 * @apidoc http://dev.sphere.io/http-api-projects-products.html#product-projections-by-query
 * @method ProductProjectionCollection mapResponse(ApiResponseInterface $response)
 */
class ProductProjectionQueryRequest extends AbstractQueryRequest
{
    use StagedTrait;

    protected $resultClass = '\Commercetools\Core\Model\Product\ProductProjectionCollection';

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
