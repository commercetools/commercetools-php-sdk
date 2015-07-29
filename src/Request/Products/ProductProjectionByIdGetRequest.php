<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 02.02.15, 17:36
 */

namespace Sphere\Core\Request\Products;

use Sphere\Core\Model\Common\Context;
use Sphere\Core\Model\Product\ProductProjection;
use Sphere\Core\Request\AbstractByIdGetRequest;
use Sphere\Core\Request\StagedTrait;
use Sphere\Core\Response\ApiResponseInterface;

/**
 * @package Sphere\Core\Request\Products
 * @apidoc http://dev.sphere.io/http-api-projects-products.html#product-projection-by-id
 * @method ProductProjection mapResponse(ApiResponseInterface $response)
 */
class ProductProjectionByIdGetRequest extends AbstractByIdGetRequest
{
    use StagedTrait;

    protected $resultClass = '\Sphere\Core\Model\Product\ProductProjection';

    /**
     * @param string $id
     * @param Context $context
     */
    public function __construct($id, Context $context = null)
    {
        parent::__construct(ProductProjectionEndpoint::endpoint(), $id, $context);
    }

    /**
     * @return string
     * @internal
     */
    protected function getPath()
    {
        return (string)$this->getEndpoint() . '/' . $this->getId() . $this->getParamString();
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
