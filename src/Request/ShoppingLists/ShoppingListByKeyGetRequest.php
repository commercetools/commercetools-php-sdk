<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\ShoppingLists;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\ShoppingList\ShoppingList;
use Commercetools\Core\Request\AbstractByKeyGetRequest;
use Commercetools\Core\Response\ApiResponseInterface;
use Commercetools\Core\Model\MapperInterface;

/**
 * @package Commercetools\Core\Request\ShoppingLists
 * @method ShoppingList mapResponse(ApiResponseInterface $response)
 * @method ShoppingList mapFromResponse(ApiResponseInterface $response, MapperInterface $mapper = null)
 */
class ShoppingListByKeyGetRequest extends AbstractByKeyGetRequest
{
    protected $resultClass = '\Commercetools\Core\Model\ShoppingList\ShoppingList';

    /**
     * @param string $key
     * @param Context $context
     */
    public function __construct($key, Context $context = null)
    {
        parent::__construct(ShoppingListsEndpoint::endpoint(), $key, $context);
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
