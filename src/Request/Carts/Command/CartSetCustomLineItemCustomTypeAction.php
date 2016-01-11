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
 *
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
            'type' => [static::TYPE => '\Commercetools\Core\Model\Type\TypeReference'],
            'customLineItemId' => [static::TYPE => 'string'],
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
        $this->setAction('setCustomLineItemCustomType');
    }
}
