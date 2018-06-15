<?php
/**
 */

namespace Commercetools\Core\Request\ShoppingLists\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\ShoppingLists\Command
 *
 * @method string getAction()
 * @method ShoppingListSetAnonymousIdAction setAction(string $action = null)
 * @method string getAnonymousId()
 * @method ShoppingListSetAnonymousIdAction setAnonymousId(string $anonymousId = null)
 */
class ShoppingListSetAnonymousIdAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'anonymousId' => [static::TYPE => 'string'],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('setAnonymousId');
    }
}
