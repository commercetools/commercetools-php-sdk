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
 * @deprecated
 * @link https://dev.commercetools.com/http-api-projects-payments.html#set-externalid
 * @method string getAction()
 * @method PaymentSetExternalIdAction setAction(string $action = null)
 * @method string getExternalId()
 * @method PaymentSetExternalIdAction setExternalId(string $externalId = null)
 */
class PaymentSetExternalIdAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'externalId' => [static::TYPE => 'string'],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('setExternalId');
    }
}
