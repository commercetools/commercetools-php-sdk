<?php

namespace Commercetools\Core\Request\Products;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Product\Product;
use Commercetools\Core\Request\AbstractQueryRequest;
use Commercetools\Core\Response\ApiResponseInterface;
use Commercetools\Core\Model\MapperInterface;

/**
 * @package Commercetools\Core\Request\Products
 * @link https://docs.commercetools.com/api/projects/products#query-product-selections-for-a-product-by-key
 * @method Product mapResponse(ApiResponseInterface $response)
 * @method Product mapFromResponse(ApiResponseInterface $response, MapperInterface $mapper = null)
 */
class ProductByKeyProductSelectionsGetRequest extends AbstractQueryRequest
{
    protected $resultClass = Product::class;

    /**
     * @var string
     */
    protected $key;

    /**
     * @return string
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * @param string $key
     * @param Context $context
     */
    public function __construct($key, Context $context = null)
    {
        parent::__construct(ProductsEndpoint::endpoint(), $context);
        $this->key = $key;
    }

    /**
     * @param string $key
     * @param Context $context
     * @return static
     */
    public static function ofKey($key, Context $context = null)
    {
        return new static($key, $context);
    }


    /**
     * @return string
     * @internal
     */
    protected function getPath()
    {
        return (string)$this->getEndpoint() . '/key=' . $this->getKey() . '/product-selections' . $this->getParamString();
    }
}
