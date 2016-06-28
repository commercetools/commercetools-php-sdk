<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 * @created: 04.02.15, 16:29
 */

namespace Commercetools\Core\Request\Products;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractQueryRequest;
use Commercetools\Core\Model\Product\ProductCollection;
use Commercetools\Core\Response\ApiResponseInterface;

/**
 * @package Commercetools\Core\Request\Products
 * @link https://dev.commercetools.com/http-api-projects-products.html#query-products
 * @method ProductCollection mapResponse(ApiResponseInterface $response)
 */
class ProductQueryRequest extends AbstractQueryRequest
{
    protected $resultClass = '\Commercetools\Core\Model\Product\ProductCollection';

    /**
     * @param Context $context
     */
    public function __construct(Context $context = null)
    {
        parent::__construct(ProductsEndpoint::endpoint(), $context);
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
