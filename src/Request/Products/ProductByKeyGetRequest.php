<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Products;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractByKeyGetRequest;
use Commercetools\Core\Model\Product\Product;
use Commercetools\Core\Response\ApiResponseInterface;
use Commercetools\Core\Model\MapperInterface;

/**
 * @package Commercetools\Core\Request\Products
 *
 * @method Product mapResponse(ApiResponseInterface $response)
 * @method Product mapFromResponse(ApiResponseInterface $response, MapperInterface $mapper = null)
 */
class ProductByKeyGetRequest extends AbstractByKeyGetRequest
{
    protected $resultClass = Product::class;

    /**
     * @param string $key
     * @param Context $context
     */
    public function __construct($key, Context $context = null)
    {
        parent::__construct(ProductsEndpoint::endpoint(), $key, $context);
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
}
