<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Payments\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\CustomField\Command\SetCustomTypeAction;
use Commercetools\Core\Model\CustomField\FieldContainer;
use Commercetools\Core\Model\Type\TypeReference;

/**
 * @package Commercetools\Core\Request\Payments\Command
 * @link https://docs.commercetools.com/http-api-projects-payments.html#add-interfaceinteraction
 * @method string getAction()
 * @method PaymentAddInterfaceInteractionAction setAction(string $action = null)
 * @method string getTypeId()
 * @method PaymentAddInterfaceInteractionAction setTypeId(string $typeId = null)
 * @method string getTypeKey()
 * @method PaymentAddInterfaceInteractionAction setTypeKey(string $typeKey = null)
 * @method FieldContainer getFields()
 * @method PaymentAddInterfaceInteractionAction setFields(FieldContainer $fields = null)
 * @method TypeReference getType()
 * @method PaymentAddInterfaceInteractionAction setType(TypeReference $type = null)
 */
class PaymentAddInterfaceInteractionAction extends SetCustomTypeAction
{
    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('addInterfaceInteraction');
    }
}
