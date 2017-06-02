<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\ProductTypes;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractQueryRequest;
use Commercetools\Core\Model\ProductType\ProductTypeCollection;
use Commercetools\Core\Response\ApiResponseInterface;
use Commercetools\Core\Model\MapperInterface;

/**
 * @package Commercetools\Core\Request\ProductTypes
 * @link https://dev.commercetools.com/http-api-projects-productTypes.html#query-producttypes
 * @method ProductTypeCollection mapResponse(ApiResponseInterface $response)
 * @method ProductTypeCollection mapFromResponse(ApiResponseInterface $response, MapperInterface $mapper = null)
 */
class ProductTypeQueryRequest extends AbstractQueryRequest
{
    protected $resultClass = ProductTypeCollection::class;

    /**
     * @param Context $context
     */
    public function __construct(Context $context = null)
    {
        parent::__construct(ProductTypesEndpoint::endpoint(), $context);
    }

    /**
     * @param Context $context
     * @return static
     */
    public static function of(Context $context = null)
    {
        return new static($context);
    }
}
