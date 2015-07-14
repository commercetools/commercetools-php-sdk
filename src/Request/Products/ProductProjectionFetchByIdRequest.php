<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 02.02.15, 17:36
 */

namespace Sphere\Core\Request\Products;

use Sphere\Core\Model\Common\Context;
use Sphere\Core\Model\Product\ProductProjection;
use Sphere\Core\Request\AbstractFetchByIdRequest;
use Sphere\Core\Request\StagedTrait;
use Sphere\Core\Response\ApiResponseInterface;

/**
 * Class ProductProjectionFetchByIdRequest
 * @package Sphere\Core\Request\Products
 * @link http://dev.sphere.io/http-api-projects-products.html#product-projection-by-id
 * @method ProductProjection mapResponse(ApiResponseInterface $response)
 */
class ProductProjectionFetchByIdRequest extends AbstractFetchByIdRequest
{
    use StagedTrait;

    protected $resultClass = '\Sphere\Core\Model\Product\ProductProjection';

    /**
     * @param string $id
     * @param Context $context
     */
    public function __construct($id, Context $context = null)
    {
        parent::__construct(ProductSearchEndpoint::endpoint(), $id, $context);
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
