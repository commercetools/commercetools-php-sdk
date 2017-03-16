<?php
/**
 * Created by PhpStorm.
 * User: ibrahimselim
 * Date: 16/03/17
 * Time: 15:02
 */

namespace Commercetools\Core\Request\ShoppingLists\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\ShoppingLists\Command
 * @link https://dev.commercetools.com/http-api-projects-shoppingLists.html#set-deletedaysafterlastmodification
 * @method string getAction()
 * @method ShoppingListSetDeleteDaysAfterLastModificationAction setAction(string $action = null)
 */
class ShoppingListSetDeleteDaysAfterLastModificationAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'deleteDaysAfterLastModification' => [static::TYPE => 'int']
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('setDeleteDaysAfterLastModification');
    }
}
