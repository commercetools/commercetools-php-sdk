<?php

namespace Commercetools\Core\Request\Products;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\ProductSelection\AssignedProductSelection;
use Commercetools\Core\Request\AbstractQueryRequest;
use Commercetools\Core\Request\PriceSelectTrait;
use Commercetools\Core\Response\ApiResponseInterface;
use Commercetools\Core\Model\MapperInterface;

/**
 * @package Commercetools\Core\Request\Products
 * @link https://docs.commercetools.com/api/projects/products#query-product-selections-for-a-product-by-id
 * @method AssignedProductSelection mapResponse(ApiResponseInterface $response)
 * @method AssignedProductSelection mapFromResponse(ApiResponseInterface $response, MapperInterface $mapper = null)
 */
class ProductByIdProductSelectionsGetRequest extends AbstractQueryRequest
{
    use PriceSelectTrait;
    
    protected $resultClass = AssignedProductSelection::class;

    /**
     * @var string
     */
    protected $id;

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    public function __construct($id, Context $context = null)
    {
        parent::__construct(ProductsEndpoint::endpoint(), $context);
        $this->id = $id;
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

    /**
     * @return string
     * @internal
     */
    protected function getPath()
    {
        return (string)$this->getEndpoint() . '/' . $this->getId() . '/product-selections' . $this->getParamString();
    }
}
