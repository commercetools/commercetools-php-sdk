<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\ShoppingLists\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractAction;
use Commercetools\Core\Model\Common\LocalizedString;

/**
 * @package Commercetools\Core\Request\ShoppingLists\Command
 * @link https://docs.commercetools.com/http-api-projects-shoppingLists.html#set-textlineitem-description
 * @method string getAction()
 * @method ShoppingListSetTextLineItemDescriptionAction setAction(string $action = null)
 * @method string getTextLineItemId()
 * @method ShoppingListSetTextLineItemDescriptionAction setTextLineItemId(string $textLineItemId = null)
 * @method LocalizedString getDescription()
 * @method ShoppingListSetTextLineItemDescriptionAction setDescription(LocalizedString $description = null)
 */
class ShoppingListSetTextLineItemDescriptionAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'textLineItemId' => [static::TYPE => 'string'],
            'description' => [static::TYPE => LocalizedString::class],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('setTextLineItemDescription');
    }

    /**
     * @param string $textLineItemId
     * @param Context|callable $context
     * @return ShoppingListSetTextLineItemDescriptionAction
     */
    public static function ofTextLineItemId($textLineItemId, $context = null)
    {
        return static::of($context)->setTextLineItemId($textLineItemId);
    }
}
