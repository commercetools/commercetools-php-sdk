<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Payments\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\Payments\Command
 * @link https://docs.commercetools.com/http-api-projects-payments.html#set-methodinfointerface
 * @method string getAction()
 * @method PaymentSetMethodInfoInterfaceAction setAction(string $action = null)
 * @method string getInterface()
 * @method PaymentSetMethodInfoInterfaceAction setInterface(string $interface = null)
 */
class PaymentSetMethodInfoInterfaceAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'interface' => [static::TYPE => 'string'],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('setMethodInfoInterface');
    }

    /**
     * @param string $interface
     * @param Context|callable $context
     * @return PaymentSetMethodInfoInterfaceAction
     */
    public static function ofInterface($interface, $context = null)
    {
        return static::of($context)->setInterface($interface);
    }
}
