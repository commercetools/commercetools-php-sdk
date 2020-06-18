<?php

namespace Commercetools\Core\Request\Me;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractDeleteByKeyRequest;
use Commercetools\Core\Request\AbstractDeleteRequest;
use Commercetools\Core\Model\ShoppingList\ShoppingList;
use Commercetools\Core\Response\ApiResponseInterface;
use Commercetools\Core\Model\MapperInterface;

/**
 * @package Commercetools\Core\Request\Me
 * @link https://docs.commercetools.com/http-api-projects-me-shoppingLists#delete-shoppinglist-by-key
 * @method ShoppingList mapResponse(ApiResponseInterface $response)
 * @method ShoppingList mapFromResponse(ApiResponseInterface $response, MapperInterface $mapper = null)
 */
class MeShoppingListDeleteByKeyRequest extends AbstractDeleteByKeyRequest
{
    protected $resultClass = ShoppingList::class;

    /**
     * @param string $key
     * @param int $version
     * @param Context $context
     */
    public function __construct($key, $version, Context $context = null)
    {
        parent::__construct(MeShoppingListsEndpoint::endpoint(), $key, $version, $context);
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
