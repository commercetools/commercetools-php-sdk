<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 * @created: 02.02.15, 17:36
 */

namespace Commercetools\Core\Request\Products;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Product\ProductProjection;
use Commercetools\Core\Request\AbstractByIdGetRequest;
use Commercetools\Core\Request\PriceSelectTrait;
use Commercetools\Core\Request\StagedTrait;
use Commercetools\Core\Response\ApiResponseInterface;
use Commercetools\Core\Model\MapperInterface;

/**
 * @package Commercetools\Core\Request\Products
 * @link https://dev.commercetools.com/http-api-projects-productProjections.html#get-productprojection-by-id
 * @method ProductProjection mapResponse(ApiResponseInterface $response)
 * @method ProductProjection mapFromResponse(ApiResponseInterface $response, MapperInterface $mapper = null)
 */
class ProductProjectionByIdGetRequest extends AbstractByIdGetRequest
{
    use PriceSelectTrait;
    use StagedTrait;

    protected $resultClass = ProductProjection::class;

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
