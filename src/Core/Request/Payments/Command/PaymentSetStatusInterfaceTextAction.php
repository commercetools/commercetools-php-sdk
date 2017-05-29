<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Payments\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractAction;
use Commercetools\Core\Model\Customer\CustomerReference;

/**
 * @package Commercetools\Core\Request\Payments\Command
 * @link https://dev.commercetools.com/http-api-projects-payments.html#set-statusinterfacetext
 * @method string getAction()
 * @method PaymentSetStatusInterfaceTextAction setAction(string $action = null)
 * @method string getInterfaceText()
 * @method PaymentSetStatusInterfaceTextAction setInterfaceText(string $interfaceText = null)
 */
class PaymentSetStatusInterfaceTextAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'interfaceText' => [static::TYPE => 'string'],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('setStatusInterfaceText');
    }
}
