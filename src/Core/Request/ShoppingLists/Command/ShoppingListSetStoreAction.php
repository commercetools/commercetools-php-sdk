<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\ShoppingLists\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Store\StoreReference;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\ShoppingLists\Command
 * @link https://docs.commercetools.com/http-api-projects-shoppingLists.html#set-store
 * @method string getAction()
 * @method ShoppingListSetStoreAction setAction(string $action = null)
 * @method StoreReference getStore()
 * @method ShoppingListSetStoreAction setStore(StoreReference $store = null)
 */
class ShoppingListSetStoreAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'store' => [static::TYPE => StoreReference::class],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('setStore');
    }

    /**
     * @param StoreReference $store
     * @param Context|callable $context
     * @return ShoppingListSetStoreAction
     */
    public static function ofStore(StoreReference $store, $context = null)
    {
        return static::of($context)->setStore($store);
    }
}
