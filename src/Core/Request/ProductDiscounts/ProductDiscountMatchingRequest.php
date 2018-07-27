<?php
/**
 */

namespace Commercetools\Core\Request\ProductDiscounts;

use Commercetools\Core\Client\HttpMethod;
use Commercetools\Core\Client\JsonRequest;
use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Common\Price;
use Commercetools\Core\Model\ProductDiscount\ProductDiscount;
use Commercetools\Core\Request\AbstractApiRequest;
use Commercetools\Core\Response\ApiResponseInterface;
use Commercetools\Core\Response\ResourceResponse;
use Psr\Http\Message\ResponseInterface;
use Commercetools\Core\Model\MapperInterface;

/**
 * @package Commercetools\Core\Request\ProductDiscounts
 *
 * @method ProductDiscount mapResponse(ApiResponseInterface $response)
 * @method ProductDiscount mapFromResponse(ApiResponseInterface $response, MapperInterface $mapper = null)
 */
class ProductDiscountMatchingRequest extends AbstractApiRequest
{
    protected $resultClass = ProductDiscount::class;

    const PRODUCT_ID = 'productId';
    const VARIANT_ID = 'variantId';
    const STAGED = 'staged';
    const PRICE = 'price';

    /**
     * @var string
     */
    protected $productId;

    /**
     * @var int
     */
    protected $variantId;

    /**
     * @var bool
     */
    protected $staged;

    /**
     * @var Price
     */
    protected $price;

    /**
     * @param Price $price
     * @param Context $context
     */
    public function __construct(Price $price, Context $context = null)
    {
        parent::__construct(ProductDiscountsEndpoint::endpoint(), $context);
        $this->price = $price;
    }

    /**
     * @return string
     */
    public function getProductId()
    {
        return $this->productId;
    }

    /**
     * @param string $productId
     * @return ProductDiscountMatchingRequest
     */
    public function setProductId($productId)
    {
        $this->productId = $productId;
        return $this;
    }

    /**
     * @return int
     */
    public function getVariantId()
    {
        return $this->variantId;
    }

    /**
     * @param int $variantId
     * @return ProductDiscountMatchingRequest
     */
    public function setVariantId($variantId)
    {
        $this->variantId = $variantId;
        return $this;
    }

    /**
     * @return bool
     */
    public function getStaged()
    {
        return $this->staged;
    }

    /**
     * @param bool $staged
     * @return ProductDiscountMatchingRequest
     */
    public function setStaged($staged)
    {
        $this->staged = $staged;
        return $this;
    }

    /**
     * @return Price
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param Price $price
     * @return ProductDiscountMatchingRequest
     */
    public function setPrice(Price $price)
    {
        $this->price = $price;
        return $this;
    }

    /**
     * @param string $productId
     * @param int $variantId
     * @param Price $price
     * @param Context $context
     * @return ProductDiscountMatchingRequest
     */
    public static function ofProductIdVariantIdAndPrice($productId, $variantId, Price $price, Context $context = null)
    {
        $request = new static($price, $context);
        $request->setProductId($productId)->setVariantId($variantId);

        return $request;
    }

    /**
     * @return string
     * @internal
     */
    protected function getPath()
    {
        return (string)$this->getEndpoint() . '/matching' .  $this->getParamString();
    }

    /**
     * @return JsonRequest
     * @internal
     */
    public function httpRequest()
    {
        $payload = [
            static::PRODUCT_ID => $this->getProductId(),
            static::VARIANT_ID => $this->getVariantId(),
            static::STAGED => ($this->getStaged() === true),
            static::PRICE => $this->getPrice()
        ];

        return new JsonRequest(HttpMethod::POST, $this->getPath(), $payload);
    }

    /**
     * @param ResponseInterface $response
     * @return ApiResponseInterface
     * @internal
     */
    public function buildResponse(ResponseInterface $response)
    {
        return new ResourceResponse($response, $this, $this->getContext());
    }
}
