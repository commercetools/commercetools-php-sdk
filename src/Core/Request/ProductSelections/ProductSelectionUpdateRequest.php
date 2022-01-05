<?php

namespace Commercetools\Core\Request\ProductSelections;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\MapperInterface;
use Commercetools\Core\Model\ProductSelection\ProductSelection;
use Commercetools\Core\Request\AbstractUpdateRequest;
use Commercetools\Core\Request\PriceSelectTrait;
use Commercetools\Core\Response\ApiResponseInterface;

/**
 * @package Commercetools\Core\Request\ProductSelections
 * @link https://docs.commercetools.com/http-api-projects-product-selections.html#update-productselection
 * @method ProductSelection mapResponse(ApiResponseInterface $response)
 * @method ProductSelection mapFromResponse(ApiResponseInterface $response, MapperInterface $mapper = null)
 */
class ProductSelectionUpdateRequest extends AbstractUpdateRequest
{
    use PriceSelectTrait;

    protected $resultClass = ProductSelection::class;

    /**
     * @param string $id
     * @param int $version
     * @param array $actions
     * @param Context $context
     */
    public function __construct($id, $version, array $actions = [], Context $context = null)
    {
        parent::__construct(ProductSelectionsEndpoint::endpoint(), $id, $version, $actions, $context);
    }

    /**
     * @param string $id
     * @param int $version
     * @param Context $context
     * @return static
     */
    public static function ofIdAndVersion($id, $version, Context $context = null)
    {
        return new static($id, $version, [], $context);
    }
}
