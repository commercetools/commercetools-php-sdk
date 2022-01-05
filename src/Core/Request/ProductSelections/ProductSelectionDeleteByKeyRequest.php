<?php

namespace Commercetools\Core\Request\ProductSelections;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractDeleteByKeyRequest;
use Commercetools\Core\Model\ProductSelection\ProductSelection;
use Commercetools\Core\Response\ApiResponseInterface;
use Commercetools\Core\Model\MapperInterface;

/**
 * @package Commercetools\Core\Request\ProductSelections
 * @link https://docs.commercetools.com/http-api-projects-productSelections.html#delete-productselection-by-key
 * @method ProductSelection mapResponse(ApiResponseInterface $response)
 * @method ProductSelection mapFromResponse(ApiResponseInterface $response, MapperInterface $mapper = null)
 */
class ProductSelectionDeleteByKeyRequest extends AbstractDeleteByKeyRequest
{
    protected $resultClass = ProductSelection::class;

    /**
     * @param string $key
     * @param int $version
     * @param Context $context
     */
    public function __construct($key, $version, Context $context = null)
    {
        parent::__construct(ProductSelectionsEndpoint::endpoint(), $key, $version, $context);
    }

    /**
     * @param string $key
     * @param int $version
     * @param Context $context
     * @return static
     */
    public static function ofKeyAndVersion($key, $version, Context $context = null)
    {
        return new static($key, $version, $context);
    }
}
