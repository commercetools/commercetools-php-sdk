<?php

namespace Commercetools\Core\Request\ProductSelections;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\MapperInterface;
use Commercetools\Core\Model\ProductSelection\ProductSelection;
use Commercetools\Core\Request\AbstractUpdateByKeyRequest;
use Commercetools\Core\Response\ApiResponseInterface;

/**
 * @package Commercetools\Core\Request\ProductSelections
 *
 * @method ProductSelection mapResponse(ApiResponseInterface $response)
 * @method ProductSelection mapFromResponse(ApiResponseInterface $response, MapperInterface $mapper = null)
 */
class ProductSelectionUpdateByKeyRequest extends AbstractUpdateByKeyRequest
{
    protected $resultClass = ProductSelection::class;

    /**
     * @param string $key
     * @param int $version
     * @param array $actions
     * @param Context $context
     */
    public function __construct($key, $version, array $actions = [], Context $context = null)
    {
        parent::__construct(ProductSelectionsEndpoint::endpoint(), $key, $version, $actions, $context);
    }

    /**
     * @param string $key
     * @param int $version
     * @param Context $context
     * @return static
     */
    public static function ofKeyAndVersion($key, $version, Context $context = null)
    {
        return new static($key, $version, [], $context);
    }
}
