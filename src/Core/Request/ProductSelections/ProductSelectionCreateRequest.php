<?php

namespace Commercetools\Core\Request\ProductSelections;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\ProductSelection\ProductSelectionDraft;
use Commercetools\Core\Request\AbstractCreateRequest;
use Commercetools\Core\Model\ProductSelection\ProductSelection;
use Commercetools\Core\Response\ApiResponseInterface;
use Commercetools\Core\Model\MapperInterface;

/**
 * @package Commercetools\Core\Request\ProductSelections
 * @link https://docs.commercetools.com/http-api-projects-productSelections.html#create-a-productselection
 * @method ProductSelection mapResponse(ApiResponseInterface $response)
 * @method ProductSelection mapFromResponse(ApiResponseInterface $response, MapperInterface $mapper = null)
 */
class ProductSelectionCreateRequest extends AbstractCreateRequest
{
    protected $resultClass = ProductSelection::class;

    /**
     * @param ProductSelectionDraft $productSelection
     * @param Context $context
     */
    public function __construct(ProductSelectionDraft $productSelection, Context $context = null)
    {
        parent::__construct(ProductSelectionsEndpoint::endpoint(), $productSelection, $context);
    }

    /**
     * @param ProductSelectionDraft $productSelection
     * @param Context $context
     * @return static
     */
    public static function ofDraft(ProductSelectionDraft $productSelection, Context $context = null)
    {
        return new static($productSelection, $context);
    }
}
