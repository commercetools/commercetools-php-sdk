<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Payments\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractAction;
use Commercetools\Core\Model\Common\LocalizedString;

/**
 * @package Commercetools\Core\Request\Payments\Command
 * @link https://dev.commercetools.com/http-api-projects-payments.html#set-methodinfo-name
 * @method string getAction()
 * @method PaymentSetMethodInfoNameAction setAction(string $action = null)
 * @method LocalizedString getName()
 * @method PaymentSetMethodInfoNameAction setName(LocalizedString $name = null)
 */
class PaymentSetMethodInfoNameAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'name' => [static::TYPE => '\Commercetools\Core\Model\Common\LocalizedString'],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('setMethodInfoName');
    }
}
