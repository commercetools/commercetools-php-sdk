<?php

namespace Commercetools\Core\Request\Carts;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractDeleteByKeyRequest;
use Commercetools\Core\Model\Cart\Cart;
use Commercetools\Core\Request\DataErasureTrait;
use Commercetools\Core\Request\InStores\InStoreRequestDecorator;
use Commercetools\Core\Request\InStores\InStoreTrait;
use Commercetools\Core\Response\ApiResponseInterface;
use Commercetools\Core\Model\MapperInterface;

/**
 * @package Commercetools\Core\Request\Carts
 * @link https://docs.commercetools.com/api/projects/carts#delete-a-cart-by-key
 * @method Cart mapResponse(ApiResponseInterface $response)
 * @method Cart mapFromResponse(ApiResponseInterface $response, MapperInterface $mapper = null)
 * @method CartDeleteByKeyRequest|InStoreRequestDecorator inStore($storeKey)
 */
class CartDeleteByKeyRequest extends AbstractDeleteByKeyRequest
{
    use DataErasureTrait;
    use InStoreTrait;

    protected $resultClass = Cart::class;

    /**
     * @param string $key
     * @param int $version
     * @param Context $context
     */
    public function __construct($key, $version, Context $context = null)
    {
        parent::__construct(CartsEndpoint::endpoint(), $key, $version, $context);
    }

    /**
     * @param string $key
     * @param int $version
     * @param Context $context
     * @return static
     */
    public static function ofKeyAndVersion($key, $version, Context $context = null)
    {
        return new static($key, $version, $context);
    }
}
