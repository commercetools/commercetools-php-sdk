<?php
/**
 */

namespace Commercetools\Core\Request\Me;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractQueryRequest;
use Commercetools\Core\Model\ShoppingList\ShoppingListCollection;
use Commercetools\Core\Response\ApiResponseInterface;
use Commercetools\Core\Model\MapperInterface;

/**
 * @package Commercetools\Core\Request\Me
 * @link https://docs.commercetools.com/http-api-projects-me-shoppingLists#query-shoppinglists
 * @method ShoppingListCollection mapResponse(ApiResponseInterface $response)
 * @method ShoppingListCollection mapFromResponse(ApiResponseInterface $response, MapperInterface $mapper = null)
 */
class MeShoppingListQueryRequest extends AbstractQueryRequest
{
    protected $resultClass = ShoppingListCollection::class;

    /**
     * @param Context $context
     */
    public function __construct(Context $context = null)
    {
        parent::__construct(MeShoppingListsEndpoint::endpoint(), $context);
    }

    /**
     * @param Context $context
     * @return static
     */
    public static function of(Context $context = null)
    {
        return new static($context);
    }
}
