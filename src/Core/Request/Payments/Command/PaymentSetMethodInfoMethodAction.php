<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Payments\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\Payments\Command
 * @link https://docs.commercetools.com/http-api-projects-payments.html#set-methodinfomethod
 * @method string getAction()
 * @method PaymentSetMethodInfoMethodAction setAction(string $action = null)
 * @method string getMethod()
 * @method PaymentSetMethodInfoMethodAction setMethod(string $method = null)
 */
class PaymentSetMethodInfoMethodAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'method' => [static::TYPE => 'string'],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('setMethodInfoMethod');
    }
}
