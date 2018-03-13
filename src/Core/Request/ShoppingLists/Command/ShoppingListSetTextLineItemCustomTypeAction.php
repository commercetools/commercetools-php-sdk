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
 * @link https://docs.commercetools.com/http-api-projects-shoppingLists.html#set-textlineitem-custom-type
 * @method string getAction()
 * @method ShoppingListSetTextLineItemCustomTypeAction setAction(string $action = null)
 * @method string getTextLineItemId()
 * @method ShoppingListSetTextLineItemCustomTypeAction setTextLineItemId(string $textLineItemId = null)
 * @method FieldContainer getFields()
 * @method ShoppingListSetTextLineItemCustomTypeAction setFields(FieldContainer $fields = null)
 * @method TypeReference getType()
 * @method ShoppingListSetTextLineItemCustomTypeAction setType(TypeReference $type = null)
 */
class ShoppingListSetTextLineItemCustomTypeAction extends SetCustomTypeAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'type' => [static::TYPE => TypeReference::class],
            'textLineItemId' => [static::TYPE => 'string'],
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
        $this->setAction('setTextLineItemCustomType');
    }

    /**
     * @param string $typeKey
     * @param string $textLineItemId
     * @param Context|callable $context
     * @return static
     */
    public static function ofTypeKeyAndTextLineItemId($typeKey, $textLineItemId, $context = null)
    {
        return static::ofTypeKey($typeKey, $context)->setTextLineItemId($textLineItemId);
    }

    /**
     * @param string $typeId
     * @param string $textLineItemId
     * @param Context|callable $context
     * @return static
     */
    public static function ofTypeIdAndTextLineItemId($typeId, $textLineItemId, $context = null)
    {
        return static::ofTypeId($typeId, $context)->setTextLineItemId($textLineItemId);
    }

    /**
     * @param TypeReference $type
     * @param string $textLineItemId
     * @param Context|callable $context
     * @return static
     */
    public static function ofTypeAndTextLineItemId(TypeReference $type, $textLineItemId, $context = null)
    {
        return static::ofType($type, $context)->setTextLineItemId($textLineItemId);
    }
}
