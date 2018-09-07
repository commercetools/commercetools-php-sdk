<?php
/**
 */

namespace Commercetools\Core\Request\Payments\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\Payments\Command
 * @link https://docs.commercetools.com/http-api-projects-payments#set-anonymousid
 * @method string getAction()
 * @method PaymentSetAnonymousIdAction setAction(string $action = null)
 * @method string getAnonymousId()
 * @method PaymentSetAnonymousIdAction setAnonymousId(string $anonymousId = null)
 */
class PaymentSetAnonymousIdAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'anonymousId' => [static::TYPE => 'string'],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('setAnonymousId');
    }
}
