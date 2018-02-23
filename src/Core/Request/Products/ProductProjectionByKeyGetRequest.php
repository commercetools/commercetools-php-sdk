<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
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
 * @link https://docs.commercetools.com/http-api-projects-productProjections.html#get-productprojection-by-key
 * @method ProductProjection mapResponse(ApiResponseInterface $response)
 * @method ProductProjection mapFromResponse(ApiResponseInterface $response, MapperInterface $mapper = null)
 */
class ProductProjectionByKeyGetRequest extends AbstractByIdGetRequest
{
    use PriceSelectTrait;
    use StagedTrait;

    protected $resultClass = ProductProjection::class;

    /**
     * @return string
     */
    public function getKey()
    {
        return $this->getId();
    }

    /**
     * @param $key
     * @return $this
     */
    public function setKey($key)
    {
        return $this->setId($key);
    }

    /**
     * @param string $key
     * @param Context $context
     */
    public function __construct($key, Context $context = null)
    {
        parent::__construct(ProductProjectionEndpoint::endpoint(), $key, $context);
    }

    /**
     * @return string
     * @internal
     */
    protected function getPath()
    {
        return (string)$this->getEndpoint() . '/key=' . $this->getId() . $this->getParamString();
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
