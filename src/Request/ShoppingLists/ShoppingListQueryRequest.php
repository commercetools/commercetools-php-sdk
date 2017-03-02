<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\ShoppingLists;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractQueryRequest;
use Commercetools\Core\Model\ShoppingList\ShoppingListCollection;
use Commercetools\Core\Response\ApiResponseInterface;
use Commercetools\Core\Model\MapperInterface;

/**
 * @package Commercetools\Core\Request\ShoppingLists
 * @link https://dev.commercetools.com/http-api-projects-ShoppingLists.html#query-ShoppingLists
 * @method ShoppingListCollection mapResponse(ApiResponseInterface $response)
 * @method ShoppingListCollection mapFromResponse(ApiResponseInterface $response, MapperInterface $mapper = null)
 */
class ShoppingListQueryRequest extends AbstractQueryRequest
{
    protected $resultClass = '\Commercetools\Core\Model\ShoppingList\ShoppingListCollection';

    /**
     * @param Context $context
     */
    public function __construct(Context $context = null)
    {
        parent::__construct(ShoppingListsEndpoint::endpoint(), $context);
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
