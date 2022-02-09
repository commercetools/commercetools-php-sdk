<?php

namespace Commercetools\Core\Request\ProductSelections;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractByIdGetRequest;
use Commercetools\Core\Model\ProductSelection\ProductSelection;
use Commercetools\Core\Request\AbstractQueryRequest;
use Commercetools\Core\Response\ApiResponseInterface;
use Commercetools\Core\Model\MapperInterface;

/**
 * @package Commercetools\Core\Request\ProductSelections
 * @link https://docs.commercetools.com/api/projects/product-selections#by-id
 * @method ProductSelection mapResponse(ApiResponseInterface $response)
 * @method ProductSelection mapFromResponse(ApiResponseInterface $response, MapperInterface $mapper = null)
 */
class ProductSelectionByIdProductsGetRequest extends AbstractQueryRequest
{
    protected $resultClass = ProductSelection::class;

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

    /**
     * @param string $id
     * @param Context $context
     */
    public function __construct($id, Context $context = null)
    {
        parent::__construct(ProductSelectionsEndpoint::endpoint(), $context);
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
        return (string)$this->getEndpoint() . '/' . $this->getId() . '/products' . $this->getParamString();
    }
}
