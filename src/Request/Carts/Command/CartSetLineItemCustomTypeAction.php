<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Carts\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\CustomField\Command\SetCustomTypeAction;
use Commercetools\Core\Model\CustomField\FieldContainer;

/**
 * @package Commercetools\Core\Request\Carts\Command
 * @method string getAction()
 * @method CartSetLineItemCustomTypeAction setAction(string $action = null)
 * @method string getTypeId()
 * @method CartSetLineItemCustomTypeAction setTypeId(string $typeId = null)
 * @method string getTypeKey()
 * @method CartSetLineItemCustomTypeAction setTypeKey(string $typeKey = null)
 * @method string getLineItemId()
 * @method CartSetLineItemCustomTypeAction setLineItemId(string $lineItemId = null)
 * @method FieldContainer getFields()
 * @method CartSetLineItemCustomTypeAction setFields(FieldContainer $fields = null)
 */
class CartSetLineItemCustomTypeAction extends SetCustomTypeAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'typeId' => [static::TYPE => 'string'],
            'typeKey' => [static::TYPE => 'string'],
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
}
