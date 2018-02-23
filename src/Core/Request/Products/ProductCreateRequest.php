<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 * @created: 04.02.15, 16:34
 */

namespace Commercetools\Core\Request\Products;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Product\ProductDraft;
use Commercetools\Core\Request\AbstractCreateRequest;
use Commercetools\Core\Model\Product\Product;
use Commercetools\Core\Request\PriceSelectTrait;
use Commercetools\Core\Response\ApiResponseInterface;
use Commercetools\Core\Model\MapperInterface;

/**
 * @package Commercetools\Core\Request\Products
 * @link https://docs.commercetools.com/http-api-projects-products.html#create-a-product
 * @method Product mapResponse(ApiResponseInterface $response)
 * @method Product mapFromResponse(ApiResponseInterface $response, MapperInterface $mapper = null)
 */
class ProductCreateRequest extends AbstractCreateRequest
{
    use PriceSelectTrait;

    protected $resultClass = Product::class;
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
