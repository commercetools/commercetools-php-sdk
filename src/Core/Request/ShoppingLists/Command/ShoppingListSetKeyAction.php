<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\ShoppingLists\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\ShoppingLists\Command
 * @link https://dev.commercetools.com/http-api-projects-shoppingLists.html#set-key
 * @method string getAction()
 * @method ShoppingListSetKeyAction setAction(string $action = null)
 * @method string getKey()
 * @method ShoppingListSetKeyAction setKey(string $key = null)
 */
class ShoppingListSetKeyAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'key' => [static::TYPE => 'string'],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('setKey');
    }

    /**
     * @param string $key
     * @param Context|callable $context
     * @return ShoppingListSetKeyAction
     */
    public static function ofKey($key, $context = null)
    {
        return static::of($context)->setKey($key);
    }
}
