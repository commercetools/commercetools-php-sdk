<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 04.02.15, 16:27
 */

namespace Commercetools\Core\Request\Products;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractByIdGetRequest;
use Commercetools\Core\Model\Product\Product;
use Commercetools\Core\Response\ApiResponseInterface;

/**
 * @package Commercetools\Core\Request\Products
 * @apidoc http://dev.sphere.io/http-api-projects-products.html#product-by-id
 * @method Product mapResponse(ApiResponseInterface $response)
 */
class ProductByIdGetRequest extends AbstractByIdGetRequest
{
    protected $resultClass = '\Commercetools\Core\Model\Product\Product';

    /**
     * @param string $id
     * @param Context $context
     */
    public function __construct($id, Context $context = null)
    {
        parent::__construct(ProductsEndpoint::endpoint(), $id, $context);
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
}
