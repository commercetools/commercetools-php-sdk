<?php
/**
 */

namespace Commercetools\Core\Request\Me;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractDeleteRequest;
use Commercetools\Core\Model\ShoppingList\ShoppingList;
use Commercetools\Core\Response\ApiResponseInterface;
use Commercetools\Core\Model\MapperInterface;

/**
 * @package Commercetools\Core\Request\Me
 * @link https://docs.commercetools.com/http-api-projects-me-shoppingLists#delete-shoppinglist
 * @method ShoppingList mapResponse(ApiResponseInterface $response)
 * @method ShoppingList mapFromResponse(ApiResponseInterface $response, MapperInterface $mapper = null)
 */
class MeShoppingListDeleteRequest extends AbstractDeleteRequest
{
    protected $resultClass = ShoppingList::class;

    /**
     * @param string $id
     * @param int $version
     * @param Context $context
     */
    public function __construct($id, $version, Context $context = null)
    {
        parent::__construct(MeShoppingListsEndpoint::endpoint(), $id, $version, $context);
    }

    /**
     * @param string $id
     * @param int $version
     * @param Context $context
     * @return static
     */
    public static function ofIdAndVersion($id, $version, Context $context = null)
    {
        return new static($id, $version, $context);
    }
}
