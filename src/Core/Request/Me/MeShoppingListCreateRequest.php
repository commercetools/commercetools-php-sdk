<?php
/**
 */

namespace Commercetools\Core\Request\Me;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\ShoppingList\MyShoppingListDraft;
use Commercetools\Core\Request\AbstractCreateRequest;
use Commercetools\Core\Model\ShoppingList\ShoppingList;
use Commercetools\Core\Response\ApiResponseInterface;
use Commercetools\Core\Model\MapperInterface;

/**
 * @package Commercetools\Core\Request\Me
 * @link https://docs.commercetools.com/http-api-projects-me-shoppingLists#create-a-shoppinglist
 * @method ShoppingList mapResponse(ApiResponseInterface $response)
 * @method ShoppingList mapFromResponse(ApiResponseInterface $response, MapperInterface $mapper = null)
 */
class MeShoppingListCreateRequest extends AbstractCreateRequest
{
    protected $resultClass = ShoppingList::class;

    /**
     * @param MyShoppingListDraft $ShoppingList
     * @param Context $context
     */
    public function __construct(MyShoppingListDraft $ShoppingList, Context $context = null)
    {
        parent::__construct(MeShoppingListsEndpoint::endpoint(), $ShoppingList, $context);
    }

    /**
     * @param MyShoppingListDraft $ShoppingList
     * @param Context $context
     * @return static
     */
    public static function ofDraft(MyShoppingListDraft $ShoppingList, Context $context = null)
    {
        return new static($ShoppingList, $context);
    }
}
