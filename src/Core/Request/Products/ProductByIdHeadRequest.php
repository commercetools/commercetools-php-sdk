<?php

namespace Commercetools\Core\Request\Products;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Product\Product;
use Commercetools\Core\Request\AbstractByIdHeadRequest;
use Commercetools\Core\Request\PriceSelectTrait;
use Commercetools\Core\Response\ApiResponseInterface;
use Commercetools\Core\Model\MapperInterface;

/**
 * @package Commercetools\Core\Request\Products
 * @link https://docs.commercetools.com/api/projects/products#by-id
 * @method Product mapResponse(ApiResponseInterface $response)
 * @method Product mapFromResponse(ApiResponseInterface $response, MapperInterface $mapper = null)
 */
class ProductByIdHeadRequest extends AbstractByIdHeadRequest
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
