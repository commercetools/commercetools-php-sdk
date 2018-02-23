<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Carts\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\CustomField\Command\SetCustomTypeAction;
use Commercetools\Core\Model\CustomField\FieldContainer;
use Commercetools\Core\Model\Type\TypeReference;

/**
 * @package Commercetools\Core\Request\Carts\Command
 * @link https://docs.commercetools.com/http-api-projects-carts.html#set-customlineitem-custom-type
 * @method string getAction()
 * @method CartSetCustomLineItemCustomTypeAction setAction(string $action = null)
 * @method string getCustomLineItemId()
 * @method CartSetCustomLineItemCustomTypeAction setCustomLineItemId(string $customLineItemId = null)
 * @method FieldContainer getFields()
 * @method CartSetCustomLineItemCustomTypeAction setFields(FieldContainer $fields = null)
 * @method TypeReference getType()
 * @method CartSetCustomLineItemCustomTypeAction setType(TypeReference $type = null)
 */
class CartSetCustomLineItemCustomTypeAction extends SetCustomTypeAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'type' => [static::TYPE => TypeReference::class],
            'customLineItemId' => [static::TYPE => 'string'],
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
        $this->setAction('setCustomLineItemCustomType');
    }

    /**
     * @param string $typeKey
     * @param string $customLineItemId
     * @param Context|callable $context
     * @return static
     */
    public static function ofTypeKeyAndCustomLineItemId($typeKey, $customLineItemId, $context = null)
    {
        return static::ofTypeKey($typeKey, $context)->setCustomLineItemId($customLineItemId);
    }

    /**
     * @param string $typeId
     * @param string $customLineItemId
     * @param Context|callable $context
     * @return static
     */
    public static function ofTypeIdAndCustomLineItemId($typeId, $customLineItemId, $context = null)
    {
        return static::ofTypeId($typeId, $context)->setCustomLineItemId($customLineItemId);
    }

    /**
     * @param TypeReference $type
     * @param string $customLineItemId
     * @param Context|callable $context
     * @return static
     */
    public static function ofTypeAndCustomLineItemId(TypeReference $type, $customLineItemId, $context = null)
    {
        return static::ofType($type, $context)->setCustomLineItemId($customLineItemId);
    }
}
