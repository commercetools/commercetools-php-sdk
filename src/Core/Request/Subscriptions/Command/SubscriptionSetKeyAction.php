<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Subscriptions\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\Subscriptions\Command
 * @link https://docs.commercetools.com/http-api-projects-subscriptions.html#set-key
 * @method string getAction()
 * @method SubscriptionSetKeyAction setAction(string $action = null)
 * @method string getKey()
 * @method SubscriptionSetKeyAction setKey(string $key = null)
 */
class SubscriptionSetKeyAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'key' => [static::TYPE => 'string'],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('setKey');
    }
}
