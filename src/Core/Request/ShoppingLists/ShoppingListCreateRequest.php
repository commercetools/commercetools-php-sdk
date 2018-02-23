<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\ShoppingLists;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\ShoppingList\ShoppingListDraft;
use Commercetools\Core\Request\AbstractCreateRequest;
use Commercetools\Core\Model\ShoppingList\ShoppingList;
use Commercetools\Core\Response\ApiResponseInterface;
use Commercetools\Core\Model\MapperInterface;

/**
 * @package Commercetools\Core\Request\ShoppingLists
 * @link https://docs.commercetools.com/http-api-projects-shoppingLists.html#create-ShoppingList
 * @method ShoppingList mapResponse(ApiResponseInterface $response)
 * @method ShoppingList mapFromResponse(ApiResponseInterface $response, MapperInterface $mapper = null)
 */
class ShoppingListCreateRequest extends AbstractCreateRequest
{
    protected $resultClass = ShoppingList::class;

    /**
     * @param ShoppingListDraft $ShoppingList
     * @param Context $context
     */
    public function __construct(ShoppingListDraft $ShoppingList, Context $context = null)
    {
        parent::__construct(ShoppingListsEndpoint::endpoint(), $ShoppingList, $context);
    }

    /**
     * @param ShoppingListDraft $ShoppingList
     * @param Context $context
     * @return static
     */
    public static function ofDraft(ShoppingListDraft $ShoppingList, Context $context = null)
    {
        return new static($ShoppingList, $context);
    }
}
