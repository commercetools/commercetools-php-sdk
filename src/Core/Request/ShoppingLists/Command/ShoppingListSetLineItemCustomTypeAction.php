<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\ShoppingLists\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\CustomField\Command\SetCustomTypeAction;
use Commercetools\Core\Model\CustomField\FieldContainer;
use Commercetools\Core\Model\Type\TypeReference;

/**
 * @package Commercetools\Core\Request\ShoppingLists\Command
 * @link https://docs.commercetools.com/http-api-projects-shoppingLists.html#set-lineitem-custom-type
 * @method string getAction()
 * @method ShoppingListSetLineItemCustomTypeAction setAction(string $action = null)
 * @method string getLineItemId()
 * @method ShoppingListSetLineItemCustomTypeAction setLineItemId(string $lineItemId = null)
 * @method FieldContainer getFields()
 * @method ShoppingListSetLineItemCustomTypeAction setFields(FieldContainer $fields = null)
 * @method TypeReference getType()
 * @method ShoppingListSetLineItemCustomTypeAction setType(TypeReference $type = null)
 */
class ShoppingListSetLineItemCustomTypeAction extends SetCustomTypeAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'type' => [static::TYPE => TypeReference::class],
            'lineItemId' => [static::TYPE => 'string'],
            'fields' => [static::TYPE => FieldContainer::class],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('setLineItemCustomType');
    }

    /**
     * @param string $typeKey
     * @param string $lineItemId
     * @param Context|callable $context
     * @return static
     */
    public static function ofTypeKeyAndLineItemId($typeKey, $lineItemId, $context = null)
    {
        return static::ofTypeKey($typeKey, $context)->setLineItemId($lineItemId);
    }

    /**
     * @param string $typeId
     * @param string $lineItemId
     * @param Context|callable $context
     * @return static
     */
    public static function ofTypeIdAndLineItemId($typeId, $lineItemId, $context = null)
    {
        return static::ofTypeId($typeId, $context)->setLineItemId($lineItemId);
    }

    /**
     * @param TypeReference $type
     * @param string $lineItemId
     * @param Context|callable $context
     * @return static
     */
    public static function ofTypeAndLineItemId(TypeReference $type, $lineItemId, $context = null)
    {
        return static::ofType($type, $context)->setLineItemId($lineItemId);
    }
}
