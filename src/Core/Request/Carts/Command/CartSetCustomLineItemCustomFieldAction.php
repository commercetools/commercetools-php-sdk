<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Carts\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\CustomField\Command\SetCustomFieldAction;

/**
 * @package Commercetools\Core\Request\Carts\Command
 * @link https://dev.commercetools.com/http-api-projects-carts.html#set-customlineitem-customfield
 * @method string getAction()
 * @method CartSetCustomLineItemCustomFieldAction setAction(string $action = null)
 * @method string getName()
 * @method CartSetCustomLineItemCustomFieldAction setName(string $name = null)
 * @method string getCustomLineItemId()
 * @method CartSetCustomLineItemCustomFieldAction setCustomLineItemId(string $customLineItemId = null)
 * @method mixed getValue()
 * @method CartSetCustomLineItemCustomFieldAction setValue($value = null)
 */
class CartSetCustomLineItemCustomFieldAction extends SetCustomFieldAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'name' => [static::TYPE => 'string'],
            'customLineItemId' => [static::TYPE => 'string'],
            'value' => [static::TYPE => null],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('setCustomLineItemCustomField');
    }

    /**
     * @param string $customLineItemId
     * @param string $name
     * @param Context|callable $context
     * @return static
     */
    public static function ofCustomLineItemIdAndName($customLineItemId, $name, $context = null)
    {
        return static::of($context)->setCustomLineItemId($customLineItemId)->setName($name);
    }
}
