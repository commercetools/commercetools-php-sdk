<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 * @created: 04.02.15, 16:34
 */

namespace Commercetools\Core\Request\Products;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Product\ProductDraft;
use Commercetools\Core\Request\AbstractCreateRequest;
use Commercetools\Core\Model\Product\Product;
use Commercetools\Core\Response\ApiResponseInterface;

/**
 * @package Commercetools\Core\Request\Products
 * @link http://dev.commercetools.com/http-api-projects-products.html#create-product
 * @method Product mapResponse(ApiResponseInterface $response)
 */
class ProductCreateRequest extends AbstractCreateRequest
{
    protected $resultClass = '\Commercetools\Core\Model\Product\Product';
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
