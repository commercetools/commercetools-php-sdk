<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 * @created: 02.02.15, 17:28
 */

namespace Commercetools\Core\Request\Products;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Product\ProductProjectionCollection;
use Commercetools\Core\Request\AbstractQueryRequest;
use Commercetools\Core\Request\PriceSelectTrait;
use Commercetools\Core\Request\StagedTrait;
use Commercetools\Core\Response\ApiResponseInterface;
use Commercetools\Core\Model\MapperInterface;

/**
 * @package Commercetools\Core\Request\Products
 * @link https://docs.commercetools.com/http-api-projects-products.html#query-productprojections
 * @method ProductProjectionCollection mapResponse(ApiResponseInterface $response)
 * @method ProductProjectionCollection mapFromResponse(ApiResponseInterface $response, MapperInterface $mapper = null)
 */
class ProductProjectionQueryRequest extends AbstractQueryRequest
{
    use StagedTrait;
    use PriceSelectTrait;

    protected $resultClass = ProductProjectionCollection::class;

    /**
     * @param Context $context
     */
    public function __construct(Context $context = null)
    {
        parent::__construct(ProductProjectionEndpoint::endpoint(), $context);
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
