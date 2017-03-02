<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Carts\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\CustomField\Command\SetCustomTypeAction;
use Commercetools\Core\Model\CustomField\FieldContainer;
use Commercetools\Core\Model\Type\TypeReference;

/**
 * @package Commercetools\Core\Request\Carts\Command
 * @link https://dev.commercetools.com/http-api-projects-carts.html#set-customlineitem-custom-type
 * @method string getAction()
 * @method CartSetLineItemCustomTypeAction setAction(string $action = null)
 * @method string getLineItemId()
 * @method CartSetLineItemCustomTypeAction setLineItemId(string $lineItemId = null)
 * @method FieldContainer getFields()
 * @method CartSetLineItemCustomTypeAction setFields(FieldContainer $fields = null)
 * @method TypeReference getType()
 * @method CartSetLineItemCustomTypeAction setType(TypeReference $type = null)
 */
class CartSetLineItemCustomTypeAction extends SetCustomTypeAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'type' => [static::TYPE => '\Commercetools\Core\Model\Type\TypeReference'],
            'lineItemId' => [static::TYPE => 'string'],
            'fields' => [static::TYPE => '\Commercetools\Core\Model\CustomField\FieldContainer'],
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
