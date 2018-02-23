<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Carts\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\CustomField\Command\SetCustomFieldAction;

/**
 * @package Commercetools\Core\Request\Carts\Command
 * @link https://docs.commercetools.com/http-api-projects-carts.html#set-lineitem-customfield
 * @method string getAction()
 * @method CartSetLineItemCustomFieldAction setAction(string $action = null)
 * @method string getName()
 * @method CartSetLineItemCustomFieldAction setName(string $name = null)
 * @method string getLineItemId()
 * @method CartSetLineItemCustomFieldAction setLineItemId(string $lineItemId = null)
 * @method mixed getValue()
 * @method CartSetLineItemCustomFieldAction setValue($value = null)
 */
class CartSetLineItemCustomFieldAction extends SetCustomFieldAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'name' => [static::TYPE => 'string'],
            'lineItemId' => [static::TYPE => 'string'],
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
        $this->setAction('setLineItemCustomField');
    }

    /**
     * @param string $lineItemId
     * @param string $name
     * @param Context|callable $context
     * @return static
     */
    public static function ofLineItemIdAndName($lineItemId, $name, $context = null)
    {
        return static::of($context)->setLineItemId($lineItemId)->setName($name);
    }
}
