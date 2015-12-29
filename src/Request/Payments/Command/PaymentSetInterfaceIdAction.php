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
 *
 * @method string getAction()
 * @method PaymentSetInterfaceIdAction setAction(string $action = null)
 * @method string getInterfaceId()
 * @method PaymentSetInterfaceIdAction setInterfaceId(string $interfaceId = null)
 */
class PaymentSetInterfaceIdAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'interfaceId' => [static::TYPE => 'string'],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('setInterfaceId');
    }

    /**
     * @param string $interfaceId
     * @param Context|callable $context
     * @return PaymentSetInterfaceIdAction
     */
    public static function ofInterfaceId($interfaceId, $context = null)
    {
        return static::of($context)->setInterfaceId($interfaceId);
    }
}
