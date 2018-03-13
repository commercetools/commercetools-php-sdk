<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 * @created: 04.02.15, 16:27
 */

namespace Commercetools\Core\Request\Products;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractByIdGetRequest;
use Commercetools\Core\Model\Product\Product;
use Commercetools\Core\Request\PriceSelectTrait;
use Commercetools\Core\Response\ApiResponseInterface;
use Commercetools\Core\Model\MapperInterface;

/**
 * @package Commercetools\Core\Request\Products
 * @link https://docs.commercetools.com/http-api-projects-products.html#get-product-by-id
 * @method Product mapResponse(ApiResponseInterface $response)
 * @method Product mapFromResponse(ApiResponseInterface $response, MapperInterface $mapper = null)
 */
class ProductByIdGetRequest extends AbstractByIdGetRequest
{
    use PriceSelectTrait;
    
    protected $resultClass = Product::class;

    /**
     * @param string $id
     * @param Context $context
     */
    public function __construct($id, Context $context = null)
    {
        parent::__construct(ProductsEndpoint::endpoint(), $id, $context);
    }

    /**
     * @param string $id
     * @param Context $context
     * @return static
     */
    public static function ofId($id, Context $context = null)
    {
        return new static($id, $context);
    }
}
