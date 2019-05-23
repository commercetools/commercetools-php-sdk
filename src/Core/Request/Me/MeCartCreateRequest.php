<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Me;

use Commercetools\Core\Model\Cart\MyCartDraft;
use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractCreateRequest;
use Commercetools\Core\Model\Cart\Cart;
use Commercetools\Core\Request\InStores\InStoreRequestDecorator;
use Commercetools\Core\Response\ApiResponseInterface;
use Commercetools\Core\Model\MapperInterface;

/**
 * @package Commercetools\Core\Request\Me
 * @link https://docs.commercetools.com/http-api-projects-me-carts.html#create-a-cart
 * @method Cart mapResponse(ApiResponseInterface $response)
 * @method Cart mapFromResponse(ApiResponseInterface $response, MapperInterface $mapper = null)
 * @method MeCartCreateRequest|InStoreRequestDecorator inStore($storeKey)
 */
class MeCartCreateRequest extends AbstractCreateRequest
{
    protected $resultClass = Cart::class;

    /**
     * @param MyCartDraft $cartDraft
     * @param Context $context
     */
    public function __construct(MyCartDraft $cartDraft, Context $context = null)
    {
        parent::__construct(MeCartsEndpoint::endpoint(), $cartDraft, $context);
    }

    /**
     * @param MyCartDraft $cartDraft
     * @param Context $context
     * @return static
     */
    public static function ofDraft(MyCartDraft $cartDraft, Context $context = null)
    {
        return new static($cartDraft, $context);
    }
}
